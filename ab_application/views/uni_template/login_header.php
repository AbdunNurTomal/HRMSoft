<?php
    $log_data = $this->session->userdata('hr_logged_in'); 
    //$coy_no=$log_data['coy_no'];
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        
        <title><?php echo $title; ?></title>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Favicon -->
       <link rel="icon" type="image/ico" href="<?php echo base_url(); ?>assets/img/icon.ico"/>

        <!-- Web Fonts -->
        <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>
        
        <!--  vegas slider  ======================================	 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/vegas.css">
        
        <!-- Ico font ======================================= -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/icofont.css">
        
        <!--   animate css  ======================================	 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">

        <!-- CSS Global Compulsory -->
        <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

        <!-- CSS Header and Footer -->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/headers/header-default.css">-->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/footers/footer-v1.css">-->
          
        <!-- CSS Implementing Plugins -->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/plugins/animate.css">-->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/plugins/line-icons/line-icons.css">-->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">-->
        <!--<link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">-->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">-->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">-->
        <!--[if lt IE 9]><link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->

        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/plugins/hover-effects/css/custom-hover-effects.css">-->

        <!-- CSS Page Style -->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/pages/page_search.css">-->

        <!-- CSS Theme -->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/theme-colors/default.css" id="style_color">-->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/theme-skins/dark.css">-->

        <!-- CSS Customization -->
       
        <!--<link href="<?php // echo base_url(); ?>assets/css/select2.css" rel="stylesheet"/>-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/image-hover/css/img-hover.css">
        <!-- CSS log-in -->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/login.css" />-->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/new_login.css" />-->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/plugins/magic/magic.css" />-->
        <!-- data table -->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/plugins/dataTables/dataTables.bootstrap.css" />-->
        <!-- JS -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
        <!--<script src="<?php // echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php // echo base_url(); ?>assets/js/plugins/validation.js"></script>-->
        <!-- select 2 -->
        <!--<script src="<?php // echo base_url(); ?>assets/js/select2.js"></script>--> 
        <!-- Time Picker-->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/timepicker/bootstrap-timepicker.css" type="text/css" media="screen">-->
        <!--<script type="text/javascript" src="<?php // echo base_url(); ?>assets/timepicker/bootstrap-timepicker.js"></script>-->
        <!--<script type="text/javascript" src="<?php // echo base_url(); ?>assets/js/jquery.chained.min.js"></script>--> 
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/custom.css">-->
        
       
        
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login_style.css">
    </head>
    <script>
	function defaultCompany()
	{
		document.forms[0].company_login_name.options[0].selected = true;
	}
        
    </script>

   