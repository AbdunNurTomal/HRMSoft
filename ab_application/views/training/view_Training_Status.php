
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_Training_Requisition/add_Training_Requisition" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Requisition </a></br></br>-->
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                            <col width="1%">
                            <col width="20%">
                            <col width="25%">
                            <col width="25%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Training Name</th>
                            <th>Employees</th>
                            <th>Training Objective</th>
                            <th>Proposed Date</th>
<!--                            <th>Training Output</th>
                            <th>Training Outcome</th>-->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $training_status_array = $this->Common_model->get_array('training_status');
                        if ($query) {
                            $sl = 0;
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
                                        
                                $sl++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') . "</td>";
                                print"<td  id='catA" . $pdt . "'>" . $employees . "</td>"; //class='td-cw'
                                print"<td id='catA" . $pdt . "'>" . $row->training_objective. "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->proposed_date). "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $row->training_output. "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $row->training_outcome. "</td>";
                                print"<td id='catA" . $pdt . "'>" . $training_status_array[$row->training_status] . "</td>";
                                print"<td><div class='action-buttons '><a title='Edit' href='" . base_url() . "Con_Training_Status/edit_Training_Status/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;</div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

