<?php
$company_data = $this->session->userdata('company');
$this->company_settings_id = $company_data['company_settings_id'];
if ($this->company_settings_id == "" || $this->company_settings_id == null) {
    $chk_com = 0;
} else {
    $chk_com = 1;
}
?>
<script type="text/javascript">

    var is_company = <?php echo $chk_com; ?>;

    $(document).ready(function () {
        $("a[data-toggle='tab'").prop('disabled', true);

        $("a[data-toggle='tab'").click(function (e) {
            var target = $(e.target).text();
            if ($('#chk_company').val() == "")
            {
                //alert ($('#chk_company').val());
                alert('Please add the Company first to add his ' + target + ' .');
            }
        });
    });

    function enable_tabs()
    {
        $("a[data-toggle='tab'").prop('disabled', false);
        //$('.nav-tabs a[href="#education"]').tab('show');
    }

    if (is_company == 1)
    {
        $(window).load(function () {
            enable_tabs();
        });
    }

</script>

<div class="col-md-<?php if($module_id==0) echo 12; else echo 10;?> main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container" style="margin-top: 0px; padding-bottom: 15px;"> 

            <div class="row tab-v3">
                <div class="col-sm-2" id="tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#company" data-toggle="tab"><i class="fa fa-gear"></i> Company</a></li>
                        <li class=""><a href="#location" data-toggle="tab"><i class="fa fa-gear"></i> Location</a></li>
                        <li class=""><a href="#department" data-toggle="tab"><i class="fa fa-gear"></i> Department</a></li>
                        <li class=""><a href="#businesstype" data-toggle="tab"><i class="fa fa-gear"></i> Business Type</a></li>
                        <li class=""><a href="#payfrequency" data-toggle="tab"><i class="fa fa-gear"></i> Pay Frequency</a></li>
                        <!--<li class=""><a href="#jobtitles" data-toggle="tab"><i class="fa fa-gear"></i> Job Titles</a></li>-->
                        <li class=""><a href="#position" data-toggle="tab"><i class="fa fa-gear"></i> Position</a></li>
                        <li class=""><a href="#employeestatus" data-toggle="tab"><i class="fa fa-gear"></i> Employee Status</a></li>
                        <li class=""><a href="#language" data-toggle="tab"><i class="fa fa-gear"></i> Language</a></li>
                        <li class=""><a href="#leavetype" data-toggle="tab"><i class="fa fa-gear"></i> Leave Type</a></li>
                        <li class=""><a href="#education" data-toggle="tab"><i class="fa fa-gear"></i> Education</a></li>
                        <li class=""><a href="#bankaccounttype" data-toggle="tab"><i class="fa fa-gear"></i> Bank Account Types</a></li>
                        <li class=""><a href="#competencylevels" data-toggle="tab"><i class="fa fa-gear"></i> Competency Levels</a></li>
                        <li class=""><a href="#disciplinetype" data-toggle="tab"><i class="fa fa-gear"></i> Discipline Type</a></li>
                        <li class=""><a href="#incidenttype" data-toggle="tab"><i class="fa fa-gear"></i> Incident Type</a></li>  
                        <li class=""><a href="#benefitstype" data-toggle="tab"><i class="fa fa-gear"></i> Benefits Type</a></li>
                        <li class=""><a href="#benefitsprovider" data-toggle="tab"><i class="fa fa-gear"></i> Benefits Provider</a></li>
                        <li class=""><a href="#relationshipstatus" data-toggle="tab"><i class="fa fa-gear"></i> Dependents </a></li>
                        <!--<li class=""><a href="#dependentinformation" data-toggle="tab"><i class="fa fa-gear"></i> Enrolling </a></li>-->
                        <li class=""><a href="#companypolicy" data-toggle="tab"><i class="fa fa-gear"></i> Company Policy</a></li>
                        <li class=""><a href="#eeoc" data-toggle="tab"><i class="fa fa-gear"></i> EEOC</a></li>
                        <li class=""><a href="#assetstype" data-toggle="tab"><i class="fa fa-gear"></i> Assets Type</a></li>
                        <li class=""><a href="#assetscategory" data-toggle="tab"><i class="fa fa-gear"></i> Assets Category</a></li>
                        <li class=""><a href="#assetsname" data-toggle="tab"><i class="fa fa-gear"></i> Assets Name</a></li>
                        <li class=""><a href="#assetregister" data-toggle="tab"><i class="fa fa-gear"></i> Asset Register</a></li>
                        <li class=""><a href="#alertpolicy" data-toggle="tab"><i class="fa fa-gear"></i> Alert Policy</a></li>
                        <li class=""><a href="#leavepolicy" data-toggle="tab"><i class="fa fa-gear"></i> Leave Policy </a></li>
                        <li class=""><a href="#ptopolicy" data-toggle="tab"><i class="fa fa-gear"></i> Accrual Leave Policy </a></li>
                        <li class=""><a href="#apisetting" data-toggle="tab"><i class="fa fa-gear"></i> API Setting </a></li>
                        <li class=""><a href="#jobposting" data-toggle="tab"><i class="fa fa-gear"></i> Job Posting API </a></li>
                        <!--<li class=""><a href="#WageCompensation" data-toggle="tab"><i class="fa fa-gear"></i> Wage & Compensation</a></li>-->
                    </ul>
                </div>

                <div class="col-sm-10">
                    <!-- Tab panes -->
                    <div class="tab-content tag-box tag-box-v3">
                        <div class="tab-pane active" id="company"><?php include_once("settings/company.php"); ?>  </div>
                        <div class="tab-pane" id="location"><?php include_once("settings/location.php"); ?> </div>
                        <div class="tab-pane" id="department"><?php include_once("settings/department.php"); ?> </div>
                        <div class="tab-pane" id="businesstype"><?php include_once("settings/businesstype.php"); ?> </div>
                        <div class="tab-pane" id="payfrequency"><?php include_once("settings/payfrequency.php"); ?></div>
                        <!--<div class="tab-pane" id="jobtitles"><?php // include_once("settings/jobtitles.php");    ?></div>-->
                        <div class="tab-pane" id="position"><?php include_once("settings/position.php"); ?></div>
                        <div class="tab-pane" id="employeestatus"><?php include_once("settings/employeestatus.php"); ?></div>
                        <div class="tab-pane" id="language"><?php include_once("settings/language.php"); ?></div>
                        <div class="tab-pane" id="leavetype"><?php include_once("settings/leavetype.php"); ?></div>
                        <div class="tab-pane" id="education"><?php include_once("settings/education.php"); ?></div>
                        <div class="tab-pane" id="bankaccounttype"><?php include_once("settings/bankaccounttype.php"); ?></div>
                        <div class="tab-pane" id="competencylevels"><?php include_once("settings/competencylevels.php"); ?></div>
                        <div class="tab-pane" id="disciplinetype"><?php include_once("settings/disciplinetype.php"); ?></div>
                        <div class="tab-pane" id="incidenttype"><?php include_once("settings/incidenttype.php"); ?></div>
                        <div class="tab-pane" id="benefitstype"><?php include_once("settings/benefitstype.php"); ?></div>
                        <div class="tab-pane" id="benefitsprovider"><?php include_once("settings/benefitsprovider.php"); ?></div>
                        <div class="tab-pane" id="relationshipstatus"><?php include_once("settings/relationshipstatus.php"); ?></div>
                        <!--<div class="tab-pane" id="dependentinformation"><?php // include_once("settings/dependentinformation.php");    ?></div>-->
                        <div class="tab-pane" id="companypolicy"><?php include_once("settings/companypolicy.php"); ?></div>
                        <div class="tab-pane" id="eeoc"><?php include_once("settings/eeoc.php"); ?></div>
                        <div class="tab-pane" id="assetstype"><?php include_once("settings/assetstype.php"); ?></div>
                        <div class="tab-pane" id="assetscategory"><?php include_once("settings/assetscategory.php"); ?></div>
                        <div class="tab-pane" id="assetsname"><?php include_once("settings/assetsname.php"); ?></div>
                        <div class="tab-pane" id="assetregister"><?php include_once("settings/assetregister.php"); ?></div>
                        <div class="tab-pane" id="alertpolicy"><?php include_once("settings/alertpolicy.php"); ?></div>
                        <div class="tab-pane" id="leavepolicy"><?php include_once("settings/leavepolicy.php"); ?></div>
                        <div class="tab-pane" id="ptopolicy"><?php include_once("settings/ptopolicy.php"); ?></div>
                        <div class="tab-pane" id="apisetting"><?php include_once("settings/apisetting.php"); ?></div>
                        <div class="tab-pane" id="jobposting"><?php include_once("settings/jobposting.php"); ?></div>
                        <!--<div class="tab-pane" id="WageCompensation"><?php // include_once("settings/wage_compensation.php"); ?> </div>-->
                         
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</div><!--/end row-->
</div><!--/end container-->


