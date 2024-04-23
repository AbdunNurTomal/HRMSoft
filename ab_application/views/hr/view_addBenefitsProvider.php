<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_BenefitsProvider/save_Benefits_provider" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>

                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Service Provider Name </label>
                            <input type="text" name="service_provider_name" id="service_provider_name" class="form-control" placeholder="Service Provider Name" />
                        </div>                        
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-12 control-label pull-left">Address1</label>
                            <textarea class="form-control" rows="2" id="address1" name="address1"></textarea>
                        </div>                        
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-12 control-label pull-left">Address2</label>
                            <textarea class="form-control" rows="2" id="address2" name="address2"></textarea>
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">City </label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="City " />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">States</label>
                            <select name="states" id="states" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($states->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->state_name . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Zipcode </label>
                            <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Zipcode " />
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Contact Name </label>
                            <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Contact Name" />
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Phone No. </label>
                            <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone Number" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Ext. </label>
                            <input type="text" name="ext" id="ext" class="form-control" placeholder="Ext." />
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Fax </label>
                            <input type="text" name="fax" id="fax" class="form-control" placeholder="Fax" />
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Email </label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                        </div>
                    </div>                    
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_BenefitsProvider" ?>">Close</a>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                //print_r($query);
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_BenefitsProvider/update_Benefits_provider" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Service Provider Name </label>
                                <input type="text" name="service_provider_name" id="service_provider_name" value="<?php echo ucwords($row->service_provider_name) ?>" class="form-control" placeholder="Group Name" />
                            </div>                        
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-12 control-label pull-left">Address1</label>
                                <textarea class="form-control" rows="2" id="address1" name="address1"><?php echo ucwords($row->address1) ?></textarea>
                            </div>                        
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-12 control-label pull-left">Address2</label>
                                <textarea class="form-control" rows="2" id="address2" name="address2"><?php echo ucwords($row->address2) ?></textarea>
                            </div> 
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">City </label>
                                <input type="text" name="city" id="city" value="<?php echo ucwords($row->city) ?>" class="form-control" placeholder="Group Name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">States</label>
                                <select name="states" id="states" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php foreach ($states->result() as $row1): ?>
                                        <option value="<?php echo $row1->id ?>"<?php if ($state_id == $row1->id) echo "selected"; ?>><?php echo $row1->state_name ?></option>
                                    <?php endforeach; ?>

                                    ?>
                                </select>  
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Zipcode </label>
                                <input type="text" name="zipcode" id="zipcode" value="<?php echo $row->zipcode ?>" class="form-control" placeholder="Group Name" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Contact Name </label>
                                <input type="text" name="contact_name" id="contact_name" value="<?php echo ucwords($row->contact_name) ?>" class="form-control" placeholder="Group Name" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Phone No. </label>
                                <input type="text" name="phone_no" id="phone_no" value="<?php echo $row->phone_no ?>" class="form-control" placeholder="Group Name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Ext. </label>
                                <input type="text" name="ext" id="ext" value="<?php echo $row->ext ?>" class="form-control" placeholder="Group Name" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Fax </label>
                                <input type="text" name="fax" id="fax" value="<?php echo $row->fax ?>" class="form-control" placeholder="Group Name" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Email </label>
                                <input type="text" name="email" id="email" value="<?php echo $row->email ?>" class="form-control" placeholder="Group Name" />
                            </div>
                        </div>                                               
                        <div class="modal-footer">                            
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_BenefitsProvider" ?>">Close</a>
                        </div>
                    <?php endforeach; ?>
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
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $('#sky-form11')[0].reset();
                var url = '<?php echo base_url() ?>Con_BenefitsProvider';
                view_message(data, url);
            });
            event.preventDefault();
        });
    });

    $("#states").select2({
        placeholder: "States",
        allowClear: true,
    });

    $(function () {
        $("#zipcode").mask("99999 9999");
        $("#phone_no").mask("(999) 999-9999");
        $("#ext").mask("999999");
        $("#fax").mask("999999");

    });

</script>
<!--=== End Script ===-->

