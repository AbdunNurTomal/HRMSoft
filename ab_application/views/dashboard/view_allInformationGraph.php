<?php
/* ------------------DEPARTMENT GRAPH------------------- */
$this->db->select("COUNT(*) AS Emp_No, main_employees.company_id, main_emp_workrelated.department AS dept_id, department_name");
$this->db->join("main_emp_workrelated", "main_emp_workrelated.employee_id = main_employees.id", "LEFT");
$this->db->join("main_department", "main_department.id = main_emp_workrelated.department", "LEFT");
$this->db->where("main_employees.company_id", $company_id);
$this->db->where("main_employees.isactive", 1);
$this->db->order_by("main_emp_workrelated.department", "DESC");
$this->db->group_by("main_emp_workrelated.department");
$department_chart_data = $this->db->get("main_employees")->result();

/* ------------------POSITION GRAPH------------------- */
// $this->db->select("COUNT(*) AS Emp_No, main_employees.company_id, main_positions.id AS position_id, positionname");
// $this->db->join("main_positions", "main_positions.id = main_employees.position", "LEFT");
// $this->db->where("main_employees.company_id", $company_id);
// $this->db->where("main_employees.isactive", 1);
// $this->db->order_by("main_employees.state", "DESC");
// $this->db->group_by("main_employees.position");
$this->db->select("COUNT(*) AS Emp_No, main_employees.company_id, main_jobtitles.id AS position_id, main_jobtitles.job_title AS positionname");
$this->db->join("main_jobtitles", "main_jobtitles.id = main_employees.position", "LEFT");
$this->db->where("main_employees.company_id", $company_id);
$this->db->where("main_employees.isactive", 1);
$this->db->order_by("main_employees.state", "DESC");
$this->db->group_by("main_employees.position");
$position_chart_data = $this->db->get("main_employees")->result();

/* ------------------COUNTY GRAPH------------------- */
$this->db->group_by("main_employees.county");
$this->db->order_by("main_employees.county", "DESC");
$this->db->where("main_employees.isactive", 1);
$this->db->where("main_employees.company_id", $company_id);
$this->db->join("main_county", "main_county.id = main_employees.county", "LEFT");
$this->db->select("COUNT(*) AS Emp_No, main_employees.company_id, main_county.id AS county_id, county_name");
$county_chart_data = $this->db->get("main_employees")->result();

/* ------------------STATE GRAPH------------------- */$this->db->group_by("main_employees.state");
$this->db->order_by("main_employees.state", "DESC");
$this->db->where("main_employees.isactive", 1);
$this->db->where("main_employees.company_id", $company_id);
$this->db->join("main_state", "main_state.id = main_employees.state", "LEFT");
$this->db->select("COUNT(*) AS Emp_No, main_employees.company_id, main_state.id AS state_id, state_name, state_abbr");
$state_chart_data = $this->db->get("main_employees")->result();

/* ------------------EDUCATION GRAPH------------------- */
$this->db->select("COUNT(*) AS Emp_No, educationlevel, educationlevelcode");
$this->db->join("main_educationlevelcode", "main_educationlevelcode.id = main_emp_education.educationlevel");
$this->db->where("main_emp_education.company_id", $company_id);
$this->db->where("main_emp_education.isactive", 1);
$this->db->group_by("educationlevel");
$education_chart_data = $this->db->get("main_emp_education")->result();

/* ------------------EXPERIENCE GRAPH------------------- */
$this->db->select("COUNT(*) AS Emp_No, hire_date, FLOOR(DATEDIFF( CURDATE(), `hire_date`) /365) AS exp_year");
$this->db->where("main_employees.company_id", $company_id);
$this->db->where("main_employees.isactive", 1);
$this->db->group_by("exp_year");
$experience_chart_data = $this->db->get("main_employees")->result();

