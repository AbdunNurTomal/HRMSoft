<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">

            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_ReviewRemarks/update_overallReviewRemarks/' . $this->uri->segment(3); ?>" enctype="multipart/form-data" role="form" >    
                <div class="col-sm-12">
                    <h4 style="margin-bottom:20px">Edit Overall Review Remark</h4>
                </div>
                <br/><br/>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rating Value:</label>
                        <label class="col-sm-1 lbl control-label">Rating 1:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_1" placeholder="Remark Text Here ..." required><?php echo $overallRemarks->rating_1; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <label class="col-sm-1 lbl control-label">Rating 2:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_2" placeholder="Remark Text Here ..." required><?php echo $overallRemarks->rating_2; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <label class="col-sm-1 lbl control-label">Rating 3:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_3" placeholder="Remark Text Here ..." required><?php echo $overallRemarks->rating_3; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <label class="col-sm-1 lbl control-label">Rating 4:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_4" placeholder="Remark Text Here ..." required><?php echo $overallRemarks->rating_4; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <label class="col-sm-1 lbl control-label">Rating 5:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_5" placeholder="Remark Text Here ..." required><?php echo $overallRemarks->rating_5; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <div class="col-sm-3">
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_ReviewRemarks" ?>">Close</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->
<style type="text/css">
    .instruction{margin-bottom:20px !important;}
    .instruction label{color:lightcoral !important; text-align:left !important}
    .instruction label i{font-weight:bold !important;}
    .instruction label i input{border:none !important; outline:none !important; width:min-content !important}
    .instruction label i input.first{width:56px !important}
    .instruction label i input.second{width:57px !important}
    .instruction label i input.last{width:61px !important}
    .lbl{padding-right:0}
</style>

<!--Add item script-->       
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.removeEval', function (e) {
            e.preventDefault();
            var len = $('.evalCatWrp').length;
            if (len > 1) {
                $(this).closest('.evalCatWrp').remove();
            }
        });
    });

    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() . "Con_ReviewRemarks/edit_overallReviewRemarks"; ?>';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    $("#parent_user").select2({
        placeholder: "Parent User",
        allowClear: true,
    });

    $("#user_group").select2({
        placeholder: "User Group",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->