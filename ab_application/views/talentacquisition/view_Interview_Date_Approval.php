<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Interview_Date_Acceptance/save_Interview_Date_Acceptance" enctype="multipart/form-data" role="form" >
                <div class="col-md-12" style="margin-top: 10px">
                    <div id="employee_review_div">   
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-u">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-tasks"></i> Interview Date Approval </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                                <tbody>
                                                    <?php
                                                    foreach ($query->result() as $row) {
                                                        ?>
                                                        <tr>
                                                            <th>Requisition Id : <input type="hidden" id="schedule_id" name="schedule_id" value="<?php echo $row->id ?>"> </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'requisition_code') ?></td>
                                                            <th>Position : </th>
                                                            <td>
                                                                <?php
                                                                $position_id = $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'position_id');
                                                                echo $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                                ?> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Candidate Name : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'candidate_first_name') ?></td>
                                                            <th>Interviewer : </th>
                                                            <td>
                                                                <?php
                                                                $interview_array = explode(",", $row->interviewer);
                                                                //pr($interview_array,1);
                                                                $int_name = '';
                                                                foreach ($interview_array as $key) {
                                                                    if ($int_name == '') {
                                                                        $int_name = $this->Common_model->get_selected_value($this, 'employee_id', $key, 'main_employees', 'first_name');
                                                                    } else {
                                                                        $int_name = $int_name . " , " . $this->Common_model->get_selected_value($this, 'employee_id', $key, 'main_employees', 'first_name');
                                                                    }
                                                                }
                                                                echo $int_name;
                                                                ?>
                                                            </td>
                                                        </tr>                                                    
                                                        <tr>                                                        
                                                            <th>Interview Date : </th>
                                                            <td><?php echo $this->Common_model->show_date_formate($row->interview_date) ?> </td>
                                                            <th>Interview Time : </th>
                                                            <td><?php echo $row->interview_time ?></td>

                                                        </tr>
                                                        <tr>
                                                            <th>Location : </th>
                                                            <td><?php echo $row->location ?></td>
                                                            <th>Description : </th>
                                                            <td><?php echo $row->description ?></td>
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
                                        <div class="col-md-12" style="margin-top: 10px">
                                            <div class="form-group ">
                                                <label class="col-sm-2 control-label"> Status <span class="req"/></label>
                                                <div class="col-sm-4">                            
                                                    <select name="acceptance_status" id="acceptance_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                                        <option></option>
                                                        <?php
                                                        foreach ($approver_status as $key => $val):
                                                            ?>
                                                            <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                                            <?php
                                                        endforeach;
                                                        ?>                        
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div> 
                    <div class="modal-footer">
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Interview_Date_Acceptance" ?>">Close</a>
                        <button type="submit" id="submit" class="btn btn-u"> Process </button>
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

    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Interview_Date_Acceptance';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    $("#acceptance_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });


</script>
<!--=== End Script ===-->

