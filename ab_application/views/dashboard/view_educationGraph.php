<?php
$this->db->select("COUNT(*) AS Emp_No, educationlevel, educationlevelcode");
$this->db->join("main_educationlevelcode", "main_educationlevelcode.id = main_emp_education.educationlevel");
$this->db->where("main_emp_education.company_id", $company_id);
$this->db->where("main_emp_education.isactive", 1);
$this->db->group_by("educationlevel");
$query = $this->db->get("main_emp_education");

$chart_data = $query->result();

//pr($chart_data, 1);
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
            <div class="container col-md-12">
                <div class="table-responsive col-md-4 no-border">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Education Level</th>
                                <th>No. of Employees</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            if (!empty($chart_data)) {
                                foreach ($chart_data as $row) {
                                    if ($row->educationlevelcode == '') {
                                        ?>
                                        <tr>
                                            <td class="center-align"><i>-  Not Defined -</i></td>
                                            <td class="right-align"><?php echo $row->Emp_No; ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td><?php echo $row->educationlevelcode; ?></td>
                                            <td class="right-align"><?php echo $row->Emp_No; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    $total += $row->Emp_No;
                                }
                            }
                            ?>
                            <tr>
                                <th class="right-align">Total =</th>
                                <th class="right-align"><?php echo $total; ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-8">
                    <div align="center" id="container_chart"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<style type="text/css">
    #container_chart{height:350px !important}
    .highcharts-credits{display:none !important}
</style>
<script src="<?php echo base_url(); ?>assets/chart/hschart/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/chart/hschart/highcharts-3d.js"></script>

<script type="text/javascript">

    Highcharts.chart('container_chart', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 40,
                beta: 0
            }
        },
        title: {
            text: '<?php echo $page_header; ?>'
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
        },
        series: [{
                type: 'pie',
                name: 'Current Employees',
                data: [
<?php
if (!empty($chart_data)) {
    foreach ($chart_data as $row) {
        $Name = ($row->educationlevelcode == "") ? 'Not Defined' : $row->educationlevelcode;
        echo "['" . $Name . "', " . $row->Emp_No . "],";
    }
}
?>
                ]
            }]
    });

</script>

</div><!--/end row-->
</div><!--/end container-->


<!--  // Sample Data Type
        data: [
            ['Firefox', 45.0],
            ['IE', 26.8],
            {
                name: 'Chrome',
                y: 12.8,
                sliced: true,
                selected: true
            },
            ['Safari', 8.5],
            ['Opera', 6.2],
            ['Others', 0.7]
        ] 
-->
