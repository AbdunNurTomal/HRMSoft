<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
            <!-- data table -->
            <form id="Quick_Modification_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Quick_Modification_Explorer/Quick_get_employee" enctype="multipart/form-data" role="form">
            <div class="table-responsive col-md-12 col-centered">
                <!-- <div class="overflow-x" style="overflow-y: scroll; margin-bottom: 12px; max-height: 500px;"> -->
                <table id="dataTables-example_qm" class="table table-striped table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th><input name="CheckAll" id="CheckAll" class="CheckAll" type="checkbox" > </th>
                            <!--<th> SL </th>-->
                            <th>Employee Code </th>
                            <th>Employee ID </th>
                            <th>Name </th>
                            <th>SSN </th>
                            <th>Position </th>
                            <th>Department </th>
                            <th>Pay Type </th>
                            <th>Pay Schedule </th>
                            <th>Rate </th>
                            <th>Salary </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($this->user_group == 11 || $this->user_group == 12) {
                            $positions_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
                        } else {
                            $positions_query = $this->db->get_where('main_positions', array('isactive' => 1));
                        }
                        
                        if ($this->user_group == 11 || $this->user_group == 12) {
                            $department_query = $this->db->get_where('main_department', array('company_id' => $this->company_id, 'isactive' => 1));
                            $wages_query = $this->db->get_where('main_payfrequency', array('company_id' => $this->company_id, 'isactive' => 1));
                        } else {
                            $department_query = $this->db->get_where('main_department', array('isactive' => 1));
                            $wages_query = $this->db->get_where('main_payfrequency', array('isactive' => 1));
                        }

                        $wage_type_array = $this->Common_model->get_array('wage_type');
                        if ($this->user_group == 10) {//self
                            $sql = "SELECT main_employees.id,main_employees.import_employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department,main_emp_workrelated.wages,main_emp_workrelated.salary_type,main_emp_workrelated.per_hour_rate,main_emp_workrelated.per_pay_period_salary FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.emp_user_id='" . $this->user_id . "' Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        }
                        else if ($this->user_group == 11 ) {//Hr Manager 
                            
                            $rpt_men_emp_id=$this->Common_model->get_selected_value($this,'emp_user_id',$this->user_id,'main_employees','employee_id');
                            $sql = "SELECT main_employees.id,main_employees.import_employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department,main_emp_workrelated.wages,main_emp_workrelated.salary_type,main_emp_workrelated.per_hour_rate,main_emp_workrelated.per_pay_period_salary FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='" . $this->company_id . "' and main_emp_workrelated.reporting_manager='" . $rpt_men_emp_id . "' Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        }
                        else if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                            $sql = "SELECT main_employees.id,main_employees.import_employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department,main_emp_workrelated.wages,main_emp_workrelated.salary_type,main_emp_workrelated.per_hour_rate,main_emp_workrelated.per_pay_period_salary FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='" . $this->company_id . "' Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        } else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
                            //$sql = "SELECT main_employees.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.createdby IN (" . get_sub_users($this->user_id) . ") Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                            $sql = "SELECT main_employees.id,main_employees.import_employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department,main_emp_workrelated.wages,main_emp_workrelated.salary_type,main_emp_workrelated.per_hour_rate,main_emp_workrelated.per_pay_period_salary FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id WHERE main_employees.company_id='0' and  main_employees.createdby IN (" . get_sub_users($this->user_id) . ") Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        } else {
                            $sql = "SELECT main_employees.id,main_employees.import_employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address,main_employees.city,main_employees.state,main_employees.zipcode,main_employees.ssn_code,main_employees.county, main_employees.marital_status,main_employees.email, main_employees.employee_id, main_employees.hire_date,main_employees.home_phone, main_employees.mobile_phone,main_employees.work_phone,main_employees.image_location,main_employees.image_name, main_employees.isactive, main_employees.position, main_emp_workrelated.location, main_emp_workrelated.department,main_emp_workrelated.wages,main_emp_workrelated.salary_type,main_emp_workrelated.per_hour_rate,main_emp_workrelated.per_pay_period_salary FROM main_employees LEFT JOIN main_emp_workrelated ON main_emp_workrelated.employee_id = main_employees.employee_id  WHERE main_employees.emp_user_id='" . $this->user_id . "' Group BY main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                        }
                        //$this->db->order_by("name", "asc");
                        $query = $this->db->query($sql);

                        //echo $this->db->last_query();

                        if ($query) {
                            $i=0;
                            foreach ($query->result() as $row) {
                                $i++;
                                if($row->salary_type==NULL)$salary_type=""; else $salary_type=$wage_type_array[$row->salary_type];
                                ?>
                                <tr>
                                    <td><input name="empCheck[]" id="empCheck" type="checkbox" value="<?php echo $row->employee_id; ?>"></td>
                                    <!--<td><?php // echo $i; ?></td>-->
                                    <td><?php echo sprintf("%07d", $row->employee_id); ?></td>
                                    <td><?php echo $row->import_employee_id; ?></td>
                                    <td><?php echo $this->Common_model->employee_name($row->employee_id); ?></td>
                                    <td><?php echo $number = "XXX-XX-" . substr($this->Common_model->decrypt($row->ssn_code), -4); ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title'); ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->department, 'main_department', 'department_name'); ?></td>
                                    <td><?php echo $salary_type; ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->wages,'main_payfrequency_type','freqcode'); ?></td>
                                    <td><?php echo number_format($row->per_hour_rate,2); ?></td>
                                    <td><?php echo number_format($row->per_pay_period_salary,2); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
               <!--  </div> -->
            </div>
            <!-- end data table -->
            
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u"> Quick  Processing </button>
                </div>
            
            </form>
<!--            <div class="modal-footer">
                <button type="button" onclick="open_Quick_Modification_modal();" class="btn btn-u"> Quick  Processing </button>
            </div>-->
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<!-- Modal -->
<div class="modal fade" id="Quick_Modification_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Quick Edits </h4>
            </div>
            <form id="Quick_Modification_modal_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="employee_id" id="employee_id"/>
                <div class="modal-body">
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Position </label>
                        <div class="col-sm-4">
                            <select name="quickPosition" id="quickPosition" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($positions_query->result() as $key): ?>
                                    <option value="<?php echo $key->positionname ?>"><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Department </label>
                        <div class="col-sm-4">
                            <select name="quickDepartment" id="quickDepartment" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($department_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->department_name ?></option>
                                <?php endforeach; ?>
                            </select>                        
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Pay Type </label>
                        <div class="col-sm-4">
                            <select name="quickPayType" id="quickPayType" onchange="set_rate_salary(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($wage_type_array as $keyw => $valw):
                                    ?>
                                    <option value="<?php echo $keyw ?>"><?php echo $valw ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>                          
                        </div> 
                        <label class="col-sm-2 control-label">Pay Schedule </label>
                        <div class="col-sm-4">
                            <select name="quickPaySchedule" id="quickPaySchedule" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($wages_query->result() as $key):
                                    $freqtype = $this->Common_model->get_name($this, $key->freqtype, 'main_payfrequency_type', 'freqcode');
                                    ?>
                                    <option value="<?php echo $key->freqtype ?>"><?php echo $freqtype ?></option>
                                <?php endforeach; ?>
                            </select>                          
                        </div>
                    </div> 
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Rate</label>
                        <div class="col-sm-4">
                            <input readonly="" type="text" name="rate" id="rate" class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Rate" title="Rate">
                        </div>
                        <label class="col-sm-2 control-label">Salary </label>
                        <div class="col-sm-4">
                            <input readonly="" type="text" name="salary" id="salary" class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Salary" title="Salary">
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

<script type="text/javascript">
    
  /*  $(document).ready(function () {
       $('#dataTables-example_qm').dataTable({
           "order": [1, "asc"],
           "pageLength": 15,
           "scrollX": true,
       });
   }); */

   $(document).ready(function () {
        $('#dataTables-example_qm').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });

    var save_method; //for save method string
    
     $(function () {
        $("#Quick_Modification_form").submit(function (event) {
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#Quick_Modification_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                if(data)
                {
                    save_method = 'add';
                    $('#Quick_Modification_modal_form')[0].reset(); // reset form on modals
                    
                    $("#quickPosition").select2({
                        placeholder: "Select Position",
                        allowClear: true,
                    });

                    $("#quickDepartment").select2({
                        placeholder: "Select Department",
                        allowClear: true,
                    });

                    $("#quickPayType").select2({
                        placeholder: "Select Pay Type",
                        allowClear: true,
                    });

                    $("#quickPaySchedule").select2({
                        placeholder: "SelectPay Schedule",
                        allowClear: true,
                    });
    
                    $('#Quick_Modification_modal').modal('show'); // show bootstrap modal
                    $('.modal-title').text('Quick Edits '); // Set Title to Bootstrap modal title

                    $('#employee_id').val(data);
                }
                else
                {
                    alert ('Select Employee');
                }

            });
            event.preventDefault();
        });
    });
    
    $(function () {
        $("#Quick_Modification_modal_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Quick_Modification_Explorer/save_Quick_Modification_Explorer') ?>";
            } else
            {
                url = "<?php echo site_url('Con_Quick_Modification_Explorer/save_Quick_Modification_Explorer') ?>";
            }
            $.ajax({
                url: url,
                data: $("#Quick_Modification_modal_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                var url = '<?php echo base_url() ?>Con_Quick_Modification_Explorer';
                view_message(data, url, 'Quick_Modification_modal', 'Quick_Modification_modal_form');

            });
            event.preventDefault();
        });
    });

    $("#quickPosition").select2({
        placeholder: "Select Position",
        allowClear: true,
    });

    $("#quickDepartment").select2({
        placeholder: "Select Department",
        allowClear: true,
    });

    $("#quickPayType").select2({
        placeholder: "Select Pay Type",
        allowClear: true,
    });

    $("#quickPaySchedule").select2({
        placeholder: "SelectPay Schedule",
        allowClear: true,
    });
    
    $('.CheckAll').change(function(){   
       this.checked ? $('input[type=checkbox]').prop('checked', true): $('input[type=checkbox]').prop('checked', false);
    });
    
    function set_rate_salary(id){
        if(id==0)
        {
            $('#rate').prop('readonly', true);
            $('#salary').prop('readonly', false);
        }else{
            $('#salary').prop('readonly', true);
            $('#rate').prop('readonly', false);
        }
    }



</script>
<!--=== End Content ===-->
