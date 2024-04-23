
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12" id="pto_div">
        <!--<div style="overflow-x:scroll;">-->
        <table id="dataTables-example-emppto" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
           <colgroup>
                <col width="1%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Leave Code</th>
                    <th>Allocated Hour Limit</th>
                    <th>Earned Hour</th>
                    <th>Maximum Available Hour</th>
                    <th>Used Hour</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="leave_req_rep">
                <?php 
                //echo $this->Common_model->employee_pto_info($employee_id); 
                ?>
                <?php
                
                $this->db->select('leave_type,SUM(earned_houre) AS earned', FALSE);
                $this->db->where('employee_id', $employee_id);
                //$this->db->where('date_payment <=', $max_date);
                $this->db->group_by("leave_type");
                $qwer = $this->db->get('main_emp_accrual_leave');
                $Row_Data_arr=array();
                foreach ($qwer->result() as $row) {
                    $Row_Data_arr[$row->leave_type]=$row->earned;
                }
                
                //echo $this->db->last_query();

                $query = $this->db->get_where('main_emp_accrual_leave', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type,'main_leave_types', 'leave_code') . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $row->available_limit . "</td>";
                        print"<td id='catC" . $pdt . "'>" . $Row_Data_arr[$row->leave_type] . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $row->available_hour . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->used_hour . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->balance . "</td>";
                        print"<td><div class='action-buttons '><a href='#' onclick='edit_accrual_leave(" . $row->id . ")' title='Edit' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_accrual_leave(" . $row->id . ")' title='Delete'><i class='fa fa-trash-o'></i></a></div> </td>";
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

