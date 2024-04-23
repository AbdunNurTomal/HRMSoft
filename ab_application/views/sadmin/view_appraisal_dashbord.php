<?php
if (($user_group == 11) || ($user_group == 12)) {
// Company User
    $query = $this->db->query("SELECT `Appraisal_times`, `company_id`, COUNT( `Appraisal_times` ) AS `Emp_No` FROM ( SELECT `employee_id`, `company_id`, COUNT(`employee_id`) AS `Appraisal_times` FROM main_appraisal_records WHERE `company_id`={$company_id} GROUP BY `employee_id` ) AS tbl GROUP BY `Appraisal_times` ORDER BY `Appraisal_times` ASC");
    $chart_data = $query->result_array();
} else {
// All except Company User
    $this->db->select("main_company.id AS company_id, main_company.company_full_name, COUNT(main_employees.employee_id) AS employee");
    $this->db->join("main_employees", "main_employees.company_id = main_company.id");
    $this->db->order_by("main_company.id");
    $this->db->group_by("main_company.id");
    $chart_data = $this->db->get("main_company")->result_array();

    foreach ($chart_data as $key => $rec) {
        $sql_conditions = 'WHERE `company_id`=' . $rec['company_id'];
        $query = $this->db->query("SELECT `Appraisal_times`, `company_id`, COUNT( `Appraisal_times` ) AS `Emp_No` FROM ( SELECT `employee_id`, `company_id`, COUNT(`employee_id`) AS `Appraisal_times` FROM main_appraisal_records {$sql_conditions} GROUP BY `employee_id` ) AS tbl GROUP BY `Appraisal_times` ORDER BY `Appraisal_times` ASC");
        $chart_data[$key]['appraisal_data'] = $query->result_array();
    }

    /* ----------------Finding Maximum number of Appraisal times--------------- */


    $Appraisal_times = array();
    if (!empty($chart_data)) {
        $max = 0;
        foreach ($chart_data as $key => $row) {
            $count = count($row['appraisal_data']);
            if ($count > $max) {
                $max = $count;
                foreach ($row['appraisal_data'] as $val) {
                    $Appraisal_times[] = $val['Appraisal_times'];
                }
            }
        }
    }

    /* ------------Inserting NULL values of missing Appraisal times------------- */

    if (!empty($chart_data)) {
        foreach ($chart_data as $key => $row) {
            $tmp_times = $Appraisal_times;
            foreach ($row['appraisal_data'] as $value) {
                $tmp_times = array_diff($tmp_times, array($value['Appraisal_times']));
            }

            foreach ($tmp_times as $val) {
                $chart_data[$key]['appraisal_data'][] = array(
                    'Appraisal_times' => $val,
                    'company_id' => $chart_data[$key]['company_id'],
                    'Emp_No' => 0
                );
            }
        }
    }

    /* --------------Generating Appraisal time(s) Array---------------- */
    $Data_ARR = array();

    if (!empty($Appraisal_times)) {
        foreach ($Appraisal_times as $val) {
            $Data_ARR[$val]['App_times'] = $val . " time(s)";

            foreach ($chart_data as $key => $row) {
                foreach ($row['appraisal_data'] as $rec) {
                    if ($val == $rec['Appraisal_times']) {
                        $Data_ARR[$val]['Emp_No'][] = $rec['Emp_No'];
                    }
                }
            }
        }
    }
}

//pr($Data_ARR);
//pr($chart_data);
?>

<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <?php
                if ($user_type == 1) {
                    ?>
                    <li class="active" >Welcome <?php echo $this->name; ?></li>
                    <?php
                } else {
                    ?>
                    <!--<li><a href="<?php // echo base_url() . 'Con_Onboarding' ?>">Onboarding</a></li>-->
                    <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                    <li class="active"><?php echo $page_header; ?></li>
                    <?php
                }
                ?>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
            <div class="container col-md-12">
                <div class="col-md-12">
                    <div align="center" id="container_chart"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<style type="text/css">
    #container_chart{min-width:410px !important; width:100% !important; height:400px !important; margin:0 auto !important}
    .highcharts-credits{display:none !important}
</style>
<script src="<?php echo base_url(); ?>assets/chart/hschart/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/chart/hschart/funnel.js"></script>

<script type="text/javascript">
<?php if ($user_group == 12) { ?>

        Highcharts.chart('container_chart', {
            chart: {
                type: 'pyramid',
                marginRight: 100
            },
            title: {
                text: '<?php echo $page_header; ?>',
                x: -50
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:,.0f} Employee(s) <br/> {point.name} each',
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                        softConnector: true
                    }
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                    name: 'No. of Employee',
                    data: [
    <?php
    if (!empty($chart_data)) {
        foreach ($chart_data as $row) {
            $Name = ($row['Appraisal_times'] == "") ? 'Not Defined' : $row['Appraisal_times'] . ' appraisal(s)';
            echo "['" . $Name . "', " . $row['Emp_No'] . "],";
        }
    }
    ?>
                    ]
                }]
        });

<?php } else { ?>


        Highcharts.chart('container_chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Company Wise Employee according to Appraisal time(s)'
            },
            xAxis: {
                categories: [
    <?php
    if (!empty($chart_data)) {
        $pieces = array();
        foreach ($chart_data as $value) {
            $pieces[] = "'" . $value['company_full_name'] . "'";
        }
        echo implode(',', $pieces);
    }
    ?>
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'No. of employees'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">Company: {point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0"> {series.name} Appraisal: </td>' +
                        '<td style="padding:0"><b>{point.y:,.0f} Employee(s) </b></td></tr>',
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
            series: [
    <?php
    foreach ($Data_ARR as $key => $value) {
        echo "{
                name: '" . $value['App_times'] . "',
                data: [";

        if (!empty($value['Emp_No'])) {
            $pieces = array();
            foreach ($value['Emp_No'] as $row) {
                $pieces[] = $row;
            }
            echo implode(',', $pieces);
        } else {
            echo "0";
        }

        echo "]";
        echo "},";
    }
    ?>
                /* {
                 name: 'Tokyo',
                 data: [49.9, 71.5, 106.4]
                 
                 }, {
                 name: 'New York',
                 data: [83.6, 78.8, 98.5, 93.4]                 
                 } */
            ]
        });

<?php } ?>
</script>

</div><!--/end row-->
</div><!--/end container-->

<!--=== End Content ===-->
