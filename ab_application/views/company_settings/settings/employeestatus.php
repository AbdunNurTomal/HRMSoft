<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="employeestatus_div">
        <button class="btn btn-u btn-md" onClick="add_employeestatus()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-employeestatus" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap ">
            <colgroup>
                <col width="5%">
                <col width="40%">
                <col width="40%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Status </th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $query = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->workcodename, 'tbl_employmentstatus', 'employemnt_status') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_employeestatus(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_employeestatus(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="employeestatus_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Employee Status</h4>
            </div>
            <form id="employeestatus_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="employeestatus_id" id="employeestatus_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status <span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="workcodename" id="workcodename" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $employmentstatus_query = $this->db->get_where('tbl_employmentstatus', array('isactive' => 1));
                                foreach ($employmentstatus_query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->employemnt_status . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="description" name="description" placeholder="Description"></textarea>
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
         $('#dataTables-example-employeestatus').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_employeestatus()
    {
        save_method = 'add';
        $('#employeestatus_form')[0].reset(); // reset form on modals
        
        $("#workcodename").select2({
            placeholder: "Work Code",
            allowClear: true,
        });
    
        $('#employeestatus_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Employee Status'); // Set Title to Bootstrap modal title
    }
    
    $("#workcodename").select2({
        placeholder: "Work Code",
        allowClear: true,
    });
    
    
</script>