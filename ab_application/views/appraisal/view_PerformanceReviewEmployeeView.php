
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <!-- container well div -->   
        <div class="container tag-box tag-box-v3 padding-15">
            <div>
                <h2>Employee List</h2>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Location</th>                            
                            <th>Hiring Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($employee_list)) {
                            $i = 0;
                            foreach ($employee_list as $row) {
                                echo "<tr>";
                                echo "<th>" . ++$i . "</th>";
                                echo "<th>" . sprintf("%07d", $row->employee_id) . "</th>";
                                echo "<th>" . $row->first_name . " " . $row->middle_name . " " . $row->last_name . "</th>";
                                echo "<th>" . $this->Common_model->get_name($this, $row->position, 'main_positions', 'positionname') . "</th>";
                                echo "<th>" . $row->state_name . "</th>";
                                echo "<th>" . $this->Common_model->show_date_formate($row->hire_date) . "</th>";
                                echo "<th>";
                                echo '<a href="' . base_url() . 'Con_PerformanceReviewBuilder/employee_review/' . $row->employee_id . '" title="View Employee Details" target="_blank">View</a> | ';
                                /* echo '<a href="' . base_url() . 'Con_Employees/edit_entry/' . $row->employee_id . '" title="View Employee Details" target="_blank">View</a> | '; */
                                echo '<a href="' . base_url() . 'Con_PerformanceReviewBuilder/employeeReviewForm/' . $row->employee_id . '" title="View Employee Details" target="_self">Performance Review</a>';
                                echo "</th>";
                                echo "</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->
<style type="text/css">
    .startBtnWrp{text-align:center}
</style>
<script type="text/javascript">


</script>
<!--=== End Content ===-->
