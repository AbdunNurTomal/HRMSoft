
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'Con_HrmDashbord' ?>">HRM</a></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3">
            <form class="form-horizontal" action="<?php echo site_url('Con_Rpt_Employee_Details/get_employee_search_result'); ?>" method="post">
                <div class="table-responsive col-md-12 col-centered">
                    <?php echo $this->Common_model->generate_search_fields(); ?>
                </div>
                <div class="col-md-12 more-option-wrp hidden" style="margin:20px 0">
                    <div class="form-group">
                        <label class="control-label col-sm-1">Column(s):</label>
                        <div class="col-sm-11 padding-top-7">
                            <div class="col-xs-4">
                                <input type="checkbox" name="all_options" id="all_options" checked/>&nbsp; <b><i>SELECT ALL</i></b><br/>
                                <input type="checkbox" name="emp_num" id="emp_num" class="search_column" checked/>&nbsp; Employee No.<br/>
                                <input type="checkbox" name="emp_name" id="emp_name" class="search_column" checked/>&nbsp; Employee Name<br/>
                                <input type="checkbox" name="address" id="address" class="search_column" checked/>&nbsp; Address<br/>
                                <input type="checkbox" name="state_city" id="state_city" class="search_column" checked/>&nbsp; State and City<br/>
                            </div>
                            <div class="col-xs-4">
                                <input type="checkbox" name="county" id="county" class="search_column" checked/>&nbsp; County<br/>
                                <input type="checkbox" name="ssn" id="ssn" class="search_column" checked/>&nbsp; SSN(Social Security Number)<br/>
                                <input type="checkbox" name="location" id="location" class="search_column" checked/>&nbsp; Location<br/>
                                <input type="checkbox" name="hire_date" id="hire_date" class="search_column" checked/>&nbsp; Hire Date<br/>
                                <input type="checkbox" name="department" id="department" class="search_column" checked/>&nbsp; Department<br/> 
                            </div>                            
                            <div class="col-xs-3">                               
                                <input type="checkbox" name="position" id="position" class="search_column" checked/>&nbsp; Position<br/>
                                <input type="checkbox" name="home_phone" id="home_phone" class="search_column" checked/>&nbsp; Home phone<br/>
                                <input type="checkbox" name="work_phone" id="work_phone" class="search_column" checked/>&nbsp; Work Phone<br/>
                                <input type="checkbox" name="cell_num" id="cell_num" class="search_column" checked/>&nbsp; Cell<br/>
                                <input type="checkbox" name="email" id="email" class="search_column" checked/>&nbsp; Email<br/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 right-align" style="margin-bottom:20px">
                    <button class="btn btn-sm btn-info"><i class="fa fa-search"></i> Search</button>
                </div>

            </form>
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
                                    <td style="width:19%;">
                                        <div class="testimonial-info">
                                            <img class="rounded-x" src="<?php echo $img_location; ?>" alt="No Image" height="100" width="95">
                                        </div>
                                    </td>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row"><b><?php echo ucwords($row->salutation) . " -- " . ucwords($row->first_name) . " " . ucwords($row->middle_name) ?></b></div>
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
                                    <td>
                                        <a class="btn btn-info btn-xs" title="Download PDF Form" href="<?php echo base_url() . "Con_Employees/download_employee_form/" . $row->employee_id; ?>" ><i class='fa fa-download'></i> Employee Info.</a>
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
    .btn-info{background:#72c02c !important}
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $('.more_search_btn').on('click', function () {
            if ($(this).children('i').hasClass('fa-plus-square')) {
                $('.more-option-wrp').removeClass('hidden');
                $(this).children('i').removeClass('fa-plus-square');
                $(this).children('i').addClass('fa-minus-square');
            } else {
                $('.more-option-wrp').addClass('hidden');
                $(this).children('i').removeClass('fa-minus-square');
                $(this).children('i').addClass('fa-plus-square');
                $('.search_column, #all_options').prop('checked', false);
            }
        });

        $('#all_options').on('click', function () {
            if ($(this).is(":checked")) {
                $('.search_column').prop('checked', true);
            } else {
                $('.search_column').prop('checked', false);
            }
        });


        $('.search_column').on('click', function () {
            if (!$(this).is(":checked")) {
                $('#all_options').prop('checked', false);
            }
        });
    });
</script>