<div class="modal fade" id="Accrual_Leave_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Accrual Leave</h4>
            </div>
            <form id="emp_Accrual_Leave" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id" id="id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Leave Type</label>
                        <div class="col-sm-4">
                            <select name="pto_leave_type" id="pto_leave_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                //$leave_type_query=$this->db->get_where('main_employeeleavetypes', array('isactive' => 1,'leavetype' => 0));
                                if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {//Self user //Hr Manager //Company User //Admin //HR
                                    $leave_type_query = $this->db->get_where('main_pto_settings', array('company_id' => $this->company_id, 'isactive' => 1));
                                } else {
                                    $leave_type_query = $this->db->get_where('main_pto_settings', array('isactive' => 1));
                                }
                                
                                foreach ($leave_type_query->result() as $key) {
                                    $leave_code=$this->Common_model->get_name($this, $key->paid_leave_type, 'main_leave_types', 'leave_code');
                                    ?>
                                    <option value="<?php echo $key->paid_leave_type ?>"><?php echo $leave_code ?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Allocated Hour Limit</label>
                        <div class="col-sm-4">
                            <input type="text" name="available_limit" id="available_limit" class="form-control input-sm" placeholder="Accrual Amount" data-toggle="tooltip" data-placement="bottom" title="Allocated Hour Limit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Earned Hour</label>
                        <div class="col-sm-4">
                            <input type="text" name="earned_houre" id="earned_houre" class="form-control input-sm" placeholder="Earned Hour" data-toggle="tooltip" data-placement="bottom" title="Earned Hour">
                        </div>
                        <label class="col-sm-2 control-label">Maximum Available Hour</label>
                        <div class="col-sm-4">
                            <input type="text" name="available_hour" id="available_hour" class="form-control input-sm" placeholder="Maximum Available Hour" data-toggle="tooltip" data-placement="bottom" title="Maximum Available Hour">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Used Hour</label>
                        <div class="col-sm-4">
                            <input type="text" name="used_hour" id="used_hour" class="form-control input-sm" readonly placeholder="Used Hour" data-toggle="tooltip" data-placement="bottom" title="Used Hour" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">Balance</label>
                        <div class="col-sm-4">
                            <input type="text" name="balance" id="balance" class="form-control input-sm" readonly placeholder="Balance" data-toggle="tooltip" data-placement="bottom" title="Balance">
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


<?php /* ?>
  <div class="modal fade" id="pto_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <h4 class="modal-title" id="myModalLabel">Add Education</h4>
  </div>
  <form id="emp_pto" name="sky-form11" class="form-horizontal" action="<?php echo base_url(); ?>Con_PtoPolicy/save_pto_policy" method="post" enctype="multipart/form-data" role="form">
  <input type="hidden" value="" name="id_emp_pto"/>
  <div class="modal-body">
  <div class="form-group">
  <label class="col-sm-4">
  <input name="track_time_off" id="track_time_off" type="checkbox" value="1" > Track Time Off for this Employee
  </label>
  </div>
  <div class="form-group" class="col-sm-12">
  <label class="col-sm-2">Rollover On</label>
  <div  class="col-sm-2">
  <label><input type="radio" id="rollover_on" name="rollover_on" value="1" checked> Calender Year</label>
  </div>
  <div class="col-sm-3">
  <label><input type="radio" id="rollover_on" name="rollover_on" value="2"> Hire date Anniversary </label>
  </div>
  <div class="col-sm-5">
  <label><input type="radio" id="rollover_on" name="rollover_on" value="3"> Fiscal Year(Enter Fiscal Year date in ER>PTO Policy)</label>
  </div>
  </div>
  <div class="form-group">
  <label class="col-sm-2 control-label">Leave Type</label>
  <div class="col-sm-4">
  <select name="pto_leave_type" id="pto_leave_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
  <option></option>
  <?php
  foreach ($leave_type_query->result() as $key) {
  ?>
  <option value="<?php echo $key->id; ?>" > <?php echo $key->leave_code; ?> </option>
  <?php }
  ?>
  </select>
  </div>
  <label class="col-sm-2 control-label">Accrual Amount in Hours</label>
  <div class="col-sm-4">
  <input type="text" name="accrual_amt" id="accrual_amt" class="form-control input-sm" placeholder="Accrual Amount" data-toggle="tooltip" data-placement="bottom" title="Accrual Amount">
  </div>
  </div>
  <div class="form-group">
  <label class="col-sm-2 control-label">Accrual period</label>
  <div class="col-sm-4">
  <select name="accrual_period" id="accrual_period" class="col-sm-12 col-xs-12 myselect2 input-sm">
  <option></option>
  <?php
  foreach ($accrual_period_array as $kayy => $roww) {
  ?>
  <option value="<?php echo $kayy; ?>" > <?php echo $roww; ?> </option>
  <?php }
  ?>
  </select>
  </div>
  <label class="col-sm-2 control-label">Start Days After Hire</label>
  <div class="col-sm-4">
  <input type="text" name="start_days_after_hire" id="start_days_after_hire" class="form-control input-sm" placeholder="Start Date After Hire" data-toggle="tooltip" data-placement="bottom" title="Start Date After Hire">
  </div>
  </div>
  <div class="form-group">
  <label class="col-sm-2 control-label">Max Accrual</label>
  <div class="col-sm-4">
  <input type="text" name="max_accrual" id="max_accrual" class="form-control input-sm" placeholder="Max Accrual" data-toggle="tooltip" data-placement="bottom" title="Max Accrual" autocomplete="off">
  </div>
  <label class="col-sm-2 control-label">Max Available</label>
  <div class="col-sm-4">
  <input type="text" name="max_available" id="max_available" class="form-control input-sm" placeholder="Max Available" data-toggle="tooltip" data-placement="bottom" title="Max Available">
  </div>
  </div>
  <div class="form-group">
  <label class="col-sm-2 control-label">Max Carryover</label>
  <div class="col-sm-4">
  <input type="text" name="max_carryover" id="max_carryover" class="form-control input-sm" placeholder="Max Carryover" data-toggle="tooltip" data-placement="bottom" title="Max Carryover" autocomplete="off">
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
  <?php */ ?>

<script type="text/javascript">

    $(document).ready(function () {
        $('#dataTables-example-emppto').dataTable({
            "order": [0, "asc"],
            "pageLength": 5,
            "paginationType": "input"
            //"scrollX": true,
        });
    });

    var save_method; //for save method string

    $("#pto_leave_type").select2({
        placeholder: "Select level Type",
        allowClear: true,
    });

    $("#accrual_period").select2({
        placeholder: "Select Accrual period",
        allowClear: true,
    });

</script>