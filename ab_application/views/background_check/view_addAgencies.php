<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px; padding-top: 50px;">
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Agencies/save_agencies" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                        <input type="hidden" value="" name="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Agency Name<span class="req"/> </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="agency_name" id="agency_name" class="form-control input-sm" placeholder="Agency Name" />
                            </div>
                            <label class="col-sm-2 control-label">Website URL </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="website_url" id="website_url" class="form-control input-sm" placeholder="Website URL" />
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Primary Phone<span class="req"/> </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="primary_phone" id="primary_phone" class="form-control input-sm" placeholder="Primary Phone" />
                            </div>
                            <label class="col-sm-2 control-label">Secondary Phone </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="secondary_phone" id="secondary_phone" class="form-control input-sm" placeholder="Secondary Phone" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Screening Type</label>
                            <div class="col-sm-4">                            
                                <select name="screening_id" id="screening_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($screening_types_query->result() as $row) {
                                        print"<option value='" . $row->id . "'>" . $row->screening_type . "</option>";
                                    }
                                    ?>
                                </select>  
                            </div>
                            <label class="col-sm-2 control-label">Address<span class="req"/></label>
                            <div class="col-sm-4">                            
                                <textarea class="form-control input-sm" rows="2" id="address" name="address"></textarea>
                            </div>                        
                        </div>
                        <div class="container conbre">
                            <h3><ins><strong>POC DETAILS</strong></ins></h3>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">First Name </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="agency_fast_name" id="agency_fast_name" class="form-control input-sm" placeholder="Agency First Name" />
                            </div> 
                            <label class="col-sm-2 control-label">Last Name </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="agency_last_name" id="agency_last_name" class="form-control input-sm" placeholder="Agency Last Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="agency_phone" id="agency_phone" class="form-control input-sm" placeholder="Agency Phone " />
                            </div> 
                            <label class="col-sm-2 control-label">Email  </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="agency_email" id="agency_email" class="form-control input-sm" placeholder="Agency Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Location </label>
                            <div class="col-sm-4">                           
                                <input type="text" name="agency_location" id="agency_location" class="form-control input-sm" placeholder="Agency Location " />
                            </div> 
                            <label class="col-sm-2 control-label">State</label>
                            <div class="col-sm-4">                            
                                <select name="agency_state_id" onchange="load_lo_county(this.value);" id="agency_state_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($agency_state->result() as $row) {
                                        print"<option value='" . $row->id . "'>" . $row->state_name . "</option>";
                                    }
                                    ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">County</label>
                            <div class="col-sm-4">                            
                                <select name="agency_county_id" id="agency_county_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    
                                </select>  
                            </div>                                                    
                            <label class="col-sm-2 control-label">City  </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="agency_city" id="agency_city" class="form-control input-sm" placeholder="Agency City" />
                            </div> 
                        </div>
                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Agencies" ?>">Close</a>
                        </div>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Agencies/update_agencies" enctype="multipart/form-data" role="form" >
                   <div class="col-md-10 col-md-offset-1">
                        <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Agency Name</label>
                            <div class="col-sm-4">                                
                                <input type="text" name="agency_name" id="agency_name" value="<?php echo ucwords($row->agency_name) ?>" class="form-control input-sm" placeholder="Agency Name" />
                            </div>
                            <label class="col-sm-2 control-label">Website URL</label>
                            <div class="col-sm-4">                                
                                <input type="text" name="website_url" id="website_url" value="<?php echo $row->website_url ?>" class="form-control input-sm" placeholder="Website URL" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Primary Phone</label>
                            <div class="col-sm-4">                                
                                <input type="text" name="primary_phone" id="primary_phone" value="<?php echo $row->primary_phone ?>" class="form-control input-sm" placeholder="Primary Phone" />
                            </div>
                            <label class="col-sm-2 control-label">Secondary Phone</label>
                            <div class="col-sm-4">                                
                                <input type="text" name="secondary_phone" id="secondary_phone" value="<?php echo $row->secondary_phone ?>" class="form-control input-sm" placeholder="Secondary Phone" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Screening Type</label>
                            <div class="col-sm-4">                                
                                <select name="screening_id" id="screening_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <?php foreach ($screening_types_query->result() as $row1): ?>
                                        <option value="<?php echo $row1->id ?>"<?php if ($row->screening_id == $row1->id) echo "selected"; ?>><?php echo $row1->screening_type ?></option>
                                    <?php endforeach; ?>
                                </select>  
                            </div>
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-4">                               
                                <textarea class="form-control input-sm" rows="2" id="address" name="address"><?php echo ucwords($row->address) ?></textarea>
                            </div>                            
                        </div>                        

                        <div class="container conbre">
                            <h3><ins><strong>POC DETAILS</strong></ins></h3>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">First Name </label>
                            <div class="col-sm-4">                                
                                <input type="text" name="agency_fast_name" id="agency_fast_name" value="<?php echo ucwords($row->agency_fast_name) ?>" class="form-control input-sm" placeholder="Agency First Name" />
                            </div> 
                            <label class="col-sm-2 control-label">Last Name </label>
                            <div class="col-sm-4">                                
                                <input type="text" name="agency_last_name" id="agency_last_name" value="<?php echo ucwords($row->agency_last_name) ?>" class="form-control input-sm" placeholder="Agency Last Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone </label>
                            <div class="col-sm-4">                                
                                <input type="text" name="agency_phone" id="agency_phone" value="<?php echo $row->agency_phone ?>" class="form-control input-sm" placeholder="Agency Phone " />
                            </div> 
                            <label class="col-sm-2 control-label">Email  </label>
                            <div class="col-sm-4">                                
                                <input type="email" name="agency_email" id="agency_email" value="<?php echo $row->agency_email ?>" class="form-control input-sm" placeholder="Agency Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Location </label>
                            <div class="col-sm-4">                                
                                <input type="text" name="agency_location" id="agency_location" value="<?php echo ucwords($row->agency_location) ?>" class="form-control input-sm" placeholder="Agency Location " />
                            </div>
                            <label class="col-sm-2 control-label">State</label>
                            <div class="col-sm-4">                                
                                <select name="agency_state_id" id="agency_state_id" onchange="load_lo_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <?php foreach ($agency_state->result() as $row1): ?>
                                        <option value="<?php echo $row1->id ?>"<?php if ($row->agency_state_id == $row1->id) echo "selected"; ?>><?php echo $row1->state_name ?></option>
                                    <?php endforeach; ?>
                                </select>  
                            </div>                                                        
                        </div>
                        <div class="form-group">                               
                             <label class="col-sm-2 control-label">County</label>
                            <div class="col-sm-4">                                
                                <select name="agency_county_id" id="agency_county_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <?php foreach ($agency_county->result() as $row1): ?>
                                        <option value="<?php echo $row1->id ?>"<?php if ($row->agency_county_id == $row1->id) echo "selected"; ?>><?php echo $row1->county_name ?></option>
                                    <?php endforeach; ?>
                                </select>   
                            </div>                       
                            <label class="col-sm-2 control-label">City  </label>
                            <div class="col-sm-4">                                
                                <input type="text" name="agency_city" id="agency_city" value="<?php echo ucwords($row->agency_city) ?>" class="form-control input-sm" placeholder="Agency City" />
                            </div> 
                        </div>
                        <div class="modal-footer">                            
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Agencies" ?>">Close</a>
                        </div>
                    <?php endforeach; ?>
                   </div>
                </form>
                <?php
            }
            ?>
        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {
            var url = $(this).attr('action');
            loading_box(base_url);
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Agencies';
                view_message(data, url,'','sky-form11');

            });
            event.preventDefault();
        });
    });

    $("#screening_id").select2({
        placeholder: "Screening Type",
        allowClear: true,
    });
    $("#agency_county_id").select2({
        placeholder: "Agency County",
        allowClear: true,
    });
    $("#agency_state_id").select2({
        placeholder: "Agency State",
        allowClear: true,
    });

    $(function () {
        $("#primary_phone").mask("(999) 999-9999");
        $("#secondary_phone").mask("(999) 999-9999");
        $("#agency_phone").mask("(999) 999-9999");
    });
    function load_lo_county(id) {
//        alert(id);
        $.ajax({
            url: "<?php echo site_url('Con_Agencies/load_county_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#agency_county_id').html('');
                $('#agency_county_id').empty();

                $('#agency_county_id').html(data);
            }
        });
    }

</script>
<!--=== End Script ===-->

