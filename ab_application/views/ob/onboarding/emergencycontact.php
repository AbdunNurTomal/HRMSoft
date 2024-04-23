<?php
if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
    $relationship_status_query = $this->db->get_where('main_relationship_status', array('company_id' => $this->company_id, 'isactive' => 1));
} else {
    $relationship_status_query = $this->db->get_where('main_relationship_status', array('isactive' => 1));
}

$relationship_array = $this->Common_model->get_array('relationship_array');

if ($type == 1) {
    ?>
    <form id="onboarding_emergencycontact_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/save_onboarding_emergencycontact" enctype="multipart/form-data" role="form">
        <div class="container">
            <input type="hidden" value="" name="ob_emc_emp_id" id="ob_emc_emp_id"/>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label">First Name<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="first_name" id="first_name" class="form-control input-sm"  placeholder="First Name" data-toggle="tooltip" data-placement="bottom" title="First Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Last Name<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Last Name">
                    </div>
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-4 control-label">Relationship<span class="req"/></label>
                    <div class="col-sm-8">
                        <select name="relationship_with_employee" id="relationship_with_employee" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                            <option></option>
    <?php
    foreach ($relationship_array as $key => $val):
        ?>
                                <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select> 
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Primary Phone<span class="req"/></label>
                    <div class="col-sm-8">
                        <input type="text" name="primary_phone" id="primary_phone_em" class="form-control input-sm" placeholder="Primary Phone" data-toggle="tooltip" data-placement="bottom" title="Primary Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Secondary Phone</label>
                    <div class="col-sm-8">
                        <input type="text" name="secondary_phone" id="secondary_phone_em" class="form-control input-sm" placeholder="Secondary Phone" data-toggle="tooltip" data-placement="bottom" title="Secondary Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="2" id="address" name="address" placeholder="Address"></textarea>
                    </div>  
                </div>
            </div>

            <div class="col-sm-12">
                <div class="modal-footer">
                    <!--            <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php //echo base_url() . "Con_Onboarding"   ?>">Close</a>-->

                    <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                    <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
                </div>
            </div>

        </div>
    </form>
    <?php
}
else if ($type == 2) { //Update
    $query = $this->db->get_where('main_ob_emergencycontact', array('onboarding_employee_id' => $ob_emp_id));
    if ($query->num_rows() > 0) {
        $action_type = 2;
    } else {
        $action_type = 1;
    }

    if ($action_type == 2) {
        ?>
        <form id="onboarding_emergencycontact_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/edit_onboarding_emergencycontact" enctype="multipart/form-data" role="form">
            <div class="container">
        <?php foreach ($query->result() as $row): ?> 
                    <input type="hidden" value="<?php echo $row->onboarding_employee_id ?>" name="ob_emc_emp_id" id="ob_emc_emp_id"/>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">First Name<span class="req"/></label>
                            <div class="col-sm-8">
                                <input type="text" name="first_name" id="first_name" value="<?php echo ucwords($row->first_name) ?>" class="form-control input-sm"  placeholder="First Name" data-toggle="tooltip" data-placement="bottom" title="First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Last Name<span class="req"/></label>
                            <div class="col-sm-8">
                                <input type="text" name="last_name" id="last_name" value="<?php echo ucwords($row->last_name) ?>" class="form-control input-sm" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Last Name">
                            </div>
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-sm-4 control-label">Relationship<span class="req"/></label>
                            <div class="col-sm-8">
                                <select name="relationship_with_employee" id="relationship_with_employee" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
            <?php
            foreach ($relationship_array as $key => $val):
                ?>
                                        <option value="<?php echo $key ?>" <?php if ($row->relationship_with_employee == $key) echo "selected"; ?> ><?php echo $val ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Primary Phone<span class="req"/></label>
                            <div class="col-sm-8">
                                <input type="text" name="primary_phone" id="primary_phone_em" value="<?php echo $row->primary_phone ?>" class="form-control input-sm" placeholder="Primary Phone" data-toggle="tooltip" data-placement="bottom" title="Primary Phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Secondary Phone</label>
                            <div class="col-sm-8">
                                <input type="text" name="secondary_phone" id="secondary_phone_em" value="<?php echo $row->secondary_phone ?>" class="form-control input-sm" placeholder="Secondary Phone" data-toggle="tooltip" data-placement="bottom" title="Secondary Phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="2" id="address" name="address" placeholder="Address"><?php echo ucwords($row->address) ?></textarea>
                            </div> 
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="modal-footer">
                            <!--                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                                                <a class="btn btn-danger" href="<?php //echo base_url() . "Con_onboarding_list"  ?>">Close</a>-->

                            <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                            <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>

                        </div>
                    </div>
        <?php endforeach; ?>
            </div>
        </form>

        <?php
    }
    else {
        ?>
        <form id="onboarding_emergencycontact_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/save_onboarding_emergencycontact" enctype="multipart/form-data" role="form">
            <div class="container">
                <input type="hidden" value="" name="ob_emc_emp_id" id="ob_emc_emp_id"/>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">First Name<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="first_name" id="first_name" class="form-control input-sm"  placeholder="First Name" data-toggle="tooltip" data-placement="bottom" title="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Last Name<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Last Name">
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Relationship<span class="req"/></label>
                        <div class="col-sm-8">
                            <select name="relationship_with_employee" id="relationship_with_employee" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
        <?php
        foreach ($relationship_array as $key => $val):
            ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>                 
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Primary Phone<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="primary_phone" id="primary_phone_em" class="form-control input-sm" placeholder="Primary Phone" data-toggle="tooltip" data-placement="bottom" title="Primary Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Secondary Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="secondary_phone" id="secondary_phone_em" class="form-control input-sm" placeholder="Secondary Phone" data-toggle="tooltip" data-placement="bottom" title="Secondary Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="2" id="address" name="address" placeholder="Address"></textarea>
                        </div> 
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="modal-footer">
                        <!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                        <a class="btn btn-danger" href="<?php //echo base_url() . "Con_onboarding_list"  ?>">Close</a>-->

                        <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                        <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
                    </div>
                </div>

            </div>
        </form>

        <?php
    }
}
?>


<!--<div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
    <button class="btn btn-u btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
    <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(is_employee)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
</div>-->

<script type="text/javascript">

    $(function () {
        $("#primary_phone_em").mask("(999) 999-9999");
        $("#secondary_phone_em").mask("(999) 999-9999");
    });


    $("#relationship_with_employee").select2({
        placeholder: "Relationship With Employee",
        allowClear: true,
    });

</script>  