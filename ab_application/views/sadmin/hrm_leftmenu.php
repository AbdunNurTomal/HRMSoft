<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/no_table.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/seat_cart.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/seat_manage.js"></script>
<!--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/left_menu.css" />

<?php
    $user_data = $this->session->userdata('hr_logged_in');
    $user_menu = $user_data['user_menu'];
//echo $user_menu; exit;
    $showSidebar = true;
    if (empty($user_menu)) {
        $showSidebar = false;
    }

    $user_menu = explode(",", $user_menu);
    $user_menu = array_map('intval', $user_menu);

    $currentController = $this->router->fetch_class();
    $currentAction = $this->router->fetch_method();
    // print_r($currentController);exit;
?>

<!--=== Head Files  ===-->

<!-- new layout starts -->
<?php if ($showSidebar && ($currentController != "Con_Alert")) : ?>
<div class="col-lg-2 hrc_navigation_div xs-hidden">
    <div id="sidebar-container" class="sidebar-expanded"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->

        <ul class="hrc_navigation_ul sidebar-nav-v1">
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
                        <mhk data-value="menu:<?= $main_menu['menu_name']; ?>" style="display:none">menu</mhk>
                    </a>
                    <ul id="<?php echo $data_target; ?>" class="hrc_navigation_ul hrc_navigation_sub_ul collapse <?= $inClass; ?>">
                        <?php
                            $this->db->order_by("sequence", "asc");
                            $this->db->where(array('root_menu' => $main_menu['id'], 'sub_root_menu =' => 0, 'module_id' => $module_id, 'isactive' => 1));//'isactive' => 1
                            $this->db->where_in('id', $user_menu);
                            $root_menu_query = $this->db->get('main_menu');
                            
                            $strQry = $this->db->database . ':' . $this->db->mhkSQL;
                            
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
                                } else if (($currentAction == "index" || $currentAction == "edit_entry" || $currentAction == "get_search_employee") && $root['menu_link'] == $currentController) {
                                    $submenuActive = "menuactive";
                                }
                            ?>
                                <li class="list-group-item <?php echo $class; ?>" data-toggle="collapse" data-target="#<?php echo $root_data_target; ?>" >
                                <a id="<?php echo $root_data_target; ?>" href="<?php echo $root_menu_link; ?>" class="<?php echo $root_data_target; ?> <?= $submenuActive; ?>">
                                    <i class="fa fa-bars "></i> <?php echo $root['menu_name']; ?>
                                    <mhk data-value="root_menu:<?= $root['menu_name']; ?>" style="display:none">root_menu</mhk>
                                    <query data-value="root_menu:<?= $root['menu_name'] . ':' . $strQry; ?>" style="display:none"><?= $strQry; ?></query>
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
                                            <mhk data-value="sub_root_menu:<?= $sub_root['menu_name']; ?>" style="display:none">sub_root_menu</mhk>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
        </ul>

    </div><!-- sidebar-container END -->
</div>
<!-- new layout ends -->
<?php endif; ?>

<script>
    /* function left_menu_close() {
        $(".content .main-body .left_menu").addClass("hidden");
        $(".content .main-body .left_menu").removeClass("col-md-2");

        $(".content .main-body .main-content-div").addClass("col-md-12").removeClass("col-md-10");
        //$(".content .main-body .col-md-10").addClass("col-md-12");

        $("#open_span").removeClass("hidden");
    }

    function left_menu_open() {
        $(".content .main-body .left_menu").addClass("col-md-2");
        $(".content .main-body .left_menu").removeClass("hidden");

        $(".content .main-body .main-content-div").addClass("col-md-10").removeClass("col-md-12");

        $("#open_span").addClass("hidden");
        $("#close_span").addClass("col-md-12").removeClass("col-md-10");
    } */

    $(".sidebar-nav-v1 a").click(function (event) {
        if ($(this).attr('href') != '#') {
            var ttarget = $(this).attr("id");
            var rootclass = $(this).attr('class');

            localStorage.setItem("datatarget", ttarget);
            localStorage.setItem("roottarget", rootclass);
        }
    });

    $(".navbar-nav li a").click(function (event) {
        localStorage.setItem("datatarget", "undefined");
    });

    $("#hrcsoft_sidemenu_ul a").click(function (event) {
        if ($(this).attr('href') != '#') {
            var ttarget = $(this).attr("id");
            var rootclass = $(this).attr('class');

            localStorage.setItem("datatarget", ttarget);
            localStorage.setItem("roottarget", rootclass);
        }
    });

    $(document).ready(function () {
        if (typeof (Storage) !== "undefined") {
            var datatarget = localStorage.getItem("datatarget");
        } else {
            var datatarget = "";
            alert("Sorry, your browser does not support Web Storage...");
        }

        //alert (datatarget);

        if (typeof (Storage) !== "undefined") {
            var roottarget = localStorage.getItem("roottarget");
        } else {
            var roottarget = "";
            alert("Sorry, your browser does not support Web Storage...");
        }

        // alert (datatarget); 
        // $("#" + datatarget).css('background-color', '#f6f6f7');

        // $("#" + datatarget).css("background-color","#292452"); //"color", "#292452",
        // $("#" + datatarget).css("color","#fff"); //"color", "#292452",
        // $("." + roottarget).css("background-color","#292452"); //"color", "#292452",
        // $("." + roottarget).css("color","#fff"); //"color", "#292452",
        // $("." + roottarget).addClass("menuactive");
        // $("#" + datatarget).addClass("menuactive");

        // jQuery('[data-target="#' + datatarget + '"]').parent().addClass('in').css('height', 'auto');

        //jQuery('[data-target="#' + datatarget + '"]').parent().parent().addClass('in').css('height', 'auto');
        //jQuery('[data-target="#ManageHolidayGroup"]').parent().parent().addClass('in').css('height', 'auto')
        //localStorage.setItem("datatarget", "undefined");
    });
</script>
