<?php

Class Hr_module extends CI_Model
{
      function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
    
    
    public function left_menu($moduleid) {
        //$main_menu_query = $this->Common_model->listItem('main_menu');
        $condition = array('module_id' => 4);
        $main_menu_query = $this->Common_model->get_selected_row('main_menu', $condition);
        
        $root=array();
        $chaild=array();
        foreach ($main_menu_query->result() as $key=>$val){
            //$hr_leftmenu[$key->id]=$key->menu_name;
            if($val->root_menu==0)
            {
                $root[$val->id]=$val->menu_name;
            }
            else{
                $chaild[$val->root_menu][$val->id]=$val->menu_name;
            }
        }
        //print_r($root);
        
        $hr_leftmenu=array();
        foreach ($root as $parent_id=>$parent) {
            if(isset($chaild[$parent_id])){
                $hr_leftmenu[$parent_id][$parent]=$chaild[$parent_id]; 
            }
            else {
                $hr_leftmenu[$parent_id]=$parent;
            }
        }
        
       // print_r($hr_leftmenu);
        
//       $hr_leftmenu = Array(
//            'Employees' => "Employees",
//            'User Management' => Array("menu_list" => "Menu List","user_group" => "User Group", "roles_privileges" => "Roles Privileges", "manage_external_users" => "Manage External Users"),
//            'Holiday Management' => Array("manage_holiday_group" => "Manage Holiday Group", "manage_holidays" => "Manage Holidays"),
//            'Leave Management' => Array("leave_management_options" => "Leave Management Options", "employee_leaves_summary" => "Employee Leaves Summary", "add_employee_leaves" => "Add Employee Leaves"),
//            'Employee Configuration' => Array("employee_tabs" => "Employee Tabs", "employment_status" => "Employment Status", "pay_frequency" => "Pay Frequency", "job_titles" => "Job Titles", "positions" => "Positions", "languages" => "Languages", "leave_types" => "Leave Types", "attendance_status" => "Attendance Status", "bank_account_types" => "Bank Account Types")
//        );
 
        return $hr_leftmenu;
    }

}
?>
