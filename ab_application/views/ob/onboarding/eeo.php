<?php
if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 9 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
    $self_identification_array = $this->db->get_where('main_eeoc_categories', array('company_id' => $this->company_id, 'isactive' => 1));
} else {
    $self_identification_array = $this->db->get_where('main_eeoc_categories', array('isactive' => 1));
}
$main_eeo_policies_query = $this->Common_model->listItem('main_eeo_policies');


if ($type == 1) {
    ?>
    <div class="container">
        <div class = "page-header no-margin">
            <h1>
                <small>Self Identification (Equal Employment Opportunity)</small>
            </h1>
        </div>

        <form id="onboarding_eeopolicies_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/save_onboarding_eeopolicies" enctype="multipart/form-data" role="form">
            <input type="hidden" value="" name="ob_eeo_emp_id" id="ob_eeo_emp_id"/>

            <div class="form-group" id="">
                <label class="col-sm-2 control-label">Race/Ethnicity<span class="req"/></label>
                <div class="col-sm-6">
                    <select name="eeo_id" id="eeo_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                        <option></option>
                        <?php foreach ($self_identification_array->result() as $row): ?>
                            <option value="<?php echo $row->id; ?>"><?php echo $row->eeoc_categories; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="modal-footer">
                <!--            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php //echo base_url() . "Con_Onboarding"  ?>">Close</a>-->

                <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
                </div>
            </div>
        </form>
    </div>
    <?php
}
else if ($type == 2) { //Update 
    $query = $this->db->get_where('main_ob_eeo_policies', array('onboarding_employee_id' => $ob_emp_id));
    if ($query->num_rows() > 0) {
        $action_type = 2;
    } else {
        $action_type = 1;
    }

    if ($action_type == 2) {
        ?>
        <div class="container">
            <div class = "page-header no-margin">
                <h1>
                    <small>Self Identification (Equal Employment Opportunity)</small>
                </h1>
            </div>
            <form id="onboarding_eeopolicies_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/edit_onboarding_eeopolicies" enctype="multipart/form-data" role="form">
                <?php
                foreach ($query->result() as $row1) {
                    // $pieces = explode(",", $row1->policy_id);
                    ?> 
                    <input type="hidden" value="<?php echo $row1->onboarding_employee_id ?>" name="ob_eeo_emp_id" id="ob_eeo_emp_id"/>

                    <div class="form-group" id="">
                        <label class="col-sm-2 control-label">Race/Ethnicity<span class="req"/></label>
                        <div class="col-sm-6">
                            <select name="eeo_id" id="eeo_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($self_identification_array->result() as $row): ?>
                                    <option value="<?php echo $row->id ?>" <?php if ($row1->policy_id == $row->id) {
                        echo "selected";
                    } ?>><?php echo $row->eeoc_categories ?></option>
            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

        <?php } ?>

                <div class="col-sm-12">
                    <div class="modal-footer">
                        <!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                        <a class="btn btn-danger" href="<?php //echo base_url() . "Con_onboarding_list"  ?>">Close</a>-->

                        <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                        <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
                    </div>
                </div>
            </form>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <div class="page-header no-margin">
                <h1>
                    <small>Self Identification (Equal Employment Opportunity)</small>
                </h1>
            </div>
            <form id="onboarding_eeopolicies_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/save_onboarding_eeopolicies" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="ob_eeo_emp_id" id="ob_eeo_emp_id"/>

                <div class="form-group" id="">
                    <label class="col-sm-2 control-label">Race/Ethnicity<span class="req"/></label>
                    <div class="col-sm-6">
                        <select name="eeo_id" id="eeo_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                            <option></option>
                            <?php foreach ($self_identification_array->result() as $row): ?>
                                <option value="<?php echo $row->id ?>"><?php echo $row->eeoc_categories ?></option>
                            <?php endforeach; ?>
                        </select>
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
            </form>
        </div>
        <?php
    }
}
?>

<!--
<div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
    <button class="btn btn-u btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
    <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(is_employee)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
</div>-->


<script type="text/javascript">

    $("#eeo_id").select2({
        placeholder: "Race/Ethnicity",
        allowClear: true,
    });

</script>
