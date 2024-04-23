<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <div id="employee_review_div">   
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-u">
                                <div class="panel-heading">
                                    Scheduled Interview Information
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">

                                        <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                            <tbody>
                                                <?php
                                                foreach ($query->result() as $row) {
                                                    ?>
                                                    <tr>
                                                        <th>Requisition Id : </th>
                                                        <td><?php echo $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') ?></td>
                                                        <th>Position : </th>
                                                        <td>
                                                            <?php 
                                                                $position_id=$this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','position_id');
                                                                echo $this->Common_model->get_name($this,$position_id,'main_jobtitles','job_title'); 
                                                            ?> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Candidate Name : </th>
                                                        <td><?php echo $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','candidate_first_name') ?></td>
                                                        <th>Interviewer : </th>
                                                        <td>
                                                            <?php
                                                            $interview_array=explode(",", $row->interviewer);
                                                           //pr($interview_array,1);
                                                            $int_name='';
                                                            foreach ($interview_array as $key){
                                                                if($int_name=='')
                                                                {
                                                                    $int_name=$this->Common_model->get_selected_value($this, 'employee_id', $key, 'main_employees', 'first_name');
                                                                }
                                                                else {
                                                                    $int_name=$int_name." , ".$this->Common_model->get_selected_value($this, 'employee_id', $key, 'main_employees', 'first_name');
                                                                }
                                                            }
                                                            echo $int_name;
                                                            
                                                            ?>
                                                        </td>
                                                    </tr>                                                    
                                                    
                                                    <tr>
                                                        <th>Contact Number : </th>
                                                        <td><?php echo $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','contact_number') ?></td>
                                                        <th>Email : </th>
                                                        <td><?php echo $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','candidate_email') ?></td>
                                                    </tr>
                                                    <tr>                                                        
                                                        <th>Interview Date : </th>
                                                        <td><?php echo $this->Common_model->show_date_formate($row->interview_date) ?> </td>
                                                        <th>Location : </th>
                                                        <td><?php echo $row->location ?></td>
                                                    </tr>
                                                    <tr>
                                                         <th>Description : </th>
                                                        <td><?php echo $row->description ?></td>
                                                        <th>Interview Time : </th>
                                                        <td><?php echo $row->interview_time ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status : </th>
                                                        <td>
                                                            <?php 
                                                            $interview_status = $this->Common_model->get_array('interview_status');
                                                            echo $interview_status[$row->interview_status];
//                                                            echo ($row->employee_category == 0? 'Not Define': $employee_type_array[$row->employee_category]);
                                                            ?>
                                                        </td>
                                                    </tr>                                                    
                                                    <?php
                                                }
                                                ?>     
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>        
                    </div>
                </div> 
                <div class="modal-footer">
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_ScheduledInterviews" ?>">Close</a>
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
        $("#sing_req_form").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sing_req_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Requisitions_Approval';
                view_message(data, url, '', 'sing_req_form');

            });
            event.preventDefault();
        });
    });

     $("#sing_req_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });
    

</script>
<!--=== End Script ===-->

