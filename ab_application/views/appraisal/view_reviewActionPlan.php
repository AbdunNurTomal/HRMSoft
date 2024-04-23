
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
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

            <form class="form-horizontal review-info" method="post" action="<?php echo base_url() . 'Con_PerformanceReviewBuilder/save_reviewActionPlan/' . $this->uri->segment(3) . '/' . $appr_data->temp_app_id; ?>" enctype="multipart/form-data" role="form">
                <div class="col-sm-12">
                    <h4 style="margin-bottom:40px">Review Action Plan</h4>
                </div>
                <div class="col-sm-12">
                    <p><b>Action Plan</b></p>
                    <p>The above criteria are important to properly evaluate your performance. The following Action Plan describes your specific strengths and weaknesses, and what can be done to improve your position toward continued growth.</p>
                    <br/>
                </div>

                <?php
                if ($action_plan && ($action_plan->num_rows() > 0)) {
                    foreach ($action_plan->result() as $row) {
                        ?>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12"><?php echo $row->plan_name; ?></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control col-sm-12" name="action_plan[<?php echo $row->plan_id; ?>]" required></textarea>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <p class="center-align" style="margin-top:50px">
                        <span style="color:red;font-size:18px;line-height:24px">No Action Plan Available yet !</span>
                        <a style="font-style:italic" target="_blank" href="<?php echo base_url() . 'Con_ActionPlan/add_actionPlan'; ?>">Click to Add</a>
                    </p>
                <?php } ?>

                <div class="col-sm-12 subWrp">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-u" <?php echo ($action_plan->num_rows() > 0) ? '' : 'disabled' ?>>NEXT  &nbsp;<i class="fa fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.js"></script>
<style type="text/css">
    [data-wizard-init] {
        margin: auto;
        width: 100%;
    }
    .top-actions{display:none !important}
    .subWrp{margin-top:20px; text-align:right}
</style>
<!--Add item script-->       
<script type="text/javascript">
    $(document).ready(function () {

    });

    $(function () {
        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $('#sky-form11')[0].reset();

                var url = '<?php echo base_url() ?>con_User';
                view_message(data, url);

            });
            event.preventDefault();
        });
    });

    $("#parent_user").select2({
        placeholder: "Parent User",
        allowClear: true,
    });

    $("#user_group").select2({
        placeholder: "User Group",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->
