
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <table id="dataTables-example" class="table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Employee</th>
                            <th>Position Info</th>
                            <th>Contact Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $status_array = $this->Common_model->get_array('status');
                        $marital_status_array = $this->Common_model->get_array('marital_status');
                        if ($this->user_group == 10) {//self
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.emp_user_id='" . $this->user_id . "' ORDER BY main_employees.employee_id DESC ";
                        } else if ($this->user_group == 11 || $this->user_group == 12) {//com //hr manager
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='" . $this->company_id . "' ORDER BY main_employees.employee_id DESC ";
                        } else {
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        }
                        $query = $this->db->query($sql);

                        if ($query) {
                            foreach ($query->result() as $row) {

                                if ($row->image_name == "") {
                                    $img_location = "http://" . $_SERVER['HTTP_HOST'] . "/hrm/uploads/blank.png";
                                } else {
                                    $img_location = "http://" . $_SERVER['HTTP_HOST'] . "/hrm/uploads/emp_image/" . $row->image_name;
                                }
                                ?>
                                <tr>
                                    <td style="width: 19%;">
                                        <div class="testimonial-info">
                                            <img class="rounded-x" src="<?php echo $img_location; ?>" alt="No Image" height="100" width="95">
                                        </div>
                                    </td>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row"><b><?php echo ucwords($row->salutation) . " " . ucwords($row->first_name) . " " . ucwords($row->middle_name) ?></b></div>
                                            <div class="row"><?php echo ucwords($row->first_address) ?></div>
                                            <div class="row"><?php echo ucwords($row->second_address) ?></div>
                                            <div class="row"><?php echo $row->city . " , " . $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . "  " . $row->zipcode ?></div>
                                            <div class="row"><?php echo $this->Common_model->get_name($this, $row->county, 'main_county', 'county_name') ?></div>
                                            <div class="row">SSN : <?php echo $number = "XXX-XX-" . substr($row->ssn_code, -4); ?></div>
                                        </div>
                                    </td>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Emp# : <?php echo sprintf("%07d", $row->employee_id) . " - <span class='activ' style='color:" . (($row->isactive == 1) ? '#72c02c' : 'red') . ";'>" . $status_array[$row->isactive] . "</span>" ?></div>
                                            <div class="row">Location : <?php echo $this->Common_model->get_name($this, $row->location, 'main_location', 'location_name') ?></div>
                                            <div class="row">Hire Date : <?php echo $this->Common_model->show_date_formate($row->hire_date); ?></div>
                                            <div class="row">Department : <?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></div>
                                            <div class="row">Position : <?php echo $this->Common_model->get_name($this, $row->position, 'main_positions', 'positionname') ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Home : <?php echo $row->home_phone ?></div>
                                            <div class="row">Work : <?php echo $row->work_phone ?></div>
                                            <div class="row">Cell : <?php echo $row->mobile_phone ?></div>
                                            <div class="row">Email : <?php echo $row->email ?></div>
                                        </div>
                                    </td>
                                    <td class="Rpt-Wrap">
                                        <?php
                                        $query = $this->db->get_where('main_emp_actions', array('employee_id' => $row->employee_id, 'isactive' => 1));

                                        if ($query && ($query->num_rows() > 0)) {

                                            foreach ($query->result() as $key => $VAL) {
                                                $pdt = $VAL->id;

                                                $download_link = base_url() . 'con_Employees/';
                                                $accident_inv_report = '';

                                                if ($VAL->action_type == 1) {
                                                    $action_type = "Incident";
                                                    $action_title = "Incident Report";
                                                    $download_link .= 'incident_pdf/' . $pdt;
                                                } else if ($VAL->action_type == 2) {
                                                    $action_type = "Accident";
                                                    $action_title = "Accident Report";
                                                    $download_link .= 'accident_pdf/' . $pdt;
                                                    $accident_inv_report = "<a class='btn btn-xs btn-info' href='" . base_url() . 'con_Employees/accident_inv_pdf/' . $pdt . "'><i class='fa fa-lg fa-download'></i> Accident Investigation Report</a>&nbsp;&nbsp;";
                                                } else {
                                                    $action_type = $action_title = "";
                                                    $download_link .= '#';
                                                }
                                                print "<a class='btn btn-xs btn-info' href='" . $download_link . "'><i class='fa fa-lg fa-download'></i> ".$action_title."</a>&nbsp;&nbsp;" . $accident_inv_report;
                                            }
                                        }
                                        ?>                                    
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<style type="text/css">
    .Rpt-Wrap{white-space:normal !important}
    .btn-info{background:#72c02c !important}
</style>