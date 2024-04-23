
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
            <h2>Choose a Performance Rating Language</h2>
            <p>Select the rating language that you would like to use.</p>
            <br/><br/>
            <form class="form-horizontal review-info" method="post" action="<?php echo base_url() . 'Con_PerformanceReviewBuilder/rateCompetencies/' . $employee_id; ?>" enctype="multipart/form-data" role="form">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <?php if (!empty($rating_language)) { ?>

                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Rating Level</th>
                                            <?php
                                            foreach ($rating_language as $value) {
                                                echo '<th><input type="radio" name="rating_language" class="ratingRadio" value="' . $value->rlang_id . '" required/></th>';
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rating 5</td>
                                            <?php
                                            foreach ($rating_language as $value) {
                                                echo '<td>' . $value->rating_5 . '</td>';
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td>Rating 4</td>
                                            <?php
                                            foreach ($rating_language as $value) {
                                                echo '<td>' . $value->rating_4 . '</td>';
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td>Rating 3</td>
                                            <?php
                                            foreach ($rating_language as $value) {
                                                echo '<td>' . $value->rating_3 . '</td>';
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td>Rating 2</td>
                                            <?php
                                            foreach ($rating_language as $value) {
                                                echo '<td>' . $value->rating_2 . '</td>';
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td>Rating 1</td>
                                            <?php
                                            foreach ($rating_language as $value) {
                                                echo '<td>' . $value->rating_1 . '</td>';
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>

                            <?php } else { ?>

                                <p class="center-align" style="margin-top:20px">
                                    <span style="color:red;font-size:18px;line-height:24px">No rating Language Available yet !</span>
                                    <a style="font-style:italic" target="_blank" href="<?php echo base_url() . 'Con_RatingLanguage/add_ratingLanguage'; ?>">Click to Add</a>
                                </p>

                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 subWrp">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-u" <?php echo (empty($rating_language)) ? 'disabled' : ''; ?>>NEXT  &nbsp;<i class="fa fa-chevron-right"></i></button>
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
        var firstEvalId = $(".reviewFormValue:first").attr('eval_ids');
        get_evalCat(firstEvalId);

        $(".reviewFormValue").on('change', function () {
            var evalId = $(".reviewFormValue:checked").attr('eval_ids');
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
            }
        });
    }
</script>
<!--=== End Content ===-->
