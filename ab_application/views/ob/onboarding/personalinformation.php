<?php 
$marital_status_array = $this->Common_model->get_array('marital_status');
$gender_array = $this->Common_model->get_array('gender');

//echo "=====".$candidate_id;

//if($candidate_id!="index" || $candidate_id!="0" || $candidate_id!="")
//{
    //$cquery = $this->db->get_where('main_cv_management', array('id' => $candidate_id,'isactive' => 1))->row();
    //echo $this->db->last_query();
//}

if ($user_type == 1) {
    $firstname = $this->name;
    $lastname = "";
} else {
    if($candidate_query){
        $firstname=$candidate_query->candidate_first_name;
        $lastname=$candidate_query->candidate_last_name;
        
    }else{
        $firstname = "";
        $lastname = "";
    }
}

//$firstname=$cquery->candidate_first_name;

if ($type == 1)
  {
  ?>
    <form id="onboarding_personalinformation_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/save_Onboarding_personalinformation" enctype="multipart/form-data" role="form">
        <input type="hidden" value="" name="onboarding_employee_id" id="onboarding_employee_id"/>
        <div class="form-group">
            <label class="col-sm-2 control-label">First Name<span class="req"/> </label>
            <div class="col-sm-4">
                <input type="text" name="onboarding_firstname" id="onboarding_firstname"  value="<?php echo $firstname; ?>" class="form-control input-sm"  placeholder="First Name" data-toggle="tooltip" data-placement="bottom" title="First Name">
            </div>
            <label class="col-sm-2 control-label">Middle Name </label>
            <div class="col-sm-4">
                <input type="text" name="onboarding_middlename" id="onboarding_middlename" class="form-control input-sm" placeholder="Middle Name" data-toggle="tooltip" data-placement="bottom" title="Middle Name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Last Name<span class="req"/> </label>
            <div class="col-sm-4">
                <input type="text" name="onboarding_lastname" id="onboarding_lastname" value="<?php echo $lastname; ?>" class="form-control input-sm" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Last Name">
            </div>
            <label class="col-sm-2 control-label">Suffix </label>
            <div class="col-sm-4">
                <input type="text" name="onboarding_suffix" id="onboarding_suffix" class="form-control input-sm" placeholder="Suffix" data-toggle="tooltip" data-placement="bottom" title="Suffix">
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-2 control-label">Maiden Name </label>
            <div class="col-sm-4">
                <input type="text" name="onboarding_maidenname" id="onboarding_maidenname" class="form-control input-sm" placeholder="Maiden Name" data-toggle="tooltip" data-placement="bottom" title="Maiden Name">
            </div>
            <label class="col-sm-2 control-label">Date of Birth<span class="req"/> </label>
            <div class="col-sm-4">
                <input type="text" name="onboarding_dateofbirth" id="onboarding_dateofbirth" class="form-control input-sm" placeholder="Date of Birth" title="Date of Birth" autocomplete="off">
            </div>
        </div>
        <div class="form-group no-margin">
            <label class="col-sm-2 control-label">SSN<span class="req"/></label>
            <div class="col-sm-4">
                <input type="text" name="onboarding_socialsecuritynumber" id="onboarding_socialsecuritynumber" class="form-control input-sm" placeholder="Social Security Number" data-toggle="tooltip" data-placement="bottom" title="Social Security Number">
            </div>
            <label class="col-sm-2 control-label">Gender</label>
            <div class="col-sm-4">
                <select name="gender" id="gender" class="col-sm-12 col-xs-12 myselect2 input-sm">
                    <option></option>
                    <?php
                    foreach ($gender_array as $row => $val) {
                        print"<option value='" . $row . "'>" . $val . "</option>";
                    }
                    ?>
                </select> 
            </div>
        </div>

        <div class="modal-footer">
<!--            <button type="submit" id="submit" class="btn btn-u">Save</button>
            <a class="btn btn-danger" href="<?php //echo base_url() . "Con_Onboarding" ?>">Close</a>-->

            <button class="btn btn-danger btn-prev pull-left disabled" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span> Previous </button>
            <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
            
            
        </div>
    </form>
 <?php 
  }
  else if ($type == 2) //Update
  {
      ?>
    <form id="onboarding_personalinformation_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/edit_Onboarding_personalinformation" enctype="multipart/form-data" role="form">
        <?php foreach ($query->result() as $row): ?> 
        <input type="hidden" value="<?php echo $row->onboarding_employee_id ?>" name="onboarding_employee_id" id="onboarding_employee_id"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">First Name<span class="req"/> </label>
                <div class="col-sm-4">
                    <input type="text" name="onboarding_firstname" id="onboarding_firstname" value="<?php echo ucwords($row->onboarding_firstname) ?>" class="form-control input-sm"  placeholder="First Name" data-toggle="tooltip" data-placement="bottom" title="First Name">
                </div>
                <label class="col-sm-2 control-label">Middle Name </label>
                <div class="col-sm-4">
                    <input type="text" name="onboarding_middlename" id="onboarding_middlename" value="<?php echo ucwords($row->onboarding_middlename) ?>" class="form-control input-sm" placeholder="Middle Name" data-toggle="tooltip" data-placement="bottom" title="Middle Name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Last Name<span class="req"/> </label>
                <div class="col-sm-4">
                    <input type="text" name="onboarding_lastname" id="onboarding_lastname" value="<?php echo ucwords($row->onboarding_lastname) ?>" class="form-control input-sm" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Last Name">
                </div>
                <label class="col-sm-2 control-label">Suffix </label>
                <div class="col-sm-4">
                    <input type="text" name="onboarding_suffix" id="onboarding_suffix" value="<?php echo ucwords($row->onboarding_suffix) ?>" class="form-control input-sm" placeholder="Suffix" data-toggle="tooltip" data-placement="bottom" title="Suffix">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Maiden Name </label>
                <div class="col-sm-4">
                    <input type="text" name="onboarding_maidenname" id="onboarding_maidenname" value="<?php echo ucwords($row->onboarding_maidenname) ?>" class="form-control input-sm" placeholder="Maiden Name" data-toggle="tooltip" data-placement="bottom" title="Maiden Name">
                </div>
                <label class="col-sm-2 control-label">Date of Birth<span class="req"/> </label>
                <div class="col-sm-4">
                    <input type="text" name="onboarding_dateofbirth" id="onboarding_dateofbirth" value="<?php echo $this->Common_model->show_date_formate($row->onboarding_dateofbirth); ?>" class="form-control input-sm" title="Date of Birth" autocomplete="off">
                </div>
            </div>
            <div class="form-group no-margin">
                <label class="col-sm-2 control-label">SSN<span class="req"/></label>
                <div class="col-sm-4">
                    <input type="text" name="onboarding_socialsecuritynumber" id="onboarding_socialsecuritynumber" value="<?php echo $row->onboarding_socialsecuritynumber ?>" class="form-control input-sm" placeholder="Social Security Number" data-toggle="tooltip" data-placement="bottom" title="Social Security Number">
                </div>
                <label class="col-sm-2 control-label">Gender</label>
                <div class="col-sm-4">
                    <select name="gender" id="gender" class="col-sm-12 col-xs-12 myselect2 input-sm">
                        <option></option>
                        <?php
                        foreach ($gender_array as $key => $val) {
                            ?>
                            <option value="<?php echo $key ?>"<?php if ($row->gender == $key) echo "selected"; ?>><?php echo $val ?></option>
                            <?php
                        }
                        ?>
                    </select> 
                </div>
            </div>
            
            <div class="modal-footer">
<!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                <a class="btn btn-danger" href="<?php //echo base_url() . "Con_onboarding_list" ?>">Close</a>-->
                
                <button class="btn btn-danger btn-prev pull-left disabled" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
    
            </div>
        <?php endforeach; ?>
    </form>
  
     <?php 
  }
  
?>

<!--<div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
    <button class="btn btn-u btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
    <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(is_employee)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
</div>-->

<script type="text/javascript">
    
    $(function() {
        $("#onboarding_socialsecuritynumber").mask("999-99-9999");
    });

    $("#gender").select2({
        placeholder: "Gender",
        allowClear: true,
    });

    
</script>