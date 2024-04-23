<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <form id="sing_training_approval" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Requisition_Approval/update_sing_Training_Requisition" enctype="multipart/form-data" role="form" >

                    <div id="employee_review_div">   
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-u">
                                    <div class="panel-heading">
                                        Training Requisition Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">

                                            <table id="PersonalInformation" class="table table-striped table-bordered table-hover responsive-table table-wrap">
                                                <tbody>
                                                    <?php
                                                    $requisition_by_array = $this->Common_model->get_array('requisition_by');
                                                    foreach ($query->result() as $row) {
                                                        
                                                        $employee = explode(",", $row->employee);
                                                        $employees = '';
                                                        foreach ($employee as $emp) {
                                                            if ($employees == '') {
                                                                $employees = $this->Common_model->employee_name($emp);
                                                            } else {
                                                                $employees = $employees . "," . $this->Common_model->employee_name($emp);
                                                            }
                                                        }
                                
                                                        ?>
                                                        <tr>
                                                            <input type="hidden" id="requisition_id" name="requisition_id" value="<?php echo $row->id ?>">
                                                            <th>Training Name : </th>
                                                            <td><?php echo $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name'); ?> </td>
                                                             <th>Requisition BY : </th>
                                                            <td><?php echo $this->Common_model->show_date_formate($row->proposed_date) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Employees : </th>
                                                            <td><?php echo $employees ?></td>
                                                            <th>Training Objective : </th>
                                                            <td><?php echo $row->training_objective ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Training Output : </th>
                                                            <td><?php echo $row->training_output ?></td>
                                                            <th>Training Outcome: </th>
                                                            <td><?php echo $row->training_outcome ?></td>
                                                        </tr>
                                                        
                                                        <?php
                                                    }
                                                    ?>     
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div>
                    
                    <?php
                    if ($query) {
                        foreach ($query->result() as $row) {
                            ?>
                            <div class="col-md-12" style="margin-top: 10px">
                                <div class="form-group ">
                                    <label class="col-sm-2 control-label">Status<span class="req"/></label>
                                    <div class="col-sm-4">                            
                                        <select name="req_status" id="req_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            $approver_status = $this->Common_model->get_array('approver_status');
                                            foreach ($approver_status as $key => $val):
                                                ?>
                                                <option value="<?php echo $key ?>" <?php if($row->req_status==$key) echo "selected"; ?>><?php echo $val ?></option>
                                                <?php
                                            endforeach;
                                            ?>                        
                                        </select> 
                                    </div>
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-4 center-align"> 
                                        <?php if ($row->req_status!=1) { ?>
                                        <button type="submit" id="submit" class="btn btn-u"> Process </button>
                                        <?php } ?>
                                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Training_Requisition_Approval" ?>">Close</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </form>

            </div>

        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sing_training_approval").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sing_training_approval").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Training_Requisition_Approval';
                view_message(data, url, '', 'sing_training_approval');

            });
            event.preventDefault();
        });
    });

    $("#req_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });

</script>
<!--=== End Script ===-->

