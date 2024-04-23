<?php
$user_data = $this->session->userdata('hr_logged_in');
$user_type = $user_data ['usertype'];

//echo "==>>".$user_type;

if ($user_type == 1) {//1 for Self user
    if ($module_id == 0) {
        $param['title'] = 'HRM';
        $this->load->view('uni_template/sadmin_header.php', $param);
        //$this->load->view($left_menu, $param);
        $this->load->view($content, $param);
        $this->load->view('uni_template/footer_min.php');
    } else {
        $param['title'] = 'HRM';
        $this->load->view('uni_template/sadmin_header.php', $param);
        //$this->load->view($left_menu, $param);
        //$this->load->view($content, $param);
        
        if ($module_id == 10 || $module_id == 13)
        {
            //$this->load->view($left_menu, $param);
            $this->load->view($content, $param);
        }  else {
            $this->load->view($left_menu, $param);
            $this->load->view($content, $param);
        }
    
        $this->load->view('uni_template/footer_min.php');
    }
} else if ($user_type == 2) {//2 for Company Admin
    $param['title'] = 'HRM';
    $this->load->view('uni_template/sadmin_header.php', $param);
    if ($module_id == 10 || $module_id == 13 || $module_id == 14)
    {
        //$this->load->view($left_menu, $param);
        $this->load->view($content, $param);
    }  else {
        $this->load->view($left_menu, $param);
        $this->load->view($content, $param);
    }
    $this->load->view('uni_template/footer_min.php');
} else if ($user_type == 3) {//3 for System Admin
    //echo "===".$module_id;
    if ($module_id == 0) {
        $param['title'] = 'HRM';
        $this->load->view('uni_template/sadmin_header.php', $param);
        //$this->load->view($left_menu, $param);
        $this->load->view($content, $param);
        $this->load->view('uni_template/footer_min.php');
    } else {
        $param['title'] = 'HRM';
        $this->load->view('uni_template/sadmin_header.php', $param);
        if ($module_id == 10 || $module_id == 13 || $module_id == 14)
        {
            //$this->load->view($left_menu, $param);
            $this->load->view($content, $param);
        }  else {
            $this->load->view($left_menu, $param);
            $this->load->view($content, $param);
        }
        $this->load->view('uni_template/footer_min.php');
    }
} else if ($user_type == 4) {//4 for System Admin
    $param['title'] = 'HRM';
    $this->load->view('uni_template/sadmin_header.php', $param);
    $this->load->view($left_menu, $param);
    $this->load->view($content, $param);
    $this->load->view('uni_template/footer_min.php');
} else {
    $param['title'] = 'HRM';

    $this->load->view('uni_template/login_header.php', $param);

    if ($content == "uni_template/reset_password.php") {
        $this->load->view($content, $passwordResetHash);
    } else {
        $this->load->view($content);
    }

    $this->load->view('uni_template/login_footer.php');
}
