<?php
$this->db->select("COUNT(*) AS Emp_No, status");
$this->db->join("main_ob_personal_information", "main_ob_personal_information.onboarding_employee_id = main_ob_send_mail.onboarding_employee_id");
$this->db->where("main_ob_personal_information.company_id", $company_id);
$this->db->where("status !=", 0);
$this->db->where("main_ob_send_mail.isactive", 1);
$this->db->like('main_ob_send_mail.createddate', date('Y'), 'after');
$this->db->order_by("status", "ASC");
$this->db->group_by("status");
$query = $this->db->get("main_ob_send_mail");

//die("==>> " . $this->db->last_query());

$chart_data = $query->result();
//pr($chart_data, 1);
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
                    <li><a href="<?php echo base_url() . 'Con_Onboarding' ?>">Onboarding</a></li>
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
    #container_chart{height:450px !important}
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
            text: '<?php echo $page_header . '( ' . date('Y') . ' )'; ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                innerSize: 150,
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 70,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
                type: 'pie',
                name: 'Current Candidates',
                data: [
<?php
if (!empty($chart_data)) {
    foreach ($chart_data as $row) {
        if ($row->status == 1) {
            $Name = 'Applied';
        } else if ($row->status == 2) {
            $Name = 'Hired';
        } else if ($row->status == 3) {
            $Name = 'Rejected';
        }
        $Name .= ' in ' . date('Y');

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

<!--=== End Content ===-->


