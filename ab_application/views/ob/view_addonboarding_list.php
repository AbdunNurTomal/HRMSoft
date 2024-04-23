<script type="text/javascript">

    var is_employee;
    $(document).ready(function () {
        //$("a[data-toggle='tab'").prop('disabled', true);
    });

</script>
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <?php
                if ($user_type == 1) {
                    ?>
                    <li class="active" >Welcome <?php echo $this->name; ?></li>
                    <?php
                } else {
                    ?>
                    <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                    <li class="active"><?php echo $page_header; ?></li>
                    <div class="pull-right" id="employee_name_div"><?php
                        if ($type == 2) {
                            echo "Full Name : " . $return_name;
                        }
                        ?></div>
                    <?php
                }
                ?>
            </ol>
        </div>
        <div class="container" style="margin-top:0px; padding-bottom: 15px;">

            <!-- <div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
                <button class="btn btn-u btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext()"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
            </div>-->

            <div class="row tab-v3">
                <div class="col-sm-2" id="tabs"> <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-pills nav-stacked" id="createNotTab">
                        <li class="active"><a href="#PersonalInformation" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Personal Information</a></li>
                        <li class="disabled1"><a href="#ContactInformation" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Contact Information</a></li>
                        <li class="disabled1"><a href="#emergencycontact" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Emergency Contact</a></li>
                        <li class="disabled1"><a href="#employmenthistory " data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Employment History<span style="font-size:10px;">(optional)</span></a></li>
                        <li class="disabled1"><a href="#reference" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> References<span style="font-size:10px;">(optional)</span> </a></li>
                        <li class="disabled1"><a href="#education" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Education<span style="font-size:10px;">(optional)</span></a></li>
                        <li class="disabled1"><a href="#criminalhistory" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Criminal History</a></li>
                        <li class="disabled1"><a href="#directdeposit" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Direct Deposit <span style="font-size:10px;">(optional)</span></a></li>
                        <li class="disabled1"><a href="#companypolicies" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Company Policies</a></li>
                        <li class="disabled1"><a href="#eeo" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Equal Employment Opportunity </a></li>
                        <li class="disabled1"><a href="#enrolling" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Dependent Enrolling </a></li>
                        <li class="disabled1"><a href="#benefit" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Benefit</a></li>
                        <!--<li class="disabled"><a href="#obw4" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> W -4</a></li>-->
                        <!--<li class="disabled"><a href="#obi9" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> I -9</a></li>-->
                        <!-- <li class="disabled2"><a href="#DocumentsAttach" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i>Documents Attachment</a></li> -->
                        <li class="disabled1"><a href="#review" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Review</a></li>
                    </ul>
                </div>

                <div class="col-xs-10">
                    <!-- Tab panes -->
                    <div class="tab-content tag-box tag-box-v3">
                        <div class="tab-pane active" id="PersonalInformation"><?php include_once( "onboarding/personalinformation.php" ); ?></div>
                        <div class="tab-pane" id="ContactInformation"><?php include_once( "onboarding/contactinformation.php" ); ?></div>
                        <div class="tab-pane" id="emergencycontact"><?php include_once( "onboarding/emergencycontact.php" ); ?></div>
                        <div class="tab-pane" id="employmenthistory"><?php include_once( "onboarding/employmenthistory.php" ); ?></div>
                        <div class="tab-pane" id="reference"><?php include_once( "onboarding/reference.php" ); ?></div>
                        <div class="tab-pane" id="education"><?php include_once( "onboarding/education.php" ); ?></div>
                        <div class="tab-pane" id="criminalhistory"><?php include_once( "onboarding/criminalhistory.php" ); ?></div>
                        <div class="tab-pane" id="directdeposit"><?php include_once( "onboarding/directdeposit.php" ); ?></div>
                        <div class="tab-pane" id="companypolicies"><?php include_once( "onboarding/companypolicies.php" ); ?></div>
                        <div class="tab-pane" id="eeo"><?php include_once( "onboarding/eeo.php" ); ?></div>
                        <div class="tab-pane" id="enrolling"><?php include_once( "onboarding/obenrolling.php" ); ?></div>
                        <div class="tab-pane" id="benefit"><?php include_once( "onboarding/benefit.php" ); ?></div>
                        <!--<div class="tab-pane" id="obw4"><?php // include_once( "onboarding/ob_w4.php" );  ?></div>-->
                        <!--<div class="tab-pane" id="obi9"><?php // include_once( "onboarding/ob_i9.php" );  ?></div>-->
                        <!-- <div class="tab-pane" id="DocumentsAttach"><?php //include_once( "onboarding/documentsattachment.php" ); ?></div> -->
                        <div class="tab-pane" id="review"><?php include_once( "onboarding/review.php" ); ?></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</div><!--/end row-->
