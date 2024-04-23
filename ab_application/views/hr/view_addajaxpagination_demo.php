
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
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_EmploymentStatus/save_status" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">

                            <label class="col-sm-12 col-xs-4 control-label pull-left">Work Code </label>
                            <select name="work_code_name" id="work_code_name" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $this->db->distinct();
                                $this->db->select('*');
                                $query = $this->db->get('tbl_employmentstatus');
                                foreach ($query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->employemnt_status . "</option>";
                                }
                                ?>
                            </select>  
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Work Short Code</label>
                            <input type="text" name="work_short_code" id="work_short_code" class="form-control" placeholder="Work Short Code" />
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-12 control-label pull-left">Description</label>
                            <textarea class="form-control" rows="3" id="description" name="description"></textarea>
                        </div>
                    </div> 
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "con_EmploymentStatus" ?>">Close</a>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                //print_r($query);
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_EmploymentStatus/edit_status" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Work Code </label>
                                <select name="work_code_name" id="work_code_name" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <!-- <option selected="selected" value="<?php //$row->workcodename   ?>"><?php //echo $workcodename   ?></option> -->
                                    <?php foreach ($listquery->result() as $row1): ?>
                                        <option value="<?php echo $row1->id ?>"<?php if ($workcodename == $row1->id) echo "selected"; ?>><?php echo $row1->employemnt_status ?></option>
                                    <?php endforeach; ?>
                                </select>  
                            </div> 
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Work Short Code</label>
                                <input type="text" name="work_short_code" id="work_short_code" value="<?php echo ucwords($row->workcode) ?>" class="form-control" placeholder="Work Short Code" />
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-12 control-label pull-left">Description</label>
                                <textarea class="form-control" rows="3" id="description" name="description"><?php echo ucwords($row->description) ?></textarea> 
                            </div>
                        </div> 
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "con_EmploymentStatus" ?>">Close</a>
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

                var url = '<?php echo base_url() ?>con_EmploymentStatus';
                view_message(data, url);

            });
            event.preventDefault();
        });
    });

    //var op = -1;
    //$("#modify_div").toggle("slow");

    $("#work_code_name,#to").select2({
        placeholder: "Work Code",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->

