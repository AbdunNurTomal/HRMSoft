<?php 

$state_query = $this->Common_model->listItem('main_state');
$county_query = $this->Common_model->listItem('main_county');

if ($user_type == 1) {
    $email_id = $this->username;
} else {
    $email_id = "";
}

if ($type == 1) {
    
    ?>
        <form id="onboarding_contactinformation_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/save_onboarding_contactinformation" enctype="multipart/form-data" role="form">
            <div class="container">
                <div class="col-sm-6">
                    
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
            <input type="hidden" value="" name="ob_con_emp_id" id="ob_con_emp_id"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email Address</label>
                <div class="col-sm-4">
                    <input type="email" name="email_address" id="email_address" value="<?php echo $email_id; ?>" class="form-control input-sm"  placeholder="Email Address" data-toggle="tooltip" data-placement="bottom" title="Email Address">
                </div>
                <label class="col-sm-2 control-label">Phone 1</label>
                <div class="col-sm-4">
                    <input type="text" name="primary_phone" id="primary_phone" class="form-control input-sm" placeholder="Primary Phone" data-toggle="tooltip" data-placement="bottom" title="Primary Phone">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Address 1</label>
                <div class="col-sm-4">
                    <textarea name="street_address1" id="street_address1" class="form-control" rows="1" placeholder="Address 1" data-toggle="tooltip" data-placement="top" title="Address 1"></textarea>
                </div>  
                <label class="col-sm-2 control-label">Phone 2</label>
                <div class="col-sm-4">
                    <input type="text" name="secondary_phone" id="secondary_phone" class="form-control input-sm" placeholder="Secondary Phone" data-toggle="tooltip" data-placement="bottom" title="Secondary Phone">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Address 2</label>
                <div class="col-sm-4">
                    <textarea name="street_address2" id="street_address2" class="form-control" rows="1" placeholder="Address 2" data-toggle="tooltip" data-placement="top" title="Address 2"></textarea>
                </div>
                 <label class="col-sm-2 control-label">City</label>
                <div class="col-sm-4">
                    <input type="text" name="city" id="city" class="form-control input-sm"  placeholder="City" data-toggle="tooltip" data-placement="bottom" title="City">
                </div> 
            </div>
            <div class="form-group no-margin">
                <label class="col-sm-2 control-label">State</label>
                <div class="col-sm-4">
                    <select name="state" id="state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                        <option></option>
                        <?php foreach ($state_query->result() as $keyy): ?>
                            <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label">Zip Code</label>
                <div class="col-sm-4">
                    <input type="text" name="zipcode" id="zipcode" class="form-control input-sm"  placeholder="Zip Code" data-toggle="tooltip" data-placement="bottom" title="Zip Code">
                </div>                
            </div>
            <div class="form-group">
               <label class="col-sm-2 control-label">County</label>
                <div class="col-sm-4">
                    <select name="county" id="county" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                        <option></option>
                        <?php
                        foreach ($county_query->result() as $key):
                            ?>
                            <option value="<?php echo $key->id ?>"><?php echo $key->county_name ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select> 
                </div>
            </div>

            <div class="modal-footer">
<!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                <a class="btn btn-danger" href="<?php //echo base_url() . "Con_Onboarding" ?>">Close</a>-->

                <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
                    
            </div>
        </form>
    <?php
}
else if ($type == 2) { //Update

    $query = $this->db->get_where('main_ob_contact_information', array('onboarding_employee_id' => $ob_emp_id));
    if ($query->num_rows() > 0) {
        $action_type = 2;
    } else {
        $action_type = 1;
    }

    if ($action_type == 2) {
        ?>
        <form id="onboarding_contactinformation_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/edit_onboarding_contactinformation" enctype="multipart/form-data" role="form">
            <?php foreach ($query->result() as $row): ?> 
                <input type="hidden" value="<?php echo $row->onboarding_employee_id ?>" name="ob_con_emp_id" id="ob_con_emp_id"/>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email Address</label>
                    <div class="col-sm-4">
                        <input type="email" name="email_address" id="email_address" value="<?php echo $row->email_address ?>" class="form-control input-sm"  placeholder="Email Address" data-toggle="tooltip" data-placement="bottom" title="Email Address">
                    </div>
                    <label class="col-sm-2 control-label">Phone 1</label>
                    <div class="col-sm-4">
                        <input type="text" name="primary_phone" id="primary_phone" value="<?php echo $row->primary_phone ?>" class="form-control input-sm" placeholder="Primary Phone" data-toggle="tooltip" data-placement="bottom" title="Primary Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address 1</label>
                    <div class="col-sm-4">
                        <textarea name="street_address1" id="street_address1" class="form-control" rows="1" placeholder="Address 1" data-toggle="tooltip" data-placement="top" title="Address 1"> <?php echo ucwords($row->street_address1) ?> </textarea>
                    </div> 
                    <label class="col-sm-2 control-label">Phone 2</label>
                    <div class="col-sm-4">
                        <input type="text" name="secondary_phone" id="secondary_phone" value="<?php echo $row->secondary_phone ?>" class="form-control input-sm" placeholder="Secondary Phone" data-toggle="tooltip" data-placement="bottom" title="Secondary Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address 2</label>
                    <div class="col-sm-4">
                        <textarea name="street_address2" id="street_address2" class="form-control" rows="1" placeholder="Address 2" data-toggle="tooltip" data-placement="top" title="Address 2"> <?php echo ucwords($row->street_address2) ?> </textarea>
                    </div>
                    <label class="col-sm-2 control-label">City</label>
                    <div class="col-sm-4">
                        <input type="text" name="city" id="city" value="<?php echo ucwords($row->city) ?>" class="form-control input-sm"  placeholder="City" data-toggle="tooltip" data-placement="bottom" title="City">
                    </div>                    
                </div>
                <div class="form-group no-margin">
                    <label class="col-sm-2 control-label">State</label>
                    <div class="col-sm-4">
                        <select name="state" id="state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                            <option></option>
                            <?php foreach ($state_query->result() as $keyy): ?>
                                <option value="<?php echo $keyy->id ?>" <?php if ($row->state == $keyy->id) echo "selected"; ?> ><?php echo $keyy->state_abbr ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="col-sm-2 control-label">Zip Code</label>
                    <div class="col-sm-4">
                        <input type="text" name="zipcode" id="zipcode" value="<?php echo $row->zipcode ?>" class="form-control input-sm"  placeholder="Zip Code" data-toggle="tooltip" data-placement="bottom" title="Zip Code">
                    </div>
                     
                </div>
                <div class="form-group">                    
                    <label class="col-sm-2 control-label">County</label>
                    <div class="col-sm-4">
                        <select name="county" id="county" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                            <option></option>
                            <?php
                            foreach ($county_query->result() as $key):
                                ?>
                                <option value="<?php echo $key->id ?>" <?php if ($row->county == $key->id) echo "selected"; ?> ><?php echo $key->county_name ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select> 
                    </div>
                </div>
                
                <div class="modal-footer">
<!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                    <a class="btn btn-danger" href="<?php //echo base_url() . "Con_onboarding_list" ?>">Close</a>-->
                    
                    <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                    <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
                
                </div>
        <?php endforeach; ?>
        </form>
          
        <?php
    }
    else {
        ?>

        <form id="onboarding_contactinformation_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/save_onboarding_contactinformation" enctype="multipart/form-data" role="form">
            <input type="hidden" value="" name="ob_con_emp_id" id="ob_con_emp_id"/>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email Address</label>
                <div class="col-sm-4">
                    <input type="email" name="email_address" id="email_address" value="<?php echo $email_id; ?>" class="form-control input-sm"  placeholder="Email Address" data-toggle="tooltip" data-placement="bottom" title="Email Address">
                </div>
                <label class="col-sm-2 control-label">Phone 1</label>
                <div class="col-sm-4">
                    <input type="text" name="primary_phone" id="primary_phone" class="form-control input-sm" placeholder="Primary Phone" data-toggle="tooltip" data-placement="bottom" title="Primary Phone">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Address 1</label>
                <div class="col-sm-4">
                    <textarea name="street_address1" id="street_address1" class="form-control" rows="1" placeholder="Address 1" data-toggle="tooltip" data-placement="top" title="Address 1"></textarea>
                </div>
                <label class="col-sm-2 control-label">Phone 2</label>
                <div class="col-sm-4">
                    <input type="text" name="secondary_phone" id="secondary_phone" class="form-control input-sm" placeholder="Secondary Phone" data-toggle="tooltip" data-placement="bottom" title="Secondary Phone">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Address 2</label>
                <div class="col-sm-4">
                    <textarea name="street_address2" id="street_address2" class="form-control" rows="1" placeholder="Address 2" data-toggle="tooltip" data-placement="top" title="Address 2"></textarea>
                </div>
                <label class="col-sm-2 control-label">City</label>
                <div class="col-sm-4">
                    <input type="text" name="city" id="city" class="form-control input-sm"  placeholder="City" data-toggle="tooltip" data-placement="bottom" title="City">
                </div>
            </div>
            <div class="form-group no-margin">
                <label class="col-sm-2 control-label">State</label>
                <div class="col-sm-4">
                    <select name="state" id="state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                        <option></option>
                        <?php foreach ($state_query->result() as $keyy): ?>
                            <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <label class="col-sm-2 control-label">Zip Code</label>
                <div class="col-sm-4">
                    <input type="text" name="zipcode" id="zipcode" class="form-control input-sm"  placeholder="Zip Code" data-toggle="tooltip" data-placement="bottom" title="Zip Code">
                </div>
            </div>
            <div class="form-group no-margin">
                <label class="col-sm-2 control-label">County</label>
                <div class="col-sm-4">
                    <select name="county" id="county" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                        <option></option>
                        <?php
                        foreach ($county_query->result() as $key):
                            ?>
                            <option value="<?php echo $key->id ?>"><?php echo $key->county_name ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select> 
                </div>
            </div>
            
            <div class="modal-footer">
<!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                <a class="btn btn-danger" href="<?php //echo base_url() . "Con_onboarding_list" ?>">Close</a>-->
                
                <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
                
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
    
    $("#state").select2({
        placeholder: "State",
        allowClear: true,
    });
    
    $("#county").select2({
        placeholder: "County",
        allowClear: true,
    });
    
    $(function() {
        $("#zipcode").mask("99999");
        $("#primary_phone").mask("(999) 999-9999");
        $("#secondary_phone").mask("(999) 999-9999");
    });
    
    $(document).ready(function () {
//        $('#if_foreign_address').change(function () {
//            if (!this.checked) {
//                $('#foreign_address_div').addClass("hidden");
//                $('#city_street_div').addClass("hidden");
//                $('#zipcode_div').addClass("hidden");
//                $('#if_foreign_address').val('0');
//            }
//            else
//            {
//               $('#foreign_address_div').removeClass("hidden");
//               $('#city_street_div').removeClass("hidden");
//               $('#zipcode_div').removeClass("hidden");
//               $('#if_foreign_address').val('1');
//            }
//        });
//        
//        if ($('input.checkbox_check').prop('checked')) {
//            $('#foreign_address_div').removeClass("hidden");
//            $('#city_street_div').removeClass("hidden");
//            $('#zipcode_div').removeClass("hidden");
//            $('#if_foreign_address').val('1');
//        }
//        else
//        {
//            $('#foreign_address_div').addClass("hidden");
//            $('#city_street_div').addClass("hidden");
//            $('#zipcode_div').addClass("hidden");
//            $('#if_foreign_address').val('0'); 
//        }
    });
    
</script>  