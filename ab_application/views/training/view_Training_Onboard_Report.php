
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
        <div class="table-responsive col-md-12 col-centered">

            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_Training_Onboard_Report/get_Training_Onboard_Report/' . $menu_id; ?>" enctype="multipart/form-data" role="form" >
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label"> From: </label>
                            <div class="col-sm-8">
                                <input type="text" name="action_from" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_from']; ?>" readonly="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">To: </label>
                            <div class="col-sm-8">
                                <input type="text" name="action_to" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_to']; ?>" readonly="" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Training Status: </label>
                            <div class="col-sm-8">
                                <select name="training_status" id="training_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $training_status = $this->Common_model->get_array('training_status');
                                    foreach ($training_status as $key => $val):
                                        $slct = ($search_criteria['training_status'] == $key) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $key ?>" <?php echo $slct; ?>><?php echo $val ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Training Name : </label>
                            <div class="col-sm-8">
                                <select name="training_name" id="training_name" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    foreach ($training_query->result() as $row) {
                                        $slct = ($search_criteria['training_name'] == $row->id) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $row->id ?>" <?php echo $slct; ?> ><?php echo $row->training_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="form-group">
                            <button type="submit" class="btn-u"><i class="fa fa-search"></i>Search</button> 
                            <button class="btn-u center-align" type='button' id='btn' onclick='printDiv();'> <i class="fa fa-print" aria-hidden="true"></i> PDF </button>
                            <a href="#" class="btn-u center-align" onClick ="$('#print_to_Div').tableExport({type: 'excel', escape: 'false'});"><i class="fa fa-file-excel-o" aria-hidden="true"></i> XLS </a>
                        </div>
                    </div>
                </div>

            </form>

            
                <!-- data table -->
                <div class="table-responsive col-md-12 col-centered">
                    <div id="print_to_Div">
                        <div>
                            <div class="col-md-3 col-xs-3">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div style="text-align: center; "> <h4> Training Onboard Report </h4> </div>
                            </div>
                            <div class="col-md-3 col-xs-3">

                            </div>
                        </div>
                        <?php if ($show_result) { ?>
                    <table id="dataTables-example-requisition" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                        <colgroup>
                            <col width="1%">
                            <col width="25%">
                            <col width="20%">
                            <col width="25%">
                            <col width="20%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th> SL </th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Position</th>
                                <th>Training Name</th>
                                <th>Training date</th>
                                <th>Training Objective</th>
                            </tr>
                        </thead>
                        <tbody id="req_tbody">
                            <?php
                             $this->company_id = $this->user_data['company_id'];
                            $this->db->select('*');
                            $this->db->from('main_training_status');
                            $this->db->join('main_training_status_details', 'main_training_status.id = main_training_status_details.master_id');
                            $this->db->where_in('main_training_status.company_id', $this->company_id);
                            if (!empty($search_ids)) {
                                $this->db->where_in('main_training_status.id', $search_ids);
                            }
                            $query = $this->db->get();

                            
                            $i = 0;
                            if ($query) {
                                foreach ($query->result() as $row) {
                                    
                                    $position_id = $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'position');
                                    $position = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td> 
                                        <td><?php echo sprintf("%07d", $row->employee_id) ?></td> 
                                        <td><?php echo $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'first_name') ?></td> 
                                        <td><?php echo $position ?></td> 
                                        <td><?php echo $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') ?></td>
                                        <td><?php echo $this->Common_model->show_date_formate($row->issued_date) ?></td>
                                        <td><?php echo $this->Common_model->get_selected_value($this,'training_id',$row->training_id, 'main_training_requisition','training_objective')  ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                        <?php } ?>
                    </div>
                </div>               
                </div>
            
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">


    $("#training_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });
    $("#training_name").select2({
        placeholder: "Select Training Name",
        allowClear: true,
    });
    
    function printDiv() {
        $.print("#print_to_Div");
    }

</script>
<!--=== End Content ===-->

