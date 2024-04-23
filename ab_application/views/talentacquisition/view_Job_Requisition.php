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
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_Job_Requisition/add_job_Requisition" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add New Requisition </a></br></br>-->
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                     <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
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
                            <th>Requisition Id</th>
                            <th>Location</th>
                            <th>Department</th>
                            <th>Requisitions Date</th>
                            <th>Due Date</th>
                            <th>Position</th> 
                            <th>Required Positions</th> 
                            <th>Status</th> 
                            <th>Is Close </th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $approver_status_array= $this->Common_model->get_array('approver_status');
                        if ($query) {
                            $sl = 0;
                            foreach ($query->result() as $row) {
                                $sl++;
                                $pdt = $row->id;
                                
                                if($row->req_status!=1)
                                {
                                    $up_status="<a title='Approve' href='javascript:void(0)' onclick='approve_data(" . $row->id . ")'><i class='fa fa-check'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a title='Edit' href='" . base_url() . "Con_Job_Requisition/edit_job_Requisition/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;&nbsp;<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a>";
                                }
                                else {
                                    $up_status="";
                                }
                                $is_close=($row->is_close == '0') ?  'NO' :  'YES';
                                
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->requisition_code . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->location_id, 'main_location', 'location_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->requisitions_date) . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->due_date) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->no_of_positions . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $approver_status_array[$row->req_status] . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $is_close . "</td>";
                                print"<td><div class='action-buttons '>". $up_status ." &nbsp;&nbsp; <a title='Preview' href='" . base_url() . "Con_Job_Requisition/view_requisition/" . $row->id . "/' target='_blank' ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;</div> </td>";
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

//    function delete_data(id) {
//        var r = confirm("Do you want to delete this?")
//        if (r == true)
//            window.location = base_url + "Con_Job_Requisition/delete_job_Requisition/" + id;
//        else
//            return false;
//    }
    
    function delete_data(id) { 
    
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
        .then((willDelete) => {
        if (willDelete) {
            window.location = base_url + "Con_Job_Requisition/delete_job_Requisition/" + id;
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    }

    function approve_data(id) { 
    
        swal({
            title: "Are you sure?",
            text: "Once Approved, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            window.location = base_url + "Con_Job_Requisition/approve_job_Requisition/" + id;
            swal("Poof! Your imaginary file has been Approved!", {
            icon: "success",
        });
        } else {
                swal("Your imaginary file is safe!");
            }
        });
    }

</script>
<!--=== End Content ===-->

