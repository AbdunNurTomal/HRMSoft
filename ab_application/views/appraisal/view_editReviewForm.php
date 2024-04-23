<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">

            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_ReviewForm/update_reviewForm/' . $singleForm->form_id; ?>" enctype="multipart/form-data" role="form" >    
                <div class="col-sm-12">
                    <h4 style="margin-bottom:40px">Employee Review Form</h4>
                </div>
                <br/><br/>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Form Name</label>
                        <div class="col-sm-3">
                            <input type="text" name="review_form" class="form-control col-sm-12" value="<?php echo $singleForm->form_name; ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 evalCatWrp">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Evaluation Category</label>
                        <div class="col-sm-5">
                            <?php
                            if ($evalCategory) {
                                if ($evalCategory->num_rows() > 0) {
                                    foreach ($evalCategory->result() as $row) {
                                        $temp_arr = explode(',', $singleForm->cat_id);
                                        $checked = (in_array($row->cat_id, $temp_arr)) ? 'checked' : '';
                                        echo '<input type="checkbox" name="eval_cat[]" value="' . $row->cat_id . '" class="" ' . $checked . ' /> &nbsp;' . $row->cat_name . '<br/>';
                                    }
                                } else {
                                    echo '<b class="red">No Evaluation Category Created Yet!</b>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-u">Save</button>
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

                var url = '<?php echo base_url() . "Con_ReviewForm/edit_reviewForm/" . $this->uri->segment(3); ?>';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Script ===-->
