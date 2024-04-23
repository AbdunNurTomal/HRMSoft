<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="padding:15px; box-sizing:border-box">

            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_ReviewRemarks/update_reviewRemarks/' . $this->uri->segment(3); ?>" enctype="multipart/form-data" role="form" >    
                <input type="hidden" name="com_id" value="<?php echo $com_id ?>" />
                <div class="col-sm-12">
                    <h4 style="margin-bottom:20px">Edit Review Remark</h4>
                </div>
                <br/><br/>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Competency Name</label>
                        <div class="col-sm-8">
                            <textarea class="form-control col-sm-12" name="com_name" required><?php echo $singleCompetency->com_name; ?></textarea>
                        </div>
                    </div>
                </div>             
                <div class="col-sm-12 instruction">
                    <label class="col-sm-12 control-label">
                        ** Instruction: Please use 
                        <i><input title="Click to Select" onClick="this.select();" value="{He/She}" class="first" readonly/></i>, 
                        <i><input title="Click to Select" onClick="this.select();" value="{His/Her}" class="second" readonly/></i>
                        or 
                        <i><input title="Click to Select" onClick="this.select();" value="{Him/Her}" class="last" readonly/></i> 
                        (Not Case Sensitive) in the remark text, instead of the candidate name.
                    </label>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rating Value:</label>
                        <label class="col-sm-1 lbl control-label">Rating 1:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_1" required><?php echo $singleCompetency->rating_remarks_1; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <label class="col-sm-1 lbl control-label">Rating 2:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_2" required><?php echo $singleCompetency->rating_remarks_2; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <label class="col-sm-1 lbl control-label">Rating 3:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_3" required><?php echo $singleCompetency->rating_remarks_3; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <label class="col-sm-1 lbl control-label">Rating 4:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_4" required><?php echo $singleCompetency->rating_remarks_4; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <label class="col-sm-1 lbl control-label">Rating 5:</label>
                        <div class="col-sm-7">
                            <textarea class="form-control col-sm-12" name="rating_remarks_5" required><?php echo $singleCompetency->rating_remarks_5; ?></textarea>
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
    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() . "Con_ReviewRemarks/edit_reviewRemarks/" . $this->uri->segment(3); ?>';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Script ===-->

