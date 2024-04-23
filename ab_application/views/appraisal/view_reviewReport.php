
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <?php if ($show_step_wizard): ?>
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
        <?php endif; ?>

        <!-- container tag-box tag-box-v3 div -->   
        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">
            <h2>Employee Performance Review Summary</h2>
            <br/>
            <div class="col-sm-12" style="padding:0">
                <button id="word-button" class="btn-u"><i class="fa fa-file-word-o"> </i> Word Export</button>
                <button id="pdf-button" class="btn-u"><i class="fa fa-file-pdf-o"> </i> PDF Export</button>
                <a id="img-button" class="btn-u"><i class="fa fa-file-photo-o"> </i> Image Export</a>
            </div>
            <br/><br/>

            <div id="word-content" class="customTable">

                <div style="margin-bottom:10px">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="4" style="background:#000; color:#fff; text-align:left; padding:6px; box-sizing:border-box">Review</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Employee:</td>
                                <td><?php echo $appr_record['employee_name'] ?></td>
                                <td>Job Title:</td>
                                <td><?php echo $this->Common_model->get_name($this, $appr_record['data']['position'], 'main_positions', 'positionname') ?></td>
                            </tr>
                            <tr>
                                <td>Reviewer:</td>
                                <td><?php echo $appr_record['data']['reviewer_name']; ?></td>
                                <td>Review Period:</td>
                                <td>
                                    <?php
                                    echo $this->Common_model->show_date_formate($appr_record['data']['start_date']) . '&nbsp; to &nbsp;';
                                    echo $this->Common_model->show_date_formate($appr_record['data']['end_date']);
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
                $grant_total_rating = 0.0;
                if ($appr_record['data']['remark_data']) {
                    $i = 0;
                    $sub_total_rating = 0.0;
                    foreach ($appr_record['data']['remark_data'] as $key => $row) {
                        $i++;
                        ?>

                        <div style="margin-bottom:10px">
                            <table class="cell-border">
                                <thead>
                                    <tr style="background:#000; color:#fff; text-align:left; padding:6px; box-sizing:border-box">
                                        <th class="col-xs-6" style="text-align:left;"><?php echo 'Competency Rating: ' . $row['cat_name']; ?></th>
                                        <th class="col-xs-1">N/A</th>
                                        <th class="col-xs-1"><?php echo $appr_record['data']['rating_1']; ?></th>
                                        <th class="col-xs-1"><?php echo $appr_record['data']['rating_2']; ?></th>
                                        <th class="col-xs-1"><?php echo $appr_record['data']['rating_3']; ?></th>
                                        <th class="col-xs-1"><?php echo $appr_record['data']['rating_4']; ?></th>
                                        <th class="col-xs-1"><?php echo $appr_record['data']['rating_5']; ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $ok = '<img src="' . base_url() . 'assets/img/ok.png" alt="OK"/>';
                                    $tmp_rating = 0.0;
                                    $j = 0;
                                    foreach ($appr_record['data']['rating_data'] as $value) {
                                        if (in_array($value['com_id'], explode(',', $row['competencies']))) {
                                            $j++;
                                            $tmp_rating += $value['rating'];
                                            ?>
                                            <tr>
                                                <td class="whiteSpaceNormal"><?php echo $value['com_name']; ?></td>
                                                <td class="nowWrpp"><?php echo ($value['rating'] == 0) ? $ok : '-'; ?></td>
                                                <td class="nowWrpp"><?php echo ($value['rating'] == 1) ? $ok : '-'; ?></td>
                                                <td class="nowWrpp"><?php echo ($value['rating'] == 2) ? $ok : '-'; ?></td>
                                                <td class="nowWrpp"><?php echo ($value['rating'] == 3) ? $ok : '-'; ?></td>
                                                <td class="nowWrpp"><?php echo ($value['rating'] == 4) ? $ok : '-'; ?></td>
                                                <td class="nowWrpp"><?php echo ($value['rating'] == 5) ? $ok : '-'; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                        <div style="margin-bottom:10px">
                            <table class="cell-border">
                                <thead>
                                    <tr style="background:#000; color:#fff; padding:6px; box-sizing:border-box">
                                        <th class="col-xs-11" style="text-align:left;">Comments / Remarks</th>
                                        <th class="col-xs-1">Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="whiteSpaceNormal"><?php echo $row['remark_text']; ?></td>
                                        <td class="nowWrpp">
                                            <?php
                                            $tmp_rating = $tmp_rating / $j;
                                            echo number_format($tmp_rating, 1) . ' / 5';
                                            ?> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        $sub_total_rating += $tmp_rating;
                    }

                    $grant_total_rating = ($sub_total_rating / $i);

                    if ($appr_record['data']['include_action_plan'] == 1) {
                        ?>
                        <div style="margin-bottom:10px">
                            <table class="cell-border">
                                <thead>
                                    <tr>
                                        <th style="background:#000; color:#fff; text-align:left; padding:6px; box-sizing:border-box">Action Plan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="whiteSpaceNormal">
                                            <p>The above criterion is important to properly evaluate your 
                                                performance.  The following Action Plan describes your specific 
                                                strengths and weaknesses, and what can be done to improve your 
                                                position toward continued growth.
                                            </p> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        if ($appr_record['data']['action_plan_data']) {
                            foreach ($appr_record['data']['action_plan_data'] as $value) {
                                ?>
                                <div style="margin-bottom:10px">
                                    <table class="cell-border">
                                        <tr>
                                            <th style="background:#000; color:#fff; text-align:left; padding:6px; box-sizing:border-box"><?php echo $value['plan_name'] ?></th>
                                        </tr>
                                        <tr>
                                            <td class="whiteSpaceNormal"><?php echo $value['review_text'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <?php ?>
                    <?php } ?>

                    <div style="margin-bottom:10px">
                        <table class="cell-border">
                            <thead>
                                <tr>
                                    <th colspan="2" style="background:#000; color:#fff; text-align:left; padding:6px; box-sizing:border-box">Overall Summary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-xs-2 nowWrpp">Overall Rating:</td>
                                    <td class="col-xs-10 whiteSpaceNormal">
                                        <?php
                                        $final_rating = number_format($grant_total_rating, 1);
                                        echo $final_rating . ' / 5';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-xs-2 nowWrpp">Review Remarks:</td>
                                    <td class="col-xs-10 whiteSpaceNormal">
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
                    <div style="margin-bottom:10px">
                        <table class="sign no-tbl-border">
                            <tr>
                                <td>
                                    <hr/>
                                    <p>Employee's Signature</p>
                                </td>
                                <td>
                                    <hr/>
                                    <p>Date</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <hr/>
                                    <p>Reviewer's Signature</p>
                                </td>
                                <td>
                                    <hr/>
                                    <p>Date</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div><!-- end container tag-box tag-box-v3 div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/appraisal_wizard/jquery.wizard.js"></script>

<style type="text/css">
    .startBtnWrp{text-align:center}
    [data-wizard-init] {
        margin: auto;
        width: 100%;
    }
    .top-actions{display:none !important}
    .nowWrpp{white-space:nowrap !important;}
    .whiteSpaceNormal{white-space:normal !important;}
    table.sign{width:100% !important; margin-top:50px;}
    table.sign hr{border-top: 1px solid #000 !important; margin-bottom:0;}
    table.sign td{padding:15px; box-sizing:border-box; width:50%;}
    .customTable{background:#fff; box-sizing:border-box !important}
    .customTable table td, .customTable table th{padding:6px; box-sizing:border-box}
    .customTable table th{background:#000; color:#fff}
    .customTable table{border:1px solid #000; width:100%}
    .no-tbl-border{border:none !important}
    .cell-border td{border:1px solid #000 !important}
</style>

<script src="<?php echo base_url(); ?>assets/plugins/html_to_word/FileSaver.js"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/html_to_word/jquery.wordexport.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/html_to_pdf/jspdf.debug.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/html_to_pdf/html2pdf.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var empName = "<?php echo $appr_record['data']['employee_name'] ?>";
        var content = $('.customTable');
        var imgageData;
        var newData;

        html2canvas(content, {
            onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                imgageData = canvas.toDataURL("image/png");
                newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                $("#img-button").attr("download", empName + ".png").attr("href", newData);
            }
        });

        $("#word-button").click(function () {
            $("th").css("background-color", "#000 !important");
            $(content).wordExport(empName + '_appraisal');
        });

        $("#pdf-button").click(function () {
            var doc = new jsPDF('portrait', 'pt', 'a1');
            doc.setDisplayMode('fullpage')
//            var canvas = doc.canvas;
//            canvas.height = 72 * 11;
//            canvas.width = 72 * 8.5;
            html2pdf(content, doc, function (pdf) {
                pdf.save(empName + '.pdf');
            });
        });

    });
</script>
<!--=== End Content ===-->
