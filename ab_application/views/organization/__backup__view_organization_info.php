
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div id="org_tree" class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px; padding-top: 50px;">

            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label"> Organization Tree </label></br>
                <div id="pr_li" class="col-sm-8 well-sm">
                    <?php
                    $this->db->order_by("sequence", "asc");
                    $query = $this->db->get_where('main_organization_settings', array('hierarchy' => 0));
                    if ($query) {
                        foreach ($query->result() as $row) {
                            ?>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <?php
                                    $emp_image = $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'image_name');
                                    if ($emp_image == "") {
                                        $src = base_url() . "uploads/blank.png";
                                    } else {
                                        $src = "http://" . $_SERVER['HTTP_HOST'] . "/hrm/uploads/emp_image/" . $emp_image;
                                    }
                                    ?>
                                    <img src="<?php echo $src; ?>" id="my_image" class="twPc-avatarImg pull-right" alt="Image" height="80" width="70">
                                    <h4><?php echo $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'first_name'); ?></h4>
                                    <h3>Position : <?php
                                        $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'position');
                                        echo $position_name = $this->Common_model->get_name($this, $emp_position, 'main_positions', 'positionname');
                                        ?> 
                                    </h3>
                                </li>
                            </ul>

                            <?php
                            $this->db->order_by("sequence", "asc");
                            $root_query = $this->db->get_where('main_organization_settings', array('hierarchy' => $row->employee_id));
                            if ($root_query) {
                                foreach ($root_query->result() as $rrow) {
                                    ?>

                                    <ul class="list-group" style=" margin-left: 40px;">
                                        <li class="list-group-item">
                                            <?php
                                            $emp_image = $this->Common_model->get_selected_value($this, 'employee_id', $rrow->employee_id, 'main_employees', 'image_name');
                                            if ($emp_image == "") {
                                                $src = base_url() . "uploads/blank.png";
                                            } else {
                                                $src = "http://" . $_SERVER['HTTP_HOST'] . "/hrm/uploads/emp_image/" . $emp_image;
                                            }
                                            ?>
                                            <img src="<?php echo $src; ?>" id="my_image" class="twPc-avatarImg pull-right" alt="Image" height="80" width="70">
                                            <h4><?php echo $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $rrow->employee_id, 'main_employees', 'first_name'); ?> </h4>
                                            <h3>Position : <?php
                                                $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $rrow->employee_id, 'main_employees', 'position');
                                                echo $position_name = $this->Common_model->get_name($this, $emp_position, 'main_positions', 'positionname');
                                                ?> 
                                            </h3>
                                        </li>
                                    </ul>

                                    <?php
                                    $this->db->order_by("sequence", "asc");
                                    $sroot_query = $this->db->get_where('main_organization_settings', array('hierarchy' => $rrow->employee_id));
                                    if ($sroot_query) {
                                        foreach ($sroot_query->result() as $srow) {
                                            ?>
                                            <ul class="list-group" style=" padding-left: 90px;">
                                                <li class="list-group-item">
                                                    <?php
                                                    $emp_image = $this->Common_model->get_selected_value($this, 'employee_id', $srow->employee_id, 'main_employees', 'image_name');
                                                    if ($emp_image == "") {
                                                        $src = base_url() . "uploads/blank.png";
                                                    } else {
                                                        $src = "http://" . $_SERVER['HTTP_HOST'] . "/hrm/uploads/emp_image/" . $emp_image;
                                                    }
                                                    ?>
                                                    <img src="<?php echo $src; ?>" id="my_image" class="twPc-avatarImg pull-right" alt="Image" height="80" width="70">
                                                    <h4><?php echo $this->Common_model->get_selected_value($this, 'employee_id', $srow->employee_id, 'main_employees', 'first_name'); ?> </h4>
                                                    <h3>Position : <?php
                                                        $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $srow->employee_id, 'main_employees', 'position');
                                                        echo $this->Common_model->get_name($this, $emp_position, 'main_positions', 'positionname');
                                                        ?>
                                                    </h3>
                                                </li>
                                            </ul>
                                            <?php
                                        }
                                    }
                                }
                            }
                            ?>

                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>















<?php
$data = array(
    '0' => array(
        '1' => array(
            '1' => 'aaaa',
            '2' => 'bbb',
            '3' => 'cccc',
        ),
        '2' => array(
            '1' => 'dddd',
            '2' => 'eee',
            '3' => 'fff',
        ),        
    )
);

print_r($data);
//exit();
?>











<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() . 'con_HrmDashbord' ?>">HRM</a></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div id="org_tree" class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px; padding-top: 50px;">

            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label">Organization Tree</label></br>
                <div id="pr_li" class="col-sm-8 well-sm">
<?php
$this->db->order_by("sequence", "asc");
$query = $this->db->get_where('main_organization_settings', array('hierarchy' => 0));
if ($query) {
    foreach ($query->result() as $row) {
        ?>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4><?php echo $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'first_name'); ?></h4>
                                </li>
                            </ul>

        <?php
        $this->db->order_by("sequence", "asc");
        $root_query = $this->db->get_where('main_organization_settings', array('hierarchy' => $row->employee_id));
        if ($root_query) {
            foreach ($root_query->result() as $rrow) {
                ?>

                                    <ul class="list-group" style=" margin-left: 40px;">
                                        <li class="list-group-item">
                                            <h4><?php echo $emp_position = $this->Common_model->get_selected_value($this, 'employee_id', $rrow->employee_id, 'main_employees', 'first_name'); ?> </h4>
                                        </li>
                                    </ul>

                <?php
                $this->db->order_by("sequence", "asc");
                $sroot_query = $this->db->get_where('main_organization_settings', array('hierarchy' => $rrow->employee_id));
                if ($sroot_query) {
                    foreach ($sroot_query->result() as $srow) {
                        ?>
                                            <ul class="list-group" style=" padding-left: 90px;">
                                                <li class="list-group-item">
                                                    <h4><?php echo $this->Common_model->get_selected_value($this, 'employee_id', $srow->employee_id, 'main_employees', 'first_name'); ?> </h4>
                                                </li>
                                            </ul>
                        <?php
                    }
                }
            }
        }
    }
}
?>
                </div>
            </div>

        </div>
    </div>
</div>































</div><!--/row-->
</div><!--/container-->
