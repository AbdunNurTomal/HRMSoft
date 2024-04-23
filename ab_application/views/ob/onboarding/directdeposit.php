<div class="row">
    <!-- data table -->
    <div class="col-md-12" id="ob_directdeposit_div">
        <button class="btn btn-u btn-md" onClick="javascript:add_ob_directdeposit()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-directdeposit" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
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
                    <th>Bank Name</th>
                    <th>Account Number</th>
                    <th>Routing Number</th>
                    <th>Account Type</th>
                    <th>Amount Type</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 9 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                    $bank_account_types_query = $this->db->get_where('main_bank_account_types', array('company_id' => $this->company_id));
                } else {
                    $bank_account_types_query = $this->Common_model->listItem('main_bank_account_types');
                }
                
               // echo $this->db->last_query();
                
                $amount_type_array = $this->Common_model->get_array('amount_type');
                
                
                if ($type == 1) {
                    $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
                    $ob_emp_id = $this->onboarding_employee_data['onboarding_employee_id'];
                } else if ($type == 2) {
                    $ob_emp_id = $ob_emp_id;
                }
                
                $query = $this->db->get_where('main_ob_direct_deposit', array('onboarding_employee_id' => $ob_emp_id,'isactive' => 1));
                
                if ($query) {
                    $i=0;
                    foreach ($query->result() as $row) {
                        $i++;
                        if ($row->amount_type == 0) {
                            $amount_type = "";
                        } else {
                            $amount_type = $amount_type_array[$row->amount_type];
                        }
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->bank_name) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->account_number . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $row->routing_number . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->account_type,'main_bank_account_types','bank_account_type') . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $amount_type . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $row->acc_value . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_ob_directdeposit(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_ob_directdeposit(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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


<div class="modal fade bd-example-modal-lg" id="directdeposit_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Direct Deposit</h4>
            </div>
            <form id="onboarding_directdeposit_form" name="sky-form11" class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="directdeposit_id"/>
                <input type="hidden" value="" name="onboarding_employee_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bank Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="bank_name" id="bank_name" class="form-control input-sm"  placeholder="Bank Name" data-toggle="tooltip" data-placement="bottom" title="Bank Name">
                        </div>
                        <label class="col-sm-2 control-label">Account Number<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="account_number" id="account_number" class="form-control input-sm"  placeholder="Account Number" data-toggle="tooltip" data-placement="bottom" title="Account Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Routing Number<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="routing_number" id="routing_number" class="form-control input-sm"  placeholder="Routing Number" data-toggle="tooltip" data-placement="bottom" title="Routing Number">
                        </div>
                        <label class="col-sm-2 control-label">Account Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="account_type" id="account_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($bank_account_types_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->bank_account_type ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-4">
                            <select name="amount_type" id="amount_type" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="change_Persentase_Fixed(this.value)" >
                                <?php
                                foreach ($amount_type_array as $key=>$val):
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Value</label>
                        <div class="col-sm-4">
                            <input type="text" name="acc_value" id="acc_value" class="form-control input-sm"  placeholder="Percentage ( % )" data-toggle="tooltip" data-placement="bottom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Paid as Live Check </label>
                        <div class="col-sm-4">
                            <select name="paid_check" id="paid_check" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $yes_no_array = $this->Common_model->get_array('yes_no');
                                foreach ($yes_no_array as $keyy=>$vall):
                                    ?>
                                    <option value="<?php echo $keyy ?>"><?php echo $vall ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
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
    
    function change_Persentase_Fixed(id)
    {
        if(id==2)
        {
            $("#acc_value").removeAttr("placeholder");
            $("#acc_value").attr("placeholder", "$ Fixed ( Amount )");
        }
        else
        {
            $("#acc_value").removeAttr("placeholder");
            $("#acc_value").attr("placeholder", "Percentage ( % )");
        }
        
    }
    
    $(document).ready(function () {
        $('#dataTables-example-directdeposit').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5,
            "paginationType": "input"    
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_ob_directdeposit()
    {
        save_method = 'add';
        $('#onboarding_directdeposit_form')[0].reset(); // reset form on modals
        
        $("#account_type").select2({
            placeholder: "Account Type",
            allowClear: true,
        });

        $("#amount_type").select2({
            placeholder: "Amount Type",
            allowClear: true,
        });
        
        $("#paid_check").select2({
            placeholder: "Paid as Live Check",
            allowClear: true,
        });
    
        $('#directdeposit_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Direct Deposit'); // Set Title to Bootstrap modal title
    }
  
    
    $("#account_type").select2({
        placeholder: "Account Type",
        allowClear: true,
    });
    
    $("#amount_type").select2({
        placeholder: "Amount Type",
        allowClear: true,
    });
    
    $("#paid_check").select2({
        placeholder: "Paid as Live Check",
        allowClear: true,
    });
    
    $(function() {
        $("#routing_number").mask("999999999");       
    });

</script>
