<?php
    $log_data = $this->session->userdata('hr_logged_in');
    $username = $log_data['name'];
    $userid = $log_data['id'];
    $userimage = $log_data['user_image'];
    $user_group = $log_data['user_group'];
    $admin_login = $log_data['admin_login'];
    $admin_user_id = $log_data['admin_user_id'];

    if ($user_group == 1) {
        $api_secret_type = 1;
    } else {
        $api_secret_type = 1;
    }

    $query = $this->db->get_where('main_apisetting', array('company_id' => $this->company_id, 'api_secret_type' => $api_secret_type, 'isactive' => 1))->row();
    //echo $this->db->last_query();
    if (!empty($query)) {
        $clint_site_id = $query->site;
        $clint_accountant = $query->accountant;
        $clint_api_secret = $query->api_secret;
        //$clint_api_secret = 'oiUY744EbYEWnHSGRZw5pVdjIYkJPQMoFKOqighfkuuEByn7PWbKKRC85ynsgfKl';
    } else {
        $clint_site_id = '33172';
        $clint_accountant = '1086';
        $clint_api_secret = 'oiUY744EbYEWnHSGRZw5pVdjIYkJPQMoFKOqighfkuuEByn7PWbKKRC85ynsgfKl';
    }
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
        <!--<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-OpenSans.css">

        <!-- CSS Global Compulsory -->
        <link rel="stylesheet"  href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/hrc_styles.css">
        
        <!-- CSS Header and Footer -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/headers/header-default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/footers/footer-v1.css">

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/animate.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/line-icons/line-icons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
        <!--<link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
        <!--[if lt IE 9]><link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/hover-effects/css/custom-hover-effects.css">

        <!-- CSS Page Style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pages/page_search.css">

        <!-- CSS Page Style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pages/page_404_error.css">

        <!-- CSS Theme -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-colors/default.css" id="style_color">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme-skins/dark.css">

        <!-- CSS Customization -->
        <link href="<?php echo base_url(); ?>assets/css/select2.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/image-hover/css/img-hover.css">

        <!-- CSS log-in -->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/login.css" />
        <link rel="stylesheet" href="<?php // echo base_url(); ?>assets/plugins/magic/magic.css" />-->

        <!-- data table -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dataTables/dataTables.bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dataTables/jquery.dataTables.css" />
        
        <!-- JS -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/validation.js"></script>

        <!-- select 2 -->
        <script src="<?php echo base_url(); ?>assets/js/select2.js"></script>

        <!-- Print -->
        <script src="<?php echo base_url(); ?>assets/js/jQuery.print.js"></script>

        <!-- Time Picker-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/timepicker/bootstrap-timepicker.css" type="text/css" media="screen">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/timepicker/bootstrap-timepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.chained.min.js"></script>

        <script src="<?php echo base_url() ?>assets/js/ajaxfileupload.js"></script>
        <!-- <link rel="stylesheet" href="<?php // echo base_url(); ?>assets/css/slicknav.min.css"> -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
        <link href="<?php echo base_url(); ?>assets/slimimage/slim/slim.min.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/bootstrap-datepicker/css/bootstrap-datepicker.css">
        
        <!-- bootstrap-sweetalert-master -->
        <!--<link rel="stylesheet" href="<?php // echo base_url(); ?>assets/sweetalert-master/dist/sweetalert.css">-->
       
        <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->
        <!--<script src="http://kjur.github.io/jsrsasign/jsrsasign-latest-all-min.js"></script>-->
        <script src="<?php echo base_url(); ?>assets/js/jsrsasign-latest-all-min.js"></script>
    
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
            var user_group = '<?php echo $user_group; ?>';
            var userid = '<?php echo $userid; ?>';

            var clint_site_id = '<?php echo $clint_site_id; ?>';
            var clint_accountant = '<?php echo $clint_accountant; ?>';
            var clint_api_secret = '<?php echo $clint_api_secret; ?>';
        </script>
    </head>

    <body class="">
        <div class="wrapper">
            <!-- Mobile Navigation bar starts -->
            <nav id="mobile-navbar" class="navbar navbar-fixed-top lg-hidden" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <ul style=" list-style-type: none; margin-top:10px;">
                    <li class="dropdown">
                            <a href="" class="dropdown-toggle pull-right layout-loggedin-username-anchor-mobile" data-toggle = "dropdown">
                                <?php
                                    $src = base_url() . "assets/img/user_img.png";
                                    if ($userimage) {
                                        $userImagePath = FCPATH . "uploads/user_image/" . $userimage;
                                        if (file_exists($userImagePath)) {
                                            $src = base_url() . "uploads/user_image/" . $userimage;
                                        }
                                    }
                                ?>
                                <img class="rounded-x" src="<?php echo $src; ?>" alt="" height="30" width="30">
                                <span class="layout-loggedin-username"><?php echo $username; ?></span>&nbsp;&nbsp;
                                <span class = "caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right" style="margin-top: 40px; padding: 0px;">
                                <li><a href="#"><i class="fa fa-cog"></i><span>Settings</span></a></li>
                                <li class="divider"></li>

                                <?php if($admin_login == 1) : ?>
                                    <li><a href = "<?php echo base_url() . 'Con_ChangeCompany/change_AdminbyCompany/' . $admin_user_id; ?>"><i class="fa fa-home"></i><span>Home</span></a></li>
                                    <li class="divider"></li>
                                <?php endif; ?>

                                <?php if ($user_group == 1 || $user_group == 12) : ?>
                                    <!--<li><a href = "#" onclick="mail_settings();" ><i class="fa-li fa fa-spinner fa-spin"></i> Mail Settings </a></li>-->
                                <?php endif; ?>

                                <li><a href = "<?php echo base_url() . "Con_User/view_user_data/" . $userid ?>"><i class="fa fa-eye"></i><span>View Profile</span></a></li>
                                <li class="divider"></li>

                                <li><a href = "#" onclick="change_password();"><i class="fa fa-key"></i> <span>Change Password</span> </a></li>
                                <li class="divider"></li>

                                <li><a href = "<?php echo base_url() . "Con_User/settings/"?>"><i class="fa fa-cog"></i> <span>User settings</span></a></li>
                                <li class="divider"></li>

                                <li><a onclick="clear_cache()" href = "<?php echo base_url() . 'index.php/Chome/logout' ?>"><i class="fa fa-sign-out"></i><span>Log Out</span></a></li>
                            </ul>
                        </li>
                    </ul>
                    
                    <a class="">
                        <div class="hrc_innerpage_logo">
                            <?php $logoUrl = base_url() . "assets/img/hrc_logo.png";
                            if ($user_group != 1 || $user_group != 2 || $user_group != 3) :
                                $logo = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_logo');
                                if ($logo) {
                                    $logoUrl = base_url() . "uploads/companylogo/" . $logo;
                                } ?>
                            <?php endif; ?>
                            <a href="<?php echo base_url() . 'Con_dashbord' ?>">
                                <img src="<?php echo $logoUrl; ?>" class="hrc-logo" alt="HRCSoft" title="HRCSoft" />
                            </a>
                            <?php $companyName = "HRC - HR SYSTEM";
                                if ($user_group != 1 && $user_group && 2 && $user_group != 3) {
                                    $show_in_header = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'show_in_header');

                                    if ($show_in_header == 0) {
                                        $companyName = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_full_name');
                                    } else {
                                        $companyName = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_short_name');
                                    }
                                }
                            ?>
                        </div>
                    </a>
                </div>

                <?php
                    $user_data = $this->session->userdata('hr_logged_in');
                    $user_menu = $user_data['user_menu'];

                    $showSidebar = true;
                    if (empty($user_menu)) {
                        $showSidebar = false;
                    }

                    $user_menu = explode(",", $user_menu);
                    $user_menu = array_map('intval', $user_menu);

                    $currentController = $this->router->fetch_class();
                    $currentAction = $this->router->fetch_method();
                    
                    $this->db->select('main_menu.id, main_module.module_name');
                    $this->db->from('main_menu');
                    $this->db->join('main_module', 'main_module.id = main_menu.module_id');
                    $this->db->like('main_menu.menu_link', $currentController);
                    $moduleQuery = $this->db->get();
                    $moduleRecord = $moduleQuery->result();

                    if (empty($moduleRecord)) {
                        $this->db->select('main_module.module_name');
                        $this->db->from('main_module');
                        $this->db->like('main_module.module_link', $currentController);
                        $moduleQuery = $this->db->get();
                        $moduleRecord = $moduleQuery->result();
                    }
                    $currentModule = $moduleRecord ? $moduleRecord[0]->module_name : "-";
                ?>
                <!-- Mobile - Top Menu Items starts -->
                <ul class="nav navbar-right top-nav topbar-border">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle pull-left layout-loggedin-topbar-anchor-mobile" style="padding-top:10px;" data-toggle="dropdown">
                            <span class="layout-loggedin-username"><?= $currentModule; ?></span>&nbsp;&nbsp;
                            <span class = "caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-left" style="margin-top: 50px; padding: 0px;">
                            <?php
                                // check for sidemenu click starts
                                $currentController = $this->router->fetch_class();
                                $currentAction = $this->router->fetch_method();

                                $this->db->select('mo.module_link');
                                $this->db->from('main_menu as mm');
                                $this->db->join('main_module as mo', 'mo.id = mm.module_id');
                                $this->db->where('mm.menu_link', $currentController);
                                $query = $this->db->get();

                                $activeMenuModuleLink = "";
                                if ($query->num_rows() > 0) {
                                    $activeMenuModuleLink = $query->result()[0]->module_link;
                                }
                                // check for sidemenu click ends

                                $user_data = $this->session->userdata('hr_logged_in');
                                $user_module = $user_data ['user_module'];
                                $user_module = explode(",", $user_module);
                                $user_module = array_map('intval', $user_module);

                                $this->db->order_by("sequence", "asc");
                                $this->db->where(array('status' => 1));
                                $this->db->where_in('id', $user_module);
                                $module_query = $this->db->get('main_module');

                                foreach ($module_query->result() as $key):
                                    if ($key->id == 13) {
                                        $module_link = base_url() . $key->module_link . '/' . 'index' . '/' . $key->id;
                                        $tergate = "";
                                    } else {
                                        $module_link = base_url() . $key->module_link . '/' . 'index' . '/' . $key->id;
                                        $tergate = "";
                                    }

                                    $menuActive = "";
                                    if ($this->router->fetch_class() == $key->module_link) {
                                        $menuActive = "menuactive";
                                    } else if ($activeMenuModuleLink && $activeMenuModuleLink == $key->module_link) {
                                        $menuActive = "menuactive";
                                    }

                                    $menuEqualWidth = "width: 100%";
                                    if ($key->module_name == "Talent Acquisition" || $key->module_name == "Time & Attendance") {
                                        $menuEqualWidth = "";
                                    }
                                ?>
                                <li>
                                    <a id="<?php echo $key->module_link . "_mod"; ?>" href="<?php echo $module_link; ?>" class="<?= $menuActive; ?>" style="<?= $menuEqualWidth; ?>"><?php echo $key->module_name; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </ul>
                <!-- Mobile - Top Menu Items ends -->
                <!-- Mobile - Sidebar Menu Items - These collapse to the responsive navigation menu on small screens starts -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <?php
                            $this->db->order_by("sequence", "asc");
                            $this->db->where(array('root_menu' => 0, 'module_id' => $module_id, 'isactive' => 1));
                            $this->db->where_in('id', $user_menu);
                            $main_menu_query = $this->db->get('main_menu');
                            foreach ($main_menu_query->result_array() as $main_menu) :
                                $data_target = preg_replace('/\s+/', '', $main_menu['menu_name']);
                                $menu_icon = "";
                                if ($main_menu['menu_link'] == "") {
                                    $menu_link = "#";
                                    $aclass = "list-toggle";
                                } else {
                                    $segments = array($main_menu['menu_link'], 'index', $main_menu['id']);
                                    $menu_link = site_url($segments);
                                    $aclass = "";
                                }

                                $menu_icon_path = FCPATH . "assets/img/menu_icons/" . $main_menu['menu_icon'] . ".png";
                                if (file_exists($menu_icon_path)) {
                                    $menu_icon = base_url() . "assets/img/menu_icons/" . $main_menu['menu_icon'] . ".png";
                                }

                                $hasSubMenu = false;
                                $query = $this->db->query('SELECT * FROM main_menu WHERE root_menu='. $main_menu['id']);
                                if ($query->num_rows() > 0) {
                                    $hasSubMenu = true;
                                }

                                $menuActive = "";
                                if ($main_menu['menu_link'] == $currentController) {
                                    $menuActive = "menuactive";

                                    if (file_exists($menu_icon_path)) {
                                        $menu_icon = base_url() . "assets/img/menu_icons/" . $main_menu['menu_icon'] . "_active.png";
                                    }
                                }

                                $areaExpanded = "false";
                                $inClass = "";
                                $query = $this->db->query("SELECT * FROM main_menu WHERE root_menu=". $main_menu['id'] ." AND menu_link='{$currentController}'");
                                if ($query->num_rows() > 0) {
                                    $areaExpanded = "true";
                                    $inClass = "in";

                                    if (file_exists($menu_icon_path)) {
                                        $menu_icon = base_url() . "assets/img/menu_icons/" . $main_menu['menu_icon'] . "_active.png";
                                    }
                                }
                            ?>
                            <li class="list-group-item <?php echo $aclass; ?>" data-toggle="collapse" data-target="#<?php echo $data_target; ?>" aria-expanded="<?= $areaExpanded; ?>">
                                <a href="<?php echo $menu_link; ?>" class="<?php echo $data_target; ?> <?= $menuActive; ?>">
                                    <?php if ($menu_icon) : ?>
                                        <img class="sidebar-menu-icon" src="<?= $menu_icon; ?>">
                                    <?php else: ?>
                                        <i class="fa fa-bars"></i>
                                    <?php endif; ?>
                                    <?php echo $main_menu['menu_name'] ?>
                                </a>
                                <ul id="<?php echo $data_target; ?>" class="hrc_navigation_ul hrc_navigation_sub_ul collapse <?= $inClass; ?>">
                                    <?php
                                        $this->db->order_by("sequence", "asc");
                                        $this->db->where(array('root_menu' => $main_menu['id'], 'sub_root_menu =' => 0, 'module_id' => $module_id, 'isactive' => 1));//'isactive' => 1
                                        $this->db->where_in('id', $user_menu);
                                        $root_menu_query = $this->db->get('main_menu');
                                        foreach ($root_menu_query->result_array() as $root) :
                                            $root_data_target = preg_replace('/\s+/', '', $root['menu_name']);
                                            if ($root['menu_link'] == "") {
                                                $root_menu_link = "#";
                                                $class = "list-toggle active";
                                            } else {
                                                $rootsegments = array($root['menu_link'], 'index', $root['id']);
                                                $root_menu_link = site_url($rootsegments);

                                                $class = "";
                                            }

                                            if ($root_data_target == "Notification") {
                                                $root_data_target = "Notification/Notification";
                                            }

                                            $submenuActive = "";
                                            if ($root['menu_link'] == $currentController . "/" . $currentAction) {
                                                $submenuActive = "menuactive";
                                            } else if ($currentAction == "index" && $root['menu_link'] == $currentController) {
                                                $submenuActive = "menuactive";
                                            }
                                        ?>
                                            <li class="list-group-item <?php echo $class; ?>" data-toggle="collapse" data-target="#<?php echo $root_data_target; ?>" >
                                                <a id="<?php echo $root_data_target; ?>" href="<?php echo $root_menu_link; ?>" class="<?php echo $root_data_target; ?> <?= $submenuActive; ?>">
                                                    <i class="fa fa-bars "></i> <?php echo $root['menu_name']; ?>
                                                </a>
                                                <?php
                                                    $this->db->order_by("sequence", "asc");
                                                    $this->db->where(array('sub_root_menu =' => $root['id'], 'module_id' => $module_id, 'isactive' => 1));//'isactive' => 1
                                                    $this->db->where_in('id', $user_menu);
                                                    $sub_root_menu_query = $this->db->get('main_menu');
                                                    foreach ($sub_root_menu_query->result_array() as $sub_root) :
                                                        $sub_root_data_target = preg_replace('/\s+/', '', $sub_root['menu_name']);
                                                        $sub_rootsegments = array($sub_root['menu_link'], 'index', $sub_root['id']);
                                                        $sub_root_menu_link = site_url($sub_rootsegments);

                                                        $subsubmenuActive = "";
                                                        if ($sub_root['menu_link'] == $currentController) {
                                                            $subsubmenuActive = "menuactive";
                                                        }
                                                    ?>

                                                    <li class="list-group-item">
                                                        <a href="<?php echo $sub_root_menu_link; ?>" class="<?php echo $sub_root_data_target; ?> <?= $subsubmenuActive; ?>" style="padding-left: 35px !important;">
                                                            <i class="fa fa-arrows-h"></i>
                                                            <?= $sub_root['menu_name']; ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- Mobile - Sidebar Menu Items - These collapse to the responsive navigation menu on small screens ends -->
            </nav>
            <!-- Mobile Navigation bar ends -->

            <!-- header (logo, company name and logged in user image) starts -->
            <header>
                <div class="container-fluid">
                    <div class="row header-logo-section-div xs-hidden">
                        <div class=" col-lg-8 col-sm-8 col-xs-8 text-left">
                            <div class="hrc_innerpage_logo">
                                <?php $logoUrl = base_url() . "assets/img/hrc_logo.png";
                                if ($user_group != 1 || $user_group != 2 || $user_group != 3) :
                                    $logo = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_logo');
                                    if ($logo) {
                                        $logoUrl = base_url() . "uploads/companylogo/" . $logo;
                                    } ?>
                                <?php endif; ?>
                                <a href="<?php echo base_url() . 'Con_dashbord' ?>">
                                    <img src="<?php echo $logoUrl; ?>" alt="HRCSoft" title="HRCSoft" />
                                </a>
                                <?php $companyName = "HRC - HR SYSTEM";
                                    if ($user_group != 1 && $user_group && 2 && $user_group != 3) {
                                        $show_in_header = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'show_in_header');

                                        if ($show_in_header == 0) {
                                            $companyName = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_full_name');
                                        } else {
                                            $companyName = $this->Common_model->get_selected_value($this, "id", $this->company_id, 'main_company', 'company_short_name');
                                        }
                                    }
                                ?>
                                <h4 style="padding: 8px 0 0 20px; position: absolute;"><?php echo $companyName; ?></h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-xs-4 text-right user-option">
                            <a href="" class="dropdown-toggle layout-loggedin-username-anchor" data-toggle = "dropdown">
                                <?php 
                                    $src = base_url() . "assets/img/user_img.png";
                                    if ($userimage) {
                                        $userImagePath = FCPATH . "uploads/user_image/" . $userimage;
                                        if (file_exists($userImagePath)) {
                                            $src = base_url() . "uploads/user_image/" . $userimage;
                                        }
                                    }
                                ?>
                                <img class="rounded-x" src="<?php echo $src; ?>" alt="" height="40" width="40">
                                <span class="layout-loggedin-username"><?php echo $username; ?></span>
                                <span class = "caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right" style="margin-top: 20px; padding: 0px;">
                                <li><a href="#"><i class="fa fa-cog"></i><span>Settings</span></a></li>
                                <li class="divider"></li>

                                <?php if($admin_login == 1) : ?>
                                    <li><a href = "<?php echo base_url() . 'Con_ChangeCompany/change_AdminbyCompany/' . $admin_user_id; ?>"><i class="fa fa-home"></i><span>Home</span></a></li>
                                    <li class="divider"></li>
                                <?php endif; ?>

                                <?php if ($user_group == 1 || $user_group == 12) : ?>
                                    <!--<li><a href = "#" onclick="mail_settings();" ><i class="fa-li fa fa-spinner fa-spin"></i> Mail Settings </a></li>-->
                                <?php endif; ?>

                                <li><a href = "<?php echo base_url() . "Con_User/view_user_data/" . $userid ?>"><i class="fa fa-eye"></i><span>View Profile</span></a></li>
                                <li class="divider"></li>

                                <li><a href = "#" onclick="change_password();"><i class="fa fa-key"></i> <span>Change Password</span> </a></li>
                                <li class="divider"></li>

                                <li><a href = "<?php echo base_url() . "Con_User/settings/"?>"><i class="fa fa-cog"></i> <span>User settings</span></a></li>
                                <li class="divider"></li>

                                <li><a onclick="clear_cache()" href = "<?php echo base_url() . 'index.php/Chome/logout' ?>"><i class="fa fa-sign-out"></i><span>Log Out</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <!-- header (logo, company name and logged in user image) ends -->

            <!-- other than mobile navbar starts -->
            <?php if ($module_id != 0) : ?>
                <nav class="hrc_menu_nav">
                    <ul class="hrc_menu_ul">
                        <?php
                            // check for sidemenu click starts
                            $currentController = $this->router->fetch_class();
                            $currentAction = $this->router->fetch_method();

                            $this->db->select('mo.module_link');
                            $this->db->from('main_menu as mm');
                            $this->db->join('main_module as mo', 'mo.id = mm.module_id');
                            $this->db->where('mm.menu_link', $currentController);
                            $query = $this->db->get();

                            $activeMenuModuleLink = "";
                            if ($query->num_rows() > 0) {
                                $activeMenuModuleLink = $query->result()[0]->module_link;
                            }
                            // print_r($currentAction);exit();
                            // check for sidemenu click ends

                            $user_data = $this->session->userdata('hr_logged_in');
                            $user_module = $user_data ['user_module'];
                            $user_module = explode(",", $user_module);
                            $user_module = array_map('intval', $user_module);

                            $this->db->order_by("sequence", "asc");
                            $this->db->where(array('status' => 1));
                            $this->db->where_in('id', $user_module);
                            $module_query = $this->db->get('main_module');

                            foreach ($module_query->result() as $key):
                                if ($key->id == 13) {
                                    $module_link = base_url() . $key->module_link . '/' . 'index' . '/' . $key->id;
                                    $tergate = "";
                                } else {
                                    $module_link = base_url() . $key->module_link . '/' . 'index' . '/' . $key->id;
                                    $tergate = "";
                                }

                                $menuActive = "";
                                if ($this->router->fetch_class() == $key->module_link) {
                                    $menuActive = "menuactive";
                                } else if ($activeMenuModuleLink && $activeMenuModuleLink == $key->module_link) {
                                    $menuActive = "menuactive";
                                }

                                $menuEqualWidth = "width: 90px";
                                if ($key->module_name == "Talent Acquisition" || $key->module_name == "Time & Attendance") {
                                    $menuEqualWidth = "";
                                }
                            ?>
                                <li>
                                    <a id="<?php echo $key->module_link . "_mod"; ?>" href="<?php echo $module_link; ?>" class="<?= $menuActive; ?>" style="<?= $menuEqualWidth; ?>"><?php echo $key->module_name; ?></a>
                                </li>
                            <?php endforeach; ?>
                    </ul>
                </nav>
            <?php else: ?>
                <nav class="hrc_menu_nav">
                    <ul class="hrc_menu_ul">
                        <!-- <li><a href="<?php // echo base_url() . "Con_Admin_Dashbord/"; ?>" class="menuactive">Company List</a></li> -->
                        <li><a href="" class="menuactive">Alert</a></li>
                    </ul>
                </nav>
            <?php endif; ?>
            <!-- other than mobile navbar ends -->

