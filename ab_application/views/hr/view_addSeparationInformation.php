<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <!--<div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">-->
        <!--<div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px; padding-top: 15px;">-->
        <div class="container tag-box tag-box-v3 padding-15">

            <?php
            if ($type == 1) {//entry
                if ($this->user_group == 11 || $this->user_group == 12) {
                    $condition = array('company_id' => $this->company_id, 'isactive' => 1);
                } else {
                    $condition = array('isactive' => 1);
                }

                /* ----------Get Voluntary Employee ID's---------- */
                $this->db->select('employee_id');
                $volData = $this->db->get_where("main_voluntary_info", $condition)->result_array();

                /* ----------Get In-Voluntary Employee ID's---------- */
                $this->db->select('employee_id');
                $InvolData = $this->db->get_where("main_involuntary_info", $condition)->result_array();

                /* -----------Merge Voluntary & In-Voluntar Employee ID's----------- */
                $EXIT_EMP = array_merge($volData, $InvolData);
                $EXIT_EMP = array_column($EXIT_EMP, 'employee_id');

                /* ----------Get Already Separated Employee ID's---------- */
                $this->db->select('employee_id');
                $SepData = $this->db->get_where("main_separation_information", $condition)->result_array();
                $SepData = array_column($SepData, 'employee_id');

                /* ------------Remove Already Separated From Exit------------ */
                $sep_eligible = array_diff($EXIT_EMP, $SepData);

                /* --------Retrived Employee Info-------- */
                if(!empty($sep_eligible)){
                  $this->db->where_in('employee_id', $sep_eligible);
                  $employees_query = $this->db->get_where('main_employees', $condition);

                }else{
                   $this->db->where_in('employee_id');
                    $employees_query = $this->db->get_where('main_employees', $condition);

                }
                
                $termination_type_array = $this->Common_model->get_array('termination_type');
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Separation_Information/save_Separation_Information" enctype="multipart/form-data" role="form" >

                    <input type="hidden" value="" name="id"/> 
                    <input type="hidden" value="" name="exit_interview_id" id="exit_interview_id"/>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="employee" id="employee" onchange="emp_info(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($employees_query->result() as $row) {
                                    print"<option value='" . $row->employee_id . "'>" . $row->first_name . "</option>";
                                }
                                ?>
                            </select>
                        </div>                         
                    </div>

                    <div id="sep_emp_div" class="hidden">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-u">
                                    <div class="panel-heading">
                                        Personal Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                                <tbody>
                                                    <!--Ajax Separation Info Here-->
                                                </tbody>
                                            </table>
                                        </div>

                                        <div id="Work-Info">
                                            <!--Ajax Work related Info Here-->                                            
                                        </div>

                                    </div>
                                </div>
                            </div>        
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-u">
                                    <div class="panel-heading">
                                        Asset Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="assetInformation" class="table table-responsive table-striped table-bordered table-hover">
                                                <tbody>
                                                    <!--Ajax Asset Info Here-->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div>

                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Termination type<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="termination_type" id="termination_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option> 
                                <?php
                                foreach ($termination_type_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Last Paycheck Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="last_paycheck_date" id="last_paycheck_date" class="form-control dt_pick input-sm" placeholder="Last Paycheck Date" data-toggle="tooltip" data-placement="bottom" title="To Date" autocomplete="off">
                        </div>
                    </div>                                       
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Separation Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="separation_date" id="separation_date" class="form-control dt_pick input-sm" placeholder="Separation Date" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">Description </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="description" name="description" placeholder="Description"></textarea>
                        </div>                        
                    </div>                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> &nbsp; </label>
                        <div class="col-sm-4">
                            <a href="#" onclick="add_separation_documents();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                <button type="button" class="btn btn-u">Upload Documents</button>
                            </a>
                            <input type="hidden" name="separation_documents" id="separation_documents" />
                        </div>                        
                    </div>                   
                    <div class="modal-footer no-padding-right">                        
                        <button type="submit" id="submit" class="save-btn btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Separation_Information" ?>">Close</a>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                //print_r($query);
                if ($this->user_group == 11 || $this->user_group == 12) {
                    $employees_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
                } else {
                    $employees_query = $this->db->get_where('main_employees', array());
                }
                //echo $this->db->last_query();
                $termination_type_array = $this->Common_model->get_array('termination_type');

                $row = $query->row();
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Separation_Information/update_Separation_Information" enctype="multipart/form-data" role="form" >

                    <input type="hidden" value="<?php echo $row->id ?>" name="id"/> 
                    <input type="hidden" value="<?php echo $row->exit_interview_id ?>" name="exit_interview_id" id="exit_interview_id"/>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="employee" id="employee" onchange="emp_info(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" disabled>
                                <option></option>
                                <?php
                                foreach ($employees_query->result() as $keyy) {
                                    ?>
                                    <option value="<?php echo $keyy->employee_id ?>" <?php if ($keyy->employee_id == $row->employee_id) echo "selected"; ?>> <?php echo $keyy->first_name ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>                         
                    </div>

                    <div id="sep_emp_div" class="hidden">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-u">
                                    <div class="panel-heading">
                                        Personal Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                                <tbody>
                                                    <!--Ajax Separation Info Here-->
                                                </tbody>
                                            </table>
                                        </div>

                                        <div id="Work-Info">
                                            <!--Ajax Work related Info Here-->                                            
                                        </div>

                                    </div>
                                </div>
                            </div>        
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-u">
                                    <div class="panel-heading">
                                        Asset Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="assetInformation" class="table table-responsive table-striped table-bordered table-hover">
                                                <tbody>
                                                    <!--Ajax Asset Info Here-->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div>

                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Termination type<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="termination_type" id="termination_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option> 
                                <?php
                                foreach ($termination_type_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>" <?php if ($key == $row->termination_type) echo "selected"; ?>> <?php echo $val ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Last Paycheck Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="last_paycheck_date" id="last_paycheck_date" value="<?php echo $this->Common_model->show_date_formate($row->last_paycheck_date) ?>" class="form-control dt_pick input-sm" placeholder="Last Paycheck Date" data-toggle="tooltip" data-placement="bottom" title="To Date" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Separation Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="separation_date" id="separation_date" value="<?php echo $this->Common_model->show_date_formate($row->separation_date) ?>" class="form-control dt_pick input-sm" placeholder="Separation Date" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">Description </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="description" name="description" placeholder="Description"><?php echo $row->description; ?></textarea>
                        </div>                        
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"> &nbsp; </label>
                        <div class="col-sm-4">
                            <a href="#" onclick="add_separation_documents();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                <button type="button" class="btn btn-u">Upload Documents</button>
                            </a>
                            <input type="hidden" name="separation_documents" id="separation_documents" value="<?php echo $row->documents ?>" />
                        </div>                        
                    </div>

                    <div class="modal-footer no-padding-right">                            
                        <button type="submit" id="submit" class="save-btn btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Separation_Information" ?>">Close</a>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<div class="modal fade" id="separation_documents_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
            </div>
            <form id="separation_documents_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Document </label>
                        <div class="col-sm-8">
                            <input type="file" name="separation_documents_file" id="separation_documents_file" size="20" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Add item script-->       
<script>

    function emp_info(empid) {

        get_exit_interview(empid);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() . 'Con_Separation_Information/get_ajax_separation_info/pI/' ?>" + empid,
            success: function (data) {
                $("#PersonalInformation tbody").html(data['result']);
                emp_info2(empid);
            },
            error: function (xhr, err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\nresponseText: " + xhr.responseText);
            }
        });
    }

    function emp_info2(empid) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() . 'Con_Separation_Information/get_ajax_separation_info/wR/' ?>" + empid,
            success: function (data) {
                $("#Work-Info").html(data['result2']);
                emp_info3(empid);
            },
            error: function (xhr, err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\nresponseText: " + xhr.responseText);
            }
        });
    }

    function emp_info3(empid) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() . 'Con_Separation_Information/get_ajax_separation_info/aI/' ?>" + empid,
            success: function (data) {
                $("#assetInformation tbody").html(data['result3']);
            },
            error: function (xhr, err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\nresponseText: " + xhr.responseText);
            }
        });

        $('#sep_emp_div').removeClass("hidden");
    }

    function get_exit_interview(empid) {
        $('select#termination_type').removeAttr('disabled');

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url() . 'Con_Separation_Information/get_ajax_exit_interview_info/' ?>" + empid,
            success: function (data) {
                $('#exit_interview_id').val(data['exit_id']);
                $('select#termination_type').select2().select2('val', data['termination_type']);
                $('select#termination_type').attr('disabled', '');
            },
            error: function (xhr, err) {
                alert("readyState: " + xhr.readyState + "\nstatus: " + xhr.status + "\nresponseText: " + xhr.responseText);
            }
        });
    }

    $(function () {
        $("#sky-form11").submit(function (event) {
            $('#employee').removeAttr('disabled');
            $('select#termination_type').removeAttr('disabled');

            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Separation_Information';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    $("#employee").select2({
        placeholder: "Select Employee",
        allowClear: true,
    });

    $("#termination_type").select2({
        placeholder: "Select Termination Type",
        allowClear: true,
    });

    function add_separation_documents()
    {
        $('#separation_documents_form')[0].reset(); // reset form on modals
        $('#separation_documents_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Upload Document'); // Set Title to Bootstrap modal title
    }

    $(function () {
        $('#separation_documents_form').submit(function (e) {
            e.preventDefault();
            var base_url = '<?php echo base_url(); ?>';
            $.ajaxFileUpload({
                url: base_url + './Con_Separation_Information/upload_documents_file/',
                secureuri: false,
                fileElementId: 'separation_documents_file',
                dataType: 'JSON',
                success: function (data)
                {
                    var datas = data.split('__');
                    $('#separation_documents').val(datas[1]);

                    $('#separation_documents_form')[0].reset();
                    $('#separation_documents_Modal').modal('hide');

                    var url = '';
                    view_message(datas[0], url, '', '');
                }
            });
            return false;
        });
    });

    $(function () {
        var emp_id = $('#employee').val();
        if (emp_id != "")
        {
            emp_info(emp_id);
        }
    });

//    $(function () {
//        $("#Separation_Information_form").submit(function (event) {
//            var url;
//            if (save_method == 'add')
//            {
//                url = "<?php // echo site_url('Con_Separation_Information/save_Separation_Information')                                     ?>";
//            } else
//            {
//                url = "<?php // echo site_url('Con_Separation_Information/update_Separation_Information')                                     ?>";
//            }
//            $.ajax({
//                url: url,
//                data: $("#Separation_Information_form").serialize(),
//                type: $(this).attr('method')
//            }).done(function (data) {
//
//                var url = '<?php // echo base_url()                                     ?>Con_Separation_Information';
//                view_message(data, url, 'Separation_Information_Modal', 'Separation_Information_form');
//            });
//            event.preventDefault();
//        });
//    });

</script>
<!--=== End Script ===-->

