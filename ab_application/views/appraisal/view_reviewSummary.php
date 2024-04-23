<style type="text/css">
    .table tbody tr td{white-space:normal !important;}
</style>
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
            <div>
                <h2>Employee Performance Review Summary</h2>
                <br/>

                <div class="col-sm-12">
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th class='col-xs-1'>Sl No.</th>
                                <th class='col-xs-2'>Competency</th>
                                <th>Rating</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grant_total_rating = 0.0;
                            if (!empty($appr_data['remark_data'])) {
                                $i = 0;
                                $sub_total_rating = 0.0;
                                foreach ($appr_data['remark_data'] as $row) {
                                    $tmp_rating = $this->hr_appraisal_model->get_avg_rating($row['temp_app_id'], $row['cat_id']);

                                    echo "<tr>";
                                    echo "<th>" . ++$i . "</th>";
                                    echo "<th>" . $row['cat_name'] . "</th>";
                                    echo "<th>" . number_format($tmp_rating, 1) . "</th>";
                                    echo "<td>" . $row['remark_text'] . "</td>";
                                    echo "</tr>";

                                    $sub_total_rating += $tmp_rating;
                                }
                                $grant_total_rating = ($sub_total_rating / $i);
                            }
                            ?> 

                            <tr>
                                <th colspan="2">Overall Rating</th>
                                <th>
                                    <?php
                                    $final_rating = number_format($grant_total_rating, 1);
                                    echo $final_rating;
                                    ?>
                                </th>
                                <td>
                                    <?php
                                    if (round($final_rating) != 0) {
                                        echo $this->hr_appraisal_model->get_overall_review($final_rating);
                                    } else {
                                        echo "No description available for this Rating!";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-12 subWrp">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <form action="<?php echo base_url() . 'Con_PerformanceReviewBuilder/appraisal_completed' ?>" method="post">
                                <input type="hidden" name="employee_id" value="<?php echo $appr_data['employee_id']; ?>" />
                                <input type="hidden" name="temp_app_id" value="<?php echo $appr_data['temp_app_id']; ?>" />
                                <label class="col-sm-11 control-label">&nbsp;</label>
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-u">DONE  &nbsp;<i class="fa fa-chevron-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- end container well div -->
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
    .startBtnWrp{text-align:center}
    .subWrp{margin-top:20px; text-align:right}
</style>
<!--=== End Content ===-->

