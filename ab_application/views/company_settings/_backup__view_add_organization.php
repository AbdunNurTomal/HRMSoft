<div class="col-md-12 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <?php
        if ($this->user_type == 2) {
            $employees_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id));
            $position_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id));
            $hierarchy_query = $this->db->get_where('main_organization_settings', array('company_id' => $this->company_id));
        } else {
            $employees_query = $this->Common_model->listItem('main_employees');
            $position_query = $this->Common_model->listItem('main_positions');
            $hierarchy_query = $this->Common_model->listItem('main_organization_settings');
        }
        ?>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px; padding-top: 50px;">

            <form id="org_settings_form" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_configaration/save_organization_settings" enctype="multipart/form-data" role="form" >
                <div class="col-md-10 col-md-offset-1">   

                    <input type="hidden" value="" name="id" id="id"/>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select Employee</label>
                            <div class="col-sm-8">                            
                                <select name="employee_id" id="employee_id" onchange="get_emp_data(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
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
                            <label class="col-sm-4 control-label">Positions</label>
                            <div class="col-sm-8" id="position_div"> </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Hierarchy </label>
                            <div class="col-sm-8">                            
                                <select name="hierarchy" id="hierarchy" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($hierarchy_query->result() as $hrow) {
                                        print"<option value='" . $hrow->employee_id  . "'>" . $this->Common_model->get_selected_value($this,'employee_id',$hrow->employee_id,'main_employees','first_name') . "</option>";
                                    }
                                    ?>
                                </select>  
                            </div>  
                        </div>  
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Sequence</label>
                            <div class="col-sm-8">
                                <input type="text" name="sequence" id="sequence" class="form-control input-sm"  placeholder="Sequence" data-toggle="tooltip" data-placement="bottom" title="Sequence" >
                            </div> 
                        </div>  
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <!--<label class="col-sm-2 control-label">Images</label>-->
                            <div class="col-sm-12">  
                                <?php
                                $src = base_url() . "uploads/blank.png";
                                ?>
                                <input type="hidden" name="image_name" id="image_name" value="<?php // echo $row->image_name ?>" />
                                <div class="box pull-left">
                                    <img src="<?php echo $src; ?>" id="my_image" class="twPc-avatarImg pull-right" alt="Image" height="100" width="95">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-md-10 col-md-offset-1">
                     <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php  echo base_url() . "Con_configaration" ?>">Close</a>
                    </div>
                </div>                
            </form>
        </div>
        
<!--        <div id="org_tree" class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px; padding-top: 50px;">
            
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label">Organization Tree</label></br>
                <div id="pr_li" class="col-sm-8 well-sm">
                    <?php
//                    $this->db->order_by("sequence", "asc");
//                    $query = $this->db->get_where('main_organization_settings', array('hierarchy' => 0));
//                    if ($query) {
//                        foreach ($query->result() as $row) {
                            ?>
                        
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <?php
//                                    $emp_image = $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees','image_name');
//                                    if ($emp_image == "") {
//                                        $src = base_url() . "uploads/blank.png";
//                                    } else {
//                                        $src = "http://".$_SERVER['HTTP_HOST']."/hrm/uploads/emp_image/". $emp_image;
//                                    }
                                    ?>
                                    <img src="<?php // echo $src; ?>" id="my_image" class="twPc-avatarImg pull-right" alt="Image" height="80" width="70">
                                    <h4><?php // echo $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'first_name'); ?></h4>
                                    <h3>Position : <?php
//                                        $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'position');
//                                        echo $position_name = $this->Common_model->get_name($this, $emp_position, 'main_positions', 'positionname');
                                        ?> 
                                    </h3>
                                </li>
                            </ul>
                            
                                <?php
//                                $this->db->order_by("sequence", "asc");
//                                $root_query = $this->db->get_where('main_organization_settings', array('hierarchy' => $row->employee_id));
//                                if ($root_query) {
//                                    foreach ($root_query->result() as $rrow) {
                                        ?>
                                    
                                        <ul class="list-group" style=" margin-left: 40px;">
                                            <li class="list-group-item">
                                                <?php
