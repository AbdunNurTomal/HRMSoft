<?php
$this->db->select('employee_id, emp_user_id');
$this->db->where('employee_id', $employee_id);
$query = $this->db->get('main_employees')->row();
//echo $this->db->last_query();

if ($query->emp_user_id > 0) {
    $type = 2;
} else {
    $type = 1;
}
//echo $type;

if ($type == 1) {
    //echo $type;
    ?>
    <form id="password_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employees/save_emp_password" enctype="multipart/form-data" role="form">
        <input type="hidden" value="" name="emp_user_id" id="emp_user_id"/>
        <div class="">
            <div class="form-group">
                <label class="col-sm-4 control-label ">User Password</label>
                <div class="col-sm-4">
                    <input type="password" name="emp_password" id="emp_password" class="form-control input-sm" placeholder="User Password" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Confirm Password</label>
                <div class="col-sm-4">
                    <input type="password" name="emp_confirm_password" id="emp_confirm_password" class="form-control input-sm" placeholder="Confirm Password" />
                </div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-u"> Save </button>
                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employees/index/1" ?>">Close</a>
            </div>
    </form>
    <?php
}
else if ($type == 2) { //Update
    //echo $type;
    $user_query = $this->db->get_where('main_users', array('id' => $query->emp_user_id));
    if ($user_query->num_rows() > 0) {
        $utype = 2;
    } else {
        $utype = 1;
    }
    if($utype==2)
    {
    ?>
    <form id="password_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employees/save_emp_password" enctype="multipart/form-data" role="form">
        <?php foreach ($user_query->result() as $row): ?> 
            <input type="hidden" value="<?php echo $row->id ?>" name="emp_user_id" id="emp_user_id"/>
            <div class=" ">
                <div class="form-group">
                    <label class="col-sm-4 control-label ">User Password <span class="req"/></label>
                    <div class="col-sm-4">
                        <input type="password" name="emp_password" id="emp_password" value="" class="form-control input-sm" placeholder="User Password" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Confirm Password <span class="req"/></label>
                    <div class="col-sm-4">
                        <input type="password" name="emp_confirm_password" id="emp_confirm_password" value="" class="form-control input-sm" placeholder="Confirm Password" />
                    </div>
                </div>
               
            </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u"> Save </button>
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employees/index/1"; ?>">Close</a>
                </div>
        <?php endforeach; ?>
    </form>

    <?php
    }
    else {
        ?>
        <form id="password_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Employees/save_emp_password" enctype="multipart/form-data" role="form">
            <input type="hidden" value="" name="emp_user_id" id="emp_user_id"/>
            <div class="">
                <div class="form-group">
                    <label class="col-sm-4 control-label ">User Password <span class="req"/></label>
                    <div class="col-sm-4">
                        <input type="password" name="emp_password" id="emp_password" class="form-control input-sm" placeholder="User Password" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Confirm Password <span class="req"/></label>
                    <div class="col-sm-4">
                        <input type="password" name="emp_confirm_password" id="emp_confirm_password" class="form-control input-sm" placeholder="Confirm Password" />
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-u"> Save </button>
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employees/edit_entry/$employee_id" ?>">Close</a>
                </div>
        </form>
        <?php
    }
}
?>

<script type="text/javascript">

   
</script>  