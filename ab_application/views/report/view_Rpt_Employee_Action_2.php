
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
                <table class="table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Position</th> 
                            <th>Action Type</th>
                            <th>Action Date</th>
                            <th>Action Time</th>
                            <th>Discipline Type</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($this->user_group == 11 || $this->user_group == 12) {//com //hr manager
                            $sql = "SELECT main_emp_actions.id, main_emp_actions.employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.id as action_id, main_emp_actions.employee_id, main_emp_actions.action_type, main_emp_actions.action_date, main_emp_actions.accident_time, main_emp_actions.discipline_type FROM main_employees LEFT JOIN main_emp_actions ON main_emp_actions.employee_id = main_employees.employee_id WHERE main_emp_actions.company_id='" . $this->company_id . "' AND main_employees.isactive=1 ORDER BY main_employees.employee_id,main_emp_actions.action_type DESC ";
                        } else {
                            $sql = "SELECT main_emp_actions.id, main_emp_actions.employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.id as action_id, main_emp_actions.employee_id, main_emp_actions.action_type, main_emp_actions.action_date, main_emp_actions.accident_time, main_emp_actions.discipline_type FROM main_employees LEFT JOIN main_emp_actions ON main_emp_actions.employee_id = main_employees.employee_id WHERE  main_employees.isactive=1 ORDER BY main_employees.employee_id,main_emp_actions.action_type DESC ";
                        }
                        $query = $this->db->query($sql);
//                        echo $this->db->last_query($query);  

                        if ($query) {
                            $sqll = "select employee_id, COUNT(employee_id) as row_sp FROM main_emp_actions WHERE main_emp_actions.company_id='" . $this->company_id . "' GROUP BY employee_id";
                            $row_query = $this->db->query($sqll);
                            $xyz = array();
                            $abc = array();
                            foreach ($row_query->result() as $row_span) {
                                $xyz[$row_span->employee_id] = $row_span->row_sp;
                            }
                            $sum = '';
                            $summ = '';
                            foreach ($query->result() as $row) {
                                ?>
                                <tr> 
                                <?php
                                if ($row->employee_id != $sum) {
                                    $sum = $row->employee_id;

                                    $sqlll = "select action_type, COUNT(action_type) as send_row_sp FROM main_emp_actions WHERE main_emp_actions.company_id='" . $this->company_id . "' AND main_emp_actions.employee_id='" . $row->employee_id . "' GROUP BY action_type";
                                    $row_query = $this->db->query($sqlll);
                                    
                                    foreach ($row_query->result() as $row_span) {
                                        $abc[$row->employee_id][$row_span->action_type] = $row_span->send_row_sp;
                                    }
                                    echo $abc[$row->employee_id][$row->action_type];
                                    ?>                                    
                                        <td rowspan='<?php echo $xyz[$row->employee_id]; ?>'><?php echo $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name ?></td>                                    
                                        <td rowspan='<?php echo $xyz[$row->employee_id]; ?>'><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
<!--                                        <td><tr>-->
                                            <?php
                                       //foreach ($row_query->result() as $col) {
                                            if ($row->action_type != $summ) {
                                                $summ = $row->action_type;
                                                ?>                                            
                                                <td rowspan='<?php echo $abc[$row->employee_id][$row->action_type]; ?>'>                                       
                                                <?php 
                                                echo $row->action_type;
                                                //echo $col->action_type == 1 ? "<a href='#' onclick='view_action_falloup(" . $row->action_id . ")'>Accident</a>" : "<a href='#' onclick='view_action_falloup(" . $row->action_id . ")'>Incident</a>"; 
                                                ?>                                    
                                                </td>
                                                <?php 
                                                
                                            }
                                           // }
                                        } ?>
<!--                                           </tr></td>-->
                                    <td><?php echo $this->Common_model->show_date_formate($row->action_date) ?></td>
                                    <td><?php echo $row->accident_time ?></td> 
                                    <td><?php echo $this->Common_model->get_name($this, $row->discipline_type, 'main_disciplinetype', 'discipline_type') ?></td>

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