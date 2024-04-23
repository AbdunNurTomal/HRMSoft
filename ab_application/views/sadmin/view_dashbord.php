<?php
if ($user_group == 11) {//hr manager
    ?>
    <div class="col-md-10 main-content-div">
        <div class="main-content">

            <div class="container conbre">
                <ol class="breadcrumb">
                    <!--<li><a href="<?php // echo base_url() . 'con_dashbord' ?>">HRM</a></li>-->
                    <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                    <li class="active"><?php echo $page_header; ?></li>
                </ol>
            </div>

            <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
                <div class="row">
                    <div class="container">
                        <div class="col-lg-12">
                            <div class="alert col-md-3">
                                <img src="<?php echo base_url(); ?>uploads/blank.png" id="my_image" class="twPc-avatarImg pull-left margin-right-10" alt="" height="70" width="65">
                                <?php echo $user_name; ?>
                                <?php echo $user_email; ?>
                            </div>
                            <div class="alert alert-warning col-md-6 text-center">
                                Interview Schedules, Mon 21, Nov 2016 <br>
                                No interviews scheduled for today.
                            </div>
                            <div class="alert col-md-3">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php
                    $balert_query = $this->db->get_where('main_alert_policy', array('alert_item' => 1, 'isactive' => 1, 'company_id' => $this->company_id))->row();
                    if ($balert_query) {
                        ?>
                        <div class="col-md-6">
                            <!-- Orange Panel -->
                            <div class="panel panel-orange">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-tasks"></i> BirthDay Alerts </h3>
                                </div>
                                <div class="panel-body">
                                    <?php
                                    $after_days = $balert_query->alert_after_days;

                                    $alert_date_start = $this->Common_model->add_date(date("Y-m-d"), $balert_query->alert_after_days);
                                    $sday = date("d", strtotime($alert_date_start));
                                    $cday = date("d", strtotime(date("Y-m-d")));
                                    $yr_mon_part = date("m", strtotime(date("Y-m-d")));

                                    $ts1 = strtotime(date("Y-m-d"));
                                    $ts2 = strtotime($alert_date_start);
                                    $day_diff = date("d", $ts2 - $ts1);

                                    $in_arr = array();
                                    $k = 0;
                                    for ($i = 0; $i <= $day_diff - 1; $i++) {
                                        $in_arr[] = ((int) date("m", strtotime($this->Common_model->add_date(date("Y-m-d"), $k))) . (int) date("d", strtotime($this->Common_model->add_date(date("Y-m-d"), $k))));
                                        $k++;
                                    }
                                    $in_arrr = implode(",", $in_arr);

                                    //$in_arrr = array_map('intval', $in_arr);
                                    //$sql = "SELECT first_name,position,birthdate FROM main_employees WHERE isactive='1' and company_id=" . $this->company_id . "  and birthdate like '"."%-".$yr_mon_part."-%"."' order by employee_id";
                                    //SELECT CURDATE(),`emp_code`, doj FROM `0_hcm_emp` WHERE month(doj)=month(CURDATE()) and (day(doj) between day(CURDATE()) and day(CURDATE()) +3) order by doj
                                    //$sql = "SELECT first_name,position,birthdate FROM main_employees WHERE isactive='1' and company_id=" . $this->company_id . "  and month(birthdate) between  month(CURDATE()) and month(DATE_ADD(NOW(), INTERVAL " . $after_days . " DAY)) order by employee_id";

                                    $sql = "SELECT first_name,position,birthdate,concat(month(birthdate),day(birthdate)) FROM main_employees WHERE isactive='1' and company_id=24 and concat(month(birthdate),day(birthdate)) in (" . $in_arrr . ")";
                                    $query = $this->db->query($sql);
                                    //echo $this->db->last_query();
                                    ?>
                                    <table id="alert_table" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Position</th>
                                                <th>Birth Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($query) {
                                                $i = 0;
                                                foreach ($query->result() as $row) {
                                                    print"<tr>";
                                                    print"<td>" . ucwords($row->first_name) . "</td>";
                                                    print"<td>" . $this->Common_model->get_name($this, $row->position, 'main_positions', 'positionname') . "</td>";
                                                    print"<td>" . $this->Common_model->show_date_formate($row->birthdate) . "</td>";
                                                    print"</tr>";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End Orange Panel -->
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $walert_query = $this->db->get_where('main_alert_policy', array('alert_item' => 3, 'isactive' => 1, 'company_id' => $this->company_id));
                    if ($walert_query->num_rows() > 0) {
                        ?>
                        <div class="col-md-6">
                            <!-- Purple Panel -->
                            <div class="panel panel-purple">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Work Anniversaries Alert </h3>
                                </div>
                                <div class="panel-body">
                                    <?php
                                    $yr_mon_part = date("m-d", strtotime(date("Y-m-d")));
                                    $sql = "SELECT * FROM main_employees WHERE isactive='1' and company_id=" . $this->company_id . "  and hire_date like '" . "%-" . $yr_mon_part . "' order by employee_id";
                                    $query = $this->db->query($sql);
                                    ?>
                                    <table id="alert_table" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Position</th>
                                                <th>Hire Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($query) {
                                                $i = 0;
                                                foreach ($query->result() as $row) {
                                                    print"<tr>";
                                                    print"<td>" . ucwords($row->first_name) . "</td>";
                                                    print"<td>" . $this->Common_model->get_name($this, $row->position, 'main_positions', 'positionname') . "</td>";
                                                    print"<td>" . $this->Common_model->show_date_formate($row->hire_date) . "</td>";
                                                    print"</tr>";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End Purple Panel -->
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $walert_query = $this->db->get_where('main_alert_policy', array('alert_item' => 5, 'isactive' => 1, 'company_id' => $this->company_id));
                    if ($walert_query->num_rows() > 0) {
                        ?>
                        <div class="col-md-6">
                            <!-- Aqua Panel -->
                            <div class="panel panel-aqua">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Social Security Tax Remains </h3>
                                </div>
                                <div class="panel-body">
                                    <?php
                                    $yr_mon_part = date("m-d", strtotime(date("Y-m-d")));
                                    $sql = "SELECT * FROM main_emp_license WHERE isactive='1' and company_id=" . $this->company_id . "  and expiration_date like '" . "%-" . $yr_mon_part . "' order by employee_id";
                                    $query = $this->db->query($sql);
                                    ?>
                                    <table id="alert_table" class="table table-striped table-bordered dt-responsive table-hover nowrap">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>License Type</th>
                                                <th>Expiration Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($query) {
                                                $i = 0;
                                                foreach ($query->result() as $row) {
                                                    print"<tr>";
                                                    print"<td>" . $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'first_name') . "</td>";
                                                    print"<td>" . $row->license_type . "</td>";
                                                    print"<td>" . $this->Common_model->show_date_formate($row->expiration_date) . "</td>";
                                                    print"</tr>";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End Aqua Panel -->
                        </div>
                        <?php
                    }
                    ?>

                    <div class="col-md-6">
                        <!-- Green Panel -->
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> TO Do List </h3>
                            </div>
                            <div class="panel-body">

                            </div>
                        </div>
                        <!-- End Green Panel -->
                    </div>

                </div>

            </div>
        </div>
    </div>

    <?php
} else if ($user_group == 12) {//Company User
    $sql = "SELECT a.id,count(a.employee_id) as employee,b.department
        FROM main_employees as a JOIN main_emp_workrelated as b ON 
        a.employee_id = b.employee_id 
        WHERE a.company_id=" . $this->company_id . " group by b.department order by b.department";
    $dquery = $this->db->query($sql);
    //echo $this->db->last_query();
    $rowcount = $dquery->num_rows();
    $dept = "[";
    $emp = "[";
    $i = 0;
    if ($rowcount > 0) {
        foreach ($dquery->result() as $key):
            $i++;
            if ($i != $rowcount) {
                $dept .= "'" . $this->Common_model->get_name($this, $key->department, 'main_department', 'department_name') . "',";
                $emp .= "" . $key->employee . ",";
            } else {
                $dept .= "'" . $this->Common_model->get_name($this, $key->department, 'main_department', 'department_name') . "']";
                $emp .= "" . $key->employee . "]";
            }
        endforeach;
    } else {
        $dept .= "]";
        $emp .= "]";
    }
    ?>
    <script src="<?php echo base_url(); ?>assets/chart/hschart/hschart.js"></script>
    <div class="col-md-10 main-content-div">
        <div class="main-content">

            <div class="container conbre">
                <ol class="breadcrumb">
                    <!--<li><a href="<?php // echo base_url() . 'Con_dashbord' ?>">HRM</a></li>-->
                    <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                    <li class="active"><?php echo $page_header; ?></li>
                </ol>
            </div>

            <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
                <div class="text-center" id="container_chart"></div>
            </div>

        </div>
    </div>

    <script>

        var dept =<?php echo $dept; ?>;
        var emp =<?php echo $emp; ?>;

        Highcharts.theme = {
            colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
                '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
            chart: {
                backgroundColor: null,
                style: {
                    fontFamily: 'Dosis, sans-serif'
                }
            },
            title: {
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    textTransform: 'uppercase'
                }
            },
            tooltip: {
                borderWidth: 0,
                backgroundColor: 'rgba(219,219,216,0.8)',
                shadow: false
            },
            legend: {
                itemStyle: {
                    fontWeight: 'bold',
                    fontSize: '13px'
                }
            },
            xAxis: {
                gridLineWidth: 1,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                minorTickInterval: 'auto',
                title: {
                    style: {
                        textTransform: 'uppercase'
                    }
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            plotOptions: {
                candlestick: {
                    lineColor: '#404048'
                }
            },

            // General
            background2: '#F0F0EA'

        };

    // Apply the theme
        Highcharts.setOptions(Highcharts.theme);
        $(function () {
            var companyName = "<?= $companyName; ?>";
            $('#container_chart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Employees Per Department'
                },
                subtitle: {
                    text: 'Source: ' + companyName
                },
                xAxis: {
                    categories: dept,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Employee'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y} EMP</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Department',
                        data: emp

                    }]
            });
        });

    </script>

    <?php
} else {//service Provaider user
    $sql = "SELECT a.id,a.company_full_name,count(b.employee_id) as employee FROM main_company as a JOIN main_employees as b ON 
        a.id = b.company_id  group by a.id order by a.id";
    $cquery = $this->db->query($sql);
    //echo $this->db->last_query();
    $rowcount = $cquery->num_rows();
    $comp = $emp = "[]";
    if ($rowcount > 0):
        $comp = "[";
        $emp = "[";
        $i = 0;
        foreach ($cquery->result() as $key):
            $i++;
            if ($i != $rowcount) {
                $comp .= "'" . $key->company_full_name . "',";
                $emp .= "" . $key->employee . ",";
            } else {
                $comp .= "'" . $key->company_full_name . "']";
                $emp .= "" . $key->employee . "]";
            }
        endforeach;
    endif;

    ?>
    <script src="<?php echo base_url(); ?>assets/chart/hschart/hschart.js"></script>
    <div class="col-md-10 main-content-div">
        <div class="main-content">

            <div class="container conbre">
                <ol class="breadcrumb">
                    <!--<li><a href="<?php // echo base_url() . 'Con_dashbord' ?>">HRM</a></li>-->
                    <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                    <li class="active"><?php echo $page_header; ?></li>
                </ol>
            </div>

            <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
                <div align="center" id="container_chart"></div>
            </div>

        </div>
    </div>

    <script>

        var comp =<?php echo $comp ?>;
        var emp =<?php echo $emp ?>;

        Highcharts.theme = {
            colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
                '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
            chart: {
                backgroundColor: null,
                style: {
                    fontFamily: 'Dosis, sans-serif'
                }
            },
            title: {
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    textTransform: 'uppercase'
                }
            },
            tooltip: {
                borderWidth: 0,
                backgroundColor: 'rgba(219,219,216,0.8)',
                shadow: false
            },
            legend: {
                itemStyle: {
                    fontWeight: 'bold',
                    fontSize: '13px'
                }
            },
            xAxis: {
                gridLineWidth: 1,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                minorTickInterval: 'auto',
                title: {
                    style: {
                        textTransform: 'uppercase'
                    }
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            plotOptions: {
                candlestick: {
                    lineColor: '#404048'
                }
            },

            // General
            background2: '#F0F0EA'

        };

    // Apply the theme
        Highcharts.setOptions(Highcharts.theme);
        $(function () {
            $('#container_chart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Employee Per Company'
                },
                subtitle: {
                    text: 'Source: HRC '
                },
                xAxis: {
                    categories: comp,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'EMPLOYEE'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y} EMP</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Company',
                        data: emp

                    }]
            });
        });
    </script>
    <?php
}
?>

</div><!--/end row-->
</div><!--/end container-->
