
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_yearend_process/yearend_process" enctype="multipart/form-data" role="form" >
                    <div class="row">
                        <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Year End Process </h3>
                            </div>
                            <div class="panel-body">
                                <div class="container">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Closing Date</label>
                                            <div class="col-sm-6">
                                            <input type="text" name="closing_date" id="closing_date" class="form-control dt_pick input-sm" placeholder="Closing Date" data-toggle="tooltip" data-placement="bottom" title="Closing Date" autocomplete="off">
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" id="submit" class="btn btn-u padding-top-10">Process</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                            <!-- <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>Status</h4></label>
                                <select name="leave_status" id="leave_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>                           
                                    <?php
                                    /*$app_status = $this->Common_model->get_array('approver_status');
                                    foreach ($app_status as $key => $val):
                                        ?>
                                        <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                    <?php endforeach; */ ?>
                                </select>  
                            </div>  -->
                            <!-- <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>Employee</h4></label>
                                <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>                           
                                    <?php
                                    /* foreach ($amployee->result() as $row):
                                        ?>
                                        <option value="<?php echo $row->employee_id ?>"><?php echo $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'middle_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'last_name'); ?></option>
                                    <?php endforeach;*/ ?>
                                </select>  
                            </div> -->
                            <!-- <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>Closing Date</h4></label>
                                <input type="text" name="closing_date" id="closing_date" class="form-control dt_pick input-sm" placeholder="closing date" data-toggle="tooltip" data-placement="bottom" title="Closing Date" autocomplete="off">
                            </div> -->
                            <!-- <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>From Date</h4></label>
                                <input type="text" name="from_date" id="from_date" class="form-control dt_pick input-sm" placeholder="Started On" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>To Date</h4></label>
                                <input type="text" name="to_date" id="to_date" class="form-control dt_pick input-sm" placeholder="Started On" data-toggle="tooltip" data-placement="bottom" title="To Date" autocomplete="off">
                            </div> -->

                            <!-- <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left"> &nbsp; </label>
                                <label class="col-sm-12 col-xs-4 control-label pull-left"> &nbsp; </label>
                                <button type="submit" id="submit" class="btn btn-u padding-top-10">Process</button>
                            </div> -->
                    </div>
                </form>

                <form id="sky-form111" name="sky-form111"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_yearend_process/search_employee/" enctype="multipart/form-data" role="form" >
                    <div class="row">

                        <div class="container">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Employee</label>
                                    <div class="col-sm-6">
                                    <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>                           
                                        <?php foreach ($amployee->result() as $row): 
                                            $slct = ($search_criteria['employee_id'] != "" && $search_criteria['employee_id'] == $row->employee_id) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $row->employee_id ?>" <?php echo $slct ?>><?php echo $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'middle_name')." ".$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'last_name'); ?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" id="submit" class="btn btn-u padding-top-10">Search</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>


                <table id="dataTables-example-leaveSummary" class="table table-striped table-bordered dt-responsive table-hover nowrap" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee Name</th>
                            <th>Year</th>
                            <th>Leave Type</th>
                            <th>Closing Date</th>
                            <th>Hourly Allowance</th>
                            <th>Carry Over Maximum</th>
                            <th>Carry Balance</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="sum_table" >
                    <?php
                        $leave_status = $this->Common_model->get_array('approver_status');
                        $hourly_allowance_array = $this->Common_model->get_array('hourly_allowance_array');
                        if ($query) {
                            foreach ($query as $row) {
                                $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name').", ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $employee_name. "</td>"; //$this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name')
                                print"<td id='catB" . $pdt . "'>" . $row->year . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_selected_value($this, "leave_code", $row->leave_type, 'main_employeeleavetypes', 'leave_short_code') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->closing_date) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $hourly_allowance_array[$row->hourly_allowance_option] . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->carryover_maximum . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->carry_balance . "</td>";
                                print"<td><div class='action-buttons '> &nbsp; <a href='javascript:void()' onclick='edit_yearend_process(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;&nbsp;</div> </td>";
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


<!-- Modal -->
<div class="modal fade" id="yearend_process_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Year end Process</h4>
            </div>
            <form id="yearend_process_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id" id="id"/>
                <div class="modal-body">
                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Carry Balance<span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="carry_balance" id="carry_balance" class="form-control input-sm" placeholder="Carry Balance" autocomplete="off" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>



</div><!--/row-->
</div><!--/container-->
<!--=== End Content ===-->

<script type="text/javascript">

    var table;

    // $(document).ready(function () {
    //     var leaveId = "";
    //     $.ajax({
    //         url: "<?php echo site_url('con_LeaveSummary/total_status/') ?>/" + leaveId,
    //         async: false,
    //         type: "POST",
    //         success: function (data) {
    //             // $('#sum_table').find('tr').remove();
    //             $('#sum_table').html(data);
    //         }
    //     })
    // });

    $(function () {
        $("#sky-form11").submit(function (event) {

            // var leave_status = $("#leave_status").val();
            // var employee_id = $("#employee_id").val();
            // var from_date = $("#from_date").val();
            // var to_date = $("#to_date").val();
            var closing_date = $("#closing_date").val();

            if (closing_date) {
                var url = $(this).attr('action');
                //loading_box(base_url);
                $.ajax({
                    url: url,
                    data: $("#sky-form11").serialize(),
                    type: $(this).attr('method')
                }).done(function (data) {

                    //alert(data);return;
                    //$('#sum_table').html(data);

                    //alert('Year end process done.');

                    var url = '<?php echo base_url() ?>Con_yearend_process';
                    view_message(data, url, '', '#sky-form11');

                });
            } else {
                alert('Please Select At Least One Field');
            }
            event.preventDefault();
        });
    });

    $("#leave_status").select2({
        placeholder: "Status",
        allowClear: true,
    });
    $("#employee_id").select2({
        placeholder: "Employee",
        allowClear: true,
    });

    function edit_yearend_process(id) {
        //alert (id);
        save_method = 'update';
        $('#yearend_process_form')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_yearend_process/ajax_edit_yearend_process/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                $('[name="id"]').val(data.id);
                // $('[name="business_type"]').select2().select2('val', data.business_type);
                // load_business_type_categories(data.business_type)
                // $('[name="sub_categories"]').select2().select2('val', data.sub_categories);
                $('[name="carry_balance"]').val(data.carry_balance);

                $('#yearend_process_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Year End Process'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    $(function () {
        $("#yearend_process_form").submit(function (event) {
            //loading_box(base_url);
           
            var url = "<?php echo site_url('Con_yearend_process/edit_yearend_process') ?>";
            $.ajax({
                url: url,
                data: $("#yearend_process_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //$("#businesstype_div").load(location.href + " #businesstype_div");

                var url = '<?php echo base_url() ?>Con_yearend_process';
                view_message(data, url, 'yearend_process_Modal', 'yearend_process_form');
                
                // setTimeout(function(){ 
                //     reload_table('dataTables-example-businesstype');
                // }, 4000);

            });
            event.preventDefault();
        });
    });
</script>