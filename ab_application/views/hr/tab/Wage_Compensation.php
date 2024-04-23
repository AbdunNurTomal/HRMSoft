<style>
    input.disabled {
        pointer-events:none;
        color:#ffffff !important;
        background:#cccccc !important;
    }

    #per_pay_period_salary_table tr th{
        color:#4e4e4e !important;
        background:#cccccc !important;
    }
</style>
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="wage_compensation_div">
        <button class="btn btn-u btn-md" onClick="add_emp_wage_compensation()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-compensation" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Date</th>
                    <th>Wage Type</th>
                    <th>Position</th>
                    <!-- <th>GL Codes</th> -->
                    <th>Pay Schedule</th>
                    <!-- <th>Hours per Pay Period</th> -->
                    <th>Per Hour Rate</th>
                    <!-- <th>Per Pay Period Salary</th> -->
                    <th>Yearly Salary</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $positions_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
                $employee_position=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_employees','position');
                $salary_type=$this->Common_model->get_selected_value($this,'employee_id',$employee_id,'main_emp_workrelated','salary_type');
                
                $wage_type_query=$this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id,'isactive' => 1));
                
                $wage_type_array = $this->Common_model->get_array('wage_type');
                $status_array = $this->Common_model->get_array('status');
                
                $this->db->order_by("id", "DESC");
                $query = $this->db->get_where('main_emp_wage_compensation', array('employee_id' => $employee_id,'isactive' => 1));
                 //echo $this->db->last_query();

                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        
                        $per_hour_rate=" $". $row->per_hour_rate;
                        $per_pay_period_salary=" $". round($row->per_pay_period_salary,2);
                        ?>
                        <tr>
                            <td> <?php echo $i ?> </td>
                            <td><?php echo $this->Common_model->show_date_formate($row->wage_date) ?></td>
                            <td> <?php echo $wage_type_array[$row->wage_salary_type]; ?></td>
                            <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title'); ?></td>
                            <!-- <td><?php //echo $this->Common_model->get_selected_value($this,'positionname',$row->position,'main_positions','gl_code'); ?></td> -->
                            <td><?php echo $this->Common_model->get_name($this, $row->pay_schedule,'main_payfrequency_type', 'freqcode'); ?></td>
                            <!-- <td><?php //echo $row->hours_per_pay_period ?></td> -->
                            <td><?php echo $per_hour_rate; ?></td>
                            <!-- <td><?php //echo $per_pay_period_salary; ?></td> -->
                            <td>$ <?php echo $row->yearly_salary; ?></td>
                            <td><?php echo $status_array[$row->status]; ?></td>
                            <td>
                                <div class='action-buttons '>
                                    <?php if($row->status==1) {?>
                                    <a href='javascript:void()' title="Edit" onclick='edit_wage_compensation("<?php echo $row->id ?>")'><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>
                                    <a href='javascript:void(0)' title="Delete" onclick='delete_data_wage_compensation("<?php echo $row->id ?>")'><i class='fa fa-trash-o'>&nbsp;&nbsp;</i></a>
                                    <?php } ?>
                                </div>
                            </td>
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

