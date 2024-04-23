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
                
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Create_Schedule/search_Candidate_Schedule/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_Create_Schedule/add_Create_Schedule" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Scheduled </a></br></br>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">  &nbsp;  </label>
                                <div class="col-sm-8">
                                    <select name="requisition_idd" id="requisition_idd" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($opening_position_query->result() as $key) {
                                            $position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                            $position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                            $slct = ($search_criteria['requisition_idd'] != "" && $search_criteria['requisition_idd'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->requisition_code . "  ( " . $position_name . " ) " . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                   <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="20%">
                        <col width="10%">
                        <col width="20%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requisition Id</th>
                            <th>Schedule Group</th>
                            <th>Interview Type</th>
                            <th>Interview Date</th>
                            <th>Interview Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $interview_status = $this->Common_model->get_array('interview_status');
                        $interview_type = $this->Common_model->get_array('interview_type');
                        if ($search_data) {
                            $sl=0;
                            foreach ($search_data as $row) {
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->schedule_group ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_type[$row->interview_type] ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->interview_date) ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->interview_time ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_status[$row->status]."</td>";
                                print"<td><div class='action-buttons '>&nbsp;<a title='Edit' href='" . base_url() . "Con_Create_Schedule/edit_Create_Schedule/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;&nbsp;<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
    
    $("#requisition_idd").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
    

//    function delete_data(id) {
//        var r = confirm("Do you want to delete this?")
//        if (r == true)
//            window.location = base_url + "Con_Create_Schedule/delete_Create_Schedule/" + id;
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
            window.location = base_url + "Con_Create_Schedule/delete_Create_Schedule/" + id;
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    }

</script>
<!--=== End Content ===-->