//                                                $emp_image = $this->Common_model->get_selected_value($this, 'employee_id', $rrow->employee_id, 'main_employees','image_name');
//                                                if ($emp_image == "") {
//                                                    $src = base_url() . "uploads/blank.png";
//                                                } else {
//                                                    $src = "http://".$_SERVER['HTTP_HOST']."/hrm/uploads/emp_image/". $emp_image;
//                                                }
                                                ?>
                                                <img src="<?php // echo $src; ?>" id="my_image" class="twPc-avatarImg pull-right" alt="Image" height="80" width="70">
                                                <h4><?php // echo $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $rrow->employee_id, 'main_employees', 'first_name'); ?> </h4>
                                                <h3>Position : <?php
//                                                    $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $rrow->employee_id, 'main_employees', 'position');
//                                                    echo $position_name = $this->Common_model->get_name($this, $emp_position, 'main_positions', 'positionname');
                                                    ?> 
                                                </h3>
                                            </li>
                                        </ul>
                                    
                                        <?php
//                                        $this->db->order_by("sequence", "asc");
//                                        $sroot_query = $this->db->get_where('main_organization_settings', array('hierarchy' => $rrow->employee_id));
//                                        if ($sroot_query) {
//                                            foreach ($sroot_query->result() as $srow) {
                                                ?>
                                                <ul class="list-group" style=" padding-left: 90px;">
                                                    <li class="list-group-item">
                                                        <?php
//                                                        $emp_image = $this->Common_model->get_selected_value($this, 'employee_id', $srow->employee_id, 'main_employees','image_name');
//                                                        if ($emp_image == "") {
//                                                            $src = base_url() . "uploads/blank.png";
//                                                        } else {
//                                                            $src = "http://".$_SERVER['HTTP_HOST']."/hrm/uploads/emp_image/". $emp_image;
//                                                        }
                                                        ?>
                                                        <img src="<?php // echo $src; ?>" id="my_image" class="twPc-avatarImg pull-right" alt="Image" height="80" width="70">
                                                        <h4><?php // echo $this->Common_model->get_selected_value($this, 'employee_id', $srow->employee_id, 'main_employees', 'first_name'); ?> </h4>
                                                        <h3>Position : <?php //
//                                                            $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $srow->employee_id, 'main_employees', 'position');
//                                                            echo $this->Common_model->get_name($this, $emp_position, 'main_positions', 'positionname');
                                                            ?>
                                                        </h3>
                                                    </li>
                                                </ul>
                                                //<?php
//                                            }
//                                        }
//                                        
//                                    }
//                                }
//                                ?>
                           
                            //<?php
//                        }
//                    }
//                    ?>
                </div>
            </div>
            
        </div>-->
        
    </div>
</div>


</div><!--/end row-->
</div><!--/end container-->


<script type="text/javascript">


function get_emp_data(emp_id)
{
    $.ajax({
            url: "<?php echo site_url('Con_configaration/load_emp_position/') ?>/" + emp_id,
            async: false,
            type: "POST",
            success: function (data) {
                //alert (data);
                var datas = data.split( '_' );
                
                $('#position_div').html('');
                $('#position_div').empty();
        
                $('#position_div').html(datas[0]);
                
                if(datas[1])
                {
                  var path = 'http://'+'<?php echo $_SERVER['HTTP_HOST']; ?>'+'/hrm/uploads/emp_image/';
                  $("#my_image").removeAttr("src").attr("src", path + datas[1]);  
                }
                else
                {
                    var path = 'http://'+'<?php echo $_SERVER['HTTP_HOST']; ?>'+'/hrm/uploads/';
                    $("#my_image").removeAttr("src").attr("src", path + 'blank.png');
                }
                
                if(datas[2]!="")
                {
                    $("#hierarchy").select2("val", "");
                    $("#hierarchy").select2("val", datas[2]);
                    alert ('Already Set Hierarchy');
                }
                else
                {
                    $("#hierarchy").select2("val", "");
                }
                
                if(datas[3]!="")
                {
                    $("#sequence").val(datas[3]);
                }
                else
                {
                    $("#sequence").val('');
                }
            }
        })
}

    $(function(){
        $( "#org_settings_form" ).submit(function( event ) {
            var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#org_settings_form").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  
//                    $('#org_settings_form')[0].reset();
                    
                    var url='';
                    view_message(data,url,'','org_settings_form');
                    
                    $("#org_tree").load(location.href + " #org_tree");
                    
              });
            event.preventDefault();
        });
    });
   
    
    $("#employee_id").select2({
        placeholder: "Employee",
        allowClear: true,
    });
    
    $("#hierarchy").select2({
        placeholder: "Hierarchy",
        allowClear: true,
    });

</script>


