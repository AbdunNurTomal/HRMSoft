            </div>
        </section>
    </div>
</div>

<!--=== Footer Version 1 ===-->
<div class="footer-v1">
   
    <div class="copyright">
        <div class="container">
            <div class="row zero-margin padding-top-5 padding-bottom-5">
                <div class="col-md-4 col-12">
                    <div class="col-md-4 col-xs-4">
                        <!-- Logo -->
                        <a  href="<?php echo base_url() . 'Con_dashbord' ?>">
                            <img src="<?php echo base_url(); ?>assets/img/hrc_logo.png" alt="Logo" height="70px;" style="margin-left:20px;">
                        </a>
                    </div>
                    <div class="col-md-8 col-xs-8">
                        <div class="app-title">
                            <h2 style="color: #fff; font-size: 14px;  " class="text-primary"> Powered By HRC Service. </h2>
                        </div>			
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="col-md-5 col-12 m-0 text-center">
                        <p> 2017 &copy; All Rights Reserved. </p>
                    </div>
                    <div class="col-md-7 col-12 m-0 text-center">
                        <p><a href="#">HRC</a> | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
                    </div>
                </div>
                <!-- Social Links -->
                <div class="col-md-4 col-12">
                    <ul class="footer-socials list-inline text-center text-lg-right margin-right-20">
                        <li>
                            <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Skype">
                                <i class="fa fa-skype"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest">
                                <i class="fa fa-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dribbble">
                                <i class="fa fa-dribbble"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Social Links -->
            </div>
        </div>
    </div><!--/copyright-->
</div>
<!--=== End Footer Version 1 ===-->
        
</div><!--/End Wrapepr-->


<!-- JS Global Compulsory -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- JS Implementing Plugins -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/smoothScroll.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js"></script>

<!-- data table -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/dataTables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/dataTables/input.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- JS Customization -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<!-- Log-in -->
<!--<script src="<?php // echo base_url(); ?>assets/js/login.js"></script>-->

<!-- JS Page Level -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/style-switcher.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/masking.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/validation.js"></script>

<!--<script type="text/javascript" src="<?php // echo base_url(); ?>assets/plugins/image-hover/js/modernizr.js"></script>-->

<script src="<?php echo base_url(); ?>assets/js/jquery.slicknav.min.js"></script>
<!--<script src="<?php // echo base_url(); ?>assets/masking/jquery.maskedinput.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>

<script src="<?php  echo base_url(); ?>assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php  echo base_url(); ?>assets/js/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>


<script type="text/javascript">
     //alert ('ssss');
    jQuery(document).ready(function() {
        App.init();
        Masking.initMasking();
        //Datepicker.initDatepicker();
        Validation.initValidation();
    });

</script>
<!-- select 2 -->
<script>
    
//    $("#e1,#e2,#e3,#c_status").select2({
//        placeholder: "Select a State",
//        allowClear: true,
//    });

    $(document).ready(function () {
        $('#dataTables-example').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "bLengthChange": false,
            "bInfo" : false,
            "paginationType": "input"
        });
    });
    //"scrollX": true,
    
    //alert (getCookie("login"));
    function reload_table(table_id)
    {
        setTimeout( function () {
            $('#'+table_id).dataTable({
                "order": [ 0, "asc" ],
                "pageLength": 10,
                "destroy": true,
                "paginationType": "input"
            });
        }, 3000 );
    }
   
    if(getCookie("login") == 'false'){
        window.location.href = window.location.protocol + "//" + window.location.host + "/hrm/Chome";
    }
    
    $(function () {
        
        $('.dt_pick').datepicker({
            format: 'mm-dd-yyyy',
            todayHighlight: true,
            autoclose: true
        });
    
        $('#birthdate').datepicker({
            format: 'mm-dd-yyyy',
            todayHighlight: true,
            autoclose: true
        });

        $('#onboarding_dateofbirth').datepicker({
            format: 'mm-dd-yyyy',
            todayHighlight: true,
            autoclose: true
        });
        
        $('.time_pick').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: false,
            showSeconds: false,
            defaultTime: ''
        });
        
    });
    
    //$.fn.modal.Constructor.prototype.enforceFocus = function () {};
    
    $(".navbar-nav li a").click(function (event) {
        if ($(this).attr('href') != '#')
        {
            var mtarget = $(this).attr("id");
            localStorage.setItem("modtarget", mtarget);
        }
    });
    
    $(document).ready(function () {
        if (typeof (Storage) !== "undefined") {
            var mdatatarget = localStorage.getItem("modtarget");
        } else {
            var mdatatarget = "";
            alert("Sorry, your browser does not support Web Storage...");
        }
        //alert (mdatatarget);
         $("#" + mdatatarget).css("color", "#ffd426");
    });

     
</script>
 <script src="<?php echo base_url(); ?>assets/slimimage/slim/slim.kickstart.min.js"></script>
 
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/jSignature/flashcanvas.js"></script>
 <script src="<?php echo base_url(); ?>assets/jSignature/jSignature.min.js"></script>
 
<!-- bootstrap-sweetalert-master -->
<!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/sweetalert-master/dist/sweetalert.min.js">-->
<!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/sweetalert-master/dist/sweetalert.js">-->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tableExport.jquery.plugin-master/tableExport.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tableExport.jquery.plugin-master/jquery.base64.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tableExport.jquery.plugin-master/html2canvas.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tableExport.jquery.plugin-master/jspdf/libs/sprintf.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tableExport.jquery.plugin-master/jspdf/jspdf.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tableExport.jquery.plugin-master/jspdf/libs/base64.js"></script>

        <script>
//            
//new Slim(element, {
//    ratio: '4:3',
//    minSize: {
//        width: 640,
//        height: 480,
//    },
//    crop: {
//        x: 0,
//        y: 0,
//        width: 100,
//        height: 100
//    },
//    service: 'upload-async.php',
//    download: false,
//    willSave: function(data, ready) {
//        alert('saving!');
//        ready(data);
//    },
//    label: 'Drop your image here.',
//    buttonConfirmLabel: 'Ok',
//    meta: {
//        userId:'1234'
//    }
//});



    </script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
<![endif]-->
<!--[if lt IE 10]>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
<![endif]-->

</body>
</html>
