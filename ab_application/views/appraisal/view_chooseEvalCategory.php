
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
            <h2>Choose a Performance Review Form</h2>
            <p>Select a form you want to use to evaluate this employee from below.</p>
            <br/><br/>
            <form class="form-horizontal review-info" method="post" action="<?php echo base_url() . 'Con_PerformanceReviewBuilder/ratingLanguage/' . $employee_id; ?>" enctype="multipart/form-data" role="form">
                <div class="col-sm-5" style="padding-top:15px">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <?php
                            //print_r($review_form_type);
                            $k = 0;
                            if (!empty($review_form_type)) {
                                foreach ($review_form_type as $row) {
                                    $chk = ($k == 0) ? 'checked' : '';
                                    echo '<input type="radio" name="reviewFormType" class="reviewFormValue" eval_ids="' . $row->cat_id . '" value="' . $row->form_id . '#' . $row->cat_id . '" ' . $chk . '/> &nbsp;' . $row->form_name . '<br/>';
                                    $k++;
                                }
                            }
                            ?>
                            <?php /* <input type="radio" name="reviewFormType" id="customReviewForm" /> &nbsp;<a href="<?php echo base_url() . 'Con_PerformanceReviewBuilder/customReviewForm/'; ?>">Create Your Own</a> &nbsp;
                              <a href="javascript:void();" data-toggle="tooltip" data-placement="right" title="<?php echo $custom_tooltip_title; ?>">
                              <img src="<?php echo base_url() . 'assets/img/question_custom.gif'; ?>" style="display:inline-block; margin-top:-4px;" />
                              </a> */ ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group container well evalWrp">
                        <div class="col-sm-12">
                            <p>This performance review will include the following evaluation categories:</p>
                        </div>
                        <div class="col-sm-12">
                            <ol>
                                <!------Evaluation Category Here------>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 subWrp">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-u nxt-btn">NEXT  &nbsp;<i class="fa fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- end container well div -->
</div>
</div>

</div><!--/row-->
</div><!--/container-->
<link rel="stylesheet" type="" href="<?php echo base_url() . 'assets/jquery-ui-autocomplete/jquery-ui.css'; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.js"></script>
<style type="text/css">
    .startBtnWrp{text-align:center}
    [data-wizard-init] {
        margin: auto;
        width: 100%;
    }
    .top-actions{display:none !important}
    form.review-info h4{margin:30px 0 20px !important}
    .evalWrp{padding:15px; box-sizing:border-box}
    .subWrp{margin-top:20px; text-align:right}
</style>
<script type="text/javascript" src="<?php echo base_url() . 'assets/jquery-ui-autocomplete/jquery-ui.js'; ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        /* var firstEvalId = $(".reviewFormValue:first").attr('eval_ids'); */
        var firstEvalId = $(".reviewFormValue:first").val();
        get_evalCat(firstEvalId);

        $(".reviewFormValue").on('change', function () {
            /* var evalId = $(".reviewFormValue:checked").attr('eval_ids'); */
            var evalId = $(".reviewFormValue:checked").val();
            get_evalCat(evalId);
        });
    });

    function get_evalCat(evalId) {
        var data = {
            "cat_ids_arr": evalId
        };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() . 'Con_PerformanceReviewBuilder/get_reviewCategories'; ?>",
            data: data,
            success: function (data) {
                $('.evalWrp ol').html(data['response']);
                if (data['empty']) {
                    $(".nxt-btn").attr('disabled', '');
                } else {
                    $(".nxt-btn").removeAttr('disabled');
                }
            }
        });
    }
</script>
<!--=== End Content ===-->
