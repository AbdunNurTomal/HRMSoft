
<?php
    $showSSNButton = false;
    if ($this->KurunthamModel->checkShowSSNAccess()) {
        $showSSNButton = true;
    }
?>

<script>
	var note_size	= <?php echo $note_size; ?>;
</script>

<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <?php //echo $menu_id;?>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <?php if ($this->user_type != 1) { ?>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employees/add_employees" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Employee</a>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employees/get_search_employee/"."1"; ?>"><i class="fa fa-search" aria-hidden="true"></i> Active </a>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employees/get_search_employee/"."0"; ?>"><i class="fa fa-search" aria-hidden="true"></i> Inactive </a>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employees/get_search_employee/"."2"; ?>"><i class="fa fa-search" aria-hidden="true"></i> All Employee</a></br></br>
                <?php } ?>
                <?php if ($show_result) { ?>
                <table id="dataTables-example" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl responsive-table table-wrap" >
                    <colgroup>
                        <col width="5%">
                        <col width="25%">
                        <col width="30%">
                        <col width="30%">
                        <col width="10%">
                    </colgroup> 
                    <thead>
                        <tr>
                            <th> </th>
                            <th>Employee</th>
                            <th>Position Info</th>
                            <th>Contact Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                         <?php

//                        $nn=0;
//                        $tables = $this->db->query("SELECT t.TABLE_NAME AS myTables FROM INFORMATION_SCHEMA.TABLES AS t WHERE t.TABLE_SCHEMA = 'us_hrm' ")->result_array();
//                        foreach ($tables as $key => $val) {
//                            $nn++;
//                            echo $val['myTables'] . "<br>"; // myTables is the alias used in query.
//                        }
//                        echo $nn;
//                        
                        $Xtra = "";
                        if ($search_ids != "") {
                            if ($search_ids == 2) {
                                $Xtra = "";
                            } else {
                                $Xtra = " and main_employees.isactive=$search_ids";
                            }
                        } else {
                            $Xtra = " and main_employees.isactive=1";
                        }

                        //echo $Xtra;

                        if ($this->user_group == 10) {//self
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.emp_user_id='" . $this->user_id . "' {$Xtra} Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        } else if ($this->user_group == 11) {//Hr Manager 
                            $rpt_men_emp_id = $this->Common_model->get_selected_value($this, 'emp_user_id', $this->user_id, 'main_employees', 'employee_id');
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='" . $this->company_id . "' and main_emp_workrelated.reporting_manager='" . $rpt_men_emp_id . "'  {$Xtra} Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        } else if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='" . $this->company_id . "' {$Xtra}  Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
                            $companyIdFromSession = $this->session->userdata('hr_logged_in') ? $this->session->userdata('hr_logged_in')["company_id"] : 0;
                            //$sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.createdby IN (" . get_sub_users($this->user_id) . ") Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                            /* $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, 
                                    main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,
                                    main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, 
                                    main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,
                                    main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, 
                                    main_emp_workrelated.department FROM main_employees 
                                    LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id 
                                    WHERE main_employees.company_id='0' and  main_employees.createdby IN (" . get_sub_users($this->user_id) . ") {$Xtra} 
                                    Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC "; */
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, 
                                    main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,
                                    main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, 
                                    main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,
                                    main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, 
                                    main_emp_workrelated.department FROM main_employees 
                                    LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id 
                                    WHERE main_employees.company_id >= 0 {$Xtra} 
                                    Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                            if ($companyIdFromSession) {
                                $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, 
                                    main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,
                                    main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, 
                                    main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,
                                    main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, 
                                    main_emp_workrelated.department FROM main_employees 
                                    LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id 
                                    WHERE main_employees.company_id='{$companyIdFromSession}' {$Xtra} 
                                    Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                            }
                        } else {
                            $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id  WHERE main_employees.emp_user_id='" . $this->user_id . "' {$Xtra} Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        }

                        // echo "<pre>".print_r($this->session->userdata('hr_logged_in'),1)."</pre>";exit;

                        $query = $this->db->query($sql);

                        //echo $this->db->last_query();

                        if ($query) {
                            foreach ($query->result() as $row) {

                               
                                if ($row->image_name == "") {
                                    $img_location = base_url() . "uploads/blank.png";
                                } else {
                                    $img_location = base_url() . "uploads/emp_image/" . $row->image_name;
                                }
                                
                                ?>
                                <tr>
                                    <td onclick="edit_row('<?php echo $row->employee_id; ?>');" style="cursor: pointer !important;">
                                        <!--<img alt="No Image" src="<?php // echo $img_location;                  ?>" height="100" width="95">-->
                                        <div class="testimonial-info">
                                            <img class="rounded-x" src="<?php echo $img_location; ?>" alt="No Image" height="100" width="95">
                                        </div>
                                    </td>
                                    <td onclick="edit_row('<?php echo $row->employee_id; ?>');" style="cursor: pointer !important;" >
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                           <?php $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name').", ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');?>
                                            <div class="row"><b><?php echo $employee_name ?></b></div> <?php //echo $this->Common_model->employee_name($row->employee_id); ?>
                                            <div class="row"><b>Position : </b> <?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title'); ?></div>
                                            <div class="row"><?php echo ucwords($row->first_address) ." ".ucwords($row->second_address) ?></div>
                                            <!--<div class="row"><?php // echo $row->city . " , " . $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . "  " . $row->zipcode ?></div>-->
                                            <!--<div class="row"><?php // echo $this->Common_model->get_name($this, $row->county, 'main_county', 'county_name') ?></div>-->
                                            <div class="row">SSN : <?php echo $number = "XXX-XX-" . substr($this->Common_model->decrypt($row->ssn_code), -4); ?></div>
                                        </div>
                                    </td>
                                    <td onclick="edit_row('<?php echo $row->employee_id; ?>');" style="cursor: pointer !important;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Emp# : <?php echo sprintf("%07d", $row->employee_id) . " - <span class='activ' style='color:" . (($row->isactive == 1) ? '#72c02c' : 'red') . ";'>" . $status_array[$row->isactive] . "</span>" ?></div>
                                            <div class="row">Location : <?php echo $this->Common_model->get_name($this, $row->location, 'main_location', 'location_name') ?></div>
                                            <div class="row">Hire Date : <?php echo $this->Common_model->show_date_formate($row->hire_date); ?></div>
                                            <div class="row">Department : <?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></div>
                                            <!--<div class="row">Position : <?php // echo $this->Common_model->get_name($this, $row->position, 'main_positions', 'positionname') ?></div>-->
                                        </div>
                                    </td>
                                    <td onclick="edit_row('<?php echo $row->employee_id; ?>');" style="cursor: pointer !important;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Home : <?php echo $row->home_phone ?></div>
                                            <div class="row">Work : <?php echo $row->work_phone ?></div>
                                            <div class="row">Cell : <?php echo $row->mobile_phone ?></div>
                                            <div class="row">Email : <?php echo $row->email ?></div>
                                        </div>
                                    </td>

                                    <td>
                                        <!-- <a title="Download PDF Form" href="<?php //echo base_url() . "Con_Employees/download_employee_form/" . $row->employee_id; ?>" ><i class='fa fa-lg fa-download'></i>Employee Info.</a> -->
                                        <a class="btn btn-info btn-xs" title="Download PDF Form" href="<?php echo base_url() . "Con_Employees/download_employee_form/" . $row->employee_id; ?>" ><i class='fa fa-download'></i> Employee Info.</a>
                                        <!--<a href="#" onclick="delete_data(<?php /* echo $row->id */ ?>)"><i class='fa fa-trash-o'></i></a>-->
                                        <?php if ($showSSNButton): ?>
                                            <div class="container text-center">
                                                <div class="row"> 
                                                    <button data-id="<?php echo $row->id; ?>" type="button" class="btn btn-u showSSNCode" style="top:8px;">Show SSN</button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                    <?php } ?>
            </div>
            <!-- end data table -->
        </div>
        <!-- show SSN Code modal starts -->
                <div class="modal fade" id="ssn_code_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">SSN Code</h4>
                            </div>
                            <form id="show_ssn_code_form" name="sky-form111" <?php echo $row->employee_id; ?> class="form-horizontal" action="" method="post" role="form">
                                <div class="modal-body">
                                    <div id="show_ssn_code_form_div">
                                        <div class="form-group">
                                        <div class="col-sm-6">
                                                <input id="showSSNCodeEmployeeId" type="hidden" name="employee_id" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"> Password <span class="req"></label>
                                            <div class="col-sm-7">
                                                <input id="txt-show-ssn-code-password" type="password" name="user_password" class="form-control input-sm" placeholder="User Password" />
                                                <div id="show-ssn-code-form-password-error" class="required"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="ssn-code-div" style="display: none;">
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label">Employee Code:</label>
                                            <div class="col-sm-6 show-ssn-code-result-div">
                                                <label id="employeeCodeLabel"></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label">Employee Name:</label>
                                            <div class="col-sm-6 show-ssn-code-result-div">
                                                <label id="employeeNameLabel"></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label">SSN Code:</label>
                                            <div class="col-sm-6 show-ssn-code-result-div">
                                                <label id="ssnCodeLabel" class="label label-success show-ssn-code-label"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button id="btnShowSSNCode" type="button" class="btn btn-u">Show</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Close </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- show SSN Code modal ends -->

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<style type="text/css">
    .btn-info{background:#72c02c !important}
    .scroll-wrap{overflow-x:scroll !important}
    .no-wrap{
        min-width:300px;
        white-space:normal !important;
    }
    /*#dataTables-example td{white-space:normal !important}*/
</style>

<script type="text/javascript">

    var url = "<?php echo base_url(); ?>";
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "Con_Employees/delete_entry/" + id;
        else
            return false;
    }

    function edit_row(emp_id)
    {
        window.location = url + "Con_Employees/edit_entry/" + emp_id;
    }


    $(document).on("click", ".showSSNCode", function() {
        $("#ssn-code-div").hide();
        $("#btnShowSSNCode").show();
        $("#show_ssn_code_form_div").show();
        $("#show-ssn-code-form-password-error").html("").hide();
        $("#txt-show-ssn-code-password").removeClass("txt-error-border-color");

        $('#show_ssn_code_form')[0].reset(); // reset form on modals

        var employeeId = $(this).data('id');
        $("#showSSNCodeEmployeeId").val(employeeId);
        $('.modal-title').text('SSN Code');

        $('#ssn_code_modal').modal('show'); // show bootstrap modal
    });

    $(document).on("click", "#btnShowSSNCode", function() {
        $("#ssn-code-div").hide();
        $("#show_ssn_code_form_div").show();
        $("#show-ssn-code-form-password-error").html("").hide();
        $("#txt-show-ssn-code-password").removeClass("txt-error-border-color");

        if (!$.trim($("#txt-show-ssn-code-password").val())) {
            $("#txt-show-ssn-code-password").addClass("txt-error-border-color");
            $("#show-ssn-code-form-password-error").html("Password cannot be blank").show();
            return;
        }

        $.ajax({
            url: "<?php echo site_url('Con_Employee_Profile/get_ssn_code') ?>",
            data: $('#show_ssn_code_form').serialize(),
            type: "POST",
            dataType: "JSON",
        }).done(function(data) {
            if (data.success) {
                $("#show_ssn_code_form_div").hide();
                $("#btnShowSSNCode").hide();

                $("#employeeCodeLabel").html(data.employee_code);
                $("#employeeNameLabel").html(data.first_name);
                $("#ssnCodeLabel").html(data.ssn_code);
                $("#ssn-code-div").show();
            } else {
                $("#txt-show-ssn-code-password").addClass("txt-error-border-color");
                $("#show-ssn-code-form-password-error").html(data.msg).show();
            }
        });
        event.preventDefault();
    });
</script>
<!--=== End Content ===-->