<!-- content section starts here and will be ended in each view -->
<div id="main-container" class="container content" style="padding-top: 0px;">
    <div class="row main-body m-0 ml-dk-15">

        <section>
            <div class="row zero-margin">

            <div class="col-md-10 col-md-offset-2 pull-right" id='messagebox' style=" font-size: 14px; text-align: center; position: relative; z-index: 9999 !important;"></div>

            <?php if ($module_id == 0) : ?>
                <div class="container content" style="padding-top: 0px;">
                    <div class="row main-body">
            <?php endif; ?>

            <!-- change_password_modal starts -->
            <div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                        </div>
                        <form id="change_password_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Password <span class="req"/></label>
                                    <div class="col-sm-6">
                                        <input type="password" name="user_password" id="user_password" class="form-control input-sm" placeholder="User Password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Confirm Password <span class="req"/></label>
                                    <div class="col-sm-6">
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control input-sm" placeholder="Confirm Password" />
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" id="usubmit" class="btn btn-u"> Change Password </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Close </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- change_password_modal ends -->

            <!-- mail_settings_modal starts -->
            <div class="modal fade" id="mail_settings_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel"> Mail Settings </h4>
                        </div>
                        <form id="mail_settings_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                            <div class="modal-body">
                                <input type="hidden" name="company_id" id="company_id" />
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> User Name <span class="req"/></label>
                                    <div class="col-sm-6">
                                        <input type="email" name="useremail" id="useremail" class="form-control input-sm" placeholder="User Name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Password <span class="req"/></label>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> SMTP Server <span class="req"/></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="smtp_server" id="smtp_server" class="form-control input-sm" placeholder="SMTP Server" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Secure Transport Layer </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="secure_transport_layer" id="secure_transport_layer" class="form-control input-sm" placeholder="Secure Transport Layer" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Port <span class="req"/></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="port" id="port" class="form-control input-sm" placeholder="Port" />
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" id="submit" class="btn btn-u"> Settings </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Close </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- mail_settings_modal ends -->

