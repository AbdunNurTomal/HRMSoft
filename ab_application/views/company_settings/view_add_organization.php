<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <?php
        if ($this->user_group == 11 || $this->user_group == 12) {
            $employees_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
            $position_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
            $hierarchy_query = $this->db->get_where('main_organization_settings', array('company_id' => $this->company_id, 'isactive' => 1));
        } else {
            $employees_query = $this->db->get_where('main_employees', array('isactive' => 1));
            $position_query = $this->db->get_where('main_positions', array('isactive' => 1));
            $hierarchy_query = $this->db->get_where('main_organization_settings', array('isactive' => 1));
        }
        // echo $this->db->last_query();
        // pr($employees_query->result());
        ?>            

        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">

            <div class="col-xl-12">
                <!----- Show Existing Organogram ----->
                <div class="col-md-8">
                    <p class="org-title">Current Company Chart</p>
                    <div id="chart_div"> </div>
                </div>

                <!------ New Employee Insert to Organogram  ------>
                <div class="col-md-4 well">
                    <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Organization_Setup/save_organization_settings" enctype="multipart/form-data" role="form">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Employee<span class="req"/></label>
                            <div class="col-sm-7">                            
                                <select name="employee_id" id="employee_id" onchange="get_emp_data(this.value);" class="col-sm-12 input-sm myselect2">
                                    <option></option>
                                    <?php
                                    foreach ($employees_query->result() as $row) {
                                        print"<option value='" . $row->employee_id . "'>" . $row->first_name . "</option>";
                                    }
                                    ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Profile picture</label>
                            <div class="col-sm-7">                            
                                <?php $src = base_url() . "uploads/blank.png"; ?>
                                <input type="hidden" name="image_name" id="image_name" value="<?php /* echo $row->image_name; */ ?>" />
                                <div class="pull-left">
                                    <img src="<?php echo $src; ?>" id="my_image" class="twPc-avatarImg pull-right" alt="Image" height="100" width="95">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Position</label>
                            <div class="col-sm-7">
                                <input type="text" id="position_div" class="form-control input-sm" data-toggle="tooltip" data-placement="bottom" title="Position" disabled readonly />
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Hierarchy</label>
                            <div class="col-sm-7">                            
                                <select name="hierarchy" id="hierarchy" class="col-sm-12 input-sm myselect2">
                                    <option></option>
                                    <?php
                                    foreach ($hierarchy_query->result() as $hrow) {
                                        print"<option value='" . $hrow->employee_id . "'>" . $this->Common_model->get_selected_value($this, 'employee_id', $hrow->employee_id, 'main_employees', 'first_name') . "</option>";
                                    }
                                    ?>
                                </select>  
                            </div>  
                        </div>  
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Sequence</label>
                            <div class="col-sm-7">
                                <input type="text" name="sequence" id="sequence" class="form-control input-sm"  placeholder="Sequence" data-toggle="tooltip" data-placement="bottom" title="Sequence" >
                            </div> 
                        </div>  
                        <div class="form-group">
                            <label class="col-sm-5 control-label">&nbsp;</label>
                            <div class="col-sm-7">
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Organization_Setup" ?>">Close</a>
                            </div> 
                        </div>   
                    </form>
                </div>      
            </div>

        </div>

    </div>
</div>


</div><!--/end row-->
</div><!--/end container-->
<style type="text/css">
    .well{margin-bottom:0 !important}
    .org-title{font-family:sans-serif; font-size:15px; font-style:italic; margin:0 0 15px}
    #chart_div table{border-collapse:separate !important;}
    .google-visualization-orgchart-node-medium{font-size:1.1em !important;}
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/company_organogram/loader.js" ></script>
<script type="text/javascript">
                                    google.charts.load('current', {packages: ["orgchart"]});
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = new google.visualization.DataTable();
                                        data.addColumn('string', 'Name');
                                        data.addColumn('string', 'Manager');
                                        data.addColumn('string', 'ToolTip');

                                        data.addRows([
                                            /* [{v: 'Mike', f: 'Mike<p style="color:red; font-style:italic; white-space:nowrap;">President</p>'}, '', 'The President'],
                                             [{v: 'Jim', f: 'Jim<p style="color:red; font-style:italic; white-space:nowrap;">Vice President</p>'}, 'Mike', 'VP'],
                                             ['Alice', 'Mike', ''],
                                             ['Bob', 'Jim', 'Bob Sponge'],
                                             ['Carol', 'Bob', ''],
                                             [{v: 'Yap', f: 'Yap<p style="color:red; font-style:italic; white-space:nowrap;">Software Engineer</p>'}, 'Alice', 'SE'],
                                             ['Mahmud', 'Bob', ''], */

<?php
foreach ($organogram as $val) {
    ?>
                                                [{v: '<?php echo $val["node"] ?>', f: '<?php echo $val["node"] ?><p style="color:red; font-style:italic; white-space:nowrap;"><?php echo $this->Common_model->get_name($this, $val["position"], 'main_jobtitles', 'job_title'); ?></p>'}, '<?php echo $val["parent"] ?>', '<?php echo $val["position"] ?>'],
    <?php
}
?>
                                        ]);

                                        // Create the chart.
                                        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
                                        // Draw the chart, setting the allowHtml option to true for the tooltips.
                                        chart.draw(data, {allowHtml: true});
                                    }
</script>

<script type="text/javascript">

    function get_emp_data(emp_id)
    {
        $.ajax({
            url: "<?php echo site_url('Con_Organization_Setup/load_emp_position/') ?>/" + emp_id,
            async: false,
            type: "POST",
            success: function (data) {
                //alert (data);
                var datas = data.split('_');

                $('#position_div').val('');
                $('#position_div').empty();

                $('#position_div').val(datas[0]);

                if (datas[1])
                {
                    var path = base_url + 'uploads/emp_image/';
                    $("#my_image").removeAttr("src").attr("src", path + datas[1]);
                } else
                {
                    var path = base_url + 'uploads/';
                    $("#my_image").removeAttr("src").attr("src", path + 'blank.png');
                }

                if (datas[2] != "")
                {
                    $("#hierarchy").select2("val", "");
                    $("#hierarchy").select2("val", datas[2]);
                    alert('Already Set Hierarchy');
                } else
                {
                    $("#hierarchy").select2("val", "");
                }

                if (datas[3] != "")
                {
                    $("#sequence").val(datas[3]);
                } else
                {
                    $("#sequence").val('');
                }
            }
        });
    }

    $(document).ready(function () {

        $("#employee_id").select2({
            placeholder: "Select Employee",
            allowClear: true,
        });

        $("#hierarchy").select2({
            placeholder: "Hierarchy",
            allowClear: true,
        });

        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Organization_Setup';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });

    });

</script>


