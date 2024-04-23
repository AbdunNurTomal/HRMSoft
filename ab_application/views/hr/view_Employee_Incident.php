
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employee_Incident/add_Employee_Incident" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Incident </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
                    <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="10%">
                        <col width="15%">
                        <col width="25%">
                        <col width="20%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee Name</th>
                            <th>Action Date</th>
                            <th>Actions Type</th>
                            <th>Description</th>
                            <th>Discipline Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tncident_type_array = $this->db->get_where('main_incidenttype', array('company_id' => $this->company_id));
                        $discipline_type_array = $this->db->get_where('main_disciplinetype', array('company_id' => $this->company_id));

                        //$query = $this->db->get_where('main_emp_actions', array('action_type' => 1, 'isactive' => 1));

                        if ($query) {
                            $i = 0;
                            foreach ($query->result() as $row) {
                                $i++;
                                $pdt = $row->id;

                                $download_link = base_url() . 'con_Employees/';
                                $accident_inv_report = $accident_body_report = '';
                                $refusal_report = "";
                                $work_comp_claim_report = "";

                                if ($row->action_type == 1) {
                                    $action_type = "Incident";
                                    $action_title = "Incident Report";
                                    $download_link .= 'incident_pdf/' . $pdt;
                                } else if ($row->action_type == 2) {
                                    $action_type = "Accident";
                                    $action_title = "Accident Report";
                                    $download_link .= 'accident_pdf/' . $pdt;
                                    $accident_inv_report = "<a title='Accident Investigation Report' href='" . base_url() . 'con_Employees/accident_inv_pdf/' . $pdt . "'><i class='fa fa-lg fa-cloud-download'></i></a>&nbsp;&nbsp;";
                                    $accident_body_report = "<a title='Employee Accident Report' href='" . base_url() . 'con_Employees/accident_report/' . $pdt . "'><i class='fa fa-lg fa-arrow-down'></i></a>&nbsp;&nbsp;";
                                    $refusal_report = "<a title='Medical Attention Refusal' href='" . base_url() . 'Con_Employees/medical_attention_refusal/' . $pdt . "'><i class='fa fa-lg fa-cloud-download'></i></a>&nbsp;&nbsp;";
                                    if ($row->any_benefit_provider == 1) {
                                        $work_comp_claim_report = "<a title='WORKERS’ COMPENSATION CLAIM' href='" . base_url() . 'Con_Employees/work_comp_claim/' . $pdt . "'><i class='fa fa-download' aria-hidden='true'></i></a>&nbsp;&nbsp;";
                                    }
                                    //WORKERS’ COMPENSATION CLAIM FORM (DWC 1)work_comp_claim 
                                } else {
                                    $action_type = $action_title = "";
                                    $download_link .= '#';
                                }
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->employee_name($row->employee_id) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->action_date) . "</td>";
                                print"<td id='catC" . $pdt . "'>" . $action_type . "</td>";
                                print"<td id='catD" . $pdt . "'>" . ucwords($row->report_description) . "</td>";
                                print"<td id='catE" . $pdt . "'>";
                                if ($row->discipline_type != 0) {
                                    print $this->Common_model->get_name($this, $row->discipline_type, 'main_disciplinetype', 'discipline_type') . "</td>";
                                } else {
                                    print" - </td>";
                                }
                                print"<td><div class='action-buttons'>"
                                        . "<a title='Review' href='" . base_url() . "Con_Employee_Incident/edit_Employee_Incident/" . $row->id . "'  ><i class='fa fa-lg fa-pencil-square-o'></i></a>&nbsp;&nbsp;"
                                        . "<a title='Follow-up' href='javascript:;' onclick='observation_action_func(" . $row->id . ", " . $row->action_type . ")'  ><i class='fa fa-lg fa-search-plus'></i></a>&nbsp;&nbsp;"
                                        . "<a title='" . $action_title . "' href='" . $download_link . "'><i class='fa fa-lg fa-download'></i></a>&nbsp;&nbsp;"
                                        . $accident_inv_report
                                        . $accident_body_report
                                        . $refusal_report
                                        . $work_comp_claim_report
                                        . "<a title='Delete' href='javascript:;' onclick='delete_data_action(" . $row->id . ")'><i class='fa fa-trash-o'></i></a>"
                                        . "</div></td>";
                                print"</tr>";
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

<!-- Follow-up Modal -->
<div class="modal fade" id="Obs_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Action Follow-up</h4>
            </div>
            <form id="observation_action" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" name="obs_action_id" value="" />
                <input type="hidden" name="obs_action_type" value="" />

                <div class="modal-body" id="observation_action_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-6"> 
                                <label class="col-sm-4 control-label">Follow-up Date<span class="req"/></label>
                                <div class="col-sm-8">   
                                    <input type="text" name="Observation_Date" id="Observation_Date" class="form-control dt_pick input-sm req-field" placeholder="Follow-up Date" data-toggle="tooltip" data-placement="bottom" title="Follow-up Date" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">Start Time<span class="req"/></label>
                                <div class="col-sm-8">
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input type="text" name="Start_Time" id="Start_Time" class="form-control time_pick input-sm" placeholder="Start Time" data-toggle="tooltip" data-placement="bottom" title="Start Time" autocomplete="off">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">End Time<span class="req"/></label>
                                <div class="col-sm-8">
                                    <div class="input-group bootstrap-timepicker timepicker">
                                        <input type="text" name="End_Time" id="End_Time" class="form-control time_pick input-sm" placeholder="End Time" data-toggle="tooltip" data-placement="bottom" title="End Time" autocomplete="off">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                    </div>                                
                                </div>
                            </div>                    
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">Next Follow-up Date<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="Next_Follow_Date" id="Next_Follow_Date" class="form-control dt_pick input-sm" placeholder="Next Follow-up Date" data-toggle="tooltip" data-placement="bottom" title="Next Follow-up Date" autocomplete="off">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">Action<span class="req"/></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="Action" id="Action" placeholder="Action"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-sm-4 control-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="Description" id="Description" placeholder="Description"></textarea>
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-body" id="observation_action_list">
                    <div class="overflow-x">
                        <table class="table table-striped ObsActionList">
                            <thead>
                                <tr>
                                    <th>Sl. no.</th>
                                    <th>Follow-up Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Next Follow-up Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-------- Ajax Data Here -------->
                                <tr>
                                    <td colspan="7" class="center-align"><i>- Please Wait -</i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<style type="text/css">
    input[type=checkbox]{margin-top:8px !important}
    .bootstrap-timepicker-widget{z-index:5000001 !important}
    .ObsActionList tbody td{white-space:normal !important}
    .ObsActionList thead th{white-space:nowrap !important}
    .doc_name{float:right !important;border:none !important}
    .modal-open .modal {
        overflow-x: hidden !important;
        overflow-y: auto !important;
    }
</style>

<script type="text/javascript">

    var url = "<?php echo base_url(); ?>";
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "Con_Employee_Incident/delete_entry/" + id;
        else
            return false;
    }

    var save_method; //for save method string
    function observation_action_func(action_id, Action_Type) {
        save_method = 'add';
        $('input[name="obs_action_id"]').val(action_id);
        $('input[name="obs_action_type"]').val(Action_Type);
        var DATA = {
            "action_id": action_id
        };
        $.ajax({
            url: '<?php echo site_url('Con_Employees/get_observation_data'); ?>',
            data: DATA,
            type: 'POST'
        }).done(function (data) {
            $(".ObsActionList tbody").html(data);
        });
        $('#Obs_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Action Follow-up'); // Set Title to Bootstrap modal title
    }

    $(function () {
        $('#accident_time, .time_pick').timepicker({
            minuteStep: 5,
            showInputs: false,
            disableFocus: false,
            showSeconds: false,
            defaultTime: ''
        });

        /*-----------------Follow-up Action Save------------------*/
        $("#observation_action").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employees/add_observation_action') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Employees/edit_observation_action') ?>";
            }
            $.ajax({
                url: url,
                data: $("#observation_action").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //alert (data);

                $("#actions_div").load(location.href + " #actions_div");
                reload_table('dataTables-example-actions');
                var url = '';
                view_message(data, url, 'Obs_Modal', 'observation_action');
                $("#employee_review_div").load(location.href + " #employee_review_div");
            });
            event.preventDefault();
        });
    });

</script>
