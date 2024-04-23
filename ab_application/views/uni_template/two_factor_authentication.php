<?php // print_r($this->session->userdata('login_details')['username']);exit; ?>

<style type="text/css">
    .isa_error p {
        color: #FF0000 !important;
    }
</style>

<body id='loginscreen' >
    <div class="site-content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="main-site">
                        <div class="login-form-area">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                                    <div class="main-form">
                                        <div class="col-md-11 isa_error" id='messagebox' style=" font-size: 14px; text-align: center; position: absolute; z-index: 9999 !important;">
                                            <?php echo form_error('username'); ?>
                                            <?php echo form_error('password'); ?>
                                        </div>

                                        <div class="main_logo">
                                            <img class="img-responsive center-block" src="<?php echo base_url(); ?>assets/img/hrc_logo.png" height="70px" width="70px" alt="Logo">
                                        </div>
                                        
                                        <div class="form-title text-center">
                                            <h4>Two-Factor Authentication</h4>
                                            <br/>
                                            <span id="new-otp-alert" style="font-size: 14px; color: green; display: none;">New OTP sent to your mail <br/> </span>
                                            <span style="font-size: 14px; color: green;">Please check your email for the OTP</span>
                                        </div>
                                        <div class="form-middle-content clearfix">

                                            <!--<form method='post' action='/posystem/' name='loginform' class='loginform'>-->
                                            <form id="check-otp-form" action="<?php echo site_url('Chome/check_otp') ?>" class="loginform" method="post" id="log_frm">
                                                <input class="form-control" type="hidden" name="username" value="<?= $this->session->userdata('login_details')['username']; ?>">
                                                <input class="form-control" type="hidden" name="password" value="<?= $this->session->userdata('login_details')['password']; ?>">
                                                <input type="hidden" name="ajaxCall" value="1" >
                                                <div class="form-group single-group">
                                                    <label for="login-name" class="form-label">
                                                        <i class="icofont icofont-key"></i>
                                                    </label>
                                                    <input type="text" class="erp-form" value="<?php echo set_value('otp'); ?>" placeholder="OTP" name="otp" >
                                                    <div class="col-md-11 formFieldError" id='messagebox'>
                                                        <?php echo form_error('otp'); ?>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn erp-btn" value='&nbsp;&nbsp;Login&nbsp;&nbsp;' name='SubmitUser' >Go</button>
                                                <a class="btn erp-close-btn" href="<?php echo base_url() . "Chome" ?>"><span class="spcl">Close</span></a>
                                            </form>
                                            <a id="resendOTPLink" href="javascript:void(0)" class="pull-right" style="">Resend OTP</a>
                                        </div>
                                        <!-- <div class="form-footer">
                                            <p>Don't have a login? <span><a href="./index.php?signup=true">Try for free</a></span></p>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>

<script>

    /* $(function(){
        $( "#log_frm" ).submit(function( event ) {
            document.cookie = "login = false";
            var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#log_frm").serialize(),
                type: $(this).attr('method')
            }).done(function(data) {
                //alert (data);return;
                var res = data.split("__");
                    if(res[0]==1)
                    {
                        //alert (res[1]);
                        localStorage.setItem("modtarget", 'Con_dashbord_mod');
                        document.cookie = "login = true";
                        window.location.href='<?php // echo base_url() ?>'+ res[1]; 

                        localStorage.setItem("elflag", '0');
                    }
                    else if(res[0]==2)
                    {
                        $('#log_frm')[0].reset();
                        var url='';
                        view_message(res[1],url);
                    }
                    else
                    {
                        $('#log_frm')[0].reset();
                        var url='';
                        view_message(data,url);
                    }

                });
            event.preventDefault();
        });
    }); */

    function view_message(data, url)
    {
        if (data) {
            var datas = data.split('##');
            if (datas[1] == 1) { //Successful==1
                $("#messagebox").fadeTo(200, 0.1, function () {
                    $(this).html(datas[0]).fadeTo(900, 1);
                    $('html, body').animate({scrollTop: 0}, 800);
                    $(this).fadeOut(5000);
                });

                if (url != '') {
                    setTimeout(function () {
                        window.location.href = url;
                    }, 5000);
                }
            } else { //Not Successful ==2
                $("#messagebox").fadeTo(200, 0.1, function () {
                    $(this).html(datas[0]).fadeTo(900, 1);
                    $('html, body').animate({scrollTop: 0}, 800);
                    //$(this).fadeOut(5000);
                });
            }
        } else {
            $("#messagebox").fadeTo(200, 0.1, function () {
                $(this).html('No Message Found').fadeTo(900, 1);
                $('html, body').animate({scrollTop: 0}, 800);
                //$(this).fadeOut(5000);
            });
        }
    }

    $(document).on("click", "#resendOTPLink", function()
    {
        var url = "send_otp";
        $.ajax({
            url: url,
            data: $("#check-otp-form").serialize(),
            type: "POST"
        }).done(function(data) {
            if (data) {
                $("#new-otp-alert").css("display", "block");
            }
        });
        event.preventDefault();
    });

</script>
