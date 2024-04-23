<?php
    $userId = 0;
    if ($this->session->userdata('hr_logged_in')) {
        $userId = $this->session->userdata('hr_logged_in')['id'];
    }
    $enableTwoFactorAuthentication = 0;
    $otpSendMethod = "";
    $userSettings = $this->db->get_where('two_factor_authentication', array('user_id' => $userId));
    if ($userSettings->result()) {
        $enableTwoFactorAuthentication = $userSettings->result()[0]->enable_two_factor_authentication;
        $otpSendMethod = $userSettings->result()[0]->otp_send_method;
    }

    $emailSelected = "";
    $smsSelected = "";
    $bothSelected = "";
    if ($otpSendMethod == "email") {
        $emailSelected = "selected";
    } else if ($otpSendMethod == "sms") {
        $smsSelected = "selected";
    } else {
        $bothSelected = "selected";
    }
    // echo "<pre>". print_r($smsSelected, 1) ."</pre>";exit;
?>
        <div class="col-md-10 main-content-div">
            <div class="main-content">

                <div class="container conbre">
                    <ol class="breadcrumb">
                        <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                        <li class="active"><?php echo $page_header; ?>&nbsp;settings</li>
                    </ol>
                </div>

                <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding: 15px;">
                    <form id="user_profile_settings" class="form-horizontal" method="POST" action="<?php echo site_url('Con_User/save_user_settings') ?>" role="form" >
                        <div class="col-md-10 col-md-offset-1">
                            <div class="container tag-box" style="margin-bottom: 20px">
                                <h2>Two Factor Authentication Settings:</h2>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div id="user-settings-checkbox-div" class="col-sm-3">
                                    <?php if ($enableTwoFactorAuthentication) : ?>
                                        <input class="user-settings-checkbox" id="two_factor" type="checkbox" checked name="enableTwoFactorAuthentication" />
                                    <?php else: ?>
                                        <input class="user-settings-checkbox" id="two_factor" type="checkbox" name="enableTwoFactorAuthentication" />
                                    <?php endif; ?>
                                    <label class="user-settings-checkbox" for="two_factor">Enable Two Factor Authentication</label>
                                </div>   
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-3">
                                    <?php if ($enableTwoFactorAuthentication) : ?>
                                        <select id="two_factor_path" name="otpSendingMethod" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <?php else: ?>
                                        <select id="two_factor_path" name="otpSendingMethod" class="col-sm-12 col-xs-12 myselect2 input-sm" disabled="disabled" >
                                    <?php endif; ?>
                                        <!-- <option></option> -->
                                        <option value="email" <?= $emailSelected; ?>>Email</option>
                                        <option value="sms" <?= $smsSelected; ?>>SMS</option>
                                        <option value="both" <?= $bothSelected; ?>>Both Email & SMS</option>
                                    </select>
                                </div>   
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="modal-footer">
                                <div class="col-sm-10 text-center">
                                    <p id="user-settings-msg" class="bg-success" style="padding: 8px; display: none;">Your settings has been saved.</p>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" id="userSettingsSave" class="btn btn-u">Save</button>
                                    <!-- <a class="btn btn-danger" href="<?php echo base_url() . "Con_User" ?>">Close</a> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            
            </div>
        </div>

    </div><!--/row-->
</div><!--/container-->

<script type="text/javascript">
    $(function () {
        $("#two_factor_path").select2({
            placeholder: "Select OTP Send Method",
            allowClear: true,
        });
    });

    var $checkBox = $('#two_factor'),
        $select = $('#two_factor_path');

    $checkBox.on('change',function(e)
    {
        if ($(this).is(':checked')) {
            $select.removeAttr('disabled');
        } else {
            $select.attr('disabled','disabled');
        }
    });

    $(document).on('click', '#userSettingsSave', function()
    {
        var url = $("#user_profile_settings").attr('action');
        var method = $("#user_profile_settings").attr('method');

        $.ajax({
            url: url,
            data: $("#user_profile_settings").serialize(),
            type: method
        }).done(function(data) {
            if (data.indexOf("Your settings has been saved") != -1) {
                $("#user-settings-msg").css("display", "block").fadeIn().delay(2500).fadeOut();
            } else {
                var url = "<?php echo base_url() ?>Chome";
                view_message(data, url);
            }
        });
        event.preventDefault();
    });
</script>

<style>
    .user-settings-checkbox:hover {
        cursor: pointer !important;
    }
</style>
