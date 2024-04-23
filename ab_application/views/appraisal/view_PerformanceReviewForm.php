<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container-fluid" style="padding:0 17px 10px">
            <div data-wizard-init>
                <ul class="steps">
                    <li data-step="1" class="<?php echo ($step == 1) ? 'active' : ''; ?>">Review Information</li>
                    <li data-step="2" class="<?php echo ($step == 2) ? 'active' : ''; ?>">Select Review Form</li>
                    <li data-step="3" class="<?php echo ($step == 3) ? 'active' : ''; ?>">Rating Language</li>
                    <li data-step="4" class="<?php echo ($step == 4) ? 'active' : ''; ?>">Rate Competencies</li>
                    <li data-step="5" class="<?php echo ($step == 5) ? 'active' : ''; ?>">Performance Summary</li>
                    <li data-step="6" class="<?php echo ($step == 6) ? 'active' : ''; ?>">Generate/Save Document</li>
                </ul>
            </div>
        </div><!--/.fluid-container-->

        <!-- container tag-box tag-box-v3 div -->   
        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">
            <h2>Performance Review Form</h2>
            <div>
                <p>Performance reviews play a key role in helping to guide employees’ performance, compensation and professional development.
                    When you think about it, effective performance reviews should result in helping you to achieve your company’s goals by aligning your employees’ development and growth with that of your business. 
                    Employees are generally more productive and motivated when they understand how they are contributing to your business. 
                    Finally, the performance review process should also enhance communications between the employee and his or her manager.</p>

                <br/>
                <form class="form-horizontal review-info" method="post" action="<?php echo base_url() . 'Con_PerformanceReviewBuilder/chooseEvalCategory/' . $employee_id; ?>" enctype="multipart/form-data" role="form">

                    <div class="col-sm-12">
                        <h4>Employee Information</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-3">
                                <input type="text" name="first_name" class="form-control col-sm-12" value="<?php echo $single_employee->first_name; ?>" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Middle Name</label>
                            <div class="col-sm-3">
                                <input type="text" name="middle_name" class="form-control col-sm-12" value="<?php echo $single_employee->middle_name; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-3">
                                <input type="text" name="last_name" class="form-control col-sm-12" value="<?php echo $single_employee->last_name; ?>" required="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-3">
                                <label><input type="radio" name="gender" value="1" <?php echo ($single_employee->gender == 1) ? 'checked' : ''; ?> required /> &nbsp; Male </label> <br/>
                                <label><input type="radio" name="gender" value="2" <?php echo ($single_employee->gender == 2) ? 'checked' : ''; ?> required /> &nbsp; Female </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Position</label>
                            <div class="col-sm-3">
                                <input type="hidden" name="position" value="<?php echo $single_employee->position; ?>" />
                                <input type="text" readonly id="job_title" class="form-control col-sm-12" value="<?php echo $this->Common_model->get_name($this, $single_employee->position, 'main_positions', 'positionname'); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Date of Review</label>
                            <div class="col-sm-3">
                                <input type="text" name="review_date" class="form-control col-sm-12 dt_pick" value="<?php echo date('m-d-Y'); ?>" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4>Review Period</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Period Covered</label>
                            <div class="col-sm-3">
                                <label><input type="radio" name="period_covered" value="six_month" checked /> &nbsp; 6-Month Review </label> <br/>
                                <label><input type="radio" name="period_covered" value="annual" /> &nbsp; Annual </label> <br/>
                                <label><input type="radio" name="period_covered" value="merit" /> &nbsp; Merit </label> <br/>
                                <label><input type="radio" name="period_covered" value="promotion" /> &nbsp; Promotion </label> <br/>
                                <label><input type="radio" name="period_covered" value="end_of_intro" /> &nbsp; End of Introduction Period </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Start Date</label>
                            <div class="col-sm-3">
                                <input type="text" name="start_date" class="form-control col-sm-12 dt_pick" value="" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">End Date</label>
                            <div class="col-sm-3">
                                <input type="text" name="end_date" class="form-control col-sm-12 dt_pick" value="" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4>Reviewer</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-3">
                                <input type="text" name="reviewer_first_name" class="form-control col-sm-12" value="<?php echo $user_name; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-3">
                                <input type="text" name="reviewer_last_name" class="form-control col-sm-12" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4>Action Plan</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Include Action Plan?</label>
                            <div class="col-sm-3">
                                <label><input type="radio" name="include_action_plan" value="1" /> &nbsp; Yes </label> <br/>
                                <label><input type="radio" name="include_action_plan" value="0" checked /> &nbsp; No </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 subWrp">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-u">NEXT  &nbsp;<i class="fa fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- end container tag-box tag-box-v3 div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<link rel="stylesheet" type="" href="<?php echo base_url() . 'assets/jquery-ui-autocomplete/jquery-ui.css'; ?>">
<script type="text/javascript" src="<?php echo base_url() . 'assets/jquery-ui-autocomplete/jquery-ui.js'; ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.js"></script>
<style type="text/css">
    .startBtnWrp{text-align:center}
    .subWrp{margin-top:20px; text-align:right}
    form.review-info h4{margin:30px 0 20px !important}
    [data-wizard-init] {
        margin: auto;
        width: 100%;
    }
    .top-actions{display:none !important}
</style>

<!--=== End Content ===-->