<style type="text/css">
    .nowWrpp{white-space:nowrap !important;}
    .whiteSpaceNormal{white-space:normal !important;}
    table.sign{width:100% !important; margin-top:50px;}
    table.sign hr{border-top: 1px solid #000 !important; margin-bottom:0;}
    table.sign td{padding:15px; box-sizing:border-box; width:50%;}
</style>
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <!-- container well div -->   
        <div class="container well" style="margin-top:0; width:96%; padding:15px; box-sizing:border-box">
            <h2>Employee Performance Review Summary</h2>
            <br/>
            <div class="col-sm-12">
                <button id="word-button" class="btn-u"><i class="fa fa-file-word-o"> </i> Word Export</button>
                <button id="pdf-button" class="btn-u"><i class="fa fa-file-pdf-o"> </i> PDF Export</button>
            </div>
            <br/><br/>

            <div id="word-content">
                <div class="col-sm-12 tblWrpp">
                    <table class="table table-bordered table-hover" id="candidate">
                        <thead>
                            <tr>
                                <th colspan="4">Review</th>
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
                        <div class="col-sm-12 tblWrpp">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-xs-6"><?php echo 'Competency Rating: ' . $row['cat_name']; ?></th>
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

                        <div class="col-sm-12 tblWrpp">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-xs-11">Comments / Remarks</th>
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
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Action Plan</th>
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
                            <?php
                            if ($appr_record['data']['action_plan_data']) {
                                foreach ($appr_record['data']['action_plan_data'] as $value) {
                                    ?>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th><?php echo $value['plan_name'] ?></th>
                                        </tr>
                                        <tr>
                                            <td class="whiteSpaceNormal"><?php echo $value['review_text'] ?></td>
                                        </tr>
                                    </table>
                                    <?php
                                }
                            }
                            ?>
                            <?php ?>
                        </div>
                    <?php } ?>
                    <div class="col-sm-12 tblWrpp">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2">Overall Summary</th>
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
                                    <td class="col-xs-10 whiteSpaceNormal"><?php echo $this->hr_appraisal_model->get_overall_review($final_rating); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 tblWrpp">
                        <table class="sign">
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
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<style type="text/css">
    .startBtnWrp{text-align:center}
</style>

<script src="<?php echo base_url(); ?>assets/plugins/html_to_word/FileSaver.js"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/html_to_word/jquery.wordexport.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/html_to_pdf/jspdf.debug.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/html_to_pdf/html2pdf.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/html_to_pdf/display-mode.spec.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var empName = "<?php echo $appr_record['data']['employee_name'] ?>";

        $("#word-button").click(function () {
            $(".table thead tr th").css("background-color", "#000");
            $("#word-content").wordExport(empName + '_appraisal');
            $(".table thead tr th").css("background-color", "#80c641");
        });

        $("#pdf-button").click(function () {

            $(".table thead tr th").css("background-color", "#000");
            
            var doc = new jsPDF('portrait', 'pt', 'a1');
            doc.setDisplayMode('fullpage')
//            var canvas = doc.canvas;
//            canvas.height = 72 * 11;
//            canvas.width = 72 * 8.5;
            var content = document.getElementById('word-content');
            html2pdf(content, doc, function (pdf) {
                pdf.save(empName + '.pdf');
            });

            $(".table thead tr th").css("background-color", "#80c641");
        });

    });
</script>
<!--=== End Content ===-->

