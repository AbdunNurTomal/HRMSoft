
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
        <div class="table-responsive col-md-12 col-centered"><!-- container well div -->

            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url() . 'Con_Training_Requistition_Report/get_Training_Requistition_Report/' . $menu_id; ?>" enctype="multipart/form-data" role="form" >
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
                            <label class="col-sm-4 control-label">Training Type: </label>
                            <div class="col-sm-8">
                                <select name="training_type" id="training_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $training_type_array= $this->Common_model->get_array('training_type');
                                    foreach ($training_type_array as $key=>$val):
                                        $slct = ($search_criteria['training_type'] == $key) ? 'selected' : '';
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
                            <label class="col-sm-4 control-label">Status: </label>
                            <div class="col-sm-8">
                                <select name="req_status" id="req_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                    <?php
                                    $approver_status = $this->Common_model->get_array('approver_status');
                                    foreach ($approver_status as $key => $val):
                                        $slct = ($search_criteria['req_status'] == $key) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $key ?>" <?php echo $slct; ?>><?php echo $val ?></option>
                                        <?php
                                    endforeach;
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
                                <div style="text-align: center; "> <h4> Training Requisition Report </h4> </div>
                            </div>
                            <div class="col-md-3 col-xs-3">

                            </div>
                        </div>
                    <?php if ($show_result) { ?>
                <table id="dataTables-example-requisition" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Training Name</th>
                            <th>Proposed Date</th>
                            <th>Training Objective</th> 
                            <th>Training Output </th> 
                            <th>Training Outcome </th> 
                            <th>Company Cost </th> 
                            <th>Employee Cost </th> 
                        </tr>
                    </thead>
                    <tbody id="req_tbody">
                        <?php 
                        $this->db->select('main_training_requisition.*,main_new_training.training_name,main_new_training.company_cost,main_new_training.employee_cost');
                        $this->db->join('main_new_training', 'main_training_requisition.training_id = main_new_training.id', 'LEFT');
                        
                        if (!empty($search_ids)) {
                            $this->db->where_in('main_training_requisition.id', $search_ids);
                        }
                        if (!empty($search_criteria['training_type'])) {
                            $this->db->where_in('main_new_training.training_type', $search_criteria['training_type']);
                        }
                        if (!empty($search_criteria['req_status'])) {
                            $this->db->where_in('main_training_requisition.req_status', $search_criteria['req_status']);
                        }
                        $this->db->where('main_training_requisition.isactive', 1);
                        // $this->db->where('main_new_training.isactive', 1);
                        //  $this->db->where('main_new_training.company_id');
                        // $query = $this->db->get('main_training_requisition');
                        if($this->company_id==0){
                           $this->db->where('main_training_requisition.isactive', 1);
                           $this->db->where('main_new_training.isactive', 1);
                           //$this->db->where('main_new_training.company_id');
                           $query = $this->db->get('main_training_requisition');  
                        } else{
                            $this->db->where('main_training_requisition.isactive', 1);
                            $this->db->where('main_new_training.isactive', 1);
                            $this->db->where('main_new_training.company_id',$this->company_id);
                            $query = $this->db->get('main_training_requisition');
                        }
                        //echo $this->db->last_query();
                        $i=0;
                        if ($query) {
                            foreach ($query->result() as $row) {
                                $i++;
                                ?>
                        <tr>
                            <td><?php echo $i ?></td> 
                            <td><?php echo $row->training_name ?></td> 
                            <td><?php echo $this->Common_model->show_date_formate($row->proposed_date) ?></td>
                            <td><?php echo $row->training_objective ?></td>
                            <td><?php echo $row->training_output ?></td>
                            <td><?php echo $row->training_outcome ?></td>
                            <td><?php echo $row->company_cost ?></td>
                            <td><?php echo $row->employee_cost ?></td>
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

//    var table;
//
//    $(document).ready(function () {
//        var selDpto = null;
//        $.ajax({
//            url: "<?php // echo site_url('Con_Requistion_Explorer/data_load_rwq/') ?>/" + selDpto,
//            async: false,
//            type: "POST",
//            success: function (data) {
//
//                $('#req_tbody').find('tr').remove();
//                $('#req_tbody').html(data);
//            }
//        })
//    });
//
//
//    $(document).ready(function () {
//        $('#req_status').change(function () {
//
//            var selDpto = $(this).val(); // <-- change this line
//            //alert (selDpto);
//
//            $.ajax({
//                url: "<?php // echo site_url('Con_Requistion_Explorer/data_load_rwq/') ?>/" + selDpto,
//                async: false,
//                type: "POST",
//                success: function (data) {
//                    //alert (data);return;
//                    $('#req_tbody').find('tr').remove();
//                    $('#req_tbody').html(data);
//                }
//            })
//        });
//    });

    $("#req_status").select2({
        placeholder: "Select Status for search",
        allowClear: true,
    });
    $("#training_type").select2({
        placeholder: "Select training type",
        allowClear: true,
    });

    function reload_table()
    {
        table.ajax.reload(null, false); //reload datatable ajax 
    }
    
    function printDiv() {
        $.print("#print_to_Div");
    }
    
</script>
<!--=== End Content ===-->