<script>
    var save_method; // for save method string
    function change_password() {
        save_method = 'add';
        $('#change_password_form')[0].reset(); // reset form on modals
        $('#change_password_modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Change Password'); // Set Title to Bootstrap modal title
    }

    function mail_settings() {
        check_mail_settings();
        save_method = 'add';
        $('#mail_settings_form')[0].reset(); // reset form on modals
        $('#mail_settings_modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Mail Settings'); // Set Title to Bootstrap modal title
    }

    $(function () {
        $("#change_password_form").submit(function (event) {
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('Chome/change_password') ?>";
            } else {
                url = "<?php echo site_url('Chome/change_password') ?>";
            }
            $.ajax({
                url: url,
                data: $("#change_password_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                var url = '';
                view_message(data, url, 'change_password_modal', 'change_password_form');
            });
            event.preventDefault();
        });
    });

    $(function () {
        $("#mail_settings_form").submit(function (event) {
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('Chome/mail_settings') ?>";
            } else {
                url = "<?php echo site_url('Chome/mail_settings') ?>";
            }
            $.ajax({
                url: url,
                data: $("#mail_settings_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                var url = '';
                view_message(data, url, 'mail_settings_modal', 'mail_settings_form');
            });
            event.preventDefault();
        });
    });

    function check_mail_settings() {
        // save_method = 'add';
        $('#mail_settings_form')[0].reset(); // reset form on modals

        // Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Chome/ajax_edit_mail_settings/'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="company_id"]').val(data.company_id);
                $('[name="useremail"]').val(data.useremail);
                $('[name="password"]').val(data.password);
                $('[name="smtp_server"]').val(data.smtp_server);
                $('[name="secure_transport_layer"]').val(data.secure_transport_layer);
                $('[name="port"]').val(data.port);

                // $('#mail_settings_modal').modal('show'); // show bootstrap modal
                // $('.modal-title').text('Mail Settings'); // Set Title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function clear_cache() {
       localStorage.clear();
    }

    var isMobile = false; // initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
        isMobile = true;
    }
    if (!isMobile) {
        $("#mobile-navbar").empty();
    }

</script>
