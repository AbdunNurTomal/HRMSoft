
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px; padding-top: 15px;"> <!-- container well div -->
            <!-- data table -->
                <div class="table-responsive col-md-12 col-centered">
                    <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Requisition Code</th>
                                <th>Due Date</th>
                                <th>Department</th> 
                                <th>Job Title</th> 
                                <th>Position</th> 
                                <th>No. of Positions</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $approver_status = $this->Common_model->get_array('approver_status');
                        if ($query) {
                            foreach ($query->result() as $row) {
                                // echo "<pre>". print_r($row, 1) ."</pre>";exit;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->id, 'main_opening_position', 'requisition_code') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->due_date) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name') . "</td>";
                                // print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->job_title_id, 'main_jobtitles', 'jobtitlename') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') . "</td>";
                                // print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position_id, 'main_positions', 'positionname') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_table_field_value($this, 'main_positions', "positionname", $row->position_id, 'job_family') . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->no_of_positions . "</td>";
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



<!--=== End Content ===-->


