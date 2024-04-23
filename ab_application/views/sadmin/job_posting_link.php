<!DOCTYPE html> 
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Jobs Description | HRC Service </title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/headers/header-default.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/footers/footer-v1.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">

    <!-- CSS Page Style -->    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pages/page_job_inner2.css">

    <!-- CSS Theme -->    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-colors/default.css" id="style_color">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-skins/dark.css">
    
    <link href="<?php echo base_url(); ?>assets/css/select2.css" rel="stylesheet"/>
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/slicknav.min.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    
    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>
</head> 

<body>
    
<!--=== Job Description ===-->
<div class="job-description">
    <div class="col-md-10 col-md-offset-2 pull-right" id='messagebox' style=" font-size: 14px; text-align: center; position: absolute; z-index: 9999 !important;"> </div>
    <div class="container content">
        <div class="title-box-v2">
            <h2>Job Description</h2>
            <p><?php if(!empty($query))echo $query->position_description ?></p>
        </div>    
        <!-- Left Inner -->
        <div class="left-inner" id="print_div">
            <!--<img src="assets/img/clients2/ea-canada.png" alt="">-->
            <img src="<?php if(!empty($query)) echo $logo; ?>" alt="">
            
            <h3><?php if(!empty($query)) echo $this->Common_model->get_name($this,$query->company_id,'main_company','company_full_name'); ?></h3>
            <div class="position-top">
<!--                <ul class="social-icons social-icons-color">
                    <li><a class="social_facebook" data-original-title="Facebook" href="#"></a></li>
                    <li><a class="social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                    <li><a class="social_tumblr" data-original-title="Tumblr" href="#"></a></li>
                    <li><a class="social_twitter" data-original-title="Twitter" href="#"></a></li>
                </ul>-->
                <a href="#" onclick="printDiv()"><i class="fa fa-print"></i></a>
            </div>    
            <div class="overflow-h">
                <p class="hex"><?php if(!empty($query)) echo $this->Common_model->get_name($this,$query->company_id,'main_company','address_1'); ?></p>
                <div class="star-vote">
