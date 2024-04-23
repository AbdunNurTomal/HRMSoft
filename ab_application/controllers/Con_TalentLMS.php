<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Con_TalentLMS extends CI_Controller
{
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
    public $companyView = false;

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

        $this->companyView = $this->user_data['company_view'];
    }

    public function index()
    {
        $this->menu_id = $this->uri->segment(3);
        $this->Common_model->is_user_valid($this->user_id, $this->menu_id, $this->user_menu);

        $param['menu_id'] = $this->menu_id;
        $param['page_header'] = "Talent LMS";
        $param['module_id'] = $this->module_id;

        $param['left_menu'] = 'sadmin/hrm_leftmenu.php';
        $param['content'] = 'training/view_talent_lms.php';
        $this->load->view('admin/home', $param);
    }

    public function showEmployees()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $order = $this->input->get("order");
        $search = $this->input->get("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";

        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $valid_columns = array(
            0 => 'main_employees.employee_id',
            2 => 'main_employees.first_name',
            3 => 'main_employees.last_name',
            4 => 'main_employees.city'
        );

        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        if ($order != null) {
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }

        $this->db->limit($length, $start);
        $this->db->select('main_employees.id as employee_id, main_employees.first_name, main_employees.last_name, main_emp_workrelated.department, main_employees.mobile_phone');
        $this->db->from('main_employees');

        $this->db->join('main_emp_workrelated', 'main_employees.id = main_emp_workrelated.employee_id', 'left');
        $this->db->where('main_employees.contact_via_text', 1);
        $this->db->where('main_employees.isactive', 1);

        if ($this->user_group == 1 && $this->user_data["company_view"] == 0) { } else {
            $this->db->where('main_employees.company_id', $this->company_id);
        }
        $employees = $this->db->get()->result();
        // echo "<pre>". print_r($employees) ."</pre>";exit;

        $data = array();
        foreach ($employees as $row) {
            $data[] = array(
                $row->employee_id,
                $row->first_name,
                $row->last_name,
                $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name'),
                $row->mobile_phone,
                // '<a href="#" class="btn btn-warning mr-1">Edit</a>
                //  <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );
        }

        $total_employees = $this->totalEmployees();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function totalEmployees()
    {
        $departmentId = $this->input->get("department_id");

        $this->db->select("COUNT(*) as num");
        $this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
        $this->db->where('main_employees.contact_via_text', 1);
        if ($this->user_group == 1 && $this->user_data["company_view"] == 0) { } else {
            $this->db->where('main_employees.company_id', $this->company_id);
        }
        $this->db->where('main_emp_workrelated.department', $departmentId);

        $query = $this->db->get("main_employees");
        $result = $query->row();

        if (isset($result)) return $result->num;

        return 0;
    }

    public function showEmployeesByDepartment()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $order = $this->input->get("order");
        $search = $this->input->get("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";

        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'main_employees.employee_id',
            2=>'main_employees.first_name',
            3=>'main_employees.last_name',
            4=>'main_employees.city'
        );

        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        if ($order !=null) {
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm,$search);
                } else {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }
        }

        $departmentId = $this->input->get("department_id");

        $employees = array();
        if ($departmentId) {
            $this->db->limit($length,$start);
            $this->db->select('main_employees.id as employee_id, main_employees.first_name, main_employees.last_name, main_emp_workrelated.department, main_employees.mobile_phone');
            $this->db->from('main_employees');
            $this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id', 'left');
    
            if ($this->user_group == 1 && $this->user_data["company_view"] == 0) {
            } else {
                $this->db->where('main_employees.company_id', $this->company_id);
            }
            $this->db->where('main_emp_workrelated.department', $departmentId);
            $this->db->where('main_employees.contact_via_text', 1);
            $this->db->where('main_employees.isactive', 1);

            $employees = $this->db->get()->result();
        }

        $data = array();
        foreach ($employees as $row) {
            $data[] = array(
                $row->employee_id,
                $row->first_name,
                $row->last_name,
                $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name'),
                $row->mobile_phone,
                // '<a href="#" class="btn btn-warning mr-1">Edit</a>
                //  <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );
        }

        $total_employees = $this->totalEmployeesByDepartment();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function totalEmployeesByDepartment()
    {
        $departmentId = $this->input->get("department_id");

        $this->db->select("COUNT(*) as num");
        $this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
        $this->db->where('main_employees.contact_via_text', 1);
        if ($this->user_group == 1 && $this->user_data["company_view"] == 0) {
        } else {
            $this->db->where('main_employees.company_id', $this->company_id);
        }
        $this->db->where('main_emp_workrelated.department', $departmentId);

        $query = $this->db->get("main_employees");
        $result = $query->row();

        if(isset($result)) return $result->num;

        return 0;
    }

    public function sendSMS()
    {
        $response = array();
        $response["status"] = false;
        $response["msg"] = "Unable to send SMS";
        if (!empty($_POST["employee_id"]) && !empty($_POST["message"])) {
            $employeeId = $_POST["employee_id"];
            $message = $_POST["message"];
            $selectedOption = $_POST["selectedOption"];

            $loggedInUserName = "";
            if ($this->user_data) {
                $loggedInUserName = $this->user_data ? $this->user_data["name"] : "";
                if ($loggedInUserName) {
                    $message .= " - " . $loggedInUserName;
                }
            }

            $employeeIDs = array();
            if ($employeeId) {
                $employeeIDs = explode(",", $employeeId);
            }
            // echo "<pre>".print_r($employeeIDs,1)."</pre>";exit;

            $employees = array();
            $this->db->select('*');
            $this->db->from('main_employees');
            $this->db->where_in('id', $employeeIDs);
            $query = $this->db->get();
            $employees = $query->result();

            $employeesToSendMsg = array();
            foreach($employees as $employee) {
                    $employeesToSendMsg[] = array(
                                            "employee_id" => $employee->id,
                                            "company_id" => $employee->company_id,
                                            "phone_number" => $employee->mobile_phone,
                                            "message" => $message
                                        );
            }
            // echo "<pre>".print_r($employeesToSendMsg,1)."</pre>";exit;

            $result = $this->KurunthamModel->sendSMS($employeesToSendMsg);

            $response["successMsg"] = "";
            if ($result["msgSentArr"]) {
                $response["successMsg"] = "Text message successfully sent";
                $i = 1;
                foreach($result["msgSentArr"] as $phoneNo) {
                    if ($i == 1) {
                        $response["successMsg"] .= " to " . $phoneNo;
                    } else {
                        $response["successMsg"] .= ", ". $phoneNo;
                    }
                    $i++;
                }
            }

            $response["errorMsg"] = "";
            if ($result["msgNotSentArr"]) {
                $response["errorMsg"] = "Text message not sent";
                $i = 1;
                foreach($result["msgNotSentArr"] as $phoneNo) {
                    if ($i == 1) {
                        $response["errorMsg"] .= " to " . $phoneNo;
                    } else {
                        $response["errorMsg"] .= ", ". $phoneNo;
                    }
                    $i++;
                }
            }
            // $response["errorMsg"] = "Text message successfully sent to (661) 998-6472, (661) 644-9425, (818) 288-7412, (818) 618-7187, (661) 817-3234, (310) 261-3187";

            if ($result["status"]) {
                $response["status"] = true;
                // $response["msg"] = "SMS successfully sent";
            }
        } else {
            $response["errorMsg"] = "Employee(s) not selected (OR) message is not provided";
        }
        echo json_encode($response);
    }

    public function showEmployeesByGroup()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $order = $this->input->get("order");
        $search = $this->input->get("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";

        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $valid_columns = array(
            0=>'main_employees.id',
            2=>'main_employees.first_name',
            3=>'main_employees.last_name',
            4=>'main_employees.mobile_phone'
        );

        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        if ($order !=null) {
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm,$search);
                } else {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }
        }

        $usergroupId = $this->input->get("usergroup_id");

        $employees = array();
        if ($usergroupId) {
            $this->db->limit($length,$start);
            $this->db->select('main_employees.id as employee_id, main_employees.first_name, main_employees.last_name, main_employees.mobile_phone');
            $this->db->from('main_employees');
            $this->db->join('main_users', 'main_users.id = main_employees.emp_user_id','left');

            if ($this->user_group == 1 && $this->user_data["company_view"] == 0) {
            } else {
                $this->db->where('main_users.company_id', $this->company_id);
            }
            $this->db->where('main_users.user_group', $usergroupId);
            $this->db->where('main_employees.isactive', 1);

            $employees = $this->db->get()->result();
        }
        $data = array();
        foreach ($employees as $row) {
            $this->db->select('main_emp_workrelated.department')->from('main_employees');
            $this->db->join('main_emp_workrelated', 'main_employees.employee_id = main_emp_workrelated.employee_id');
            $this->db->where('main_employees.contact_via_text', 1);
            $this->db->where('main_employees.id', $row->employee_id);
            $department = $this->db->get()->result();
            $departmentId = 0;
            if ($department) {
                $departmentId = $department[0]->department;
            }

            $data[] = array(
                $row->employee_id,
                $row->first_name,
                $row->last_name,
                $this->Common_model->get_name($this, $departmentId, 'main_department', 'department_name'),
                $row->mobile_phone,
                // '<a href="#" class="btn btn-warning mr-1">Edit</a>
                //  <a href="#" class="btn btn-danger mr-1">Delete</a>'
            );
        }

        $total_usergroup = $this->totalUsers();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_usergroup,
            "recordsFiltered" => $total_usergroup,
            "data" => $data
        );

        echo json_encode($output);
        exit();
    }

    public function totalUsers()
    {
        $this->db->select("COUNT(*) as num");
        $this->db->from('main_employees');
        $this->db->join('main_users', 'main_users.id = main_employees.emp_user_id','left');

        if ($this->user_group == 1 && $this->user_data["company_view"] == 0) {
        } else {
            $this->db->where('main_users.company_id', $this->company_id);
        }
        $this->db->where('main_employees.isactive', 1);

        $usergroupId = $this->input->get("usergroup_id");
        $this->db->where('main_users.user_group', $usergroupId);
        $query = $this->db->get();
        $result = $query->row();

        if(isset($result)) return $result->num;

        return 0;
    }

}
