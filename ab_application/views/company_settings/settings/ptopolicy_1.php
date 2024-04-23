<?php
    $company_data = $this->session->userdata('company');
    $this->company_settings_id = $company_data['company_settings_id'];

    $query = $this->db->get_where('main_pto_settings', array('company_id' => $this->company_settings_id,'isactive' => 1));
    //echo $this->db->last_query();
    
    if($query->num_rows()>0)
    {
        $type = 2;
    }
    else
    {
        $type = 1;
    }

if($type==1)
{
    //echo $type;
?>
    <form id="com_pto_main_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_configaration/save_pto_policy" enctype="multipart/form-data" role="form">

        <input type="hidden" value="" name="com_pto_settings_id" id="com_pto_settings_id"/>
        <div class="modal-body" id="leave-modal-body">
            
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Identification</h4></u></label>
                </div>

                <div class="col-md-3 col-sm-6 find_mar">
                    <label class="col-sm-12 col-xs-4 control-label pull-left">Description:</label>
                </div>
                <div class="col-md-6 col-sm-6 find_mar">
                    <input type="text" name="paid_description" id="paid_description" class="form-control input-sm" placeholder="Description" />
                </div>
                <div class="col-md-3 col-sm-6 find_mar">
                    <label class="col-sm-12 col-xs-4 control-label pull-left">Report description:</label>
                </div>
                <div class="col-md-6 col-sm-6 find_mar">
                    <input type="text" name="report_description" id="report_description" class="form-control input-sm" placeholder="Report description" />
                </div>
            </div>
            <div class="row">

                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Accrual information </h4></u></label>
                </div>

                <div class="col-md-6 col-sm-6 find_mar">
                    <label class="col-sm-4 col-xs-4 control-label pull-left">Method:</label>
                    <select name="method" id="method" class="col-sm-8 col-xs-8 myselect2 input-sm" >
                        <option></option>
                        <?php
                        $method = $this->Common_model->get_array('method');
                        foreach ($method as $row => $val) {
                            print"<option value='" . $row . "'>" . $val . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6 col-sm-6 pull-left ">
                    <div class="col-md-12">
                        <label><input type="checkbox" name="ot_hour" id="ot_hour" value="1">Include OT Hour</label>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 find_mar">
                    <label class="col-md-6 control-label">Hourly Allowance:</label>
                    <div class="col-md-6" id="radiobutt">
                        <div class="radio col-md-6">
                            <label> <input type="radio" id="hourly_allowance_option" class="abc" name="hourly_allowance_option" value="1" checked> Fixed</label>
                        </div>
                        <div class="col-sm-6">
                            <label><input type="text" name="fixed_amount" id="fixed_amount" class="form-control input-sm" value=""></label>
                        </div>
                        <div class="radio col-md-6">
                            <label> <input type="radio"  id="hourly_allowance_option" name="hourly_allowance_option" value="2" >Graduated</label>
                        </div>
                        <div class="col-md-3">
                            <label><a onclick="add_pto_table()" href="#">
                                    <input id="leave_table" class="btn btn-u" type="button" value="Table">
                                </a></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 find_mar">
                    <div class="col-md-12">
                        <label><input type="checkbox" name="dt_hour" id="dt_hour" value="1">Include DT Hour</label>
                    </div>
                    <div class="col-md-12">
                        <label><input type="checkbox" name="accruable_benefit_hour" id="accruable_benefit_hour" value="1" >Include Accruable Benefit Hour</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Eligibility </h4></u></label>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label class="col-sm-12 col-xs-12 control-label pull-left">Delay Benefit Accrual Until:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="benefit_accrual_until" id="benefit_accrual_until" class="form-control input-sm" value="" />
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="hire_date_leave" id="hire_date_leave" class="form-control dt_pick" placeholder="Date" autocomplete="off" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-12 control-label pull-left">After Employee's Hire Date </label>
                    </div>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label class="col-sm-12 col-xs-12 control-label pull-left">Delay Accrual Hours Availability Until:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="accrual_hours_availability_until" id="accrual_hours_availability_until" class="form-control input-sm" value="" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="hire_date" id="hire_date" class="form-control dt_pick" placeholder="Date" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-12 control-label pull-left">After Employee's Hire Date  </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Limits </h4></u></label>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Available Limit:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="available_limit" id="available_limit" class="form-control input-sm" value="" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left"> Per Check Limit: </label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="per_check_limit" id="per_check_limit" class="form-control " placeholder="" />
                    </div>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Annual Limit:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="annual_limit" id="annual_limit" class="form-control input-sm" value="" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left">Per Month Limit:  </label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="per_month_limit" id="per_month_limit" class="form-control" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Balance Reset </h4></u></label>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Method:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="balanced_method" id="balanced_method" class="form-control input-sm" value="" />
                    </div>
                    <div class="col-md-6 col-sm-3 find_mar">
                        <label><input type="checkbox" name="reset_beginning_balance" value="1"> Reset Beginning Balance To Zero </label>
                    </div>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Date:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="balanced_date" id="balanced_date" class="form-control dt_pick" placeholder="Date" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left">Carryover Maximum:  </label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="carryover_maximum" id="carryover_maximum" class="form-control " placeholder="" />
                    </div>
                </div>
                <div class="col-md-12 col-sm-6 find_mar">
                    <label class="col-md-6 control-label">If Pay Period Spans Multiple Benefit Years: </label>
                    <div class="col-md-6">
                        <div class="radio col-md-12">
                            <label>
                                <input id="inlineradio1" name="pay_period_spans" value="1" type="radio">
                                Apply Benefit Hours Used To The Current Benefit Years</label>
                        </div>
                        <div class="radio col-md-12">
                            <label>
                                <input id="inlineradio1" name="pay_period_spans" value="2" type="radio">
                                Apply Benefit Hours Used To The Prior Benefit Years</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4> Exclusions</h4></u></label>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Workers Compensation:</label>
                    </div>
                    <div class="col-md-9 col-sm-3 find_mar">
                        <div class="col-md-9 col-sm-3 find_mar">
                            <select name="workers_compensation" id="workers_compensation" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $compensation = $this->Common_model->get_array('Workers_compensation');
                                foreach ($compensation as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="tb_type" id="tb_type" value="1">
            <div class="col-md-12" id="hd_div1">
                <input type="hidden" name="hidden_hourly_allowance_option" id="hidden_hourly_allowance_option"/>
                <input type="hidden" name="hidden_graduated_form" id="hidden_graduated_form"/>
                <input type="hidden" name="hidden_graduated_to" id="hidden_graduated_to"/>
                <input type="hidden" name="hidden_hourly_allowance" id="hidden_hourly_allowance"/>
                <input type="hidden" name="hidden_available_limit" id="hidden_available_limit"/>
                <input type="hidden" name="hidden_check_limit" id="hidden_check_limit"/>
                <input type="hidden" name="hidden_month_limit" id="hidden_month_limit"/>
                <input type="hidden" name="hidden_annual_limit" id="hidden_annual_limit"/>
                <input type="hidden" name="hidden_carryover_maximum" id="hidden_carryover_maximum"/>
            </div>

            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-u">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </form>
<?php
}
else
{
    //echo $type;
    ?>
    <form id="com_pto_main_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_configaration/save_pto_policy" enctype="multipart/form-data" role="form">
     <?php foreach ($query->result() as $row): ?>
        <input type="hidden" value="<?php echo $row->id ?>" name="com_pto_settings_id" id="com_pto_settings_id"/>
        <div class="modal-body" id="leave-modal-body">
            
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Identification</h4></u></label>
                </div>

                <div class="col-md-4 col-sm-4 find_mar">
                    <label class="col-sm-12 col-xs-4 control-label pull-left">Description:</label>
                </div>
                <div class="col-md-8 col-sm-8 find_mar">
                    <input type="text" name="paid_description" id="paid_description" value="<?php echo $row->paid_description ?>" class="form-control input-sm" placeholder="Description" />
                </div>
                <div class="col-md-4 col-sm-4 find_mar">
                    <label class="col-sm-12 col-xs-4 control-label pull-left">Report description:</label>
                </div>
                <div class="col-md-8 col-sm-8 find_mar">
                    <input type="text" name="report_description" id="report_description" value="<?php echo $row->report_description ?>" class="form-control input-sm" placeholder="Report description" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Accrual information </h4></u></label>
                </div>
                <div class="col-md-6 col-sm-6 find_mar">
                    <label class="col-sm-4 col-xs-4 control-label pull-left">Method:</label>
                    <select name="method" id="method" class="col-sm-8 col-xs-8 myselect2 input-sm" >
                        <option></option>
                        <?php 
                        $method = $this->Common_model->get_array('method');
                        foreach ($method as $roww => $val): ?>
                        <option value="<?php echo $roww; ?>" <?php if ($row->method == $roww) echo "selected"; ?> ><?php echo $val; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6 pull-left ">
                    <div class="col-md-12">
                        <label><input type="checkbox" name="ot_hour" id="ot_hour" value="<?php echo $row->ot_hour ?>" <?php if($row->ot_hour==1) { echo "checked"; } ?>> Include OT Hour</label> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 find_mar">
                    <label class="col-md-6 control-label">Hourly Allowance:</label>
                    <div class="col-md-6" id="radiobutt">
                        <div class="radio col-md-6">
                            <label> <input type="radio" id="hourly_allowance_option" class="abc" name="hourly_allowance_option" value="1" <?php if($row->hourly_allowance_option==1){ echo "checked"; } ?>> Fixed</label>
                        </div>
                        <div class="col-sm-6">
                            <label><input type="text" name="fixed_amount" id="fixed_amount" value="<?php if($row->hourly_allowance_option==1){ echo $row->fixed_amount; } ?>" class="form-control input-sm" ></label>
                        </div>
                        <div class="radio col-md-6">
                            <label> <input type="radio"  id="hourly_allowance_option" name="hourly_allowance_option" value="2" <?php if($row->hourly_allowance_option==2){ echo "checked"; } ?>> Graduated</label>
                        </div>
                        <div class="col-md-3">
                            <label><a onclick="add_pto_table()" href="#">
                                    <input id="leave_table" class="btn btn-u" type="button" value="Table">
                                </a></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 find_mar">
                    <div class="col-md-12">
                        <label><input type="checkbox" name="dt_hour" id="dt_hour" value="<?php echo $row->dt_hour ?>" <?php if($row->dt_hour==1) { echo "checked"; } ?>> Include DT Hour</label>
                    </div>
                    <div class="col-md-12">
                        <label><input type="checkbox" name="accruable_benefit_hour" id="accruable_benefit_hour" value="<?php echo $row->accruable_benefit_hour ?>" <?php if($row->accruable_benefit_hour==1) { echo "checked"; } ?>> Include Accruable Benefit Hour</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Eligibility </h4></u></label>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label class="col-sm-12 col-xs-12 control-label pull-left">Delay Benefit Accrual Until:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="benefit_accrual_until" id="benefit_accrual_until" value="<?php echo $row->benefit_accrual_until ?>" class="form-control input-sm"  />
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <input type="text" name="hire_date_leave" id="hire_date_leave" value="<?php echo $this->Common_model->show_date_formate( $row->hire_date_leave ); ?>" class="form-control dt_pick" placeholder="Date" autocomplete="off" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-12 control-label pull-left">After Employee's Hire Date </label>
                    </div>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label class="col-sm-12 col-xs-12 control-label pull-left">Delay Accrual Hours Availability Until:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="accrual_hours_availability_until" id="accrual_hours_availability_until" value="<?php echo $row->accrual_hours_availability_until ?>" class="form-control input-sm"/>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="hire_date" id="hire_date" value="<?php echo $this->Common_model->show_date_formate( $row->hire_date ); ?>" class="form-control dt_pick" placeholder="Date" autocomplete="off" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-12 control-label pull-left">After Employee's Hire Date  </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Limits </h4></u></label>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Available Limil:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="available_limit" id="available_limit" value="<?php echo $row->available_limit ?>" class="form-control input-sm"  />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left"> Per Check Limit: </label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="per_check_limit" id="per_check_limit" value="<?php echo $row->per_check_limit ?>" class="form-control " placeholder="" />
                    </div>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Annual Limit:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="annual_limit" id="annual_limit" value="<?php echo $row->annual_limit ?>" class="form-control input-sm" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left">Per Month Limit:  </label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="per_month_limit" id="per_month_limit" value="<?php echo $row->per_month_limit ?>" class="form-control" placeholder="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4>Balance Reset </h4></u></label>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Method:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="balanced_method" id="balanced_method" value="<?php echo $row->balanced_method ?>" class="form-control input-sm"/>
                    </div>
                    <div class="col-md-6 col-sm-3 find_mar">
                        <label><input type="checkbox" name="reset_beginning_balance" value="<?php echo $row->reset_beginning_balance ?>" <?php if($row->reset_beginning_balance==1) {echo "checked"; }?>> Reset Beginning Balance To Zero </label>
                    </div>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Date:</label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="balanced_date" id="balanced_date" value="<?php echo $this->Common_model->show_date_formate( $row->balanced_date ); ?>" class="form-control dt_pick" placeholder="Date" autocomplete="off" />
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left">Carryover Maximum:  </label>
                    </div>
                    <div class="col-md-3 col-sm-3 find_mar">
                        <input type="text" name="carryover_maximum" id="carryover_maximum" value="<?php echo $row->carryover_maximum; ?>" class="form-control " placeholder="" />
                    </div>
                </div>
                <div class="col-md-12 col-sm-6 find_mar">
                    <label class="col-md-6 control-label">If Pay Period Spans Multiple Benefit Years: </label>
                    <div class="col-md-6">
                        <div class="radio col-md-12">
                            <label>
                                <input id="inlineradio1" name="pay_period_spans" value="1" type="radio" <?php if($row->pay_period_spans==1){ echo "checked"; } ?>>
                                Apply Benefit Hours Used To The Current Benefit Years</label>
                        </div>
                        <div class="radio col-md-12">
                            <label>
                                <input id="inlineradio1" name="pay_period_spans" value="2" type="radio" <?php if($row->pay_period_spans==2){ echo "checked"; } ?>>
                                Apply Benefit Hours Used To The Prior Benefit Years</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <label class="col-sm-12 pull-right"><u><h4> Exclusions</h4></u></label>
                </div>
                <div class="col-md-12 pull-right">
                    <div class="col-md-3 col-sm-6 find_mar">
                        <label class="col-sm-12 col-xs-4 control-label pull-left">Workers Compensation:</label>
                    </div>
                    <div class="col-md-9 col-sm-3 find_mar">
                        <div class="col-md-9 col-sm-3 find_mar">
                            <select name="workers_compensation" id="workers_compensation" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $compensation = $this->Common_model->get_array('Workers_compensation');
                                foreach ($compensation as $croww => $cval): ?>
                                    <option value="<?php echo $croww; ?>" <?php if ($row->workers_compensation == $croww) echo "selected"; ?> ><?php echo $cval; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

    <?php 
        if($row->hourly_allowance_option==2)
        { 
            $hidden_hourly_allowance_option="";
            $hidden_graduated_form="";
            $hidden_graduated_to="";
            $hidden_hourly_allowance="";
            $hidden_available_limit="";
            $hidden_check_limit="";
            $hidden_month_limit="";
            $hidden_annual_limit="";
            $hidden_carryover_maximum="";

        $dtl_query=$this->db->get_where('main_pto_settings_details', array('mst_id' => $row->id));
        if($dtl_query)
        {
            foreach ($dtl_query->result() as $dtlrow):
                $hidden_hourly_allowance_option=$dtlrow->hourly_allowance_option;

                if($hidden_graduated_form==""){$hidden_graduated_form=$dtlrow->graduated_form;}else {$hidden_graduated_form=$hidden_graduated_form.",".$dtlrow->graduated_form;}
                if($hidden_graduated_to==""){$hidden_graduated_to=$dtlrow->graduated_to;}else {$hidden_graduated_to=$hidden_graduated_to.",".$dtlrow->graduated_to;}
                if($hidden_hourly_allowance==""){$hidden_hourly_allowance=$dtlrow->hourly_allowance;}else {$hidden_hourly_allowance=$hidden_hourly_allowance.",".$dtlrow->hourly_allowance;} 
                if($hidden_available_limit==""){$hidden_available_limit=$dtlrow->available_limit;}else {$hidden_available_limit=$hidden_available_limit.",".$dtlrow->available_limit;}
                if($hidden_check_limit==""){$hidden_check_limit=$dtlrow->check_limit;}else {$hidden_check_limit=$hidden_check_limit.",".$dtlrow->check_limit;}
                if($hidden_month_limit==""){$hidden_month_limit=$dtlrow->month_limit;}else {$hidden_month_limit=$hidden_month_limit.",".$dtlrow->month_limit;}
                if($hidden_annual_limit==""){$hidden_annual_limit=$dtlrow->annual_limit;}else {$hidden_annual_limit=$hidden_annual_limit.",".$dtlrow->annual_limit;}
                if($hidden_carryover_maximum==""){$hidden_carryover_maximum=$dtlrow->carryover_maximum;}else {$hidden_carryover_maximum=$hidden_carryover_maximum.",".$dtlrow->carryover_maximum;}

            endforeach;

            } 
        ?>
            <input type="hidden" name="tb_type" id="tb_type" value="2">
            <div class="col-md-12" id="hd_div2">
                <input type="hidden" name="hidden_hourly_allowance_option" id="hidden_hourly_allowance_option" value="<?php echo $hidden_hourly_allowance_option; ?>"/>
                <input type="hidden" name="hidden_graduated_form" id="hidden_graduated_form" value="<?php echo $hidden_graduated_form; ?>"/>
                <input type="hidden" name="hidden_graduated_to" id="hidden_graduated_to" value="<?php echo $hidden_graduated_to; ?>"/>
                <input type="hidden" name="hidden_hourly_allowance" id="hidden_hourly_allowance" value="<?php echo $hidden_hourly_allowance; ?>"/>
                <input type="hidden" name="hidden_available_limit" id="hidden_available_limit" value="<?php echo $hidden_available_limit; ?>"/>
                <input type="hidden" name="hidden_check_limit" id="hidden_check_limit" value="<?php echo $hidden_check_limit; ?>"/>
                <input type="hidden" name="hidden_month_limit" id="hidden_month_limit" value="<?php echo $hidden_month_limit; ?>"/>
                <input type="hidden" name="hidden_annual_limit" id="hidden_annual_limit" value="<?php echo $hidden_annual_limit; ?>"/>
                <input type="hidden" name="hidden_carryover_maximum" id="hidden_carryover_maximum" value="<?php echo $hidden_carryover_maximum; ?>"/>
            </div>
        <?php 
        }
        ?>
            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-u">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
        </div>
        <?php endforeach; ?>
    </form>
<?php
}
?>

<!-- Table  Modal -->
<div class="modal fade bd-example-modal-lg" id="pto_table_modal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add PTO</h4>
            </div>
            <form id="pto_table_form" name="sky-form11" class="form-horizontal" action="<?php // echo base_url();   ?>Con_configaration/receive_leave_table_info" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="pto_table_id" id="pto_table_id"/>
                <div class="modal-body">

                    <div class="col-md-12 col-sm-12 find_mar">
                        <div class="col-md-6 col-sm-6 find_mar">
                            <div class="radio col-md-3">
                                <label > <input type="radio"  id="radio_allowance_option" name="radio_allowance_option" value="1" checked > Days </label>
                            </div>
                            <div class="radio col-md-3">
                                <label> <input type="radio" id="radio_allowance_option" name="radio_allowance_option" value="2" > Weeks</label>
                            </div>
                            <div class="radio col-md-3">
                                <label> <input type="radio" id="radio_allowance_option" name="radio_allowance_option" value="3" > Months</label>
                            </div>
                            <div class="radio col-md-3">
                                <label> <input  type="radio" id="radio_allowance_option" name="radio_allowance_option" value="4" >Years</label>
                            </div>
                        </div>

                    </div>

                    <div >
                        <div >
                            <table id="pto_table" class="table table-striped table-bordered dt-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th class="mycol">From</th>
                                        <th class="mycol">To</th>
                                        <th class="mycol">Hourly Allowance</th>
                                        <th class="mycol">Available Limit</th>
                                        <th class="mycol">Check Limit</th>
                                        <th class="mycol">Month Limit</th>
                                        <th class="mycol">Annual Limit</th>
                                        <th class="mycol">Carryover Maximum</th>
                                        <th class="mycol" style="width: 11%; "> Action</th>
                                    </tr>
                                </thead>
                                <tbody id="pto_tbody">
                                    <tr id="tr_1">
                                        <td><input class="form-control input-sm" type="text" name="graduated_form[]" id="graduated_form_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="graduated_to[]" id="graduated_to_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="hourly_allowance[]" id="hourly_allowance_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="available_limit[]" id="available_limit_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="check_limit[]" id="check_limit_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="month_limit[]" id="month_limit_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="annual_limit[]" id="annual_limit_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="carryover_maximum[]" id="carryover_maximum_1" /></td>
                                        <td>
                                            <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_pto_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                            <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_pto_row(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="close_table_modal();" class="btn btn-u" >Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
         
        $('#leave_table').attr("readonly", true);
        $('input:radio[name="hourly_allowance_option"]').click(function() {
            if ($(this).val() == 1) {
              $('#fixed_amount').removeAttr("readonly");
              $('#leave_table').attr("disabled", true);
            } else {
               $('#leave_table').removeAttr("disabled");
               $('#fixed_amount').attr("readonly", true);
            }
        });
        
    });
    
    $("#method").select2({
        placeholder: "Method",
        allowClear: true,
    });

    $("#workers_compensation").select2({
        placeholder: "Workers Compensation",
        allowClear: true,
    });
    
    function add_pto_table()
    {
        var value = $('input[name="hourly_allowance_option"]:checked').val();
        if(value==1){
            alert('Please Select Graduated Field');
        }else{
            
        save_method = 'add';
        $('#pto_table_form')[0].reset(); // reset form on modals
        $('#pto_table_modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Graduated PTO Table'); // Set Title to Bootstrap modal title
//        var tb_type=$('#tb_type').val();
//        if(tb_type==2)
//        {
//            $('#hd_div1').html('');
//            $('#hd_div1').empty();
//            
//        }
        
        $("#pto_tbody tr").not(':first').remove();

        var val_hourly_allowance_option = $('#hidden_hourly_allowance_option').val();
        var val_graduated_form = $('#hidden_graduated_form').val();
        var val_graduated_to = $('#hidden_graduated_to').val();
        var val_hourly_allowance = $('#hidden_hourly_allowance').val();
        var val_available_limit = $('#hidden_available_limit').val();
        var val_check_limit = $('#hidden_check_limit').val();
        var val_month_limit = $('#hidden_month_limit').val();
        var val_annual_limit = $('#hidden_annual_limit').val();
        var val_carryover_maximum = $('#hidden_carryover_maximum').val();

        var arr_graduated_form = val_graduated_form.split(',');
        var arr_graduated_to = val_graduated_to.split(',');
        var arr_hourly_allowance = val_hourly_allowance.split(',');
        var arr_available_limit = val_available_limit.split(',');
        var arr_check_limit = val_check_limit.split(',');
        var arr_month_limit = val_month_limit.split(',');
        var arr_annual_limit = val_annual_limit.split(',');
        var arr_carryover_maximum = val_carryover_maximum.split(',');

        $('input[name=radio_allowance_option][value=' + val_hourly_allowance_option + ']').attr('checked', true);

            for (var i = 0; i <= arr_graduated_form.length; i++) {
                //alert (i);
                $('#graduated_form_' + i).val(arr_graduated_form[ i - 1 ]);
                $('#graduated_to_' + i).val(arr_graduated_to[ i - 1 ]);
                $('#hourly_allowance_' + i).val(arr_hourly_allowance[ i - 1 ]);
                $('#available_limit_' + i).val(arr_available_limit[ i - 1 ]);
                $('#check_limit_' + i).val(arr_check_limit[ i - 1 ]);
                $('#month_limit_' + i).val(arr_month_limit[ i - 1 ]);
                $('#annual_limit_' + i).val(arr_annual_limit[ i - 1 ]);
                $('#carryover_maximum_' + i).val(arr_carryover_maximum[ i - 1 ]);
               
                if(i!=0 && i < arr_graduated_form.length)
                {
                    add_pto_row(i);
                }
                
            }
        }
    }
    
    function close_table_modal()
    {
        var graduated_form;
        var graduated_to;
        var hourly_allowance;
        var available_limit;
        var check_limit;
        var month_limit;
        var annual_limit;
        var carryover_maximum;

        var totrow = $("#pto_table > tbody > tr").length;

        var hourly_allowance_option = $('input[name=radio_allowance_option]:checked').val();

        for (var i = 0; i <= totrow; i++) {
            if (i == 1)
            {
                graduated_form = $('#graduated_form_' + i).val();
                graduated_to = $('#graduated_to_' + i).val();
                hourly_allowance = $('#hourly_allowance_' + i).val();
                available_limit = $('#available_limit_' + i).val();
                check_limit = $('#check_limit_' + i).val();
                month_limit = $('#month_limit_' + i).val();
                annual_limit = $('#annual_limit_' + i).val();
                carryover_maximum = $('#carryover_maximum_' + i).val();
            }
            else
            {
                graduated_form = graduated_form + ',' + $('#graduated_form_' + i).val();
                graduated_to = graduated_to + ',' + $('#graduated_to_' + i).val();
                hourly_allowance = hourly_allowance + ',' + $('#hourly_allowance_' + i).val();
                available_limit = available_limit + ',' + $('#available_limit_' + i).val();
                check_limit = check_limit + ',' + $('#check_limit_' + i).val();
                month_limit = month_limit + ',' + $('#month_limit_' + i).val();
                annual_limit = annual_limit + ',' + $('#annual_limit_' + i).val();
                carryover_maximum = carryover_maximum + ',' + $('#carryover_maximum_' + i).val();
            }
           
        }
        $('#hidden_hourly_allowance_option').val(hourly_allowance_option);
        $('#hidden_graduated_form').val(graduated_form);
        $('#hidden_graduated_to').val(graduated_to);
        $('#hidden_hourly_allowance').val(hourly_allowance);
        $('#hidden_available_limit').val(available_limit);
        $('#hidden_check_limit').val(check_limit);
        $('#hidden_month_limit').val(month_limit);
        $('#hidden_annual_limit').val(annual_limit);
        $('#hidden_carryover_maximum').val(carryover_maximum);

        $('#pto_table_modal').modal('hide');
    }
    
    function add_pto_row(i)
    {
        //alert (i);
        var rowCount = $('#pto_tbody tr').length;
        //alert (rowCount);
        if ($('#graduated_form_' + rowCount).val() == "")
        {
            alert('Graduated form Can not be empty.');
            $('#graduated_form_' + rowCount).focus();
            return;
        }
        else
        {
            rowCount++;

            $('#pto_table').append(
                '<tr id="tr_' + rowCount + '">'
                    + '<td><input class="form-control input-sm" type="text" name="graduated_form[]" id="graduated_form_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="graduated_to[]" id="graduated_to_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="hourly_allowance[]" id="hourly_allowance_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="available_limit[]" id="available_limit_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="check_limit[]" id="check_limit_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="month_limit[]" id="month_limit_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="annual_limit[]" id="annual_limit_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="carryover_maximum[]" id="carryover_maximum_' + rowCount + '" autocomplete="off"/> </td>'
                    + '<td>\n\
                    <a class="btn btn-sm btn-u" id="add_' + rowCount + '" title="Add" onclick="add_pto_row(' + rowCount + ');"><i class="glyphicon glyphicon-plus" ></i></a>\n\
                    <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_pto_row(' + rowCount + ');"><i class="glyphicon glyphicon-minus" ></i> </a>\n\
                    </td>'
                + '</tr>'
            );

        }

    }
    
    function  remove_pto_row(i)
    {
        var rowCount = $('#pto_tbody tr').length;
        if (rowCount != 1)
        {
            $("#pto_tbody tr:last").remove();
            //$('#tr_' + i).remove();
        }
    }
    
    </script>
