<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Interview_Candidate/search_for_Interview/'; ?>" method="post">
                    <div class="row">
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">  Requisition  </label>
                                <div class="col-sm-8">
                                    <select name="requisition_idd" id="requisition_idd" onchange="load_schedule_group(this.value)" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($opening_position_query->result() as $key) {
                                            $position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                            $position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');

                                            $slct = ($search_criteria['requisition_idd'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->requisition_code . "  ( " . $position_name . " ) " . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Schedule Group </label>
                                <div class="col-sm-8">
                                    <select name="schedule_group" id="schedule_group" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        $scquery = $this->db->get_where('main_schedule', array('isactive' => 1, 'requisition_id' => $search_criteria['requisition_idd']));
                                        foreach ($scquery->result() as $row){
                                            $slct = ($search_criteria['schedule_group'] != "" && $search_criteria['schedule_group'] == $row->id) ? 'selected' : '';
                                            echo '<option value="' . $row->id . '" ' . $slct . '>' . $row->schedule_group . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
                
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!--<th>Resume Type</th>-->
<!--                            <th>Requisition Id</th>
                            <th>Position</th>-->
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $interview_status = $this->Common_model->get_array('interview_status');
                        if ($search_data) {
                            $sl=0;
                            foreach ($search_data as $row) {
                                $position_id=$this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','position_id');
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $resume_type[$this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','resume_type')] ."</td>";
                                //print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$position_id,'main_jobtitles','job_title') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','candidate_first_name') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','candidate_last_name') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','candidate_email') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','contact_number') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_status[$row->interview_status]."</td>";
                                print"<td><div class='action-buttons '><a title='Interview' href='" . base_url() . "Con_Interview_Candidate/set_Interview_panel/" . $row->id . "/" . "' ><i class='fa fa-question-circle' aria-hidden='true'>&nbsp;</i></a> &nbsp; <a title='Preview' href='" . base_url() . "Con_Interview_Candidate/view_Candidate/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;</div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
    
    $("#requisition_idd").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
    $("#schedule_group").select2({
        placeholder: "Select schedule group",
        allowClear: true
    });

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_Interview_Candidate/delete_Scheduled/" + id;
        else
            return false;
    }
    
    function load_schedule_group(id){
        
        $.ajax({
            url: "<?php echo site_url('Con_Interview_Candidate/load_schedule_group/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                
                $('#schedule_group').html("");
                $('#schedule_group').html(data);
                
                $("#schedule_group").select2({
                    placeholder: "Select schedule group",
                    allowClear: true,
                });
            }
        });
        
    }

</script>
<!--=== End Content ===-->

