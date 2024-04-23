<?php

class Csv extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $company_id = null;
    public $user_type = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $date_time = null;
    public $module_data = array();
    public $module_id = null;

    function __construct() {
        parent::__construct();
        $this->load->model('Csv_model');
        $this->load->library('csvimport');

        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id = $this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");

//        if($this->user_type==2){ $this->company_id=$this->company_id;} else { $this->company_id=""; }

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];
    }

    function index() {

        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "CSV Import";
        $param['module_id'] = $this->module_id;
        $param['addressbook'] = $this->Csv_model->get_addressbook();

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/csvindex.php';
        $this->load->view('admin/home', $param);
    }

    function importcsv() {
        $param['addressbook'] = $this->Csv_model->get_addressbook();
        $param['error'] = '';    //initialize image upload error array to empty

        $config['upload_path'] = './uploads/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            //$data['error'] = $this->upload->display_errors();
            $param['error'] = $this->Common_model->show_massege($this->upload->display_errors(), 2);
            //$this->load->view('csvindex', $data);

            $param['menu_id'] = $this->menu_id;
            $param['page_header'] = "CSV Import";
            $param['module_id'] = $this->module_id;

            $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
            $param['content'] = 'hr/csvindex.php';
            $this->load->view('admin/home', $param);
        } else {
            $file_data = $this->upload->data();
            $file_path = './uploads/csv/' . $file_data['file_name'];

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'firstname' => $row['firstname'],
                        'lastname' => $row['lastname'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                    );
                    $this->Csv_model->insert_csv($insert_data);
                }
                //$this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                $this->session->set_flashdata('success', $this->Common_model->show_massege('Csv Data Imported Succesfully.', 1));

                redirect(base_url() . 'csv');
                //echo "<pre>"; print_r($insert_data);
            } else {
                $param['error'] = "Error occured";
                //$this->load->view('csvindex', $data);
                $param['menu_id'] = $this->menu_id;
                $param['page_header'] = "CSV Import";
                $param['module_id'] = $this->module_id;

                $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
                $param['content'] = 'hr/csvindex.php';
                $this->load->view('admin/home', $param);
            }
        }
    }

    public function get_from_file() {
        $file = fopen(Get_File_Directory('test/demo_data.txt'), "r");
        $Data_Arr = array();

        $state_id = 51;

        $i = 0;
        while (!feof($file)) {
            $county = trim(fgets($file));
            $Data_Arr[$i]['state_id'] = $state_id;
            $Data_Arr[$i]['county_name'] = trim($county);
            $Data_Arr[$i]['description'] = trim($county);
            $i++;
        }
        pr($Data_Arr);

        $this->db->insert_batch('main_county', $Data_Arr);
    }

}

/*END OF FILE*/
