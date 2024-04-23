
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="actions_div">
        <button class="btn btn-u btn-md" onClick="add_actions_incident()"><span class="glyphicon glyphicon-plus-sign"></span> Add Incident</button>
        <button class="btn btn-u btn-md" onClick="add_actions_Discipline()"><span class="glyphicon glyphicon-plus-sign"></span> Add Discipline</button>
        <button class="btn btn-u btn-md" onClick="add_actions_accident()"><span class="glyphicon glyphicon-plus-sign"></span> Add Accident</button><br><br>
        <table id="dataTables-example-actions" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
             <colgroup>
                <col width="1%">
                <col width="20%">
                <col width="20%">
                <col width="25%">
                <col width="25%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Action Date</th>
                    <th>Actions Type</th>
                    <th>Description</th>
                    <th>Discipline Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                /* $tncident_type_array = $this->Common_model->listItem('main_incidenttype');
                  $discipline_type_array = $this->Common_model->listItem('main_disciplinetype'); */

                $tncident_type_array = $this->db->get_where('main_incidenttype', array('company_id' => $this->company_id));
                $discipline_type_array = $this->db->get_where('main_disciplinetype', array('company_id' => $this->company_id));

                $query = $this->db->get_where('main_emp_actions', array('employee_id' => $employee_id, 'isactive' => 1));

                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;

                        $download_link = base_url() . 'con_Employees/';
                        $accident_inv_report = $accident_body_report = '';
                        $refusal_report = "";
                        $work_comp_claim_report = "";

                        if ($row->action_type == 1) {
                            $action_type = "Incident";
                            $action_title = "Incident Report";
                            $download_link .= 'incident_pdf/' . $pdt;
                        } else if ($row->action_type == 2) {
                            $action_type = "Accident";
                            $action_title = "Accident Report";
                            $download_link .= 'accident_pdf/' . $pdt;
                            $accident_inv_report = "<a title='Accident Investigation Report' href='" . base_url() . 'con_Employees/accident_inv_pdf/' . $pdt . "'><i class='fa fa-lg fa-cloud-download'></i></a>&nbsp;&nbsp;";
                            $accident_body_report = "<a title='Employee Accident Report' href='" . base_url() . 'con_Employees/accident_report/' . $pdt . "'><i class='fa fa-lg fa-arrow-down'></i></a>&nbsp;&nbsp;";
                            $refusal_report = "<a title='Medical Attention Refusal' href='" . base_url() . 'Con_Employees/medical_attention_refusal/' . $pdt . "'><i class='fa fa-lg fa-cloud-download'></i></a>&nbsp;&nbsp;";
                            if ($row->any_benefit_provider == 1) {
                                $work_comp_claim_report = "<a title='WORKERS’ COMPENSATION CLAIM' href='" . base_url() . 'Con_Employees/work_comp_claim/' . $pdt . "'><i class='fa fa-download' aria-hidden='true'></i></a>&nbsp;&nbsp;";
                            }
                            //WORKERS’ COMPENSATION CLAIM FORM (DWC 1)work_comp_claim 
                        } else {
                            $action_type = $action_title = "Discipline Action";
                            $download_link .= '#';
                        }

                        $download_video="";
                        if($row->video_path!=""){
                            $download_video = "<a title='download video' href='" . base_url() . 'Con_Employees/download_video/' . $row->video_path . "'><i class='fa fa-file-video-o'></i></a>&nbsp;&nbsp;";
                        }

                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->action_date) . "</td>";
                        print"<td id='catC" . $pdt . "'>" . $action_type . "</td>";
                        print"<td id='catD" . $pdt . "'>" . ucwords($row->report_description) . "</td>";
                        print"<td id='catE" . $pdt . "'>";
                        if ($row->discipline_type != 0) {
                            print $this->Common_model->get_name($this, $row->discipline_type, 'main_disciplinetype', 'discipline_type') . "</td>";
                        } else {
                            print" - </td>";
                        }
                        print"<td><div class='action-buttons'>"
                                . "<a title='Review' href='javascript:;' onclick='edit_action(" . $row->id . ")'  ><i class='fa fa-lg fa-pencil-square-o'></i></a>&nbsp;&nbsp;"
                                . "<a title='Follow-up' href='javascript:;' onclick='observation_action_func(" . $row->id . ", " . $row->action_type . ")'  ><i class='fa fa-lg fa-search-plus'></i></a>&nbsp;&nbsp;"
                                . "<a title='" . $action_title . "' href='" . $download_link . "'><i class='fa fa-lg fa-download'></i></a>&nbsp;&nbsp;"
                                . $accident_inv_report
                                . $accident_body_report
                                . $refusal_report
                                . $work_comp_claim_report
                                . $download_video
                                . "<a title='Delete' href='javascript:;' onclick='delete_data_action(" . $row->id . ")'><i class='fa fa-trash-o'></i></a>"
                                . "</div></td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>

