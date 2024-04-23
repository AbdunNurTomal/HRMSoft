<?php
$discipline_type_array = $this->db->get_where('main_disciplinetype', array('company_id' => $this->company_id));

$Row_Data = array();
if (($type == 2)) {
    $Row_Data = $query->row();
}
//pr($Row_Data);
?>

<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3">            
            <div class="col-md-12"><h2><?php echo ($type == 1) ? 'Add' : 'Edit'; ?> Accident</h2><br/></div>

            <form id="emp_accident_action" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">

                <div class="col-lg-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label"> Employee <span class="req"/> </label> 
                            <div class="col-sm-8">
                                <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    if ($this->user_group != 1 || $this->user_group != 2 || $this->user_group != 3) {
                                        $employees_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
                                    } else {
                                        $employees_query = $this->db->get_where('main_employees', array('isactive' => 1));
                                    }
                                    foreach ($employees_query->result() as $row) {
                                        $slct = (($type == 2) && ($Row_Data->employee_id == $row->employee_id)) ? 'selected' : '';
                                        print"<option value='" . $row->employee_id . "' " . $slct . ">" . $row->first_name . " " . $row->middle_name . " " . $row->last_name . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Type<span class="req"/></label>
                            <div class="col-sm-8">
                                <select name="acc_action_type" id="acc_action_type" onchange="change_acc_action(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <?php
                                    $action_type_array = $this->Common_model->get_array('accident_action_type');
                                    foreach ($action_type_array as $row => $val) {
                                        print"<option value='" . $row . "'>" . $val . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($type == 1) {//entry ?>
                    <input type="hidden" id="save_method" value="add" /> 

                    <div class="col-lg-12" id="acc_report_info">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Accident Date<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="accident_action_date" id="accident_action_date" class="form-control dt_pick input-sm" placeholder="Accident Date" data-toggle="tooltip" data-placement="bottom" title="Action Date" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Location<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="accident_location" id="accident_location" class="form-control input-sm" placeholder="Accident Location" data-toggle="tooltip" data-placement="top" title="Accident Location">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Accident Time</label>
                                <div class="col-sm-8">
                                    <input type="text" name="accident_time" id="accident_time" class="form-control input-sm" placeholder="Accident Time" data-toggle="tooltip" data-placement="top" title="Accident Time">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Any Witness?</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_acc_any_witness();" name="acc_any_witness" id="acc_any_witness" value="0">
                                </div>
                            </div>
                            <div id="acc-wit" class="form-group hidden">
                                <label class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_witness_name" id="acc_witness_name" class="form-control input-sm" placeholder="Accident Witness Name" data-toggle="tooltip" data-placement="top" title="Accident Witness Name">
                                </div>
                            </div>

                            <div id="acc-witt" class="form-group hidden">
                                <label class="col-sm-4 control-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_witness_phone" id="acc_witness_phone" class="form-control input-sm" placeholder="Accident Witness Phone" data-toggle="tooltip" data-placement="top" title="Accident Witness Phone">
                                </div>
                            </div>
                            <div id="acc-wittt" class="form-group hidden">
                                <label class="col-sm-4 control-label">Address</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_witness_address" id="acc_witness_address" class="form-control input-sm" rows="2" placeholder="Accident Witness Address" data-toggle="tooltip" data-placement="top" title="Accident Witness Address"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Reported to Supervisor? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_acc_report_supervisor();" name="acc_report_supervisor" id="acc_report_supervisor" value="0" />
                                </div>
                            </div>
                            <div id="accsup" class="form-group hidden">
                                <label class="col-sm-4 control-label">Date</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_supervisor_report_date" id="acc_supervisor_report_date" class="form-control dt_pick input-sm" placeholder="Date" data-toggle="tooltip" data-placement="bottom" title="Date" autocomplete="off">
                                </div>
                            </div>
                            <div id="accsupp" class="form-group hidden">
                                <label class="col-sm-4 control-label">Reported By</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_supervisor_reported_by" id="acc_supervisor_reported_by" class="form-control input-sm" placeholder="Reported By" data-toggle="tooltip" data-placement="top" title="Reported By">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Reported to HR? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_acc_report_hr();" name="acc_report_hr" id="acc_report_hr" value="0" />
                                </div>
                            </div>
                            <div id="acchr" class="form-group hidden">
                                <label class="col-sm-4 control-label">Date</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_hr_report_date" id="acc_hr_report_date" class="form-control dt_pick input-sm" placeholder="Date" data-toggle="tooltip" data-placement="bottom" title="Date" autocomplete="off">
                                </div>
                            </div>
                            <div id="acchrr" class="form-group hidden">
                                <label class="col-sm-4 control-label">Reported By</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_hr_reported_by" id="acc_hr_reported_by" class="form-control input-sm" placeholder="Reported By" data-toggle="tooltip" data-placement="top" title="Reported By">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_report_description" id="acc_report_description" class="form-control input-sm" rows="3" placeholder="Describe any conditions, methods or practices related to the accident" data-toggle="tooltip" data-placement="top" title="Describe any conditions, methods or practices related to the accident"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Employee Comments</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_employee_comments" id="acc_employee_comments" class="form-control input-sm" rows="2" placeholder="Employee Comments" data-toggle="tooltip" data-placement="top" title="Employee Comments"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">First Aid given?</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_first_aid_given();" name="first_aid_given" id="first_aid_given" value="0" />
                                </div>
                            </div>
                            <div id="firstAid" class="form-group hidden">
                                <label class="col-sm-4 control-label">By whom? </label>
                                <div class="col-sm-8">
                                    <input type="text" name="firstAid_by_whom" id="firstAid_by_whom" class="form-control input-sm" placeholder="Name of First Aid Provider" autocomplete="off">
                                </div>
                            </div>                                                
                            <div id="explain_first_aid" class="form-group hidden">
                                <label class="col-sm-4 control-label">Explain about First Aid given</label>
                                <div class="col-sm-8">
                                    <textarea name="explain_first_aid" id="explain_first_aid" class="form-control input-sm" rows="6" placeholder="Explain about First Aid given" data-toggle="tooltip" data-placement="top" title="Explain about First Aid given"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Medical Treatment? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_Medical_Treatment();" name="requires_hospitalization" id="requires_hospitalization" value="0" />
                                </div>
                            </div>
                            <div id="clname" class="form-group hidden">
                                <label class="col-sm-4 control-label">Clinic Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="clinic_name" id="clinic_name" class="form-control input-sm" placeholder="Clinic Name" data-toggle="tooltip" data-placement="top" title="Clinic Name">
                                </div>
                            </div>
                            <div id="phyname" class="form-group hidden">
                                <label class="col-sm-4 control-label">Physician</label>
                                <div class="col-sm-8">
                                    <input type="text" name="physician_name" id="physician_name" class="form-control input-sm" placeholder="Physician Name" data-toggle="tooltip" data-placement="top" title="Physician Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nature and extent of injuries</label>
                                <div class="col-sm-8">
                                    <textarea name="nature_of_injury" id="nature_of_injury" class="form-control input-sm" rows="3" placeholder="Nature and extent of injuries" data-toggle="tooltip" data-placement="top" title="Nature and extent of injuries"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Injury Type</label> 
                                <div class="col-sm-8">
                                    <select multiple name="injury_type[]" id="injury_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <?php
                                        $injury_type = $this->Common_model->get_array('type_of_injury');
                                        foreach ($injury_type as $row => $val) {
                                            print "<option value='" . $row . "'>" . $val . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Injured Body Parts</label> 
                                <div class="col-sm-8">
                                    <select multiple name="injured_body_parts[]" id="injured_body_parts" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <?php
                                        $injured_body_parts = $this->Common_model->get_array('bodypart_injurylist');
                                        foreach ($injured_body_parts as $row => $val) {
                                            print "<option value='" . $row . "'>" . $val . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Add Worker's Comp ? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_Worker_Comp();" name="any_benefit_provider" id="any_benefit_provider" value="0" />
                                </div>
                            </div>

                            <div id="provider_name_wrpp" class="form-group hidden">
                                <label class="col-sm-4 control-label">Provider's Name</label>
                                <div class="col-sm-8">
                                    <select name="benefit_provider_id" id="benefit_provider" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $benefit_provider = $this->db->get_where('main_benefits_provider', array('company_id' => $this->company_id))->result();
                                        foreach ($benefit_provider as $row) {
                                            print "<option value='" . $row->id . "' data-acc='" . $row->acc_number . "'>" . $row->service_provider_name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div id="benefit_account_wrpp" class="form-group hidden">
                                <label class="col-sm-4 control-label">Account</label>
                                <div class="col-sm-8">
                                    <input type="text" id="benefit_account" readonly disabled class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Benefit Account" autocomplete="off" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">How did the accident occur?</label>
                                <div class="col-sm-8">
                                    <textarea name="how_accident_occured" id="how_accident_occured" class="form-control input-sm" rows="3" placeholder="How did the accident occur?" data-toggle="tooltip" data-placement="top" title="How did the accident occur?"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Activity During Injury</label>
                                <div class="col-sm-8">
                                    <textarea name="activity_during_injury" id="activity_during_injury" class="form-control input-sm" rows="3" placeholder="Activity During Injury" data-toggle="tooltip" data-placement="top" title="Activity During Injury"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">        
                            <div class="form-group">
                                <h4 class="center-align"><i>Investigation Report (Confidential)</i></h4>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Details</label>
                                <div class="col-sm-8">
                                    <textarea name="detail_description" id="detail_description" class="form-control input-sm" rows="6" placeholder="Describe what employee was doing; what tools, equipment, structures, or fixtures were involved; and which witnesses saw it and what they reported" data-toggle="tooltip" data-placement="top" title="In Details"></textarea>
                                </div>
                            </div>                        
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Explain accident causes, especially if there were past problems</label>
                                <div class="col-sm-8">
                                    <textarea name="explain_accident_causes" id="explain_accident_causes" class="form-control input-sm" rows="6" placeholder="Explain accident causes, especially if there were past problems" data-toggle="tooltip" data-placement="top" title="Explain Accident Causes"></textarea>
                                </div>
                            </div>                        
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Measures to be taken in Future</label>
                                <div class="col-sm-8">
                                    <textarea name="measures_in_future" id="measures_in_future" class="form-control input-sm" rows="6" placeholder="What should be done, and by whom, to prevent recurrence of this type of accident in the future?" data-toggle="tooltip" data-placement="top" title="Measures to be taken in Future"></textarea>
                                </div>
                            </div>                        
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Comments by Department and/or Safety Manager</label>
                                <div class="col-sm-8">
                                    <textarea name="comments_by_dept" id="comments_by_dept" class="form-control input-sm" rows="6" placeholder="Comments by Department and/or Safety Manager" data-toggle="tooltip" data-placement="top" title="Comments by Department"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Upload Document<br/><span style="font-weight:normal;font-size:9px">( PDF, DOC, DOCX, XLSX )</span></label>
                                <div class="col-sm-8" style="padding-top:7px">
                                    <a href="#" onclick="add_action_image('A-D');" class="linkStyle" data-toggle="tooltip" title="Upload Document">
                                        <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                    </a>
                                    <input type="text" class="A-D doc_name" name="action_document_path" id="action_document_path" value="" />
                                </div>
                            </div>                    
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Upload Image<br/><span style="font-weight:normal;font-size:9px">( JPG, JPEG, PNG )</span></label>
                                <div class="col-sm-8" style="padding-top:7px">
                                    <a href="#" onclick="add_action_image('A-P');" class="linkStyle" data-toggle="tooltip" title="Upload Photo">
                                        <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                    </a>
                                    <input type="hidden" class="A-P" name="action_image_path" id="action_image_path" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">&nbsp;</label>
                                <div class="col-sm-8">
                                    <img id="temp_accident_img" class="A-P" style="max-width:100%" src="<?php echo site_url('uploads/no-image.png'); ?>" alt="No Image Available" /> 
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-lg-12 hidden" id="acc_discipline_info">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Discipline Type <span class="req"/> </label>
                                <div class="col-sm-7">
                                    <select name="acc_discipline_type" id="acc_discipline_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($discipline_type_array->result() as $roww) {
                                            print"<option value='" . $roww->id . "'>" . $roww->discipline_type . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-5 control-label">Verbal Warning By</label>
                                <div class="col-sm-7">
                                    <input type="text" name="acc_verbal_warning_by" id="acc_verbal_warning_by" class="form-control input-sm" placeholder="Verbal Warning By" data-toggle="tooltip" data-placement="top" title="Verbal Warning By">
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-5 control-label">Written Warning By</label>
                                <div class="col-sm-7">
                                    <input type="text" name="acc_written_warning_by" id="acc_written_warning_by" class="form-control input-sm" placeholder="Written Warning By" data-toggle="tooltip" data-placement="top" title="Written Warning By">
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-5 control-label">Counseled By</label>
                                <div class="col-sm-7">
                                    <input type="text" name="acc_counseled_by" id="acc_counseled_by" class="form-control input-sm" placeholder="Counseled By" data-toggle="tooltip" data-placement="top" title="Counseled By">
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-5 control-label">Suspended From</label>
                                <div class="col-sm-7">
                                    <input type="text" name="acc_suspended_from" id="acc_suspended_from" class="form-control dt_pick input-sm" placeholder="Suspended From" data-toggle="tooltip" data-placement="top" title="Suspended From" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Suspended To</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_suspended_to" id="acc_suspended_to" class="form-control dt_pick input-sm" placeholder="Suspended To" data-toggle="tooltip" data-placement="top" title="Suspended To" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Subject</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_subject" id="acc_subject" class="form-control input-sm" placeholder="Subject" data-toggle="tooltip" data-placement="top" title="Subject">
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_description" id="acc_description" class="form-control input-sm" rows="1" placeholder="Description" data-toggle="tooltip" data-placement="top" title="Description"></textarea>                        
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Improvement Plan</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_improvement_plan" id="acc_improvement_plan" class="form-control input-sm" rows="1" placeholder="Improvement Plan" data-toggle="tooltip" data-placement="top" title="Improvement Plan"></textarea>                        
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Further Actions</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_further_actions" id="acc_further_actions" class="form-control input-sm" rows="1" placeholder="Further Actions" data-toggle="tooltip" data-placement="top" title="Further Actions"></textarea>                        
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>    

                    <div class="col-lg-12">
                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                        </div>
                    </div>

                    <?php
                } else if ($type == 2) {//edit
                    ?>
                    <input type="hidden" name="id_emp_accident" value="<?php echo $Row_Data->id; ?>" />
                    <input type="hidden" id="save_method" value="edit" /> 

                    <div class="col-lg-12" id="acc_report_info">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Accident Date<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="accident_action_date" id="accident_action_date" value="<?php echo $this->Common_model->show_date_formate($Row_Data->action_date); ?>" class="form-control dt_pick input-sm" placeholder="Accident Date" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Location<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="accident_location" id="accident_location" value="<?php echo $Row_Data->accident_location; ?>" class="form-control input-sm" placeholder="Accident Location" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Accident Time</label>
                                <div class="col-sm-8">
                                    <input type="text" name="accident_time" id="accident_time" class="form-control input-sm" value="<?php echo $Row_Data->accident_time; ?>" placeholder="Accident Time" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Any Witness?</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_acc_any_witness();" name="acc_any_witness" id="acc_any_witness" value="<?php echo ($Row_Data->any_witness == 1) ? 1 : 0; ?>" <?php echo ($Row_Data->any_witness == 1) ? 'checked' : ''; ?> />
                                </div>
                            </div>
                            <div id="acc-wit" class="form-group <?php echo ($Row_Data->any_witness == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_witness_name" id="acc_witness_name" class="form-control input-sm" value="<?php echo $Row_Data->accident_witness; ?>" placeholder="Accident Witness Name" />
                                </div>
                            </div>

                            <div id="acc-witt" class="form-group <?php echo ($Row_Data->any_witness == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_witness_phone" id="acc_witness_phone" class="form-control input-sm" value="<?php echo $Row_Data->accident_witness_phone; ?>" placeholder="Accident Witness Phone" />
                                </div>
                            </div>
                            <div id="acc-wittt" class="form-group <?php echo ($Row_Data->any_witness == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Address</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_witness_address" id="acc_witness_address" class="form-control input-sm" rows="2" placeholder="Accident Witness Address"><?php echo $Row_Data->accident_witness_address; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Reported to Supervisor? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_acc_report_supervisor();" name="acc_report_supervisor" id="acc_report_supervisor" value="<?php echo ($Row_Data->report_supervisor == 1) ? 1 : 0; ?>" <?php echo ($Row_Data->report_supervisor == 1) ? 'checked' : ''; ?> />     
                                </div>
                            </div>
                            <div id="accsup" class="form-group <?php echo ($Row_Data->report_supervisor == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Date</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_supervisor_report_date" id="acc_supervisor_report_date" value="<?php echo $this->Common_model->show_date_formate($Row_Data->supervisor_report_date); ?>" class="form-control dt_pick input-sm" autocomplete="off" />
                                </div>
                            </div>
                            <div id="accsupp" class="form-group <?php echo ($Row_Data->report_supervisor == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Reported By</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_supervisor_reported_by" id="acc_supervisor_reported_by" value="<?php echo $Row_Data->supervisor_reported_by; ?>" class="form-control input-sm" title="Reported By" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Reported to HR? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_acc_report_hr();" name="acc_report_hr" id="acc_report_hr" value="<?php echo ($Row_Data->report_hr == 1) ? 1 : 0; ?>" <?php echo ($Row_Data->report_hr == 1) ? 'checked' : ''; ?> />
                                </div>
                            </div>
                            <div id="acchr" class="form-group <?php echo ($Row_Data->report_hr == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Date</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_hr_report_date" id="acc_hr_report_date" value="<?php echo $Row_Data->hr_report_date; ?>" class="form-control dt_pick input-sm" autocomplete="off">
                                </div>
                            </div>
                            <div id="acchrr" class="form-group <?php echo ($Row_Data->report_hr == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Reported By</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_hr_reported_by" id="acc_hr_reported_by" value="<?php echo $Row_Data->hr_reported_by; ?>" class="form-control input-sm" placeholder="Reported By" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_report_description" id="acc_report_description" class="form-control input-sm" rows="3" placeholder="Describe any conditions, methods or practices related to the accident" ><?php echo $Row_Data->report_description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Employee Comments</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_employee_comments" id="acc_employee_comments" class="form-control input-sm" rows="2" placeholder="Employee Comments"><?php echo $Row_Data->employee_comments; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">First Aid given?</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_first_aid_given();" name="first_aid_given" id="first_aid_given" value="<?php echo ($Row_Data->first_aid_given == 1) ? 1 : 0; ?>" <?php echo ($Row_Data->first_aid_given == 1) ? 'checked' : ''; ?> />
                                </div>
                            </div>
                            <div id="firstAid" class="form-group  <?php echo ($Row_Data->first_aid_given == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">By whom? </label>
                                <div class="col-sm-8">
                                    <input type="text" name="firstAid_by_whom" id="firstAid_by_whom" value="<?php echo $Row_Data->firstAid_by_whom; ?>" class="form-control input-sm" placeholder="Name of First Aid Provider" autocomplete="off">
                                </div>
                            </div>                                                
                            <div id="explain_first_aid" class="form-group hidden">
                                <label class="col-sm-4 control-label">Explain about First Aid given</label>
                                <div class="col-sm-8">
                                    <textarea name="explain_first_aid" id="explain_first_aid" value="<?php echo $Row_Data->explain_first_aid; ?>" class="form-control input-sm" rows="6" placeholder="Explain about First Aid given" data-toggle="tooltip" data-placement="top" title="Explain about First Aid given"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Medical Treatment? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_Medical_Treatment();" name="requires_hospitalization" id="requires_hospitalization" value="<?php echo ($Row_Data->requires_hospitalization == 1) ? 1 : 0; ?>" <?php echo ($Row_Data->requires_hospitalization == 1) ? 'checked' : ''; ?> />
                                </div>
                            </div>
                            <div id="clname" class="form-group <?php echo ($Row_Data->requires_hospitalization == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Clinic Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="clinic_name" id="clinic_name" value="<?php echo $Row_Data->clinic_name; ?>" class="form-control input-sm" placeholder="Clinic Name" />
                                </div>
                            </div>
                            <div id="phyname" class="form-group <?php echo ($Row_Data->requires_hospitalization == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Physician</label>
                                <div class="col-sm-8">
                                    <input type="text" name="physician_name" id="physician_name" value="<?php echo $Row_Data->physician_name; ?>" class="form-control input-sm" placeholder="Physician Name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Nature and extent of injuries</label>
                                <div class="col-sm-8">
                                    <textarea name="nature_of_injury" id="nature_of_injury" class="form-control input-sm" rows="3" placeholder="Nature and extent of injuries"><?php echo $Row_Data->nature_of_injury; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Injury Type</label> 
                                <div class="col-sm-8">
                                    <select multiple name="injury_type[]" id="injury_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <?php
                                        $injury_type = $this->Common_model->get_array('type_of_injury');

                                        $injType = explode(',', $Row_Data->injury_type);
                                        foreach ($injury_type as $row => $val) {
                                            $slct = (in_array($row, $injType)) ? 'selected' : '';
                                            print "<option value='" . $row . "' " . $slct . ">" . $val . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Injured Body Parts</label> 
                                <div class="col-sm-8">
                                    <select multiple name="injured_body_parts[]" id="injured_body_parts" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <?php
                                        $injured_body_parts = $this->Common_model->get_array('bodypart_injurylist');

                                        $injBodyParts = explode(',', $Row_Data->injured_body_parts);
                                        foreach ($injured_body_parts as $row => $val) {
                                            $slct = (in_array($row, $injBodyParts)) ? 'selected' : '';
                                            print "<option value='" . $row . "' " . $slct . ">" . $val . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Add Worker's Comp ? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_Worker_Comp();" name="any_benefit_provider" id="any_benefit_provider" value=" <?php echo ($Row_Data->any_benefit_provider == 1) ? 1 : 0; ?>" <?php echo ($Row_Data->any_benefit_provider == 1) ? 'checked' : ''; ?> />
                                </div>
                            </div>

                            <div id="provider_name_wrpp" class="form-group <?php echo ($Row_Data->any_benefit_provider == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Provider's Name</label>
                                <div class="col-sm-8">
                                    <select name="benefit_provider_id" id="benefit_provider" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        $benefit_provider = $this->db->get_where('main_benefits_provider', array('company_id' => $this->company_id))->result();
                                        foreach ($benefit_provider as $row) {
                                            $slct = ($Row_Data->benefit_provider == $row->id) ? 'selected' : '';
                                            print "<option value='" . $row->id . "' data-acc='" . $row->acc_number . "' " . $slct . ">" . $row->service_provider_name . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <script type="text/javascript">
                                        $(window).load(function () {
                                            var AccNum = $('select#benefit_provider option:selected').attr('data-acc');
                                            $('input#benefit_account').val(AccNum);
                                        });
                                    </script>
                                </div>
                            </div>

                            <div id="benefit_account_wrpp" class="form-group <?php echo ($Row_Data->any_benefit_provider == 1) ? '' : 'hidden'; ?>">
                                <label class="col-sm-4 control-label">Account</label>
                                <div class="col-sm-8">
                                    <input type="text" id="benefit_account" readonly disabled class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Benefit Account" autocomplete="off" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">How did the accident occur?</label>
                                <div class="col-sm-8">
                                    <textarea name="how_accident_occured" id="how_accident_occured" class="form-control input-sm" rows="3" placeholder="How did the accident occur?"><?php echo $Row_Data->how_accident_occured; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Activity During Injury</label>
                                <div class="col-sm-8">
                                    <textarea name="activity_during_injury" id="activity_during_injury" class="form-control input-sm" rows="3" placeholder="Activity During Injury"><?php echo $Row_Data->activity_during_injury; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">        
                            <div class="form-group">
                                <h4 class="center-align"><i>Investigation Report (Confidential)</i></h4>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Details</label>
                                <div class="col-sm-8">
                                    <textarea name="detail_description" id="detail_description" class="form-control input-sm" rows="6" placeholder="Describe what employee was doing; what tools, equipment, structures, or fixtures were involved; and which witnesses saw it and what they reported"><?php echo $Row_Data->detail_description; ?></textarea>
                                </div>
                            </div>                        
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Explain accident causes, especially if there were past problems</label>
                                <div class="col-sm-8">
                                    <textarea name="explain_accident_causes" id="explain_accident_causes" class="form-control input-sm" rows="6" placeholder="Explain accident causes, especially if there were past problems" ><?php echo $Row_Data->explain_accident_causes; ?></textarea>
                                </div>
                            </div>                        
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Measures to be taken in Future</label>
                                <div class="col-sm-8">
                                    <textarea name="measures_in_future" id="measures_in_future" class="form-control input-sm" rows="6" placeholder="What should be done, and by whom, to prevent recurrence of this type of accident in the future?"><?php echo $Row_Data->measures_in_future; ?></textarea>
                                </div>
                            </div>                        
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Comments by Department and/or Safety Manager</label>
                                <div class="col-sm-8">
                                    <textarea name="comments_by_dept" id="comments_by_dept" class="form-control input-sm" rows="6" placeholder="Comments by Department and/or Safety Manager"><?php echo $Row_Data->comments_by_dept; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Upload Document<br/><span style="font-weight:normal;font-size:9px">( PDF, DOC, DOCX, XLSX )</span></label>
                                <div class="col-sm-8" style="padding-top:7px">
                                    <a href="#" onclick="add_action_image('A-D');" class="linkStyle" data-toggle="tooltip" title="Upload Document">
                                        <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                    </a>
                                    <input type="text" class="A-D doc_name" name="action_document_path" id="action_document_path" value="<?php echo $Row_Data->document_path; ?>" />
                                    <?php
                                    if ($Row_Data->document_path != '') {
                                        $IMG_PATH = Get_File_Directory('uploads/action_document/' . $Row_Data->document_path);
                                        if (file_exists($IMG_PATH)) {
                                            ?><a class="btn btn-xs btn-info" target="_blank" href="<?php echo site_url('uploads/action_document/' . $Row_Data->document_path); ?>" title="Download this File"><i class="fa fa-download"></i></a> <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>                    
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Upload Image<br/><span style="font-weight:normal;font-size:9px">( JPG, JPEG, PNG )</span></label>
                                <div class="col-sm-8" style="padding-top:7px">
                                    <a href="#" onclick="add_action_image('A-P');" class="linkStyle" data-toggle="tooltip" title="Upload Photo">
                                        <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                    </a>
                                    <input type="hidden" class="A-P" name="action_image_path" id="action_image_path" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">&nbsp;</label>
                                <div class="col-sm-8">
                                    <?php
                                    if ($Row_Data->image_path != '') {
                                        $IMG_PATH = Get_File_Directory('uploads/action_image/' . $Row_Data->image_path);
                                        if (file_exists($IMG_PATH)) {
                                            ?><img id="temp_accident_img" class="A-P" style="max-width:100%" src="<?php echo site_url('uploads/action_image/' . $Row_Data->image_path); ?>" alt="No Image Available" /> <?php
                                        }
                                    } else {
                                        ?><img id="temp_accident_img" class="A-P" style="max-width:100%" src="<?php echo site_url('uploads/no-image.png'); ?>" alt="No Image Available" /> <?php
                                    }
                                    ?>                                    
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-lg-12 hidden" id="acc_discipline_info">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Discipline Type <span class="req"/> </label>
                                <div class="col-sm-7">
                                    <select name="acc_discipline_type" id="acc_discipline_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($discipline_type_array->result() as $roww) {
                                            $slct = ($Row_Data->discipline_type == $roww->id) ? 'selected' : '';
                                            print"<option value='" . $roww->id . "' " . $slct . ">" . $roww->discipline_type . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-5 control-label">Verbal Warning By</label>
                                <div class="col-sm-7">
                                    <input type="text" name="acc_verbal_warning_by" value="<?php echo $Row_Data->verbal_warning_by; ?>" id="acc_verbal_warning_by" class="form-control input-sm" placeholder="Verbal Warning By" />
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-5 control-label">Written Warning By</label>
                                <div class="col-sm-7">
                                    <input type="text" name="acc_written_warning_by" value="<?php echo $Row_Data->written_warning_by; ?>" id="acc_written_warning_by" class="form-control input-sm" placeholder="Written Warning By" />
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-5 control-label">Counseled By</label>
                                <div class="col-sm-7">
                                    <input type="text" name="acc_counseled_by" value="<?php echo $Row_Data->counseled_by; ?>" id="acc_counseled_by" class="form-control input-sm" placeholder="Counseled By" />
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-5 control-label">Suspended From</label>
                                <div class="col-sm-7">
                                    <input type="text" name="acc_suspended_from" value="<?php echo $this->Common_model->show_date_formate($Row_Data->suspended_from); ?>" id="acc_suspended_from" class="form-control dt_pick input-sm" placeholder="Suspended From" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Suspended To</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_suspended_to" value="<?php echo $this->Common_model->show_date_formate($Row_Data->suspended_to); ?>" id="acc_suspended_to" class="form-control dt_pick input-sm" placeholder="Suspended To" data-toggle="tooltip" data-placement="top" title="Suspended To" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Subject</label>
                                <div class="col-sm-8">
                                    <input type="text" name="acc_subject" value="<?php echo $Row_Data->subject; ?>" id="acc_subject" class="form-control input-sm" placeholder="Subject" data-toggle="tooltip" data-placement="top" title="Subject">
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_description" id="acc_description" class="form-control input-sm" rows="1" placeholder="Description"><?php echo $Row_Data->description; ?></textarea>                        
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Improvement Plan</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_improvement_plan" id="acc_improvement_plan" class="form-control input-sm" rows="1" placeholder="Improvement Plan"><?php echo $Row_Data->improvement_plan; ?></textarea>                        
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label class="col-sm-4 control-label">Further Actions</label>
                                <div class="col-sm-8">
                                    <textarea name="acc_further_actions" id="acc_further_actions" class="form-control input-sm" rows="1" placeholder="Further Actions"><?php echo $Row_Data->further_actions; ?></textarea>                        
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>    

                    <div class="col-lg-12">
                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u">Update</button>
                        </div>
                    </div>
                <?php } ?>
            </form>
        </div><!-- end container well div -->
    </div>
</div>

<!-- Follow-up Modal -->
<div class="modal fade" id="Obs_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Action Follow-up</h4>
            </div>
            <form id="observation_action" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" name="obs_action_id" value="" />
                <input type="hidden" name="obs_action_type" value="" />

                <div class="modal-body" id="observation_action_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-6"> 
                                <label class="col-sm-4 control-label">Follow-up Date<span class="req"/></label>
                                <div class="col-sm-8">   
                                    <input type="text" name="Observation_Date" id="Observation_Date" class="form-control dt_pick input-sm req-field" placeholder="Follow-up Date" data-toggle="tooltip" data-placement="bottom" title="Follow-up Date" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">Start Time<span class="req"/></label>
                                <div class="col-sm-8">
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input type="text" name="Start_Time" id="Start_Time" class="form-control time_pick input-sm" placeholder="Start Time" data-toggle="tooltip" data-placement="bottom" title="Start Time" autocomplete="off">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">End Time<span class="req"/></label>
                                <div class="col-sm-8">
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input type="text" name="End_Time" id="End_Time" class="form-control time_pick input-sm" placeholder="End Time" data-toggle="tooltip" data-placement="bottom" title="End Time" autocomplete="off">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>                                
                                </div>
                            </div>                    
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">Next Follow-up Date<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="Next_Follow_Date" id="Next_Follow_Date" class="form-control dt_pick input-sm" placeholder="Next Follow-up Date" data-toggle="tooltip" data-placement="bottom" title="Next Follow-up Date" autocomplete="off">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">Action<span class="req"/></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="Action" id="Action" placeholder="Action"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="Description" id="Description" placeholder="Description"></textarea>
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-body" id="observation_action_list">
                    <div class="overflow-x">
                        <table class="table table-striped ObsActionList">
                            <thead>
                                <tr>
                                    <th>Sl. no.</th>
                                    <th>Follow-up Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Next Follow-up Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-------- Ajax Data Here -------->
                                <tr>
                                    <td colspan="7" class="center-align"><i>- Please Wait -</i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!-- Action Image Modal -->
<div class="modal fade" id="action_image_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
            </div>
            <form id="action_image_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" id="upload_type"/>

                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Image </label>
                        <div class="col-sm-8" style="padding-top:7px">
                            <input type="file" name="action_image_file" id="action_image_file" size="20" />
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

<style type="text/css">
    input[type=checkbox]{margin-top:8px !important}
    .bootstrap-timepicker-widget{z-index:5000001 !important}
    .ObsActionList tbody td{white-space:normal !important}
    .ObsActionList thead th{white-space:nowrap !important}
    .doc_name{
        text-align:right !important;
        border:none !important;
    }
    .modal-open .modal {
        overflow-x: hidden !important;
        overflow-y: auto !important;
    }
</style>

<script type="text/javascript">

    var url = "<?php echo base_url(); ?>";
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "Con_Employee_Incident/delete_entry/" + id;
        else
            return false;
    }

    var save_method; //for save method string
    function observation_action_func(action_id, Action_Type) {
        save_method = 'add';
        $('input[name="obs_action_id"]').val(action_id);
        $('input[name="obs_action_type"]').val(Action_Type);
        var DATA = {
            "action_id": action_id
        };
        $.ajax({
            url: '<?php echo site_url('Con_Employees/get_observation_data'); ?>',
            data: DATA,
            type: 'POST'
        }).done(function (data) {
            $(".ObsActionList tbody").html(data);
        });
        $('#Obs_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Action Follow-up'); // Set Title to Bootstrap modal title
    }

    //========================================Accident========================================================== 

    function change_acc_any_witness()
    {
        //$('#acc_any_witness').change(function () {
        if ($('#acc_any_witness').is(":checked")) {
            $('#acc-wit').removeClass('hidden');
            $('#acc-witt').removeClass('hidden');
            $('#acc-wittt').removeClass('hidden');
            $('#acc_any_witness').val('1');
        } else {
            $('#acc-wit').addClass('hidden');
            $('#acc-witt').addClass('hidden');
            $('#acc-wittt').addClass('hidden');
            $('#acc_witness_name').val('');
            $('#acc_witness_phone').val('');
            $('#acc_witness_address').val('');
            $('#acc_any_witness').val('0');
        }
        //});
    }

    function change_acc_report_supervisor()
    {
        //$('#acc_report_supervisor').change(function () {
        if ($('#acc_report_supervisor').is(":checked")) {
            $('#accsup').removeClass("hidden");
            $('#accsupp').removeClass("hidden");
            $('#acc_report_supervisor').val('1');
        } else {
            $('#accsup').addClass("hidden");
            $('#accsupp').addClass("hidden");
            $('#acc_supervisor_report_date').val('');
            $('#acc_supervisor_reported_by').val('');
            $('#acc_report_supervisor').val('0');
        }
        //});
    }

    function change_acc_report_hr()
    {
        //$('#acc_report_hr').change(function () {
        if ($('#acc_report_hr').is(":checked")) {
            $('#acchr').removeClass("hidden");
            $('#acchrr').removeClass("hidden");
            $('#acc_report_hr').val('1');
        } else {
            $('#acchr').addClass("hidden");
            $('#acchrr').addClass("hidden");
            $('#acc_hr_report_date').val('');
            $('#acc_hr_reported_by').val('');
            $('#acc_report_hr').val('0');
        }
        //});
    }

    function change_first_aid_given()
    {
        //$('#first_aid_given').change(function () {
        if ($('#first_aid_given').is(":checked")) {
            $('#firstAid').removeClass("hidden");
            $('#explain_first_aid').removeClass("hidden");
            $('#first_aid_given').val('1');
        } else {
            $('#firstAid').addClass("hidden");
            $('#explain_first_aid').addClass("hidden");
            $('#first_aid_given').val('0');
        }
        //});
    }

    function change_Medical_Treatment()
    {
        //$('#requires_hospitalization').change(function () {
        if ($('#requires_hospitalization').is(":checked")) {
            $('#clname').removeClass("hidden");
            $('#phyname').removeClass("hidden");
            $('#requires_hospitalization').val('1');
        } else {
            $('#clname').addClass("hidden");
            $('#phyname').addClass("hidden");
            $('#requires_hospitalization').val('0');
        }
        //});
    }

    function change_Worker_Comp()
    {
        //$('#any_benefit_provider').change(function () {
        if ($('#any_benefit_provider').is(":checked")) {
            $('#provider_name_wrpp').removeClass("hidden");
            $('#benefit_account_wrpp').removeClass("hidden");
            $('#any_benefit_provider').val('1');
        } else {
            $('#provider_name_wrpp').addClass("hidden");
            $('#benefit_account_wrpp').addClass("hidden");
            $('#any_benefit_provider').val('0');
        }
        // });
    }

    /*---------- Add action image ----------*/
    function add_action_image(TYPE)
    {
        var Modal_Title = ''
        if ((TYPE == 'I-D') || (TYPE == 'A-D')) {
            Modal_Title = 'Upload Document';
        } else if ((TYPE == 'I-P') || (TYPE == 'A-P')) {
            Modal_Title = 'Upload Image';
        }
        $('#upload_type').val(TYPE);
        $('#action_image_form')[0].reset(); // reset form on modals
        $('#action_image_Modal').modal('show'); // show bootstrap modal
        $('#action_image_Modal .modal-title').text(Modal_Title); // Set Title to Bootstrap modal title
    }

    function change_acc_action(acc_action_type)
    {
        if (acc_action_type == 2) {
            $('#acc_discipline_info').removeClass("hidden");
            $('#acc_report_info').addClass("hidden");
        } else {
            $('#acc_discipline_info').addClass("hidden");
            $('#acc_report_info').removeClass("hidden");
        }
    }


    $(function () {
        $("#employee_id").select2({
            placeholder: "Select Employee",
            allowClear: true,
        });
        $("#injury_type").select2({
            placeholder: "Injury Type",
            allowClear: true,
        });
        $("#injured_body_parts").select2({
            placeholder: "Injured Body Parts",
            allowClear: true,
        });
        $("#benefit_provider").select2({
            placeholder: "Benefit Provider",
            allowClear: true,
        });
        $("#acc_action_type").select2({
            placeholder: "Action Type",
            allowClear: true,
        });
        $("#acc_discipline_type").select2({
            placeholder: "Discipline Type",
            allowClear: true,
        });

        $(document).on('change', '#benefit_provider', function () {
            var ACC = $(this).children('option:selected').attr('data-acc');
            $('#benefit_account').val(ACC);
        });

        $('#accident_time, .time_pick').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: false,
            showSeconds: false,
            defaultTime: ''
        });


        $('#action_image_form').submit(function (e) {
            e.preventDefault();
            var upload_type = $('#upload_type').val();
            var base_url = '<?php echo base_url(); ?>';
            $.ajaxFileUpload({
                url: base_url + './Con_Employees/upload_action_image_file/' + upload_type,
                secureuri: false,
                fileElementId: 'action_image_file',
                dataType: 'JSON',
                success: function (data)
                {
                    var datas = data.split('__');
                    if ((upload_type == 'I-D') || (upload_type == 'A-D')) {
                        if (datas[1] != "") {
                            $('input.' + upload_type).val(datas[1]);
                            $('#action_image_form')[0].reset();
                            $('#action_image_Modal').modal('hide');
                        }
                    } else {
                        if (!datas[1]) {
                            var path = base_url + 'uploads/no-image.png';
                        } else {
                            var path = base_url + 'uploads/action_image/' + datas[1];
                        }

                        $("img." + upload_type).removeAttr("src").attr("src", path);
                        $('input.' + upload_type).val(datas[1]);
                        $('#action_image_form')[0].reset();
                        $('#action_image_Modal').modal('hide');
                    }

                    var url = '';
                    view_message(datas[0], url);
                }
            });
            return false;
        });



//        $("#emp_accident_action").submit(function (event) {
//            //$('select').removeAttr('disabled');
//            var url = $(this).attr('action');
//            $.ajax({
//                url: url,
//                data: $("#sky-form11").serialize(),
//                type: $(this).attr('method')
//            }).done(function (data) {
//                //alert (data);
//                var url = '<?php //echo base_url()          ?>Con_Employee_Incident';
//                view_message(data, url, '', 'sky-form11');
//            });
//            event.preventDefault();
//        });


        $("#emp_accident_action").submit(function (event) {
            var url;

            var save_method = $('#save_method').val();

//            alert('==>>> ' + save_method);
//            return;

            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employee_Accident/save_emp_acc_actions') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Employee_Accident/edit_emp_acc_actions') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_accident_action").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

//                $("#actions_div").load(location.href + " #actions_div");
//                reload_table('dataTables-example-actions');

                var url = '<?php echo base_url() ?>Con_Accident_Explorer';
                view_message(data, url, '', 'emp_accident_action');
            });
            event.preventDefault();
        });

        /*-----------------Follow-up Action Save------------------*/
        $("#observation_action").submit(function (event) {
            var url;

            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employees/add_observation_action') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Employees/edit_observation_action') ?>";
            }
            $.ajax({
                url: url,
                data: $("#observation_action").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //alert (data);

                $("#actions_div").load(location.href + " #actions_div");
                reload_table('dataTables-example-actions');
                var url = '';
                view_message(data, url, 'Obs_Modal', 'observation_action');
                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

</script>
