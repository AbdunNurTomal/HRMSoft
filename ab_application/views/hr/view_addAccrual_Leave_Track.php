<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <?php
            
            
            if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                $employee_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id,'isactive' => 1));
                $wages_query = $this->db->get_where('main_payfrequency', array('company_id' => $this->company_id,'isactive' => 1));
                $leave_type_query = $this->db->get_where('main_pto_settings', array('company_id' => $this->company_id,'isactive' => 1));
            } else {
                $employee_query = $this->db->get_where('main_employees', array('isactive' => 1));
                $wages_query = $this->db->get_where('main_payfrequency', array('isactive' => 1));
                $leave_type_query = $this->db->get_where('main_pto_settings', array('isactive' => 1));
            }
        
            if ($type == 1) {//entry
                ?>
                <?php if ($leave_track_by == 1 || $leave_track_by == 2) { //1=Payroll,2=Time & Attendance ?>
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Accrual_Leave_Track/save_Accrual_Leave_Track_Payroll" enctype="multipart/form-data" role="form" >
                        
                        <div class="col-md-12" style="margin-top: 10px"> 
                            <div class="form-group col-md-6 find_mar">
                                <label class="col-sm-4 control-label pull-left">Pay Period From : <span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="pay_period_from" id="pay_period_from" class="form-control dt_pick input-sm" placeholder="Pay Period From " autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group col-md-6 find_mar">
                                <label class="col-sm-4 control-label pull-left">Pay Period TO :<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="pay_period_to" id="pay_period_to" class="form-control dt_pick input-sm" placeholder="Pay Period TO " autocomplete="off" />
                                </div>
                            </div> 
                        </div>
                        
                        <input type="hidden" name="leave_track_by" id="leave_track_by" value="<?php echo $leave_track_by; ?>">
                        <table id="accrual_payroll_table" class="table table-striped table-bordered dt-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="mycol">Employee </th>
                                    <th class="mycol">Pay Schedule </th>
                                    <th class="mycol">Allocated Hour Limit </th>
                                    <th class="mycol">Working Hours </th>
                                    <th class="mycol">Hourly Allowance </th>
                                    <th class="mycol">Available Hour </th>
                                    <th class="mycol" style="width: 11%; "> Action</th>
                                </tr>
                            </thead>
                            <tbody id="accrual_payroll_tbody">
                                <tr id="tr_1">
                                    <td>
                                        <select name="employee_id[]" id="employee_id_1" onchange="set_pay_schedule(1);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php foreach ($employee_query->result() as $key): ?>
                                                <option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="pay_schedule[]" id="pay_schedule_1" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            foreach ($wages_query->result() as $key):
                                                $freqtype = $this->Common_model->get_name($this, $key->freqtype, 'main_payfrequency_type', 'freqcode');
                                                ?>
                                                <option value="<?php echo $key->freqtype ?>"><?php echo $freqtype ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="hour_limit[]" id="hour_limit_1" autocomplete="off" />
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="working_hours[]" id="working_hours_1" autocomplete="off" />
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="hourly_allowance[]" id="hourly_allowance_1" autocomplete="off" />
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="available_hour[]" id="available_hour_1" autocomplete="off" />
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_accrual_row_payroll(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                        <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row_payroll(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="modal-footer">                        
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-u" href="#" onclick="save_process();">Save and Process</a>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Accrual_Leave_Track" ?>">Close</a>
                            </div>
                        </div>
                    </form>
                    <?php
                } else {//0=HRM
                    ?>
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Accrual_Leave_Track/save_Accrual_Leave_Track" enctype="multipart/form-data" role="form" >
                        
                        <div class="col-md-10" style="margin-top: 10px"> 
                            <div class="col-md-12 pull-right">
                                <label class="col-sm-12 pull-right"><u><h4>Pay Period </h4></u></label>
                            </div>
                            
                            <div class="form-group col-md-6 find_mar">
                                <label class="col-sm-3 control-label pull-left">From : <span class="req"/></label>
                                <div class="col-sm-9">
                                    <input type="text" name="pay_period_from" id="pay_period_from" class="form-control dt_pick input-sm" placeholder="From " autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group col-md-6 find_mar">
                                <label class="col-sm-2 control-label pull-left"> To :<span class="req"/></label>
                                <div class="col-sm-10">
                                    <input type="text" name="pay_period_to" id="pay_period_to" class="form-control dt_pick input-sm" placeholder="To " autocomplete="off" />
                                </div>
                            </div> 
                        </div>
                        
                        <input type="hidden" name="leave_track_by" id="leave_track_by" value="<?php echo $leave_track_by; ?>">
                        <table id="accrual_table" class="table table-striped table-bordered dt-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="mycol">Employee </th>
                                    <th class="mycol">Pay Schedule </th>
                                    <th class="mycol">Leave Type </th>
                                    <th class="mycol">Working Hours </th>
                                    <th class="mycol" style="width: 11%; "> Action</th>
                                </tr>
                            </thead>
                            <tbody id="accrual_tbody">
                                <tr id="tr_1">
                                    <td>
                                        <select name="employee_id[]" id="employee_id_1" onchange="set_pay_schedule(1);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php foreach ($employee_query->result() as $key): ?>
                                                <option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="pay_schedule[]" id="pay_schedule_1" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            foreach ($wages_query->result() as $key):
                                                $freqtype = $this->Common_model->get_name($this, $key->freqtype, 'main_payfrequency_type', 'freqcode');
                                                ?>
                                                <option value="<?php echo $key->freqtype ?>"><?php echo $freqtype ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="leave_type[]" id="leave_type_1" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            foreach ($leave_type_query->result() as $key):
                                                $leave_code = $this->Common_model->get_name($this, $key->paid_leave_type, 'main_leave_types', 'leave_code');
                                                ?>
                                                <option value="<?php echo $key->paid_leave_type ?>"><?php echo $leave_code ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="working_hours[]" id="working_hours_1" onkeypress="return numbersonly(this, event)" autocomplete="off" placeholder="Working Hours " />
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_accrual_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                        <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="modal-footer">                        
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-u" href="#" onclick="save_process();">Save & Process</a>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Accrual_Leave_Track" ?>">Close</a>
                            </div>
                        </div>
                    </form>
                <?php } ?>


                <?php
            } else if ($type == 2) {//edit
                //print_r($query);
                ?>
                <?php if ($leave_track_by == 1 || $leave_track_by == 2) { //1=Payroll,2=Time & Attendance ?>
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Accrual_Leave_Track/edit_Accrual_Leave_Track_Payroll" enctype="multipart/form-data" role="form" >
                        <input type="hidden" name="update_id" id="update_id" value="<?php echo $query->id; ?>">
                        <input type="hidden" name="leave_track_by" id="leave_track_by" value="<?php echo $leave_track_by; ?>">
                        
                         <div class="col-md-12" style="margin-top: 10px"> 
                            <div class="form-group col-md-6 find_mar">
                                <label class="col-sm-4 control-label pull-left">Pay Period From : <span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="pay_period_from" id="pay_period_from" value="<?php echo $this->Common_model->show_date_formate($query->pay_period_from); ?>" class="form-control dt_pick input-sm" placeholder="Pay Period From " autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group col-md-6 find_mar">
                                <label class="col-sm-4 control-label pull-left">Pay Period TO : <span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="pay_period_to" id="pay_period_to" value="<?php echo $this->Common_model->show_date_formate($query->pay_period_to); ?>" class="form-control dt_pick input-sm" placeholder="Pay Period TO " autocomplete="off" />
                                </div>
                            </div> 
                        </div>
                        
                        <table id="accrual_table" class="table table-striped table-bordered dt-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="mycol">Employee </th>
                                    <th class="mycol">Pay Schedule </th>
                                    <th class="mycol">Allocated Hour Limit </th>
                                    <th class="mycol">Working Hours </th>
                                    <th class="mycol">Hourly Allowance </th>
                                    <th class="mycol">Available Hour </th>
                                    <!--<th class="mycol" style="width: 11%; "> Action</th>-->
                                </tr>
                            </thead>
                            <tbody id="accrual_tbody">
                                <tr id="tr_1">
                                    <td>
                                        <select name="employee_id[]" id="employee_id_1" onchange="set_pay_schedule(1);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php foreach ($employee_query->result() as $key): ?>
                                                <option value="<?php echo $key->employee_id ?>" <?php if($query->employee_id==$key->employee_id) echo "selected"; ?>><?php echo $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="pay_schedule[]" id="pay_schedule_1" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            foreach ($wages_query->result() as $key):
                                                $freqtype = $this->Common_model->get_name($this, $key->freqtype, 'main_payfrequency_type', 'freqcode');
                                                ?>
                                                <option value="<?php echo $key->freqtype ?>" <?php if($query->pay_schedule==$key->freqtype) echo "selected"; ?>><?php echo $freqtype ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="hour_limit[]" id="hour_limit_1" value="<?php echo $query->hour_limit; ?>" autocomplete="off" />
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="working_hours[]" id="working_hours_1" value="<?php echo $query->working_hours; ?>" autocomplete="off" />
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="hourly_allowance[]" id="hourly_allowance_1" value="<?php echo $query->hourly_allowance; ?>" autocomplete="off" />
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="available_hour[]" id="available_hour_1" value="<?php echo $query->available_hour; ?>" autocomplete="off" />
                                    </td>
<!--                                    <td>
                                        <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_accrual_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                        <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
                                    </td>-->
                                </tr>
                            </tbody>
                        </table>
                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-u" href="#" onclick="edit_process();">Save and Process</a>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Accrual_Leave_Track" ?>">Close</a>
                        </div>
                    </form>
                    <?php
                } else {//0=HRM
                    ?>
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Accrual_Leave_Track/edit_Accrual_Leave_Track" enctype="multipart/form-data" role="form" >
                        <input type="hidden" name="update_id" id="update_id" value="<?php echo $query->id; ?>">
                        <input type="hidden" name="leave_track_by" id="leave_track_by" value="<?php echo $leave_track_by; ?>">
                        
                        
                        <div class="col-md-12" style="margin-top: 10px"> 
                            <div class="col-md-12 pull-right">
                                <label class="col-sm-12 pull-right"><u><h4>Pay Period </h4></u></label>
                            </div>
                            
                            <div class="form-group col-md-6 find_mar">
                                <label class="col-sm-3 control-label pull-left">From : <span class="req"/></label>
                                <div class="col-sm-9">
                                    <input type="text" name="pay_period_from" id="pay_period_from" value="<?php echo $this->Common_model->show_date_formate($query->pay_period_from); ?>" class="form-control dt_pick input-sm" placeholder="From " autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group col-md-6 find_mar">
                                <label class="col-sm-2 control-label pull-left"> To :<span class="req"/></label>
                                <div class="col-sm-9">
                                    <input type="text" name="pay_period_to" id="pay_period_to" value="<?php echo $this->Common_model->show_date_formate($query->pay_period_to); ?>" class="form-control dt_pick input-sm" placeholder="To " autocomplete="off" />
                                </div>
                            </div> 
                        </div>
                        
                        <table id="accrual_table" class="table table-striped table-bordered dt-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="mycol">Employee </th>
                                    <th class="mycol">Pay Schedule </th>
                                    <th class="mycol">Leave Type </th>
                                    <th class="mycol">Working Hours </th>
                                    <!--<th class="mycol" style="width: 11%; "> Action</th>-->
                                </tr>
                            </thead>
                            <tbody id="accrual_tbody">
                                <tr id="tr_1">
                                    <td>
                                        <select name="employee_id[]" id="employee_id_1" onchange="set_pay_schedule(1);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php foreach ($employee_query->result() as $key): ?>
                                                <option value="<?php echo $key->employee_id ?>" <?php if($query->employee_id==$key->employee_id) echo "selected"; ?>><?php echo $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="pay_schedule[]" id="pay_schedule_1" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            foreach ($wages_query->result() as $key):
                                                $freqtype = $this->Common_model->get_name($this, $key->freqtype, 'main_payfrequency_type', 'freqcode');
                                                ?>
                                                <option value="<?php echo $key->freqtype ?>" <?php if($query->pay_schedule==$key->freqtype) echo "selected"; ?>><?php echo $freqtype ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="leave_type[]" id="leave_type_1" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            foreach ($leave_type_query->result() as $key):
                                                //$leave_code = $this->Common_model->get_name($this, $key->paid_leave_type, 'main_employeeleavetypes', 'leave_code');
                                                $leave_code = $this->Common_model->get_name($this, $key->paid_leave_type, 'main_leave_types', 'leave_code');
                                                ?>
                                                <option value="<?php echo $key->paid_leave_type ?>" <?php if($query->leave_type==$key->paid_leave_type) echo "selected"; ?>><?php echo $leave_code ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control input-sm" type="text" name="working_hours[]" id="working_hours_1" value="<?php echo $query->working_hours; ?>" onkeypress="return numbersonly(this, event)" autocomplete="off" />
                                    </td>
<!--                                    <td>
                                        <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_accrual_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                        <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
                                    </td>-->
                                </tr>
                            </tbody>
                        </table>
                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-u" href="#" onclick="edit_process();">Save & Process</a>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Accrual_Leave_Track" ?>">Close</a>
                        </div>
                    </form>
                <?php } ?>
                <?php
            }
            ?>
        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
                }).done(function (data) {
                    
                    //alert (data);
                    
                    var url = '<?php echo base_url() ?>Con_Accrual_Leave_Track';
                    view_message(data, url,'','');
                    
                });
                event.preventDefault();
        });
    });
    
    function save_process()
    {
        var url = "<?php echo site_url('Con_Accrual_Leave_Track/save_process_Accrual_Leave_Track') ?>";
        $.ajax({
            url: url,
            data: $("#sky-form11").serialize(),
            type: $("#sky-form11").attr('method')
        }).done(function (data) {

            var url = '<?php echo base_url() ?>Con_Accrual_Leave_Track';
            view_message(data, url,'','');

        });
    }
    
    function edit_process()
    {
        var url = "<?php echo site_url('Con_Accrual_Leave_Track/edit_process_Accrual_Leave_Track') ?>";
        $.ajax({
            url: url,
            data: $("#sky-form11").serialize(),
            type: $("#sky-form11").attr('method')
        }).done(function (data) {

            var url = '<?php echo base_url() ?>Con_Accrual_Leave_Track';
            view_message(data, url,'','');

        });
    }
            
    $("#employee_id_1").select2({
        placeholder: "Select Employee",
        allowClear: true,
    });

    $("#pay_schedule_1").select2({
        placeholder: "Select Pay Schedule",
        allowClear: true,
    });
    $("#leave_type_1").select2({
        placeholder: "Select Leave Type",
        allowClear: true,
    });
            
    function add_accrual_row(i)
    {
        //alert (i);
        var rowCount = $('#accrual_tbody tr').length;
        if ($('#employee_id_' + rowCount).val() == "")
        {
            alert('Employee Feald Can not be empty.');
            $('#employee_id_' + rowCount).focus();
            return;
        } else
        {
            rowCount++;
            $('#accrual_table').append(
            '<tr id="tr_' + rowCount + '">'
            + '<td>'
            + '<select name="employee_id[]" id="employee_id_' + rowCount + '" onchange="set_pay_schedule(' + rowCount + ')" class="col-sm-12 col-xs-12 myselect2 input-sm">'
            + '<option></option>'
            <?php foreach ($employee_query->result() as $key): ?>
                            + '<option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name ?></option>'
            <?php endforeach; ?>
            + '</select>'
            + '</td>'
            + '<td>'
            + '<select name="pay_schedule[]" id="pay_schedule_' + rowCount + '" class="col-sm-12 col-xs-12 myselect2 input-sm">'
            + '<option></option>'
            <?php
            foreach ($wages_query->result() as $key):
                $freqtype = $this->Common_model->get_name($this, $key->freqtype, 'main_payfrequency_type', 'freqcode');
                ?>
                            + '<option value="<?php echo $key->freqtype ?>"><?php echo $freqtype ?></option>'
            <?php endforeach; ?>
            + '</select>'
            + '</td>'
            + '<td>'
            + '<select name="leave_type[]" id="leave_type_' + rowCount + '" class="col-sm-12 col-xs-12 myselect2 input-sm">'
            + '<option></option>'
            <?php
            foreach ($leave_type_query->result() as $key):
                //$leave_code = $this->Common_model->get_name($this, $key->paid_leave_type, 'main_employeeleavetypes', 'leave_code');
                $leave_code = $this->Common_model->get_name($this, $key->paid_leave_type, 'main_leave_types', 'leave_code');
                ?>
                    + '<option value="<?php echo $key->paid_leave_type ?>"><?php echo $leave_code ?></option>'
            <?php endforeach; ?>
            + '</select>'
            + '</td>'
            + '<td><input class="form-control input-sm" type="text" name="working_hours[]" id="working_hours_' + rowCount + '" onkeypress="return numbersonly(this, event)" autocomplete="off"/> </td>'
            + '<td>\n\
                    <a class="btn btn-sm btn-u" id="add_' + rowCount + '" title="Add" onclick="add_accrual_row(' + rowCount + ');"><i class="glyphicon glyphicon-plus" ></i></a>\n\
                    <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row(' + rowCount + ');"><i class="glyphicon glyphicon-minus" ></i> </a>\n\
                </td>'
            + '</tr>'
            );

            $("#employee_id_" + rowCount).select2({
                placeholder: "Select Employee",
                allowClear: true,
            });

            $("#pay_schedule_" + rowCount).select2({
                placeholder: "Select Pay Schedule",
                allowClear: true,
            });
            $("#leave_type_" + rowCount).select2({
                placeholder: "Select Leave Type",
                allowClear: true,
            });

        }

    }
    
    function  remove_row(i)
    {
        var rowCount = $('#accrual_tbody tr').length;
        if (rowCount != 1)
        {
            $("#accrual_tbody tr:last").remove();
            //$('#tr_' + i).remove();
        }
    }
    
    function add_accrual_row_payroll(i)
    {
        //alert (i);
        var rowCount = $('#accrual_payroll_tbody tr').length;
        if ($('#employee_id_' + rowCount).val() == "")
        {
            alert('Employee Feald Can not be empty.');
            $('#employee_id_' + rowCount).focus();
            return;
        } else
        {
            rowCount++;
            $('#accrual_payroll_table').append(
            '<tr id="tr_' + rowCount + '">'
            + '<td>'
            + '<select name="employee_id[]" id="employee_id_' + rowCount + '" onchange="set_pay_schedule(' + rowCount + ')" class="col-sm-12 col-xs-12 myselect2 input-sm">'
            + '<option></option>'
            <?php foreach ($employee_query->result() as $key): ?>
                            + '<option value="<?php echo $key->employee_id ?>"><?php echo $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name ?></option>'
            <?php endforeach; ?>
            + '</select>'
            + '</td>'
            + '<td>'
            + '<select name="pay_schedule[]" id="pay_schedule_' + rowCount + '" class="col-sm-12 col-xs-12 myselect2 input-sm">'
            + '<option></option>'
            <?php
            foreach ($wages_query->result() as $key):
                $freqtype = $this->Common_model->get_name($this, $key->freqtype, 'main_payfrequency_type', 'freqcode');
                ?>
                            + '<option value="<?php echo $key->freqtype ?>"><?php echo $freqtype ?></option>'
            <?php endforeach; ?>
            + '</select>'
            + '</td>'
            + '<td><input class="form-control input-sm" type="text" name="hour_limit[]" id="hour_limit_' + rowCount + '"  autocomplete="off"/> </td>'
            + '<td><input class="form-control input-sm" type="text" name="working_hours[]" id="working_hours_' + rowCount + '"  autocomplete="off"/> </td>'
            + '<td><input class="form-control input-sm" type="text" name="hourly_allowance[]" id="hourly_allowance_' + rowCount + '"  autocomplete="off"/> </td>'
            + '<td><input class="form-control input-sm" type="text" name="available_hour[]" id="available_hour_' + rowCount + '"  autocomplete="off"/> </td>'
            + '<td>\n\
                    <a class="btn btn-sm btn-u" id="add_' + rowCount + '" title="Add" onclick="add_accrual_row_payroll(' + rowCount + ');"><i class="glyphicon glyphicon-plus" ></i></a>\n\
                    <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row_payroll(' + rowCount + ');"><i class="glyphicon glyphicon-minus" ></i> </a>\n\
                </td>'
            + '</tr>'
            );

            $("#employee_id_" + rowCount).select2({
                placeholder: "Select Employee",
                allowClear: true,
            });

            $("#pay_schedule_" + rowCount).select2({
                placeholder: "Select Pay Schedule",
                allowClear: true,
            });

        }

    }

    function  remove_row_payroll(i)
    {
        var rowCount = $('#accrual_payroll_tbody tr').length;
        if (rowCount != 1)
        {
            $("#accrual_payroll_tbody tr:last").remove();
            //$('#tr_' + i).remove();
        }
    }
    
    function set_pay_schedule(id)
    {
        var employee_id=$('#employee_id_' + id).val();
 
        $.ajax({
        url: "<?php  echo site_url('Con_Accrual_Leave_Track/get_pay_schedule/') ?>/" + employee_id,
        async: false,
        type: "POST",
        success: function (data) {
              //alert (data);
             
              $('#pay_schedule_' + id).select2().select2('val', data);
              
            }
        });

    }

</script>
<!--=== End Script ===-->

