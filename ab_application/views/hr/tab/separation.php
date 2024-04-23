<?php 
    //$personal_info_query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
    //$personal_info_query = $this->db->select('e.*,w.*')->from('main_employees e')->join('main_emp_workrelated w', 'e.employee_id = w.employee_id')->where('e.employee_id', $employee_id)->get();
    //echo $this->db->last_query();
    //$work_info_query = $this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id));
    //$asser_query = $this->db->get_where('main_emp_assets', array('employee_id' => $employee_id));

    $query = $this->db->get_where('main_emp_separation', array('employee_id' => $employee_id));
    if ($query->num_rows() > 0) {
        $type = 2;
    } else {
        $type = 1;
    }

if($type==1) 
  {
  ?>
    <form id="separation_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employees/save_emp_separation" enctype="multipart/form-data" role="form">
        <div id="sep_emp_div">
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
                                    <?php
                                    $personal_info_query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
                                    foreach ($personal_info_query->result() as $prow) {
                                        ?>
                                        <tr>
                                            <th>First Name : </th>
                                            <td><?php echo ucwords($prow->first_name); ?></td>
                                            <th>Middle Name : </th>
                                            <td><?php echo ucwords($prow->middle_name); ?></td>
                                        </tr>
                                        <tr>
                                            <th>SSN : </th>
                                            <td><?php echo $number = "XXX-XX-". substr($prow->ssn_code, -4); ?></td>
                                            <th>Email : </th>
                                            <td><?php echo $prow->email; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Hire Date : </th>
                                            <td><?php echo $this->Common_model->show_date_formate($prow->hire_date); ?></td>
                                            <th>Birth Date : </th>
                                            <td><?php echo $this->Common_model->show_date_formate($prow->birthdate); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Position : </th>
                                            <td><?php echo $this->Common_model->get_name($this,$prow->position,'main_jobtitles','job_title'); ?></td>
                                            <th>Mobile Phone</th>
                                            <td><?php echo $prow->mobile_phone; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>     
                                </tbody>
                            </table>
                        </div>
                        
                        <?php
                        $work_info_query = $this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id));
                        if ($work_info_query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            Work Related Information:
                            <table id="WorkRelated" class="table table-responsive table-striped table-bordered table-hover">
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($work_info_query->result() as $wrow) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <th>Location : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->location, 'main_location', 'location_name'); ?></td>
                                            <th>Department : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->department, 'main_department', 'department_name'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Reporting Manager : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'first_name') . ' ' . $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'last_name'); ?></td>
                                            <th>Wages : </th>
                                            <td><?php echo $this->Common_model->get_name($this,$wrow->wages,'main_payfrequency','freqtype');?></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                        </div>
                        <?php
                        }
                        ?>
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
                                    <?php
                                    $asser_query = $this->db->get_where('main_emp_assets', array('employee_id' => $employee_id));
                                    foreach ($asser_query->result() as $asrow) {
                                        ?>
                                        <tr>
                                            <th>
                                                <div class="container" style="text-align: left; margin-left: 20px;">
                                                    <div class="row">Asset Type : <?php echo $this->Common_model->get_name($this,$asrow->asset_type_id,'main_assets_type','asset_type'); ?></div>
                                                    <div class="row">Asset Category : <?php echo $this->Common_model->get_name($this,$asrow->asset_category_id,' main_assets_category','asset_category'); ?></div>
                                                    <div class="row">Asset Name : <?php echo $this->Common_model->get_name($this,$asrow->asset_id,'main_assets_name','asset_name'); ?></div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="container" style="text-align: left; margin-left: 20px;">
                                                    <div class="row">Asset Model : <?php echo $this->Common_model->get_name($this,$asrow->asset_model_id,'main_assets_detail','asset_id'); ?></div>
                                                    <div class="row">Issued Date : <?php echo $asrow->issued_date; ?></div>
                                                    <div class="row" style=" color: #72c02c;">Status : <?php if($asrow->IsAssigned==1){echo "Assigned";} else if($asrow->IsAssigned==2){echo "Return";} ?></div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="container" style="text-align: left; margin-left: 20px;">
                                                    <div class="row">Quantity : <?php echo $asrow->quantity; ?></div>
                                                    <div class="row">value : <?php echo $asrow->value; ?></div>
                                                    <div class="row">Total value : <?php echo $asrow->total_value; ?></div>
                                                </div>
                                            </th>
                                        </tr>
                                        <?php
                                    }
                                    ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
        </div>
            
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-u">
                    <div class="panel-heading">
                        Separation Information
                    </div>
                    <div class="panel-body">
                        <input type="hidden" value="" name="emp_Separation_id" id="emp_Separation_id"/>
                        <div class="form-group no-margin">
                            <label class="col-sm-2 control-label">Separation Date<span class="req"/></label>
                            <div class="col-sm-4">
                                <input type="text" name="separation_date" id="separation_date" class="form-control dt_pick input-sm" value="" placeholder="Separation Date" data-toggle="tooltip" data-placement="bottom" title="Separation Date" autocomplete="off">
                            </div>
                            <label class="col-sm-2 control-label">Last Paycheck Date<span class="req"/></label>
                            <div class="col-sm-4">
                                <input type="text" name="last_paycheck_date" id="last_paycheck_date" class="form-control dt_pick input-sm" value="" placeholder="Last Paycheck Date" data-toggle="tooltip" data-placement="bottom" title="Last Paycheck Date" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>

        <div class="modal-footer">
            <button type="submit" id="submit" class="btn btn-u">Save</button>
            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employees" ?>">Close</a>
        </div>
            
        
    </form>  
 <?php 
  }
  else if($type==2) //Update
  {
      ?>
    <form id="separation_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employees/edit_emp_separation" enctype="multipart/form-data" role="form">
       <div id="sep_emp_div">
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
                                    <?php
                                    $personal_info_query = $this->db->get_where('main_employees', array('employee_id' => $employee_id));
                                    foreach ($personal_info_query->result() as $prow) {
                                        ?>
                                        <tr>
                                            <th>First Name : </th>
                                            <td><?php echo ucwords($prow->first_name); ?></td>
                                            <th>Middle Name : </th>
                                            <td><?php echo ucwords($prow->middle_name); ?></td>
                                        </tr>
                                        <tr>
                                            <th>SSN : </th>
                                            <td><?php echo $number = "XXX-XX-". substr($prow->ssn_code, -4); ?></td>
                                            <th>Email : </th>
                                            <td><?php echo $prow->email; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Hire Date : </th>
                                            <td><?php echo $this->Common_model->show_date_formate($prow->hire_date); ?></td>
                                            <th>Birth Date : </th>
                                            <td><?php echo $this->Common_model->show_date_formate($prow->birthdate); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Position : </th>
                                            <td><?php echo $this->Common_model->get_name($this,$prow->position,'main_jobtitles','job_title'); ?></td>
                                            <th>Mobile Phone</th>
                                            <td><?php echo $prow->mobile_phone; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>     
                                </tbody>
                            </table>
                            
                        </div>
                        
                        <?php
                        $work_info_query = $this->db->get_where('main_emp_workrelated', array('employee_id' => $employee_id));
                        if ($work_info_query->num_rows() > 0) {
                        ?>
                        <div class="table-responsive">
                            Work Related Information:
                            <table id="WorkRelated" class="table table-responsive table-striped table-bordered table-hover">
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($work_info_query->result() as $wrow) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <th>Location : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->location, 'main_location', 'location_name'); ?></td>
                                            <th>Department : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->department, 'main_department', 'department_name'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Reporting Manager : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'first_name') . ' ' . $this->Common_model->get_name($this, $wrow->reporting_manager, 'main_employees', 'last_name'); ?></td>
                                            <th>Wages : </th>
                                            <td><?php echo $this->Common_model->get_name($this,$wrow->wages,'main_payfrequency','freqtype');?></td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                        </div>
                        <?php
                        }
                        ?>
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
                                    <?php
                                    $asser_query = $this->db->get_where('main_emp_assets', array('employee_id' => $employee_id));
                                    foreach ($asser_query->result() as $asrow) {
                                        ?>
                                        <tr>
                                            <th>
                                                <div class="container" style="text-align: left; margin-left: 20px;">
                                                    <div class="row">Asset Type : <?php echo $this->Common_model->get_name($this,$asrow->asset_type_id,'main_assets_type','asset_type'); ?></div>
                                                    <div class="row">Asset Category : <?php echo $this->Common_model->get_name($this,$asrow->asset_category_id,' main_assets_category','asset_category'); ?></div>
                                                    <div class="row">Asset Name : <?php echo $this->Common_model->get_name($this,$asrow->asset_id,'main_assets_name','asset_name'); ?></div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="container" style="text-align: left; margin-left: 20px;">
                                                    <div class="row">Asset Model : <?php echo $this->Common_model->get_name($this,$asrow->asset_model_id,'main_assets_detail','asset_id'); ?></div>
                                                    <div class="row">Issued Date : <?php echo $asrow->issued_date; ?></div>
                                                    <div class="row" style=" color: #72c02c;">Status : <?php if($asrow->IsAssigned==1){echo "Assigned";} else if($asrow->IsAssigned==2){echo "Return";} ?></div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="container" style="text-align: left; margin-left: 20px;">
                                                    <div class="row">Quantity : <?php echo $asrow->quantity; ?></div>
                                                    <div class="row">value : <?php echo $asrow->value; ?></div>
                                                    <div class="row">Total value : <?php echo $asrow->total_value; ?></div>
                                                </div>
                                            </th>
                                        </tr>
                                        <?php
                                    }
                                    ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>        
        </div>

        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-u">
                    <div class="panel-heading">
                        Separation Information
                    </div>

                    <div class="panel-body">
                        <?php foreach ($query->result() as $row): ?> 
                            <input type="hidden" value="<?php echo $row->id ?>" name="emp_Separation_id" id="emp_Separation_id"/>
                            <div class="form-group no-margin">
                                <label class="col-sm-2 control-label">Separation Date</label>
                                <div class="col-sm-4">
                                    <input type="text" name="separation_date" id="separation_date" class="form-control dt_pick input-sm" value="<?php echo $this->Common_model->show_date_formate($row->separation_date); ?>" placeholder="Separation Date" data-toggle="tooltip" data-placement="bottom" title="Separation Date" autocomplete="off">
                                </div>
                                <label class="col-sm-2 control-label">Last Paycheck Date</label>
                                <div class="col-sm-4">
                                    <input type="text" name="last_paycheck_date" id="last_paycheck_date" class="form-control dt_pick input-sm" value="<?php echo $this->Common_model->show_date_formate($row->last_paycheck_date); ?>" placeholder="Last Paycheck Date" data-toggle="tooltip" data-placement="bottom" title="Last Paycheck Date" autocomplete="off">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>        
        </div>

        <div class="modal-footer">
            <button type="submit" id="submit" class="btn btn-u">Save</button>
            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employees" ?>">Close</a>
        </div>
           
    </form>
     <?php 
  }
  ?>
