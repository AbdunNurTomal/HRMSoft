
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">
            
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_ReviewCategory/save_reviewCategory/' . $this->uri->segment(3); ?>" enctype="multipart/form-data" role="form" >    
                <div class="col-sm-12">
                    <h4 style="margin-bottom:40px">Employee Review Category</h4>
                </div>
                <br/><br/>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Review Category Name</label>
                        <div class="col-sm-3">
                            <input type="text" name="review_catName" class="form-control col-sm-12" value="" required />
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 evalCatWrp">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Review Competencies</label>
                        <div class="col-sm-5">
                            <textarea class="form-control col-sm-12" name="competencies[]" required></textarea>
                        </div>
                        <div class="col-sm-1 no-padding">
                            <button class="btn btn-md btn-u addEval" title="Add"><i class="fa fa-plus-circle"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;</label>
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
    $(document).ready(function () {
        var element = '<div class="col-sm-12 evalCatWrp">' +
                '<div class="form-group">' +
                '<label class="col-sm-3 control-label">&nbsp;</label>' +
                '<div class="col-sm-5">' +
                '<textarea class="form-control col-sm-12" name="competencies[]" required></textarea>' +
                '</div>' +
                '<div class="col-sm-1 no-padding">' +
                '<button class="btn btn-md btn-danger removeEval" title="Remove"><i class="fa fa-minus-circle"></i></button>' +
                '</div>' +
                '</div>';
        '</div>';

        $(document).on('click', '.addEval', function (e) {
            e.preventDefault();
            $('.evalCatWrp:last').after(element);
        });

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

                var url = '<?php echo base_url() . "Con_ReviewCategory"; ?>';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Script ===-->

