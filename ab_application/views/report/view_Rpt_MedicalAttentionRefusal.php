
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
                <table id="dataTables-example" class="table table-striped table-hover responsive-table table-wrap" >
                     <colgroup>
                        <col width="10%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th style="width:15%;">Employee Name</th>
                            <th>Position</th>
                            <th>Accident Date</th>
                            <th>Accident Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($this->user_group == 11 || $this->user_group == 12) {//com //hr manager
                            $sql = "SELECT main_emp_actions.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.employee_id, main_emp_actions.action_date, main_emp_actions.accident_time FROM main_employees LEFT JOIN main_emp_actions ON main_emp_actions.employee_id = main_employees.employee_id WHERE main_emp_actions.company_id='" . $this->company_id . "' AND main_emp_actions.action_type = 2 AND main_employees.isactive=1 ORDER BY main_employees.employee_id DESC ";
                        } else {
                            $sql = "SELECT main_emp_actions.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.employee_id, main_emp_actions.action_date, main_emp_actions.accident_time FROM main_employees LEFT JOIN main_emp_actions ON main_emp_actions.employee_id = main_employees.employee_id WHERE main_emp_actions.action_type = 2 AND main_employees.isactive=1 ORDER BY main_employees.employee_id DESC ";
                        }
                        $query = $this->db->query($sql);
                        if ($query) {
                            foreach ($query->result() as $row) {
                                ?>
                                <tr>                                    
                                    <td><?php echo $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
                                    <td><?php echo $this->Common_model->show_date_formate($row->action_date) ?></td>
                                    <td><?php echo $row->accident_time ?></td>                                    
                                    <td>                                       
                                        <?php
                                        print "<a title='Medical Attention Refusal' href='" . base_url() . 'Con_Employees/medical_attention_refusal/' . $row->id . "'><i class='fa fa-lg fa-cloud-download'></i></a>&nbsp;&nbsp;"
                                        ?>                                    
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
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->