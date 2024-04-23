
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            
            <div class="table-responsive col-md-12 col-centered">

                <form class="form-horizontal" action="<?php echo base_url() . 'Con_Rpt_EmployeeAction/get_action_report_data/' . $menu_id; ?>" method="post">
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Employee </label>
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
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> Type </label>
                            <div class="col-sm-9">
                                <select name="action_type" id="action_type" class="col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $action_type_arr = array(1 => 'Incident', 2 => 'Accident');
                                    foreach ($action_type_arr as $row => $val) {
                                        $sslct = ($search_criteria['action_type'] == $row) ? 'selected' : '';
                                        print"<option value='" . $row . "' ".  $sslct .">" . $val . "</option>";
                                    }
                                    ?>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label"> From: </label>
                            <div class="col-sm-8">
                                <input type="text" name="action_from" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_from']; ?>" readonly="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">To: </label>
                            <div class="col-sm-8">
                                <input type="text" name="action_to" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_to']; ?>" readonly="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-5">
                            <div class="form-group">
                                <button type="submit" class="btn-u"><i class="fa fa-search"></i>Search</button> 
                            </div>
                        </div>
                    </div>
                   
                </form>

            </div>
            <?php if ($show_result) { ?>
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <table class="table table-striped table-hover responsive-table table-wrap" >
                     <colgroup>
                        <col width="5%">
                        <col width="21%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th style="width:15%;">Employee Name</th>
                            <th>Position</th> 
                            <th>Action Type</th>
                            <th>Action Date</th>
                            <th>Action Time</th>
                            <th>Discipline Type</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
//                        if ($this->user_group == 11 || $this->user_group == 12) {//com //hr manager
//                            $sql = "SELECT main_emp_actions.id, main_emp_actions.employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.id as action_id, main_emp_actions.employee_id, main_emp_actions.action_type, main_emp_actions.action_date, main_emp_actions.accident_time, main_emp_actions.discipline_type FROM main_employees LEFT JOIN main_emp_actions ON main_emp_actions.employee_id = main_employees.employee_id WHERE main_emp_actions.company_id='" . $this->company_id . "' AND main_employees.isactive=1 ORDER BY main_employees.employee_id,main_emp_actions.action_type DESC ";
//                        } else {
//                            $sql = "SELECT main_emp_actions.id, main_emp_actions.employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name, main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.id as action_id, main_emp_actions.employee_id, main_emp_actions.action_type, main_emp_actions.action_date, main_emp_actions.accident_time, main_emp_actions.discipline_type FROM main_employees LEFT JOIN main_emp_actions ON main_emp_actions.employee_id = main_employees.employee_id WHERE  main_employees.isactive=1 AND main_emp_actions.employee_id = main_employees.employee_id ORDER BY main_employees.employee_id,main_emp_actions.action_type DESC ";
//                        }
//                        $query = $this->db->query($sql);
//                        echo $this->db->last_query($query);  
                        
                        $this->db->select('main_emp_actions.id as action_id, main_emp_actions.action_type,main_emp_actions.employee_id, main_employees.salutation, main_employees.first_name, main_employees.middle_name,main_employees.last_name, main_employees.first_address, main_employees.second_address, main_employees.position, main_employees.isactive, main_emp_actions.employee_id, main_emp_actions.action_date, main_emp_actions.accident_time, main_emp_actions.discipline_type');
                        $this->db->join('main_emp_actions', 'main_emp_actions.employee_id = main_employees.employee_id', 'LEFT');
                        if ($this->user_group == 11 || $this->user_group == 12) {
                            $this->db->where('main_emp_actions.company_id', $this->company_id);
                        }
                        if (!empty($search_ids)) {
                            $this->db->where_in('main_emp_actions.id', $search_ids);
                        }
                        //$this->db->where('main_emp_actions.action_type', 1);
                        $this->db->where('main_employees.isactive', 1);
                        $this->db->order_by('main_employees.employee_id', 'DESC');
                        $query = $this->db->get('main_employees');
                           // echo $this->db->last_query();exit();

                        if ($query) {
                            
                            $xtraSql = "";
                            if (!empty($search_ids)) {
                                $xtraSql = "AND `id` IN (" . implode(', ', $search_ids) . ")";
                            }
                                
                            if ($this->user_group == 11 || $this->user_group == 12) {//com //hr manager
                                $sqll = "select employee_id, COUNT(employee_id) as row_sp FROM main_emp_actions WHERE main_emp_actions.company_id='" . $this->company_id . "' {$xtraSql} GROUP BY employee_id";
                            } else {
                                $sqll = "select employee_id, COUNT(employee_id) as row_sp FROM main_emp_actions {$xtraSql} GROUP BY employee_id";
                            }
                            
                            $row_query = $this->db->query($sqll);
                            $xyz = array();
                            $abc = array();
                            foreach ($row_query->result() as $row_span) {
                                $xyz[$row_span->employee_id] = $row_span->row_sp;
                            }
                            $sum = '';
                            foreach ($query->result() as $row) {
                                
                                $sqlll = "select action_type, COUNT(action_type) as send_row_sp FROM main_emp_actions WHERE main_emp_actions.company_id='" . $this->company_id . "' AND main_emp_actions.employee_id='" . $row->employee_id . "' GROUP BY action_type";
                                $row_query = $this->db->query($sqlll);

                                foreach ($row_query->result() as $row_span) {
                                    $abc[$row->employee_id][$row_span->action_type] = $row_span->send_row_sp;
                                }
                                    
                                ?>
                                <tr> 
                                    <?php
                                    if ($row->employee_id != $sum) {
                                        $sum = $row->employee_id;
                                        ?>                                    
                                        <td rowspan='<?php echo $xyz[$row->employee_id]; ?>'><?php echo $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name?></td>                                    
                                        <td rowspan='<?php echo $xyz[$row->employee_id]; ?>'><?php echo $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') ?></td>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    //$summ[$row->employee_id] = array();
                                    //if (!in_array($row->action_type, $summ[$row->employee_id])) {
                                        //$summ[$row->employee_id][] = $row->action_type;
                                    ?>
                                        <!--rowspan='<?php // echo $abc[$row->employee_id][$row->action_type]; ?>'-->
                                        <td><?php echo $row->action_type==1?'Incident':'Accident' ?></td>
                                     <?php
                                     
                                    //}
                                    
                                    ?>
                                    <td><a href='#' onclick='view_action_falloup(<?php echo $row->action_id ?>)'> <?php echo $this->Common_model->show_date_formate($row->action_date) ?> </a></td>
                                    <td><?php echo $row->accident_time ?></td> 
                                    <td><?php echo $this->Common_model->get_name($this, $row->discipline_type, 'main_disciplinetype', 'discipline_type') ?></td>

                                </tr>
                                <?php
                            }
                        }
                        
                        //print_r($abc);
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
            <?php } ?>
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!-- Follow-up Modal -->
<div class="modal fade" id="acObs_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Action Detail</h4>
            </div>

            <div class="modal-body" id="observation_action_list">
                
                <!-------- Action Detail -------->
                <div class="overflow-x">
                    <table class="table table-striped actbl">

                        <tbody>
                            <!-------- Ajax Data Here -------->
                            <tr>
                                <td colspan="4" class="center-align"><i>- Data Not Found -</i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-------- Discipline Action Detail -------->
                <div class="overflow-x">
                    <div class="center-align"> <h4><b> Discipline Action Detail</b></h4></div>
                    <table class="table table-striped dstbl">

                        <tbody>
                            <!-------- Ajax Data Here -------->
                            <tr>
                                <td colspan="4" class="center-align"><i>- Data Not Found -</i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-------- Follow-up Detail -------->
                <div class="overflow-x">
                    <div class="center-align"> <h4><b> Follow-up Detail</b></h4></div>
                    <table class="table table-striped rptObsActionList">
                        <thead>
                            <tr>
                                <th>Sl. no.</th>
                                <th>Follow-up Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Next Follow-up Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-------- Ajax Data Here -------->
                            <tr>
                                <td colspan="7" class="center-align"><i>- Please Wait -</i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script>

function view_action_falloup(action_id) {
        save_method = 'add';

        var DATA = {
            "action_id": action_id
        };

        $.ajax({
            url: '<?php echo site_url('Con_Rpt_EmployeeAction/get_action_data'); ?>',
            data: DATA,
            type: 'POST'
        }).done(function (data) {
//            alert(data);return;
            var datas = data.split('##');
//            alert(datas[2]);return;
            $(".rptObsActionList tbody").html(datas[0]);
            $(".actbl tbody").html(datas[1]);
            $(".dstbl tbody").html(datas[2]);
        });


        $('#acObs_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Action Detail'); // Set Title to Bootstrap modal title
    }

</script>

<script type="text/javascript">
    
    $("select#emp_name").select2({
        placeholder: "Select Employee",
        allowClear: true
    });
    
    $("select#action_type").select2({
        placeholder: "Select Action Type",
        allowClear: true
    });
    
    
</script>