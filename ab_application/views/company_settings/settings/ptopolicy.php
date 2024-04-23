<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="ptopolicy_div">
        <button class="btn btn-u btn-md" onClick="add_ptopolicy()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-ptopolicy" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
               <col width="5%">
                <col width="25%">
                <col width="25%">
                <col width="15%">
                <col width="20%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Leave Type</th>
                    <th>Description</th>
                    <th>Method</th>
                    <th>Hourly Allowance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                    $paid_leaves = $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_id, 'leavetype' => 0, 'isactive' => 1));
                } else {
                    $paid_leaves = $this->db->get_where('main_employeeleavetypes', array('leavetype' => 0, 'isactive' => 1));
                }
                //echo $this->db->last_query();
                

                //$query = $this->db->get_where('main_pto_settings', array('company_id' => $this->company_settings_id, 'isactive' => 1));
                //echo $this->db->last_query();
                
                $this->db->select('main_pto_settings.id as pto_id,main_pto_settings.*,main_employeeleavetypes.*');
                $this->db->from('main_pto_settings');
                $this->db->join('main_employeeleavetypes', 'main_pto_settings.paid_leave_type = main_employeeleavetypes.leave_code');
                $this->db->where('main_pto_settings.company_id', $this->company_settings_id);
                $this->db->where('main_pto_settings.isactive', 1);
                //$this->db->where('main_employeeleavetypes.isactive', 1);
                $this->db->order_by('main_pto_settings.id', 'DESC');
                $query = $this->db->get();
                
                //echo $this->db->last_query();

                $method_arr = $this->Common_model->get_array('method');
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        
                        if ($row->method == 0) {
                            $method = "";
                        } else {
                            $method = $method_arr[$row->method];
                        }
                        
                        if ($row->hourly_allowance_option == 0) {
                            $hourly_allowance = "";
                        } else if ($row->hourly_allowance_option == 1) {
                            $hourly_allowance = "Fixed";
                        } else if ($row->hourly_allowance_option == 2) {
                            $hourly_allowance = "Graduated";
                        }
                        
                        $i++;
                        $pdt = $row->pto_id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->paid_leave_type, 'main_leave_types', 'leave_code') . " - " . $this->Common_model->get_name($this, $row->state,'main_state','state_abbr') . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $row->paid_description . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $method . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $hourly_allowance . "</td>";
                        print"<td><div class='action-buttons '><a href='#' onclick='edit_pto_settings(" . $row->pto_id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='#' onclick='delete_ptosettings(" . $row->pto_id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>


