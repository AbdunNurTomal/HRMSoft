<?php
if ($type == 1) {
    ?>
    <form id="company_settings_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_configaration/save_company_settings" enctype="multipart/form-data" role="form">
        <div class="container">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Legal Name<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="hidden" name="chk_company" id="chk_company" value="" />
                        <input type="hidden" name="company_id" id="company_id" value="" />
                        <input type="hidden" name="company_user_id" id="company_user_id" value="" />
                        <input type="text" name="company_full_name" id="company_full_name" class="form-control input-sm" placeholder="Company Full Name" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">DBA Name<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="company_short_name" id="company_short_name" class="form-control input-sm" placeholder="Company short name" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Show in header</label>
                    <div class="col-sm-8">
                        <input type="radio" id="show_in_header" name="show_in_header" value="0" checked> Legal Name
                        <input type="radio" id="show_in_header" name="show_in_header" value="1" > DBA Name
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Corporation Type<span class="req"/></label>
                    <div class="col-sm-8">
                        <select name="corporation_type" id="corporation_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                            $corporation_type_array = $this->Common_model->get_array('corporation_type');
                            foreach ($corporation_type_array as $crow => $cval) {
                                print"<option value='" . $crow . "'>" . $cval . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"> EIN Number <span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="ein_number" id="ein_number" class="form-control input-sm" placeholder="Company EIN Number" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Address 1<span class="req"/></label>
                    <div class="col-sm-8">
                        <textarea name="address_1" id="address_1" class="form-control input-sm" rows="2" placeholder="Address 1" data-toggle="tooltip" data-placement="top" title="Address 1"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Address 2</label>
                    <div class="col-sm-8">
                        <textarea name="address_2" id="address_2" class="form-control input-sm" rows="2" placeholder="Address 2" data-toggle="tooltip" data-placement="top" title="Address 2"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">City </label>
                    <div class="col-sm-8">                            
                        <input type="text" name="city" id="city" class="form-control input-sm" placeholder="City" />
                    </div>
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">State </label>
                    <div class="col-sm-8">
                        <select name="state" id="state" onchange="load_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                            <option></option>
                            <?php
                            foreach ($state_query->result() as $keyy):
                                ?>
                                <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group no-margin" id="county_div">
                    <label class="col-sm-4 control-label">County </label>
                    <div class="col-sm-7">
                        <select name="county_id" id="county_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                            <option></option>

                        </select>
                    </div>
                    <a class="btn ntn-u col-sm-1" onClick="add_county()" href="#" title="Add County"><span class="glyphicon glyphicon-plus-sign"></span></a>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Zip Code<span class="req"></label>
                    <div class="col-sm-8">
                        <input type="text" name="zip_code" id="zip_code" class="form-control input-sm" placeholder="Zip Code" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Company Logo</label>
                    <div class="col-sm-8">
                        <div class="slim" data-label="Company Logo">
                            <input type="file" name="slim[]" id="image_name"  />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Primary Phone<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="phone_1" id="phone_1" class="form-control input-sm" placeholder="Primary Phone" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Secondary Phone</label>
                    <div class="col-sm-8">
                        <input type="text" name="phone_2" id="phone_2" class="form-control input-sm" placeholder="Secondary Phone" />   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Mobile Phone </label>
                    <div class="col-sm-8">
                        <input type="text" name="mobile_phone" id="mobile_phone" class="form-control input-sm" placeholder="Mobile Phone" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Email<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="mail" name="email" id="email" class="form-control input-sm" placeholder="Email" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Fax No</label>
                    <div class="col-sm-8">
                        <input type="text" name="fax_no" id="fax_no" class="form-control input-sm" placeholder="Fax No" />
                    </div>
                </div>

                <!--                <div class="form-group">
                                    <label class="col-sm-4 control-label">Employee Type </label>
                                    <div class="col-sm-8">
                                        <select name="employee_type" id="employee_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                            <option></option>
                <?php
                /* $employee_type_array = $this->Common_model->get_array('employee_type');
                  foreach ($employee_type_array as $erow => $eval) {
                  print"<option value='" . $erow . "'>" . $eval . "</option>";
                  } */
                ?>
                                        </select>
                                    </div>
                                </div>-->
              <!--  <div class="form-group">
                    <label class="col-sm-4 control-label">Billing Type<span class="req"/></label>
                    <div class="col-sm-8">
                        <select name="billing_type" id="billing_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                            /*$billing_type_array = $this->Common_model->get_array('billing_type');
                            foreach ($billing_type_array as $row => $val) {
                                print"<option value='" . $row . "'>" . $val . "</option>";
                            }*/
                            ?>
                        </select>
                    </div>
                </div>-->
                <!--                <div class="form-group">
                                    <label class="col-sm-4 control-label">Billing Cycle </label>
                                    <div class="col-sm-8">
                                        <select name="billing_cycle" id="billing_cycle" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                            <option></option>
                <?php /* $pay_freq = $this->db->get_where('main_payfrequency_type', array('company_id' => $this->company_id))->result();
                  foreach ($pay_freq as $row) :
                  ?>
                  <option value="<?php echo $row->id ?>"><?php echo $row->freqcode; ?></option>
                  <?php endforeach; */ ?>
                                        </select>
                                    </div>
                                </div>-->
               <!-- <div class="form-group">
                    <label class="col-sm-4 control-label">Pricing Setup </label>
                    <div class="col-sm-8">
                        <select name="pricing_setup" id="pricing_setup" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                            /*$pricing_setup_array = $this->Common_model->get_array('pricing_setup');
                            foreach ($pricing_setup_array as $key => $val) {
                                print"<option value='" . $key . "'>" . $val . "</option>";
                            }*/
                            ?>
                        </select>
                    </div>
                </div>--
                <div class="form-group">
                    <label class="col-sm-4 control-label">Payable Type </label>
                    <div class="col-sm-8">
                        <select name="payable_type" id="payable_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                            /*$payable_type_array = $this->Common_model->get_array('payable_type');
                            foreach ($payable_type_array as $key => $val) {
                                print"<option value='" . $key . "'>" . $val . "</option>";
                            }*/
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Rate </label>
                    <div class="col-sm-8">
                        <input type="text" name="rate" id="rate" class="form-control input-sm" placeholder="Rate" />   
                    </div>
                </div>-->
                <!--                <div class="form-group">
                                    <label class="col-sm-4 control-label">Company EIN Number </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="eni_number" id="eni_number" class="form-control input-sm" placeholder="Company EIN Number" readonly/>   
                                    </div>
                                </div>-->
                <!--<div class="form-group">
                    <label class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-8">
                        <select name="status" id="status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <?php
                            /*$status_array = $this->Common_model->get_array('status');
                            foreach ($status_array as $key => $val) {
                                ?>
                                <option value="<?php echo $key ?>" <?php if ($key == 1) echo "selected" ?> ><?php echo $val ?></option>
                                <?php
                            }*/
                            ?>
                        </select>
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="col-sm-4 control-label">GUID</label> <!--<span class="req"/> -->
                    <div class="col-sm-8">
                        <input type="text" name="HR360_GUID" id="HR360_GUID" class="form-control input-sm" placeholder="GUID" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Track Leave By </label>
                    <div class="col-sm-8">
                        <div class="radio col-md-12">
                            <label > 
                                <input type="radio"  id="leave_track_by" name="leave_track_by" value="0" checked > HRM 
                            </label>
                        </div>
                        <div class="radio col-md-12">
                            <label> 
                                <input type="radio" id="leave_track_by" name="leave_track_by" value="1" > Payroll
                            </label>
                        </div>
                        <div class="radio col-md-12">
                            <label> 
                                <input type="radio" id="leave_track_by" name="leave_track_by" value="2" > Time & Attendance
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-12">
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                    <a class="btn btn-danger" href="<?php echo base_url() . "con_configaration" ?>">Close</a>
                </div>
            </div>
        </div>
    </form>
    <?php
}
else {
    ?>
    <form id="company_settings_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_configaration/save_company_settings" enctype="multipart/form-data" role="form">
        <div class="container">
            <?php foreach ($query->result() as $row): ?> 
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Legal Name<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="hidden" name="chk_company" id="chk_company" value="<?php echo $row->id ?>" />
                            <input type="hidden" name="company_ID" id="company_ID" value="<?php echo $row->id ?>" />
                            <input type="hidden" name="company_user_id" id="company_user_id" value="<?php echo $row->company_user_id ?>" />
                            <input type="text" name="company_full_name" id="company_full_name" value="<?php echo $row->company_full_name ?>" class="form-control input-sm" placeholder="Company Full Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">DBA Name<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="company_short_name" id="company_short_name" value="<?php echo $row->company_short_name ?>" class="form-control input-sm" placeholder="Company short name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Show in header</label>
                        <div class="col-sm-8">
                            <input type="radio" id="show_in_header" name="show_in_header" value="0" <?php if ($row->show_in_header == 0) {
                                echo "checked";
                            } ?>> Legal Name
                                        <input type="radio" id="show_in_header" name="show_in_header" value="1" <?php if ($row->show_in_header == 1) {
                                echo "checked";
                            } ?>> DBA Name
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Corporation Type<span class="req"/></label>
                        <div class="col-sm-8">
                            <select name="corporation_type" id="corporation_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($corporation_type_array as $crow => $cval) {
                                    ?>
                                    <option value="<?php echo $crow ?>"<?php if ($row->corporation_type == $crow) echo "selected"; ?>><?php echo $cval ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> EIN Number <span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="ein_number" id="ein_number" value="<?php echo $row->ein_number ?>" class="form-control input-sm" placeholder="Company EIN Number" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 1<span class="req"/></label>
                        <div class="col-sm-8">
                            <textarea name="address_1" id="address_1" class="form-control input-sm" rows="2" placeholder="Address 1" data-toggle="tooltip" data-placement="top" title="Address 1"><?php echo $row->address_1 ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 2</label>
                        <div class="col-sm-8">
                            <textarea name="address_2" id="address_2" class="form-control input-sm" rows="2" placeholder="Address 2" data-toggle="tooltip" data-placement="top" title="Address 2"><?php echo $row->address_2 ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">City </label>
                        <div class="col-sm-8">                            
                            <input type="text" name="city" id="city" value="<?php echo $row->city ?>" class="form-control input-sm" placeholder="City" />
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">State</label>
                        <div class="col-sm-8">
                            <select name="state" id="state" onchange="load_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($state_query->result() as $keyy):
                                    ?>
                                    <option value="<?php echo $keyy->id ?>"<?php if ($row->state == $keyy->id) echo "selected"; ?>><?php echo $keyy->state_abbr ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <script type="text/javascript">
                            
                            $(function () {
                                load_county(<?php echo $row->state;?>);
                                $('[name="county_id"]').select2().select2('val', <?php  echo $row->county_id; ?>);
                            });
                            
                        </script>
                    </div>
                    <div class="form-group no-margin" id="county_div">
                        <label class="col-sm-4 control-label">County</label>
                        <div class="col-sm-7">
                            <select name="county_id" id="county_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                /*foreach ($county_query->result() as $keyy):
                                    ?>
                                    <option value="<?php echo $keyy->id ?>"<?php if ($row->county_id == $keyy->id) echo "selected"; ?>><?php echo $keyy->county_name ?></option>
                                <?php endforeach;*/ ?>
                            </select>
                        </div>
                        <a class="btn ntn-u col-sm-1" onClick="add_county()" href="#" title="Add County"><span class="glyphicon glyphicon-plus-sign"></span></a>
                       
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Zip Code<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="zip_code" id="zip_code" value="<?php echo $row->zip_code ?>" class="form-control input-sm" placeholder="Zip Code" />                
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Company Logo</label>
                        <div class="col-sm-8">
                            <div class="slim" data-label="Company Logo">
                                <?php if ($row->company_logo != "") { ?>
                                    <img src="<?php  echo base_url() . "uploads/companylogo/" . $row->company_logo; ?>" alt=""/>
                                <?php } ?>
                                <input type="file" name="slim[]" id="image_name"  />
                            </div>
                        </div>
                    </div>
                    
                </div>
            
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Primary Phone<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="phone_1" id="phone_1" value="<?php echo $row->phone_1 ?>" class="form-control input-sm" placeholder="Primary Phone" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Secondary Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone_2" id="phone_2" value="<?php echo $row->phone_2 ?>" class="form-control input-sm" placeholder="Secondary Phone" />   
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Mobile Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="mobile_phone" id="mobile_phone" value="<?php echo $row->mobile_phone ?>" class="form-control input-sm" placeholder="Mobile Phone" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email <span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="mail" name="email" id="email" value="<?php echo $row->email ?>" class="form-control input-sm" placeholder="Email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Fax No</label>
                        <div class="col-sm-8">
                            <input type="text" name="fax_no" id="fax_no" value="<?php echo $row->fax_no ?>" class="form-control input-sm" placeholder="Fax No" />
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label class="col-sm-4 control-label">Billing Type <span class="req"/> </label>
                        <div class="col-sm-8">
                            <select name="billing_type" id="billing_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                /*foreach ($billing_type_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->billing_type == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }*/
                                ?>
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pricing Setup </label>
                        <div class="col-sm-8">
                            <select name="pricing_setup" id="pricing_setup" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                /*foreach ($pricing_setup_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->pricing_setup == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }*/
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Payable Type </label>
                        <div class="col-sm-8">
                            <select name="payable_type" id="payable_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                /*foreach ($payable_type_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->payable_type == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }*/
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Rate </label>
                        <div class="col-sm-8">
                            <input type="text" name="rate" id="rate" value="<?php //echo $row->rate ?>" class="form-control input-sm" placeholder="Rate" />   
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Status</label>
                        <div class="col-sm-8">
                            <select name="status" id="status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                /*foreach ($status_array as $keyy => $vall) {
                                    ?>
                                    <option value="<?php echo $keyy ?>"<?php if ($row->isactive == $keyy) echo "selected"; ?>><?php echo $vall; ?></option>
                                    <?php
                                }*/
                                ?>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">GUID</label> <!--<span class="req"/> -->
                        <div class="col-sm-8">
                            <input type="text" name="HR360_GUID" id="HR360_GUID" value="<?php echo isset($row->HR360_GUID) ? $row->HR360_GUID : ""; ?>" class="form-control input-sm" placeholder="GUID" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Track Leave By </label>
                        <div class="col-sm-8">
                            <div class="radio col-md-12">
                                <label > 
                                    <input type="radio" id="leave_track_by" name="leave_track_by" value="0" <?php if ($row->leave_track_by == 0) echo "checked"; ?>  > HRM 
                                </label>
                            </div>
                            <div class="radio col-md-12">
                                <label> 
                                    <input type="radio" id="leave_track_by" name="leave_track_by" value="1" <?php if ($row->leave_track_by == 1) echo "checked"; ?> > Payroll
                                </label>
                            </div>
                            <div class="radio col-md-12">
                                <label> 
                                    <input type="radio" id="leave_track_by" name="leave_track_by" value="2" <?php if ($row->leave_track_by == 2) echo "checked"; ?> > Time & Attendance
                                </label>
                            </div>
                            
                        </div>
                    </div>

                </div>

                <div class="col-sm-12">
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_configaration" ?>">Close</a>
                    </div>
                </div>
    <?php endforeach; ?>
        </div>
    </form>
    <?php
}
?>


