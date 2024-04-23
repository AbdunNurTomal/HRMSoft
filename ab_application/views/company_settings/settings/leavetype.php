<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_leavetype_div">
        <button class="btn btn-u btn-md" onClick="add_leavetype()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <!--<div class="overflow-x" style=" overflow-y: scroll; margin-bottom: 12px; max-height: 800px; ">-->
        <table id="dataTables-example-leavetype" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
                <col width="10%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Leave Type</th>
                    <th>Leave Key</th>
                    <th>Type of Leave</th>
                    <th>Paid?</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                //$leave_types = $this->db->get_where('main_leave_types', array('company_id' => $this->company_id))->result();
                //echo $this->db->last_query();
                
                $leavetypeid_array = $this->Common_model->get_array('leavetype');
                $yes_no_array = $this->Common_model->get_array('yes_no');
                $employee_status_array = $this->Common_model->get_array('employee_status');

                $query = $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_settings_id, 'isactive' => 1));
                //

                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        if($row->is_paid==0) $is_paid=""; else $is_paid=$yes_no_array[$row->is_paid];
                        
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $leavetypeid_array[$row->leavetype] . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_code, 'main_leave_types', 'leave_code'). " - " . $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $row->leave_short_code . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $is_paid . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $employee_status_array[$row->status] . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_leavetype(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_leavetype(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <!--</div>-->
    </div>
    <!-- end data table -->
</div>

<!-- Modal -->
<div class="modal fade" id="leavetype_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Leave Type</h4>
            </div>
            <form id="leavetype_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="leavetype_id" id="leavetype_id"/>
                <div class="modal-body">
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Leave Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="leavetypeid" id="leavetypeid" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($leavetypeid_array as $roww => $vall) {
                                    print"<option value='" . $roww . "'>" . $vall . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Leave Key <span class="req"/></label>
                        <div class="col-sm-4">
                            <?php
                            $leave_types = $this->db->get_where('main_leave_types', array('company_id' => $this->company_id))->result();
                            ?>
                            <select name="leave_code" id="leave_code" onchange="get_leave_short_code(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($leave_types as $row) {
                                    echo '<option value="' . $row->id . '" > ' . $row->leave_code . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Paid ? </label>
                        <div class="col-sm-4">
                            <select name="is_paid" id="is_paid" class="col-sm-12 col-xs-8 myselect2 input-sm">
                                <option></option>
                                <?php
                                $yes_no_array = $this->Common_model->get_array('yes_no');
                                foreach ($yes_no_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label"> Type of Leave </label>
                        <div class="col-sm-4">
                            <input type="text" name="leave_short_code" id="leave_short_code"  class="form-control input-sm" placeholder="Leave Name" readonly >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Status  </label>
                        <div class="col-sm-4">
                            <select name="emp_status" id="emp_status" class="col-sm-12 col-xs-8 myselect2 input-sm">
                                <option></option>
                                <?php
                                $employee_status_array = $this->Common_model->get_array('employee_status');
                                foreach ($employee_status_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">State </label>
                        <div class="col-sm-4">
                            <select name="state_id" id="state_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $state_query = $this->Common_model->listItem('main_state');
                                foreach ($state_query->result() as $keyy):
                                    ?>
                                    <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
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
        $('#dataTables-example-leavetype').dataTable({
            "order": [0, "asc"],
            "pageLength": 10,
            "paginationType": "input"
        });
    });

    var save_method; //for save method string
    var table;
    function add_leavetype()
    {
        save_method = 'add';
        $('#leavetype_form')[0].reset(); // reset form on modals
        
        $("#leavetypeid").select2({
            placeholder: "Select Leave Type",
            allowClear: true,
        });

        $("#state_id").select2({
            placeholder: "Select State",
            allowClear: true,
        });
        
        $("#leave_code").select2({
            placeholder: "Select Leave Key",
            allowClear: true,
        });

        $("#is_paid").select2({
            placeholder: "Paid ? ",
            allowClear: true,
        });
    
        $("#emp_status").select2({
            placeholder: "Select status",
            allowClear: true,
        });
    

        $('#leavetype_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Leave Type'); // Set Title to Bootstrap modal title
    }

    $("#leavetypeid").select2({
        placeholder: "Select Leave Type",
        allowClear: true,
    });
    
    $("#state_id").select2({
        placeholder: "Select State",
        allowClear: true,
    });
    
    $("#leave_code").select2({
        placeholder: "Select Leave Key",
        allowClear: true,
    });

    $("#is_paid").select2({
        placeholder: "Paid ? ",
        allowClear: true,
    });
    
    $("#emp_status").select2({
        placeholder: "Select status",
        allowClear: true,
    });
    
    
    function get_leave_short_code(id){
         
         $.ajax({
            url: "<?php echo site_url('Con_configaration/search_leave_short_code/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#leave_short_code').val('');
                $('#leave_short_code').val(data);
            }
        })
    }


</script>