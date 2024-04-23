<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        
        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ActionPlan/save_actionPlan" enctype="multipart/form-data" role="form" >    
                    <div class="col-sm-12">
                        <h4 style="margin-bottom:40px">Add Review Action Plan</h4>
                    </div>
                    <br/><br/>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Action Plan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control col-sm-12" name="action_plan_name" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">&nbsp;</label>
                            <div class="col-sm-3">
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_ActionPlan" ?>">Close</a>
                            </div>
                        </div>
                    </div>
                </form>

                <?php
            } else if ($type == 2) {//edit
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ActionPlan/update_actionPlan" enctype="multipart/form-data" role="form" > 
                    <?php foreach ($action_plan_query->result() as $row): ?>
                        <input type="hidden" value="<?php echo $row->plan_id ?>" name="plan_id" id="plan_id"/>
                        <div class="col-sm-12">
                            <h4 style="margin-bottom:40px">Add Review Action Plan</h4>
                        </div>
                        <br/><br/>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Action Plan</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control col-sm-12" name="action_plan_name" required> <?php echo $row->plan_name ?> </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">&nbsp;</label>
                                <div class="col-sm-3">
                                    <button type="submit" id="submit" class="btn btn-u">Save</button>
                                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_ActionPlan" ?>">Close</a>
                                </div>
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
<script type="text/javascript">

    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_ActionPlan';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Script ===-->

