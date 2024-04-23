<?php
if ($this->user_group == 11 || $this->user_group == 12) {//Company User
    //$c_month=date("m");
    $c_month = 3;
    $gdate = "[";
    $gemp = "[";
    $semp = "[";
    $pemp = "[";

    $actual_emp = 0;
    $separet_emp = 0;
    $total_com_emp = 0;
    $total_separet_emp = 0;
    $total_emp = "";
    for ($e = 0; $e <= $c_month - 1; $e++) {
        $start_date = date("Y-01-01");
        $date = $this->Common_model->add_month(date("Y-01-01"), $e);
        $lastdate = date('Y-m-t', strtotime($date));

        if ($e != $c_month - 1) {
            $gdate .= "'" . date('Y-M', strtotime($date)) . "',";
        } else {
            $gdate .= "'" . date('Y-M', strtotime($date)) . "']";
        }
        $yr_mon_part = date("Y-m", strtotime($date));

        $sql = "SELECT id,count(employee_id) as employee FROM main_employees WHERE isactive='1' and company_id=" . $this->company_id . "  and hire_date between '" . $start_date . "' and '" . $lastdate . "' order by employee_id";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo $rowcount = $query->num_rows();
        $i = 0;
        foreach ($query->result() as $key):
            $actual_emp = $key->employee;
            if ($e != $c_month - 1) {
                $gemp .= "" . $key->employee . ",";
            } else {
                $gemp .= "" . $key->employee . "]";
            }
        endforeach;

        $ssql = "SELECT id,count(employee_id) as semployee FROM main_emp_separation WHERE isactive='1' and company_id=" . $this->company_id . "  and separation_date like '" . $yr_mon_part . "-%" . "' order by employee_id";
        $squery = $this->db->query($ssql);

        foreach ($squery->result() as $skey):
            $separet_emp = $skey->semployee;
            $total_separet_emp += $skey->semployee;
            if ($e != $c_month - 1) {
                $semp .= "" . $skey->semployee . ",";
            } else {
                $semp .= "" . $skey->semployee . "]";
            }
        endforeach;


        $total_com_emp = ($actual_emp + $total_separet_emp);
        $total_emp = ($actual_emp + $separet_emp);
        if ($separet_emp != 0 && $total_emp != 0) {
            if ($e != $c_month - 1) {
                $pemp .= "" . (($separet_emp / $total_emp) * 100) . ",";
            } else {
                $pemp .= "" . (($separet_emp / $total_emp) * 100) . "]";
            }
        } else {
            if ($e != $c_month - 1) {
                $pemp .= "" . 0 . ",";
            } else {
                $pemp .= "" . 0 . "]";
            }
        }

        //echo "<br>";
    }
//   $total_separet_per=  number_format((($total_separet_emp/$total_com_emp)*100),2);
    //echo $total_com_emp."==";
//    echo $gdate;
//    echo "<br>";
//    echo $gemp;
//    echo "<br>";
//    echo $semp;
//    echo "<br>";
//    echo $pemp;
    ?>
    <script src="<?php echo base_url(); ?>assets/chart/hschart/hschart.js"></script>
    <div class="col-md-10 main-content-div">
        <div class="main-content">

            <div class="container conbre">
                <ol class="breadcrumb">
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

        var gdate =<?php echo $gdate ?>;
        var gemp =<?php echo $gemp ?>;
        var ssemp =<?php echo $semp ?>;
    //    var pemp=<?php // echo $pemp         ?>;

    //    var total_com_emp=<?php // echo $total_com_emp         ?>;
    //    var total_separet_emp=<?php // echo $total_separet_emp         ?>;
    //    var total_separet_per=<?php // echo $total_separet_per         ?>;


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
                title: {
                    text: 'Turnover Calculation Per Month'
                }, subtitle: {
                    text: 'Source: HRC HR Management System'
                },
                xAxis: {
                    categories: gdate
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'EMPLOYEE'
                    }
                },
                labels: {
                    items: [{
                            html: 'Summary',
                            style: {
                                left: '50px',
                                top: '18px',
                                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                            }
                        }]
                },
                series: [{
                        type: 'column',
                        name: 'Employee',
                        data: gemp
                    }, {
                        type: 'column',
                        name: 'Turnover',
                        data: ssemp
                    }
    //        , {
    //            type: 'spline',
    //            name: 'Turnover %',
    //            data: pemp,
    //            marker: {
    //                lineWidth: 2,
    //                lineColor: Highcharts.getOptions().colors[3],
    //                fillColor: 'white'
    //            }
    //        }
                ]
            });
        });

    //
    //$(function () {
    //    $('#container_chart').highcharts({
    //        chart: {
    //            type: 'column'
    //        },
    //        title: {
    //            text: 'Turnover Calculation Per Month'
    //        },
    //        subtitle: {
    //            text: 'Source: HRC HR Management System'
    //        },
    //        xAxis: {
    //            categories: gdate,
    //            crosshair: true
    //        },
    //        yAxis: {
    //            min: 0,
    //            title: {
    //                text: 'EMPLOYEE'
    //            }
    //        },
    //        tooltip: {
    //            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    //            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
    //                '<td style="padding:0"><b>{point.y:.1f} EMP</b></td></tr>',
    //            footerFormat: '</table>',
    //            shared: true,
    //            useHTML: true
    //        },
    //        plotOptions: {
    //            column: {
    //                pointPadding: 0.2,
    //                borderWidth: 0
    //            }
    //        },
    //        series: [{
    //            name: 'Employee',
    //            data: gemp
    //
    //        },{
    //            name: 'Turnover',
    //            data: ssemp
    //
    //        }]
    //    });
    //});
    </script>

    <?php
} else {//service Provaider user
    $first_date = date('Y-m-01');
    $current_date = date('Y-m-d');

    //  a.user_id=". $this->user_id ."

    $sql = "SELECT a.id,a.company_full_name,count(b.employee_id) as employee FROM main_company as a 
     JOIN main_employees as b ON a.id = b.company_id  group by a.id order by a.id";
    $cquery = $this->db->query($sql);
    //echo $this->db->last_query();
    $rowcount = $cquery->num_rows();

    $comp = $emp = $semp = "[]";
    if ($rowcount > 0):
        $comp = "[";
        $emp = "[";
        $semp = "[";
        $i = 0;
        foreach ($cquery->result() as $key):
            $i++;

            $ssql = "SELECT id,count(employee_id) as semployee FROM main_emp_separation where company_id=" . $key->id . " and separation_date between '" . $first_date . "' and '" . $current_date . "' group by company_id order by company_id";
            $squery = $this->db->query($ssql)->row();
            //$squery->semployee;

            if ($i != $rowcount) {
                $comp .= "'" . $key->company_full_name . "',";
                $emp .= "" . $key->employee . ",";
                if ($squery) {
                    $semp .= "" . $squery->semployee . ",";
                } else {
                    $semp .= "" . 0 . ",";
                }
            } else {
                $comp .= "'" . $key->company_full_name . "']";
                $emp .= "" . $key->employee . "]";

                if ($squery) {
                    $semp .= "" . $squery->semployee . "]";
                } else {
                    $semp .= "" . 0 . ",";
                }
            }
        endforeach;
    endif;
    
    //MHK - Fixed
    $emp  = rtrim( $emp , ',' );
    $comp = rtrim( $comp, ',' );
    $semp = rtrim( $semp, ',' );
    
    if( stripos( $emp , ']' ) === FALSE )
    {
    	$emp  = $emp  . ']';
    }
    
    if( stripos( $comp, ']' ) === FALSE )
    {
    	$comp = $comp . ']';
    }
    
    if( stripos( $semp, ']' ) === FALSE )
    {
    	$semp = $semp . ']';
    }
    //MHK - END
    
    //echo $semp;
    //echo "<br>";
    //echo $emp;
    ?>
    <script src="<?php echo base_url(); ?>assets/chart/hschart/hschart.js"></script>
    <div class="col-md-10 main-content-div">
        <div class="main-content">

            <div class="container conbre">
                <ol class="breadcrumb">
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

        var comp =<?php echo $comp; ?>;
        var emp =<?php echo $emp; ?>;
        var semp =<?php echo $semp; ?>;

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
                    text: 'Turnover Calculation Per Company'
                },
                subtitle: {
                    text: 'Source: HRC HR Management System'
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
                            '<td style="padding:0"><b>{point.y:.1f} EMP</b></td></tr>',
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
                        name: 'Employee',
                        data: emp

                    }, {
                        name: 'Separation',
                        data: semp

                    }]
            });
        });

    </script>
    <?php
}
?>


</div><!--/end row-->
</div><!--/end container-->
