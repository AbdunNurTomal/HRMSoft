
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3 content-div"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered no-border">
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_Training_Feedback/add_Training_Feedback" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Training Feedback </a></br></br>-->
                <table id="dataTables-example-evaluatetraining" class="table table-striped table-bordered table-hover table-wrap responsive-table" style="width: 100%;">
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="25%">
                        <col width="20%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Training Name</th>
                            <th>Duration (Hours)</th>
                            <th>Proposed Date</th>
                            <th>Employee Name</th>
                            <th>Employee Position </th>
                            <!-- <th>Date OF Training</th>
                            <th>Total Training Period</th>-->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        if ($query) {
                            $sl = 0 ;
                            foreach ($query->result() as $row) {
                                $sl++;
                                //$employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name')."".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','middle_name')." ".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');
                                $employee_name=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name').",".$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','last_name');
                                $employee_position=$this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','position');
                                $emp_position=$this->Common_model->get_name($this, $employee_position, 'main_jobtitles', 'job_title');
                                $pdt = $row->id;
                                print"<tr>";
                                 print"<td id='catA" . $pdt . "'>" . $sl . "</td>"; 
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'duration') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($this->Common_model->get_name($this, $row->training_id, 'main_training_requisition', 'proposed_date')) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $employee_name . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $emp_position . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->training_date). "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $row->total_training_period. "</td>";
                                print"<td><div class='action-buttons '><a title='Edit' href='" . base_url() . "Con_Training_Feedback/add_Training_Feedback/" . $row->did . "/" .$row->employee_id . "/" .$row->training_id . "/" . "' > Feedback </a>&nbsp;</div> </td>";
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


<script type="text/javascript">

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_Training_Feedback/delete_Training_Feedback/" + id;
        else
            return false;
    }
     $(document).ready(function () {
        $('#dataTables-example-evaluatetraining').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "bLengthChange": false,
            "bInfo" : false,
            "paginationType": "input"
        });
    });
</script>
<!--=== End Content ===-->
