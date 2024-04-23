        <div class="col-md-10 main-content-div">
            <div class="main-content">

                <div class="container conbre">
                    <ol class="breadcrumb" >
                        <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                        <li class="active"><?php echo $page_header; ?></li>
                    </ol>
                </div>

                <div class="container tag-box tag-box-v3" style="padding: 15px;">
                    <?php if ($type == 1) : //entry ?>
                        <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_UserGroup/save_userGroup" role="form" >
                            <div class="col-md-10 col-md-offset-1">
                                <input type="hidden" value="" name="id"/>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Group Name<span class="req"></span></label>
                                    <div class="col-sm-4">
                                        <?php if ($this->KurunthamModel->isSuperAdmin()) : ?>
                                            <input type="text" name="group_name" id="group_name" class="form-control input-sm" placeholder="Group Name" autocomplete="off" /> 
                                        <?php elseif ($this->KurunthamModel->isCompanyAdmin()) : ?>
                                            <select name="group_parent_id" id="group_parent_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                <option></option>
                                                <?php foreach ($query->result() as $row): ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo ($row->group_name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-4">
                                        <textarea class="form-control input-sm" rows="2" id="description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                                    <a class="btn btn-danger" href="<?php echo base_url() . "con_UserGroup" ?>">Close</a>
                                </div>
                            </div>
                        </form>

                    <?php elseif ($type == 2) : //edit ?>
                        <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_UserGroup/edit_UserGroup" enctype="multipart/form-data" role="form" >
                            <div class="col-md-10 col-md-offset-1">
                                <?php foreach ($query->result() as $row): ?> 
                                    <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Group Name<span class="req"></span></label>
                                        <div class="col-sm-4">
                                            <?php if ($this->KurunthamModel->isSuperAdmin()) : ?>
                                                <input type="text" name="group_name" id="group_name" class="form-control input-sm" value="<?php echo ucwords($row->group_name) ;?>" placeholder="Group Name" autocomplete="off" /> 
                                            <?php elseif ($this->KurunthamModel->isCompanyAdmin()) : ?>
                                                <select name="group_parent_id" id="group_parent_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                                    <option></option>
                                                    <?php foreach ($user_group_query->result() as $user_group_row): ?>
                                                        <?php if ($user_group_row->group_name == $row->group_name): ?>
                                                            <option value="<?php echo $user_group_row->id; ?>" selected><?php echo ($user_group_row->group_name); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo $user_group_row->id; ?>"><?php echo ($user_group_row->group_name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php endif; ?>
                                        </div>
                                        <label class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-4">
                                            <textarea class="form-control input-sm" rows="2" id="description" name="description"><?php echo ucwords($row->description); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                                        <a class="btn btn-danger" href="<?php echo base_url() . "con_UserGroup" ?>">Close</a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    </div><!--/row-->
</div><!--/container-->

<!-- scripts starts -->
<script>
    $(function(){
        $( "#sky-form11" ).submit(function( event ) {
           var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function(data) {
                //$('#sky-form11')[0].reset();

                var url='<?php echo base_url() ?>con_UserGroup';
                view_message(data,url,'','sky-form11');
            });
            event.preventDefault();
        });
    }); 

    $("#group_parent_id").select2({
        placeholder: "Select User Group",
        allowClear: true,
    });

</script>
<!-- scripts ends -->
