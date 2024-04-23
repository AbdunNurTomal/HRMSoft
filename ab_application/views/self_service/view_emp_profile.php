<?php
    $showSSNButton = false;
    if ($this->KurunthamModel->checkShowSSNAccess()) {
        $showSSNButton = true;
    }
?>

        <div class="col-md-10 main-content-div">
            <div class="main-content">
                <div class="container conbre">
                    <ol class="breadcrumb">
                        <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                        <li class="active"><?php echo $page_header; ?></li>
                    </ol>
                </div>
                <?php //echo $menu_id;?>
                <div class="container tag-box tag-box-v3 content-div">
                    <!-- data table -->
                    <div class="table-responsive col-md-12 col-centered no-border">
                        <table id="dataTables-example" class="table table-striped table-hover responsive-table table-wrap" width="100%">
                            <colgroup>
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th>Employee</th>
                                    <th>Position Info</th>
                                    <th>Contact Info</th>
                                    <?php if ($showSSNButton): ?>
                                        <th>Actions</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.emp_user_id='" . $this->user_id . "'  ORDER BY main_employees.employee_id DESC ";
                                /* if ($this->user_group == 10) { //self
                                    $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.emp_user_id='" . $this->user_id . "'  ORDER BY main_employees.employee_id DESC ";//and main_employees.employee_id='" . $this->user_id . "'
                                } else if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {//com //hr manager
                                    $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='" . $this->company_id . "' ORDER BY main_employees.employee_id DESC ";
                                } else {
                                    $sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                                }*/
                                $query = $this->db->query($sql); 

                                //echo $this->db->last_query();

                                if ($query) {
                                    foreach ($query->result() as $row) {
                                        /* if ($row->image_location == "") {
                                           $img_location = base_url() . "uploads/blank.png";
                                        } else {
                                           $img_location = $row->image_location;
                                        } */

                                        if ($row->image_name == "") {
                                            $img_location = base_url() . "uploads/blank.png";
                                        } else {
                                            $img_location = base_url() . "uploads/emp_image/". $row->image_name;
                                        }
                                        ?>
                                        <tr>
                                            <td style="width: 19%; cursor: pointer;" onclick="view_row('<?php echo $row->employee_id; ?>');" style="cursor: pointer;">
                                                <!--<img alt="No Image" src="<?php // echo $img_location; ?>" height="100" width="95">-->
                                                <div class="testimonial-info">
                                                    <img class="rounded-x" src="<?php echo $img_location; ?>" alt="No Image" height="100" width="95">
                                                </div>
                                            </td>
                                            <td style="width: 23%; cursor: pointer;" onclick="view_row('<?php echo $row->employee_id; ?>');">
                                                <div class="container" style="text-align: left; margin-left: 20px;">
                                                    <div class="row"><b><?php echo $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name').", ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');?></b></div>  <!--echo ucwords($row->salutation) . " " . ucwords($row->first_name) . " " . ucwords($row->middle_name)-->
                                                    <div class="row"><?php echo ucwords($row->first_address) ?></div>
                                                    <div class="row"><?php echo ucwords($row->second_address) ?></div>
                                                    <div class="row"><?php echo $row->city . " , " . $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr') . "  " . $row->zipcode ?></div>
                                                    <div class="row"><?php echo $this->Common_model->get_name($this, $row->county, 'main_county', 'county_name') ?></div>
                                                    <?php $ssn_code = $this->Common_model->decrypt($row->ssn_code);?>
                                                    <div class="row">SSN : <?php echo "XXX-XX-". substr($ssn_code, -4); ?></div>
                                                </div>
                                            </td>
                                            <td style="width: 23%; cursor: pointer;" onclick="view_row('<?php echo $row->employee_id; ?>');" >
                                                <div class="container" style="text-align: left; margin-left: 20px;">
                                                    <div class="row">Emp# : <?php echo sprintf("%07d", $row->employee_id) . " - <span class='activ' style=' color: #72c02c;'>" . $status_array[$row->isactive] . "</span>" ?></div>
                                                    <div class="row">Location : <?php echo $this->Common_model->get_name($this, $row->location, 'main_location','location_name') ?></div>
                                                    <div class="row">Hire Date : <?php echo $this->Common_model->show_date_formate($row->hire_date); ?></div>
                                                    <div class="row">Department : <?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></div>
                                                    <div class="row">Position : <?php echo $this->Common_model->get_name($this, $row->position, 'main_positions', 'positionname') ?></div>
                                                </div>
                                            </td>
                                            <td style="width: 23%; cursor: pointer;" onclick="view_row('<?php echo $row->employee_id; ?>');">
                                                <div class="container" style="text-align: left; margin-left: 20px;">
                                                    <div class="row">Home : <?php echo $row->home_phone ?></div>
                                                    <div class="row">Work : <?php echo $row->work_phone ?></div>
                                                    <div class="row">Cell : <?php echo $row->mobile_phone ?></div>
                                                    <div class="row">Email : <?php echo $row->email ?></div>
                                                </div>
                                            </td>
                                            <?php if ($showSSNButton): ?>
                                                <td>
                                                    <div class="container text-center">
                                                        <div class="row"> 
                                                            <button data-id="<?php echo $row->id; ?>" type="button" class="btn btn-u showSSNCode">Show SSN</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                            <!--<td>
                                                <a href="<?php //echo base_url() . "con_Employees/edit_entry/" . $row->employee_id . ""  ?>" ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>
                                                <a href="#" onclick="delete_data(<?php //echo $row->id  ?>)"><i class='fa fa-trash-o'></i></a>
                                            </td>-->
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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

<script type="text/javascript">

    function delete_data(id) {
        var r=confirm("Do you want to delete this?")
        if (r==true)
            window.location = base_url+"con_Employees/delete_entry/"+id;
        else
            return false;
    }

    function view_row(emp_id) {
        window.location = base_url + "Con_Employee_Profile/view_employee/" + emp_id;
        // window.open(base_url + "Con_Employee_Profile/view_employee/" + emp_id);
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

    /* $(function () {
       var aaa=$('#xyz').find("a").attr('href');
       //alert (aaa);
       var bbb=5;
       var ccc=aaa+bbb;

       //window.location = aaa;
       $('#xyz').find("a").attr('href', ccc);
        alert (ccc);
    }); */

</script>
<!--=== End Content ===-->
