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
                <form id="sing_acq_approval" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Acquisition_approval/update_sing_acq" enctype="multipart/form-data" role="form" >

                    <div id="employee_review_div">   
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-u">
                                    <div class="panel-heading">
                                        Acquisition Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">

                                            <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                                <tbody>
                                                    <?php
                                                    foreach ($query->result() as $row) {
                                                        ?>
                                                        <tr>
                                                            <input type="hidden" id="requisition_id" name="requisition_id" value="<?php echo $row->id ?>">
                                                            <th>Requisition Code : </th>
                                                            <td><?php echo $row->requisition_code ?></td>
                                                            <th>Requisitions Date : </th>
                                                            <td><?php echo $this->Common_model->show_date_formate($row->requisitions_date) ?> <?php // echo ucwords($prow->last_name);           ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Due Date : </th>
                                                            <td><?php echo $this->Common_model->show_date_formate($row->due_date) ?></td>
                                                            <th>Location : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->location_id, 'main_location', 'location_name'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Department : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name'); ?></td>
                                                            <th>Position : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->position_id, 'main_positions', 'positionname') ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Reporting Manager : </th>
                                                            <td><?php
                                                                $manager_id = $this->Common_model->get_name($this, $row->reporting_manager_id, 'main_employees', 'employee_id');
                                                                echo $this->Common_model->employee_name($manager_id);
                                                                ?>
                                                            </td>
                                                            <th>No. of Positions : </th>
                                                            <td><?php echo $row->no_of_positions ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Qualification : </th>
                                                            <td><?php echo $row->required_qualification ?></td>
                                                            <th>Experience Range : </th>
                                                            <td><?php echo $row->experience_range ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Employment Status : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->employment_status_id, 'main_employmentstatus', 'description') ?></td>
                                                            <th>Priority: </th>
                                                            <td>
                                                                <?php
                                                                if ($row->priority != 0) {
                                                                    echo $priority_array[$row->priority];
                                                                } else {
                                                                    echo '';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Job Description : </th>
                                                            <td><?php echo $row->job_description; ?></td>
                                                            <th>Required Skills</th>
                                                            <td><?php echo $row->required_skills; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Additional Information : </th>
                                                            <td><?php echo $row->additional_information; ?></td>                                        
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

                    <div class="form-group">                        
                        <label class="control-label pull-left"><h4>Status<span class="req"/></h4></label>
                        <div class="col-sm-4">
                            <select name="sing_acq_status" id="sing_acq_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($acquisition_status as $key => $val):
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>                        
                            </select> 
                        </div>
                    </div>

                    <div class="modal-footer"> 
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Acquisition_approval" ?>">Close</a>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sing_acq_approval").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sing_acq_approval").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Acquisition_approval';
                view_message(data, url, '', 'sing_acq_approval');

            });
            event.preventDefault();
        });
    });

    $("#sing_acq_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->

