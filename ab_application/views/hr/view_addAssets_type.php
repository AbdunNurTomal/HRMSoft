<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px; padding-top: 50px;">
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Asset_Type/save_AssetsType" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                    <input type="hidden" value="" name="id" id="id"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Type </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="asset_type" id="asset_type" class="form-control" placeholder="Asset Type" />
                        </div>
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                        </div>                        
                    </div>                     
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Asset_Type" ?>">Close</a>
                    </div>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                //print_r($query);
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Asset_Type/update_Assets_type" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="form-group"> 
                            <label class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-4">                                
                                <input type="text" name="asset_type" id="asset_type" value="<?php echo ucwords($row->asset_type) ?>" class="form-control" placeholder="Asset Type Name" />
                            </div>
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-4">                                
                                <textarea class="form-control" rows="2" id="description" name="description"><?php echo ucwords($row->description) ?></textarea>
                            </div>                            
                        </div>                        
                        <div class="modal-footer">                            
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_Asset_Type" ?>">Close</a>
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
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $('#sky-form11')[0].reset();
                var url = '<?php echo base_url() ?>Con_Asset_Type';
                view_message(data, url);
            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Script ===-->

