<?php // echo $passwordResetHash;exit; ?>

<body id='loginscreen'>
    <div class="site-content">
        <div class="pull-right" style=" margin-right: 15px; margin-top: 5px; color: #360909;  ">
            <a style=" color: #360909;" class="" href="<?php echo base_url() . "Chome" ?>" > Sign in </a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="main-site">
                        <div class="login-form-area">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                                    <div class="main-form">
                                        <div class="main_logo">
                                            <img class="img-responsive center-block" src="<?php echo base_url(); ?>assets/img/hrc_logo.png" height="70px" width="70px" alt="Logo">
                                        </div>
                                        
                                        <div class="form-title text-center">
                                            <h3 id="reset-password-modal-title">Let’s Reset Your Password</h3>
                                        </div>

                                        <?php if ($passwordResetHash == "000"): ?>
                                            <div class="row text-center" style="margin-top: 30px;">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-8">
                                                    <p class="bg-danger" style="padding: 20px;">Password reset link expired or invalid. <br> Please try again.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row text-center">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-6">
                                                <a class="btn erp-btn" style="float: unset" href="<?php echo base_url() . "Chome" ?>"><span class="spcl">Go to Login</span></a>
                                                </div>
                                            </div>

                                        <?php else: ?>

                                        <div id="invalid-password-reset-message-div" style="display: none;">
                                            <div class="row text-center" style="margin-top: 30px;">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-8">
                                                    <p id="reset-password-modal-message" class="bg-danger" style="padding: 20px;">Password reset link expired or invalid. <br> Please try again.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row text-center">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-6">
                                                <a class="btn erp-btn" style="float: unset" href="<?php echo base_url() . "Chome" ?>"><span class="spcl">Go to Login</span></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="reset-password-modal-sub-title" class="form-title" style=" padding-top: 30px;">
                                            <h6>Please enter your new password </h6>
                                        </div>
                                        <div id="reset-password-form" class="form-middle-content clearfix">
                                            <form action="<?php echo site_url('Chome/update_new_password') ?>" class="loginform" method="post" id="reset_password_form">
                                                <input type="hidden" class="erp-form" value="<?= $passwordResetHash; ?>" placeholder="Password" id="txtResetPasswordPasswordResetHash" name="passwordRestHash">
                                                <div class="form-group single-group">
                                                    <label for="login-password" class="form-label">
                                                        <i class="icofont icofont-ui-password"></i>
                                                    </label>
                                                    <input value="" type="password" class="erp-form" placeholder="Password" id="txtResetPasswordPassword" name="password">
                                                    <div class="col-md-11 formFieldError" id='resetPasswordPasswordError'></div>
                                                </div>

                                                <div class="form-group single-group">
                                                    <label for="login-password" class="form-label">
                                                        <i class="icofont icofont-ui-password"></i>
                                                    </label>
                                                    <input value="" type="password" class="erp-form" placeholder="Confirm Password" id="txtResetPasswordConfirmPassword" name="confirmPassword">
                                                    <div class="col-md-11 formFieldError">
                                                        <p id="messagebox" class="bg-danger" style="padding: 10px; display: none;"></p>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn erp-btn" value='&nbsp;&nbsp;Login&nbsp;&nbsp;' name='SubmitUser'> Update </button>
                                                <a class="btn erp-close-btn" href="<?php echo base_url() . "Chome" ?>"><span class="spcl">Close</span></a>
                                            </form>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>
    
    <script type="text/javascript">
        $(function() {
            $( "#reset_password_form" ).submit(function( event ) {
                //alert (base_url);
                //loading_box(base_url);
                var url = $(this).attr('action');
                    $.ajax({
                    url: url,
                    data: $("#reset_password_form").serialize(),
                    type: $(this).attr('method')
                }).done(function(data) {
                    // console.log(data);
                    // var url='<?php // echo base_url() ?>Chome';
                    // view_message(data,url);

                    if (data.indexOf("Your password has been reset") != -1) {
                        $("#reset-password-form").css("display", "none");
                        $("#reset-password-modal-sub-title").css("display", "none");

                        $("#reset-password-modal-title").html("Let’s Login to Your Account With New Password");

                        $("#reset-password-modal-message").removeClass("bg-danger");
                        $("#reset-password-modal-message").addClass("bg-success");
                        $("#reset-password-modal-message").html("Your password has been reset.");
                        $("#invalid-password-reset-message-div").css("display", "block");
                    } else {
                        var url='<?php echo base_url(); ?>Chome';
                        view_message(data,url);
                    }
                });
                event.preventDefault();
            });
        }); 
    
        function view_message(data, url) {
            if (data) {
                var datas = data.split('##');
                if (datas[1] == 1) { // Successful == 1
                    $("#messagebox").fadeTo(200, 0.1, function () {
                        $(this).html(datas[0]).show().fadeTo(900, 1);
                        $('html, body').animate({scrollTop: 0}, 800);
                        $(this).fadeOut(3000);
                    });

                    if (url != '') {
                        setTimeout(function () {
                            window.location.href = url;
                        }, 3000);
                    }
                } else { //Not Successful ==2
                    $("#messagebox").fadeTo(200, 0.1, function () {
                        $(this).html(datas[0]).show().fadeTo(900, 1);
                        $('html, body').animate({scrollTop: 0}, 800);
                        //$(this).fadeOut(5000);
                    });
                }
            } else {
                $("#messagebox").fadeTo(200, 0.1, function () {
                    $(this).html('No Message Found').show().fadeTo(900, 1);
                    $('html, body').animate({scrollTop: 0}, 800);
                    //$(this).fadeOut(5000);
                });
            }
        }
    </script>
