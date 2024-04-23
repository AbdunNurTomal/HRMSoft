<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;">

            <div class="col-md-10 col-md-offset-1">

                <?php
                if ($type == 1) {//entry
                    ?>
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_DegreeSetup/save_degree" enctype="multipart/form-data" role="form" >
                        <input type="hidden" value="" name="id"/>
                        <div class="form-group" style="margin-top: 15px;">
                            <label class="col-sm-2 control-label">Degree <span class="req"/> </label>
                            <div class="col-sm-4">
                                <input type="text" name="degree" id="degree" class="form-control" placeholder="Degree" />
                            </div> 
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_DegreeSetup" ?>">Close</a>
                        </div>
                    </form>
                    <?php
                } else if ($type == 2) {//edit
                    ?>
                    <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_DegreeSetup/update_degree" enctype="multipart/form-data" role="form" >
                        <?php foreach ($query->result() as $row): ?> 
                            <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                            <div class="form-group" style="margin-top: 15px;">
                                <label class="col-sm-2 control-label">Degree <span class="req"/> </label>
                                <div class="col-sm-4">
                                    <input type="text" name="degree" id="degree" class="form-control" value="<?php echo $row->degree; ?>" placeholder="Degree" />
                                </div> 
                            </div>
                                                       
                            <div class="modal-footer">
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_DegreeSetup" ?>"> Close </a>
                            </div>
                        <?php endforeach; ?>
                    </form>
                    <?php
                }
                ?>

            </div>
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

                var url = '<?php echo base_url() ?>Con_DegreeSetup';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    
</script>

