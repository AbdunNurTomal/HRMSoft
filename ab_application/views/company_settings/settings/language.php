<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_language_div">
        <button class="btn btn-u btn-md" onClick="add_language()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-language" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
               <col width="5%">
                <col width="50%">
                <col width="45%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Language Name</th>
                    <!--<th>Description</th>-->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $query = $this->db->get_where('main_com_language', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->languagename, 'main_language', 'languagename') . "</td>";
//                        print"<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_language(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_language(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>

<!-- Modal -->
<div class="modal fade" id="language_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Language</h4>
            </div>
            <form id="language_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="language_id" id="language_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <div class=" col-md-10 col-md-offset-1">
                        <label class="col-sm-3 control-label">Language<span class="req"/></label>
                        <div class="col-sm-7">
                            <select name="languagename" id="languagename" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $pay_freq = $this->db->get_where('main_language', array('company_id' => $this->company_settings_id,))->result();
                                //print_r($this->company_id); exit;
                                foreach ($pay_freq as $row) :
                                    ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->languagename; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
<!--                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="2" id="description" name="description" placeholder="Description"></textarea>
                        </div> -->
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



<script type="text/javascript">
    
    $(document).ready(function () {
         $('#dataTables-example-language').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 25,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_language()
    {
        save_method = 'add';
        $('#language_form')[0].reset(); // reset form on modals
        
        $("#languagename").select2({
            placeholder: "Select Language Name",
            allowClear: true,
        });
    
        $('#language_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Language'); // Set Title to Bootstrap modal title
    }
    
    $("#languagename").select2({
        placeholder: "Select Language Name",
        allowClear: true,
    });


</script>