<script type="text/javascript">

    //==========================================================================

    $(function () {
        $("#company_settings_form").submit(function (event) {
            
            loading_box(base_url);
            
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#company_settings_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                //alert (data);
                
                var datas = data.split('_');
                var url = '';
                view_message(datas[0], url, '', '');

                if (datas[1])
                {
                    enable_tabs();
                }

                $('#company_id').val(datas[1]);
                $('#company_user_id').val(datas[2]);
                
                
                $("#company_logo_div").load(location.href + " #company_logo_div");
                $("#company_name_div").load(location.href + " #company_name_div");

            });
            event.preventDefault();
        });
    });

    //==========================================================================

    $(function () {
        $("#location_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_location') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_location') ?>";
            }
            $.ajax({
                url: url,
                data: $("#location_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //$("#location_div").load(location.href + " #location_div");

                var url = '';
                view_message(data, url, 'location_Modal', 'location_form');
                var oTable = $('#new_location').DataTable( );
                // to reload
                oTable.ajax.reload();
                setTimeout(function(){ 
                    reload_table('dataTables-example-location');
                }, 4000);
                    
            });
            event.preventDefault();
        });
    });

    function edit_location(id) {
        save_method = 'update';
        $('#location_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_location/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="location_id"]').val(data.id);
                $('[name="location_name"]').val(data.location_name);
                //$('[name="location_code"]').val(data.location_code);
                $('[name="contact_person"]').val(data.contact_person);
                $('[name="contact_number"]').val(data.contact_number);
                $('[name="email"]').val(data.email);
                $('[name="started_on"]').val(show_date_formate_js(data.started_on));
                $('[name="location_time_zone"]').select2().select2('val', data.time_zone);                
                $('[name="location_state_id"]').select2().select2('val', data.state_id);
                load_lo_county(data.state_id);
                $('[name="location_county_id"]').select2().select2('val', data.county_id);
                $('[name="location_city"]').val(data.city);
                $('[name="location_zipcode"]').val(data.zipcode);
                $('[name="address_1"]').val(data.address_1);
                $('[name="address_2"]').val(data.address_2);
                $('[name="description"]').val(data.description);

                $('#location_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Location'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_location(id) {

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
                
                $.ajax({
                    url: "<?php  echo site_url('Con_configaration/delete_entry_location/') ?>/" + id,
                    type: "POST",
                    success: function (data)
                    {
                        //$("#location_div").load(location.href + " #location_div");

                        var url = '';
                        view_message(data, url, 'location_Modal', '');
                         var oTable = $('#new_location').DataTable( );
                        // to reload
                        oTable.ajax.reload();
                        setTimeout(function(){ 
                            reload_table('dataTables-example-location');
                        }, 4000);

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
                
        } else {
          swal("Your imaginary file is safe!");
        }
    });
        

      
    }

    //==========================================================================

    $(function () {
        $("#department_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_department') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_department') ?>";
            }
            $.ajax({
                url: url,
                data: $("#department_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
               
                $("#department_divv").load(location.href + " #department_divv");

                var url = '';
                view_message(data, url, 'department_Modal', 'department_form');
                
                setTimeout(function(){ 
                    reload_table('dataTables-example-department');
                }, 4000);

            });
            event.preventDefault();
        });
    });

    function edit_department(id) {
        //alert (id);
        save_method = 'update';
        $('#department_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_department/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="department_id"]').val(data.id);
                $('[name="department_name"]').val(data.department_name);
                //$('[name="department_code"]').val(data.department_code);
                $('[name="description"]').val(data.description);

                $('#department_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Department'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_department(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('con_configaration/delete_entry_department/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#department_divv").load(location.href + " #department_divv");

                    var url = '';
                    view_message(data, url, 'department_Modal', '');
                    
                    setTimeout(function(){ 
                        reload_table('dataTables-example-department');
                    }, 4000);
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });
    }

    //==========================================================================

    $(function () {
        $("#businesstype_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_businesstype') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_businesstype') ?>";
            }
            $.ajax({
                url: url,
                data: $("#businesstype_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#businesstype_div").load(location.href + " #businesstype_div");

                var url = '';
                view_message(data, url, 'businesstype_Modal', 'businesstype_form');
                
                setTimeout(function(){ 
                    reload_table('dataTables-example-businesstype');
                }, 4000);

            });
            event.preventDefault();
        });
    });
    
    function edit_businesstype(id) {
        //alert (id);
        save_method = 'update';
        $('#businesstype_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_businesstype/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="businesstype_id"]').val(data.id);
                $('[name="business_type"]').select2().select2('val', data.business_type);
                load_business_type_categories(data.business_type)
                $('[name="sub_categories"]').select2().select2('val', data.sub_categories);
                $('[name="description"]').val(data.description);

                $('#businesstype_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Business Type'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
    function delete_businesstype(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_businesstype/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#businesstype_div").load(location.href + " #businesstype_div");

                    var url = '';
                    view_message(data, url, 'businesstype_Modal', '');
                    
                    setTimeout(function(){ 
                        reload_table('dataTables-example-businesstype');
                    }, 4000);
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });
    
    }
    
    //==========================================================================
    $(function () {
        $("#payfrequency_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_payfrequency') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_payfrequency') ?>";
            }
            $.ajax({
                url: url,
                data: $("#payfrequency_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $("#payfrequency_div").load(location.href + " #payfrequency_div");
                
                var url = '';
                view_message(data, url, 'payfrequency_Modal', 'payfrequency_form');
                
                setTimeout(function(){ 
                    reload_table('dataTables-example-payfrequency');
                }, 4000);

            });
            event.preventDefault();
        });
    });

    function edit_payfrequency(id) {

        save_method = 'update';
        $('#payfrequency_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_payfrequency/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="payfrequency_id"]').val(data.id);
                $('[name="pay_frequency"]').select2().select2('val', data.freqtype);
                //$('[name="short_code"]').val(data.freqcode);
                $('[name="description"]').val(data.freqdescription);

                $('#payfrequency_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Pay Frequency'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_payfrequency(id) {
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('con_configaration/delete_entry_payfrequency/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#payfrequency_div").load(location.href + " #payfrequency_div");

                    var url = '';
                    view_message(data, url, 'payfrequency_Modal', '');
                    
                    setTimeout(function(){ 
                        reload_table('dataTables-example-payfrequency');
                    }, 4000);
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
         } else {
          swal("Your imaginary file is safe!");
        }
        });

    }

    //==========================================================================

    $(function () {
        $("#jobtitle_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_jobtitle') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_jobtitle') ?>";
            }
            $.ajax({
                url: url,
                data: $("#jobtitle_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#jobtitles_div").load(location.href + " #jobtitles_div");

                var url = '';
                view_message(data, url, 'jobtitle_Modal', 'jobtitle_form');
                
                reload_table('dataTables-example-jobtitles');

            });
            event.preventDefault();
        });
    });

    function edit_jobtitle(id) {
        //alert (id);
        save_method = 'update';
        $('#jobtitle_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_jobtitle/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="jobtitle_id"]').val(data.id);
                $('[name="jobpayfrequency"]').select2().select2('val', data.jobpayfrequency);
                $('[name="jobtitlename"]').val(data.jobtitlename);
                $('[name="jobtitlecode"]').val(data.jobtitlecode);
                $('[name="minexperiencerequired"]').val(data.minexperiencerequired);
                $('[name="jobpaygradecode"]').val(data.jobpaygradecode);
                $('[name="jobdescription"]').val(data.jobdescription);

                $('#jobtitle_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Job Titles'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_jobtitle(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_configaration/delete_entry_jobtitle/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#jobtitles_div").load(location.href + " #jobtitles_div");

                    var url = '';
                    view_message(data, url, '', '');
                    
                    reload_table('dataTables-example-jobtitles');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //==========================================================================

    $(function () {
        $("#position_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_position') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_position') ?>";
            }
            $.ajax({
                url: url,
                data: $("#position_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#position_div").load(location.href + " #position_div");

                var url = '';
                view_message(data, url, 'position_Modal', 'position_form');
                
                setTimeout(function(){ 
                    reload_table('dataTables-example-position');
                }, 4000); 

            });
            event.preventDefault();
        });
    });

    function edit_position(id) {
        //alert (id);
        save_method = 'update';
        $('#position_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_position/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="position_id"]').val(data.id);
                $('[name="job_family"]').select2().select2('val', data.job_family);
                load_positionname(data.job_family);
                $('[name="positionname"]').select2().select2('val', data.positionname);
                $('[name="description"]').val(data.description);
                $('[name="gl_code"]').val(data.gl_code);

                $('#position_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Position'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_position(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_position/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#position_div").load(location.href + " #position_div");
                    
                    var url = '';
                    view_message(data, url, 'position_Modal', '');
                    
                    setTimeout(function(){ 
                        reload_table('dataTables-example-position');
                    }, 4000); 
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#employeestatus_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_employeestatus') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_employeestatus') ?>";
            }
            $.ajax({
                url: url,
                data: $("#employeestatus_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#employeestatus_div").load(location.href + " #employeestatus_div");

                var url = '';
                view_message(data, url, 'employeestatus_Modal', 'employeestatus_form');
                
                setTimeout(function(){ 
                    reload_table('dataTables-example-employeestatus');
                }, 4000); 

            });
            event.preventDefault();
        });
    });

    function edit_employeestatus(id) {

        save_method = 'update';
        $('#employeestatus_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_employeestatus/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="employeestatus_id"]').val(data.id);
                $('[name="workcodename"]').select2().select2('val', data.workcodename);
                //$('[name="workcode"]').val(data.workcode);
                $('[name="description"]').val(data.description);

                $('#employeestatus_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Employee Status'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_employeestatus(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_employeestatus/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#employeestatus_div").load(location.href + " #employeestatus_div");

                    var url = '';
                    view_message(data, url, 'employeestatus_Modal', '');
                    
                    setTimeout(function(){ 
                        reload_table('dataTables-example-employeestatus');
                    }, 4000); 
                
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
       } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#language_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_language') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_language') ?>";
            }
            $.ajax({
                url: url,
                data: $("#language_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $("#com_language_div").load(location.href + " #com_language_div");

                var url = '';
                view_message(data, url, 'language_Modal', 'language_form');
                
                setTimeout(function(){ 
                    reload_table('dataTables-example-language');
                }, 4000); 
                

            });
            event.preventDefault();
        });
    });

    function edit_language(id) {

        save_method = 'update';
        $('#language_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_language/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="language_id"]').val(data.id);
                //$('[name="languagename"]').val(data.languagename);
                $('[name="languagename"]').select2().select2('val', data.languagename);
//                $('[name="description"]').val(data.description);

                $('#language_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Language'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_language(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('con_configaration/delete_entry_language/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_language_div").load(location.href + " #com_language_div");

                    var url = '';
                    view_message(data, url, 'language_Modal', '');
                    
                    setTimeout(function(){ 
                        reload_table('dataTables-example-language');
                    }, 4000); 
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#leavetype_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_leavetype') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_leavetype') ?>";
            }
            $.ajax({
                url: url,
                data: $("#leavetype_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#com_leavetype_div").load(location.href + " #com_leavetype_div");

                var url = '';
                view_message(data, url, 'leavetype_Modal', 'leavetype_form');  
                
                setTimeout(function(){ 
                    
                   reload_table('dataTables-example-leavetype');
                   
                   $("#nonacc_leave_type_div_id").load(location.href + " #nonacc_leave_type_div_id");
                   $("#acc_leave_type_div_id").load(location.href + " #acc_leave_type_div_id");
                   
                }, 4000); 
                
            });
            
            event.preventDefault();
        });
    });

    function edit_leavetype(id) {

        save_method = 'update';
        $('#leavetype_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_leavetype/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="leavetype_id"]').val(data.id);
                $('[name="leavetypeid"]').select2().select2('val', data.leavetype);
                $('[name="state_id"]').select2().select2('val', data.state);
                $('[name="leave_code"]').select2().select2('val', data.leave_code);
                //$('[name="leave_name"]').val(data.leave_code);
                $('[name="leave_short_code"]').val(data.leave_short_code);
                $('[name="is_paid"]').select2().select2('val', data.is_paid);
                $('[name="emp_status"]').select2().select2('val', data.status);
                $('[name="description"]').val(data.description);
                //$('input[name=track_by][value=' + data.track_by + ']').attr('checked', true);

                $('#leavetype_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Leave Type'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_leavetype(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_leavetype/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_leavetype_div").load(location.href + " #com_leavetype_div");

                    var url = '';
                    view_message(data, url, 'leavetype_Modal', '');
                    
                    reload_table('dataTables-example-leavetype');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#education_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_education') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_education') ?>";
            }
            $.ajax({
                url: url,
                data: $("#education_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#com_educationl_div").load(location.href + " #com_educationl_div");

                var url = '';
                view_message(data, url, 'education_Modal', 'education_form');
                
                reload_table('dataTables-example-educationl');

            });
            event.preventDefault();
        });
    });

    function edit_education(id) {

        save_method = 'update';
        $('#education_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_education/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="education_id"]').val(data.id);
                $('[name="educationlevelcode"]').val(data.educationlevelcode);
                $('[name="degree"]').select2().select2('val', data.degree);
                $('[name="description"]').val(data.description);

                $('#education_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Education'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_education(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_education/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_educationl_div").load(location.href + " #com_educationl_div");

                    var url = '';
                    view_message(data, url, 'education_Modal', '');
                    
                    reload_table('dataTables-example-educationl');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#bankaccounttype_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_bankaccounttype') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_bankaccounttype') ?>";
            }
            $.ajax({
                url: url,
                data: $("#bankaccounttype_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
               
                $("#com_bankaccounttype_div").load(location.href + " #com_bankaccounttype_div");

                var url = '';
                view_message(data, url, 'bankaccounttype_Modal', 'bankaccounttype_form');
                
                reload_table('dataTables-example-bankaccounttype');

            });
            event.preventDefault();
        });
    });

    function edit_bankaccounttype(id) {

        save_method = 'update';
        $('#bankaccounttype_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_bankaccounttype/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="bankaccounttype_id"]').val(data.id);
                $('[name="bank_account_type"]').val(data.bank_account_type);
//                $('[name="description"]').val(data.description);

                $('#bankaccounttype_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Bank Account Type'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_bankaccounttype(id) {
       swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_bankaccounttype/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_bankaccounttype_div").load(location.href + " #com_bankaccounttype_div");

                    var url = '';
                    view_message(data, url, 'bankaccounttype_Modal', '');
                    
                    reload_table('dataTables-example-bankaccounttype');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#competencylevels_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_competencylevels') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_competencylevels') ?>";
            }
            $.ajax({
                url: url,
                data: $("#competencylevels_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#com_competencylevels_div").load(location.href + " #com_competencylevels_div");

                var url = '';
                view_message(data, url, 'competencylevels_Modal', 'competencylevels_form');
                
                reload_table('dataTables-example-competencylevels');

            });
            event.preventDefault();
        });
    });

    function edit_competencylevels(id) {

        save_method = 'update';
        $('#competencylevels_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_competencylevels/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="competencylevels_id"]').val(data.id);
                $('[name="competencylevels"]').val(data.competencylevels);
                $('[name="description"]').val(data.description);

                $('#competencylevels_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Competency Levels'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_competencylevels(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_competencylevels/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_competencylevels_div").load(location.href + " #com_competencylevels_div");

                    var url = '';
                    view_message(data, url, 'competencylevels_Modal', '');
                    
                    reload_table('dataTables-example-competencylevels');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#disciplinetype_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_disciplinetype') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_disciplinetype') ?>";
            }
            $.ajax({
                url: url,
                data: $("#disciplinetype_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#com_disciplinetype_div").load(location.href + " #com_disciplinetype_div");

                var url = '';
                view_message(data, url, 'disciplinetype_Modal', 'disciplinetype_form');
                
                reload_table('dataTables-example-disciplinetype');

            });
            event.preventDefault();
        });
    });

    function edit_disciplinetype(id) {

        save_method = 'update';
        $('#disciplinetype_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_disciplinetype/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="disciplinetype_id"]').val(data.id);
                $('[name="discipline_type"]').val(data.discipline_type);
                $('[name="description"]').val(data.description);

                $('#disciplinetype_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Discipline Type'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_disciplinetype(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_disciplinetype/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_disciplinetype_div").load(location.href + " #com_disciplinetype_div");

                    var url = '';
                    view_message(data, url, 'disciplinetype_Modal', '');
                    
                    reload_table('dataTables-example-disciplinetype');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
       } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#com_incidenttype_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_incidenttype') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/edit_incidenttype') ?>";
            }
            $.ajax({
                url: url,
                data: $("#com_incidenttype_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#com_incidenttype_div").load(location.href + " #com_incidenttype_div");

                var url = '';
                view_message(data, url, 'com_incidenttype_Modal', 'com_incidenttype_form');
                
                reload_table('dataTables-example-comincidenttype');

            });
            event.preventDefault();
        });
    });

    function edit_incidenttype(id) {

        save_method = 'update';
        $('#com_incidenttype_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_incidenttype/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="incidenttype_id"]').val(data.id);
                $('[name="incident_type"]').val(data.incident_type);
                $('[name="description"]').val(data.description);

                $('#com_incidenttype_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Incident Type'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_incidenttype(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_incidenttype/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_incidenttype_div").load(location.href + " #com_incidenttype_div");

                    var url = '';
                    view_message(data, url, 'com_incidenttype_Modal', '');
                    
                    reload_table('dataTables-example-comincidenttype');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });
    
    }

    //===========================================================================

    $(function () {
        $("#benefitstype_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_benefitstype') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_benefitstype') ?>";
            }
            $.ajax({
                url: url,
                data: $("#benefitstype_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
               
                $("#com_benefitstype_div").load(location.href + " #com_benefitstype_div");

                var url = '';
                view_message(data, url, 'benefitstype_Modal', 'benefitstype_form');
                
                reload_table('dataTables-example-benefitstype');

            });
            event.preventDefault();
        });
    });

    function edit_benefitstype(id) {

        save_method = 'update';
        $('#benefitstype_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_benefitstype/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="benefitstype_id"]').val(data.id);
                $('[name="benefit_type"]').val(data.benefit_type);
                $('[name="description"]').val(data.description);

                $('#benefitstype_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Benefit Type'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_benefitstype(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_benefitstype/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_benefitstype_div").load(location.href + " #com_benefitstype_div");

                    var url = '';
                    view_message(data, url, 'benefitstype_Modal', '');
                    
                    reload_table('dataTables-example-benefitstype');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });
    
    }

    //==========================================================================

    $(function () {
        $("#benefitsprovider_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_benefitsprovider') ?>";
            } else
            {
                url = "<?php echo site_url('con_configaration/edit_benefitsprovider') ?>";
            }
            $.ajax({
                url: url,
                data: $("#benefitsprovider_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
               
                $("#com_benefitsprovider_div").load(location.href + " #com_benefitsprovider_div");

                var url = '';
                view_message(data, url, 'benefitsprovider_Modal', 'benefitsprovider_form');
                
                reload_table('dataTables-example-benefitsprovider');

            });
            event.preventDefault();
        });
    });

    function edit_benefitsprovider(id) {

        save_method = 'update';
        $('#benefitsprovider_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_benefitsprovider/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="benefitsprovider_id"]').val(data.id);
                $('[name="service_provider_name"]').val(data.service_provider_name);
                $('[name="address1"]').val(data.address1);
                $('[name="address2"]').val(data.address2);
                $('[name="city"]').val(data.city);
                $('[name="states"]').select2().select2('val', data.states);
                load_bp_county(data.state_id);
                $('[name="county"]').select2().select2('val', data.county);
                $('[name="zipcode"]').val(data.zipcode);
                $('[name="contact_name"]').val(data.contact_name);
                $('[name="phone_no"]').val(data.phone_no);
                $('[name="ext"]').val(data.ext);
                $('[name="fax"]').val(data.fax);
                $('[name="email"]').val(data.email);
                $('[name="acc_number"]').val(data.acc_number);

                $('#benefitsprovider_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Benefits Provider'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_benefitsprovider(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_benefitsprovider/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_benefitsprovider_div").load(location.href + " #com_benefitsprovider_div");

                    var url = '';
                    view_message(data, url, 'benefitsprovider_Modal', '');
                    
                    reload_table('dataTables-example-benefitsprovider');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
       } else {
          swal("Your imaginary file is safe!");
        }
    });
    
    }

    //==========================================================================


    $(function () {
        $("#dependent_information").submit(function (event) {
            //loading_box(base_url);

            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_dependent_information') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_dependent_information') ?>";
            }
            $.ajax({
                url: url,
                data: $("#dependent_information").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $("#com_dependentinformation_div").load(location.href + " #com_dependentinformation_div");

                var url = '';
                view_message(data, url, 'dependent_Modal', 'dependent_information');
                
                reload_table('dataTables-example-dependentinformation');
            });
            event.preventDefault();
        });
    });

    function edit_dependent(id) {
        save_method = 'update';
        $('#dependent_information')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_dependent/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="id_dependent"]').val(data.id);
                $('[name="fast_name"]').val(data.fast_name);
                $('[name="middle_name"]').val(data.middle_name);
                $('[name="last_name"]').val(data.last_name);
                $('[name="suffix"]').val(data.suffix);
                $('[name="relationship"]').select2().select2('val', data.relationship);
                $('[name="dependent_birthdate"]').val(show_date_formate_js(data.date_of_birth));
                $('[name="gender"]').select2().select2('val', data.gender);
                $('[name="age"]').val(data.age);
                $('[name="ssn"]').val(data.ssn);
                $('[name="is_collage_student"]').select2().select2('val', data.is_collage_student);
                $('[name="is_tobacco_user"]').select2().select2('val', data.is_tobacco_user);
                $('[name="employee_address"]').val(data.employee_address);


                $('#dependent_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Dependent Information'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_dependent(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_dependent_information/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_dependentinformation_div").load(location.href + " #com_dependentinformation_div");
                    
                    var url = '';
                    view_message(data, url, 'dependent_Modal', '');
                    
                    reload_table('dataTables-example-dependentinformation');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }


    //==========================================================================

    $(function () {
        $("#relationshipstatus_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_relationshipstatus') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/edit_relationshipstatus') ?>";
            }
            $.ajax({
                url: url,
                data: $("#relationshipstatus_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $("#com_relationshipstatus_div").load(location.href + " #com_relationshipstatus_div");

                var url = '';
                view_message(data, url, 'relationshipstatus_Modal', 'relationshipstatus_form');
                
                reload_table('dataTables-example-relationshipstatus');

                $("#relationship_div").load(location.href + " #relationship_div");
                setTimeout(function () {
                    $("#relationship").select2({
                        placeholder: "Select Relationship",
                        allowClear: true,
                    });
                }, 1000);

            });
            event.preventDefault();
        });
    });

    function edit_relationshipstatus(id) {

        save_method = 'update';
        $('#relationshipstatus_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_relationshipstatus/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="relationshipstatus_id"]').val(data.id);
                $('[name="relationship_status"]').val(data.relationship_status);
                $('[name="description"]').val(data.description);

                $('#relationshipstatus_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Dependents'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_relationshipstatus(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_relationshipstatus/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_relationshipstatus_div").load(location.href + " #com_relationshipstatus_div");

                    var url = '';
                    view_message(data, url, 'relationshipstatus_Modal', '');
                    
                    reload_table('dataTables-example-relationshipstatus');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });
    
    }

    //==========================================================================

    $(function () {
        $("#companypolicies_form").submit(function (event) {
            //loading_box(base_url);

            var ckdata = CKEDITOR.instances.custom_text.getData();
            $('#hidden_custom_text').val(ckdata);

            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_companypolicies') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/edit_companypolicies') ?>";
            }

            $.ajax({
                url: url,
                data: $("#companypolicies_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
               
                $("#com_companysolicies_div").load(location.href + " #com_companysolicies_div");

                var url = '';
                view_message(data, url, 'companypolicies_Modal', 'companypolicies_form');
                
                reload_table('dataTables-example-companysolicies');

            });
            event.preventDefault();
        });
    });

    function edit_company_policies(id) {
        save_method = 'update';
        $('#companypolicies_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_companypolicies/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="companypolicies_id"]').val(data.id);
                $('[name="policy_name"]').val(data.policy_name);
                $('[name="description"]').val(data.description);
                $('[name="policy_file_path"]').val(data.policy_file_path);
                
                $('#policy_file_label').empty();
                $('#policy_file_label').html(data.policy_file_path);
                
                //$('[name="is_singture"]').val(data.is_singture);
                $('input[name=is_singture][value=' + data.is_singture + ']').attr('checked', true);

                $('#hidden_custom_text').val('');
                CKEDITOR.instances.custom_text.setData(data.custom_text, function () {
                    this.checkDirty();
                });

                $('#companypolicies_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Company Policies'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_company_policies(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_entry_companypolicies/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_companysolicies_div").load(location.href + " #com_companysolicies_div");

                    var url = '';
                    view_message(data, url, 'companypolicies_Modal', '');
                    
                    reload_table('dataTables-example-companysolicies');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });
    
    }

    $(function () {
        $('#policy_file_form').submit(function (e) {
            e.preventDefault();
            //var base_url = '<?php // echo base_url(); ?>';
            loading_box(base_url);
            $.ajaxFileUpload({
                url: base_url + './Con_configaration/upload_policy_file/',
                secureuri: false,
                fileElementId: 'policy_file',
                dataType: 'JSON',
                success: function (data)
                {
                    var datas = data.split('__');
                    $('#policy_file_path').val(datas[1]);
                    $('#policy_file_label').empty();
                    $('#policy_file_label').html(datas[1]);
                    $('#actual_policy_filename').val(datas[2]);

                    var url = '';
                    view_message(datas[0], url, 'policy_file_Modal', 'policy_file_form');
                }
            });
            return false;
        });
    });

    //==========================================================================

    $(function () {
        $("#eeoc_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_eeoc') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_eeoc') ?>";
            }
            $.ajax({
                url: url,
                data: $("#eeoc_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#eeoccategories_div").load(location.href + " #eeoccategories_div");

                var url = '';
                view_message(data, url, 'eeoc_Modal', 'eeoc_form');
                
                reload_table('dataTables-example-eeoccategories');
                
            });
            event.preventDefault();
        });
    });

    function edit_eeoc(id) {
        save_method = 'update';
        $('#eeoc_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_eeoc/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="id_eeoc"]').val(data.id);
                $('[name="eeoc_categories"]').val(data.eeoc_categories);
                $('[name="description"]').val(data.description);

                $('#eeoc_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit EEOC'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_eeoc(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_eeoc/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#eeoccategories_div").load(location.href + " #eeoccategories_div");

                    var url = '';
                    view_message(data, url, 'eeoc_Modal', '');
                    
                    reload_table('dataTables-example-eeoccategories');
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#assetstype_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_assetstype') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_assetstype') ?>";
            }
            $.ajax({
                url: url,
                data: $("#assetstype_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $("#com_assetstype_div").load(location.href + " #com_assetstype_div");

                var url = '';
                view_message(data, url, 'assetstype_Modal', 'assetstype_form');
                
                reload_table('dataTables-example-assetstype');

                $("#assetscategory").load(location.href + " #assetscategory");
            });
            event.preventDefault();
        });
    });

    function edit_assetstype(id) {
        save_method = 'update';
        $('#assetstype_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_assetstype/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="assetstype_id"]').val(data.id);
                $('[name="asset_type"]').val(data.asset_type);
                $('[name="description"]').val(data.description);

                $('#assetstype_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Assets Type'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_assetstype(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_assetstype/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_assetstype_div").load(location.href + " #com_assetstype_div");

                    var url = '';
                    view_message(data, url, 'assetstype_Modal', '');
                    
                    reload_table('dataTables-example-assetstype');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#assetscategory_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_assetscategory') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_assetscategory') ?>";
            }
            $.ajax({
                url: url,
                data: $("#assetscategory_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $("#assetsname").load(location.href + " #assetsname");
                $("#com_assetscategory_div").load(location.href + " #com_assetscategory_div");

                var url = '';
                view_message(data, url, 'assetscategory_Modal', 'assetscategory_form');
                
                reload_table('dataTables-example-assetscategory');

            });
            event.preventDefault();
        });
    });

    function edit_assetscategory(id) {
        save_method = 'update';
        $('#assetscategory_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_assetscategory/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="assetscategory_id"]').val(data.id);
                $('[name="asset_type_iddd"]').select2().select2('val', data.asset_type_id);
                $('[name="asset_category"]').val(data.asset_category);
                $('[name="description"]').val(data.description);

                $('#assetscategory_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Assets Category'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_assetscategory(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_assetscategory/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#com_assetscategory_div").load(location.href + " #com_assetscategory_div");

                    var url = '';
                    view_message(data, url, 'assetscategory_Modal', '');
                    
                    reload_table('dataTables-example-assetscategory');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#assetsname_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_assetsname') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_assetsname') ?>";
            }
            $.ajax({
                url: url,
                data: $("#assetsname_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#assetsname_div").load(location.href + " #assetsname_div");

                var url = '';
                view_message(data, url, 'assetsname_Modal', 'assetsname_form');
                
                reload_table('dataTables-example-assetsname');
            });
            event.preventDefault();
        });
    });

    function edit_assetsname(id) {
        save_method = 'update';
        $('#assetsname_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_assetsname/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="assetsname_id"]').val(data.id);
                $('[name="asset_type_idd"]').select2().select2('val', data.asset_type_id);
                filter_asset_category(data.asset_type_id);
                $('[name="asset_category_idd"]').select2().select2('val', data.asset_category_id);
                $('[name="asset_name"]').val(data.asset_name);
                $('[name="description"]').val(data.description);

                $('#assetsname_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Assets Name'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_assetsname(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_assetsname/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#assetsname_div").load(location.href + " #assetsname_div");

                    var url = '';
                    view_message(data, url, 'assetsname_Modal', '');
                    
                    reload_table('dataTables-example-assetsname');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    $(function () {
        $("#assetregister_form").submit(function (event) {
            //loading_box(base_url);

            $('#asset_type_id').removeAttr('disabled');
            $("#asset_category_id").removeAttr('disabled');
            $("#asset_name_id").removeAttr('disabled');

            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_AssetsInformation') ?>";
            } else if (save_method == 'unique_update')//unique_update
            {
                url = "<?php echo site_url('Con_configaration/update_Assets_Unique_Information') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_AssetsInformation') ?>";
            }

            $.ajax({
                url: url,
                data: $("#assetregister_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#com_assetregister_div").load(location.href + " #com_assetregister_div");
                //reload_table('dataTables-example-assetregister');

                var url = '';
                view_message(data, url, 'assetregister_Modal', 'assetregister_form');

            });
            event.preventDefault();
        });
    });

    function edit_assetregister(id) {

        save_method = 'update';
        $('#assetregister_form')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_AssetsInformation/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.asset_type_id);
                $('[name="asset_mst_id"]').val(data.id);
                $('[name="asset_type_id"]').select2().select2('val', data.asset_type_id);
                load_asset_categori(data.asset_type_id);
                $('[name="asset_category_id"]').select2().select2('val', data.asset_category_id);
                load_asset_name(data.asset_category_id);
                $('[name="asset_name_id"]').select2().select2('val', data.asset_name_id);
                set_asset_name(data.asset_name_id);
                $('[name="quantity"]').val(data.quantity);

                load_asset_dtls(data.id);

                //$('#assetregister_Modal').modal('show'); // show bootstrap modal when complete loaded
                //$('.modal-title').text('Edit Asset Register'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function load_asset_dtls(id) {

        $.ajax({
            url: "<?php echo site_url('Con_configaration/load_asset_dtls/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#mytbody').html('');
                $('#mytbody').empty();

                $('#mytbody').html(data);

                $('#asset_type_id').attr('disabled', true);
                $("#asset_category_id").attr('disabled', true);
                $("#asset_name_id").attr('disabled', true);

                $('#assetregister_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Asset Register'); // Set title to Bootstrap modal title
            }
        })

    }

    function edit_asset_unique_register(id, dtlse_id) {

        save_method = 'unique_update';
        $('#assetregister_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_Assets_Unique_Information/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="asset_mst_id"]').val(data.id);
                $('[name="asset_type_id"]').select2().select2('val', data.asset_type_id);
                load_asset_categori(data.asset_type_id);
                $('[name="asset_category_id"]').select2().select2('val', data.asset_category_id);
                load_asset_name(data.asset_category_id);
                $('[name="asset_name_id"]').select2().select2('val', data.asset_name_id);
                set_asset_name(data.asset_name_id);
                $('[name="quantity"]').val(data.quantity);

                load_asset_unique_dtls(dtlse_id);

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function load_asset_unique_dtls(dtlse_id) {

        $.ajax({
            url: "<?php echo site_url('Con_configaration/load_asset_unique_dtls/') ?>/" + dtlse_id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {

                var rowCount = $('#mytbody tr').length;
                for (var i = 1; i < rowCount; i++) {
                    $("#mytbody tr:last").remove();
                }


                $('#dtls_id_1').val(data.id);
                $('#asset_name_1').val(data.asset_id);
                $('#model_name_1').val(data.model_name);
                $('#serial_no_1').val(data.serial_no);
                $('#value_1').val(data.value);
                $('#description_1').val(data.description);

                $("#asset_type_id").prop("disabled", true);
                $("#asset_category_id").prop("disabled", true);
                $("#asset_name_id").prop("disabled", true);

                $("#add_1").removeAttr("href");
                $("#add_1").addClass("disabled");

                $("#remove_1").removeAttr("href");
                $("#remove_1").addClass("disabled");

                $('#assetregister_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Asset Register'); // Set title to Bootstrap modal title
            }
        })

    }

    $(function () {
        $("#add_asset_entry").submit(function (event) {
            //loading_box(base_url);

            var typ = $('#asset_type_id').val();
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_aassetsname') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/save_aassetsname') ?>";
            }
            $.ajax({
                url: url,
                data: $("#add_asset_entry").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                load_asset_categori(typ);

                var url = '';
                view_message(data, url, 'asset_Modal_entry', 'add_asset_entry');

                setTimeout(function () {

                    var cat = $('#asset_category_id').val();
                    load_asset_name(cat);

                }, 1000);

            });
            event.preventDefault();
        });
    });

    //==========================================================================

    $(function () {
        $("#alertpolicy_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_alertpolicy') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_alertpolicy') ?>";
            }
            $.ajax({
                url: url,
                data: $("#alertpolicy_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
               
                $("#alertpolicy_div").load(location.href + " #alertpolicy_div");

                var url = '';
                view_message(data, url, 'alertpolicy_Modal', 'alertpolicy_form');
                
                setTimeout(function(){ 
                    reload_table('dataTables-example-alertpolicy');
                }, 4000);
            });
            event.preventDefault();
        });
    });

    function edit_alertpolicy(id) {
        save_method = 'update';
        $('#alertpolicy_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_alertpolicy/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="alertpolicy_id"]').val(data.id);
                //$('[name="alert_item"]').val(data.alert_item);
                $('[name="alert_item"]').select2().select2('val', data.alert_item);
                $('[name="alert_status"]').select2().select2('val', data.alert_status);
                $('[name="alert_after_days"]').val(data.alert_after_days);
                $('[name="alert_message_template"]').val(data.alert_message_template);

                $('#alertpolicy_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Alert Policy'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_alertpolicy(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_alertpolicy/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#alertpolicy_div").load(location.href + " #alertpolicy_div");

                    var url = '';
                    view_message(data, url, 'alertpolicy_Modal', '');
                    
                    setTimeout(function(){ 
                        reload_table('dataTables-example-alertpolicy');
                    }, 4000);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }

    //==========================================================================

    //==========================================================================

    $(function () {
        $("#leavepolicy_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_leavepolicy') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/edit_leavepolicy') ?>";
            }
            $.ajax({
                url: url,
                data: $("#leavepolicy_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $("#com_leavepolicy_div").load(location.href + " #com_leavepolicy_div");

                var url = '';
                view_message(data, url, 'leavepolicy_Modal', 'leavepolicy_form');
                
                setTimeout(function(){ 
                    reload_table('dataTables-example-leavepolicy');
                }, 4000); 

            });
            event.preventDefault();
        });
    });

    function edit_leavepolicy(id) {

        save_method = 'update';
        $('#leavepolicy_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_configaration/ajax_edit_leavepolicy/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                
                $('[name="leavepolicy_id"]').val(data.id);
                $('[name="leave_type"]').select2().select2('val', data.leave_type);
                $('[name="employee_type"]').select2().select2('val', data.employee_type);
                $('[name="applicable"]').select2().select2('val', data.applicable);
                $('[name="leave_year"]').val(data.leave_year);
                $('[name="fractional_leave"]').select2().select2('val', data.fractional_leave);
                $('[name="off_day_leave_count"]').select2().select2('val', data.off_day_leave_count);
                $('[name="max_limit"]').val(data.max_limit);
                $('[name="leave_status"]').select2().select2('val', data.isactive);
               
                $('#leavepolicy_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Leave Policy'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

//    function delete_leavepolicy(id) {
//        var r = confirm("Do you want to delete this?")
//        if (r == true)
//        {
//            $.ajax({
//                url: "<?php // echo site_url('con_configaration/delete_entry_language/') ?>/" + id,
//                type: "POST",
//                success: function (data)
//                {
//                    $("#com_language_div").load(location.href + " #com_language_div");
//
//                    var url = '';
//                    view_message(data, url, '', '');
//                    
//                    setTimeout(function(){ 
//                        reload_table('dataTables-example-language');
//                    }, 4000); 
//                    
//                },
//                error: function (jqXHR, textStatus, errorThrown)
//                {
//                    alert('Error get data from ajax');
//                }
//            });
//        } else
//            return false;
//
//    }

    //==========================================================================
    //===================== start Accrual information ==========================

    $(function () {
        $("#com_pto_main_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_pto_policy') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_pto_policy') ?>";
            }
            $.ajax({
                url: url,
                data: $("#com_pto_main_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#ptopolicy_div").load(location.href + " #ptopolicy_div");

                var url = '';
                view_message(data, url, 'main_pto_policy_Modal', 'com_pto_main_form');
                
                reload_table('dataTables-example-ptopolicy');

            });
            event.preventDefault();
        });
    });

    function edit_pto_settings(id) {

        save_method = 'update';
        //$('#main_pto_policy_Modal')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_ptopolicy/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.id);
                //paid_leave_type
                $('[name="com_pto_settings_id"]').val(data.id);
                $('[name="paid_leave_type"]').select2().select2('val', data.paid_leave_type);
                $('[name="paid_description"]').val(data.paid_description);
                //$('[name="report_description"]').val(data.report_description);
                $('[name="method"]').select2().select2('val', data.method);
                $('input[name=hourly_allowance_option][value=' + data.hourly_allowance_option + ']').attr('checked', true);
                if (data.hourly_allowance_option == 1)
                {
                    $('[name="fixed_amount"]').val(data.fixed_amount);
                    $('#fixed_amount').removeAttr("readonly");
                    $('#leave_table').attr("disabled", true);
                    $('#limit_row').show();
                    $('#graduated_table_content').css('display','none');
                } else
                {
                    $('[name="fixed_amount"]').val('');
                    $('#leave_table').removeAttr("disabled");
                    $('#fixed_amount').attr("readonly", true);
                    $('#limit_row').css('display','none');
                    $('#graduated_table_content').show();
                }

                if (data.ot_hour == 1)
                {
                    $('input[name=ot_hour][value=' + data.ot_hour + ']').attr('checked', true);
                }

                if (data.dt_hour == 1)
                {
                    $('input[name=dt_hour][value=' + data.dt_hour + ']').attr('checked', true);
                }
                if (data.accruable_benefit_hour == 1)
                {
                    $('input[name=accruable_benefit_hour][value=' + data.accruable_benefit_hour + ']').attr('checked', true);
                }

                $('[name="benefit_accrual_until"]').val(data.benefit_accrual_until);
                $('[name="hire_date_leave"]').val(show_date_formate_js(data.hire_date_leave));
                $('[name="accrual_hours_availability_until"]').val(data.accrual_hours_availability_until);
                $('[name="hire_date"]').val(show_date_formate_js(data.hire_date));
                $('[name="available_limit"]').val(data.available_limit);
                //$('[name="per_check_limit"]').val(data.per_check_limit);
                $('[name="annual_limit"]').val(data.annual_limit);
                //$('[name="per_month_limit"]').val(data.per_month_limit);
                $('[name="balanced_method"]').val(data.balanced_method);
                if (data.reset_beginning_balance == 1)
                {
                    $('input[name=reset_beginning_balance][value=' + data.reset_beginning_balance + ']').attr('checked', true);
                }
                $('[name="balanced_date"]').val(show_date_formate_js(data.balanced_date));
                $('[name="carryover_maximum"]').val(data.carryover_maximum);
                $('input[name=pay_period_spans][value=' + data.pay_period_spans + ']').attr('checked', true);
                $('[name="workers_compensation"]').select2().select2('val', data.workers_compensation);

                load_graduated_table_data(id);

                $('#main_pto_policy_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Accrual Leave Policy'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }



    function load_graduated_table_data(id) {

        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_ptopolicy_dtls/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert (data.id);

                $('[name="hidden_hourly_allowance_option"]').val(data.hourly_allowance_option);
                $('[name="hidden_graduated_form"]').val(data.graduated_form);
                $('[name="hidden_graduated_to"]').val(data.graduated_to);
                $('[name="hidden_hourly_allowance"]').val(data.hourly_allowance);
                $('[name="hidden_available_limit"]').val(data.available_limit);
                //$('[name="hidden_check_limit"]').val(data.check_limit);
                //$('[name="hidden_month_limit"]').val(data.month_limit);
                $('[name="hidden_annual_limit"]').val(data.annual_limit);
                $('[name="hidden_carryover_maximum"]').val(data.carryover_maximum);
                
                show_graduated_table();

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    }
    
    function show_graduated_table(){
        
        var val_hourly_allowance_option = $('#hidden_hourly_allowance_option').val();
        var val_graduated_form = $('#hidden_graduated_form').val();
        var val_graduated_to = $('#hidden_graduated_to').val();
        var val_hourly_allowance = $('#hidden_hourly_allowance').val();
        var val_available_limit = $('#hidden_available_limit').val();
        //var val_check_limit = $('#hidden_check_limit').val();
        //var val_month_limit = $('#hidden_month_limit').val();
        var val_annual_limit = $('#hidden_annual_limit').val();
        var val_carryover_maximum = $('#hidden_carryover_maximum').val();

        var arr_graduated_form = val_graduated_form.split(',');
        var arr_graduated_to = val_graduated_to.split(',');
        var arr_hourly_allowance = val_hourly_allowance.split(',');
        var arr_available_limit = val_available_limit.split(',');
        //var arr_check_limit = val_check_limit.split(',');
        //var arr_month_limit = val_month_limit.split(',');
        var arr_annual_limit = val_annual_limit.split(',');
        var arr_carryover_maximum = val_carryover_maximum.split(',');
 
        //alert (arr_graduated_form);
        
        $('#graduated_table_label').html('');
        $('#graduated_table_label').append('<u><h4> Graduated Accrual Table : </h4></u>');
        
        $("#graduated_table tr").remove();
        $('#graduated_table').append(
            '<tr>'
            + '<td>From</td>'
            + '<td>TO</td>'
            + '<td>Hourly Allowance</td>'
            + '<td>Available Limit</td>'
            + '<td>Annual Limit</td>'
            + '<td>Carryover Maximum</td>'
            + '</tr>'
        );

        for (var i = 0; i <= arr_graduated_form.length-1; i++) {
            
            $('#graduated_table').append(
                '<tr>'
                    + '<td>'+ arr_graduated_form[ i ] +'</td>'
                    + '<td>'+ arr_graduated_to[ i ] +'</td>'
                    + '<td>'+ arr_hourly_allowance[ i ] +'</td>'
                    + '<td>'+ arr_available_limit[ i ] +'</td>'
                    + '<td>'+ arr_annual_limit[ i ] +'</td>'
                    + '<td>'+ arr_carryover_maximum[ i ] +'</td>'
                + '</tr>'
            );

        }
        
    }

    //==========================================================================
    
    //==========================================================================

    $(function () {
        $("#WageCompensation_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_WageCompensation') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_WageCompensation') ?>";
            }
            $.ajax({
                url: url,
                data: $("#WageCompensation_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
               
                $("#WageCompensation_div").load(location.href + " #WageCompensation_div");

                var url = '';
                view_message(data, url, 'WageCompensation_Modal', 'WageCompensation_form');
                
                reload_table('dataTables-example-WageCompensation');
            });
            event.preventDefault();
        });
    });

    function edit_WageCompensation(id) {
    //alert (id);
        save_method = 'update';
        $('#WageCompensation_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_WageCompensation/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="wage_id"]').val(data.id);
                $('[name="wage_position"]').select2().select2('val', data.position);
                $('[name="wage_gl_code"]').val(data.gl_code);
                $('[name="wage_type"]').select2().select2('val', data.wage_type);
                change_rate_option(data.wage_type);
                $('[name="hourly_rate"]').val(data.hourly_rate);

                $('#WageCompensation_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Wage & Compensation'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_WageCompensation(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_WageCompensation/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#WageCompensation_div").load(location.href + " #WageCompensation_div");

                    var url = '';
                    view_message(data, url, 'WageCompensation_Modal', '');
                    
                    reload_table('dataTables-example-WageCompensation');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }
    
    //==========================================================================

    //============================API Setting===================================

    $(function () {
        $("#apisetting_form").submit(function (event) {
            //loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_apisetting') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_apisetting') ?>";
            }
            $.ajax({
                url: url,
                data: $("#apisetting_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
               
                $("#apisetting_div").load(location.href + " #apisetting_div");

                var url = '';
                view_message(data, url, 'apisetting_Modal', 'apisetting_form');
                
                reload_table('dataTables-example-apisetting');
            });
            event.preventDefault();
        });
    });

    function edit_apisetting(id) {
    
        save_method = 'update';
        $('#apisetting_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_apisetting/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="apisetting_id"]').val(data.id);
                $('[name="secret_type"]').select2().select2('val', data.api_secret_type);
                $('[name="accountant"]').val(data.accountant);
                $('[name="site"]').val(data.site);
                $('[name="api_secret"]').val(data.api_secret);

                $('#apisetting_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit API Setting'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_apisetting(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_apisetting/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#apisetting_div").load(location.href + " #apisetting_div");

                    var url = '';
                    view_message(data, url, 'apisetting_Modal', '');
                    
                    reload_table('dataTables-example-apisetting');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }
    
    //==========================================================================


    //============================job posting API===================================

    $(function () {
        $("#jobposting_form").submit(function (event) {
            //loading_box(base_url);
            //alert ('lllllll');
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_jobposting') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/update_jobposting') ?>";
            }
            //alert (url);
            $.ajax({
                url: url,
                data: $("#jobposting_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
               
                $("#jobposting_div").load(location.href + " #jobposting_div");

                var url = '';
                view_message(data, url, 'jobposting_Modal', 'jobposting_form');
                
                reload_table('dataTables-example-jobposting');
            });
            event.preventDefault();
        });
    });

    function edit_jobposting(id) {
    
        save_method = 'update';
        $('#jobposting_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_configaration/ajax_edit_jobposting/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="jobposting_id"]').val(data.id);
                $('[name="secret_type"]').select2().select2('val', data.api_secret_type);
                $('[name="accountant"]').val(data.accountant);
                $('[name="site"]').val(data.site);
                $('[name="api_secret"]').val(data.api_secret);

                $('#jobposting_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Job Posting API'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_jobposting(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }) .then(function(willDelete) {
        if (willDelete) {
            
            $.ajax({
                url: "<?php echo site_url('Con_configaration/delete_jobposting/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#jobposting_div").load(location.href + " #jobposting_div");

                    var url = '';
                    view_message(data, url, 'jobposting_Modal', '');
                    
                    reload_table('dataTables-example-jobposting');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        } else {
          swal("Your imaginary file is safe!");
        }
    });

    }
    
    //==========================================================================

</script>


