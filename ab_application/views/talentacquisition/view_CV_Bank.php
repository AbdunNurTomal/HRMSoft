<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_CV_Bank/search_CV_Bank/'; ?>" method="post">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Resume Type </label>
                                    <div class="col-sm-8">
                                        <select name="resume_type" id="resume_type" class="col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($resume_type as $key => $val){
                                                $slct = ($search_criteria['resume_type'] != "" && $search_criteria['resume_type'] == $key) ? 'selected' : '';
                                                echo '<option value="' . $key . '" ' . $slct . '>' . $val . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">  Requisition  </label>
                                    <div class="col-sm-8">
                                        <select name="requisition_id" id="requisition_id" class="col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($opening_position_query->result() as $key) {
                                                $position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                                $position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                
                                                $slct = ($search_criteria['requisition_id'] == $key->id) ? 'selected' : '';
                                                echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->requisition_code . "  ( " . $position_name . " ) " . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Qualification </label>
                                    <div class="col-sm-8">
                                        <select name="qualification" id="qualification" class="col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($educationlevel_query->result() as $key) {
                                                $slct = ($search_criteria['qualification'] != "" && $search_criteria['qualification'] == $key->id) ? 'selected' : '';
                                                echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->educationlevelcode . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Skill Set </label>
                                    <div class="col-sm-8">
                                       <select name="skill_set" id="skill_set" class="col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($skill_query->result() as $key) {
                                                $slct = ($search_criteria['skill_set'] != "" && $search_criteria['skill_set'] == $key->id) ? 'selected' : '';
                                                echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->skill_name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Experience </label>
                                <div class="col-sm-8">
                                   <select name="experience" id="experience" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($experience_query->result() as $key) {
                                            $slct = ($search_criteria['experience'] != "" && $search_criteria['experience'] == $key->work_experience) ? 'selected' : '';
                                            echo '<option value="' . $key->work_experience . '" ' . $slct . '>' . $key->work_experience . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Status </label>
                                <div class="col-sm-8">
                                    <select name="status" id="status" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($candidate_status as $key=>$val) {
                                            $slct = ($search_criteria['status'] !="" && $search_criteria['status'] == $key) ? 'selected' : '';
                                            echo '<option value="' . $key . '" ' . $slct . '>' . $val . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                
                <div class="overflow-x">
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
<!--                            <th>Resume Type</th>
                            <th>Requisition Id</th>
                            <th>Position</th>-->
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile</th> 
<!--                            <th>Qualification</th>
                            <th>Work Experience</th>
                            <th>Skill Set</th>-->
                            <th>Status</th>
                            <th>Resume</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $candidate_status = $this->Common_model->get_array('candidate_status');
                        if ($search_data) {
                            $sl=0;
                            foreach ($search_data as $row) {
                                
                                $skill_set_arr = explode(",", $row->skill_set);
                                $skill_set = '';
                                foreach ($skill_set_arr as $intr) {
                                    if ($skill_set == '') {
                                        $skill_set = $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                    } else {
                                        $skill_set = $skill_set . " , " . $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                    }
                                }
                                
//                                $qualification_arr = explode(",", $row->qualification);
//                                $qualification = '';
//                                foreach ($qualification_arr as $intr) {
//                                    if ($qualification == '') {
//                                        $qualification = $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
//                                    } else {
//                                        $qualification = $qualification . " , " . $this->Common_model->get_name($this, $intr, 'main_educationlevelcode', 'educationlevelcode');
//                                    }
//                                }

                                $position_id=$this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','position_id');
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $resume_type[$row->resume_type] . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$position_id,'main_jobtitles','job_title') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_first_name ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_last_name ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_email."</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->contact_number . "</td>";
//                                print"<td id='catA" . $pdt . "'>" . $qualification ."</td>";
//                                print"<td id='catA" . $pdt . "'>" . $row->work_experience ."</td>";
//                                print"<td id='catA" . $pdt . "'>" . $skill_set ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $candidate_status[$row->status] ."</td>";
                                print"<td id='catA" . $pdt . "'><a href='" . base_url() . "Con_CV_Bank/download_resume/" . $row->upload_resume_path . "/" . "' > ". $row->upload_resume_path ." </a></td>";
                                print"<td><div class='action-buttons '> &nbsp; <a title='Preview' href='" . base_url() . "Con_CV_Bank/view_CVManagement/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;</div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
                </div>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    $("#resume_type").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
    $("#requisition_id").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
    $("#qualification").select2({
        placeholder: "Select qualification",
        allowClear: true
    });
    $("#skill_set").select2({
        placeholder: "Select skill set",
        allowClear: true
    });
    $("#experience").select2({
        placeholder: "Select experience",
        allowClear: true
    });
    $("#status").select2({
        placeholder: "Select status",
        allowClear: true
    });
        
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_CVManagement/delete_CVManagement/" + id;
        else
            return false;
    }


</script>
<!--=== End Content ===-->

