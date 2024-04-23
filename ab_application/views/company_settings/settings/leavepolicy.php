<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_leavepolicy_div">
        <button class="btn btn-u btn-md" onClick="add_leavepolicy()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-leavepolicy" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
               <col width="5%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Leave Type</th>
                    <th>Employee Type</th>
                    <th>Applicable</th>
                    <th>Year</th>
                    <th>Max Limit (hour) </th>
                    <th>Is Day-off</th>                            
                    <th>Is Fractional</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $employee_type_array=$this->Common_model->get_array('employee_type');
                $applicable_array=$this->Common_model->get_array('applicable');
                $yes_no_array=$this->Common_model->get_array('yes_no');
                $status_array = $this->Common_model->get_array('status');
                
                if ($this->user_group == 11  || $this->user_group == 12 || $this->user_group == 4) {
                    $leave_type = $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_id,'leavetype' => 1,'isactive' => 1));
                } else {
                    $leave_type = $this->db->get_where('main_employeeleavetypes', array('isactive' => 1,'leavetype' => 1));
                }
                
                //echo $this->db->last_query();
                
                //$query = $this->db->get_where('main_leave_policy', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                $this->db->select('main_leave_policy.id as lid,main_leave_policy.*,main_employeeleavetypes.*');
                $this->db->from('main_leave_policy');
                $this->db->join('main_employeeleavetypes', 'main_leave_policy.leave_type = main_employeeleavetypes.leave_code');
                $this->db->where('main_leave_policy.company_id', $this->company_settings_id);
                $this->db->where('main_leave_policy.isactive', 1);
                //$this->db->where('main_employeeleavetypes.isactive', 1);
                $this->db->order_by('main_leave_policy.id', 'DESC');
                $query = $this->db->get();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $pdt = $row->lid;
                        $i++;
                        if($row->off_day_leave_count==0)$off_day_leave_count=""; else $off_day_leave_count=$yes_no_array[$row->off_day_leave_count];
                        if($row->fractional_leave==0)$fractional_leave=""; else $fractional_leave=$yes_no_array[$row->fractional_leave];

                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->leave_type,'main_leave_types','leave_code') . " - " . $this->Common_model->get_name($this, $row->state,'main_state','state_abbr')."</td>";
                        print"<td id='catA" . $pdt . "'>" . $employee_type_array[$row->employee_type]  ."</td>";
                        print"<td id='catA" . $pdt . "'>" . $applicable_array[$row->applicable] . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $row->leave_year . "</td>"; 
                        print"<td id='catA" . $pdt . "'>" . $row->max_limit . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $off_day_leave_count . "</td>";                                
                        print"<td id='catD" . $pdt . "'>" . $fractional_leave . "</td>";                                
                        print"<td id='catA" . $pdt . "'>" . $status_array[$row->isactive] . "</td>";
                        print"<td><div class='action-buttons '><a href='#' onclick='edit_leavepolicy(" . $row->lid . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;</div> </td>";
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
<div class="modal fade" id="leavepolicy_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add leave policy</h4>
            </div>
            <form id="leavepolicy_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="leavepolicy_id" id="leavepolicy_id"/>
                <div class="modal-body">
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Leave Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <div id="nonacc_leave_type_div_id">
                                <select name="leave_type" id="leave_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($leave_type->result() as $row) {
                                        $leave_code=$this->Common_model->get_name($this, $row->leave_code, 'main_leave_types', 'leave_code') ." - ". $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr');
                                        print"<option value='" . $row->leave_code . "'>" . $leave_code . "</option>";
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">Employee Type<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <select name="employee_type" id="employee_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $e_type = $this->Common_model->get_array('employee_type');
                                foreach ($e_type as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Applicable<span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <select name="applicable" id="applicable" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $applicable = $this->Common_model->get_array('applicable');
                                foreach ($applicable as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                        <label class="col-sm-2 control-label">Year<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <input type="text" name="leave_year" id="leave_year" class="form-control input-sm" placeholder="Year" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group no-margin">                            
                        <label class="col-sm-2 control-label">Is Fractional</label>
                        <div class="col-sm-4">                            
                            <select name="fractional_leave" id="fractional_leave" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $yes_no_array = $this->Common_model->get_array('yes_no');
                                foreach ($yes_no_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                        <label class="col-sm-2 control-label">Is Day-off</label>
                        <div class="col-sm-4">
                            <select name="off_day_leave_count" id="off_day_leave_count" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $yes_no_array = $this->Common_model->get_array('yes_no');
                                foreach ($yes_no_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group">                            
                        <label class="col-sm-2 control-label">Max Limit <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="max_limit" id="max_limit" class="form-control input-sm" placeholder="Max Limit (hour)" autocomplete="off" />
                        </div>
                        <label class="col-sm-2 control-label"> Status </label>
                        <div class="col-sm-4">                            
                            <select name="leave_status" id="leave_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                $status_array = $this->Common_model->get_array('status');
                                foreach ($status_array as $key => $val) {
                                    ?>
                                <option value="<?php echo $key ?>" <?php if($key==1) echo "selected" ?> ><?php echo $val ?></option>
                                <?php
                                }
                                ?>
                            </select>  
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
         $('#dataTables-example-leavepolicy').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_leavepolicy()
    {
        save_method = 'add';
        $('#leavepolicy_form')[0].reset(); // reset form on modals
        $('#leavepolicy_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Leave Policy'); // Set Title to Bootstrap modal title
        
        $("#leave_type").select2({
            placeholder: "Leave Type",
            allowClear: true,
        });
        $("#employee_type").select2({
            placeholder: "Employee Type",
            allowClear: true,
        });
        $("#applicable").select2({
            placeholder: "Applicable",
            allowClear: true,
        });
        $("#off_day_leave_count").select2({
            placeholder: "Off-day Leave Count",
            allowClear: true,
        });
        $("#fractional_leave").select2({
            placeholder: "Fractional Leave",
            allowClear: true,
        });

        $("#leave_status").select2({
            placeholder: "Select Status",
            allowClear: true,
        });
    
    }
    
    $("#leave_type").select2({
        placeholder: "Leave Type",
        allowClear: true,
    });
    $("#employee_type").select2({
        placeholder: "Employee Type",
        allowClear: true,
    });
    $("#applicable").select2({
        placeholder: "Applicable",
        allowClear: true,
    });
    $("#off_day_leave_count").select2({
        placeholder: "Off-day Leave Count",
        allowClear: true,
    });
    $("#fractional_leave").select2({
        placeholder: "Fractional Leave",
        allowClear: true,
    });
    
    $("#leave_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });

</script>