<!-- Modal -->
<div class="modal fade" id="main_pto_policy_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Accrual Leave Policy</h4>
            </div>
            <form id="com_pto_main_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="com_pto_settings_id" id="com_pto_settings_id"/>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Identification</h4></u></label>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Leave Type<span class="req"/></label>
                            <div class="col-sm-4">
                                <div id="acc_leave_type_div_id">
                                    <select name="paid_leave_type" id="paid_leave_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($paid_leaves->result() as $row):
                                            $leave_code=$this->Common_model->get_name($this, $row->leave_code, 'main_leave_types', 'leave_code')." - ". $this->Common_model->get_name($this, $row->state, 'main_state', 'state_abbr');
                                            print"<option value='" . $row->leave_code . "'>" . $leave_code . "</option>";
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Description<span class="req"/></label>
                            <div class="col-sm-4">
                                <input type="text" name="paid_description" id="paid_description" class="form-control input-sm" placeholder="Description" />
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label class="col-sm-4 control-label">Report Description<span class="req"/></label>
                            <div class="col-sm-4">
                                <input type="text" name="report_description" id="report_description" class="form-control input-sm" placeholder="Report description" />
                            </div>
                        </div>-->

                    </div>
                    <div class="row">

                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Accrual information </h4></u></label>
                        </div>

                        <div class="col-md-6 col-sm-6 find_mar">
                            <label class="col-sm-4 col-xs-4 control-label pull-left">Method<span class="req"/></label>
                            <select name="method" id="method" class="col-sm-8 col-xs-8 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $method = $this->Common_model->get_array('method');
                                foreach ($method as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 col-sm-6 pull-left ">
                            <div class="col-md-12">
                                <label><input type="checkbox" name="ot_hour" id="ot_hour" value="1"> &nbsp;Include OT Hour</label>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 find_mar">
                            <label class="col-md-6 control-label">Hourly Allowance:</label>
                            <div class="col-md-6" id="radiobutt">
                                <div class="radio col-md-6">
                                    <label> <input type="radio" id="hourly_allowance_option" class="abc" name="hourly_allowance_option" value="1" checked> Fixed</label>
                                </div>
                                <div class="col-sm-6">
                                    <label><input type="text" name="fixed_amount" id="fixed_amount" class="form-control input-sm" value=""></label>
                                </div>
                                <div class="radio col-md-6">
                                    <label> <input type="radio"  id="hourly_allowance_option" name="hourly_allowance_option" value="2" > Graduated </label>
                                </div>
                                <div class="col-md-3">
                                    <a onclick="add_pto_table()" href="#">
                                        <input id="leave_table" class="btn btn-u" type="button" value=" Table ">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 find_mar">
                            <div class="col-md-12">
                                <label><input type="checkbox" name="dt_hour" id="dt_hour" value="1"> &nbsp;Include DT Hour</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="accruable_benefit_hour" id="accruable_benefit_hour" value="1" > &nbsp;Include Accruable Benefit Hour</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="graduated_table_content">
                        <div class="col-md-12 find_mar">
                            
                            <div class="col-md-12 pull-right">
                                <label class="col-sm-12 pull-right" id="graduated_table_label"><u><h4> </h4></u></label>
                            </div>
                            
                            <table id="graduated_table" class="table table-striped table-bordered dt-responsive table-hover">

                            </table>
                        </div>
                    </div>
                    
                    <div class="row" style="display:none;">
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Eligibility </h4></u></label>
                        </div>
                        <div class="col-md-12 pull-right">
                            <div class="col-md-3 col-sm-3 find_mar">
                                <label class="col-sm-12 col-xs-12 control-label pull-left">Delay Benefit Accrual Until:</label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="benefit_accrual_until" id="benefit_accrual_until" class="form-control input-sm" value="" />
                            </div>
                            
                            <div class="col-md-3 col-sm-3 find_mar">
                                <label class="col-sm-12 col-xs-12 control-label pull-left">Delay Accrual Hours Availability Until:</label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="accrual_hours_availability_until" id="accrual_hours_availability_until" class="form-control input-sm" value="" />
                            </div>
                            
                            
<!--                            <div class="col-md-3 col-sm-3">
                                <input type="text" name="hire_date_leave" id="hire_date_leave" class="form-control dt_pick" placeholder="Date" autocomplete="off" />
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <label style="text-align: left;" class="col-sm-12 col-xs-12 control-label pull-left">After Employee's Hire Date </label>
                            </div>-->
                        </div>
                        <div class="col-md-12 pull-right">
                            
<!--                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="hire_date" id="hire_date" class="form-control dt_pick" placeholder="Date" />
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <label style="text-align: left;" class="col-sm-12 col-xs-12 control-label pull-left">After Employee's Hire Date  </label>
                            </div>-->
                        </div>
                    </div>
                    <div class="row" id="limit_row">
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Condition </h4></u></label>
                        </div>
                        <div class="col-md-12 pull-right">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Available Limit:</label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="available_limit" id="available_limit" class="form-control input-sm" value="" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Annual Limit:</label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="annual_limit" id="annual_limit" class="form-control input-sm" value="" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Carry Over Maximum:</label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="carryover_maximum" id="carryover_maximum" class="form-control input-sm" value="" />
                            </div>
<!--                            <div class="col-md-3 col-sm-3 find_mar">
                                <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left"> Per Check Limit: </label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="per_check_limit" id="per_check_limit" class="form-control " placeholder="" />
                            </div>-->
                        </div>
                        <div class="col-md-12 pull-right">
                            
<!--                            <div class="col-md-3 col-sm-3 find_mar">
                                <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left">Per Month Limit:  </label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="per_month_limit" id="per_month_limit" class="form-control" placeholder="" />
                            </div>-->
                        </div>
                    </div>
                    <div class="row" style="display:none;">
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Balance Reset </h4></u></label>
                        </div>
                        <div class="col-md-12 pull-right">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Method:</label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="balanced_method" id="balanced_method" class="form-control input-sm" value="" />
                            </div>
                            <div class="col-md-6 col-sm-3 find_mar">
                                <label><input type="checkbox" name="reset_beginning_balance" value="1"> Reset Beginning Balance To Zero </label>
                            </div>
                        </div>
                        <div class="col-md-12 pull-right">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Date:</label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="balanced_date" id="balanced_date" class="form-control dt_pick" placeholder="Date" />
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left">Carryover Maximum:  </label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="carryover_maximum" id="carryover_maximum" class="form-control " placeholder="" />
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 find_mar">
                            <label class="col-md-6 control-label">If Pay Period Spans Multiple Benefit Years: </label>
                            <div class="col-md-6">
                                <div class="radio col-md-12">
                                    <label>
                                        <input id="inlineradio1" name="pay_period_spans" value="1" type="radio">
                                        Apply Benefit Hours Used To The Current Benefit Years</label>
                                </div>
                                <div class="radio col-md-12">
                                    <label>
                                        <input id="inlineradio1" name="pay_period_spans" value="2" type="radio">
                                        Apply Benefit Hours Used To The Prior Benefit Years</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display:none;">
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4> Exclusions</h4></u></label>
                        </div>
                        <div class="col-md-12 pull-right">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Workers Compensation:</label>
                            </div>
                            <div class="col-md-9 col-sm-3 find_mar">
                                <div class="col-md-9 col-sm-3 find_mar">
                                    <select name="workers_compensation" id="workers_compensation" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $compensation = $this->Common_model->get_array('Workers_compensation');
                                        foreach ($compensation as $row => $val) {
                                            print"<option value='" . $row . "'>" . $val . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="tb_type" id="tb_type" value="1">
                    <div class="col-md-12" id="hd_div1">
                        <input type="hidden" name="hidden_hourly_allowance_option" id="hidden_hourly_allowance_option"/>
                        <input type="hidden" name="hidden_graduated_form" id="hidden_graduated_form"/>
                        <input type="hidden" name="hidden_graduated_to" id="hidden_graduated_to"/>
                        <input type="hidden" name="hidden_hourly_allowance" id="hidden_hourly_allowance"/>
                        <input type="hidden" name="hidden_available_limit" id="hidden_available_limit"/>
<!--                        <input type="hidden" name="hidden_check_limit" id="hidden_check_limit"/>
                        <input type="hidden" name="hidden_month_limit" id="hidden_month_limit"/>-->
                        <input type="hidden" name="hidden_annual_limit" id="hidden_annual_limit"/>
                        <input type="hidden" name="hidden_carryover_maximum" id="hidden_carryover_maximum"/>
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

<!-- Table  Modal -->
<div class="modal fade bd-example-modal-lg" id="pto_table_modal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="close_last_modal();" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Graduated Accrual Table</h4>
            </div>
            <!--<form id="pto_table_form" name="sky-form11" class="form-horizontal" action="<?php // echo base_url();                             ?>Con_configaration/receive_leave_table_info" method="post" enctype="multipart/form-data" role="form">-->
            <form id="pto_table_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">    
                <input type="hidden" value="" name="pto_table_id" id="pto_table_id"/>
                <div class="modal-body">

                    <div class="col-md-12 col-sm-12 find_mar">
                        <div class="col-md-6 col-sm-6 find_mar">
                            <div class="radio col-md-3">
                                <label > <input type="radio"  id="radio_allowance_option" name="radio_allowance_option" value="1" checked > Days </label>
                            </div>
                            <div class="radio col-md-3">
                                <label> <input type="radio" id="radio_allowance_option" name="radio_allowance_option" value="2" > Weeks</label>
                            </div>
                            <div class="radio col-md-3">
                                <label> <input type="radio" id="radio_allowance_option" name="radio_allowance_option" value="3" > Months</label>
                            </div>
                            <div class="radio col-md-3">
                                <label> <input  type="radio" id="radio_allowance_option" name="radio_allowance_option" value="4" >Years</label>
                            </div>
                        </div>

                    </div>

                    <div >
                        <div >
                            <table id="pto_table" class="table table-striped table-bordered dt-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th class="mycol">From</th>
                                        <th class="mycol">To</th>
                                        <th class="mycol">Hourly Allowance</th>
                                        <th class="mycol">Available Limit</th>
<!--                                        <th class="mycol">Check Limit</th>
                                        <th class="mycol">Month Limit</th>-->
                                        <th class="mycol">Annual Limit</th>
                                        <th class="mycol">Carryover Maximum</th>
                                        <th class="mycol" style="width: 11%; "> Action</th>
                                    </tr>
                                </thead>
                                <tbody id="pto_tbody">
                                    <tr id="tr_1">
                                        <td><input class="form-control input-sm" type="text" name="graduated_form[]" id="graduated_form_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="graduated_to[]" id="graduated_to_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="hourly_allowance[]" id="hourly_allowance_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="available_limit[]" id="available_limit_1" /></td>
<!--                                        <td><input class="form-control input-sm" type="text" name="check_limit[]" id="check_limit_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="month_limit[]" id="month_limit_1" /></td>-->
                                        <td><input class="form-control input-sm" type="text" name="annual_limit[]" id="annual_limit_1" /></td>
                                        <td><input class="form-control input-sm" type="text" name="carryover_maximum[]" id="carryover_maximum_1" /></td>
                                        <td>
                                            <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_pto_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                            <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_pto_row(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="close_table_modal();" class="btn btn-u" >Save</button>
                        <button type="button" onclick="close_last_modal();" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('#dataTables-example-ptopolicy').dataTable({
            "order": [0, "asc"],
            "pageLength": 10,
            "paginationType": "input"
        });
        
        
        $('.modal').on('hidden.bs.modal', function (e) {
            if ($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });


    });

    var save_method; //for save method string
    var table;
    function add_ptopolicy()
    {
        save_method = 'add';
        $('#com_pto_main_form')[0].reset(); // reset form on modals

        $("#method").select2({
            placeholder: "Method",
            allowClear: true,
        });

        $("#workers_compensation").select2({
            placeholder: "Workers Compensation",
            allowClear: true,
        });
        
  
        //$("#acc_leave_type_div_id").load(location.href + " #acc_leave_type_div_id");

        $("#paid_leave_type").select2({
            placeholder: "Select Leave Type",
            allowClear: true,
        });


        $('#main_pto_policy_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Accrual Leave Policy'); // Set Title to Bootstrap modal title
        
        $('#graduated_table_label').html('');
        $("#graduated_table tr").remove();
        
    }

    $(document).ready(function () {
        
        $('#leave_table').attr("readonly", true);
        $('input:radio[name="hourly_allowance_option"]').click(function () {
            if ($(this).val() == 1) {
                $('#fixed_amount').removeAttr("readonly");
                $('#leave_table').attr("disabled", true);
                $('#limit_row').show();
                $('#graduated_table_content').css('display','none');
            } else {
                $('#leave_table').removeAttr("disabled");
                $('#fixed_amount').attr("readonly", true);
                $('#fixed_amount').val('');
                $('#limit_row').css('display','none');
                $('#graduated_table_content').show();
            }

        });
        
    });

    function add_pto_table()
    {
        var value = $('input[name="hourly_allowance_option"]:checked').val();
        if (value == 1) {
            alert('Please Select Graduated Field');
        } else {

            //$('#main_pto_policy_Modal').modal('hide');

            //save_method = 'add';
            $('#pto_table_form')[0].reset(); // reset form on modals
            $('#pto_table_modal').modal('show'); // show bootstrap modal
            $('.modal-title').text('Graduated Accrual Table'); // Set Title to Bootstrap modal title

            $("#pto_tbody tr").not(':first').remove();

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

            $('input[name=radio_allowance_option][value=' + val_hourly_allowance_option + ']').attr('checked', true);

            for (var i = 0; i <= arr_graduated_form.length; i++) {
                //alert (i);
                
                $('#graduated_form_' + i).val(arr_graduated_form[ i - 1 ]);
                $('#graduated_to_' + i).val(arr_graduated_to[ i - 1 ]);
                $('#hourly_allowance_' + i).val(arr_hourly_allowance[ i - 1 ]);
                $('#available_limit_' + i).val(arr_available_limit[ i - 1 ]);
                //$('#check_limit_' + i).val(arr_check_limit[ i - 1 ]);
                //$('#month_limit_' + i).val(arr_month_limit[ i - 1 ]);
                $('#annual_limit_' + i).val(arr_annual_limit[ i - 1 ]);
                $('#carryover_maximum_' + i).val(arr_carryover_maximum[ i - 1 ]);

                if (i != 0 && i < arr_graduated_form.length)
                {
                    add_pto_row(i);
                }

            }
        }
    }

    function close_table_modal()
    {
        var graduated_form;
        var graduated_to;
        var hourly_allowance;
        var available_limit;
        //var check_limit;
        //var month_limit;
        var annual_limit;
        var carryover_maximum;

        var totrow = $("#pto_table > tbody > tr").length;
        var hourly_allowance_option = $('input[name=radio_allowance_option]:checked').val();

        for (var i = 0; i <= totrow; i++) {
            if (i == 1)
            {
                graduated_form = $('#graduated_form_' + i).val();
                graduated_to = $('#graduated_to_' + i).val();
                hourly_allowance = $('#hourly_allowance_' + i).val();
                available_limit = $('#available_limit_' + i).val();
                //check_limit = $('#check_limit_' + i).val();
                //month_limit = $('#month_limit_' + i).val();
                annual_limit = $('#annual_limit_' + i).val();
                carryover_maximum = $('#carryover_maximum_' + i).val();
            } else
            {
                graduated_form = graduated_form + ',' + $('#graduated_form_' + i).val();
                graduated_to = graduated_to + ',' + $('#graduated_to_' + i).val();
                hourly_allowance = hourly_allowance + ',' + $('#hourly_allowance_' + i).val();
                available_limit = available_limit + ',' + $('#available_limit_' + i).val();
                //check_limit = check_limit + ',' + $('#check_limit_' + i).val();
                //month_limit = month_limit + ',' + $('#month_limit_' + i).val();
                annual_limit = annual_limit + ',' + $('#annual_limit_' + i).val();
                carryover_maximum = carryover_maximum + ',' + $('#carryover_maximum_' + i).val();
            }

        }

        $('#hidden_hourly_allowance_option').val(hourly_allowance_option);
        $('#hidden_graduated_form').val(graduated_form);
        $('#hidden_graduated_to').val(graduated_to);
        $('#hidden_hourly_allowance').val(hourly_allowance);
        $('#hidden_available_limit').val(available_limit);
        //$('#hidden_check_limit').val(check_limit);
        //$('#hidden_month_limit').val(month_limit);
        $('#hidden_annual_limit').val(annual_limit);
        $('#hidden_carryover_maximum').val(carryover_maximum);

        $('#pto_table_modal').modal('hide');

//        setTimeout(function () {
//            $("#main_pto_policy_Modal").modal("show");
//            $('#main_pto_policy_Modal').modal({
//                backdrop: 'dynamic',
//                keyboard: true
//            });
//        }, 500);

    //show_graduated_table();
    //<label class="col-sm-12 pull-right" id="graduated_table_label"><u><h4> Graduated Table : </h4></u></label>
    
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
    
        for (var i = 1; i <= totrow; i++) {
            
            $('#graduated_table').append(
                '<tr>'
                    + '<td>'+ $('#graduated_form_' + i).val() +'</td>'
                    + '<td>'+ $('#graduated_to_' + i).val() +'</td>'
                    + '<td>'+ $('#hourly_allowance_' + i).val() +'</td>'
                    + '<td>'+ $('#available_limit_' + i).val() +'</td>'
                    + '<td>'+ $('#annual_limit_' + i).val() +'</td>'
                    + '<td>'+ $('#carryover_maximum_' + i).val() +'</td>'
                + '</tr>'
            );

        }

    }

    function close_last_modal()
    {
        setTimeout(function () {
            $("#main_pto_policy_Modal").modal("show");
            $('#main_pto_policy_Modal').modal({
                backdrop: 'dynamic',
                keyboard: true
            });
        }, 500);
    }

    function add_pto_row(i)
    {
        //alert (i);
        var rowCount = $('#pto_tbody tr').length;
        //alert (rowCount);
        if ($('#graduated_form_' + rowCount).val() == "")
        {
            alert('Graduated form Can not be empty.');
            $('#graduated_form_' + rowCount).focus();
            return;
        } else
        {
            rowCount++;

            $('#pto_table').append(
                    '<tr id="tr_' + rowCount + '">'
                    + '<td><input class="form-control input-sm" type="text" name="graduated_form[]" id="graduated_form_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="graduated_to[]" id="graduated_to_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="hourly_allowance[]" id="hourly_allowance_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="available_limit[]" id="available_limit_' + rowCount + '"  autocomplete="off"/> </td>'
                    //+ '<td><input class="form-control input-sm" type="text" name="check_limit[]" id="check_limit_' + rowCount + '"  autocomplete="off"/> </td>'
                    //+ '<td><input class="form-control input-sm" type="text" name="month_limit[]" id="month_limit_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="annual_limit[]" id="annual_limit_' + rowCount + '"  autocomplete="off"/> </td>'
                    + '<td><input class="form-control input-sm" type="text" name="carryover_maximum[]" id="carryover_maximum_' + rowCount + '" autocomplete="off"/> </td>'
                    + '<td>\n\
                    <a class="btn btn-sm btn-u" id="add_' + rowCount + '" title="Add" onclick="add_pto_row(' + rowCount + ');"><i class="glyphicon glyphicon-plus" ></i></a>\n\
                    <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_pto_row(' + rowCount + ');"><i class="glyphicon glyphicon-minus" ></i> </a>\n\
                    </td>'
                    + '</tr>'
                    );

        }

    }

    function  remove_pto_row(i)
    {
        var rowCount = $('#pto_tbody tr').length;
        if (rowCount != 1)
        {
            $("#pto_tbody tr:last").remove();
            //$('#tr_' + i).remove();
        }
    }

    $(document).ready(function () {
        
        $("#method").select2({
            placeholder: "Method",
            allowClear: true,
        });

        $("#paid_leave_type").select2({
            placeholder: "Select Leave Type",
            allowClear: true,
        });

        $("#workers_compensation").select2({
            placeholder: "Workers Compensation",
            allowClear: true,
        });
        
//        setTimeout(function(){ 
//            
//            $("#paid_leave_type").select2({
//                placeholder: "Select Leave Type",
//                allowClear: true,
//            });
//
//        }, 5000); 
    
    });

</script>
