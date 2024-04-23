<style type="text/css">
    #signature {
            border: 2px dotted black;
            background-color:lightgrey;
    }
</style>

<?php
    $showSSNButton = false;
    if ($this->KurunthamModel->checkShowSSNAccess()) {
        $showSSNButton = true;
    }
?>

<?php
$county_query = $this->Common_model->listItem('main_county');
$state_query = $this->Common_model->listItem('main_state');
// if ($this->user_group == 11 || $this->user_group == 12) {
    $positions_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
/* } else {
    $positions_query = $this->db->get_where('main_positions', array('isactive' => 1));
} */
// echo "<pre>". print_r($positions_query->result(), 1) ."</pre>";exit;

if ($employee_id == "" && $type == 1) {
    ?>
    <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employees/save_Employees" enctype="multipart/form-data" role="form">
        <div class="container">
            <div class="col-sm-6">
                <input type="hidden" value="" name="id" id="id"/>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Employee ID</label>
                    <div class="col-sm-8">
                        <?php //$employee_id = $this->Common_model->return_next_id('id', 'main_employees'); ?>
                        <input type="text" name="employee_id" id="employee_id" readonly="readonly"  class="form-control input-sm" placeholder="Employee ID" data-toggle="tooltip" data-placement="bottom" title="Employee ID">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Salutation</label>
                    <div class="col-sm-8">
                        <input type="text" name="salutation" id="salutation" class="form-control input-sm" placeholder="Salutation" data-toggle="tooltip" data-placement="bottom" title="Salutation">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">First Name<span class="req"></label>
                    <div class="col-sm-8">
                        <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First name" data-toggle="tooltip" data-placement="bottom" title="First Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">MI</label>
                    <div class="col-sm-8">
                        <input type="text" name="middle_name" id="middle_name" class="form-control input-sm" placeholder="Middle name" data-toggle="tooltip" data-placement="bottom" title="Middle name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Last Name<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Suffix</label>
                    <div class="col-sm-8">
                        <input type="text" name="suffix" id="suffix" class="form-control input-sm" placeholder="Suffix" data-toggle="tooltip" data-placement="bottom" title="Suffix">
                    </div>
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">State</label>
                    <div class="col-sm-8">
                        <select name="state" id="state" onchange="load_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                            <option></option>
                            <?php foreach ($state_query->result() as $keyy): ?>
                                <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group no-margin">
                    <div id="cocounty_div">
                        <label class="col-sm-4 control-label">County </label>
                        <div class="col-sm-7">
                            <select name="county" id="county" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                
                            </select> 
                        </div>
                    </div>
                    <a class="btn ntn-u col-sm-1" style="padding-left:0" onClick="add_cocounty()" href="#" title="Add County"><span class="glyphicon glyphicon-plus-sign"></span></a>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"> Address 1<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="address1" id="address1" class="form-control input-sm" placeholder="Address 1" data-toggle="tooltip" data-placement="bottom" title=" Address 1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Address 2</label>
                    <div class="col-sm-8">
                        <input type="text" name="address2" id="address2" class="form-control input-sm" placeholder="Address 2" data-toggle="tooltip" data-placement="bottom" title="Address 2">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-8">
                        <input type="text" name="city" id="city" class="form-control input-sm capitalize" placeholder="City" data-toggle="tooltip" data-placement="bottom" title="City">
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Zip Code</label>
                    <div class="col-sm-8">
                        <input type="text" name="zipcode" id="zipcode" class="form-control input-sm" placeholder="Zip Code" data-toggle="tooltip" data-placement="bottom" title="Zip Code">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">SSN <span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="ssn_code" id="ssn_code" class="form-control input-sm" placeholder="SSN" data-toggle="tooltip" data-placement="bottom" title="SSN">
                    </div>
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">Marital Status </label>
                    <div class="col-sm-8">
                        <select name="marital_status" id="marital_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                            $marital_status_array = $this->Common_model->get_array('marital_status');
                            foreach ($marital_status_array as $row => $val) {
                                print"<option value='" . $row . "'>" . $val . "</option>";
                            }
                            ?>
                        </select>          
                    </div>
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">Gender</label>
                    <div class="col-sm-8">
                        <select name="gender" id="gender" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <?php
                            $gender_array = $this->Common_model->get_array('gender');
                            foreach ($gender_array as $row => $val) {
                                print"<option value='" . $row . "'>" . $val . "</option>";
                            }
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"> Birthdate </label>
                    <div class="col-sm-8">
                        <input type="text" name="birthdate" id="birthdate" class="form-control input-sm" placeholder="Birthdate" data-toggle="tooltip" data-placement="bottom" title="Birthdate" autocomplete="off">
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-sm-4 control-label">Signature </label>
                    <div class="col-sm-8">
<!--                        <div class="slim" style="background-image:url('<?php // echo base_url(); ?>uploads/no-image.png'); background-size: 100% 100%; " 
                            data-label="Drop your Image"
                            data-size="240,240"
                            data-ratio="2:1">
                           <input type="file" name="signature[]" id="signature" required />
                        </div>-->
                        <!--<textarea class="form-control" rows="2" id="signature" name="signature" placeholder="Signature"></textarea>-->
                        <div id="signature"></div>
                        <input type="hidden" name="scanvasData" id="scanvasData">
                    </div>
                </div>
                
            </div>
            <div class="col-sm-6">
                <div class="form-group">   
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                        <div class="box pull-right" style="height:150px; width:145px;" >

                            <!--<div class="slim"
                                data-service="<?php /* echo base_url(); */ ?>assets/slimimage/server/async.php"
                                data-ratio="1:1"
                                data-size="240,240">
                                <input type="file" name="slim[]"/>
                           </div>-->
                            <div class="slim" style="background-image:url('<?php echo base_url(); ?>uploads/blank.png'); background-size:150px 145px;" 
                                 data-label="Drop your Image"
                                 data-size="240,240"
                                 data-ratio="1:1">
                                <!--<img src="<?php/* echo base_url(); */?>uploads/blank.png" alt=""/>-->
                                <input type="file" name="slim[]" id="image_name" required />
                            </div>

                            <!--<img src="<?php /* echo base_url(); */ ?>uploads/blank.png" id="my_image" class="twPc-avatarImg pull-right" alt="" height="100" width="95">
                            <a href="#" onclick="add_upload();" class="thumbnail linkStyle" data-toggle="tooltip">
                                <div class="hover-item">
                                    <h6><i class="fa fa-camera" aria-hidden="true"></i>Upload Image</h6>
                                </div>
                            </a>-->
                            <input type="hidden" name="img_path" id="img_path" />
                            <!--<input type="hidden" name="image_name" id="image_name" />-->
                        </div>
                    </div>   
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">Position<span class="req"/></label>
                    <div class="col-sm-8">
                        <select name="position" id="position" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                            <option></option>
                            <?php foreach ($positions_query->result() as $key): ?>
                                <option value="<?php echo $key->positionname ?>"><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Home Phone</label>
                    <div class="col-sm-8">
                        <input name="home_phone" id="home_phone" class="form-control input-sm" placeholder="Home Phone" data-toggle="tooltip" data-placement="bottom" title="Home Phone">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Mobile Phone <span class="req"/> </label>
                    <div class="col-sm-8">
                        <input type="text" name="mobile_phone" id="mobile_phone" class="form-control input-sm" placeholder="Mobile Phone" data-toggle="tooltip" data-placement="bottom" title="Mobile Phone">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Work Phone</label>
                    <div class="col-sm-8">
                        <input type="text" name="work_phone" id="work_phone" class="form-control input-sm" placeholder="Work Phone" data-toggle="tooltip" data-placement="bottom" title="Work Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"> Card No </label>
                    <div class="col-sm-8">
                        <input type="text" name="card_no" id="card_no" class="form-control input-sm" placeholder="Card No" data-toggle="tooltip" data-placement="bottom" title="Card No">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Ext</label>
                    <div class="col-sm-8">
                        <input type="text" name="ext" id="ext" class="form-control input-sm" placeholder="Ext" data-toggle="tooltip" data-placement="bottom" title="Ext">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Email <span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email" data-toggle="tooltip" data-placement="bottom" title="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Hire Date<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="hire_date" id="hire_date" class="form-control dt_pick input-sm" placeholder="Hire Date" data-toggle="tooltip" data-placement="bottom" title="Hire Date" autocomplete="off" >
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Introductory Period</label>
                    <div class="col-sm-8">
                        <input type="text" name="probation_days" id="probation_days" onkeypress="return numbersonly(this, event)" onblur="get_probation_start(this.value)" class="form-control input-sm" placeholder="Introductory Period" title="Introductory Period">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"> Introductory Period End </label>
                    <div class="col-sm-8">
                        <input type="text" name="probation_start" id="probation_start" class="form-control dt_pick input-sm" placeholder="Probation Start" title="Probation Start" onchange="get_days(this.value)" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Review Date</label>
                    <div class="col-sm-8">
                        <input type="text" name="review_date" id="review_date" class="form-control dt_pick input-sm" placeholder="Review Date" data-toggle="tooltip" data-placement="bottom" title="Review Date" autocomplete="off" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Termination Date</label>
                    <div class="col-sm-8">
                        <input type="text" name="termination_date" id="termination_date" class="form-control dt_pick input-sm" placeholder="Termination Date" data-toggle="tooltip" data-placement="bottom" title="Termination Date" autocomplete="off" >
                    </div>
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">Transportation</label>
                    <div class="col-sm-8">
                        <select name="transportation" id="transportation" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <?php
                            $yes_no_array = $this->Common_model->get_array('yes_no');
                            foreach ($yes_no_array as $key => $val) {
                                print"<option value='" . $key . "'>" . $val . "</option>";
                            }
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">Status </label>
                    <div class="col-sm-8">
                        <select name="status" id="status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <?php
                            $status_array = $this->Common_model->get_array('status');
                            foreach ($status_array as $key => $val) {
                                ?>
                                <option value="<?php echo $key ?>" <?php if ($key == 1) echo "selected" ?> ><?php echo $val ?></option>
                                <?php
                            }
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">Contact Via Email</label>
                    <div class="col-sm-8">
                        <select name="contact_via_email" id="contact_via_email" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <?php
                            foreach ($yes_no_array as $key => $val) {
                                print"<option value='" . $key . "'>" . $val . "</option>";
                            }
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">Contact Via Text</label>
                    <div class="col-sm-8">
                        <select name="contact_via_text" id="contact_via_text" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <?php
                            foreach ($yes_no_array as $key => $val) {
                                print"<option value='" . $key . "'>" . $val . "</option>";
                            }
                            ?>
                        </select> 
                    </div>
                </div>
                
            </div>
            <div class="col-sm-12">
                <div class="modal-footer">
                    <!--<button type="button" id="pass_gen_id" class="btn btn-u" onclick="generate_emp_password()" > Password </button>-->
                    <button type="submit" id="submit" class="btn btn-u"> Save </button>
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employees/index/1" ?>">Close</a>
                </div>
            </div>
        </div>
    </form>
    <?php
} 
elseif ($employee_id != "" && $type == 2) { //Update
    ?>
    <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employees/edit_Employees" enctype="multipart/form-data" role="form">
        <div class="container">
            <?php foreach ($query->result() as $row): ?> 
                <div class="col-sm-6">
                    <input type="hidden" value="<?php echo $row->employee_id ?>" name="id" id="id"/>
                    <input type="hidden" value="<?php echo $row->emp_user_id ?>" name="user_id"/>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Employee ID</label>
                        <div class="col-sm-8">
                            <input type="text" name="employee_id" id="employee_id" class="form-control input-sm" value="<?php $employee_id = $row->employee_id; echo sprintf("%07d", $row->employee_id) ?>"  placeholder="Employee ID" data-toggle="tooltip" data-placement="bottom" title="Employee ID" readonly="readonly">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Salutation</label>
                        <div class="col-sm-8">
                            <input type="text" name="salutation" id="salutation" class="form-control input-sm" value="<?php echo ucwords($row->salutation) ?>" placeholder="Salutation" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Salutation">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">First Name<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="first_name" id="first_name" class="form-control input-sm" value="<?php echo ucwords($row->first_name) ?>" placeholder="First name" data-toggle="tooltip" data-placement="bottom" title="Tooltip for First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">MI</label>
                        <div class="col-sm-8">
                            <input type="text" name="middle_name" id="middle_name" class="form-control input-sm" value="<?php echo ucwords($row->middle_name) ?>" placeholder="Middle name" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Middle name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Last Name<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="last_name" id="last_name" class="form-control input-sm" value="<?php echo ucwords($row->last_name) ?>" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Suffix</label>
                        <div class="col-sm-8">
                            <input type="text" name="suffix" id="suffix" class="form-control input-sm" value="<?php echo $row->suffix ?>" placeholder="Suffix" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Suffix">
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">State</label>
                        <div class="col-sm-8">
                            <select name="state" id="state" onchange="load_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($state_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"<?php if ($row->state == $key->id) echo "selected"; ?>><?php echo $key->state_abbr ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        
                        <script type="text/javascript">
                            
                            $(function () {
                                load_county(<?php echo $row->state;?>);
                                $('[name="county"]').select2().select2('val', <?php  echo $row->county; ?>);
                            });
                            
                        </script>
                        
                    </div>
                    <div class="form-group no-margin no-padding-right">
                        <div id="cocounty_div">
                            <label class="col-sm-4 control-label">County</label>
                            <div class="col-sm-7">
                                <select name="county" id="county" class="col-sm-12 form-control myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    /*foreach ($county_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"<?php if ($row->county == $key->id) echo "selected"; ?>><?php echo $key->county_name ?></option>
                                        <?php
                                    endforeach;*/
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <a class="btn ntn-u col-sm-1" style="padding-left:0" onClick="add_cocounty()" href="#" title="Add County"><span class="glyphicon glyphicon-plus-sign"></span></a>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Address 1 <span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="address1" id="address1" class="form-control input-sm" value="<?php echo ucwords($row->first_address) ?>" placeholder="Address 1 " data-toggle="tooltip" data-placement="bottom" title="Address 1 ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 2</label>
                        <div class="col-sm-8">
                            <input type="text" name="address2" id="address2" class="form-control input-sm" value="<?php echo ucwords($row->second_address) ?>" placeholder="Address 2" data-toggle="tooltip" data-placement="bottom" title="Address 2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">City</label>
                        <div class="col-sm-8">
                            <input type="text" name="city" id="city" class="form-control input-sm capitalize" value="<?php echo ucwords($row->city) ?>" placeholder="City" data-toggle="tooltip" data-placement="bottom" title="Tooltip for City">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Zip Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="zipcode" id="zipcode" class="form-control input-sm" value="<?php echo $row->zipcode ?>" placeholder="Zip Code" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Zip Code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label">SSN<span class="req"></label>
                        <div class="col-sm-8">
                            <label  id="ssnCodeDiv" style="font-size:14px; padding-top: 7px;"><?php echo $number = "XXX-XX-" . substr($this->Common_model->decrypt($row->ssn_code), -4); ?></label>
                            <?php if ($showSSNButton): ?>
                                <button style="float:right;" id="edit-employee-show-ssn-btn" data-id="<?php echo $row->id; ?>" type="button" class="btn btn-u">Show SSN</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Marital Status</label>
                        <div class="col-sm-8">
                            <select name="marital_status" id="marital_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $marital_status_array = $this->Common_model->get_array('marital_status');
                                foreach ($marital_status_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->marital_status == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select>          
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Gender</label>
                        <div class="col-sm-8">
                            <select name="gender" id="gender" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                $gender_array = $this->Common_model->get_array('gender');
                                foreach ($gender_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->gender == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Birthdate </label>
                        <div class="col-sm-8">
                            <input type="text" name="birthdate" id="birthdate" class="form-control input-sm" value="<?php echo $this->Common_model->show_date_formate($row->birthdate); ?>" placeholder="Birthdate" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Birthdate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">New Signature </label>
                        <div class="col-sm-8">
                             <?php
//                                if ($row->signature == "") {
//                                    $sigsrc = base_url() . "uploads/no-image.png";
//                                } else {
//                                    $sigsrc = base_url() . "uploads/emp_signature/" . $row->signature;
//                                }
                                ?>
<!--                                <div class="slim" style="background-image:url('<?php // echo base_url(); ?>uploads/no-image.png'); background-size: 100% 100%; " 
                                    data-label="Drop your Image"
                                    data-size="240,240"
                                    data-ratio="2:1">
                                    <img src="<?php // echo $sigsrc; ?>" alt=""/>
                                   <input type="file" name="signature[]" id="signature" required />
                               </div>-->
                            
                                <div id="signature"></div>
                                <input type="hidden" name="scanvasData" id="scanvasData" value="<?php echo $row->emp_signature; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Previous Signature </label>
                        <div class="col-sm-8">
                            <img id="show_signature" src="<?php echo $row->emp_signature; ?>" alt=""/>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <div class="box pull-right" style="height:150px; width:145px;" >
                                <?php
//                                if ($row->image_name == "") {
//                                    $src = base_url() . "uploads/blank.png";
//                                } else {
//                                    $src = base_url() . "uploads/emp_image/" . $row->image_name;
//                                }
                                ?>
                                <div class="slim" style=" background-size:150px 145px;"
                                     data-size="240,240" data-ratio="1:1">
                                    <?php 
                                    if ($row->image_name != "") {
                                    ?>
                                     <img src="<?php echo base_url() . "uploads/emp_image/" . $row->image_name; ?>" alt=""/>
                                     <?php 
                                    }
                                    ?>
                                    <input type="file" name="slim[]" id="image_name" required />
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Position<span class="req"/></label>
                        <div class="col-sm-8">
                            <select name="position" id="position" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($positions_query->result() as $key): ?>
                                    <option value="<?php echo $key->positionname ?>"<?php if ($row->position == $key->positionname) echo "selected"; ?>><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Home Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="home_phone" id="home_phone" class="form-control input-sm" value="<?php echo $row->home_phone ?>" placeholder="Home Phone" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Home Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Mobile Phone <span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control input-sm" value="<?php echo $row->mobile_phone ?>" placeholder="Mobile Phone" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Mobile Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Work Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="work_phone" id="work_phone" class="form-control input-sm" value="<?php echo $row->work_phone ?>" placeholder="Work Phone" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Work Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Card No </label>
                        <div class="col-sm-8">
                            <input type="text" name="card_no" id="card_no" value="<?php echo $row->card_no ?>" class="form-control input-sm" placeholder="Card No" data-toggle="tooltip" data-placement="bottom" title="Card No">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Ext</label>
                        <div class="col-sm-8">
                            <input type="text" name="ext" id="ext" class="form-control input-sm" value="<?php echo $row->ext ?>" placeholder="Ext" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Ext">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email <span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="email" name="email" id="email" class="form-control input-sm" value="<?php echo $row->email ?>" placeholder="Email" data-toggle="tooltip" data-placement="bottom" title="Tooltip for Email">
                        </div>
                    </div>
                    <?php
                    if ($row->isactive == 0) {
                        $ronly = "readonly";
                        $dt_pick="";
                    } else {
                        $ronly = "";
                        $dt_pick="dt_pick";
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Hire Date<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="hire_date" id="hire_date" class="form-control input-sm <?php echo $dt_pick; ?>" value="<?php echo $this->Common_model->show_date_formate($row->hire_date); ?>" placeholder="Hire Date" <?php echo $ronly; ?>  >
                        </div>
                    </div>
                    <?php
                    if ($row->isactive == 0) {
                       ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Rehire Date </label>
                            <div class="col-sm-8">
                                <input type="text" name="rehire_date" id="rehire_date" class="form-control input-sm dt_pick " value="<?php echo $this->Common_model->show_date_formate($row->rehire_date); ?>" placeholder="Rehire Date" >
                            </div>
                        </div>
                    <?php
                    } 
                    ?>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Introductory Period</label>
                        <div class="col-sm-8">
                            <input type="text" name="probation_days" id="probation_days" class="form-control input-sm" onkeypress="return numbersonly(this, event)" onblur="get_probation_start(this.value)" value="<?php echo $row->probation_days ?>" placeholder="Introductory Period"  title="Tooltip for Introductory Period">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Introductory Period End</label>
                        <div class="col-sm-8">
                            <input type="text" name="probation_start" id="probation_start" class="form-control dt_pick input-sm" value="<?php
                            if ($this->Common_model->show_date_formate($row->probation_start_date) == "00-00-0000") {
                                echo "";
                            } else {
                                echo $this->Common_model->show_date_formate($row->probation_start_date);
                            }
                            ?>" placeholder="Probation Start" onchange="get_days(this.value)" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Review Date</label>
                        <div class="col-sm-8">
                            <input type="text" name="review_date" id="review_date" class="form-control dt_pick input-sm" value="<?php if($row->review_date!="0000-00-00") { echo $this->Common_model->show_date_formate($row->review_date); } ?>" placeholder="Review Date" data-toggle="tooltip" data-placement="bottom" title="Review Date" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Termination Date</label>
                        <div class="col-sm-8">
                            <input type="text" name="termination_date" id="termination_date" class="form-control dt_pick input-sm" value="<?php if($row->termination_date!="0000-00-00") { echo $this->Common_model->show_date_formate($row->termination_date); } ?>" placeholder="Termination Date" data-toggle="tooltip" data-placement="bottom" title="Termination Date" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Transportation</label>
                        <div class="col-sm-8">
                            <select name="transportation" id="transportation" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                $yes_no_array = $this->Common_model->get_array('yes_no');
                                foreach ($yes_no_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->transportation == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Status </label>
                        <div class="col-sm-8">
                            <select name="status" id="status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                $status_array = $this->Common_model->get_array('status');
                                foreach ($status_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->isactive == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Contact Via Email</label>
                        <div class="col-sm-8">
                            <select name="contact_via_email" id="contact_via_email" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                $yes_no_array = $this->Common_model->get_array('yes_no');
                                foreach ($yes_no_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->contact_via_email == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Contact Via Text</label>
                        <div class="col-sm-8">
                            <select name="contact_via_text" id="contact_via_text" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                $yes_no_array = $this->Common_model->get_array('yes_no');
                                foreach ($yes_no_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->contact_via_text == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div>

                </div>

                <div class="col-sm-12">
                    <div class="modal-footer">
                        <!--<button type="button" id="pass_gen_id" class="btn btn-u" onclick="generate_emp_password()" > Password </button>-->
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employees/index/1" ?>">Close</a>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </form>
    <?php
}
?>


<!-- Modal -->
<div class="modal fade" id="cocounty_Modal_entry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add languages</h4>
            </div>
            <form id="add_cocounty_entry" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
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


<!-- Modal -->
<div class="modal fade" id="image_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Image</h4>
            </div>
            <form id="emp_image" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_languages"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Image </label>
                        <div class="col-sm-8">
                            <input type="file" name="emp_profile_pic" id="emp_profile_pic" size="20" />
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


<!-- Modal -->
<!--<div class="modal fade" id="emp_password_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Generate Password</h4>
            </div>
            <form id="emp_password_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="emp_id" id="emp_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label ">User Password</label>
                        <div class="col-sm-6">
                            <input type="password" name="emp_password" id="emp_password" class="form-control input-sm" placeholder="User Password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Confirm Password</label>
                        <div class="col-sm-6">
                            <input type="password" name="emp_confirm_password" id="emp_confirm_password" class="form-control input-sm" placeholder="Confirm Password" />
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
</div>-->

<!-- show SSN Code modal starts -->
<div class="modal fade" id="ssn_code_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">SSN Code</h4>
            </div>
            <form id="show_ssn_code_form" name="sky-form11" class="form-horizontal" action="" method="post" role="form">
                <div class="modal-body">
                    <div id="show_ssn_code_form_div">
                        <div class="form-group">
                        <div class="col-sm-6">
                                <input id="showSSNCodeEmployeeId" type="hidden" name="employee_id" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> Password <span class="req"></label>
                            <div class="col-sm-7">
                                <input id="txt-show-ssn-code-password" type="password" name="user_password" class="form-control input-sm" placeholder="User Password" />
                                <div id="show-ssn-code-form-password-error" class="required"></div>
                            </div>
                        </div>
                    </div>

                    <div id="ssn-code-div" style="display: none;">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Employee Code:</label>
                            <div class="col-sm-6 show-ssn-code-result-div">
                                <label id="employeeCodeLabel"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Employee Name:</label>
                            <div class="col-sm-6 show-ssn-code-result-div">
                                <label id="employeeNameLabel"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">SSN Code:</label>
                            <div class="col-sm-6 show-ssn-code-result-div">
                                <input id="txt_emp_edit_modal_ssn_code" type="text" name="ssn_code" class="form-control input-sm" placeholder="SSN Code" />
                                <div id="emp-edit-ssn-code-error" class="required"></div>
                            </div>
                        </div>

                        <div id="modal-update-ssn-code-alert" class="alert text-center alert-success" role="alert" style="display: none;">Test alert</div>
                    </div>

                    <div class="modal-footer">
                        <button id="btnModalShowSSNCode" type="button" class="btn btn-u">Show</button>
                        <button id="btnUpdateSSNCode" type="button" class="btn btn-u">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Close </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- show SSN Code modal ends -->

<script type="text/javascript">

    var save_method; //for save method string
    var table;
    function add_upload()
    {
        save_method = 'add';
        $('#emp_image')[0].reset(); // reset form on modals
        $('#image_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Upload Image'); // Set Title to Bootstrap modal title
    }

    $("#position").select2({
        placeholder: "Select Position",
        allowClear: true,
    });

    $("#county").select2({
        placeholder: "Select County",
        allowClear: true,
    });

    $("#state").select2({
        placeholder: "Select State",
        allowClear: true,
    });

    $("#marital_status").select2({
        placeholder: "Select Marital Status",
        allowClear: true,
    });

    $("#gender").select2({
        placeholder: "Select Gender",
        allowClear: true,
    });

    $("#transportation").select2({
        placeholder: "Select Transportation",
        allowClear: true,
    });

    $("#status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });

    $("#contact_via_email").select2({
        placeholder: "Select",
        allowClear: true,
    });

    $("#contact_via_text").select2({
        placeholder: "Select",
        allowClear: true,
    });

    $(function () {
        $("#zipcode").mask("99999");
        $("#ssn_code").mask("999-99-9999");
        $("#txt_emp_edit_modal_ssn_code").mask("999-99-9999");
        //$("#ssn_code").mask("***-**-****");
        $("#home_phone").mask("(999) 999-9999");
        $("#mobile_phone").mask("(999) 999-9999");
        $("#work_phone").mask("(999) 999-9999");
        $("#ext").mask("999999");
    });


    function add_cocounty()
    {
        save_method = 'add';
        $('#add_cocounty_entry')[0].reset(); // reset form on modals
        $('#cocounty_Modal_entry').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add County'); // Set Title to Bootstrap modal title
    }

    $(function () {
        $("#add_cocounty_entry").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_County_Settings/save_County_Settings') ?>";
            }
            $.ajax({
                url: url,
                data: $("#add_cocounty_entry").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '';
                view_message(data, url, 'cocounty_Modal_entry', 'add_cocounty_entry');

                $("#cocounty_div").load(location.href + " #cocounty_div");

                setTimeout(function () {

                    $("#county").select2({
                        placeholder: "Select County",
                        allowClear: true,
                    });

                }, 1000);


            });
            event.preventDefault();
        });
    });

    function get_days(dob){
        if (dob != "")
        {
            var from_datea = dob;
            var dates = from_datea.split('-');
            var date1 = new Date(dates[2] + '-' + dates[0] + '-' + dates[1]);
            //var date1 = new Date(from_datea);

            var to_datea = new Date();
            var twoDigitMonth = ((to_datea.getMonth().length+1) === 1)? (to_datea.getMonth()+1) : '0' + (to_datea.getMonth()+1);
            var currentDate = twoDigitMonth + "-" + to_datea.getDate() + "-" + to_datea.getFullYear();
            var datess = currentDate.split('-');
            var date2 = new Date(datess[2] + '-' + datess[0] + '-' + datess[1]);
            //var date2 = new Date(to_datea);

            var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            var diffDays = Math.abs((date1.getTime() - date2.getTime()) / (oneDay));
            //alert(diffDays);
            var DAYS = parseInt(diffDays + 1);
            if (DAYS)
            {
                $('#probation_days').val(DAYS);
            }
        }
    }
    
    function get_probation_start(days){
        var probation_start=add_days(-days);
        $('#probation_start').val(probation_start);
    }
    
    function load_county(id) {
//        alert(id);
        $.ajax({
            url: "<?php echo site_url('con_Employees/load_county_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#county').html('');
                $('#county').empty();

                $('#county').html(data);
            }
        });
    }

    $(document).ready(function() {
        $("#signature").jSignature({'UndoButton':true});
        $('.jSignature').attr('id', 'jSignature');
    })
    
    function generate_emp_password()
    {
        var employee_id=$('#id').val();
        if(employee_id=="")
        {
            alert ("Employee not created yet.");
            return;
        }
        
        save_method = 'add';
        $('#emp_password_form')[0].reset(); // reset form on modals
        $('#emp_password_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Generate Password'); // Set Title to Bootstrap modal title
        
        $('#emp_id').val(employee_id);
    }
    
    $(function () {
        $("#emp_password_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employees/save_emp_password') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Employees/save_emp_password') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_password_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '';
                view_message(data, url, 'emp_password_Modal', 'emp_password_form');
                
            });
            event.preventDefault();
        });
    });
    
    $(document).ready(function() {
    
        if($('#id').val()=="")
        {
            $('#pass_gen_id').prop("disabled", true);
        }
        
    })
    
    /* SSN Code */
    $(document).on("click", "#edit-employee-show-ssn-btn", function() {
        $("#ssn-code-div").hide();
        $("#btnModalShowSSNCode").show();
        $("#btnUpdateSSNCode").hide();
        $("#show_ssn_code_form_div").show();
        $("#txt_emp_edit_modal_ssn_code").removeClass("txt-error-border-color");
        $("#emp-edit-ssn-code-error").hide();
        $("#show-ssn-code-form-password-error").html("").hide();
        $("#txt-show-ssn-code-password").removeClass("txt-error-border-color");

        $('#show_ssn_code_form')[0].reset(); // reset form on modals

        var employeeId = $(this).data('id');
        $("#showSSNCodeEmployeeId").val(employeeId);
        $('.modal-title').text('SSN Code');

        $('#ssn_code_modal').modal('show'); // show bootstrap modal
    });

    $(document).on("click", "#btnModalShowSSNCode", function() {
        $("#ssn-code-div").hide();
        $("#show_ssn_code_form_div").show();
        $("#btnUpdateSSNCode").hide();
        $("#show-ssn-code-form-password-error").html("").hide();
        $("#txt-show-ssn-code-password").removeClass("txt-error-border-color");

        if (!$.trim($("#txt-show-ssn-code-password").val())) {
            $("#txt-show-ssn-code-password").addClass("txt-error-border-color");
            $("#show-ssn-code-form-password-error").html("Password cannot be blank").show();
            return;
        }

        $.ajax({
            url: "<?php echo site_url('Con_Employee_Profile/get_ssn_code') ?>",
            data: $('#show_ssn_code_form').serialize(),
            type: "POST",
            dataType: "JSON",
        }).done(function(data) {
            if (data.success) {
                $("#btnModalShowSSNCode").hide();
                $("#show_ssn_code_form_div").hide();
                $("#btnUpdateSSNCode").show();

                $("#employeeCodeLabel").html(data.employee_code);
                $("#employeeNameLabel").html(data.first_name);
                $("#txt_emp_edit_modal_ssn_code").val(data.ssn_code);
                $("#ssn-code-div").show();
            } else {
                $("#txt-show-ssn-code-password").addClass("txt-error-border-color");
                $("#show-ssn-code-form-password-error").html(data.msg).show();
            }
        });
        event.preventDefault();
    });

    $(document).on("click", "#btnUpdateSSNCode", function() {
        $("#txt_emp_edit_modal_ssn_code").removeClass("txt-error-border-color");
        $("#emp-edit-ssn-code-error").hide();
        $("#modal-update-ssn-code-alert").hide();

        $.ajax({
            url: "<?php echo site_url('Con_Employees/update_ssncode'); ?>",
            data: { "employee_id": $('#showSSNCodeEmployeeId').val(), "ssn_code": $("#txt_emp_edit_modal_ssn_code").val() },
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                // console.log(data.success);
                if (data.success) {
                    $("#modal-update-ssn-code-alert").removeClass("alert-error").addClass("alert-success").html(data.msg).show();
                    setTimeout(function() { 
                    //$("#modal-update-ssn-code-alert").removeClass("alert-success"); 
                    $("#modal-update-ssn-code-alert").hide(); 
                    $('#ssn_code_modal').modal('toggle');
                    }, 800);
                } else {
                    $("#txt_emp_edit_modal_ssn_code").addClass("txt-error-border-color");
                    $("#emp-edit-ssn-code-error").html(data.msg).show();
                }
                $("#ssnCodeDiv").load(location.href + " #ssnCodeDiv");
                
               
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Error get data from ajax');
            }
        });
        event.preventDefault();
    });
    /*  $('#btnUpdateSSNCode').click(function() {
    location.reload();
});  */
</script>