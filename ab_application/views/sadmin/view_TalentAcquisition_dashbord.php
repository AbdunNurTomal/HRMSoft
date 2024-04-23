<?php
    if ($this->user_group == 11 || $this->user_group == 12) : //Company User
        $first_date = date('Y-m-01');
        $current_date = date('Y-m-d');
        $current_month = date('Y-M');

        $sql = "SELECT id,department_id,sum(no_of_positions) as positions FROM main_opening_position 
            WHERE company_id=" . $this->company_id . " and requisitions_date between '" . $first_date . "' and '" . $current_date . "' group by department_id order by department_id";
        $dquery = $this->db->query($sql);
        //echo $this->db->last_query();exit();
        $rowcount = $dquery->num_rows();
        $dept = "[";
        $emp = "[";
        $i = 0;
        foreach ($dquery->result() as $key):
            $i++;
            if ($i != $rowcount) {
                $dept .= "'" . $this->Common_model->get_name($this, $key->department_id, 'main_department', 'department_name') . "',";
                $emp .= "" . $key->positions . ",";
            } else {
                $dept .= "'" . $this->Common_model->get_name($this, $key->department_id, 'main_department', 'department_name') . "']";
                $emp .= "" . $key->positions . "]";
            }
        endforeach;

        //echo $dept;
        //echo "<br>";
        //echo $emp;
?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashboard/style.css">
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

            <div class="container" style="margin-top: 10px; padding-bottom: 10px;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-envelope-o f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>
                                        <a title='Open Job Position' href="<?php echo base_url() ?>Con_OpeningsPositions/"  target='_blank' >  
                                        <?php 
                                        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
                                            $this->db->where('company_id', $this->company_id);
                                        }
                                        $this->db->where('is_close', 0);
                                        $this->db->where('req_status', 1);
                                        $this->db->where('due_date >', date("Y-m-d"));  
                                        $this->db->from('main_opening_position');
          
                                        echo $this->db->count_all_results();
                                        ?>
                                        </a>
                                    </h2>
                                    <p class="m-b-0"> Open Job Position </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-users f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>
                                        <a title='Interview Schedule' href="<?php echo base_url() ?>Con_Create_Schedule/"  target='_blank' >
                                        <?php 
                                        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
                                            $this->db->where('company_id', $this->company_id);
                                        }
                                        $this->db->where('isactive', 1);
                                        $this->db->where('is_close', 0);
                                        $this->db->from('main_schedule');
                                        echo $this->db->count_all_results();
                                        ?>
                                        </a>
                                    </h2>
                                    <p class="m-b-0"> Interview Schedule </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-file f-s-40 color-warning"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>
                                        <a title='Interview Schedule' href="<?php echo base_url() ?>Con_CV_Bank/"  target='_blank' >
                                            <?php 
                                            if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
                                                $this->db->where('company_id', $this->company_id);
                                            }
                                            $this->db->where('isactive', 1);
                                            $this->db->from('main_cv_management');
                                            echo $this->db->count_all_results();
                                            ?>
                                        </a>
                                    </h2>
                                    <p class="m-b-0"> Resume Bank </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <!--<span><i class="fa fa-times f-s-40 color-danger"></i></span>-->
                                    <span><i class="fa fa-check-square-o f-s-40 color-danger"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>
                                        <a title='Interview Schedule' href="<?php echo base_url() ?>Con_SelectedCandidates/"  target='_blank' >
                                        <?php
                                        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
                                                $this->db->where('company_id', $this->company_id);
                                            }
                                        $this->db->where('isactive', 1);
                                        $this->db->where('is_close', 0);
                                        $this->db->where('status', 3);
                                        $this->db->from('main_cv_management');
                                        echo $this->db->count_all_results();
                                        ?>
                                        </a>
                                    </h2>
                                    <p class="m-b-0">Selected Candidates</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
                <div align="center" id="container_chart"></div>
            </div>
            
            <!--<div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
                <fieldset>
                    <section>
                        <label class="label">Select single date with inline datepicker</label>
                        <div id="inline"></div>
                    </section>
                </fieldset>
            </div>-->

        </div>
    </div>

    <script>
        var dept =<?php echo $dept; ?>;
        var emp =<?php echo $emp; ?>;
        //var curr_mon=<?php // echo $current_month; ?>;

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
                    text: 'Open Positions Per Department'
                },
                subtitle: {
                    text: 'Source: HRC '
                },
                xAxis: {
                    categories: dept,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'No. of Positions'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y} REQ</b></td></tr>',
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
    else : //service Provaider user
        $first_date = date('Y-m-01');
        $current_date = date('Y-m-d');

        $sql = "SELECT a.id,a.company_full_name,sum(b.no_of_positions) as positions FROM main_company as a JOIN main_opening_position as b ON 
            a.id = b.company_id WHERE b.requisitions_date between '" . $first_date . "' and '" . $current_date . "'  group by a.id order by a.id";
        $cquery = $this->db->query($sql);
        //echo $this->db->last_query();exit();
        $rowcount = $cquery->num_rows();

        $comp = $dep = "[]";
        if ($rowcount > 0):
            $comp = "[";
            $dep = "[";
            $i = 0;
            foreach ($cquery->result() as $key):
                $i++;
                if ($i != $rowcount) {
                    $comp .= "'" . $key->company_full_name . "',";
                    $dep .= "" . $key->positions . ",";
                } else {
                    $comp .= "'" . $key->company_full_name . "']";
                    $dep .= "" . $key->positions . "]";
                }
            endforeach;
        endif;

        //echo $comp;
        //echo "<br>";
        //echo $dep;
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
        var dep =<?php echo $dep; ?>;

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
                    text: 'Open Positions Per Company'
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
                        text: 'No of Positions'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y} REQ</b></td></tr>',
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
                        data: dep

                    }]
            });
        });
    </script>
    <?php
    endif;
?>

</div>
</div>
