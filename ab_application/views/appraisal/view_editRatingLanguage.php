<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_RatingLanguage/update_ratingLanguage/' . $singleRating->rlang_id; ?>" enctype="multipart/form-data" role="form" >    
                <div class="col-sm-12">
                    <h4 style="margin-bottom:40px">Add Rating Language</h4>
                </div>
                <br/><br/>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rating 5</label>
                        <div class="col-sm-4">
                            <input type="text" name="Rating_5" class="form-control col-sm-12" value="<?php echo $singleRating->rating_5; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rating 4</label>
                        <div class="col-sm-4">
                            <input type="text" name="Rating_4" class="form-control col-sm-12" value="<?php echo $singleRating->rating_4; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rating 3</label>
                        <div class="col-sm-4">
                            <input type="text" name="Rating_3" class="form-control col-sm-12" value="<?php echo $singleRating->rating_3; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rating 2</label>
                        <div class="col-sm-4">
                            <input type="text" name="Rating_2" class="form-control col-sm-12" value="<?php echo $singleRating->rating_2; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rating 1</label>
                        <div class="col-sm-4">
                            <input type="text" name="Rating_1" class="form-control col-sm-12" value="<?php echo $singleRating->rating_1; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                            <button type="submit" id="submit" class="btn btn-u">Update</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_RatingLanguage" ?>">Close</a>
                        </div>
                    </div>
                </div>
            </form>

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

                var url = '<?php echo base_url() ?>Con_RatingLanguage';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });
</script>
<!--=== End Script ===-->