<!-- Modal -->
<div class="modal fade" id="wage_compensation_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"> Wage Compensation </h4>
            </div>
            <form id="wage_compensation_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">    
                <input type="hidden" value="" name="id_emp_wage" id="id_emp_wage"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Position <span class="req"/> </label>
                        <div class="col-sm-4">
                            <select name="emp_wage_position" id="emp_wage_position" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($positions_query->result() as $key): ?>
                                    <option value="<?php echo $key->positionname ?>" <?php if($key->positionname==$employee_position) echo "selected"; ?>><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label"> Pay Schedule <span class="req"></span></label>
                        <div class="col-sm-4">
                            <select name="pay_schedule" id="pay_schedule" class="col-sm-12 col-xs-12 myselect2 input-sm" placeholder="">
                                <!-- <option value="">Select a pay schedule</option> -->
                                <option></option>
                                <?php foreach ($wage_type_query->result() as $keyy): ?>
                                    <?php if ($keyy->wages): ?>
                                    <option value="<?php echo $keyy->wages ?>" ><?php echo $this->Common_model->get_name($this, $keyy->wages, 'main_payfrequency_type', 'freqcode'); ?></option>
                                    <?php endif; ?>
                                <?php endforeach;  ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-2 control-label"> Salary Type : </label>
                        <div class="col-sm-4">
                        <input type="hidden" name="wage_salary_type" id="wage_salary_type" value="<?php echo $salary_type; ?>" class="form-control input-sm"  >
                            <!-- <select name="wage_salary_type" id="wage_salary_type" onchange="change_salary_rate(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                // $wage_type_array = $this->Common_model->get_array('wage_type');
                                // foreach ($wage_type_array as $keyw => $valw):
                                //     ?>
                                //     <option value="<?php //echo $keyw ?>"><?php //echo $valw ?></option>
                                //     <?php
                                // endforeach;
                                ?>
                            </select>  -->
                            <span id="wage_salary_type_val" class="form-control input-sm">
                                <?php echo $wage_type_array[$salary_type]; ?>
                            </span>
                        </div>
                        <!-- <label class="col-sm-2 control-label"> Hours per Pay Period </label>
                        <div class="col-sm-4">
                            <input type="text" name="hours_per_pay_period" id="hours_per_pay_period" onblur="calculate_salary();" class="form-control input-sm" placeholder="Hours per Pay Period" >
                        </div> -->
                        <?php //if($salary_type=="0") { ?>
                            <div id="yearly_salary_div" style="display:none">
                                <label class="col-sm-2 control-label">Yearly Package ( $ )</label>
                                <div class="col-sm-4">
                                    <input type="text" name="yearly_salary" id="yearly_salary" onblur="set_yearly_salart();" class="form-control input-sm" placeholder="Yearly Salary ( $ )" title="Yearly Salary" >
                                </div>
                            </div>
                        <?php //} else{ ?>
                            <div id="per_hour_rate_div" style="display:none">
                                <label class="col-sm-2 control-label" id="salary_rate_lable"> Hourly Rate ( $ )</label>
                                <div class="col-sm-4">
                                    <input type="text" name="per_hour_rate" id="per_hour_rate" class="form-control input-sm" placeholder="Per Hour Rate ( $ )" onblur="calculate_salary(); set_yearly_salart();" >
                                </div>
                            </div>
                        <?php //} ?>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label" id="salary_rate_lable"> Per Hour Rate ( $ )</label>
                        <div class="col-sm-4">
                            <input type="text" name="per_hour_rate" id="per_hour_rate" class="form-control input-sm" placeholder="Per Hour Rate ( $ )" onblur="calculate_salary(); set_yearly_salart();" >
                        </div>
                        <label class="col-sm-2 control-label">Yearly Salary ( $ )</label>
                        <div class="col-sm-4">
                            <input type="text" name="yearly_salary" id="yearly_salary" onblur="set_yearly_salart();" class="form-control input-sm" placeholder="Yearly Salary ( $ )" title="Yearly Salary" >
                        </div>
                    </div> -->
                    <!-- <div class="form-group ">
                        <label class="col-sm-2 control-label"> Per Pay Period Salary ( $ )</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="per_pay_period_salary" id="per_pay_period_salary" class="form-control input-sm" placeholder="Per Pay Period Salary ( $ )" >
                        </div>
                        <label class="col-sm-2 control-label"> Date <span class="req"></span></label>
                        <div class="col-sm-4">
                            <input type="text"  name="wage_date" id="wage_date" class="form-control input-sm dt_pick" placeholder="Date" autocomplete="off" >
                        </div>
                    </div> -->

                    

                    <!-- <div class="form-group ">
                        <label class="col-sm-2 control-label"> Status </label>
                        <div class="col-sm-4">
                            <select name="wage_status" id="wage_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                // $status_array = $this->Common_model->get_array('status');
                                // foreach ($status_array as $key => $val) {
                                //     ?>
                                //     <option value="<?php //echo $key ?>" <?php //if ($key == 1) echo "selected" ?> ><?php //echo $val ?></option>
                                //     <?php
                                // }
                                ?>
                            </select> 
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 ">
                            
                            <div class="col-md-12 pull-right">
                                <label class="col-sm-12 pull-right" id="per_pay_period_salary_table_label"><u><h4> </h4></u></label>
                            </div>
                            
                            <table id="per_pay_period_salary_table" class="table table-striped table-bordered dt-responsive table-hover">

                            </table>
                        </div>
                    </div>

                    <div class="form-group hideshowdiv" style=" display: none";>                      
                        <label class="col-sm-2 control-label"> Effective Date <span class="req"></span></label>
                        <div class="col-sm-4">
                            <input type="text"  name="effective_date" id="effective_date" class="form-control input-sm dt_pick" placeholder="Effective Date" autocomplete="off" >
                        </div>
                        <label class="col-sm-2 control-label"> Note </label>
                        <div class="col-sm-4">
                            <textarea id="note" name="note" rows="2" class="form-control input-sm"> </textarea>
                        </div>
                    </div>
                    

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save & Approval</button>
                        <button type="button" id="reset_form" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    
                    
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTables-example-compensation').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });
    var save_method; //for save method string
    var table;
    function add_emp_wage_compensation()
    {
        if($("#wage_salary_type").val() == '0') {
            $('#yearly_salary_div').show();
            $('#per_hour_rate_div').css('display','none');
        } else {
            $('#per_hour_rate_div').show();
            $('#yearly_salary_div').css('display','none');
        }
        
        save_method = 'add';
        $('#wage_compensation_form')[0].reset(); // reset form on modals
        $('#wage_compensation_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Wage History Report'); // Set Title to Bootstrap modal title

        //set_per_hour_rate();
        // $("#wage_salary_type").select2({
        //     placeholder: "Salary Type",
        //     allowClear: true,
        // });
        //$(".hideshowdiv").hide();

        set_yearly_salart();
    }

    $(document).ready(function () {
        $('#reset_form').click(function(e) {
            e.preventDefault();
            $('#wage_compensation_form')[0].reset();
            $("#pay_schedule").select2("val", "");
            $("#per_pay_period_salary_table").hide();
         });
     });
    
    function set_per_hour_rate()
    {
        var id=$('#emp_wage_position').val();
        $.ajax({
            url: "<?php echo site_url('Con_Employees/set_per_hour_rate/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                //alert (data);
                $('#per_hour_rate').val(data);
            }
        });
    } 
    
    function calculate_salary()
    {
        var hours_per_pay_period=$('#hours_per_pay_period').val();
        var per_hour_rate=$('#per_hour_rate').val();
        var salary=(hours_per_pay_period*per_hour_rate);
        $('#per_pay_period_salary').val(salary);
        $('#yearly_salary').val(2080*per_hour_rate);
        
    } 

    
    function set_yearly_salart()
    {
     
        var wage_salary_type=$('#wage_salary_type').val();
        if (wage_salary_type == 0) {

            var yearly_salary=$('#yearly_salary').val();
            //var hour_salary=$('#hours_per_pay_period').val();
            var per_hour_rate=(yearly_salary/2080);
            //$('#per_hour_rate').val(per_hour_rate.toFixed(2));
            // if(hour_salary ==""){
            // $('#hours_per_pay_period').val(0);
            // }
            //$('#hours_per_pay_period').val(2080); 

            show_PerPay_Period_Salary(per_hour_rate);
            
        } else {
            var per_hour_rate=$('#per_hour_rate').val();
            if(per_hour_rate=="") per_hour_rate=0;
            show_PerPay_Period_hourly(per_hour_rate);
        }

        
         
    }
    
    function show_PerPay_Period_Salary(per_hour_rate)
    {
        var yearly_salary=$('#yearly_salary').val();
        if(yearly_salary==""){
            var yearly_salary=0;
        }

        $(".hideshowdiv").show();

        $("#per_pay_period_salary_table tr").remove();
        $('#per_pay_period_salary_table').append(
            '<tr>'
                + '<th colspan="3">Payout Breakdown</th>'
            + '</tr>'
            + '<tr>'
                + '<th>Period</th>'
                + '<th>Explain</th>'
                + '<th>Amount</th>'
            + '</tr>'
            + '<tr>'
                + '<td>Hourly : </td>'
                + '<td>Yearly Package / 2080   : </td>'
                + '<td>$ ' + (yearly_salary/2080).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Weekly Salary : </td>'
                + '<td>40 Hours X Hourly Rate   : </td>'
                + '<td>$ ' + (40*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Bi-Weekly Salary : </td>'
                + '<td>80 Hours X Hourly Rate : </td>'
                + '<td>$ ' + (80*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Semi-Monthly Salary : </td>'
                + '<td>86.67 Hours X Hourly Rate : </td>'
                + '<td>$ ' + (86.67*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Monthly Salary : </td>'
                + '<td>173.333 Hours X Hourly Rate  : </td>'
                + '<td>$ ' + (173.333*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Yearly Salary : </td>'
                + '<td>2080 X Hourly Rate  : </td>'
                + '<td>$ ' + (2080*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
        );
    }

    function show_PerPay_Period_hourly(per_hour_rate)
    {
       
        $(".hideshowdiv").show();

        $("#per_pay_period_salary_table tr").remove();
        $('#per_pay_period_salary_table').append(
            '<tr>'
                + '<th colspan="3">Payout Breakdown</th>'
            + '</tr>'
            + '<tr>'
                + '<th>Period</th>'
                + '<th>Explain</th>'
                + '<th>Amount</th>'
            + '</tr>'
            + '<tr>'
                + '<td>Hourly : </td>'
                + '<td>Hourly Rate  : </td>'
                + '<td>$ ' + (1*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Weekly Salary : </td>'
                + '<td>40 Hours X Hourly Rate   : </td>'
                + '<td>$ ' + (40*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Bi-Weekly Salary : </td>'
                + '<td>80 Hours X Hourly Rate : </td>'
                + '<td>$ ' + (80*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Semi-Monthly Salary : </td>'
                + '<td>86.67 Hours X Hourly Rate : </td>'
                + '<td>$ ' + (86.67*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Monthly Salary : </td>'
                + '<td>173.333 Hours X Hourly Rate  : </td>'
                + '<td>$ ' + (173.333*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
            + '<tr>'
                + '<td>Yearly Salary : </td>'
                + '<td>2080 X Hourly Rate  : </td>'
                + '<td>$ ' + (2080*per_hour_rate).toFixed(2) + '</td>'
            + '</tr>'
        );
    }

    function change_salary_rate(id)
    {
        if (id == 0) {
            $('#per_hour_rate').prop('readonly', true).addClass( "disabled" );
            $('#yearly_salary').prop('readonly', false).removeClass( "disabled" );
            $('#per_hour_rate').val('');
            $('#yearly_salary').val('');
        } else {
            $('#per_hour_rate').prop('readonly', false).removeClass( "disabled" );
            $('#yearly_salary').prop('readonly', true).addClass( "disabled" );
            $('#per_hour_rate').val('');
            $('#yearly_salary').val('');
        }
        $("#per_pay_period_salary_table tr").remove();
    }

    $("#emp_wage_position").select2({
        placeholder: "Select Position",
        allowClear: true,
    });
    
    $("#pay_schedule").select2({
        placeholder: "Pay Schedule",
        allowClear: true,
    });

    $("#wage_salary_type").select2({
        placeholder: "Salary Type",
        allowClear: true,
    });
    
    $("#wage_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });
</script>