<!--Incident Modal -->
<div class="modal fade" id="Inc_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Incident</h4>
            </div>
            <form id="emp_inc_action" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Type</label> 
                        <div class="col-sm-5">
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
                </div>
                <input type="hidden" value="" name="id_emp_inc"/>
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
                                    <?php foreach ($tncident_type_array->result() as $key): ?>
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
                                <input type="text" name="accident_time" id="accident_time" class="form-control input-sm" placeholder="Incident Time"n data-toggle="tooltip" data-placement="top" title="Incident Time">
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
                                <input type="text" class="I-D doc_name" name="action_document_path" id="action_document_path" value="" />
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
                            <label class="col-sm-4 control-label">Upload Video</label>
                            <div class="col-sm-8" style="padding-top:7px">
                                <a href="#" onclick="add_action_image('I-V');" class="linkStyle" data-toggle="tooltip" title="Upload Video">
                                    <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                </a>
                                <input type="hidden" class="I-V" name="action_video_path" id="action_video_path" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <img id="temp_accident_img" class="I-P" style="max-width:100%" src="<?php echo site_url('uploads/no-image.png'); ?>" alt="No Image Available" /> 
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-body hidden" id="inc_discipline_info">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Discipline Type<span class="req"/></label>
                            <div class="col-sm-7">
                                <select name="inc_discipline_type" id="inc_discipline_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
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

                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Discipline Modal -->
<div class="modal fade" id="Disc_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Incident</h4>
            </div>
            <form id="emp_Disc" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Type</label> 
                        <div class="col-sm-5">
                        <input type="hidden" value="2" name="disc_action_type" id="disc_action_type"/>
                            <!-- <select name="disc_action_type" id="disc_action_type" onchange="change_inc_action(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <?php
                                // $action_type_array = $this->Common_model->get_array('incident_action_type');
                                // foreach ($action_type_array as $row => $val) {
                                //     if($row==2){
                                //         print"<option value='" . $row . "'>" . $val . "</option>";
                                //     }
                                // }
                                ?>
                            </select> -->
                            
                            <span class="form-control input-sm">Discipline Action</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="" name="id_emp_disc"/>
                
                <div class="modal-body">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Discipline Type<span class="req"/></label>
                            <div class="col-sm-7">
                                <select name="disc_discipline_type" id="disc_discipline_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
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

                    <div class="clearfix"></div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- accident Modal -->
<div class="modal fade" id="accident_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Accident</h4>
            </div>
            <form id="emp_accident_action" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Type<span class="req"/></label>
                        <div class="col-sm-5">
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
                <input type="hidden" value="" name="id_emp_accident"/>
                <div class="modal-body" id="acc_report_info">
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
                        <div id="acc-wit" class="form-group" style="display: none;">
                            <label class="col-sm-4 control-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="acc_witness_name" id="acc_witness_name" class="form-control input-sm" placeholder="Accident Witness Name" data-toggle="tooltip" data-placement="top" title="Accident Witness Name">
                            </div>
                        </div>

                        <div id="acc-witt" class="form-group" style="display: none;">
                            <label class="col-sm-4 control-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" name="acc_witness_phone" id="acc_witness_phone" class="form-control input-sm" placeholder="Accident Witness Phone" data-toggle="tooltip" data-placement="top" title="Accident Witness Phone">
                            </div>
                        </div>
                        <div id="acc-wittt" class="form-group" style="display: none;">
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
                                <textarea name="acc_employee_comments" id="acc_employee_comments" class="form-control input-sm" rows="1" placeholder="Employee Comments" data-toggle="tooltip" data-placement="top" title="Employee Comments"></textarea>
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
                            <label class="col-sm-4 control-label">Provider's Name<span class="req"/></label>
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
                            <label class="col-sm-4 control-label">Upload Document</label>
                            <div class="col-sm-8" style="padding-top:7px">
                                <a href="#" onclick="add_action_image('A-D');" class="linkStyle" data-toggle="tooltip" title="Upload Document">
                                    <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                </a>
                                <input type="text" class="A-D doc_name" name="action_document_path" id="action_document_path" value="" />
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Upload Image</label>
                            <div class="col-sm-8" style="padding-top:7px">
                                <a href="#" onclick="add_action_image('A-P');" class="linkStyle" data-toggle="tooltip" title="Upload Photo">
                                    <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                </a>
                                <input type="hidden" class="A-P" name="action_image_path" id="action_image_path" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Upload Video</label>
                            <div class="col-sm-8" style="padding-top:7px">
                                <a href="#" onclick="add_action_image('A-V');" class="linkStyle" data-toggle="tooltip" title="Upload Video">
                                    <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload</button>
                                </a>
                                <input type="hidden" class="A-V" name="action_video_path" id="action_video_path" value="" />
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

                <div class="modal-body hidden" id="acc_discipline_info">
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

                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
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
                        <label class="col-sm-4 control-label"> Select File </label>
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
    .doc_name{float:right !important;border:none !important}
    .modal-open .modal {
        overflow-x: hidden !important;
        overflow-y: auto !important;
    }
