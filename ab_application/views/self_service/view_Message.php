<?php
    $this->user_id = $this->user_data['id'];
    $employeeId = $this->Common_model->get_selected_value($this,'emp_user_id',$this->user_id,'main_employees','employee_id');

    // to get SMS sent for the current logged in employee starts
    /* if ($this->session->userdata('hr_logged_in')["company_view"] == 1 || $this->user_group == 12) {
        $smslogs_query = $this->db->get_where('main_sms_logs', array('company_id' => $this->company_id));

    } else if( $this->session->userdata('hr_logged_in')['user_group'] == 10) {
        $this->db->select('*');
        $this->db->from('main_sms_logs');
        // $this->db->join('main_employees', 'main_sms_logs.employee_id = main_employees.id');
        // $this->db->where('main_employees.emp_user_id', $this->user_id);
        $this->db->where('employee_id', $employeeId);
        $smslogs_query = $this->db->get();
    } else {
        $smslogs_query = $this->db->get_where('main_sms_logs');
    } */
    $this->db->select('*');
    $this->db->from('main_sms_logs');
    $this->db->join('main_employees', 'main_sms_logs.employee_id = main_employees.employee_id');
    $this->db->where('main_sms_logs.employee_id', $employeeId);
    $this->db->order_by('main_sms_logs.id', 'DESC');
    $this->db->limit(5);
    $smslogs_query = $this->db->get();
    $smsLogs = $smslogs_query->result();
    // to get SMS sent for the current logged in employee starts

    // to get announcements for the current logged in employee starts
    $this->db->select();
    $this->db->from('main_announcements');
    $this->db->join("main_department", "main_department.id = main_announcements.department_id");
    $this->db->join("main_emp_workrelated", "main_emp_workrelated.department = main_department.id");
    $this->db->join("main_employees", "main_employees.id = main_emp_workrelated.employee_id");
    $this->db->where('main_emp_workrelated.employee_id',$employeeId);
    $this->db->where('main_announcements.isactive',1);
    $this->db->order_by('main_announcements.id', 'DESC');
    $this->db->limit(5);
    $announcements_query = $this->db->get();
    $announcements = $announcements_query->result();
    // echo "<pre>". print_r($smsLogs, 1) ."</pre>";exit;
    // to get announcements for the current logged in employee ends

    // echo $this->db->last_query();
?>

        <div class="col-md-10 main-content-div">
            <div class="main-content">
                <div class="container conbre">
                    <ol class="breadcrumb">
                        <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                        <li class="active"><?php echo $page_header; ?></li>
                    </ol>
                </div>
                <div class="container tag-box tag-box-v3 content-div" style="padding-bottom: 15px; padding-top: 15px;">
                    <div class="table-responsive col-md-12 col-centered no-border">
                        <table id="dataTables-example" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl responsive-table table-wrap">
                            <colgroup>
                                <col width="5%">
                                <col width="25%">
                                <col width="10%">
                                <col width="60%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th style="display: none;">Hidden Date</th>
                                    <th>S.No</th>
                                    <th>To Employee</th>
                                    <th>Date</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($announcements || $smsLogs) {
                                    $announcementsArr = array();
                                    foreach ($announcements as $announcement) {
                                        $announcementsArr[] = array(
                                            'id' => $announcement->id,
                                            'employee' => $announcement->first_name . ", " . $announcement->last_name,
                                            'date' => $announcement->val_date,
                                            'message' => $announcement->title
                                        );
                                    }

                                    foreach ($smsLogs as $smsLog) {
                                        $announcementsArr[] = array(
                                            'id' => $smsLog->id,
                                            'employee' => $smsLog->last_name . ", " . $smsLog->first_name,
                                            'date' => $smsLog->date,
                                            'message' => $smsLog->message
                                        );
                                    }
                                    // $date = array_column($announcementsArr, 'date');
                                    // array_multisort($date, SORT_DESC, $announcementsArr);

                                    $sl = 0;
                                    foreach ($announcementsArr as $announcement) {
                                        $sl++;
                                        $pdt = $announcement['id'];
                                        $announcementDate = date("m-d-Y", strtotime($announcement['date']));
                                        print "<tr>";
                                            print "<td id='catB" . $pdt . "' style='display: none;'>" . $announcementDate . "</td>";
                                            print "<td id='catB" . $pdt . "'>" . $sl . "</td>";
                                            // print "<td id='catB" . $pdt . "'>" . $this->Common_model->employee_name($row->employee_id). "</td>";
                                            // print "<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->date) . "</td>";
                                            // print "<td id='catB" . $pdt . "'>" . $row->message . "</td>";
                                            print "<td id='catB" . $pdt . "'>" . $announcement['employee']. "</td>";
                                            print "<td id='catB" . $pdt . "'>" . $announcementDate . "</td>";
                                            print "<td id='catB" . $pdt . "'>" . $announcement['message'] . "</td>";
                                        print "</tr>";
                                    }
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                </div><!-- end container well div -->
            </div>
        </div>

    </div><!--/row-->
</div><!--/container-->
<!--=== End Content ===-->
