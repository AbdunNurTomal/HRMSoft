<style type="text/css">
    input[type=checkbox]{margin-top:8px !important}
    .bootstrap-timepicker-widget{z-index:5000001 !important}
    .ObsActionList tbody td{white-space:normal !important}
    .ObsActionList thead th{white-space:nowrap !important}
    .doc_name{float:right !important;border:none !important}
    .modal-open .modal {
        overflow-x: hidden !important;
        overflow-y: auto !important;
    }
</style>
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3 padding-15">

            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employee_Incident/save_Employee_Incident" enctype="multipart/form-data" role="form" >

                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Employee <span class="req"/> </label> 
                        <div class="col-sm-4">
                            <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                if ($this->user_group != 1 || $this->user_group != 2 || $this->user_group != 3) {
                                    $employees_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
                                } else {
                                    $employees_query = $this->db->get_where('main_employees', array('isactive' => 1));
                                }
                                foreach ($employees_query->result() as $row) {
                                    print"<option value='" . $row->employee_id . "'>" . $row->first_name . " " . $row->middle_name . " " . $row->last_name . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label"> Type <span class="req"/> </label> 
                        <div class="col-sm-4">
                            <select name="inc_action_type" id="inc_action_type" onchange="change_inc_action(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <?php
                                $action_type_array = $this->Common_model->get_array('incident_action_type');
                                foreach ($action_type_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="modal-body" id="inc_report_info"> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Action Date<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="inc_action_date" id="inc_action_date" class="form-control dt_pick input-sm" placeholder="Action Date" data-toggle="tooltip" data-placement="bottom" title="Action Date" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group no-margin">
                                <label class="col-sm-4 control-label">Category<span class="req"/></label>
                                <div class="col-sm-8">
                                    <select name="incident_category" id="incident_category" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $incident_category_array = $this->Common_model->get_array('incident_category');
                                        foreach ($incident_category_array as $row => $val) {
                                            print"<option value='" . $row . "'>" . $val . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group no-margin">
                                <label class="col-sm-4 control-label">Incident Type<span class="req"/></label>
                                <div class="col-sm-8">
                                    <select name="tncident_type" id="tncident_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $tncident_type_array = $this->db->get_where('main_incidenttype', array('company_id' => $this->company_id));
                                        foreach ($tncident_type_array->result() as $key):
                                            ?>
                                            <option value="<?php echo $key->id ?>"><?php echo $key->incident_type ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Location<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="accident_location" id="accident_location" class="form-control input-sm" placeholder="Incident Location" data-toggle="tooltip" data-placement="top" title="Incident Location">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Incident Time</label>
                                <div class="col-sm-8">
                                    <input type="text" name="accident_time" id="accident_time" class="form-control time_pick input-sm" placeholder="Incident Time"n data-toggle="tooltip" data-placement="top" title="Incident Time">
                                </div>
                            </div>                    
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Any Witness?</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_inc_any_witness();" name="inc_any_witness" id="inc_any_witness" value="0">
                                </div>
                            </div>
                            <div id="inc-wit" class="form-group" style="display: none;">
                                <label class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="inc_witness_name" id="inc_witness_name" class="form-control input-sm" placeholder="Incident Witness Name" data-toggle="tooltip" data-placement="top" title="Incident Witness Name">
                                </div>
                            </div>
                            <div id="inc-witt" class="form-group" style="display: none;">
                                <label class="col-sm-4 control-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" name="inc_witness_phone" id="inc_witness_phone" class="form-control input-sm" placeholder="Incident Witness Phone" data-toggle="tooltip" data-placement="top" title="Incident Witness Phone">
                                </div>
                            </div>
                            <div id="inc-wittt" class="form-group" style="display: none;">
                                <label class="col-sm-4 control-label">Address</label>
                                <div class="col-sm-8">
                                    <textarea name="inc_witness_address" id="inc_witness_address" class="form-control input-sm" rows="2" placeholder="Incident Witness Address" data-toggle="tooltip" data-placement="top" title="Incident Witness Address"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Reported to Supervisor? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_inc_report_supervisor();" name="inc_report_supervisor" id="inc_report_supervisor" value="0">
                                </div>
                            </div>
                            <div id="sup" class="form-group" style="display: none;">
                                <label class="col-sm-4 control-label">Date</label>
                                <div class="col-sm-8">
                                    <input type="text" name="inc_supervisor_report_date" id="inc_supervisor_report_date" class="form-control dt_pick input-sm" placeholder="Date" data-toggle="tooltip" data-placement="bottom" title="Date" autocomplete="off">
                                </div>
                            </div>
                            <div id="supp" class="form-group" style="display: none;">
                                <label class="col-sm-4 control-label">Reported By</label>
                                <div class="col-sm-8">
                                    <input type="text" name="inc_supervisor_reported_by" id="inc_supervisor_reported_by" class="form-control input-sm" placeholder="Reported By" data-toggle="tooltip" data-placement="top" title="Reported By">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Reported to HR? </label>
                                <div class="col-sm-8">
                                    <input type="checkbox" onchange="change_inc_report_hr();" name="inc_report_hr" id="inc_report_hr" value="0">
                                </div>
                            </div>
                            <div id="hr" class="form-group" style="display: none;">
                                <label class="col-sm-4 control-label">Date</label>
                                <div class="col-sm-8">
                                    <input type="text" name="inc_hr_report_date" id="inc_hr_report_date" class="form-control dt_pick input-sm" placeholder="Date" data-toggle="tooltip" data-placement="bottom" title="Date" autocomplete="off">
                                </div>
                            </div>
                            <div id="hrr" class="form-group" style="display: none;">
                                <label class="col-sm-4 control-label">Reported By</label>
                                <div class="col-sm-8">
                                    <input type="text" name="inc_hr_reported_by" id="inc_hr_reported_by" class="form-control input-sm" placeholder="Reported By" data-toggle="tooltip" data-placement="top" title="Reported By">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="inc_report_description" id="inc_report_description" class="form-control input-sm" rows="7" placeholder="Describe the incident in detail. Identify who, what, when, where, and how: Who committed the alleged incident? What exactly occurred or what was said? When did it occur, and is it still ongoing? Where did it occur? How often did it occur? How did it affect you?" data-toggle="tooltip" data-placement="top" title="Details"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Employee Comments</label>
                                <div class="col-sm-8">
                                    <textarea name="inc_employee_comments" id="inc_employee_comments" class="form-control input-sm" rows="2" placeholder="Employee Comments" data-toggle="tooltip" data-placement="top" title="Employee Comments"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Upload Documents</label>
                                <div class="col-sm-8" style="padding-top:7px">
                                    <a href="#" onclick="add_action_image('I-D');" class="linkStyle" data-toggle="tooltip" title="Upload Photo">
                                        <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                    </a>
                                    <input type="text" class="I-D doc_name" name="action_document_path" id="action_document_path" value="" readonly />
                                </div>
                            </div>                    
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Upload Image</label>
                                <div class="col-sm-8" style="padding-top:7px">
                                    <a href="#" onclick="add_action_image('I-P');" class="linkStyle" data-toggle="tooltip" title="Upload Photo">
                                        <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                    </a>
                                    <input type="hidden" class="I-P" name="action_image_path" id="action_image_path" value="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">&nbsp;</label>
                                <div class="col-sm-8">
                                    <img id="temp_accident_img" class="I-P" style="max-width:100%" src="<?php echo site_url('uploads/no-image.png'); ?>" alt="No Image Available" /> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body hidden" id="inc_discipline_info">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-5 control-label">Discipline Type<span class="req"/></label>
                                <div class="col-sm-7">
                                    <select name="inc_discipline_type" id="inc_discipline_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $discipline_type_array = $this->db->get_where('main_disciplinetype', array('company_id' => $this->company_id));
                                        foreach ($discipline_type_array->result() as $roww) {
                                            print"<option value='" . $roww->id . "'>" . $roww->discipline_type . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group " id="">
                                <label class="col-sm-5 control-label">Verbal Warning By</label>
                                <div class="col-sm-7">
                                    <input type="text" name="inc_verbal_warning_by" id="inc_verbal_warning_by" class="form-control input-sm" placeholder="Verbal Warning By" data-toggle="tooltip" data-placement="top" title="Verbal Warning By">
                                </div>
                            </div>
                            <div class="form-group " id="">
                                <label class="col-sm-5 control-label">Written Warning By</label>
                                <div class="col-sm-7">
                                    <input type="text" name="inc_written_warning_by" id="inc_written_warning_by" class="form-control input-sm" placeholder="Written Warning By" data-toggle="tooltip" data-placement="top" title="Written Warning By">
                                </div>
                            </div>
                            <div class="form-group " id="">
                                <label class="col-sm-5 control-label">Counseled By</label>
                                <div class="col-sm-7">
                                    <input type="text" name="inc_counseled_by" id="inc_counseled_by" class="form-control input-sm" placeholder="Counseled By" data-toggle="tooltip" data-placement="top" title="Counseled By">
                                </div>
                            </div>
                            <div class="form-group " id="">
                                <label class="col-sm-5 control-label">Suspended From</label>
                                <div class="col-sm-7">
                                    <input type="text" name="inc_suspended_from" id="inc_suspended_from" class="form-control dt_pick input-sm" placeholder="Suspended From" data-toggle="tooltip" data-placement="top" title="Suspended From" autocomplete="off">
                                </div>
                            </div>                    
                        </div>

                        <div class="col-md-6">                    
                            <div class="form-group " id="">
                                <label class="col-sm-4 control-label">Suspended To</label>
                                <div class="col-sm-8">
                                    <input type="text" name="inc_suspended_to" id="inc_suspended_to" class="form-control dt_pick input-sm" placeholder="Suspended To" data-toggle="tooltip" data-placement="top" title="Suspended To" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group " id="">
                                <label class="col-sm-4 control-label">Subject</label>
                                <div class="col-sm-8">
                                    <input type="text" name="inc_subject" id="inc_subject" class="form-control input-sm" placeholder="Subject" data-toggle="tooltip" data-placement="top" title="Subject">
                                </div>
                            </div>
                            <div class="form-group " id="">
                                <label class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="inc_description" id="inc_description" class="form-control input-sm" rows="1" placeholder="Description" data-toggle="tooltip" data-placement="top" title="Description"></textarea>                        
                                </div>
                            </div>
                            <div class="form-group " id="">
                                <label class="col-sm-4 control-label">Improvement Plan</label>
                                <div class="col-sm-8">
                                    <textarea name="inc_improvement_plan" id="inc_improvement_plan" class="form-control input-sm" rows="1" placeholder="Improvement Plan" data-toggle="tooltip" data-placement="top" title="Improvement Plan"></textarea>                        
                                </div>
                            </div>
                            <div class="form-group " id="">
                                <label class="col-sm-4 control-label">Further Actions</label>
                                <div class="col-sm-8">
                                    <textarea name="inc_further_actions" id="inc_further_actions" class="form-control input-sm" rows="1" placeholder="Further Actions" data-toggle="tooltip" data-placement="top" title="Further Actions"></textarea>                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u"> Save </button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employee_Incident" ?>">Close</a>
                        </div>
                    </div>
                </form>

                <?php
            } else if ($type == 2) {//edit
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employee_Incident/update_Employee_Incident" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?>

                        <input type="hidden" name="id_emp_inc" id="id_emp_inc" value="<?php echo $row->id ?>">

                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Employee <span class="req"/> </label> 
                            <div class="col-sm-4">
                                <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    if ($this->user_group != 1 || $this->user_group != 2 || $this->user_group != 3) {
                                        $employees_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
                                    } else {
                                        $employees_query = $this->db->get_where('main_employees', array('isactive' => 1));
                                    }
                                    foreach ($employees_query->result() as $row1) {
                                        //print"<option value='" . $row->employee_id . "'>" . $row->first_name ." ". $row->middle_name ." ". $row->last_name . "</option>";
                                        ?>
                                        <option value="<?php echo $row1->employee_id; ?>"<?php if ($row1->employee_id == $row->employee_id) echo "selected"; ?>><?php echo $row1->first_name . " " . $row1->middle_name . " " . $row1->last_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-sm-2 control-label"> Type <span class="req"/> </label> 
                            <div class="col-sm-4">
                                <select name="inc_action_type" id="inc_action_type" onchange="change_inc_action(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <?php
                                    $action_type_array = $this->Common_model->get_array('incident_action_type');
                                    foreach ($action_type_array as $roww => $val) {
                                        print"<option value='" . $roww . "'>" . $val . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="modal-body" id="inc_report_info"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Action Date <span class="req"/></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inc_action_date" id="inc_action_date" value="<?php echo $this->Common_model->show_date_formate($row->action_date) ?>" class="form-control dt_pick input-sm" placeholder="Action Date" title="Action Date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-sm-4 control-label">Category<span class="req"/></label>
                                    <div class="col-sm-8">
                                        <select name="incident_category" id="incident_category" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            $incident_category_array = $this->Common_model->get_array('incident_category');
                                            foreach ($incident_category_array as $roww => $val) {
                                                ?>
                                                <option value="<?php echo $roww ?>" <?php if ($roww == $row->incident_category) echo "selected"; ?>> <?php echo $val ?> </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group no-margin">
                                    <label class="col-sm-4 control-label">Incident Type<span class="req"/></label>
                                    <div class="col-sm-8">
                                        <select name="tncident_type" id="tncident_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                            <option></option>
                                            <?php
                                            $tncident_type_array = $this->db->get_where('main_incidenttype', array('company_id' => $this->company_id));
                                            foreach ($tncident_type_array->result() as $key):
                                                ?>
                                                <option value="<?php echo $key->id ?>" <?php if ($key->id == $row->tncident_type) echo "selected"; ?>><?php echo $key->incident_type ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Location<span class="req"/></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="accident_location" id="accident_location" value="<?php echo $row->accident_location ?>" class="form-control input-sm" placeholder="Incident Location" data-toggle="tooltip" data-placement="top" title="Incident Location">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Incident Time</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="accident_time" id="accident_time" value="<?php echo $row->accident_time ?>" class="form-control time_pick input-sm" placeholder="Incident Time" title="Incident Time">
                                    </div>
                                </div>                    
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Any Witness?</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" onchange="change_inc_any_witness();" name="inc_any_witness" id="inc_any_witness" value="0" <?php if ($row->any_witness == 1) echo "checked"; ?> >
                                    </div>
                                    <script>
                                        $(function () {
                                            change_inc_any_witness();
                                        });
                                    </script>
                                </div>
                                <div id="inc-wit" class="form-group" style="display: none;">
                                    <label class="col-sm-4 control-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inc_witness_name" id="inc_witness_name" value="<?php echo $row->accident_witness ?>" class="form-control input-sm" placeholder="Incident Witness Name" data-toggle="tooltip" data-placement="top" title="Incident Witness Name">
                                    </div>
                                </div>
                                <div id="inc-witt" class="form-group" style="display: none;">
                                    <label class="col-sm-4 control-label">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inc_witness_phone" id="inc_witness_phone" value="<?php echo $row->accident_witness_phone ?>" class="form-control input-sm" placeholder="Incident Witness Phone" data-toggle="tooltip" data-placement="top" title="Incident Witness Phone">
                                    </div>
                                </div>
                                <div id="inc-wittt" class="form-group" style="display: none;">
                                    <label class="col-sm-4 control-label">Address</label>
                                    <div class="col-sm-8">
                                        <textarea name="inc_witness_address" id="inc_witness_address" class="form-control input-sm" rows="2" placeholder="Incident Witness Address"  title="Incident Witness Address"> <?php echo $row->accident_witness_address ?> </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Reported to Supervisor? </label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" onchange="change_inc_report_supervisor();" name="inc_report_supervisor" id="inc_report_supervisor" value="0" <?php if ($row->report_supervisor == 1) echo "checked"; ?> >
                                    </div>
                                    <script>
                                        $(function () {
                                            change_inc_report_supervisor();
                                        });
                                    </script>
                                </div>
                                <div id="sup" class="form-group" style="display: none;">
                                    <label class="col-sm-4 control-label">Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inc_supervisor_report_date" id="inc_supervisor_report_date" value="<?php echo $this->Common_model->show_date_formate($row->supervisor_report_date) ?>" class="form-control dt_pick input-sm" placeholder="Date" title="Date" autocomplete="off">
                                    </div>
                                </div>
                                <div id="supp" class="form-group" style="display: none;">
                                    <label class="col-sm-4 control-label">Reported By</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inc_supervisor_reported_by" id="inc_supervisor_reported_by" value="<?php echo $row->supervisor_reported_by ?>" class="form-control input-sm" placeholder="Reported By" data-toggle="tooltip" data-placement="top" title="Reported By">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Reported to HR? </label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" onchange="change_inc_report_hr();" name="inc_report_hr" id="inc_report_hr" value="0" <?php if ($row->report_hr == 1) echo "checked"; ?> >
                                    </div>
                                    <script>
                                        $(function () {
                                            change_inc_report_hr();
                                        });
                                    </script>
                                </div>
                                <div id="hr" class="form-group" style="display: none;">
                                    <label class="col-sm-4 control-label">Date</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inc_hr_report_date" id="inc_hr_report_date" value="<?php echo $this->Common_model->show_date_formate($row->hr_report_date) ?>" class="form-control dt_pick input-sm" placeholder="Date" data-toggle="tooltip" data-placement="bottom" title="Date" autocomplete="off">
                                    </div>
                                </div>
                                <div id="hrr" class="form-group" style="display: none;">
                                    <label class="col-sm-4 control-label">Reported By</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="inc_hr_reported_by" id="inc_hr_reported_by" value="<?php echo $row->hr_reported_by ?>" class="form-control input-sm" placeholder="Reported By" data-toggle="tooltip" data-placement="top" title="Reported By">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Description</label>
                                    <div class="col-sm-8">
                                        <textarea name="inc_report_description" id="inc_report_description" class="form-control input-sm" rows="7" placeholder="Describe the incident in detail. Identify who, what, when, where, and how: Who committed the alleged incident? What exactly occurred or what was said? When did it occur, and is it still ongoing? Where did it occur? How often did it occur? How did it affect you?" data-toggle="tooltip" data-placement="top" title="Details"> <?php echo $row->report_description ?>  </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Employee Comments</label>
                                    <div class="col-sm-8">
                                        <textarea name="inc_employee_comments" id="inc_employee_comments" class="form-control input-sm" rows="2" placeholder="Employee Comments" data-toggle="tooltip" data-placement="top" title="Employee Comments"> <?php echo $row->employee_comments ?> </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Upload Documents</label>
                                    <div class="col-sm-8" style="padding-top:7px">
                                        <a href="#" onclick="add_action_image('I-D');" class="linkStyle" data-toggle="tooltip" title="Upload Photo">
                                            <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                        </a>
                                        <input type="text" class="I-D doc_name" name="action_document_path" id="action_document_path" value="<?php echo $row->document_path ?>" readonly />
                                    </div>
                                </div>                    
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Upload Image</label>
                                    <div class="col-sm-8" style="padding-top:7px">
                                        <a href="#" onclick="add_action_image('I-P');" class="linkStyle" data-toggle="tooltip" title="Upload Photo">
                                            <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                        </a>
                                        <input type="hidden" class="I-P" name="action_image_path" id="action_image_path" value="<?php echo $row->image_path ?>" />
                                    </div>
                                </div>
                                <?php
                                if ($row->image_path == "") {
                                    $imagesrc = base_url() . "uploads/no-image.png";
                                } else {
                                    $imagesrc = base_url() . "uploads/action_image/" . $row->image_path;
                                }
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <img id="temp_accident_img" class="I-P" style="max-width:100%" src="<?php echo $imagesrc; ?>" alt="No Image Available" /> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="col-md-12">
                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u"> Update </button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employee_Incident" ?>">Close</a>
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>

    </div>
</div>


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

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $("#employee_id").select2({
        placeholder: "Select Employee",
        allowClear: true,
    });

    $("#inc_action_type").select2({
        placeholder: "Action Type",
        allowClear: true,
    });

    $("#incident_category").select2({
        placeholder: "incident category",
        allowClear: true,
    });

    $("#tncident_type").select2({
        placeholder: "incident type",
        allowClear: true,
    });

    $("#inc_discipline_type").select2({
        placeholder: "incident discipline type",
        allowClear: true,
    });

    $(function () {
        $("#inc_witness_phone").mask("(999) 999-9999");
    });


    function change_inc_action(id)
    {
        if (id == 2) {
            $('#inc_discipline_info').removeClass("hidden");
            $('#inc_report_info').addClass("hidden");
        } else {
            $('#inc_discipline_info').addClass("hidden");
            $('#inc_report_info').removeClass("hidden");
        }
    }

    function change_inc_any_witness()
    {
        //$('#inc_any_witness').change(function () {
        if ($('#inc_any_witness').is(":checked")) {
            $('#inc-wit').removeAttr("style");
            $('#inc-witt').removeAttr("style");
            $('#inc-wittt').removeAttr("style");
            $('#inc_any_witness').val('1');
        } else {
            $('#inc-wit').attr('style', 'display:none');
            $('#inc-witt').attr('style', 'display:none');
            $('#inc-wittt').attr('style', 'display:none');
            $('#inc_witness_name').val('');
            $('#inc_witness_phone').val('');
            $('#inc_witness_address').val('');
            $('#inc_any_witness').val('0');
        }
        // });
    }

    function change_inc_report_supervisor()
    {
        //$('#inc_report_supervisor').change(function () {
        if ($('#inc_report_supervisor').is(":checked")) {
            $('#sup').removeAttr("style");
            $('#supp').removeAttr("style");
            $('#inc_report_supervisor').val('1');
        } else {
            $('#sup').attr('style', 'display:none');
            $('#supp').attr('style', 'display:none');
            $('#inc_supervisor_report_date').val('');
            $('#inc_supervisor_reported_by').val('');
            $('#inc_report_supervisor').val('0');
        }
        //});
    }

    function change_inc_report_hr()
    {
        //$('#inc_report_hr').change(function () {
        if ($('#inc_report_hr').is(":checked")) {
            $('#hr').removeAttr("style");
            $('#hrr').removeAttr("style");
            $('#inc_report_hr').val('1');
        } else {
            $('#hr').attr('style', 'display:none');
            $('#hrr').attr('style', 'display:none');
            $('#inc_hr_report_date').val('');
            $('#inc_hr_reported_by').val('');
            $('#inc_report_hr').val('0');
        }
        //});
    }

    function add_action_image(TYPE)
    {
        var Modal_Title = ''
        if (TYPE == 'I-D') {
            Modal_Title = 'Upload Document';
        } else if (TYPE == 'I-P') {
            Modal_Title = 'Upload Image';
        }
        $('#upload_type').val(TYPE);
        $('#action_image_form')[0].reset(); // reset form on modals
        $('#action_image_Modal').modal('show'); // show bootstrap modal
        $('#action_image_Modal .modal-title').text(Modal_Title); // Set Title to Bootstrap modal title
    }

    $(function () {
        $('#action_image_form').submit(function (e) {
            e.preventDefault();
            var upload_type = $('#upload_type').val();
            //var base_url = '<?php // echo base_url();           ?>';
            $.ajaxFileUpload({
                url: base_url + './Con_Employee_Incident/upload_action_image_file/' + upload_type,
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
    });

    $(function () {
        $("#sky-form11").submit(function (event) {
            //$('select').removeAttr('disabled');
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                var url = '<?php echo base_url() ?>Con_Employee_Incident';
                view_message(data, url, '', 'sky-form11');
            });
            event.preventDefault();
        });
    });


</script>
<!--=== End Script ===-->

