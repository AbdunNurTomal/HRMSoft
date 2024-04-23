
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12" id="pto_div">
        <!--<button class="btn btn-u btn-md" onClick="add_emp_pto()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>-->
        <div style="overflow-x:scroll;">
            <table id="dataTables-example-emppto" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                <thead>
                    <tr>
                        <th>SL </th>
                        <th>Leave Code</th>
                        <th>Accrual Amt(hours)</th>
                        <th>Accrual period </th>
                        <th>Start Date</th>
                        <th>Max Accrual</th>
                        <th>Max Available</th>
                        <th>Max Carryover</th>
                        <th>Carryover Hrs</th>
                        <th>Accrual Hrs</th>
                        <th>Used Hrs</th>
                        <th>Used Hrs Adjust</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $accrual_period_array = $this->Common_model->get_array('accrual_period');
                    $hire_date = $this->Common_model->get_selected_value($this, 'employee_id', $employee_id, 'main_employees', 'hire_date');

                    if ($this->user_group == 12 || $this->user_group == 11) {
                        $query = $this->db->get_where('main_emp_pto', array('company_id' => $this->company_id, 'isactive' => 1));
                        $leave_type_query = $this->db->get_where('main_employeeleavetypes', array('leavetype' => 0, 'isactive' => 1, 'company_id' => $this->company_id));
                    } else {
                        $query = $this->db->get_where('main_emp_pto', array('isactive' => 1));
                        $leave_type_query = $this->db->get_where('main_employeeleavetypes', array('leavetype' => 0, 'isactive' => 1));
                    }

                    if ($query) {
                        $i = 0;
                        foreach ($query->result() as $row) {
                            $i++;
                            $pdt = $row->id;
                            print"<tr>";
                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                            print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type, 'main_employeeleavetypes', 'leave_code') . "</td>";
                            print"<td id='catC" . $pdt . "'>" . $row->accrual_amt . "</td>";
                            print"<td id='catD" . $pdt . "'>" . $accrual_period_array[$row->accrual_period] . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->add_date($hire_date, $row->start_days_after_hire) . "</td>";
                            print"<td id='catB" . $pdt . "'>" . $row->max_accrual . "</td>";
                            print"<td id='catC" . $pdt . "'>" . $row->max_available . "</td>";
                            print"<td id='catD" . $pdt . "'>" . $row->max_carryover . "</td>";
                            print"<td id='catE" . $pdt . "'>" . "" . "</td>";
                            print"<td id='catB" . $pdt . "'>" . "" . "</td>";
                            print"<td id='catC" . $pdt . "'>" . "" . "</td>";
                            print"<td id='catD" . $pdt . "'>" . "" . "</td>";
                            print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_emp_pto(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_pto(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                            print"</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end data table -->
</div>
<!-- pto modal -->
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
            "order": [0, "desc"],
            "pageLength": 5,
            //"scrollX": true,
        });
    });


    var save_method; //for save method string
//    function add_emp_pto()
//    {
//        save_method = 'add';
//        $('#emp_pto')[0].reset(); // reset form on modals
//
//        $("#pto_leave_type").select2({
//            placeholder: "Select level Type",
//            allowClear: true,
//        });
//
//        $("#accrual_period").select2({
//            placeholder: "Select Accrual period",
//            allowClear: true,
//        });
//
//        $('#pto_Modal').modal('show'); // show bootstrap modal
//        $('.modal-title').text('Add Pto'); // Set Title to Bootstrap modal title
//    }

    $("#pto_leave_type").select2({
        placeholder: "Select level Type",
        allowClear: true,
    });

    $("#accrual_period").select2({
        placeholder: "Select Accrual period",
        allowClear: true,
    });

</script>