<?php
$this->db->select("COUNT(*) AS no_of_jobPost, department_id, department_name");
$this->db->join("main_department", "main_department.id = main_opening_position.department_id");
$this->db->where("main_opening_position.company_id", $company_id);
$this->db->where("main_opening_position.isactive", 1);
$this->db->group_by("department_id");
$query = $this->db->get("main_opening_position");

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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Opening Post</th>
                                <th>Positions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            if (!empty($chart_data)) {
                                foreach ($chart_data as $key => $row) {
                                    $res = $this->db->get_where('main_opening_position', array('company_id ' => $company_id, 'department_id' => $row->department_id))->result();

                                    $k = 0;
                                    $subTotal = 0;
                                    foreach ($res as $value) {
                                        echo '<tr>';
                                        if ($k == 0) {
                                            echo '<td rowspan="' . $row->no_of_jobPost . '">' . $row->department_name . '</td>';
                                        }
                                        echo '<td>' . $value->requisition_code . '</td>';
                                        echo '<td class="right-align">' . $value->no_of_positions . '</td>';
                                        echo '</tr>';

                                        $subTotal += $value->no_of_positions;
                                        $k++;
                                    }
                                    $chart_data[$key]->total_per_dept = $subTotal;
                                    $total += $subTotal;
                                }
                            }
                            ?>
                            <tr>
                                <th colspan="2" class="right-align">Total =</th>
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
<?php //pr($chart_data); ?>

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
                name: 'Opening Positions',
                data: [
<?php
if (!empty($chart_data)) {
    foreach ($chart_data as $row) {
        $Name = ($row->department_name == "") ? 'Not Defined' : $row->department_name;
        echo "['" . $Name . "', " . $row->total_per_dept . "],";
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
