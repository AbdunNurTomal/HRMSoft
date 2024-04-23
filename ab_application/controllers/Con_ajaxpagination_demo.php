<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_ajaxpagination_demo extends CI_Controller {

    public $user_data = array();
    public $user_id = null;
    public $user_type = null;
    public $user_group = null;
    public $user_menu = null;
    public $user_module = null;
    public $menu_id = null;
    public $company_id = null;
    public $date_time = null;
    public $module_data = array();
    public $module_id = null;

    public function __construct() {
        parent::__construct();
        $this->user_data = $this->session->userdata('hr_logged_in');
        $this->user_id = $this->user_data['id'];
        $this->company_id = $this->user_data['company_id'];
        $this->user_type = $this->user_data['usertype'];
        $this->user_group = $this->user_data['user_group'];
        $this->user_menu = $this->user_data['user_menu'];
        $this->user_module = $this->user_data['user_module'];
        $this->date_time = date("Y-m-d H:i:s");

        $this->module_data = $this->session->userdata('active_module_id');
        $this->module_id = $this->module_data['module_id'];

        $this->load->library('Ajax_pagination');
        $this->perPage = 10;
    }

    public function index() {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Employment Status";
        $param['module_id'] = $this->module_id;
        $param['status_array'] = $this->Common_model->get_array('status');

//        if ($this->user_type == 2) {
//            $param['query'] = $this->db->get_where('main_menu', array('company_id' => $this->company_id));
//        } else {
//            $param['query'] = $this->db->get('main_menu');
//        }

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_ajaxpagination_demo2.php';
        $this->load->view('admin/home', $param);
    }

    function ajaxPaginationData() {

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Employment Status";
        $param['module_id'] = $this->module_id;
        $param['status_array'] = $this->Common_model->get_array('status');
//        if ($this->user_type == 2) {
//            $param['query'] = $this->db->get_where('main_menu', array('company_id' => $this->company_id));
//        } else {
//            $param['query'] = $this->db->get('main_menu');
//        }

        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        //total rows count
        $totalRec = count($this->Common_model->getRows_pagination());

        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'Con_ajaxpagination_demo/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $this->ajax_pagination->initialize($config);

        //get the posts data
        $param['query'] = $this->Common_model->getRows_pagination(array('start' => $offset, 'limit' => $this->perPage));

        //load the view
        //$this->load->view('posts/ajax-pagination-data', $data, false);

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_ajaxpagination_demo.php';
        $this->load->view('admin/home', $param);
    }

    public function add_status() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $param['type'] = "1";
        $param['page_header'] = "Employment Status";
        //$this->load->model('hr_module');
        //$param['left_menu_content'] = $this->hr_module->left_menu(2);
        $param['module_id'] = $this->module_id;
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addajaxpagination_demo.php';
        $this->load->view('admin/home', $param);
    }

    public function save_status() {
        $this->form_validation->set_rules('work_code_name', 'Work Code', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('work_short_code', 'Work Short Code', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $user_data = $this->session->userdata('logged_in');
            $user_id = $user_data['id'];
            $date_time = date("Y-m-d H:i:s");

            $data = array('company_id' => $this->company_id,
                'workcodename' => $this->input->post('work_code_name'),
                'workcode' => $this->input->post('work_short_code'),
                'description' => $this->input->post('description'),
                'createdby' => $this->user_id,
                'createddate' => $this->date_time,
                'isactive' => '1',
            );
            $res = $this->Common_model->insert_data('main_employmentstatus', $data);

            if ($res) {
                echo $this->Common_model->show_massege(0, 1);
            } else {
                echo $this->Common_model->show_massege(1, 2);
            }
        }
    }

    function edit_entry() {
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);
        $id = $this->uri->segment(3);
        $param['workcodename'] = str_replace("%20", " ", $this->uri->segment(4));
        $param['type'] = "2";
        $param['query'] = $this->db->get_where('main_employmentstatus', array('id' => $id));
        $param['listquery'] = $this->Common_model->listItem('tbl_employmentstatus');
        $param['page_header'] = "Employment Status";
        //$this->load->model('hr_module');
        //$param['left_menu_content'] = $this->hr_module->left_menu(2);
        $param['module_id'] = $this->module_id;
        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'hr/view_addajaxpagination_demo.php';
        $this->load->view('admin/home', $param);
    }

    public function edit_status() {
        $this->form_validation->set_rules('work_code_name', 'Work Code', 'required', array('required' => "Please the enter required field, for more Info : %s."));
        $this->form_validation->set_rules('work_short_code', 'Work Short Code', 'required', array('required' => "Please the enter required field, for more Info : %s."));

        if ($this->form_validation->run() == FALSE) {
            echo $this->Common_model->show_validation_massege(validation_errors(), 2);
        } else {
            $user_data = $this->session->userdata('logged_in');
            $user_id = $user_data['id'];
            $date_time = date("Y-m-d H:i:s");

            $data = array('company_id' => $this->company_id,
                'workcode' => $this->input->post('work_short_code'),
                'workcodename' => $this->input->post('work_code_name'),
                'description' => $this->input->post('description'),
                'modifiedby' => $this->user_id,
                'modifieddate' => $this->date_time,
                'isactive' => '1',
            );

            $res = $this->Common_model->update_data('main_employmentstatus', $data, array('id' => $this->input->post('id')));

            if ($res) {
                echo $this->Common_model->show_massege(2, 1);
            } else {
                echo $this->Common_model->show_massege(3, 2);
            }
        }
    }

    public function delete_entry() {
        $id = $this->uri->segment(3);
        $this->Common_model->delete_by_id("main_employmentstatus", $id);
        redirect('con_EmploymentStatus/');
        exit;
    }

    public function pagination() {
        $page_number = $this->input->post('page_number');

        $item_par_page = 10;
        $position = ($page_number * $item_par_page);
        $result_set = $this->db->query("SELECT * FROM main_menu LIMIT " . $position . "," . $item_par_page);
        $total_set = $result_set->num_rows();
        $page = $this->db->get('main_menu');
        $total = $page->num_rows();
        //break total recoed into pages
        $total = ceil($total / $item_par_page);
        if ($total_set > 0) {
            $entries = null;
            // get data and store in a json array
            foreach ($result_set->result() as $row) {
                $entries[] = $row;
            }
            $data = array(
                'TotalRows' => $total,
                'Rows' => $entries
            );
            $this->output->set_content_type('application/json');
            echo json_encode(array($data));
        }
        exit;
    }

    public function pagination2() {


        /*
         * DataTables example server-side processing script.
         *
         * Please note that this script is intentionally extremely simply to show how
         * server-side processing can be implemented, and probably shouldn't be used as
         * the basis for a large complex system. It is suitable for simple use cases as
         * for learning.
         *
         * See http://datatables.net/usage/server-side for full details on the server-
         * side processing requirements of DataTables.
         *
         * @license MIT - http://datatables.net/license_mit
         */

        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

// DB table to use
        $table = 'main_employees';

// Table's primary key
        $primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
        $columns = array(
            array('db' => 'first_name', 'dt' => 0),
            array('db' => 'middle_name', 'dt' => 1),
            array('db' => 'last_name', 'dt' => 2),
            array('db' => 'first_address', 'dt' => 3),
            /* array(
                'db' => 'start_date',
                'dt' => 4,
                'formatter' => function( $d, $row ) {
                    return date('jS M y', strtotime($d));
                }
            ),
            array(
                'db' => 'salary',
                'dt' => 5,
                'formatter' => function( $d, $row ) {
                    return '$' . number_format($d);
                }
            ) */
        );

// SQL server connection information
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );


        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        //require( 'ssp.class.php' );
        $this->load->library('Ssp');

        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
        exit;
    }

}
