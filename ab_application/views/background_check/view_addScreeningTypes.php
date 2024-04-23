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
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ScreeningTypes/save_screening_types" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                        <input type="hidden" value="" name="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Screening Type<span class="req"/> </label>
                            <div class="col-sm-4">                                
                                <input type="text" name="screening_type" id="screening_type" class="form-control input-sm" placeholder="Screening Type" />
                            </div> 
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-4">                                
                                <textarea class="form-control input-sm" rows="2" id="description" name="description"></textarea>
                            </div>                        
                        </div>                     
                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_ScreeningTypes" ?>">Close</a>
                        </div>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_ScreeningTypes/update_screening_types" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                        <?php foreach ($query->result() as $row): ?> 
                            <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                            <div class="row"> 
                                <label class="col-sm-2 control-label">Screening Type<span class="req"/></label>
                                <div class="col-sm-4">                                    
                                    <input type="text" name="screening_type" id="screening_type" value="<?php echo ucwords($row->screening_type) ?>" class="form-control input-sm" placeholder="Screening Type" />
                                </div>
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-4">                                    
                                    <textarea class="form-control input-sm" rows="2" id="description" name="description"><?php echo ucwords($row->description) ?></textarea>
                                </div>                            
                            </div>                        
                            <div class="modal-footer">                            
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_ScreeningTypes" ?>">Close</a>
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

                var url = '<?php echo base_url() ?>Con_ScreeningTypes';
                view_message(data, url,'','sky-form11');

            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Script ===-->

