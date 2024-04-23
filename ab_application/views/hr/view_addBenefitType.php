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
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_BenefitType/save_benefit_type" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Benefit Type Name </label>
                            <input type="text" name="benefit_type" id="benefit_type" class="form-control" placeholder="Benefit Type" />
                        </div>                        
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-12 control-label pull-left">Description</label>
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                        </div>                        
                    </div>                     
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_BenefitType" ?>">Close</a>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                //print_r($query);
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_BenefitType/update_benefit_type" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="row">                             
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Benefit Type Name</label>
                                <input type="text" name="benefit_type" id="benefit_type" value="<?php echo ucwords($row->benefit_type) ?>" class="form-control" placeholder="Benefit Type" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-12 control-label pull-left">Description</label>
                                <textarea class="form-control" rows="2" id="description" name="description"><?php echo ucwords($row->description) ?></textarea>
                            </div>                            
                        </div>                        
                        <div class="modal-footer">                            
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_BenefitType" ?>">Close</a>
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
                var url = '<?php echo base_url() ?>Con_Benefittype';
                view_message(data, url);
            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Script ===-->