<!-- Modal -->
<div class="modal fade" id="county_Modal_entry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add County</h4>
            </div>
            <form id="add_county_entry" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_languages"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label ">County Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="county_name" id="county_name" class="form-control input-sm" placeholder="County Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="2" id="description" name="description" placeholder="Description"></textarea>
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

<!--<style type="text/css">
    .slim-result img{height:100% !important; width:100% !important}
</style>-->

<script type="text/javascript">

    $(function () {

        $("#state").select2({
            placeholder: "State",
            allowClear: true,
        });

        $("#county_id").select2({
            placeholder: "Select County",
            allowClear: true,
        });

        $("#billing_type").select2({
            placeholder: "Billing Type",
            allowClear: true,
        });

        $("#billing_cycle").select2({
            placeholder: "Billing Cycle",
            allowClear: true,
        });

        $("#pricing_setup").select2({
            placeholder: "Pricing Setup",
            allowClear: true,
        });

        $("#status").select2({
            placeholder: "Status",
            allowClear: true,
        });

        $("#payable_type").select2({
            placeholder: "Payable Type",
            allowClear: true,
        });

        $("#corporation_type").select2({
            placeholder: "Corporation Type",
            allowClear: true,
        });

        $("#employee_type").select2({
            placeholder: "Select Employee Type",
            allowClear: true,
        });
        
        $("#zip_code").mask("99999");
        $("#phone_1").mask("(999) 999-9999", { "escapeChar": "\\" });
        $("#phone_2").mask("(999) 999-9999", { "escapeChar": "\\" });
        $("#mobile_phone").mask("(999) 999-9999", { "escapeChar": "\\" });
        $("#fax_no").mask("(999) 999-9999", { "escapeChar": "\\" });
    });

    function add_county()
    {
        save_method = 'add';
        $('#add_county_entry')[0].reset(); // reset form on modals
        $('#county_Modal_entry').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add County'); // Set Title to Bootstrap modal title
    }

    $(function () {
        $("#add_county_entry").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_County_Settings/save_County_Settings') ?>";
            }
            $.ajax({
                url: url,
                data: $("#add_county_entry").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

//              $("#county_Modal_entry").load(location.href + " #county_Modal_entry"); 
                var url = '';
                view_message(data, url, 'county_Modal_entry', 'add_county_entry');

                $("#county_div").load(location.href + " #county_div");

                setTimeout(function () {

                    $("#county_id").select2({
                        placeholder: "Select County",
                        allowClear: true,
                    });

                }, 1000);


            });
            event.preventDefault();
        });
    });


    function load_county(id) {
        //alert (id);
        $.ajax({
            url: "<?php echo site_url('Con_configaration/load_county_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#county_id').html('');
                $('#county_id').empty();

                $('#county_id').html(data);
            }
        });
    }
    
    
</script>