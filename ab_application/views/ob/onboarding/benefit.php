<div class="row">
    <!-- data table -->
    <div class="col-md-12" id="ob_benefit_div">
        <button class="btn btn-u btn-md" onClick="add_ob_benefit()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
             <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="15%">
                <col width="12%">
                <col width="13%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Enrolling</th>
                    <th>Provider</th>
                    <th>Benefit Type</th>
                    <th>Eligible Date</th>
                    <th>Enrolled Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 9 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                    $benefits_provider_query = $this->db->get_where('main_benefits_provider', array('company_id' => $this->company_id,'isactive' => 1));
                    $benefit_type_query = $this->db->get_where('main_benefit_type', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $benefits_provider_query = $this->db->get_where('main_benefits_provider', array('isactive' => 1));
                    $benefit_type_query = $this->db->get_where('main_benefit_type', array('isactive' => 1));
                }
                
                $percent_dollars_array = $this->Common_model->get_array('percent_dollars');
                $status_array = $this->Common_model->get_array('status');
                
                if ($type == 1) {
                    $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
                    $ob_emp_id = $this->onboarding_employee_data['onboarding_employee_id'];
                } else if ($type == 2) { //for Update
                    $ob_emp_id = $ob_emp_id;
                }
                
                $query = $this->db->get_where('main_ob_benefit', array('onboarding_employee_id' => $ob_emp_id));
                if ($query) {
                    $i=0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->enrolling, 'main_ob_enrolling', 'fast_name') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->provider, 'main_benefits_provider', 'service_provider_name') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->benefit_type, 'main_benefit_type', 'benefit_type') . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->eligible_date) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->enrolled_date) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $status_array[$row->isactive] . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_ob_benefit(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_ob_benefit(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>


<div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
    <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
    <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(1)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
</div>


<div class="modal fade bd-example-modal-lg" id="ob_benefit_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Criminal History</h4>
            </div>
            <form id="onboarding_benefit_form" name="sky-form11" class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="benefit_id" id="benefit_id"/>
                <input type="hidden" value="" name="onboarding_employee_id" id="onboarding_employee_id"/>
                
                <div class="modal-body">
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Provider<span class="req"/></label>
                        <div class="col-sm-4">
                           <select name="provider" id="provider" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($benefits_provider_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->service_provider_name ?></option> 
                                <?php endforeach; ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Benefit Type<span class="req"/></label>
                        <div class="col-sm-4">
                           <select name="benefit_type" id="benefit_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($benefit_type_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->benefit_type ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Eligible Date <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="eligible_date" id="eligible_date" class="form-control input-sm dt_pick" placeholder="Eligible Date" data-toggle="tooltip" data-placement="bottom" title="Eligible Date">
                        </div>
                        <label class="col-sm-2 control-label">Enrolled Date <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="enrolled_date" id="enrolled_date" class="form-control input-sm dt_pick" placeholder="Enrolled Date" data-toggle="tooltip" data-placement="bottom" title="Enrolled Date">
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Enrolling <span class="req"/> </label>
                        <div id="ben_enrolling_div">
                            <div class="col-sm-4">
                               <select name="benefit_enrolling" id="benefit_enrolling" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php 
                                    $ob_enrolling_query = $this->db->get_where('main_ob_enrolling', array('isactive' => 1,'onboarding_employee_id' => $ob_emp_id));
                                    foreach ($ob_enrolling_query->result() as $key): 
                                        $relationship=$this->Common_model->get_name($this, $key->relationship, 'main_relationship_status', 'relationship_status')
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->fast_name." (". $relationship .") "; ?></option> 
                                    <?php endforeach; ?>
                                </select> 
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">Percent or Dollars</label>
                        <div class="col-sm-4">
                            <select name="percent_dollars" id="percent_dollars" onchange="change_Persentase_doller(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($percent_dollars_array as $key => $val): ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee Portion</label>
                        <div class="col-sm-4">
                            <input type="text" name="employee_portion" id="employee_portion" class="form-control input-sm" placeholder="Employee Portion" data-toggle="tooltip" data-placement="bottom" title="Employee Portion">
                        </div>
                        <label class="col-sm-2 control-label">Employer Portion</label>
                        <div class="col-sm-4">
                            <input type="text" name="employer_portion" id="employer_portion" class="form-control input-sm" placeholder="Employer Portion" data-toggle="tooltip" data-placement="bottom" title="Employer Portion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deduction Frequency</label>
                        <div class="col-sm-4">
                            <select name="deduction_frequency" id="deduction_frequency" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $pay_freq = $this->db->get_where('main_payfrequency_type', array('company_id' => $this->company_id));
                                foreach ($pay_freq->result() as $row) :
                                    ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->freqcode; ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Status </label>
                        <div class="col-sm-4">
                            <select name="benefit_status" id="benefit_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                foreach ($status_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>" <?php if($key==1) echo "selected" ?> ><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
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
    
    $(document).ready(function () {
        $('#dataTables-example-benefit').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5,
            "paginationType": "input"    
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_ob_benefit()
    {
        save_method = 'add';
        $('#onboarding_benefit_form')[0].reset(); // reset form on modals
        
        $("#benefit_enrolling").select2({
            placeholder: "Select Enrolling",
            allowClear: true,
        });

         $("#provider").select2({
            placeholder: "Select Provider",
            allowClear: true,
         });

         $("#benefit_type").select2({
            placeholder: "Select Benefit Type",
            allowClear: true,
         });

         $("#percent_dollars").select2({
            placeholder: "Select Percent or Dollars",
            allowClear: true,
         });
         
         $("#deduction_frequency").select2({
            placeholder: "Select Deduction Frequency",
            allowClear: true,
         });
         
         $("#benefit_status").select2({
            placeholder: "Select Status",
            allowClear: true,
         });
    
        $('#ob_benefit_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Benefit'); // Set Title to Bootstrap modal title
    }
    
    $("#benefit_enrolling").select2({
        placeholder: "Select Enrolling",
        allowClear: true,
    });
    
    $("#provider").select2({
       placeholder: "Select Provider",
       allowClear: true,
    });
    
    $("#benefit_type").select2({
       placeholder: "Select Benefit Type",
       allowClear: true,
    });
    
    $("#percent_dollars").select2({
       placeholder: "Select Percent or Dollars",
       allowClear: true,
    });
    
    $("#deduction_frequency").select2({
        placeholder: "Select Deduction Frequency",
        allowClear: true,
     });
         
    $("#benefit_status").select2({
       placeholder: "Select Status",
       allowClear: true,
    });
    
    function change_Persentase_doller(id)
    {
        if(id==2)
        {
            $("#employee_portion").removeAttr("placeholder");
            $("#employee_portion").attr("placeholder", " Dollar ( $ )");
            $("#employer_portion").removeAttr("placeholder");
            $("#employer_portion").attr("placeholder", " Dollar ( $ )");
        }
        else
        {
            $("#employee_portion").removeAttr("placeholder");
            $("#employee_portion").attr("placeholder", " Percentage ( % )");
            $("#employer_portion").removeAttr("placeholder");
            $("#employer_portion").attr("placeholder", " Percentage ( % )");
        }
        
    }
  
</script>