</style>

<script type="text/javascript">
    var table;
    $(document).ready(function () {

        $('#dataTables-example-actions').dataTable({
            "order": [0, "asc"],
            "pageLength": 10,
            "paginationType": "input"
        });


        $(document).on('change', '#benefit_provider', function () {
            var ACC = $(this).children('option:selected').attr('data-acc');
            $('#benefit_account').val(ACC);
        });

        $('.modal').on('hidden.bs.modal', function (e) {
            if ($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });


        $('#accident_time, .time_pick').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: false,
            showSeconds: false,
            defaultTime: ''
        });

        change_acc_action($('#acc_action_type').val());
        change_inc_action($('#inc_action_type').val());
    });

    /*---------- Add action image ----------*/
    function add_action_image(TYPE)
    {
        var Modal_Title = ''
        if ((TYPE == 'I-D') || (TYPE == 'A-D')) {
            Modal_Title = 'Upload Document';
        } else if ((TYPE == 'I-P') || (TYPE == 'A-P')) {
            Modal_Title = 'Upload Image';
        } else if ((TYPE == 'I-V') || (TYPE == 'A-V')) {
            Modal_Title = 'Upload Video';
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
                    } else if((upload_type == 'I-P') || (upload_type == 'A-P')) {
                        if (!datas[1]) {
                            var path = base_url + 'uploads/no-image.png';
                        } else {
                            var path = base_url + 'uploads/action_image/' + datas[1];
                        }

                        $("img." + upload_type).removeAttr("src").attr("src", path);
                        $('input.' + upload_type).val(datas[1]);
                        $('#action_image_form')[0].reset();
                        $('#action_image_Modal').modal('hide');
                    }else{
                        if (datas[1] != "") {

                            if (!datas[1]) {
                                var path = base_url + 'uploads/no-image.png';
                            } else {
                                var path = base_url + 'uploads/action_video/' + datas[1];
                            }
                            $("img." + upload_type).removeAttr("src").attr("src", path);
                            $('input.' + upload_type).val(datas[1]);
                            $('#action_image_form')[0].reset();
                            $('#action_image_Modal').modal('hide');
                        }
                    }

                    var url = '';
                    view_message(datas[0], url);
                }
            });
            return false;
        });
    });
    $(function () {
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


    function add_actions_incident()
    {
        save_method = 'add';
        $('#emp_inc_action')[0].reset(); // reset form on modals

        $("#inc_action_type").select2({
            placeholder: "Action Type",
            allowClear: true,
        });

        $("#incident_category").select2({
            placeholder: "Incident Category",
            allowClear: true,
        });

        $("#tncident_type").select2({
            placeholder: "Incident Type",
            allowClear: true,
        });

        $("#inc_discipline_type").select2({
            placeholder: "Discipline Type",
            allowClear: true,
        });

        change_inc_action($('#inc_action_type').val());

        $('#inc_any_witness').prop('checked', false);
        change_inc_any_witness();

        $('#inc_report_supervisor').prop('checked', false);
        change_inc_report_supervisor();

        $('#inc_report_hr').prop('checked', false);
        change_inc_report_hr();


        $('#Inc_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Incident'); // Set Title to Bootstrap modal title
    }


    function add_actions_Discipline()
    {
        save_method = 'add';
        $('#emp_Disc')[0].reset(); // reset form on modals

        // $("#disc_action_type").select2({
        //     placeholder: "Action Type",
        //     allowClear: true,
        // });

        // $("#incident_category").select2({
        //     placeholder: "Incident Category",
        //     allowClear: true,
        // });

        // $("#tncident_type").select2({
        //     placeholder: "Incident Type",
        //     allowClear: true,
        // });

        $("#disc_discipline_type").select2({
            placeholder: "Discipline Type",
            allowClear: true,
        });

        //change_inc_action($('#inc_action_type').val());

        // $('#inc_any_witness').prop('checked', false);
        // change_inc_any_witness();

        // $('#inc_report_supervisor').prop('checked', false);
        // change_inc_report_supervisor();

        // $('#inc_report_hr').prop('checked', false);
        // change_inc_report_hr();


        $('#Disc_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Discipline'); // Set Title to Bootstrap modal title
    }

    //var save_method; //for save method string
    function add_actions_accident()
    {
        save_method = 'add';
        $('#emp_accident_action')[0].reset(); // reset form on modals

        $("#acc_action_type").select2({
            placeholder: "Action Type",
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

        $("#acc_discipline_type").select2({
            placeholder: "Discipline Type",
            allowClear: true,
        });

        change_acc_action($('#acc_action_type').val());

        $('#acc_any_witness').prop('checked', false);
        change_acc_any_witness();

        $('#acc_report_supervisor').prop('checked', false);
        change_acc_report_supervisor();

        $('#acc_report_hr').prop('checked', false);
        change_acc_report_hr();

        $('#first_aid_given').prop('checked', false);
        change_first_aid_given();

        $('#requires_hospitalization').prop('checked', false);
        change_Medical_Treatment();

        $('#any_benefit_provider').prop('checked', false);
        change_Worker_Comp();

        $('#accident_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Accident'); // Set Title to Bootstrap modal title
    }

    //========================================Incident===========================================================

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


    //$('#inc_discipline_type').change(function()
    function change_inc_data(val) {
        if (val == 1) { //1==verbal_warning
            $('#inc_verbal_warning_by_div').removeClass("hidden");
            $('#inc_subject_div').removeClass("hidden");
            $('#inc_description_div').removeClass("hidden");
            $('#inc_improvement_plan_div').removeClass("hidden");
            $('#inc_further_actions_div').removeClass("hidden");
            $('#inc_written_warning_by_div').addClass("hidden");
            $('#inc_suspended_from_div').addClass("hidden");
            $('#inc_suspended_to_div').addClass("hidden");
            $('#inc_counseled_by_div').addClass("hidden");
            $('#inc_verbal_warning_by').val("");
            $('#inc_written_warning_by').val("");
            $('#inc_subject').val("");
            $('#inc_description').val("");
            $('#inc_improvement_plan').val("");
            $('#inc_further_actions').val("");
            $('#inc_suspended_from').val("");
            $('#inc_suspended_to').val("");
            $('#inc_counseled_by').val("");
        } else if (val == 3) {//3==written_warning
            $('#inc_written_warning_by_div').removeClass("hidden");
            $('#inc_subject_div').removeClass("hidden");
            $('#inc_description_div').removeClass("hidden");
            $('#inc_improvement_plan_div').removeClass("hidden");
            $('#inc_further_actions_div').removeClass("hidden");
            $('#inc_verbal_warning_by_div').addClass("hidden");
            $('#inc_suspended_from_div').addClass("hidden");
            $('#inc_suspended_to_div').addClass("hidden");
            $('#inc_counseled_by_div').addClass("hidden");
            $('#inc_verbal_warning_by').val("");
            $('#inc_written_warning_by').val("");
            $('#inc_subject').val("");
            $('#inc_description').val("");
            $('#inc_improvement_plan').val("");
            $('#inc_further_actions').val("");
            $('#inc_suspended_from').val("");
            $('#inc_suspended_to').val("");
            $('#inc_counseled_by').val("");
        } else if (val == 4) {//4==counseled
            $('#inc_counseled_by_div').removeClass("hidden");
            $('#inc_subject_div').removeClass("hidden");
            $('#inc_description_div').removeClass("hidden");
            $('#inc_improvement_plan_div').removeClass("hidden");
            $('#inc_further_actions_div').removeClass("hidden");
            $('#inc_written_warning_by_div').addClass("hidden");
            $('#inc_verbal_warning_by_div').addClass("hidden");
            $('#inc_suspended_from_div').addClass("hidden");
            $('#inc_suspended_to_div').addClass("hidden");
            $('#inc_verbal_warning_by').val("");
            $('#inc_written_warning_by').val("");
            $('#inc_subject').val("");
            $('#inc_description').val("");
            $('#inc_improvement_plan').val("");
            $('#inc_further_actions').val("");
            $('#inc_suspended_from').val("");
            $('#inc_suspended_to').val("");
            $('#inc_counseled_by').val("");
        } else if (val == 5) {//5==suspended
            $('#inc_suspended_from_div').removeClass("hidden");
            $('#inc_suspended_to_div').removeClass("hidden");
            $('#inc_subject_div').removeClass("hidden");
            $('#inc_description_div').removeClass("hidden");
            $('#inc_improvement_plan_div').removeClass("hidden");
            $('#inc_further_actions_div').removeClass("hidden");
            $('#inc_written_warning_by_div').addClass("hidden");
            $('#inc_verbal_warning_by_div').addClass("hidden");
            $('#inc_counseled_by_div').addClass("hidden");
            $('#inc_verbal_warning_by').val("");
            $('#inc_written_warning_by').val("");
            $('#inc_subject').val("");
            $('#inc_description').val("");
            $('#inc_improvement_plan').val("");
            $('#inc_further_actions').val("");
            $('#inc_suspended_from').val("");
            $('#inc_suspended_to').val("");
            $('#inc_counseled_by').val("");
        } else
        {
            $('#inc_verbal_warning_by_div').addClass("hidden");
            $('#inc_written_warning_by_div').addClass("hidden");
            $('#inc_subject_div').addClass("hidden");
            $('#inc_description_div').addClass("hidden");
            $('#inc_improvement_plan_div').addClass("hidden");
            $('#inc_further_actions_div').addClass("hidden");
            $('#inc_suspended_from_div').addClass("hidden");
            $('#inc_suspended_to_div').addClass("hidden");
            $('#inc_counseled_by_div').addClass("hidden");
            $('#inc_verbal_warning_by').val("");
            $('#inc_written_warning_by').val("");
            $('#inc_subject').val("");
            $('#inc_description').val("");
            $('#inc_improvement_plan').val("");
            $('#inc_further_actions').val("");
            $('#inc_suspended_from').val("");
            $('#inc_suspended_to').val("");
            $('#inc_counseled_by').val("");
        }

    }
    //====================================end Incident=========================================================

    //========================================Accident========================================================== 

    function change_acc_any_witness()
    {
        //$('#acc_any_witness').change(function () {
        if ($('#acc_any_witness').is(":checked")) {
            $('#acc-wit').removeAttr("style");
            $('#acc-witt').removeAttr("style");
            $('#acc-wittt').removeAttr("style");
            $('#acc_any_witness').val('1');
        } else {
            $('#acc-wit').attr('style', 'display:none');
            $('#acc-witt').attr('style', 'display:none');
            $('#acc-wittt').attr('style', 'display:none');
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

    //$('#acc_discipline_type').change(function(){
    function change_acc_data(val)
    {
        if (val == 1) { //1==verbal_warning
            $('#acc_verbal_warning_by_div').removeClass("hidden");
            $('#acc_subject_div').removeClass("hidden");
            $('#acc_description_div').removeClass("hidden");
            $('#acc_improvement_plan_div').removeClass("hidden");
            $('#acc_further_actions_div').removeClass("hidden");
            $('#acc_written_warning_by_div').addClass("hidden");
            $('#acc_suspended_from_div').addClass("hidden");
            $('#acc_suspended_to_div').addClass("hidden");
            $('#acc_counseled_by_div').addClass("hidden");
            $('#acc_verbal_warning_by').val("");
            $('#acc_written_warning_by').val("");
            $('#acc_subject').val("");
            $('#acc_description').val("");
            $('#acc_improvement_plan').val("");
            $('#acc_further_actions').val("");
            $('#acc_suspended_from').val("");
            $('#acc_suspended_to').val("");
            $('#acc_counseled_by').val("");
        } else if (val == 3) {//3==written_warning
            $('#acc_written_warning_by_div').removeClass("hidden");
            $('#acc_subject_div').removeClass("hidden");
            $('#acc_description_div').removeClass("hidden");
            $('#acc_improvement_plan_div').removeClass("hidden");
            $('#acc_further_actions_div').removeClass("hidden");
            $('#acc_verbal_warning_by_div').addClass("hidden");
            $('#acc_suspended_from_div').addClass("hidden");
            $('#acc_suspended_to_div').addClass("hidden");
            $('#acc_counseled_by_div').addClass("hidden");
            $('#acc_verbal_warning_by').val("");
            $('#acc_written_warning_by').val("");
            $('#acc_subject').val("");
            $('#acc_description').val("");
            $('#acc_improvement_plan').val("");
            $('#acc_further_actions').val("");
            $('#acc_suspended_from').val("");
            $('#acc_suspended_to').val("");
            $('#acc_counseled_by').val("");
        } else if (val == 4) {//4==counseled
            $('#acc_counseled_by_div').removeClass("hidden");
            $('#acc_subject_div').removeClass("hidden");
            $('#acc_description_div').removeClass("hidden");
            $('#acc_improvement_plan_div').removeClass("hidden");
            $('#acc_further_actions_div').removeClass("hidden");
            $('#acc_written_warning_by_div').addClass("hidden");
            $('#acc_verbal_warning_by_div').addClass("hidden");
            $('#acc_suspended_from_div').addClass("hidden");
            $('#acc_suspended_to_div').addClass("hidden");
            $('#acc_verbal_warning_by').val("");
            $('#acc_written_warning_by').val("");
            $('#acc_subject').val("");
            $('#acc_description').val("");
            $('#acc_improvement_plan').val("");
            $('#acc_further_actions').val("");
            $('#acc_suspended_from').val("");
            $('#acc_suspended_to').val("");
            $('#acc_counseled_by').val("");
        } else if (val == 5) {//5==suspended
            $('#acc_suspended_from_div').removeClass("hidden");
            $('#acc_suspended_to_div').removeClass("hidden");
            $('#acc_subject_div').removeClass("hidden");
            $('#acc_description_div').removeClass("hidden");
            $('#acc_improvement_plan_div').removeClass("hidden");
            $('#acc_further_actions_div').removeClass("hidden");
            $('#acc_written_warning_by_div').addClass("hidden");
            $('#acc_verbal_warning_by_div').addClass("hidden");
            $('#acc_counseled_by_div').addClass("hidden");
            $('#acc_verbal_warning_by').val("");
            $('#acc_written_warning_by').val("");
            $('#acc_subject').val("");
            $('#acc_description').val("");
            $('#acc_improvement_plan').val("");
            $('#acc_further_actions').val("");
            $('#acc_suspended_from').val("");
            $('#acc_suspended_to').val("");
            $('#acc_counseled_by').val("");
        } else
        {
            $('#acc_verbal_warning_by_div').addClass("hidden");
            $('#acc_written_warning_by_div').addClass("hidden");
            $('#acc_subject_div').addClass("hidden");
            $('#acc_description_div').addClass("hidden");
            $('#acc_improvement_plan_div').addClass("hidden");
            $('#acc_further_actions_div').addClass("hidden");
            $('#acc_suspended_from_div').addClass("hidden");
            $('#acc_suspended_to_div').addClass("hidden");
            $('#acc_counseled_by_div').addClass("hidden");
            $('#acc_verbal_warning_by').val("");
            $('#acc_written_warning_by').val("");
            $('#acc_subject').val("");
            $('#acc_description').val("");
            $('#acc_improvement_plan').val("");
            $('#acc_further_actions').val("");
            $('#acc_suspended_from').val("");
            $('#acc_suspended_to').val("");
            $('#acc_counseled_by').val("");
        }

    }

    //======================================end Accident===========================================================


    $("#incident_category").select2({
        placeholder: "Incident Category",
        allowClear: true,
    });
    $("#tncident_type").select2({
        placeholder: "Incident Type",
        allowClear: true,
    });
    $("#inc_action_type").select2({
        placeholder: "Action Type",
        allowClear: true,
    });
    $("#inc_discipline_type").select2({
        placeholder: "Discipline Type",
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


    $(function () {
        $("#inc_witness_phone").mask("(999) 999-9999");
        $("#acc_witness_phone").mask("(999) 999-9999");
    });

</script>