<?php
$employee_data = $this->session->userdata('employee');
$employee_id = $employee_data['employee_id'];
if ($employee_id == "" || $employee_id == null) {
    $chk_emp = 0;
} else {
    $chk_emp = 1;
}
?>
<script type="text/javascript">
    var is_employee = <?php echo $chk_emp; ?>;
    $(document).ready(function () {
        $("a[data-toggle='tab'").prop('disabled', true);

        $("a[data-toggle='tab']").click(function (e) {
            var target = $(e.target).text();
            if ($('#employee_id').val() == "")
            {
                alert('Please add the Employee first to add his ' + target + '.');
            }
        });
    });

    function enable_tabs()
    {
        $("a[data-toggle='tab'").prop('disabled', false);
        //$('.nav-tabs a[href="#education"]').tab('show');
    }

    function activaTab(tab) {
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    }
    ;

    if (is_employee == 1)
    {
        $(window).load(function () {
            enable_tabs();
        });
    }
</script>   

<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
                <div class="pull-right" id="employee_name_div" ><?php
                    if ($type == 2) {
                        if ($emp_pic == "") {
                            $emp_pic_src = base_url() . "uploads/blank.png";
                        } else {
                            $emp_pic_src = base_url() . "uploads/emp_image/" . $emp_pic;
                        }
                        ?>
                        <img class="rounded-x" src="<?php echo $emp_pic_src; ?>" alt="" height="40" width="40">
                        <?php
                        echo " " . $return_name;
                    }
                    ?>
                </div>
            </ol>
        </div>

        <div class="container" style="margin-top: 0px; padding-bottom: 15px;">
            <?php
            if ($type == 1 || $type == 2) { //entry and edit
                ?>
                <div class="row tab-v3">
                    <div class="col-sm-2" id="tabs"> <!-- required for floating -->
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-pills nav-stacked">
                            <li class="active"><a href="#empbasic" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Employee Details</a></li>
                            <li class=""><a href="#WorkRelated" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Work Related</a></li>
                            <li class=""><a href="#WageCompensation" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Wage & Compensation </a></li>
                            <li class=""><a href="#AssetTracking" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Asset Tracking</a></li>
                            <li class=""><a href="#Education" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Education</a></li>
                            <li class=""><a href="#Experience" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Experience</a></li>
                            <li class=""><a href="#Skills" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Skills</a></li>
                            <li class=""><a href="#EmpLanguages" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Languages</a></li>
                            <li class=""><a href="#TrainingCertification" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Training & Certification</a></li>
                            <li class=""><a href="#License" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> License</a></li>
                            <li class=""><a href="#AbsenceTracking" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Absence Tracking</a></li>
                            <li class=""><a href="#EmergencyContact" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Emergency Contact</a></li>
                            <li class=""><a href="#Actions" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Actions</a></li>
                            <li class=""><a href="#enrolling" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Enrolling</a></li>
                            <li class=""><a href="#BenefitsTracking" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Benefits Tracking</a></li>  
                            <li class=""><a href="#PTO" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Accrual Leaves </a></li>
                            <li class=""><a href="#policyreview" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Policy Review</a></li>
                            <!--<li class=""><a href="#separation" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Separation</a></li>-->
                            <li class=""><a href="#passwordtab" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Password </a></li>
                            <li class=""><a href="#review" data-toggle="tab"><i class="fa fa-chevron-circle-right"></i> Review</a></li>
                        </ul>
                    </div>

                    <div class="col-sm-10">
                        <!-- Tab panes -->
                        <div class="tab-content tag-box tag-box-v3">
                            <div class="tab-pane active" id="empbasic"><?php include_once( "tab/emp_basic.php" ); ?> </div>
                            <div class="tab-pane" id="WorkRelated"><?php include_once( "tab/work_related.php" ); ?> </div>
                            <div class="tab-pane" id="WageCompensation"><?php include_once( "tab/Wage_Compensation.php" ); ?> </div>
                            <div class="tab-pane" id="AssetTracking"><?php include_once( "tab/assets.php" ); ?> </div>
                            <div class="tab-pane" id="Education"><?php include_once( "tab/education.php" ); ?></div>
                            <div class="tab-pane" id="Experience"><?php include_once( "tab/experiences.php" ); ?></div>
                            <div class="tab-pane" id="Skills"><?php include_once("tab/skills.php"); ?></div>
                            <div class="tab-pane" id="EmpLanguages"><?php include_once("tab/emp_languages.php"); ?></div>
                            <div class="tab-pane" id="TrainingCertification"><?php include_once("tab/training_certification.php"); ?></div>
                            <div class="tab-pane" id="License"><?php include_once("tab/license.php"); ?></div>
                            <div class="tab-pane" id="AbsenceTracking"><?php include_once("tab/absencetracking.php"); ?></div>
                            <div class="tab-pane" id="EmergencyContact"><?php include_once("tab/emergencycontact.php"); ?></div>
                            <div class="tab-pane" id="Actions"><?php include_once("tab/actions.php"); ?></div>
                            <div class="tab-pane" id="enrolling"><?php include_once("tab/emp_enrolling.php"); ?></div>
                            <div class="tab-pane" id="BenefitsTracking"><?php include_once("tab/benefitstracking.php"); ?></div>
                            <div class="tab-pane" id="PTO"><?php include_once("tab/pto.php"); ?></div>
                            <div class="tab-pane" id="policyreview"><?php include_once("tab/policyreview.php"); ?></div>
                            <!--<div class="tab-pane" id="separation"><?php // include_once("tab/separation.php"); ?></div>-->
                            <div class="tab-pane" id="passwordtab"><?php include_once("tab/password.php"); ?></div>
                            <div class="tab-pane" id="review"><?php include_once("tab/review.php"); ?></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script>

    //==========================================================================

    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);

            var canvas = document.getElementById('jSignature');
            var canvasData = canvas.toDataURL("image/png");
            
            if(canvasData=="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPIAAAA9CAYAAACX1jTFAAAAaElEQVR4nO3TsQ0AIAwEsYz7izEndIgWGlLY0o1wVQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAI0kGUmmpOvG73+3GFl6rc/IAAAAAAAAAAAAAJwWvn6YJn2027wAAAAASUVORK5CYII=")
            {
                //$('#scanvasData').val('');
            }
            else {
                $('#scanvasData').val(canvasData);
            }
        
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //alert (data);

                var datas = data.split('_');
                $('#employee_id').val(datas[1]);
                $('#id').val(datas[3]);
                
                if (datas[1])
                {
                    enable_tabs();
                }

                $("#wage_compensation_div").load(location.href + " #wage_compensation_div");

                var url = '';
                view_message(datas[0], url,'','');

                if (datas[2])
                {
                    $('#employee_name_div').html(datas[2]);
                }

                $("#employee_review_div").load(location.href + " #employee_review_div");
                $("#sep_emp_div").load(location.href + " #sep_emp_div");

                reload_table('dataTables-example-compensation');
                
            });
            event.preventDefault();
        });
    });


    //==========================================================================

    $(function () {
        $("#emp_image").submit(function (e) {
            e.preventDefault();
            //var base_url = '<?php // echo base_url();  ?>';
            $.ajaxFileUpload({
                url: base_url + './con_Employees/upload_profile_pic/',
                secureuri: false,
                fileElementId: 'emp_profile_pic',
                dataType: 'JSON',
                success: function (data)
                {
                    var datas = data.split('__');
                    var path = base_url + 'uploads/emp_image/';
                    //alert (path);
                    $('#img_path').val(path + datas[1]);
                    $('#image_name').val(datas[1]);
                    $("#my_image").removeAttr("src").attr("src", path + datas[1]);

                    $('#emp_image')[0].reset();
                    $('#image_Modal').modal('hide');
                }
            });
            return false;
        });
    });

    //========================================== Work Related ===================

    $(function () {
        $("#work_related").submit(function (event) {

            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#work_related").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '';
                view_message(data, url, '', 'work_related');

                $("#employee_review_div").load(location.href + " #employee_review_div");
                $("#sep_emp_div").load(location.href + " #sep_emp_div");

            });
            event.preventDefault();
        });
    });

    //===================================end work related=======================

    //================================== Wage Compensation =====================

    $(function () {
        $("#wage_compensation_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employees/save_emp_wage_compensation') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Employees/edit_emp_wage_compensation') ?>";
            }
            $.ajax({
                url: url,
                data: $("#wage_compensation_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#emp_wage_compensation_div").load(location.href + " #emp_wage_compensation_div");

                var url = '';
                view_message(data, url, 'wage_compensation_Modal', 'wage_compensation_form');

                reload_table('dataTables-example-emp_wage_compensation');

                $("#employee_review_div").load(location.href + " #employee_review_div");
                $("#sep_emp_div").load(location.href + " #sep_emp_div");
            });
            event.preventDefault();
        });
    });

    function edit_wage_compensation(id) {

        save_method = 'update';
        $('#wage_compensation_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_Employees/ajax_edit_wage_compensation/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="id_emp_wage"]').val(data.id);
                $('[name="emp_wage_position"]').select2().select2('val', data.position);
                $('[name="pay_schedule"]').select2().select2('val', data.pay_schedule);
                $('[name="wage_salary_type"]').select2().select2('val', data.wage_salary_type);
                change_salary_rate(data.wage_salary_type);
                $('[name="hours_per_pay_period"]').val(data.hours_per_pay_period);
                $('[name="per_hour_rate"]').val(data.per_hour_rate);
                $('[name="per_pay_period_salary"]').val(data.per_pay_period_salary);
                $('[name="yearly_salary"]').val(data.yearly_salary);
                $('[name="wage_date"]').val(show_date_formate_js(data.wage_date));
                $('[name="wage_status"]').select2().select2('val', data.status);

                $('#wage_compensation_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Employee Wage Compensation'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_wage_compensation(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('Con_Employees/delete_entry_wage_compensation/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#emp_wage_compensation_div").load(location.href + " #emp_wage_compensation_div");

                    var url = '';
                    view_message(data, url, '', '');

                    reload_table('dataTables-example-emp_wage_compensation');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //================================= Wage Compensation ======================

    //===================================asset==================================

    $(function () {
        $("#emp_asset").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employees/save_emp_asset') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Employees/edit_emp_asset') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_asset").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
//                    $('#emp_asset')[0].reset();
                //$('#assets_Modal').modal('hide');
                $("#asset_div").load(location.href + " #asset_div");
                reload_table('dataTables-example-assets');

                var url = '';
                view_message(data, url, 'assets_Modal', 'emp_asset');

                $("#employee_review_div").load(location.href + " #employee_review_div");
                $("#sep_emp_div").load(location.href + " #sep_emp_div");
            });
            event.preventDefault();
        });
    });

    function edit_assets(id) {
        //alert (id);
        save_method = 'update';
        $('#emp_asset')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_assets/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                //alert(data.id);
                $('[name="id_emp_asset"]').val(data.id);
                $('[name="asset_id"]').select2().select2('val', data.asset_id);
                $('[name="asset_type_id"]').select2().select2('val', data.asset_type_id);
                load_asset_categori(data.asset_type_id);
                $('[name="asset_category_id"]').select2().select2('val', data.asset_category_id);
                load_asset_name(data.asset_category_id);
                $('[name="asset_id"]').select2().select2('val', data.asset_id);
                load_model_id(data.asset_id);
                $('[name="asset_model_id"]').select2().select2('val', data.asset_model_id);
                $('[name="issued_date"]').val(show_date_formate_js(data.issued_date));
                $('[name="retuned_date"]').val(show_date_formate_js(data.retuned_date));
                $('[name="quantity"]').val(data.quantity);
                $('[name="value"]').val(data.value);

                $('#assets_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Assets'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_assets(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_assets/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#asset_div").load(location.href + " #asset_div");
                    reload_table('dataTables-example-assets');

                    var url = '';
                    view_message(data, url, '', '');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    $(function () {
        $("#return_asset").submit(function (event) {
            var url;
            if (save_method == 'update')
            {
                url = "<?php echo site_url('con_Employees/return_asset') ?>";
            }
            $.ajax({
                url: url,
                data: $("#return_asset").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#asset_div").load(location.href + " #asset_div");
                reload_table('dataTables-example-assets');

                var url = '';
                view_message(data, url, 'assets_return_Modal', 'return_asset');
            });
            event.preventDefault();
        });
    });

    //=====================================end asset============================

    //=====================================education============================

    $(function () {
        $("#emp_education").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_education') ?>";
                //var url = $(this).attr('action');
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_education') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_education").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
//                    $('#emp_education')[0].reset();
                //$('#Coy_Modal').modal('hide');

                $("#education_div").load(location.href + " #education_div");
                reload_table('dataTables-example-edu');
                var url = '';
                view_message(data, url, 'Coy_Modal', 'emp_education');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    function edit_education(id) {
        //alert (id);
        save_method = 'update';
        $('#emp_education')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.id);
                $('[name="id_emp_education"]').val(data.id);
                $('[name="educationlevel"]').select2().select2('val', data.educationlevel);
                $('[name="institution_name"]').val(data.institution_name);
                $('[name="no_of_years"]').val(data.no_of_years);
                $('[name="certification_degree"]').val(data.certification_degree);
                $('[name="edu_remarks"]').val(data.edu_remarks);
                //$('[name="opening_date"]').val(data.setup_date);
                //$('[name="c_status"]').select2().select2('val', data.status);

                $('#Coy_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Company'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_education(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_education/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#education_div").load(location.href + " #education_div");
                    reload_table('dataTables-example-edu');

                    var url = '';
                    view_message(data, url, '', '');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //=======================================end education======================

    //=====================================experience===========================

    $(function () {
        $("#emp_experience").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_experience') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_experience') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_experience").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

//                    $('#emp_experience')[0].reset();
                //$('#Experience_Modal').modal('hide');

                $("#experience_div").load(location.href + " #experience_div");
                reload_table('dataTables-example-experience');
                var url = '';
                view_message(data, url, 'Experience_Modal', 'emp_experience');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    function edit_experience(id) {
        save_method = 'update';
        $('#emp_experience')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_experience/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.id);
                $('[name="id_emp_experience"]').val(data.id);
                $('[name="comp_name"]').val(data.comp_name);
                $('[name="emp_position"]').val(data.emp_position);
                //$('[name="emp_position"]').select2().select2('val', data.emp_position);
                $('[name="from_datee"]').val(show_date_formate_js(data.from_date));
                $('[name="to_datee"]').val(show_date_formate_js(data.to_date));
                $('[name="reason_for_leaving"]').val(data.reason_for_leaving);
                $('[name="contact_employee"]').select2().select2('val', data.contact_employee);
                explain_check(data.contact_employee);
                $('[name="explain"]').val(data.explain);

                //$('[name="position"]').select2().select2('val',data.position);
                //$('[name="c_status"]').select2().select2('val', data.status);

                $('#Experience_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Experience'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_experience(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_experience/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#experience_div").load(location.href + " #experience_div");
                    reload_table('dataTables-example-experience');

                    var url = '';
                    view_message(data, url, '', '');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //=======================================end experience=====================

    //=====================================skills===============================

    $(function () {
        $("#emp_skills").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_skills') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_skills') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_skills").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

//                    $('#emp_skills')[0].reset();
                //$('#skills_Modal').modal('hide');

                $("#skil_div").load(location.href + " #skil_div");
                reload_table('dataTables-example-skills');
                var url = '';
                view_message(data, url, 'skills_Modal', 'emp_skills');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    function edit_skills(id) {
        save_method = 'update';
        $('#emp_skills')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_skills/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.id);
                $('[name="id_emp_skills"]').val(data.id);
                $('[name="skillname"]').val(data.skillname);
                $('[name="yearsofexp"]').val(data.yearsofexp);
                $('[name="competencylevelid"]').select2().select2('val', data.competencylevelid);
                //$('[name="c_status"]').select2().select2('val', data.status);

                $('#skills_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Skills'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_skills(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_skills/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#skil_div").load(location.href + " #skil_div");
                    reload_table('dataTables-example-skills');

                    var url = '';
                    view_message(data, url, '', '');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //=======================================end skills=========================

    //=====================================emp languages========================

    $(function () {
        $("#emp_languages").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_languages') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_languages') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_languages").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

//                    $('#emp_languages')[0].reset();
                //$('#languages_Modal').modal('hide');

                //$('#dataTables-example-languages').DataTable({ajax: "data.json"}).ajax.reload();
                $("#language_div").load(location.href + " #language_div");
                reload_table('dataTables-example-languages');
                var url = '';
                view_message(data, url, 'languages_Modal', 'emp_languages');

                $("#employee_review_div").load(location.href + " #employee_review_div");

            });
            event.preventDefault();
        });
    });

    function edit_languages(id) {
        save_method = 'update';
        $('#emp_languages')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_languages/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.id);
                $('[name="id_emp_languages"]').val(data.id);
                $('[name="languagesid"]').select2().select2('val', data.languagesid);
                $('[name="competencylevel"]').select2().select2('val', data.competencylevel);

                var selectedValues = data.languages_skill.split(',');
                $('#languages_skill').val(selectedValues).trigger("change");

                $('#languages_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Languages'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_languages(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_languages/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#language_div").load(location.href + " #language_div");
                    reload_table('dataTables-example-languages');

                    var url = '';
                    view_message(data, url, '', '');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //=======================================end languages======================

    //=====================================emp Training & Certification=========

    $(function () {
        $("#emp_certification").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_certification') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_certification') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_certification").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
//                    $('#emp_certification')[0].reset();
                // $('#Certification_Modal').modal('hide');                    
                $("#certification_div").load(location.href + " #certification_div");
                reload_table('dataTables-example-certification');
                var url = '';
                view_message(data, url, 'Certification_Modal', 'emp_certification');

                $("#employee_review_div").load(location.href + " #employee_review_div");

            });
            event.preventDefault();
        });
    });

    function edit_certification(id) {
        save_method = 'update';
        $('#emp_certification')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_certification/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.id);course_name
                $('[name="id_emp_certification"]').val(data.id);
                $('[name="course_name"]').val(data.course_name);
                $('[name="course_level"]').val(data.course_level);
                $('[name="certification_name"]').val(data.certification_name);
                $('[name="issued_datee"]').val(show_date_formate_js(data.issued_date));
                $('[name="description"]').val(data.description);
                //$('[name="languagesid"]').select2().select2('val',data.languagesid);

                $('#Certification_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Training & Certification'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_certification(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_certification/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#certification_div").load(location.href + " #certification_div");
                    reload_table('dataTables-example-certification');

                    var url = '';
                    view_message(data, url, '', '');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //=======================================end certification==================

    //=====================================emp License==========================

    $(function () {
        $("#emp_license").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employees/save_emp_license') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Employees/edit_emp_license') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_license").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
//                    $('#emp_license')[0].reset();
                // $('#License_Modal').modal('hide');

                $("#license_div").load(location.href + " #license_div");
                reload_table('dataTables-example-license');
                var url = '';
                view_message(data, url, 'License_Modal', 'emp_license');

                $("#employee_review_div").load(location.href + " #employee_review_div");

            });
            event.preventDefault();
        });
    });

    function edit_license(id) {
        save_method = 'update';
        $('#emp_license')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_Employees/ajax_edit_license/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.id);course_name
                $('[name="id_emp_license"]').val(data.id);
                $('[name="license_type"]').val(data.license_type);
                //$('[name="state_issued"]').val(data.state_issued);
                $('[name="state_issued"]').select2().select2('val', data.state_issued);
                $('[name="state_name"]').select2().select2('val', data.state_name);
                //$('[name="state_name"]').val(data.state_name);
                $('[name="issued_dates"]').val(show_date_formate_js(data.issued_date));
                $('[name="expiration_date"]').val(show_date_formate_js(data.expiration_date));
                $('[name="description"]').val(data.description);
                $('[name="license_image_path"]').val(data.license_image);

                if (data.license_image == "") {
                    var path = base_url + 'uploads/blank_license.jpg';
                } else {
                    var path = base_url + 'uploads/emp_license/' + data.license_image;
                }

                $("#my_license").removeAttr("src").attr("src", path);

                $('#License_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit License'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_license(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_license/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#license_div").load(location.href + " #license_div");
                    reload_table('dataTables-example-license');

                    var url = '';
                    view_message(data, url, '', '');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //=======================================end License========================

    //=====================================emp Absence Tracking=================

    $(function () {
        $("#emp_absencetracking").submit(function (event) {
            loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_absencetracking') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_absencetracking') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_absencetracking").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
//                    $('#emp_absencetracking')[0].reset();
                //$('#Absencetracking_Modal').modal('hide');

                $("#absencetracking_div").load(location.href + " #absencetracking_div");
                reload_table('dataTables-example-absencetracking');
                var url = '';
                view_message(data, url, 'Absencetracking_Modal', 'emp_absencetracking');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    function edit_absencetracking(id) {
        save_method = 'update';
        $('#emp_absencetracking')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_absencetracking/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                //alert(data.id);course_name
                $('[name="id_emp_absencetracking"]').val(data.id);
                $('[name="from_datea"]').val(show_date_formate_js(data.from_date));
                $('[name="to_datea"]').val(show_date_formate_js(data.to_date));
                $('[name="total_days"]').val(data.total_days);
                $('[name="absent_type"]').select2().select2('val', data.absent_type);
                $('[name="details_reason"]').val(data.details_reason);
                $('[name="is_leave"]').select2().select2('val', data.is_leave);
                if (data.is_leave == 1)
                {
                    change_is_leave(data.is_leave);
                    $('[name="leave_type"]').select2().select2('val', data.leave_type);
                }
                $('#Absencetracking_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Absence Tracking'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function change_is_leave(val) {
        if (val == 1)
        {
            $('#leave_type_div').removeAttr("style");
        } else
        {
            $('#leave_type_div').attr('style', 'display:none');
            $('#leave_type').val('');
        }
    }

    function delete_data_absencetracking(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_absencetracking/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#absencetracking_div").load(location.href + " #absencetracking_div");
                    reload_table('dataTables-example-absencetracking');
                    var url = '';
                    view_message(data, url, '', '');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //=======================================end Absence Tracking===============

    //=====================================emp emergency contact================

    $(function () {
        $("#emp_emergencycontact").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_emergencycontact') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_emergencycontact') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_emergencycontact").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);return;

                $("#emergencycontact_div").load(location.href + " #emergencycontact_div");
                reload_table('dataTables-example-emergencycontact');
                var url = '';
                view_message(data, url, 'Emergencycontact_Modal', 'emp_emergencycontact');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    function edit_emergencycontact(id) {
        save_method = 'update';
        $('#emp_emergencycontact')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_Employees/ajax_edit_emergencycontact/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="id_emp_emergencycontact"]').val(data.id);
                $('[name="em_first_name"]').val(data.first_name);
                $('[name="em_last_name"]').val(data.last_name);
                $('[name="em_occupation"]').val(data.occupation);

//                $('[name="em_relationship"]').val(data.relationship);
                $('[name="em_relationship"]').select2().select2('val', data.relationship);

                $('[name="em_first_address"]').val(data.first_address);
                $('[name="em_second_address"]').val(data.second_address);
                $('[name="em_city"]').val(data.city);
                $('[name="em_state"]').select2().select2('val', data.state);
                load_em_county(data.state);
                $('[name="em_county"]').select2().select2('val', data.county);
                $('[name="em_zipcode"]').val(data.zipcode);
                $('[name="em_phone"]').val(data.phone);
                $('[name="em_mobile"]').val(data.mobile);
                $('[name="em_description"]').val(data.description);

                $('#Emergencycontact_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Emergency Contact'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_emergencycontact(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_emergencycontact/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#emergencycontact_div").load(location.href + " #emergencycontact_div");
                    reload_table('dataTables-example-emergencycontact');

                    var url = '';
                    view_message(data, url, '', '');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //=======================================end emergency contact==============

    //=====================================emp Actions==========================

    $(function () {
        $("#emp_inc_action").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_inc_actions') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_inc_actions') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_inc_action").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#actions_div").load(location.href + " #actions_div");
                reload_table('dataTables-example-actions');

                var url = '';
                view_message(data, url, 'Inc_Modal', 'emp_inc_action');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    $(function () {
        $("#emp_accident_action").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_acc_actions') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_acc_actions') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_accident_action").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#actions_div").load(location.href + " #actions_div");
                reload_table('dataTables-example-actions');

                var url = '';
                view_message(data, url, 'accident_Modal', 'emp_accident_action');
            });
            event.preventDefault();
        });
    });

    function edit_action(id) {

        save_method = 'update';
        $('#emp_inc_action')[0].reset(); // reset form on modals
        $('#emp_accident_action')[0].reset();
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_actions/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                /*----------------Common----------------*/
                $('[name="accident_time"]').val(data.accident_time);
                $('[name="accident_witness"]').val(data.accident_witness);
                $('[name="accident_location"]').val(data.accident_location);
                //$('[name="inc_what_doing"]').val(data.inc_what_doing);

                if (data.action_type == 1)  /* Incident */
                {
                    $('[name="id_emp_inc"]').val(data.id);
                    $('[name="inc_action_date"]').val(show_date_formate_js(data.action_date));
                    $('[name="incident_category"]').select2().select2('val', data.incident_category);
                    $('[name="tncident_type"]').select2().select2('val', data.tncident_type);

                    // put edit data into Witness Report
                    $('[name="inc_any_witness"]').val(data.any_witness);
                    if (data.any_witness == 1) {
                        $('#inc_any_witness').attr('checked', true);
                        $('#inc-wit').removeAttr("style");
                        $('#inc-witt').removeAttr("style");
                        $('#inc-wittt').removeAttr("style");
                        $('[name="inc_witness_name"]').val(data.accident_witness);
                        $('[name="inc_witness_phone"]').val(data.accident_witness_phone);
                        $('[name="inc_witness_address"]').val(data.accident_witness_address);
                    } else {
                        $('#inc_any_witness').attr('checked', false);
                        $('#inc-wit').attr('style', 'display:none');
                        $('#inc-witt').attr('style', 'display:none');
                        $('#inc-wittt').attr('style', 'display:none');
                    }

                    // put edit data into Supervisor Report
                    $('[name="inc_report_supervisor"]').val(data.report_supervisor);
                    if (data.report_supervisor == 1) {
                        $('#inc_report_supervisor').attr('checked', true);
                        $('#sup').removeAttr("style");
                        $('#supp').removeAttr("style");
                        $('[name="inc_supervisor_report_date"]').val(show_date_formate_js(data.supervisor_report_date));
                        $('[name="inc_supervisor_reported_by"]').val(data.supervisor_reported_by);
                    } else {
                        $('#inc_report_supervisor').attr('checked', false);
                        $('#sup').attr('style', 'display:none');
                        $('#supp').attr('style', 'display:none');
                    }

                    // put edit data into HR Report
                    $('[name="inc_report_hr"]').val(data.report_hr);
                    if (data.report_hr == 1) {
                        $('#inc_report_hr').attr('checked', true);
                        $('#hr').removeAttr("style");
                        $('#hrr').removeAttr("style");
                        $('[name="inc_hr_report_date"]').val(show_date_formate_js(data.hr_report_date));
                        $('[name="inc_hr_reported_by"]').val(data.hr_reported_by);
                    } else {
                        $('#inc_report_hr').attr('checked', false);
                        $('#hr').attr('style', 'display:none');
                        $('#hrr').attr('style', 'display:none');
                    }

                    $('[name="inc_report_description"]').val(data.report_description);
                    $('[name="inc_employee_comments"]').val(data.employee_comments);


                    if (data.discipline_type)
                    {
                        $('[name="inc_discipline_type"]').select2().select2('val', data.discipline_type);
                        change_inc_data(data.discipline_type);
                    }

                    $('[name="inc_verbal_warning_by"]').val(data.verbal_warning_by);
                    $('[name="inc_written_warning_by"]').val(data.written_warning_by);
                    $('[name="inc_counseled_by"]').val(data.counseled_by);
                    $('[name="inc_suspended_from"]').val(show_date_formate_js(data.suspended_from));
                    $('[name="inc_suspended_to"]').val(show_date_formate_js(data.suspended_to));
                    $('[name="inc_subject"]').val(data.subject);
                    $('[name="inc_description"]').val(data.description);
                    $('[name="inc_improvement_plan"]').val(data.improvement_plan);
                    $('[name="inc_further_actions"]').val(data.further_actions);

                    $('#Inc_Modal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Incident'); // Set title to Bootstrap modal title
                } else  /* Accident */
                {
                    $('[name="id_emp_accident"]').val(data.id);
                    $('[name="accident_action_date"]').val(show_date_formate_js(data.action_date));
                    $('[name="accident_location"]').val(data.accident_location);
                    $('[name="acc_report_supervisor"]').val(data.report_supervisor);
                    /*----------------------------------------------------*/
                    $('[name="nature_of_injury"]').val(data.nature_of_injury);

                    $('#injury_type').val(data.injury_type.split(',')).trigger("change");
                    $('#injured_body_parts').val(data.injured_body_parts.split(',')).trigger("change");

                    $('[name="how_accident_occured"]').val(data.how_accident_occured);
                    $('[name="activity_during_injury"]').val(data.activity_during_injury);

                    $('[name="detail_description"]').val(data.detail_description);
                    $('[name="explain_first_aid"]').val(data.explain_first_aid);
                    $('[name="explain_accident_causes"]').val(data.explain_accident_causes);
                    $('[name="measures_in_future"]').val(data.measures_in_future);
                    $('[name="comments_by_dept"]').val(data.comments_by_dept);

                    /* Put Edit data into Supervisor Reporting */
                    if (data.report_supervisor == 1) {
                        $('#acc_report_supervisor').attr('checked', true);
                        $('#accsup').removeClass("hidden");
                        $('#accsupp').removeClass("hidden");
                        $('[name="acc_supervisor_report_date"]').val(show_date_formate_js(data.supervisor_report_date));
                        $('[name="acc_supervisor_reported_by"]').val(data.supervisor_reported_by);
                    } else {
                        $('#acc_report_supervisor').attr('checked', false);
                        $('#accsup').addClass("hidden");
                        $('#accsupp').addClass("hidden");
                    }

                    /* Put Edit data into HR Reporting */
                    $('[name="acc_report_hr"]').val(data.report_hr);
                    if (data.report_hr == 1) {
                        $('#acc_report_hr').attr('checked', true);
                        $('#acchr').removeClass("hidden");
                        $('#acchrr').removeClass("hidden");
                        $('[name="acc_hr_report_date"]').val(show_date_formate_js(data.hr_report_date));
                        $('[name="acc_hr_reported_by"]').val(data.hr_reported_by);
                    } else {
                        $('#acc_report_hr').attr('checked', false);
                        $('#acchr').addClass("hidden");
                        $('#acchrr').addClass("hidden");
                    }

                    $('[name="acc_report_description"]').val(data.report_description);
                    $('[name="acc_employee_comments"]').val(data.employee_comments);

                    /* Put Edit data into Medical Treatment/Requires Hospitalization */
                    $('[name="requires_hospitalization"]').val(data.requires_hospitalization);
                    if (data.requires_hospitalization == 1) {
                        $('#requires_hospitalization').attr('checked', true);
                        $('#clname').removeClass("hidden");
                        $('#phyname').removeClass("hidden");
                        $('[name="clinic_name"]').val(data.clinic_name);
                        $('[name="physician_name"]').val(data.physician_name);
                    } else
                    {
                        $('#requires_hospitalization').attr('checked', false);
                        $('#clname').addClass("hidden");
                        $('#phyname').addClass("hidden");
                        $('[name="clinic_name"]').val('');
                        $('[name="physician_name"]').val('');
                    }

                    /* Put Edit data into Benefit Provider */
                    $('[name="any_benefit_provider"]').val(data.any_benefit_provider);
                    if (data.any_benefit_provider == 1) {
                        $('#any_benefit_provider').attr('checked', true);
                        $('#provider_name_wrpp').removeClass("hidden");
                        $('#benefit_account_wrpp').removeClass("hidden");
                        $('#benefit_provider').select2().select2('val', data.benefit_provider);
                        var acc_no = $('#benefit_provider option:selected').attr('data-acc');
                        $('#benefit_account').val(acc_no);
                    } else
                    {
                        $('#any_benefit_provider').attr('checked', false);
                        $('#provider_name_wrpp').addClass("hidden");
                        $('#benefit_account_wrpp').addClass("hidden");
                        $('#benefit_account').val('');
                    }

                    /* Put Edit data into Witness */
                    $('[name="acc_any_witness"]').val(data.any_witness);
                    if (data.any_witness == 1) {
                        $('#acc_any_witness').attr('checked', true);
                        $('#acc-wit').removeAttr("style");
                        $('#acc-witt').removeAttr("style");
                        $('#acc-wittt').removeAttr("style");
                        $('[name="acc_witness_name"]').val(data.accident_witness);
                        $('[name="acc_witness_phone"]').val(data.accident_witness_phone);
                        $('[name="acc_witness_address"]').val(data.accident_witness_address);
                    } else
                    {
                        $('#acc_any_witness').attr('checked', false);
                        $('#acc-wit').attr('style', 'display:none');
                        $('#acc-witt').attr('style', 'display:none');
                        $('#acc-wittt').attr('style', 'display:none');
                        $('[name="acc_witness_name"]').val('');
                        $('[name="acc_witness_phone"]').val('');
                        $('[name="acc_witness_address"]').val('');
                    }


                    /*-------------------------------------*/
                    if (data.first_aid_given == 1) {
                        $('#first_aid_given').attr('checked', true);
                        $('#firstAid').removeClass("hidden");
                        $('[name="firstAid_by_whom"]').val(data.firstAid_by_whom);
                    } else
                    {
                        $('#first_aid_given').attr('checked', false);
                        $('#firstAid').addClass("hidden");
                        $('[name="firstAid_by_whom"]').val('');
                    }

                    if (data.discipline_type)
                    {
                        $('[name="acc_discipline_type"]').select2().select2('val', data.discipline_type);
                        change_acc_data(data.discipline_type);
                    }

                    $('[name="acc_verbal_warning_by"]').val(data.verbal_warning_by);
                    $('[name="acc_written_warning_by"]').val(data.written_warning_by);
                    $('[name="acc_counseled_by"]').val(data.counseled_by);
                    $('[name="acc_suspended_from"]').val(show_date_formate_js(data.suspended_from));
                    $('[name="acc_suspended_to"]').val(show_date_formate_js(data.suspended_to));
                    $('[name="acc_subject"]').val(data.subject);
                    $('[name="acc_description"]').val(data.description);
                    $('[name="acc_improvement_plan"]').val(data.improvement_plan);
                    $('[name="acc_further_actions"]').val(data.further_actions);

                    $('#accident_Modal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Accident'); // Set title to Bootstrap modal title
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_action(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_actions/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#actions_div").load(location.href + " #actions_div");
                    reload_table('dataTables-example-actions');

                    var url = '';
                    view_message(data, url, '', '');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //================================end Actions===============================

    //================================Enrolling ================================

    $(function () {
        $("#emp_enrolling").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_enrolling') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_enrolling') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_enrolling").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#enrolling_div").load(location.href + " #enrolling_div");
                reload_table('dataTables-example-enrolling');

                var url = '';
                view_message(data, url, 'enrolling_Modal', 'emp_enrolling');

                $("#ben_enrolling_div").load(location.href + " #ben_enrolling_div");
                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    function edit_empenrolling(id) {
        save_method = 'update';
        $('#emp_enrolling')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_enrolling/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="id_emp_enrolling"]').val(data.id);
                $('[name="en_fast_name"]').val(data.fast_name);
                $('[name="en_middle_name"]').val(data.middle_name);
                $('[name="en_last_name"]').val(data.last_name);
                $('[name="en_suffix"]').val(data.suffix);
                $('[name="en_relationship"]').select2().select2('val', data.relationship_id);
                $('[name="en_gender"]').select2().select2('val', data.gender);
                $('[name="en_birthdate"]').val(show_date_formate_js(data.birthdate));
                $('[name="en_age"]').val(data.age);
                $('[name="en_ssn"]').val(data.ssn_code);
                $('[name="en_iscollage_student"]').select2().select2('val', data.iscollage_student);
                $('[name="en_istobacco_user"]').select2().select2('val', data.istobacco_user);
                $('[name="en_employee_address"]').val(data.employee_address);

                $('#enrolling_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Enrolling'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_empenrolling(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_enrolling/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#enrolling_div").load(location.href + " #enrolling_div");
                    reload_table('dataTables-example-enrolling');

                    var url = '';
                    view_message(data, url, '', '');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //=============================End Enrolling ===============================

    //===================================benefit================================

    $(function () {
        $("#emp_benefit").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_benefit') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_benefit') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_benefit").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);return;
                $('#emp_benefit')[0].reset();
//                    $('#benefit_Modal').modal('hide');

                $("#benefit_div").load(location.href + " #benefit_div");
                reload_table('dataTables-example-benefit');

                var url = '';
                view_message(data, url, 'benefit_Modal', 'emp_benefit');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    function edit_benefit(id) {
        save_method = 'update';
        $('#emp_benefit')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_benefit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="id_emp_benefit"]').val(data.id);
                $('[name="ben_enrolling"]').select2().select2('val', data.enrolling);
                $('[name="provider"]').select2().select2('val', data.provider);
                $('[name="benefit_type"]').select2().select2('val', data.benefit_type);
                $('[name="eligible_date"]').val(show_date_formate_js(data.eligible_date));
                $('[name="enrolled_date"]').val(show_date_formate_js(data.enrolled_date));
                $('[name="percent_dollars"]').select2().select2('val', data.percent_dollars);
                $('[name="employee_portion"]').val(data.employee_portion);
                $('[name="employer_portion"]').val(data.employer_portion);
                $('[name="description"]').val(data.description);

                $('#benefit_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Benefit'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_benefit(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('con_Employees/delete_entry_benefit/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#benefit_div").load(location.href + " #benefit_div");
                    reload_table('dataTables-example-benefit');

                    var url = '';
                    view_message(data, url, '', '');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }


    //=====================================end benefit==========================

    //=====================================PTO==================================

    function edit_accrual_leave(id) {
        save_method = 'update';
        $('#emp_Accrual_Leave')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_Employees/ajax_accrual_leave/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="id"]').val(data.id);
                //$('input[name=track_time_off][value=' + data.track_time_off + ']').attr('checked', true);
                //$('input[name=rollover_on][value=' + data.rollover_on + ']').attr('checked', true);
                $('[name="pto_leave_type"]').select2().select2('val', data.leave_type);
                $('[name="available_limit"]').val(data.available_limit);
                $('[name="earned_houre"]').val(data.earned_houre);
                $('[name="available_hour"]').val(data.available_hour);
                $('[name="used_hour"]').val(data.used_hour);
                $('[name="balance"]').val(data.balance);

                $('#Accrual_Leave_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Accrual Leave'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    $(function () {
        $("#emp_Accrual_Leave").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employees/update_accrual_leave') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Employees/update_accrual_leave') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_Accrual_Leave").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                $('#emp_Accrual_Leave')[0].reset();

                $("#pto_div").load(location.href + " #pto_div");
                reload_table('dataTables-example-emppto');

                var url = '';
                view_message(data, url, 'Accrual_Leave_Modal', 'emp_Accrual_Leave');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });




    $(function () {
        $("#emp_pto").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employees/save_emp_pto') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Employees/edit_emp_pto') ?>";
            }
            $.ajax({
                url: url,
                data: $("#emp_pto").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                $('#emp_pto')[0].reset();

                $("#pto_div").load(location.href + " #pto_div");
                reload_table('dataTables-example-emppto');

                var url = '';
                view_message(data, url, 'pto_Modal', 'emp_pto');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    function edit_emp_pto(id) {
        save_method = 'update';
        $('#emp_pto')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_pto/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {
                $('[name="id_emp_pto"]').val(data.id);
                $('input[name=track_time_off][value=' + data.track_time_off + ']').attr('checked', true);
                $('input[name=rollover_on][value=' + data.rollover_on + ']').attr('checked', true);
                $('[name="pto_leave_type"]').select2().select2('val', data.leave_type);
                $('[name="accrual_amt"]').val(data.accrual_amt);
                $('[name="accrual_period"]').select2().select2('val', data.accrual_period);
                $('[name="start_days_after_hire"]').val(data.start_days_after_hire);
                $('[name="max_accrual"]').val(data.max_accrual);
                $('[name="max_available"]').val(data.max_available);
                $('[name="max_carryover"]').val(data.max_carryover);

                $('#pto_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Pto'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function delete_data_pto(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
        {
            $.ajax({
                url: "<?php echo site_url('Con_Employees/delete_entry_pto/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    $("#pto_div").load(location.href + " #pto_div");
                    reload_table('dataTables-example-emppto');

                    var url = '';
                    view_message(data, url, '', '');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else
            return false;

    }

    //=====================================end PTO==============================

    //============================separation====================================

    $(function () {
        $("#separation_form").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#separation_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //$('#separation_form')[0].reset();

                var url = '';
                view_message(data, url, '', 'separation_form');

                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

    //=========================end separation===================================
    
    //============================== password form =============================
    
    $(function () {
        $("#password_form").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#password_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '';
                view_message(data, url, '', 'password_form');

            });
            event.preventDefault();
        });
    });
    
    //============================= end password form ==========================
</script>
