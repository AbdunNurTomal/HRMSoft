<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <div class="col-md-12" style="margin-top: 10px">

                <div id="employee_review_div">   
                    <div class="panel panel-u margin-bottom-40">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-tasks"></i> Requisition Information </h3>
                        </div>
                        <div class="panel-body">
                            <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                <tbody>
                                    <?php
                                    foreach ($query->result() as $row) {
                                        ?>
                                    <input type="hidden" id="requisition_id" name="requisition_id" value="<?php echo $row->id ?>">
                                    <tr>
                                        <th style=" width: 400px; ">Requisition Id : </th>
                                        <td><?php echo $row->requisition_code ?></td>
                                    </tr>
                                    <tr>
                                        <th>Requisitions Date : </th>
                                        <td><?php echo $this->Common_model->show_date_formate($row->requisitions_date) ?> </td>
                                    </tr>
                                    <tr>
                                        <th>Due Date : </th>
                                        <td><?php echo $this->Common_model->show_date_formate($row->due_date) ?></td>
                                    </tr>
                                    <tr>    
                                        <th>Position : </th>
                                        <td><?php echo $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') ?></td>
                                    </tr>
                                    <tr>    
                                        <th>No Of Application : </th>
                                        <td>
                                            <?php
                                            $this->db->select('id');
                                            $this->db->from('main_cv_management');
                                            $this->db->where('requisition_id', $row->id);
                                            $this->db->where('isactive', 1);
                                            $this->db->where('is_close', 0);
                                            echo $num_results = $this->db->count_all_results();
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>    
                                        <th>Selected Candidates : </th>
                                        <td>
                                            <?php
                                            $this->db->select('id');
                                            $this->db->from('main_cv_management');
                                            $this->db->where('requisition_id', $row->id);
                                            $this->db->where('status', 3);
                                            $this->db->where('isactive', 1);
                                            $this->db->where('is_close', 0);
                                            echo $num_results = $this->db->count_all_results();
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>    
                                        <th>Rejected Candidates : </th>
                                        <td>
                                            <?php
                                            $this->db->select('id');
                                            $this->db->from('main_cv_management');
                                            $this->db->where('requisition_id', $row->id);
                                            $this->db->where('status', 4);
                                            $this->db->where('isactive', 1);
                                            $this->db->where('is_close', 0);
                                            echo $num_results = $this->db->count_all_results();
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>    
                                        <th>Prepare by : </th>
                                        <td><?php echo $this->Common_model->get_name($this, $row->createdby, 'main_users', 'name') ?></td>
                                    </tr>
                                    <tr>    
                                        <th>Approval by : </th>
                                        <td><?php echo $this->Common_model->get_name($this, $row->modifiedby, 'main_users', 'name') ?></td>
                                    </tr>
                                    <tr>    
                                        <th>Schedule by : </th>
                                        <td><?php
                                            $schedule_by = $this->Common_model->get_selected_value($this, "requisition_id", $row->id, "main_schedule", "createdby");
                                            echo $this->Common_model->get_name($this, $schedule_by, 'main_users', 'name');
                                            ?></td>
                                    </tr>
                                    <tr>    
                                        <th>Request for Candidate by  : </th>
                                        <td><?php
                                            $request_by = $this->Common_model->get_selected_value($this, "requisition_id", $row->id, "main_interview_schedule", "createdby");
                                            echo $this->Common_model->get_name($this, $request_by, 'main_users', 'name');
                                            ?></td>
                                    </tr>
                                    <tr>    
                                        <th>Candidate Short List by  : </th>
                                        <td><?php
                                            $shortlist_by = $this->Common_model->get_selected_value($this, "requisition_id", $row->id, "main_candidate_interview", "createdby");
                                            echo $this->Common_model->get_name($this, $shortlist_by, 'main_users', 'name');
                                            ?></td>
                                    </tr>
                                    <tr>    
                                        <th>Candidate Select by  : </th>
                                        <td><?php
                                            $candidateselect_by = $this->Common_model->get_selected_value($this, "requisition_id", $row->id, "main_candidate_interview", "modifiedby");
                                            echo $this->Common_model->get_name($this, $candidateselect_by, 'main_users', 'name');
                                            ?></td>
                                    </tr>
                                    <tr>    
                                        <th>Requisition Close by : </th>
                                        <td><?php echo $this->Common_model->get_name($this, $row->close_by, 'main_users', 'name'); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 

                <div class="modal-footer">                        
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Requisition_History" ?>"> Close </a>
                </div>

            </div>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Close_Requisition';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });


</script>
<!--=== End Script ===-->

