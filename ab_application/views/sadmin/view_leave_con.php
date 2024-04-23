
<div class="col-md-12 main-content-div">
    <div class="main-content">
        
        <div class="container conbre">
            <ol class="breadcrumb" >
                <!--<li><a href="<?php // echo base_url() . 'Con_configaration' ?>">Configaration</a></li>-->
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        
        <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;"> 

            <form id="con_leave" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_license"/>
                <div class="modal-body" id="leave-modal-body">
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Identification</h4></u></label>
                        </div> 

                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Description:</label>
                        </div> 
                        <div class="col-md-9 col-sm-6 find_mar">
                            <input type="text" name="paid_description" id="paid_description" class="form-control input-sm" placeholder="Description" />
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Report description:</label>
                        </div> 
                        <div class="col-md-9 col-sm-6 find_mar">
                            <input type="text" name="report_description" id="report_description" class="form-control input-sm" placeholder="Report description" />
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Accrual information </h4></u></label>
                        </div>
                        <div class="col-md-6 col-sm-6 find_mar">
                            <label class="col-sm-6 col-xs-6 control-label pull-left">Method:</label>
                            <select name="method" id="method" class="col-sm-12 col-xs-12 myselect2 input-sm" >
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
                                <label><input type="checkbox" name="ot_hour" id="ot_hour" value="1">Include OT Hour</label>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-6 col-sm-6 find_mar">
                            <label class="col-md-6 control-label">Hourly Allowance:</label>
                            <div class="col-md-6">
                                <div class="radio col-md-6">
                                    <label> <input type="radio" id="hourly_allowance_option" name="hourly_allowance_option" value="1" > Fixed</label>
                                </div>
                                <div class="col-sm-6">
                                    <label><input type="text" name="fixed_amount" id="fixed_amount" class="form-control input-sm" value=""></label>
                                </div>
                                <div class="radio col-md-6">
                                    <label> <input type="radio" id="hourly_allowance_option" name="hourly_allowance_option" value="2" >Graduated</label>
                                </div> 
                                <div class="col-md-3">
                                    <label><a href="#" onclick="show_table();" class="btn btn-u">Table</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 find_mar">
                            <div class="col-md-12">
                                <label><input type="checkbox" name="dt_hour" id="dt_hour" value="1">Include DT Hour</label>
                            </div>
                            <div class="col-md-12">
                                <label><input type="checkbox" name="accruable_benefit_hour" id="accruable_benefit_hour" value="1" >Include Accruable Benefit Hour</label>
                            </div>
                        </div> 
                    </div>
                    
                    <table id="dataTables-example" class="table table-striped table-bordered table-hover disabled" >
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th>Hourly Allowance</th>
                                <th>Available Limit</th>
                                <th>Check Limit</th>
                                <th>Month Limit</th>
                                <th>Annual Limit</th>
                                <th>Carryover Maximum</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="carryover_maximum" id="carryover_maximum" placeholder="" /></td>
                                <td><input type="text" name="carryover_maximum" id="carryover_maximum" placeholder="" /></td>
                                <td><input type="text" name="carryover_maximum" id="carryover_maximum" placeholder="" /></td>
                                <td><input type="text" name="carryover_maximum" id="carryover_maximum" placeholder="" /></td>
                                <td><input type="text" name="carryover_maximum" id="carryover_maximum" placeholder="" /></td>
                                <td><input type="text" name="carryover_maximum" id="carryover_maximum" placeholder="" /></td>
                                <td><input type="text" name="carryover_maximum" id="carryover_maximum" placeholder="" /></td>
                                <td><input type="text" name="carryover_maximum" id="carryover_maximum" placeholder="" /></td>
                                <td>
                                    <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                    <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                     
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Eligibility </h4></u></label>
                        </div>
                        <div class="col-md-12 pull-right">
                            <div class="col-md-4 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Delay Benefit Accrual Until:</label>
                            </div> 
                            <div class="col-md-2 col-sm-3 find_mar">
                                <input type="text" name="benefit_accrual_until" id="benefit_accrual_until" class="form-control input-sm" value="" />
                            </div>
                            <div class="col-md-2 col-sm-3 find_mar">
                                <input type="text" name="hire_date1" id="hire_date1" class="form-control dt_pick" placeholder="Date" />
                            </div>
                            <div class="col-md-4 col-sm-3 find_mar">
                                <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left">After Employee's Hire Date </label>
                            </div> 

                        </div>
                        <div class="col-md-12 pull-right">
                            <div class="col-md-5 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Delay Accrual Hours Availability Until:</label>
                            </div> 
                            <div class="col-md-1 col-sm-3 find_mar">
                                <input type="text" name="accrual_hours_availability_until" id="accrual_hours_availability_until" class="form-control input-sm" value="" />
                            </div>
                            <div class="col-md-2 col-sm-3 find_mar">
                                <input type="text" name="hire_date" id="hire_date" class="form-control dt_pick" placeholder="Date" />
                            </div>
                            <div class="col-md-4 col-sm-3 find_mar">
                                <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left">After Employee's Hire Date  </label>
                            </div> 

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <label class="col-sm-12 pull-right"><u><h4>Limits </h4></u></label>
                        </div>
                        <div class="col-md-12 pull-right">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Available Limil:</label>
                            </div> 
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="available_limil" id="available_limil" class="form-control input-sm" value="" />
                            </div>                            
                            <div class="col-md-3 col-sm-3 find_mar">
                                <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left"> Per Check Limit: </label>
                            </div>
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="per_check_limit" id="per_check_limit" class="form-control " placeholder="" />
                            </div>

                        </div>
                        <div class="col-md-12 pull-right">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Annual Limit:</label>
                            </div> 
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="annual_limit" id="annual_limit" class="form-control input-sm" value="" />
                            </div>                            
                            <div class="col-md-3 col-sm-3 find_mar">
                                <label style="text-align: left;" class="col-sm-12 col-xs-4 control-label pull-left">Per Month Limit:  </label>
                            </div> 
                            <div class="col-md-3 col-sm-3 find_mar">
                                <input type="text" name="per_month_limit" id="per_month_limit" class="form-control" placeholder="" />
                            </div>

                        </div>
                    </div>
                    <div class="row">
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
                                <label><input type="checkbox" name="reset_beginning_balance" value="1">Reset Beginning Balance To Zero </label>
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
                    <div class="row">                        
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
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                    &nbsp; 
                                    <label><input type="button" value="...."></label>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a class="btn btn-u" href="<?php echo base_url() . "Con_configaration" ?>">Close</a>
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                    </div>
                </div>
            </form>

            
        </div>

    </div>
</div>

</div><!--/end row-->
</div><!--/end container-->



<script type="text/javascript">

    $("#method").select2({
        placeholder: "Method",
        allowClear: true,
    });
    
    $("#workers_compensation").select2({
        placeholder: "Workers Compensation",
        allowClear: true,
    });
    
    function show_table()
    {
         $("#table_content").removeClass("disabled");
    }


   
</script>


