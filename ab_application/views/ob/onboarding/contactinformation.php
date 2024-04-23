<?php 

$state_query = $this->Common_model->listItem('main_state');

if ($user_type == 1) {
    $email_id = $this->username;
} else {
    if($candidate_query){
        $email_id=$candidate_query->candidate_email;
    }else{
        $email_id = "";
    }
}

if ($type == 1) {
    
    ?>
        <form id="onboarding_contactinformation_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/save_onboarding_contactinformation" enctype="multipart/form-data" role="form">
            <div class="container">
                <input type="hidden" value="" name="ob_con_emp_id" id="ob_con_emp_id"/>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email Address<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="email" name="email_address" id="email_address" value="<?php echo $email_id; ?>" class="form-control input-sm"  placeholder="Email Address" data-toggle="tooltip" data-placement="bottom" title="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Home Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="home_phone" id="home_phone" class="form-control input-sm" placeholder="Home Phone" data-toggle="tooltip" data-placement="bottom" title="Home Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Mobile Phone<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control input-sm" placeholder="Mobile Phone" data-toggle="tooltip" data-placement="bottom" title="Mobile Phone">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-4 control-label">Work Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="work_phone" id="work_phone" class="form-control input-sm" placeholder="Work Phone" data-toggle="tooltip" data-placement="bottom" title="Work Phone">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 1<span class="req"/></label>
                        <div class="col-sm-8">
                            <textarea name="street_address1" id="street_address1" class="form-control" rows="2" placeholder="Address 1" data-toggle="tooltip" data-placement="top" title="Address 1"></textarea>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 2</label>
                        <div class="col-sm-8">
                            <textarea name="street_address2" id="street_address2" class="form-control" rows="2" placeholder="Address 2" data-toggle="tooltip" data-placement="top" title="Address 2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">City</label>
                        <div class="col-sm-8">
                            <input type="text" name="city" id="city" class="form-control input-sm"  placeholder="City" data-toggle="tooltip" data-placement="bottom" title="City">
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">State</label>
                        <div class="col-sm-8">
                            <select name="state" id="state" onchange="load_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($state_query->result() as $keyy): ?>
                                    <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin" id="cocounty_div">
                        <label class="col-sm-4 control-label">County</label>
                        <div class="col-sm-7">
                            <select name="county" id="county" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
//                                $county_query = $this->Common_model->listItem('main_county');
//                                foreach ($county_query->result() as $key):
//                                    ?>
<!--                                    <option value="<?php // echo $key->id ?>"><?php // echo $key->county_name ?></option>-->
                                    <?php
//                                endforeach;
                                ?>
                            </select>
                        </div>
                        <a class="btn ntn-u col-sm-1" <a class="btn ntn-u "  onClick="add_cocounty()" href="#" title="Add County"><span class="glyphicon glyphicon-plus-sign"></span></a>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Zip Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="zipcode" id="zipcode" class="form-control input-sm"  placeholder="Zip Code" data-toggle="tooltip" data-placement="bottom" title="Zip Code">
                        </div> 
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="modal-footer">
                        <!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                        <a class="btn btn-danger" href="<?php //echo base_url() . "Con_Onboarding"  ?>">Close</a>-->

                        <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                        <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>

                    </div>
                </div>
                
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
            <div class="container">
                <input type="hidden" value="<?php echo $row->onboarding_employee_id ?>" name="ob_con_emp_id" id="ob_con_emp_id"/>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email Address<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="email" name="email_address" id="email_address" value="<?php echo $row->email_address ?>" class="form-control input-sm"  placeholder="Email Address" data-toggle="tooltip" data-placement="bottom" title="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Home Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="home_phone" id="home_phone" value="<?php echo $row->home_phone ?>" class="form-control input-sm" placeholder="Home Phone" data-toggle="tooltip" data-placement="bottom" title="Home Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Mobile Phone<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="mobile_phone" id="mobile_phone" value="<?php echo $row->mobile_phone ?>" class="form-control input-sm" placeholder="Mobile Phone" data-toggle="tooltip" data-placement="bottom" title="Mobile Phone">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-4 control-label">Work Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="work_phone" id="work_phone" value="<?php //echo $row->work_phone ?>" class="form-control input-sm" placeholder="Work Phone" data-toggle="tooltip" data-placement="bottom" title="Work Phone">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 1<span class="req"/></label>
                        <div class="col-sm-8">
                            <textarea name="street_address1" id="street_address1" class="form-control" rows="2" placeholder="Address 1" data-toggle="tooltip" data-placement="top" title="Address 1"> <?php echo ucwords($row->street_address1) ?> </textarea>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 2</label>
                        <div class="col-sm-8">
                            <textarea name="street_address2" id="street_address2" class="form-control" rows="2" placeholder="Address 2" data-toggle="tooltip" data-placement="top" title="Address 2"> <?php echo ucwords($row->street_address2) ?> </textarea>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">City</label>
                        <div class="col-sm-8">
                            <input type="text" name="city" id="city" value="<?php echo ucwords($row->city) ?>" class="form-control input-sm"  placeholder="City" data-toggle="tooltip" data-placement="bottom" title="City">
                        </div> 
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">State</label>
                        <div class="col-sm-8">
                            <select name="state" id="state" onchange="load_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($state_query->result() as $keyy): ?>
                                    <option value="<?php echo $keyy->id ?>" <?php if ($row->state == $keyy->id) echo "selected"; ?> ><?php echo $keyy->state_abbr ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin" id="cocounty_div">
                        <label class="col-sm-4 control-label">County</label>
                        <div class="col-sm-7">
                            <select name="county" id="county" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $county_query = $this->Common_model->listItem('main_county');
                                foreach ($county_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>" <?php if ($row->county == $key->id) echo "selected"; ?> ><?php echo $key->county_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>                            
                        </div>
                        <a class="btn ntn-u col-sm-1"  onClick="add_cocounty()" href="#" title="Add County"><span class="glyphicon glyphicon-plus-sign"></span></a>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Zip Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="zipcode" id="zipcode" value="<?php echo $row->zipcode ?>" class="form-control input-sm"  placeholder="Zip Code" data-toggle="tooltip" data-placement="bottom" title="Zip Code">
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
            
        <?php endforeach; ?>
        </form>
          
        <?php
    }
    else {
        ?>

        <form id="onboarding_contactinformation_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/save_onboarding_contactinformation" enctype="multipart/form-data" role="form">
            <div class="container">
                <input type="hidden" value="" name="ob_con_emp_id" id="ob_con_emp_id"/>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email Address<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="email" name="email_address" id="email_address" value="<?php echo $email_id; ?>" class="form-control input-sm"  placeholder="Email Address" data-toggle="tooltip" data-placement="bottom" title="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Home Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="home_phone" id="home_phone" class="form-control input-sm" placeholder="Home Phone" data-toggle="tooltip" data-placement="bottom" title="Home Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Mobile Phone<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control input-sm" placeholder="Mobile Phone" data-toggle="tooltip" data-placement="bottom" title="Mobile Phone">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-4 control-label">Work Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="work_phone" id="work_phone" class="form-control input-sm" placeholder="Work Phone" data-toggle="tooltip" data-placement="bottom" title="Work Phone">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Address 1 <span class="req"/> </label>
                        <div class="col-sm-8">
                            <textarea name="street_address1" id="street_address1" class="form-control" rows="2" placeholder="Address 1" data-toggle="tooltip" data-placement="top" title="Address 1"></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-4 control-label">Address 2</label>
                        <div class="col-sm-8">
                            <textarea name="street_address2" id="street_address2" class="form-control" rows="2" placeholder="Address 2" data-toggle="tooltip" data-placement="top" title="Address 2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">City</label>
                        <div class="col-sm-8">
                            <input type="text" name="city" id="city" class="form-control input-sm"  placeholder="City" data-toggle="tooltip" data-placement="bottom" title="City">
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">State</label>
                        <div class="col-sm-8">
                            <select name="state" id="state" onchange="load_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($state_query->result() as $keyy): ?>
                                    <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin" id="cocounty_div">
                        <label class="col-sm-4 control-label">County</label>                        
                        <div class="col-sm-7">
                            <select name="county" id="county" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $county_query = $this->Common_model->listItem('main_county');
                                foreach ($county_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->county_name ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                        <a class="btn ntn-u col-sm-1" onClick="add_cocounty()" href="#" title="Add County"><span class="glyphicon glyphicon-plus-sign"></span></a>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Zip Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="zipcode" id="zipcode" class="form-control input-sm"  placeholder="Zip Code" data-toggle="tooltip" data-placement="bottom" title="Zip Code">
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


<!-- Modal -->
<div class="modal fade" id="cocounty_Modal_entry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add languages</h4>
            </div>
            <form id="add_cocounty_entry" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_languages"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label ">County Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="county_name" id="county_name" class="form-control input-sm" placeholder="County Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="2" id="description" name="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



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
        $("#home_phone").mask("(999) 999-9999");
        $("#mobile_phone").mask("(999) 999-9999");
        //$("#work_phone").mask("(999) 999-9999");
    });
    
    function add_cocounty()
    {
        save_method = 'add';
        $('#add_cocounty_entry')[0].reset(); // reset form on modals
        $('#cocounty_Modal_entry').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add County'); // Set Title to Bootstrap modal title
    }
    
    $(function(){
        $("#add_cocounty_entry" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_County_Settings/save_County_Settings') ?>";
            }            
                $.ajax({
                url: url,
                data: $("#add_cocounty_entry").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {

                    var url='';
                    view_message(data,url,'cocounty_Modal_entry','add_cocounty_entry');
                    
                    $("#cocounty_div").load(location.href + " #cocounty_div");
                    
                    setTimeout(function () {
                        
                        $("#county").select2({
                            placeholder: "County",
                            allowClear: true,
                        });
                    
                    }, 1000);
                
                    
              });
            event.preventDefault();
        });
    });   
    
    function load_county(id) {
//        alert(id);
        $.ajax({
            url: "<?php echo site_url('Con_onboarding_list/load_county_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#county').html('');
                $('#county').empty();

                $('#county').html(data);
            }
        });
    }
    
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