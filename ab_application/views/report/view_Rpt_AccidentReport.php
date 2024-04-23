
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3"> <!-- container well div -->

            <div class="table-responsive col-md-12 col-centered">
                <form class="form-horizontal" action="<?php echo base_url() . 'Con_Rpt_AccidentReport/get_accident_data/' . $menu_id; ?>" method="post">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Employee: </label>
                            <div class="col-sm-9">
                                <select name="emp_name" id="emp_name" class="col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    if ($emp_list->num_rows() > 0) {
                                        foreach ($emp_list->result() as $key => $row) {
                                            $slct = ($search_criteria['emp_id'] == $row->employee_id) ? 'selected' : '';
                                            echo '<option value="' . $row->employee_id . '" ' . $slct . '>' . $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Accident From: </label>
                            <div class="col-sm-7">
                                <input type="text" name="accident_from" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['accident_from']; ?>" readonly="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">To: </label>
                            <div class="col-sm-10">
                                <input type="text" name="accident_to" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['accident_to']; ?>" readonly="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <button type="submit" class="btn-u"><i class="fa fa-search"></i>Search</button> 
                        </div>
                    </div>
                </form>
            </div>

            <?php if ($show_result) { ?>
                <!-- data table -->
                <div class="table-responsive col-md-12 col-centered">
                    <table class="table responsive-table table-wrap" >
                         <colgroup>
                            <col width="5%">
                            <col width="25%">
                            <col width="25%">
                            <col width="17%">
                            <col width="18%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="width:15%;">Employee Name</th>
                                <th>Position</th>                            
                                <th>Accident Date</th>
                                <th>Accident Time</th>
                                <th>Discipline Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $this->db->select('main_emp_actions.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.employee_id, main_emp_actions.action_date, main_emp_actions.accident_time, main_emp_actions.discipline_type');
                            $this->db->join('main_emp_actions', 'main_emp_actions.employee_id = main_employees.employee_id', 'LEFT');
                            if ($this->user_group == 11 || $this->user_group == 12) {
                                $this->db->where('main_emp_actions.company_id', $this->company_id);
                            }
                            if (!empty($search_ids)) {
                                $this->db->where_in('main_emp_actions.id', $search_ids);
                            }
                            $this->db->where('main_emp_actions.action_type', 2);
                            $this->db->where('main_employees.isactive', 1);
                            $this->db->order_by('main_employees.employee_id', 'DESC');
                            $query = $this->db->get('main_employees');


                            /* if ($this->user_group == 11 || $this->user_group == 12) {//com //hr manager
                              $sql = "SELECT main_emp_actions.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.employee_id, main_emp_actions.action_date, main_emp_actions.accident_time, main_emp_actions.discipline_type FROM main_employees LEFT JOIN main_emp_actions ON main_emp_actions.employee_id = main_employees.employee_id WHERE main_emp_actions.company_id='" . $this->company_id . "' AND main_emp_actions.action_type = 2 AND main_employees.isactive=1 ORDER BY main_employees.employee_id DESC ";
                              } else {
                              $sql = "SELECT main_emp_actions.id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.employee_id, main_emp_actions.action_date, main_emp_actions.accident_time, main_emp_actions.discipline_type FROM main_employees LEFT JOIN main_emp_actions ON main_emp_actions.employee_id = main_employees.employee_id WHERE main_emp_actions.action_type = 2 AND main_employees.isactive=1 AND main_emp_actions.employee_id = main_employees.employee_id ORDER BY main_employees.employee_id DESC ";
                              }
                              $query = $this->db->query($sql); */

                            // echo $this->db->last_query($query);

                            if ($query) {
                                $xtraSql = "";
                                if (!empty($search_ids)) {
                                    $xtraSql = "AND `id` IN (" . implode(', ', $search_ids) . ")";
                                }

                                if ($this->user_group == 11 || $this->user_group == 12) {//com //hr manager
                                    $sqll = "select employee_id, COUNT(employee_id) as row_sp FROM main_emp_actions WHERE main_emp_actions.company_id='" . $this->company_id . "' AND main_emp_actions.action_type = 2 {$xtraSql} GROUP BY employee_id";
                                } else {
                                    $sqll = "select employee_id, COUNT(employee_id) as row_sp FROM main_emp_actions WHERE main_emp_actions.action_type = 2 {$xtraSql} GROUP BY employee_id";
                                }
                                $row_query = $this->db->query($sqll);
                                $xyz = array();

                                foreach ($row_query->result() as $row_span) {
                                    $xyz[$row_span->employee_id] = $row_span->row_sp;
                                }
                                echo $sum = '';

                                foreach ($query->result() as $row) {
                                    ?>
                                    <tr> 
                                        <?php
                                        if ($row->employee_id != $sum) {
                                            $sum = $row->employee_id;
                                            ?>  
                                            <td rowspan='<?php echo $xyz[$row->employee_id]; ?>'><?php echo $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name ?></td>                                    
                                            <td rowspan='<?php echo $xyz[$row->employee_id]; ?>'><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
                                        <?php } ?>
                                        <td><?php echo $this->Common_model->show_date_formate($row->action_date) ?></td>
                                        <td><?php echo $row->accident_time ?></td> 
                                        <td><?php echo $this->Common_model->get_name($this, $row->discipline_type, 'main_disciplinetype', 'discipline_type') ?></td>
                                        <td>                                       
                                            <?php
                                            print "<a title='Employee Accident Report' href='" . base_url() . 'con_Employees/accident_report/' . $row->id . "'><i class='fa fa-lg fa-arrow-down'></i></a>&nbsp;&nbsp;"
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
            <?php } ?>

        </div><!-- end container well div -->
    </div>
</div>

<script type="text/javascript">
    $("select#emp_name").select2({
        placeholder: "Select Employee",
        allowClear: true
    });
</script>

</div><!--/row-->
</div><!--/container-->