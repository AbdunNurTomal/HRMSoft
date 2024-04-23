
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3">
            <form class="form-horizontal" action="<?php echo site_url('Con_Rpt_Employee_Details/get_employee_search_result'); ?>" method="post">                
                <!-----------Basic Search Field Controls------------>
                <input type="hidden" name="more_options" id="more_options" value="<?php echo (isset($view_columns['more_options'])) ? $view_columns['more_options'] : '0'; ?>"/>

                <input type="hidden" id="emp_status_radio" value="<?php echo $view_columns['emp_status']; ?>"/>
                <input type="hidden" id="state_select" value="<?php echo $view_columns['state_id']; ?>"/>
                <input type="hidden" id="county_select" value="<?php echo $view_columns['county_id']; ?>"/>
                <input type="hidden" id="position_select" value="<?php echo $view_columns['positions_id']; ?>"/>
                <input type="hidden" id="location_select" value="<?php echo $view_columns['location_id']; ?>"/>
                <input type="hidden" id="department_select" value="<?php echo $view_columns['department_id']; ?>"/>

                <div class="table-responsive col-md-12 col-centered">
                    <?php echo $this->Common_model->generate_search_fields(); ?>
                </div>
                <div class="col-md-12 more-option-wrp hidden" style="margin:20px 0">
                    <div class="form-group">
                        <label class="control-label col-sm-1">Column(s):</label>
                        <div class="col-sm-11 padding-top-7">
                            <div class="col-xs-4">
                                <input type="checkbox" name="all_options" id="all_options" <?php echo (isset($view_columns['all_options'])) ? 'checked' : ''; ?>/>&nbsp; <b><i>SELECT ALL</i></b><br/>
                                <input type="checkbox" name="emp_num" id="emp_num" class="search_column" <?php echo (isset($view_columns['emp_num'])) ? 'checked' : ''; ?>/>&nbsp; Employee No.<br/>
                                <input type="checkbox" name="emp_name" id="emp_name" class="search_column" <?php echo (isset($view_columns['emp_name'])) ? 'checked' : ''; ?>/>&nbsp; Employee Name<br/>
                                <input type="checkbox" name="address" id="address" class="search_column" <?php echo (isset($view_columns['address'])) ? 'checked' : ''; ?>/>&nbsp; Address<br/>
                                <input type="checkbox" name="state_city" id="state_city" class="search_column" <?php echo (isset($view_columns['state_city'])) ? 'checked' : ''; ?>/>&nbsp; State and City<br/>
                            </div>
                            <div class="col-xs-4">
                                <input type="checkbox" name="county" id="county" class="search_column" <?php echo (isset($view_columns['county'])) ? 'checked' : ''; ?>/>&nbsp; County<br/>
                                <input type="checkbox" name="ssn" id="ssn" class="search_column" <?php echo (isset($view_columns['ssn'])) ? 'checked' : ''; ?>/>&nbsp; SSN( Social Security Number )<br/>
                                <input type="checkbox" name="location" id="location" class="search_column" <?php echo (isset($view_columns['location'])) ? 'checked' : ''; ?>/>&nbsp; Location<br/>
                                <input type="checkbox" name="hire_date" id="hire_date" class="search_column" <?php echo (isset($view_columns['hire_date'])) ? 'checked' : ''; ?>/>&nbsp; Hire Date<br/>
                                <input type="checkbox" name="department" id="department" class="search_column" <?php echo (isset($view_columns['department'])) ? 'checked' : ''; ?>/>&nbsp; Department<br/> 
                            </div>                            
                            <div class="col-xs-3">                               
                                <input type="checkbox" name="position" id="position" class="search_column" <?php echo (isset($view_columns['position'])) ? 'checked' : ''; ?>/>&nbsp; Position<br/>
                                <input type="checkbox" name="home_phone" id="home_phone" class="search_column" <?php echo (isset($view_columns['home_phone'])) ? 'checked' : ''; ?>/>&nbsp; Home phone<br/>
                                <input type="checkbox" name="work_phone" id="work_phone" class="search_column" <?php echo (isset($view_columns['work_phone'])) ? 'checked' : ''; ?>/>&nbsp; Work Phone<br/>
                                <input type="checkbox" name="cell_num" id="cell_num" class="search_column" <?php echo (isset($view_columns['cell_num'])) ? 'checked' : ''; ?>/>&nbsp; Cell<br/>
                                <input type="checkbox" name="email" id="email" class="search_column" <?php echo (isset($view_columns['email'])) ? 'checked' : ''; ?>/>&nbsp; Email<br/>
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
                            <?php if (isset($view_columns['emp_num'])) { ?>
                                <th>Employee No.</th>
                            <?php }if (isset($view_columns['emp_name'])) { ?>
                                <th>Name</th>
                            <?php }if (isset($view_columns['address'])) { ?>
                                <th>Address</th>
                            <?php }if (isset($view_columns['state_city'])) { ?>
                                <th>City</th>
                                <th>State</th>
                            <?php }if (isset($view_columns['county'])) { ?>
                                <th>County</th>
                            <?php }if (isset($view_columns['ssn'])) { ?>
                                <th>SSN</th>
                            <?php }if (isset($view_columns['home_phone'])) { ?>
                                <th>Home Phone</th>
                            <?php }if (isset($view_columns['work_phone'])) { ?>
                                <th>Work Phone</th>
                            <?php }if (isset($view_columns['cell_num'])) { ?>
                                <th>Cell</th>
                            <?php }if (isset($view_columns['email'])) { ?>
                                <th>Email</th>
                            <?php }if (isset($view_columns['location'])) { ?>
                                <th>Location</th>
                            <?php }if (isset($view_columns['hire_date'])) { ?>
                                <th>Hire Date</th>
                            <?php }if (isset($view_columns['department'])) { ?>
                                <th>Department</th>
                            <?php }if (isset($view_columns['department'])) { ?>
                                <th>Position</th>                            
                            <?php } ?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $status_array = $this->Common_model->get_array('status');
                        //pr($query->result());

                        if ($query) {
                            foreach ($query->result() as $row) {

                                if ($row->image_name == "") {
                                    $img_location = base_url() . "uploads/blank.png";
                                } else {
                                    $img_location = base_url() . "uploads/emp_image/" . $row->image_name;
                                }
                                ?>
                                <tr>
                                    <td><img class="rounded-x" src="<?php echo $img_location; ?>" alt="Employee Image" height="60" width="60" /></td>

                                    <?php if (isset($view_columns['emp_num'])) { ?>
                                        <td><?php echo sprintf("%07d", $row->Emp_ID) . " - <span style='color:" . (($row->Emp_Active == 1) ? '#72c02c' : 'red') . ";'>" . $status_array[$row->Emp_Active] . "</span>" ?></td>
                                    <?php }if (isset($view_columns['emp_name'])) { ?>
                                        <td><?php echo $row->salutation . " " . $row->first_name . " " . $row->middle_name . " " . $row->last_name; ?></td>
                                    <?php }if (isset($view_columns['address'])) { ?>
                                        <td class="no-wrap"><?php echo implode('; ', array(ucwords($row->first_address), ucwords($row->second_address))); ?></td>
                                    <?php }if (isset($view_columns['state_city'])) { ?>
                                        <td><?php echo $row->city; ?></td>
                                        <td><?php echo $this->Common_model->get_name($this, $row->state, 'main_state', 'state_name'); ?></td>
                                    <?php }if (isset($view_columns['county'])) { ?>
                                        <td><?php echo $this->Common_model->get_name($this, $row->county, 'main_county', 'county_name') ?></td>
                                    <?php }if (isset($view_columns['ssn'])) { ?>
                                        <td><?php echo $number = "XXX-XX-" . substr($row->ssn_code, -4); ?></td>
                                    <?php }if (isset($view_columns['home_phone'])) { ?>
                                        <td><?php echo $row->home_phone ?></td>
                                    <?php }if (isset($view_columns['work_phone'])) { ?>
                                        <td><?php echo $row->work_phone ?></td>
                                    <?php }if (isset($view_columns['cell_num'])) { ?>
                                        <td><?php echo $row->mobile_phone ?></td>
                                    <?php }if (isset($view_columns['email'])) { ?>
                                        <td><?php echo $row->email ?></td>
                                    <?php }if (isset($view_columns['location'])) { ?>
                                        <td><?php echo $this->Common_model->get_name($this, $row->location, 'main_location', 'location_name') ?></td>
                                    <?php }if (isset($view_columns['hire_date'])) { ?>
                                        <td><?php echo $this->Common_model->show_date_formate($row->hire_date); ?></td>
                                    <?php }if (isset($view_columns['department'])) { ?>
                                        <td><?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name') ?></td>
                                    <?php }if (isset($view_columns['department'])) { ?>
                                        <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
                                    <?php } ?>
                                    <td><a class="btn btn-info btn-xs" title="Download PDF Form" href="<?php echo base_url() . "Con_Employees/download_employee_form/" . $row->employee_id; ?>" ><i class='fa fa-download'></i> Employee Info.</a></td>
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
    .scroll-wrap{overflow-x:scroll !important}
    .no-wrap{
        min-width:300px;
        white-space:normal !important;
    }
    /*#dataTables-example td{white-space:normal !important}*/
</style>

<script type="text/javascript">
    $(window).load(function () {
        $("table#dataTables-example").wrap("<div class='scroll-wrap'></div>");
    });

    $(document).ready(function () {

        var More_Options = parseInt('<?php echo $view_columns['more_options']; ?>');

        if (More_Options == 1) {
            $('.more-option-wrp').removeClass('hidden');
            $('#more_options').val('1');
            $('.more_search_btn').children('i').removeClass('fa-plus-square');
            $('.more_search_btn').children('i').addClass('fa-minus-square');
        } else {
            $('.more-option-wrp').addClass('hidden');
            $('#more_options').val('0');
            $('.more_search_btn').children('i').removeClass('fa-minus-square');
            $('.more_search_btn').children('i').addClass('fa-plus-square');
            $('.search_column, #all_options').prop('checked', false);
        }

        /*--------Search Criteria Selected--------*/

        $('input.emp_status[value="<?php echo $view_columns['emp_status'] ?>"]').prop("checked", true);

        $('#state_id').select2().select2('val', ($('#state_select').val())).select2({
            placeholder: "Select State",
            allowClear: true,
        });
        $('#county_id').select2().select2('val', ($('#county_select').val())).select2({
            placeholder: "Select County",
            allowClear: true,
        });
        $('#positions_id').select2().select2('val', ($('#position_select').val())).select2({
            placeholder: "Select Position",
            allowClear: true,
        });
        $('#location_id').select2().select2('val', ($('#location_select').val())).select2({
            placeholder: "Select Location",
            allowClear: true,
        });
        $('#department_id').select2().select2('val', ($('#department_select').val())).select2({
            placeholder: "Select Department",
            allowClear: true,
        });
        /*-------------------------------------------*/

        $('.more_search_btn').on('click', function () {
            if ($(this).children('i').hasClass('fa-plus-square')) {
                $('.more-option-wrp').removeClass('hidden');
                $('#more_options').val('1');
                $(this).children('i').removeClass('fa-plus-square');
                $(this).children('i').addClass('fa-minus-square');
            } else {
                $('.more-option-wrp').addClass('hidden');
                $(this).children('i').removeClass('fa-minus-square');
                $('#more_options').val('0');
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
