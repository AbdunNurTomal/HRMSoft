<?php
$this->db->select("COUNT(*) AS Emp_No, status");
$this->db->join("main_ob_personal_information", "main_ob_personal_information.onboarding_employee_id = main_ob_send_mail.onboarding_employee_id");
$this->db->where("main_ob_personal_information.company_id", $company_id);
/* $this->db->where("status !=", 0); */
$this->db->where("main_ob_send_mail.isactive", 1);
$this->db->like('main_ob_send_mail.createddate', date('Y'), 'after');
$this->db->order_by("status", "ASC");
$this->db->group_by("status");
$query = $this->db->get("main_ob_send_mail");

$chart_data = $query->result();

//die("==>> " . $this->db->last_query());
//pr($chart_data, 1);

if (!empty($chart_data)) {
    $TOTAL = 0;
    foreach ($chart_data as $CNT) {
        $TOTAL += $CNT->Emp_No;
    }
}
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
                    <!--<li><a href="<?php // echo base_url() . 'Con_ob_dashbord' ?>">Onboarding</a></li>-->
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
    #container_chart{height:450px !important}
    .highcharts-credits{display:none !important}
</style>
<script src="<?php echo base_url(); ?>assets/chart/hschart/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/chart/hschart/highcharts-3d.js"></script>

<script type="text/javascript">

// Create the chart
    Highcharts.chart('container_chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Onboarding Status <?php echo date('Y'); ?>'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Number of Candidate(s)'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.0f} candidate(s)'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.z:.2f}%</b> of Total<br/>'
        },
        series: [{
                name: 'Candidate Status',
                colorByPoint: true,
                data: [

<?php
if (!empty($chart_data)) {
    foreach ($chart_data as $row) {

        echo "{
                name: 'Total Applied in " . date('Y') . "',
                y: {$TOTAL},
                z: '100'
            },";

        $Name = "";
        if ($row->status == 0) {
            $Name .= 'In-Progress';
        } else if ($row->status == 1) {
            $Name .= 'Submitted';
        } else if ($row->status == 2) {
            $Name .= 'Hired';
        } else if ($row->status == 3) {
            $Name .= 'Rejected';
        } else {
            $Name .= 'Undefined';
        }
        $Name .= ' in ' . date('Y');

        $percent = round((($row->Emp_No / $TOTAL) * 100), 2);

        echo "{
                name: '{$Name}',
                y: {$row->Emp_No},
                z: {$percent}
            },";
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


