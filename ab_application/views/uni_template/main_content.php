<body id='loginscreen'>
    <div class="container-fluid" style="padding-left:0px;padding-right:0px;">
        <div class="">
            <div class="col-sm-9 hidden-xs " style="padding:0px;min-height:100vh;"> 
                <img class="img-responsive login-img" src="<?php echo base_url(); ?>assets/img/hrcsoft_login_bg.jpg"/>
            </div>

            <div class="col-sm-3 login-position" style="padding:0px 30px; min-height:100vh; box-shadow: -7px 0px 20px 1px rgba(0,0,0,0.35);"> 
                <div >
                <div class="login-form" style="margin-top:30px;">
                    <div class="text-center">
                        <img src="<?php echo base_url(); ?>assets/img/hrc_logo.png"/> 
                        <div class="login-application-title" style="margin-top:10px;">HRC - HR SYSTEM</div>
                    </div>
                    <div style="margin-top:40px;">
                        <form id="login-form" action="<?php echo site_url('Chome/check_login'); ?>" method="POST">
                            <div class="login-login-text" style="text-align:left;margin-bottom:10px;">LOGIN</div>
                            <label>Username</label><br>
                            <div class="input-group <?php echo form_error('username') ? "has-error" : ""; ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" value="<?php echo set_value('username'); ?>" placeholder="User Name" name="username">
                            </div>
                            <div class="error"><?php echo form_error('username'); ?></div>

                            <label class="login-password-label">Password</label>
                            <div class="input-group <?php echo form_error('password') ? "has-error" : ""; ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" value="<?php echo set_value('password'); ?>" placeholder="Password" name="password">
                            </div>
                            <div class="error"><?php echo form_error('password'); ?></div>

                            <div class="form-group clearfix">
                                <button class="btn btn-login-submit" style="margin-top: 25px; width:100%;background-color: #282550; color:#fff; height:40px">LOGIN</button>
                            </div>
                            <div><a style="color:rgb(20,20,20)" href="<?php echo base_url() . "Chome/forgot_password" ?>">Forgot Password?</a></div>
                            <div class="login-dont-have-a-login" style="color:rgb(20,20,20); margin-top: 15px;">Don't have a login?
                                <span><a class="login-try-it-for-free" href="./index.php?signup=true">Try it for free</a></span></a>
                            </div>
                        </form>

                        <div class="login-copyright">
                            Copyright reserved 2019, HRC HR Systems
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

<script>
    /* $(function() {
        $( "#log_frm" ).submit(function( event ) {
            document.cookie = "login = false";
            var url = $(this).attr('action');
            $.ajax({
               url: url,
               data: $("#log_frm").serialize(),
               type: $(this).attr('method')
            }).done(function(data) {
                // alert (data);return;
                var res = data.split("__"); 
                if(res[0]==1) {
                    // alert (res[1]);
                    localStorage.setItem("modtarget", 'Con_dashbord_mod');
                    document.cookie = "login = true";
                    window.location.href='<?php // echo base_url() ?>'+ res[1]; 

                    localStorage.setItem("elflag", '0');
                } else if(res[0]==2) {
                    $('#log_frm')[0].reset();
                    var url='';
                    view_message(res[1],url);
                } else {
                    $('#log_frm')[0].reset();
                    var url='';
                    view_message(data,url);
                }
            });
            event.preventDefault();
        });
    }); */

    function view_message(data, url) {
        if (data) {
            var datas = data.split('##');
            if (datas[1] == 1) { // Successful == 1
                $("#messagebox").fadeTo(200, 0.1, function() {
                    $(this).html(datas[0]).fadeTo(900, 1);
                    $('html, body').animate({scrollTop: 0}, 800);
                    $(this).fadeOut(5000);
                });

                if (url != '') {
                    setTimeout(function () {
                        window.location.href = url;
                    }, 5000);
                }
            } else { // Not Successful == 2
                $("#messagebox").fadeTo(200, 0.1, function() {
                    $(this).html(datas[0]).fadeTo(900, 1);
                    $('html, body').animate({scrollTop: 0}, 800);
                    // $(this).fadeOut(5000);
                });
            }
        } else {
            $("#messagebox").fadeTo(200, 0.1, function () {
                $(this).html('No Message Found').fadeTo(900, 1);
                $('html, body').animate({scrollTop: 0}, 800);
                // $(this).fadeOut(5000);
            });
        }
    }
</script>