/* ------------------ON-BOARDING GRAPH------------------- */
$this->db->select("COUNT(*) AS Emp_No, status");
$this->db->join("main_ob_personal_information", "main_ob_personal_information.onboarding_employee_id = main_ob_send_mail.onboarding_employee_id");
$this->db->where("main_ob_personal_information.company_id", $company_id);
$this->db->where("status !=", 0);
$this->db->where("main_ob_send_mail.isactive", 1);
$this->db->order_by("status", "ASC");
$this->db->group_by("status");
$onboarding_chart_data = $this->db->get("main_ob_send_mail")->result();

/* ------------------OPEN-POSITION GRAPH------------------- */
$this->db->select("COUNT(*) AS no_of_jobPost, department_id, department_name");
$this->db->join("main_department", "main_department.id = main_opening_position.department_id");
$this->db->where("main_opening_position.company_id", $company_id);
$this->db->where("main_opening_position.isactive", 1);
$this->db->group_by("department_id");
$opening_position_chart_data = $this->db->get("main_opening_position")->result();
?>

<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div align="center" class="container_chart" id="department_chart"></div>
                </div>
                <div class="col-md-6">
                    <div align="center" class="container_chart" id="position_chart"></div>
                </div>
                <div class="col-md-6">
                    <div align="center" class="container_chart" id="county_chart"></div>
                </div>
                <div class="col-md-6">
                    <div align="center" class="container_chart" id="state_chart"></div>
                </div>
                <div class="col-md-6">
                    <div align="center" class="container_chart" id="education_chart"></div>
                </div>
                <div class="col-md-6">
                    <div align="center" class="container_chart" id="experience_chart"></div>
                </div>
                <div class="col-md-6">
                    <div align="center" class="container_chart" id="onboarding_chart"></div>
                </div>
                <div class="col-md-6">
                    <div align="center" class="container_chart" id="open_position_chart"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php //pr($department_chart_data);  ?>

<style type="text/css">
    
    .container_chart{height:350px; margin-top:30px !important}
    .well{border:none !important}
    .highcharts-credits{display:none !important}
   
</style>
<script src="<?php echo base_url(); ?>assets/chart/hschart/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/chart/hschart/highcharts-3d.js"></script>
<?php

function chart_options() {
    ob_start();
    ?>
    chart: {
    type: 'pie',
    options3d: {
    enabled: true,
    alpha: 40,
    beta: 0
    },
    backgroundColor: '#f5f5f5',
    polar: true,
    type: 'line'
    },
    tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
    pie: {
    allowPointSelect: true,
    cursor: 'pointer',
    depth: 50,
    dataLabels: {
    enabled: true,
    format: '{point.name}'
    }
    }
    }
    <?php
    return ob_get_clean();
}
?>

