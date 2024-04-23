
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_ScheduledInterviews/add_ScheduledInterviews" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Interviews Scheduled </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requisition Id</th>
                            <th>Position</th>
                            <th>Candidate Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $interview_status = $this->Common_model->get_array('interview_status');
                        if ($query) {
                            $sl=0;
                            foreach ($query->result() as $row) {
                                $position_id=$this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','position_id');
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$position_id,'main_jobtitles','job_title') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','candidate_first_name') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','candidate_email') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_name,'main_cv_management','contact_number') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_status[$row->interview_status]."</td>";
                                print"<td><div class='action-buttons '><a title='Interview' href='" . base_url() . "Con_ScheduledInterviews/set_ScheduledInterviews/" . $row->id . "/" . "' ><i class='glyphicon glyphicon-check'>&nbsp;</i></a><a title='Edit' href='" . base_url() . "Con_ScheduledInterviews/edit_ScheduledInterviews/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;&nbsp;<a title='Preview' href='" . base_url() . "Con_ScheduledInterviews/view_ScheduledInterviews/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_ScheduledInterviews/delete_ScheduledInterviews/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->

