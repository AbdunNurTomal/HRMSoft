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
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_EmpCandidateScreening/save_EmpCandidateScreening" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1"> 
                        <input type="hidden" value="" name="id"/>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <label class="col-sm-4 control-label">Select Employee / Candidate<span class="req"/> </label>
                                    <div class="col-sm-8 control-label">                            
                                        <select name="employee_candidate" id="employee_candidate" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($employees_query->result() as $row) {
                                                print"<option value='" . $row->employee_id . "'>" . $row->first_name . "</option>";
                                            }
                                            ?>
                                        </select>  
                                    </div> 
                                </div>
                                <div class="col-sm-12">
                                    <label class="col-sm-4 control-label">Choose Agency<span class="req"/> </label>
                                    <div class="col-sm-8 control-label">                            
                                        <select name="agency_id" id="agency_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($agencies_query->result() as $row) {
                                                print"<option value='" . $row->id . "'>" . $row->agency_name . "</option>";
                                            }
                                            ?>
                                        </select>  
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="col-sm-4 control-label">Comment</label>
                                    <div class="col-sm-8 control-label">                            
                                        <textarea name="scr_comment" id="scr_comment" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label">Screening Types</label>
                                <div class="col-sm-8 control-label" style="text-align: left">                            
                                    <?php
                                    foreach ($screening_types_query->result() as $row) {
                                        ?>
                                        <ul class="list-unstyled">
                                            <li class="margin-right-10">
                                                <input type="checkbox" value="<?php echo $row->id ?>" id="<?php echo "screeningtypes" . $row->id ?>" name="screeningtypes[]"/> <?php echo $row->screening_type ?>
                                            </li>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>  

                            </div>
                        </div>

                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "con_EmpCandidateScreening" ?>">Close</a>
                        </div>
                    </div>   
                </form>
                <?php
            } else if ($type == 2) {//edit
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_EmpCandidateScreening/update_EmpCandidateScreening" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                        <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="" name="id"/>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <label class="col-sm-4 control-label">Select Employee / Candidate<span class="req"/> </label>
                                    <div class="col-sm-8 control-label">                            
                                        <select name="employee_candidate" id="employee_candidate" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php foreach ($employees_query->result() as $key) { ?>
                                            <option value="<?php echo $key->employee_id ?>"<?php if ($row->employee_id == $key->employee_id) echo "selected"; ?>><?php echo $key->first_name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>  
                                    </div> 
                                </div>
                                <div class="col-sm-12">   

                                    <label class="col-sm-4 control-label">Choose Agency<span class="req"/> </label>
                                    <div class="col-sm-8 control-label">                            
                                        <select name="agency_id" id="agency_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php foreach ($agencies_query->result() as $key) { ?>
                                            <option value="<?php echo $key->id ?>"<?php if ($row->agency_id == $key->id) echo "selected"; ?>><?php echo $key->agency_name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>  
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="col-sm-4 control-label">Comment</label>
                                    <div class="col-sm-8 control-label">                            
                                        <textarea name="scr_comment" id="scr_comment" class="form-control"><?php echo $row->scr_comment ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label">Screening Types</label>
                                <div class="col-sm-8 control-label" style="text-align: left">                            
                                    <?php
                                    $screening_types_arr = explode(',', $row->screening_types);
                                    foreach ($screening_types_query->result() as $roww) {
                                        if (in_array($roww->id, $screening_types_arr)) {
                                            $check = "checked";
                                        } else {
                                            $check = "";
                                        }
                                        ?>
                                        <ul class="list-unstyled">
                                            <li class="margin-left-10">
                                                <input type="checkbox" value="<?php echo $roww->id ?>" id="<?php echo "screeningtypes" . $roww->id ?>" name="screeningtypes[]" <?php echo $check; ?> /> <?php echo $roww->screening_type ?>
                                            </li>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>  

                            </div>
                        </div>

                        <div class="modal-footer">                        
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "con_EmpCandidateScreening" ?>">Close</a>
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

                //alert(data);

                var url = '<?php echo base_url() ?>Con_EmpCandidateScreening';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    $("#employee_candidate").select2({
        placeholder: "Employee / Candidate",
        allowClear: true,
    });

    $("#screening_types").select2({
        placeholder: "Screening Types",
        allowClear: true,
    });

    $("#agency_id").select2({
        placeholder: "Agency",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->

