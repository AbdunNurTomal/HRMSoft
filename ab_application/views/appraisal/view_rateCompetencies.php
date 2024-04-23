<?php
/* $cat_ids = array_column($review_categories, 'cat_id'); */
$cat_ids = array();
foreach ($review_categories as $row) {
    $cat_ids[] = $row->cat_id;
}
$current_cat_index = array_search($current_cat_id, $cat_ids);
$nextInd = $current_cat_index + 1;
?>

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
            <h2>Rate Competencies</h2>                        
            <p><?php echo 'Item ' . ($current_cat_index + 1) . ' of ' . (count($review_categories)) . ' Items'; ?></p>
            <ul class="categoryPagination">
                <?php
                if (!empty($review_categories)) {
                    foreach ($review_categories as $key => $row) {
                        $current_class = ($current_cat_index == $key) ? 'btn-w btn-u' : 'btn-u';
                        echo '<li><a href="' . base_url() . 'Con_PerformanceReviewBuilder/rateCompetencies/' . $employee_id . '/' . $row->cat_id . '" class="btn ' . $current_class . '">' . ( ++$key) . '</a></li>';
                    }

                    if (array_key_exists($nextInd, $cat_ids)) {
                        echo '<li><a href="' . base_url() . 'Con_PerformanceReviewBuilder/rateCompetencies/' . $employee_id . '/' . $review_categories[$nextInd]->cat_id . '" class="btn btn-u">NEXT  &nbsp;<i class="fa fa-chevron-right"></i></a></li>';
                    }
                }
                ?>
            </ul>
            <br/>

            <?php // echo "===>>>>> ".$nextInd; pr($review_categories); ?>

            <?php $NextCatId = (array_key_exists($nextInd, $review_categories)) ? $review_categories[$nextInd]->cat_id : 'complete'; ?>
            <form class="form-horizontal review-info" method="post" action="<?php echo base_url() . 'Con_PerformanceReviewBuilder/rate_single_category/' . $employee_id . '/' . $NextCatId; ?>" enctype="multipart/form-data" role="form">

                <input type="hidden" name="temp_app_id" value="<?php echo $temp_app_id; ?>" />
                <input type="hidden" name="current_cat_id" value="<?php echo $review_categories[$current_cat_index]->cat_id; ?>" />

                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="center-text"><?php echo $review_categories[$current_cat_index]->cat_name; ?></th>
                                        <th>N/A</th>
                                        <th><?php echo $rating_language->rating_1; ?></th>
                                        <th><?php echo $rating_language->rating_2; ?></th>
                                        <th><?php echo $rating_language->rating_3; ?></th>
                                        <th><?php echo $rating_language->rating_4; ?></th>
                                        <th><?php echo $rating_language->rating_5; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($review_competency)) {
                                        foreach ($review_competency as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row->com_name; ?></td>
                                                <td><input type="radio" name="com_ids[<?php echo $row->com_id; ?>]" com_id="<?php echo $row->com_id; ?>" class="ratings" value="0" checked=""/></td>
                                                <td><input type="radio" name="com_ids[<?php echo $row->com_id; ?>]" com_id="<?php echo $row->com_id; ?>" class="ratings" value="1" /></td>
                                                <td><input type="radio" name="com_ids[<?php echo $row->com_id; ?>]" com_id="<?php echo $row->com_id; ?>" class="ratings" value="2" /></td>
                                                <td><input type="radio" name="com_ids[<?php echo $row->com_id; ?>]" com_id="<?php echo $row->com_id; ?>" class="ratings" value="3" /></td>
                                                <td><input type="radio" name="com_ids[<?php echo $row->com_id; ?>]" com_id="<?php echo $row->com_id; ?>" class="ratings" value="4" /></td>
                                                <td><input type="radio" name="com_ids[<?php echo $row->com_id; ?>]" com_id="<?php echo $row->com_id; ?>" class="ratings" value="5" /></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <!--<label class="col-sm-12 control-label" style="text-align:left">Remarks: </label>-->
                        <div class="col-sm-12">
                            <textarea class="form-control col-12 remarksText" rows="5" name="cat_review_text" placeholder="Remarks Here ..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 subWrp">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="hidden" name="action_plan" value="<?php echo $action_plan; ?>" />
                            <button type="submit" class="btn btn-u">NEXT  &nbsp;<i class="fa fa-chevron-right"></i></button>
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
<script type="text/javascript" src="<?php echo base_url() . 'assets/jquery-ui-autocomplete/jquery-ui.js'; ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.js"></script>

<style type="text/css">
    .btn-w{   
        background-color:#f0ad4e !important;
        border-color:#eea236 !important;
    }
    .table tbody tr td{white-space:normal !important;}
    [data-wizard-init] {
        margin: auto;
        width: 100%;
    }
    .top-actions{display:none !important}

    .startBtnWrp, .center-text{text-align:center}
    form.review-info h4{margin:30px 0 20px !important}
    .evalWrp, .container >p{padding:15px; box-sizing:border-box}
    .subWrp{margin-top:20px; text-align:right}
    .categoryPagination{
        overflow:hidden;
        padding-left:15px !important;
    }
    .categoryPagination li{
        float:left;
        list-style-type:none;
        margin-right:5px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        var firstEvalId = $(".reviewFormValue:first").attr('eval_ids');
        var empID = "<?php echo $employee_id; ?>";
        get_evalCat(firstEvalId);

        $(".reviewFormValue").on('change', function () {
            var evalId = $(".reviewFormValue:checked").attr('eval_ids');
            get_evalCat(evalId);
        });

        $(".ratings").on('change', function () {
            var com_ratings = [];

            $("input.ratings").each(function (index) {
                if ($(this).prop("checked") === true) {
                    var comID = $(this).attr('com_id');
                    var rating = $(this).val();

                    com_ratings.push({
                        "com_id": comID,
                        "rating": rating
                    });
                }
            });

            var data = {
                "json_data": JSON.stringify(com_ratings),
                "employeeId": empID,
            };

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo base_url() . 'Con_PerformanceReviewBuilder/get_ratingRemarks'; ?>",
                data: data,
                success: function (data) {
                    $('.remarksText').html(data['response']);
                }
            });
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