</div><!--/end container-->


<script>

    //=========================personal information=============================

    $(function () {
        $("#onboarding_personalinformation_form").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#onboarding_personalinformation_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                var datas = data.split('_');
                //$('#onboarding_employee_id').val(datas[1]);

                var url = '';
                view_message_backup(datas[0], url, '', '');

                $("#review_div").load(location.href + " #review_div");

                setTimeout(function () {
                    showNext(1);
                }, 1000);

            });
            event.preventDefault();
        });
    });

    //=====================ecd personal information=============================

    //==========================contact information=============================

    $(function () {
        $("#onboarding_contactinformation_form").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#onboarding_contactinformation_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var datas = data.split('_');
                $('#ob_con_emp_id').val(datas[1]);

                var url = '';
                view_message_backup(datas[0], url, '', '');

                $("#review_div").load(location.href + " #review_div");

                setTimeout(function () {
                    showNext(1);
                }, 1000);

            });
            event.preventDefault();
        });
    });

    //======================end contact information=============================

    //=======================emergency contact==================================

    $(function () {
        $("#onboarding_emergencycontact_form").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#onboarding_emergencycontact_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var datas = data.split('_');

                $('#ob_emc_emp_id').val(datas[1]);
                var url = '';
                view_message_backup(datas[0], url, '', '');

                $("#review_div").load(location.href + " #review_div");

                setTimeout(function () {
                    showNext(1);
                }, 1000);

            });
            event.preventDefault();
        });
    });

    //=========================end emergency contact============================

    //===========================employment history=============================

    $(function () {
        $("#onboarding_employmenthistory_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_onboarding_list/save_onboarding_employmenthistory') ?>";
            } else
            {
                url = "<?php echo site_url('Con_onboarding_list/edit_onboarding_employmenthistory') ?>";
            }

            $.ajax({
                url: url,
                data: $("#onboarding_employmenthistory_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#employmenthistory_div").load(location.href + " #employmenthistory_div");

                var datas = data.split('_');
                var url = '';
                view_message(datas[0], url, 'employmenthistory_Modal', 'onboarding_employmenthistory_form');

                $("#review_div").load(location.href + " #review_div");
                
                reload_table('dataTables-example-employmenthistory');

            });
            event.preventDefault();
        });
    });

    function edit_ob_employmenthistory(id) {
        save_method = 'update';
        $('#onboarding_employmenthistory_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_onboarding_list/ajax_edit_employmenthistory/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="employmenthistory_id"]').val(data.id);
                $('[name="onboarding_employee_id"]').val(data.onboarding_employee_id);
                $('[name="employer"]').val(data.employer);
                $('[name="position"]').val(data.position);
                //$('[name="position"]').select2().select2('val', data.position);
                $('[name="start_date"]').val(show_date_formate_js(data.start_date));
                $('[name="end_date"]').val(show_date_formate_js(data.end_date));
                $('[name="reason_for_leaving"]').val(data.reason_for_leaving);
                $('[name="contact_employee"]').select2().select2('val', data.contact_employee);
                $('[name="supervisor_name"]').val(data.supervisor_name);
                $('[name="phone_no"]').val(data.phone_no);
                $('[name="starting_compensation"]').val(data.starting_compensation);
                $('[name="ending_compensation"]').val(data.ending_compensation);
//starting_compensation ending_compensation
                $('#employmenthistory_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Employment History'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_ob_employmenthistory(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('Con_onboarding_list/delete_entry_employmenthistory/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#employmenthistory_div").load(location.href + " #employmenthistory_div");

                    var url = '';
                    view_message(data, url, '', '');

                    $("#review_div").load(location.href + " #review_div");
                    
                    reload_table('dataTables-example-employmenthistory');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //=======================end employment history=============================

    //===========================reference======================================

    $(function () {
        $("#onboarding_reference_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_onboarding_list/save_onboarding_reference') ?>";
            } else
            {
                url = "<?php echo site_url('Con_onboarding_list/edit_onboarding_reference') ?>";
            }
            $.ajax({
                url: url,
                data: $("#onboarding_reference_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#ob_reference_div").load(location.href + " #ob_reference_div");

                var datas = data.split('_');
                var url = '';
                view_message(datas[0], url, 'reference_Modal', 'onboarding_reference_form');

                $("#review_div").load(location.href + " #review_div");
                
                reload_table('dataTables-example-reference');

            });
            event.preventDefault();
        });
    });

    function edit_ob_reference(id) {
        save_method = 'update';
        $('#onboarding_reference_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_onboarding_list/ajax_edit_reference/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="onboarding_id"]').val(data.id);
                $('[name="onboarding_employee_id"]').val(data.onboarding_employee_id);
                $('[name="name"]').val(data.name);
                $('[name="relationship"]').select2().select2('val', data.relationship);
                $('[name="reference_email"]').val(data.reference_email);
                $('[name="phone_number"]').val(data.phone_number);
                $('[name="address"]').val(data.address);

                $('#reference_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Reference'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_ob_reference(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('Con_onboarding_list/delete_entry_reference/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#ob_reference_div").load(location.href + " #ob_reference_div");

                    var url = '';
                    view_message(data, url, '', '');

                    $("#review_div").load(location.href + " #review_div");
                    
                    reload_table('dataTables-example-reference');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //=========================end reference====================================== 

    //=============================education======================================

    $(function () {
        $("#onboarding_education_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_onboarding_list/save_onboarding_education') ?>";
            } else
            {
                url = "<?php echo site_url('Con_onboarding_list/edit_onboarding_education') ?>";
            }
            $.ajax({
                url: url,
                data: $("#onboarding_education_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#od_education_div").load(location.href + " #od_education_div");

                var datas = data.split('_');
                var url = '';
                view_message(datas[0], url, 'education_Modal', 'onboarding_education_form');

                $("#review_div").load(location.href + " #review_div");
                
                reload_table('dataTables-example-education');

            });
            event.preventDefault();
        });
    });

    function edit_ob_education(id) {
        save_method = 'update';
        $('#onboarding_education_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_onboarding_list/ajax_edit_education/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="education_id"]').val(data.id);
                $('[name="onboarding_employee_id"]').val(data.onboarding_employee_id);
                $('[name="educationlevel"]').select2().select2('val', data.educationlevel);
                $('[name="institution_name"]').val(data.institution_name);
                $('[name="no_of_years"]').val(data.no_of_years);
                $('[name="graduated"]').select2().select2('val', data.graduated);
                $('[name="degree_obtained"]').val(data.degree_obtained);
                $('[name="edu_remarks"]').val(data.edu_remarks);

                $('#education_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Education'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_ob_education(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('Con_onboarding_list/delete_entry_education/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#od_education_div").load(location.href + " #od_education_div");

                    var url = '';
                    view_message(data, url, '', '');

                    $("#review_div").load(location.href + " #review_div");
                    
                    reload_table('dataTables-example-education');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //=============================end education==================================

    //===========================criminalhistory==================================

    $(function () {
        $("#onboarding_criminalhistory_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_onboarding_list/save_onboarding_criminalhistory') ?>";
            } else
            {
                url = "<?php echo site_url('Con_onboarding_list/edit_onboarding_criminalhistory') ?>";
            }
            $.ajax({
                url: url,
                data: $("#onboarding_criminalhistory_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#ob_criminalhistory_div").load(location.href + " #ob_criminalhistory_div");

                var datas = data.split('_');
                var url = '';
                view_message(datas[0], url, 'criminalhistory_Modal', 'onboarding_criminalhistory_form');

                $("#review_div").load(location.href + " #review_div");
                
                reload_table('dataTables-example-criminalhistory');

            });
            event.preventDefault();
        });
    });

    function edit_ob_criminalhistory(id) {
        save_method = 'update';
        $('#onboarding_criminalhistory_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_onboarding_list/ajax_edit_criminalhistory/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="criminalhistory_id"]').val(data.id);
                $('[name="onboarding_employee_id"]').val(data.onboarding_employee_id);
                $('[name="offense_type"]').select2().select2('val', data.offense_type);
                $('[name="offense"]').val(data.offense);
                $('[name="offense_date"]').val(show_date_formate_js(data.offense_date));
                $('[name="city"]').val(data.city);
                $('[name="offense_state"]').select2().select2('val', data.offense_state);
                load_criminal_county(data.offense_state);
                $('[name="county"]').select2().select2('val', data.county);
                $('[name="description"]').val(data.description);

                $('#criminalhistory_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Criminal History'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_ob_criminalhistory(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('Con_onboarding_list/delete_entry_criminalhistory/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#ob_criminalhistory_div").load(location.href + " #ob_criminalhistory_div");

                    var url = '';
                    view_message(data, url, '', '');

                    $("#review_div").load(location.href + " #review_div");
                    
                    reload_table('dataTables-example-criminalhistory');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //==========================end criminalhistory===============================

    //==========================direct deposit====================================

    $(function () {
        $("#onboarding_directdeposit_form").submit(function (event) {

            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_onboarding_list/save_onboarding_directdeposit') ?>";
            } else
            {
                url = "<?php echo site_url('Con_onboarding_list/edit_onboarding_directdeposit') ?>";
            }

            $.ajax({
                url: url,
                data: $("#onboarding_directdeposit_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#ob_directdeposit_div").load(location.href + " #ob_directdeposit_div");

                var datas = data.split('_');
                var url = '';
                view_message(datas[0], url, 'directdeposit_Modal', 'onboarding_directdeposit_form');

                $("#review_div").load(location.href + " #review_div");
                
                 reload_table('dataTables-example-directdeposit');

            });
            event.preventDefault();
        });
    });

    function edit_ob_directdeposit(id) {
        save_method = 'update';
        $('#onboarding_directdeposit_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_onboarding_list/ajax_edit_directdeposit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="directdeposit_id"]').val(data.id);
                $('[name="onboarding_employee_id"]').val(data.onboarding_employee_id);

                $('[name="bank_name"]').val(data.bank_name);
                $('[name="account_number"]').val(data.account_number);
                $('[name="routing_number"]').val(data.routing_number);
                $('[name="account_type"]').select2().select2('val', data.account_type);
                $('[name="amount_type"]').select2().select2('val', data.amount_type);
                $('[name="acc_value"]').val(data.acc_value);
                $('[name="paid_check"]').select2().select2('val', data.paid_check);

                $('#directdeposit_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Direct Deposit'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_ob_directdeposit(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('Con_onboarding_list/delete_entry_directdeposit/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#ob_directdeposit_div").load(location.href + " #ob_directdeposit_div");

                    var url = '';
                    view_message(data, url, '', '');

                    $("#review_div").load(location.href + " #review_div");
                    
                    reload_table('dataTables-example-directdeposit');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //====================end direct deposit======================================

    //======================company policies======================================

    $(function () {
        $("#onboarding_companypolicies_form").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#onboarding_companypolicies_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //$('#onboarding_companypolicies_form')[0].reset();
                //alert (data);
                var datas = data.split('_');

                //$('#ob_cp_emp_id').val(datas[1]);

                var url = '';
                view_message_backup(datas[0], url, '', '');

                $("#review_div").load(location.href + " #review_div");

                setTimeout(function () {
                    showNext(1);
                }, 1000);

            });
            event.preventDefault();
        });
    });

    //=================end company policies=======================================

    //======================eeo policies==========================================

    $(function () {
        $("#onboarding_eeopolicies_form").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#onboarding_eeopolicies_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var datas = data.split('_');

                $('#ob_eeo_emp_id').val(datas[1]);

                var url = '';
                view_message_backup(datas[0], url, '', '');

                $("#review_div").load(location.href + " #review_div");

                setTimeout(function () {
                    showNext(1);
                }, 1000);

            });
            event.preventDefault();
        });
    });

    //=================end eeo policies===========================================


    //=========================== Enrolling ======================================

    $(function () {
        $("#obenrolling_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_onboarding_list/save_onboarding_enrolling') ?>";
            } else
            {
                url = "<?php echo site_url('Con_onboarding_list/edit_onboarding_enrolling') ?>";
            }

            $.ajax({
                url: url,
                data: $("#obenrolling_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#ob_enrolling_div").load(location.href + " #ob_enrolling_div");

                var url = '';
                view_message(data, url, 'obenrolling_Modal', 'obenrolling_form');

                $("#ben_enrolling_div").load(location.href + " #ben_enrolling_div");
                $("#review_div").load(location.href + " #review_div");
                
                reload_table('dataTables-example-enrolling');

            });
            event.preventDefault();
        });
    });

    function edit_ob_enrolling(id) {
        save_method = 'update';
        $('#obenrolling_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_onboarding_list/ajax_edit_enrolling/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="enrolling_id"]').val(data.id);
                $('[name="onboarding_employee_id"]').val(data.onboarding_employee_id);
                $('[name="obenrolling_fast_name"]').val(data.fast_name);
                $('[name="obenrolling_middle_name"]').val(data.middle_name);
                $('[name="obenrolling_last_name"]').val(data.last_name);
                $('[name="obenrolling_suffix"]').val(data.suffix);
                $('[name="obenrolling_relationship"]').select2().select2('val', data.relationship);
                $('[name="obenrolling_gender"]').select2().select2('val', data.gender);
                $('[name="obenrolling_birthdate"]').val(show_date_formate_js(data.date_of_birth));
                $('[name="obenrolling_age"]').val(data.age);
                $('[name="obenrolling_ssn"]').val(data.ssn);
                $('[name="obenrolling_iscollage_student"]').select2().select2('val', data.is_collage_student);
                $('[name="obenrolling_istobacco_user"]').select2().select2('val', data.is_tobacco_user);
                //$('[name="obenrolling_employee_address"]').val(data.employee_address);

                $('#obenrolling_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Enrolling'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_ob_enrolling(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('Con_onboarding_list/delete_entry_enrolling/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#ob_enrolling_div").load(location.href + " #ob_enrolling_div");

                    var url = '';
                    view_message(data, url, '', '');

                    $("#ben_enrolling_div").load(location.href + " #ben_enrolling_div");
                    $("#review_div").load(location.href + " #review_div");
                    
                    reload_table('dataTables-example-enrolling');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //===========================End Enrolling====================================

    //=========================== benefit=========================================

    $(function () {
        $("#onboarding_benefit_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_onboarding_list/save_onboarding_benefit') ?>";
            } else
            {
                url = "<?php echo site_url('Con_onboarding_list/edit_onboarding_benefit') ?>";
            }

            $.ajax({
                url: url,
                data: $("#onboarding_benefit_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#ob_benefit_div").load(location.href + " #ob_benefit_div");

                var url = '';
                view_message(data, url, 'ob_benefit_Modal', 'onboarding_benefit_form');

                $("#review_div").load(location.href + " #review_div");
                
                reload_table('dataTables-example-benefit');
            });
            event.preventDefault();
        });
    });

    function edit_ob_benefit(id) {
        save_method = 'update';
        $('#onboarding_benefit_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_onboarding_list/ajax_edit_benefit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="benefit_id"]').val(data.id);
                $('[name="onboarding_employee_id"]').val(data.onboarding_employee_id);
                $('[name="benefit_enrolling"]').select2().select2('val', data.enrolling);
                $('[name="provider"]').select2().select2('val', data.provider);
                $('[name="benefit_type"]').select2().select2('val', data.benefit_type);
                $('[name="eligible_date"]').val(show_date_formate_js(data.eligible_date));
                $('[name="enrolled_date"]').val(show_date_formate_js(data.enrolled_date));
                $('[name="percent_dollars"]').select2().select2('val', data.percent_dollars);
                change_Persentase_doller(data.percent_dollars);
                $('[name="employee_portion"]').val(data.employee_portion);
                $('[name="employer_portion"]').val(data.employer_portion);
                $('[name="description"]').val(data.description);
                $('[name="benefit_status"]').select2().select2('val', data.isactive);
                $('[name="deduction_frequency"]').select2().select2('val', data.deduction_frequency);

                $('#ob_benefit_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Benefit'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_ob_benefit(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('Con_onboarding_list/delete_entry_benefit/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#ob_benefit_div").load(location.href + " #ob_benefit_div");

                    var url = '';
                    view_message(data, url, '', '');

                    $("#review_div").load(location.href + " #review_div");
                    
                    reload_table('dataTables-example-benefit');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //=======================end benefit==========================================


    //==============================documents form=================================

    $(function () {
        $("#onboarding_documents_form").submit(function (event) {
            var url = $(this).attr('action');
            //alert (url);
            $.ajax({
                url: url,
                data: $("#onboarding_documents_form").serialize(),
                type: $(this).attr('method'),
                secureuri: false
            }).done(function (data) {

                alert (data);

                var datas = data.split('_');
                $('#ob_con_emp_id').val(datas[1]);

                var url = '';
                view_message_backup(datas[0], url, '', '');

                $("#review_div_save_id").load(location.href + " #review_div_save_id");

                setTimeout(function () {
                    showNext(1);
                }, 1000);

            });
            event.preventDefault();
        });
    });

    //==============================end documents form=================================

    

    $(function () {
        $("#onboarding_submition_form").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#onboarding_submition_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //alert (data);
                var datas = data.split('_');
                var ck = datas[0].split('##');

                if (ck[1] == 2)
                {
                    $('.nav-tabs a[href="#' + datas[1] + '"]').tab('show');
                } else
                {
                    $('#ob_revieu_emp_id').val(datas[1]);
                }

                var url = '';
                view_message(datas[0], url, '', '');

            });
            event.preventDefault();
        });
    });

    //============================================================================

    var $tabs = $('#createNotTab li');

    function showPrev() {
        $tabs.filter('.active').prev('li').removeClass("disabled");
        $tabs.filter('.active').prev('li').find('a[data-toggle]').each(function () {
            $(this).attr("data-toggle", "tab");
        });

        $tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');

        $tabs.filter('.active').next('li').find('a[data-toggle="tab"]').each(function () {
            $(this).attr("data-toggle", "").parent('li').addClass("disabled");
        })
    }

    function showNext(is_employee) {
        //alert (is_employee);
        //var is_employee=1;
        if (is_employee == 1)
        {
            $tabs.filter('.active').next('li').removeClass("disabled");
            $tabs.filter('.active').next('li').find('a[data-toggle]').each(function () {
                $(this).attr("data-toggle", "tab");
            });

            $tabs.filter('.active').next('li').find('a[data-toggle="tab"]').tab('show');

            $tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').each(function () {
                $(this).attr("data-toggle", "").parent('li').addClass("disabled");
                ;
            })
        }
    }


</script>