<!--                    <ul class="list-inline">
                        <li><i class="color-green fa fa-star"></i></li>
                        <li><i class="color-green fa fa-star"></i></li>
                        <li><i class="color-green fa fa-star"></i></li>
                        <li><i class="color-green fa fa-star-half-o"></i></li>
                        <li><i class="color-green fa fa-star-o"></i></li>
                    </ul>
                    <span><a href="#">34 reviews</a></span>-->
                </div>
            </div>    
            
            <hr>

            <h2>Job Description</h2>
            <p>
                <?php if(!empty($query)) echo $query->job_posting_text; ?>
            </p>
            <br>
            <button type="button" class="btn btn-u" onclick="show_apply_form();"> Apply with Resume</button>
        </div>
        <!-- End Left Inner -->
        
        <div class="left-inner apply_form" style=" display: none; visibility: hidden;">
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_OpeningsPositions/save_Resume" enctype="multipart/form-data" role="form" >
                <div class="panel panel-u margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-tasks"></i> Candidate Details </h3>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" value="<?php if(!empty($query)) echo $req_id; ?>" name="req_id" id="req_id" />
                        <input type="hidden" value="<?php if(!empty($query)) echo $query->company_id; ?>" name="company_id" id="company_id" />
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Resume Type <span class="req"/> </label>
                            <div class="col-sm-10">                            
                                <select name="resume_type" id="resume_type" onchange="change_type(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option value="0">Requsiiton</option>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> First Name<span class="req"/> </label>
                            <div class="col-sm-10">                            
                                <input type="text" name="candidate_first_name" id="candidate_first_name" class="form-control input-sm" placeholder="Candidate First Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Last Name<span class="req"/></label>
                            <div class="col-sm-10">                            
                                <input type="text" name="candidate_last_name" id="candidate_last_name" class="form-control input-sm" placeholder="Candidate Last Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="candidate_email" class="col-sm-2 control-label">Email<span class="req"/> </label>
                            <div class="col-sm-10">                            
                                <input type="email" name="candidate_email" id="candidate_email" class="form-control input-sm" placeholder="Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact_number" class="col-sm-2 control-label">Contact Number<span class="req"/> </label>
                            <div class="col-sm-10">                            
                                <input type="text" name="contact_number" id="contact_number" class="form-control input-sm" placeholder="Contact Number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Qualification<span class="req"/> </label>
                            <div class="col-sm-10">                            
                                <!--<input type="text" name="qualification" id="qualification" class="form-control input-sm" placeholder="Qualification" />-->
                                <select name="qualification[]" id="qualification" class="col-sm-12 col-xs-12 myselect2 input-sm" title="Required Qualification (multiple select)" multiple>
                                    <option></option>
                                    <?php
                                    foreach ($educationlevel_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->educationlevelcode ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work Experience<span class="req"/> </label>
                            <div class="col-sm-10">                            
                                <input type="text" name="work_experience" id="work_experience" onkeypress="return numbersonly(this, event)" class="form-control input-sm" placeholder="Work Experience" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Skill <span class="req"/> </label>
                            <div class="col-sm-10">  
                                <select name="skill_set[]" id="skill_set" class="col-sm-12 col-xs-12 myselect2 input-sm" title=" Skill Set (multiple select)" multiple>
                                    <option></option>
                                    <?php
                                    foreach ($skills_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->skill_name ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Education Summary </label>
                            <div class="col-sm-10"> 
                                <textarea class="form-control" rows="2" id="education_summary" name="education_summary" placeholder="Education Summary"></textarea>
                            </div>
                        </div>
                        <div class="form-group">                        
                            <label class="col-sm-2 control-label">State </label>
                            <div class="col-sm-10"> 
                                <select name="state" id="state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    $state_query = $this->Common_model->listItem('main_state');
                                    foreach ($state_query->result() as $keyy):
                                        ?>
                                        <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Upload resume  </h4></u></label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Resume </label>
                            <div class="col-sm-4">
<!--                                <a href="#" onclick="upload_resume();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                    <button type="button" class="btn btn-u">Upload</button>
                                </a> 
                                <input type="hidden" name="upload_resume_path" id="upload_resume_path" />
                                <label id="resume_name_label"></label>-->
                                <input type="file" name="userfile" id="userfile" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                        
                    <button type="submit" id="submit" class="btn btn-u"> Submit Resume </button>
                </div>
            </form>
        </div>
    </div>   
</div>    
<!--=== End Job Description ===-->


<!-- Modal -->
<div class="modal fade" id="upload_resume_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
            </div>
            <form id="upload_resume_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="candidate_resume_id" id="candidate_resume_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Resume </label>
                        <div class="col-sm-8">
                            <input type="file" name="candidate_resume" id="candidate_resume" size="20" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=== Copyright v2 ===-->
<div class="copyright-v2">
    <p class="text-center">
        2018 &copy; HRC Service. ALL Rights Reserved. 
    </p>  
</div>
<!--=== End Copyright v2 ===-->

<!-- JS Global Compulsory -->           
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/circles-master/circles.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/style-switcher.js"></script>

<!-- select 2 -->
<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.slicknav.min.js"></script>

<!-- ajax file upload  -->
<script src="<?php echo base_url() ?>assets/js/ajaxfileupload.js"></script>

<!-- Print -->
<script src="<?php echo base_url(); ?>assets/js/jQuery.print.js"></script>
        
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        StyleSwitcher.initStyleSwitcher();      
    });
    
    $(function () {
        
        $("#resume_type").select2({
            placeholder: "Select Resume Type",
            allowClear: true,
        });

        $("#state").select2({
            placeholder: "Select State",
            allowClear: true,
        });

        $("#skill_set").select2({
            placeholder: "Select skill set",
            allowClear: true,
        });
        $("#qualification").select2({
            placeholder: "Select qualification",
            allowClear: true,
        });
    
     });
    
    function upload_resume() {
        $('#upload_resume_form')[0].reset(); // reset form on modals
        $('#upload_resume_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Upload Resume'); // Set Title to Bootstrap modal title
    }
    
    
    $(function () {
        $('#upload_resume_form').submit(function (e) {
            e.preventDefault();
            loading_box(base_url);
            $.ajaxFileUpload({
                url: base_url + './Con_CVManagement/upload_resume_file/',
                secureuri: false,
                fileElementId: 'candidate_resume',
                dataType: 'JSON',
                success: function (data)
                {
                    var datas = data.split('__');
                    $('#upload_resume_path').val(datas[1]);
                    $('#resume_name_label').html(datas[1]);

                    var url = '';
                    view_message(datas[0], url, 'upload_resume_Modal', 'upload_resume_form');
                    
                }
            });
            return false;
        });
    });
    
    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: new FormData(this),
                type: $(this).attr('method'),
                processData: false,
                contentType: false
            }).done(function (data) {
                var url = '';
                view_message(data, url, '', 'sky-form11');
                
                reset_dropdown();
            });
            event.preventDefault();
        });
    });
    
    function show_apply_form()
    {
        $(".apply_form").removeAttr("style");
    }
    function reset_dropdown()
    {
       $("#state").select2({
            placeholder: "Select State",
            allowClear: true,
        });

        $("#skill_set").select2({
            placeholder: "Select skill set",
            allowClear: true,
        });
        $("#qualification").select2({
            placeholder: "Select qualification",
            allowClear: true,
        });
    }
    
    function printDiv() {
        $.print("#print_div");
    }

</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html> 