<script type="text/javascript">

    /* ------------------DEPARTMENT GRAPH------------------- */
    Highcharts.chart('department_chart', {
<?php echo chart_options(); ?>,
        title: {
            text: 'Employees by Department'
        },
        series: [{
                type: 'pie',
                name: 'Current Employees',
                data: [
<?php
if (!empty($department_chart_data)) {
    foreach ($department_chart_data as $row) {
        $Name = ($row->department_name == "") ? 'Not Defined' : $row->department_name;
        echo "['" . $Name . "', " . $row->Emp_No . "],";
    }
}
?>
                ]
            }]
    });

    /* ------------------POSITION GRAPH------------------- */
    Highcharts.chart('position_chart', {
<?php echo chart_options(); ?>,
        title: {
            text: 'Employees by Position'
        },
        series: [{
                type: 'pie',
                name: 'Current Employees',
                data: [
<?php
if (!empty($position_chart_data)) {
    foreach ($position_chart_data as $row) {
        $Name = ($row->positionname == "") ? 'Not Defined' : $row->positionname;
        echo "['" . $Name . "', " . $row->Emp_No . "],";
    }
}
?>
                ]
            }]
    });


    /* ------------------COUNTY GRAPH------------------- */
    Highcharts.chart('county_chart', {
<?php echo chart_options(); ?>,
        title: {
            text: 'Employees by County'
        },
        series: [{
                type: 'pie',
                name: 'Current Employees',
                data: [
<?php
if (!empty($county_chart_data)) {
    foreach ($county_chart_data as $row) {
        $Name = ($row->county_name == "") ? 'Not Defined' : $row->county_name;
        echo "['" . $Name . "', " . $row->Emp_No . "],";
    }
}
?>
                ]
            }]
    });

    /* ------------------STATE GRAPH------------------- */

    Highcharts.chart('state_chart', {
<?php echo chart_options(); ?>,
        title: {
            text: 'Employees by State'
        },
        series: [{
                type: 'pie',
                name: 'Current Employees',
                data: [
<?php
if (!empty($state_chart_data)) {
    foreach ($state_chart_data as $row) {
        $Name = ($row->state_name == "") ? 'Not Defined' : $row->state_name;
        echo "['" . $Name . "', " . $row->Emp_No . "],";
    }
}
?>
                ]
            }]
    });

    /* ------------------EDUCATION GRAPH------------------- */

    Highcharts.chart('education_chart', {
<?php echo chart_options(); ?>,
        title: {
            text: 'Employees by Education'
        },
        series: [{
                type: 'pie',
                name: 'Current Employees',
                data: [
<?php
if (!empty($education_chart_data)) {
    foreach ($education_chart_data as $row) {
        $Name = ($row->educationlevelcode == "") ? 'Not Defined' : $row->educationlevelcode;
        echo "['" . $Name . "', " . $row->Emp_No . "],";
    }
}
?>
                ]
            }]
    });

    /* ------------------EXPERIENCE GRAPH------------------- */
    Highcharts.chart('experience_chart', {
<?php echo chart_options(); ?>,
        title: {
            text: 'Employees by Experience'
        },
        series: [{
                type: 'pie',
                name: 'Current Employees',
                data: [
<?php
if (!empty($experience_chart_data)) {
    foreach ($experience_chart_data as $row) {
        if ($row->exp_year > 0) {
            $Name = $row->exp_year . " year(s)";
        } else if ($row->exp_year == '') {
            $Name = "Not Defined";
        } else {
            $Name = 'Less than 1 Year';
        }
        echo "['" . $Name . "', " . $row->Emp_No . "],";
    }
}
?>
                ]
            }]
    });

    /* ------------------ON-BOARDING GRAPH------------------- */

    Highcharts.chart('onboarding_chart', {
<?php echo chart_options(); ?>,
        title: {
            text: 'Candidates by Onboarding'
        },
        series: [{
                type: 'pie',
                name: 'Current Candidates',
                data: [
<?php
if (!empty($onboarding_chart_data)) {
    foreach ($onboarding_chart_data as $row) {
        if ($row->status == 1) {
            $Name = 'Applied';
        } else if ($row->status == 2) {
            $Name = 'Hired';
        } else if ($row->status == 3) {
            $Name = 'Rejected';
        }
        echo "['" . $Name . "', " . $row->Emp_No . "],";
    }
}
?>
                ]
            }]
    });

    /* ------------------OPEN-POSITION GRAPH------------------- */

    Highcharts.chart('open_position_chart', {
<?php echo chart_options(); ?>,
        title: {
            text: 'Opening Positions'
        },
        series: [{
                type: 'pie',
                name: 'Opening Positions',
                data: [
<?php
if (!empty($opening_position_chart_data)) {
    foreach ($opening_position_chart_data as $row) {
        $res = $this->db->get_where('main_opening_position', array('company_id ' => $company_id, 'department_id' => $row->department_id))->result();

        $subTotal = 0;
        foreach ($res as $value) {
            $subTotal += $value->no_of_positions;
        }

        $Name = ($row->department_name == "") ? 'Not Defined' : $row->department_name;
        echo "['" . $Name . "', " . $subTotal . "],";
    }
}
?>
                ]
            }]
    });
</script>

</div><!--/end row-->
</div><!--/end container-->
