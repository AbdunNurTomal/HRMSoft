        <?php
        $this->user_data = $this->session->userdata('hr_logged_in');
       // $login_id = $this->session->userdata('hr_logged_in');
        ?>
        <div class="row main-body">
            <div class="col-md-12 main-content-div">
                <div class="main-content">
                    <?php
                        $HR360_GUID = "";
                        $companyId = $this->session->userdata('hr_logged_in') ? $this->session->userdata('hr_logged_in')["company_id"] : 0;
                        $company = $this->Common_model->get_by_id_row('main_company', $companyId);
                        if ($company) {
                            $HR360_GUID = $company->HR360_GUID;
                        }
                        // echo "<pre>". print_r($company, 1) ."</pre>";exit;
                    ?>
                    <div id="result">
                        <?php if (!$HR360_GUID): ?>
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="alert alert-danger text-center" role="alert">
                                       HR360 GUID is missing for this company. Please update GUID on SETUP > Setup Company page.
                                    </div> 
                                </div>
                            </div>

                            <!--<iframe src="http://www.hr360.com/autologin.aspx?GUID=2eeedad1-885d-4abf-8b57-56f99320af44" style="height: 900px; width: 100%;"></iframe>-->
                        <?php endif; ?>
                    </div>
                    <?php if ($HR360_GUID): ?>
                        <script type="text/javascript">
                            $(function () {
                                // var webClockUrl = 'https://www.hr360.com/autologin.aspx?GUID=2eeedad1-885d-4abf-8b57-56f99320af44';
                                var webClockUrl = "https://www.hr360.com/autologin.aspx?integrationGUID=<?php echo $HR360_GUID; ?>";
                                $('#result').html('<iframe src="' + webClockUrl + '" style="height: 900px; width: 100%;"></iframe>');
                            });
                        </script>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div><!--/end row-->
</div><!--/end container-->

