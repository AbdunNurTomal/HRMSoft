<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_companysolicies_div">
        <button class="btn btn-u btn-md" onClick="add_companypolicies()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-companysolicies" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="20%">
                <col width="25%">
                <col width="20%">
                <col width="20%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Policy Name</th>
                    <th>Description</th>
                    <th>Signature</th>
                    <th>Download File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $query = $this->db->get_where('main_company_policies', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        if($row->is_singture==1){$is_singture="Yes";} else if($row->is_singture==2){$is_singture="No";} else {$is_singture=""; }

                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->policy_name . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->description  . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $is_singture  . "</td>";
                        // print"<td ><a href='#' onclick='download_file_com(" . $row->id . ")' >" . $row->policy_file_path  . "</a></td>";
                        print"<td ><a href='#' onclick='download_file_com(" . $row->id . ")' >" . $row->file_name  . "</a></td>";
                        print"<td><div class='action-buttons '><a href='#' onclick='edit_company_policies(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_company_policies(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>

<div class="modal fade bd-example-modal-lg" id="companypolicies_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Company Policies</h4>
            </div>
            <form id="companypolicies_form" name="sky-form11" class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="companypolicies_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Policy Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="policy_name" id="policy_name" class="form-control input-sm"  placeholder="Policy Name" data-toggle="tooltip" data-placement="bottom" title="Policy Name">
                        </div>
                        <label class="col-sm-2 control-label">Description<span class="req"/></label>
                        <div class="col-sm-4">
                            <textarea name="description" id="description" class="form-control" rows="1" placeholder="Description" data-toggle="tooltip" data-placement="top" title="Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Signature</label>
                        <div class="col-sm-4 padding-top-5">
                             <input type="radio" id="is_singture" name="is_singture" value="1" checked> Yes
                             <input type="radio" id="is_singture" name="is_singture" value="2" > No
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Custom Text</label>
                        <div class="col-sm-8">
                            <textarea name="custom_text" id="custom_text" class="ckeditor"></textarea>
                            <textarea name="hidden_custom_text" id="hidden_custom_text" style="display:none;"></textarea>
                        </div>
                        <label class="col-sm-2 control-label"></label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Upload File</label>
                        <div class="col-sm-4">
                            <!--<input type="file" name="license_file" id="license_file" size="20" />-->
                            <a href="#" onclick="add_policy_file();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                <button type="button" class="btn btn-u">Upload</button>
                            </a>                
                            <input type="hidden" name="policy_file_path" id="policy_file_path" />
                            <input type="hidden" name="actual_policy_filename" id="actual_policy_filename" />
                            <label id="policy_file_label"></label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="policy_file_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
            </div>
            <form id="policy_file_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Document </label>
                        <div class="col-sm-8">
                            <input type="file" name="policy_file" id="policy_file" size="20" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

   $(document).ready(function () {
        $('#dataTables-example-companysolicies').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "destroy": true,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_companypolicies()
    {
        save_method = 'add';
        $('#companypolicies_form')[0].reset(); // reset form on modals
        CKEDITOR.instances.custom_text.setData( );
        $('#companypolicies_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Company Policies'); // Set Title to Bootstrap modal title
        
        CKEDITOR.replace( 'custom_text', {
            extraPlugins: 'imageuploader'
        });

    }
    
    function add_policy_file()
    {
        $('#policy_file_form')[0].reset(); // reset form on modals
        $('#policy_file_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Upload File'); // Set Title to Bootstrap modal title
    }
    
    function download_file_com(id)
    {
        var b_url="<?php echo base_url(); ?>";
        window.location = b_url+"Con_configaration/download_policy_file_com/"+ id;
    }
    
   
 
    
</script>