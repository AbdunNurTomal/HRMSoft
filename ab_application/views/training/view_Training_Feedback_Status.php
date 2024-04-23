
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
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_Training_Feedback_Status/add_Training_Feedback" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Training Feedback </a></br></br>-->
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="10%">
                        <col width="30%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Training Name</th>
                            <th>Feedback Type</th>
                            <th>Employee</th>
                            <th>Date OF Training</th>
                            <th>Total Training Period</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        if ($query) {
                            $sl = 0;
                            foreach ($query->result() as $row) {
                                $sl++;
                                if ($row->feedback_type == 0) {
                                    $feedback_type = "Employee Feedback";
                                } else {
                                    $feedback_type = "HR Feedback";
                                }

                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $feedback_type . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_selected_value($this,'employee_id',$row->employee_id,'main_employees','first_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->training_date). "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->total_training_period. "</td>";
                                print"<td id='catB" . $pdt . "'><a title='Preview' href='" . base_url() . "Con_Training_Feedback_Status/view_Training_Feedback_Status/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a></td>";
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
            window.location = base_url + "Con_Training_Feedback_Status/delete_Training_Feedback/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->
