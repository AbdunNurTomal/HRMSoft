<?php

Class Hr_login extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    
    public function get_user($username, $password) {
		//echo "username - ".$username." password - ".md5($password);
        //$username1 = mysqli_real_escape_string($username);
        //$password1 = mysqli_real_escape_string($password);
        $this->db->select(); //'id, user_id,user_pass,user_name,user_roll'
        $this->db->from('main_users');
        $this->db->where('email', $username);
        // $this->db->where('password', $this->Common_model->encrypt($password));
        $this->db->where('password', md5($password));
        $this->db->where('isactive', 1);
        $this->db->limit(1);
        $query = $this->db->get();
//echo 'last query - '.$this->db->last_query(); exit;
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function is_logged_in() {

        //print_r($this->session->userdata('logged_in'));
        //echo $this->session->get_userdata('logged_in');
        if($this->session->userdata('hr_logged_in')){
            return true;
        }
        else {
            return false;
        }
    }

    public function logout() {
        //echo "yyyyy";
        //print_r($this->session->get_userdata());
        //$this->session->sess_destroy();
        $this->session->unset_userdata('hr_logged_in');
        $this->session->sess_destroy();
        redirect();
    }

}
?>
