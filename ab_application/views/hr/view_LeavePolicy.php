
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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_LeavePolicy/add_leave_policy" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                   <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Leave Type</th>
                            <th>Employee Type</th>
                            <th>Applicable</th>
                            <th>Year</th>
                            <th>Max Limit (hour) </th>
                            <th>Is Day-off</th>                            
                            <th>Is Fractional</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $employee_type_array=$this->Common_model->get_array('employee_type');
                        $applicable_array=$this->Common_model->get_array('applicable');
                        $yes_no_array=$this->Common_model->get_array('yes_no');
                        $status_array = $this->Common_model->get_array('status');
                        if ($query) {
                            foreach ($query->result() as $row) {
                                $pdt = $row->id;
                                
                                if($row->off_day_leave_count==0)$off_day_leave_count=""; else $off_day_leave_count=$yes_no_array[$row->off_day_leave_count];
                                if($row->fractional_leave==0)$fractional_leave=""; else $fractional_leave=$yes_no_array[$row->fractional_leave];
                                
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->leave_type,'main_leave_types','leave_code')."</td>";
                                print"<td id='catA" . $pdt . "'>" . $employee_type_array[$row->employee_type]  ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $applicable_array[$row->applicable] . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->leave_year . "</td>"; 
                                print"<td id='catA" . $pdt . "'>" . $row->max_limit . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $off_day_leave_count . "</td>";                                
                                print"<td id='catD" . $pdt . "'>" . $fractional_leave . "</td>";                                
                                print"<td id='catA" . $pdt . "'>" . $status_array[$row->isactive] . "</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_LeavePolicy/edit_leave_policy/" . $row->id . "/". "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;</div> </td>";
                                print"</tr>";
                            }
                        }
                        
                        //<a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a>
                        
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
    
    var url="<?php echo base_url();?>";
    function delete_data(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = url+"Con_LeavePolicy/delete_leave_policy/"+id;
        else
          return false;
        } 


</script>
<!--=== End Content ===-->

