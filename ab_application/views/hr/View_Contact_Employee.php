<?php // echo "<pre>". print_r($this->session->userdata('hr_logged_in'), 1) ."</pre>";exit;
$loggedInUserName = $this->session->userdata('hr_logged_in') ? $this->session->userdata('hr_logged_in')["name"] : "";

// print_r($this->company_id);exit;
$this->db->order_by("first_name", "asc");
if ($this->session->userdata('hr_logged_in')["user_group"] == 1 && $this->session->userdata('hr_logged_in')["company_view"] == 0) {
    $employee_query = $this->db->get_where('main_employees', array('contact_via_text' => 1,'isactive' => 1));
} else {
    $employee_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'contact_via_text' => 1,'isactive' => 1));
}
?>

<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box-v3-contact-employee" style="margin-top: 0px; width: 96%; padding-bottom: 15px; padding-top: 15px;">
            <!-- container well div -->
            <div class="table-responsive col-md-12 col-centered">
                <form class="form-horizontal" action="<?php echo base_url() . 'Con_dashbord/search_company/'; ?>" method="post">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select an option</label>
                            <div class="col-sm-4">
                                <select id="contact-employee-option" class="col-sm-12 col-xs-12 myselect2 input-sm" name="contact-employee-option">
                                    <option value="department" selected>Department</option>
                                    <option value="group">User Group</option>
                                    <option value="employee">Employee</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- send sms for employees under a department section starts -->
        <div id="contact-employee-by-department" class="container tag-box-v3-contact-employee" style="margin-top: 0px; padding: 20px 0 15px; display: block;">
            <div class="table-responsive col-md-12 col-centered">
                <form class="form-horizontal" action="<?php echo base_url() . 'Con_Contact_Employee/search_Department/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Department </label>
                                <div class="col-sm-4">
                                    <select name="department_id" id="department_id" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($department_query->result() as $key) {
                                            $slct = ($search_criteria['department_id'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->department_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <!-- <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button>  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- <input type="hidden" name="employee_id" id="employee_id"> -->

                <table id="contact-employee-datatable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" name="select_all" value="1" id="department-table-select-all"></th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Mobile</th>
                            <!-- <th>Actions</th>  -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- send sms for employees under a department section ends -->

        <!-- send sms for group of employees section starts -->
        <div id="contact-employee-by-group" class="container tag-box-v3-contact-employee" style="margin-top: 0px; padding: 20px 0 15px; display: none;">
            <div class="table-responsive col-md-12 col-centered">
                <form class="form-horizontal" action="<?php echo base_url() . 'Con_Contact_Employee/search_Usergroup/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> User Group </label>
                                <div class="col-sm-4">
                                    <select name="usergroup_id" id="usergroup_id" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($usergroup_query->result() as $key) {
                                            $slct1 = ($search_criteria['usergroup_id'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct1 . '>' . $key->group_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <!-- <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button>  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- <input type="hidden" name="employee_id" id="employee_id">  -->

                <table id="contact-employee-group-datatable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" name="select_all" value="1" id="usergroup-table-select-all"></th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Mobile</th>
                            <!-- <th>Actions</th>  -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- send sms for group of employees section ends -->

        <!-- send sms for an employee section starts -->
        <div id="contact-employee-by-employee" class="container tag-box-v3-contact-employee" style="margin-top: 0px; padding: 20px 0 15px; display: none;">
            <!-- <form class="form-horizontal" role="form">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Employee</label>
                        <div class="col-sm-4">
                            <select name="employee" id="contact-employee-select" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php // foreach ($employee_query->result() as $key): 
                                ?>
                                    <option value="<?php // echo $key->employee_id 
                                                    ?>"><?php // echo $key->first_name . ' ' . $key->last_name 
                                                        ?></option>
                                <?php // endforeach; 
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </form> -->
            <div class="table-responsive col-md-12 col-centered">
                <table id="contact-employee-by-employee-datatable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" name="select_all" value="1" id="employee-table-select-all"></th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Mobile</th>
                            <!-- <th>Actions</th>  -->
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!-- send sms for an employee section ends -->

        <div class="container tag-box-v3-contact-employee" style="margin-top: 0px; padding-bottom: 15px;">
            <div class="container tag-box" style="margin-bottom: 20px">
                <h2></h2>
            </div>
            <form id="contact-employee-form" class="form-horizontal" method="POST" action="<?php echo site_url('Con_Contact_Employee/sendSMS'); ?>" role="form">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Message</label>
                        <div class="col-sm-4">
                            <textarea id="contact-employee-message" type="text" name="contact-employee-message" class="form-control input-sm" rows="4" placeholder="Message" data-toggle="tooltip" data-placement="bottom" title="Text Message" maxlength="240"></textarea>
                            <span id="word-count-div" style="display: none;"><span id="rchars">240</span> Character(s) Remaining</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Message Preview</label>
                        <div class="col-sm-4">
                            <div id="contact-employee-msg-preview" class="alert alert-info" role="alert" style="min-height: 120px;">
                                &nbsp;-&nbsp;<?= $loggedInUserName; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 text-center" style="margin-top: 10px;" id="message">
                    <div id="contact-employee-alert" class="alert alert-success" role="alert" style="display: none;">SMS sent</div>
                    <div id="contact-employee-error-alert" class="alert alert-danger" role="alert" style="display: none;"></div>
                </div>

                <div class="col-sm-12" style="margin-top: 10px;">
                    <div class="modal-footer">
                        <button id="btnSendSMS" type="button" class="btn btn-u" disabled>Send</button>
                        <a id="btnContactEmployeeClose" class="btn btn-danger" href="<?php echo base_url() . "Con_Contact_Employee"; ?>">Close</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- </div> -->
    </div>
</div>

</div>
<!--/row-->
</div>
<!--/container-->
<!--=== End Content ===-->

<script type="text/javascript">
    var loggedInUserName;
    $("#contact-employee-option").select2({
        placeholder: "Select Employee",
        allowClear: true
    });

    $("#contact-employee-select").select2({
        placeholder: "Select Employee",
        allowClear: true,
    });

    $("#department_id").select2({
        placeholder: "Select department",
        allowClear: true
    });

    $("#usergroup_id").select2({
        placeholder: "Select User Group",
        allowClear: true
    });

    $(document).on("change", "#contact-employee-option", function() {
        var selectedOption = $(this).val();

        $("#word-count-div").hide();
        $("#contact-employee-message").val("");
        $("#department-table-select-all").prop("checked", false);
        $("#usergroup-table-select-all").prop("checked", false);
        $("#employee-table-select-all").prop("checked", false);

        hideContactEmployeeAlertMsg();
        resetPreview();

        $("#contact-employee-by-department").hide();
        $("#contact-employee-by-group").hide();
        $("#contact-employee-by-employee").hide();
        $("#btnSendSMS").prop("disabled", false);
        if (selectedOption === "employee") {
            $("#contact-employee-by-employee").show();
        } else if (selectedOption === "group") {
            $("#btnSendSMS").prop("disabled", true);
            $("#contact-employee-by-group").show();
        } else if (selectedOption === "department") {
            $("#btnSendSMS").prop("disabled", true);
            $("#contact-employee-by-department").show();
        }

        $("#department_id").val("").trigger("change");
        $("#usergroup_id").val("").trigger("change");
    });

    $(document).on("change keyup paste", "#contact-employee-message", function() {
        var sendName = loggedInUserName;
        var smsMsgOnly = $(this).val();
        var smsMsg = smsMsgOnly + " - " + sendName;
        $("#contact-employee-msg-preview").html(smsMsg);

        $("#btnSendSMS").prop("disabled", true);
        if (smsMsgOnly.length > 0) {
            $("#btnSendSMS").prop("disabled", false);
        }
    });

    function resetPreview() {
        var sendName = loggedInUserName;
        var smsMsgOnly = $("#contact-employee-message").val();
        var smsMsg = smsMsgOnly + " - " + sendName;
        $("#contact-employee-msg-preview").html(smsMsg);
    }

    /* document ready starts */
    $(document).ready(function() {
        loggedInUserName = "<?php echo $loggedInUserName; ?>";
        var maxLength = 240 - (loggedInUserName.length + 3);
        $("#contact-employee-message").attr('maxlength', maxLength);
        $('textarea#contact-employee-message').keyup(function() {
            $("#word-count-div").show();
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });

        function updateWordMaxLengthCount() {
            var textlen = maxLength - $('textarea#contact-employee-message').val().length;
            $('#rchars').text(textlen);
        }

        /* department dropdown change starts */
        $(document).on('change', '#department_id', function() {
            hideContactEmployeeAlertMsg();
            $("#department-table-select-all").prop("checked", false);

            var myTable = $('#contact-employee-datatable').DataTable(); // get the table ID

            // If you want totally refresh the datatable use this 
            // myTable.ajax.reload();
            var deptId = $(this).val();
            var new_url = base_url + "Con_Contact_Employee/showEmployeesByDepartment?department_id=" + deptId;
            myTable.ajax.url(new_url).load()

            // If you want to refresh but keep the paging you can you this
            // myTable.ajax.reload( null, false );
        });
        /* department dropdown change ends */

        var base_url = "<?php echo base_url(); ?>";

        /* datatable for contact employee by employee starts */
        var contactEmployeeTable = $('#contact-employee-datatable').DataTable({
            "pageLength": 10,
            "paginationType": "input",
            // "serverSide": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'Con_Contact_Employee/showEmployeesByDepartment?department_id=' + $("#department_id").val(),
                type: 'GET'
            },
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center text-center',
                "width": "4%",
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox" name="id" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            'order': [
                [1, 'asc']
            ]
        });
        $("#contact-employee-datatable").wrap('<div class="overflow-x"> </div>');
        /* datatable for contact employee by employee ends */

        // Handle click on "Select all" control
        $('#department-table-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = contactEmployeeTable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#contact-employee-datatable tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#department-table-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if (el && el.checked && ('indeterminate' in el)) {
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });



        /* usergroup dropdown change starts */
        $(document).on('change', '#usergroup_id', function() {
            hideContactEmployeeAlertMsg();
            $("#usergroup-table-select-all").prop("checked", false);

            var myTable = $('#contact-employee-group-datatable').DataTable(); // get the table ID

            // If you want totally refresh the datatable use this 
            // myTable.ajax.reload();
            var groupId = $(this).val();
            var new_url = base_url + "Con_Contact_Employee/showEmployeesByGroup?usergroup_id=" + groupId;
            myTable.ajax.url(new_url).load()

            // If you want to refresh but keep the paging you can you this
            // myTable.ajax.reload( null, false );
        });
        /* usergroup dropdown change ends */

        /* datatable for contact employee by group starts */
        var groupContactEmployeeTable = $('#contact-employee-group-datatable').DataTable({
            "pageLength": 10,
            "paginationType": "input",
            // "serverSide": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'Con_Contact_Employee/showEmployeesByGroup?usergroup_id=' + $("#usergroup_id").val(),
                type: 'GET'
            },
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center text-center',
                "width": "4%",
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox" name="id" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            'order': [
                [1, 'asc']
            ]
        });
        $("#contact-employee-group-datatable").wrap('<div class="overflow-x"> </div>');
        /* datatable for contact employee by group ends */

        // Handle click on "Select all" control
        $('#usergroup-table-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = groupContactEmployeeTable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#contact-employee-group-datatable tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#usergroup-table-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if (el && el.checked && ('indeterminate' in el)) {
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });


        /* datatable for contact employee by employee starts */
        var contactEmployeeByEmployeeTable = $('#contact-employee-by-employee-datatable').DataTable({
            "pageLength": 10,
            "paginationType": "input",
            // "serverSide": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'Con_Contact_Employee/showEmployees',
                type: 'GET'
            },
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center text-center',
                "width": "4%",
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox" name="id" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            'order': [
                [1, 'asc']
            ]
        });
        $("#contact-employee-by-employee-datatable").wrap('<div class="overflow-x"> </div>');
        /* datatable for contact employee by employee ends */

        // Handle click on "Select all" control
        $('#employee-table-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = contactEmployeeByEmployeeTable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#contact-employee-by-employee-datatable tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#employee-table-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if (el && el.checked && ('indeterminate' in el)) {
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });



        /* SMS send button click starts */
        $('#btnSendSMS').on('click', function(e) {
            var message = $("#contact-employee-message").val();
            var url = $("#contact-employee-form").attr('action');

            hideContactEmployeeAlertMsg();
            $("#btnSendSMS").prop("disabled", true);
            $("#btnContactEmployeeClose").addClass("disabled");

            var selectedOption = $("#contact-employee-option").val();
            var employees = [];
            if (selectedOption == "group") {
                var selectedEmployees = groupContactEmployeeTable.$('input[type="checkbox"]').serializeArray();
                selectedEmployees.forEach(function(item, key) {
                    employees.push(item.value);
                });
            } else if (selectedOption == "department") {
                var selectedEmployees = contactEmployeeTable.$('input[type="checkbox"]').serializeArray();
                selectedEmployees.forEach(function(item, key) {
                    employees.push(item.value);
                });
            } else if (selectedOption == "employee") {
                var selectedEmployees = contactEmployeeByEmployeeTable.$('input[type="checkbox"]').serializeArray();
                selectedEmployees.forEach(function(item, key) {
                    employees.push(item.value);
                });
            }
            if (employees.length > 20) {
                $("#contact-employee-alert").html("Only 20 employees can be selected at the maximum").removeClass("alert-success").addClass("alert-danger").show();
                return;
            } 
             //console.log(employees);return;
            $("#message").load(location.href + " #message");
            $.ajax({
                url: url,
                data: {
                    selectedOption: selectedOption,
                    employee_id: employees.join(),
                    message: message
                },
                method: "POST",
                dataType: "JSON",
                success: function(response) {
                    if (response.status) {
                        $("#contact-employee-message").val("");
                        $("#btnSendSMS").prop("disabled", false);
                        $("#btnContactEmployeeClose").removeClass("disabled");
                        if (response.successMsg) {
                            $("#contact-employee-alert").html(response.successMsg).show();
                        }
                        if (response.errorMsg) {
                            $("#contact-employee-error-alert").html(response.errorMsg).show();
                        }

                        resetPreview();
                        updateWordMaxLengthCount();
                    }
                },
                error: function(err) {
                    $("#btnSendSMS").prop("disabled", false);
                    $("#btnContactEmployeeClose").removeClass("disabled");
                }
            });
//             $('#btnSendSMS').disable();
            $("#btnSendSMS").prop("disabled", true);
        });
        /* SMS send button click ends */
    })
    /* document ready ends */

    /* hideAlertMsg function starts */
    function hideContactEmployeeAlertMsg() {
        $("#contact-employee-alert").hide();
        $("#contact-employee-error-alert").hide();
    }
    /* hideAlertMsg function ends */
</script>