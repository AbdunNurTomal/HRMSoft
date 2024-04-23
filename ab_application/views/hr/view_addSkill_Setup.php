<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="padding:15px;">
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Skill_Setup/save_Skill_Setup" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id" id="id"/>
                    <div class="form-group col-md-6 find_mar">
                        <label class="col-sm-4 control-label pull-left">Skill Name<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="skill_name" id="skill_name" class="form-control input-sm" placeholder="Skill Name" />
                        </div>
                    </div>
                    <div class="form-group col-md-6 find_mar">
                        <label class="col-sm-3 control-label pull-left">Description</label>
                        <div class="col-sm-9 no-padding-right">
                            <textarea class="form-control" rows="3" id="description" name="description" placeholder="Description"></textarea>
                        </div>
                    </div> 
                    <div class="form-group col-md-12 pull-right right-align">
                        <div class="col-md-6 pull-right">
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Skill_Setup" ?>"> Close </a>
                            <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        </div>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Skill_Setup/edit_Skill_Setup" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id" id="id"/>
                        <div class="form-group col-md-6 find_mar">
                            <label class="col-sm-4 control-label pull-left">Skill Name<span class="req"/></label>
                            <div class="col-sm-8">
                                <input type="text" name="skill_name" id="skill_name" value="<?php echo $row->skill_name ?>" class="form-control input-sm" placeholder="Skill Name" />
                            </div>
                        </div> 
                        <div class="form-group col-md-6 find_mar">
                            <label class="col-sm-3 control-label pull-left">Description</label>
                            <div class="col-sm-9 no-padding-right">
                                <textarea class="form-control" rows="3" id="description" name="description" placeholder="Description"><?php echo $row->description ?></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12 pull-right right-align">
                            <div class="col-md-6 pull-right">
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Skill_Setup" ?>"> Close </a>
                                <button type="submit" id="submit" class="btn btn-u"> Save </button>
                            </div>
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

                //$('#sky-form11')[0].reset();
                var url = '<?php echo base_url() ?>Con_Skill_Setup';
                view_message(data, url, '', 'sky-form11');
            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Script ===-->

