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
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Interview_Result/search_Interview_Result/'; ?>" method="post">
                    <div class="row">
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">  Requisition  </label>
                                <div class="col-sm-8">
                                    <select name="requisition_idd" id="requisition_idd" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($opening_position_query->result() as $key) {
                                            $position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                            $position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');

                                            $slct = ($search_criteria['requisition_idd'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->requisition_code . "  ( " . $position_name . " ) " . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">  Rating  </label>
                                <div class="col-sm-8">
                                    <select name="rating_id" id="rating_id" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($rating_array as $key=>$val) {
                                            $slct = ($search_criteria['rating_id'] == $key) ? 'selected' : '';
                                            echo '<option value="' . $key . '" ' . $slct . '>' . $val . '</option>';
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <!--<th>Resume Type</th>-->
                            <th>Requisition Id</th>
                            <th>Position</th>
                            <th>Interview Status</th>
                            <th>Candidate Status</th>
                            <th>Rating</th>
                            <!--<th>Action</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $interview_status = $this->Common_model->get_array('interview_status');
                        $candidate_status = $this->Common_model->get_array('candidate_status');
                        $rating_array = $this->Common_model->get_array('rating_array');
                        if ($search_data) {
                            $sl=0;
                            foreach ($search_data as $row) {
                                $position_id=$this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','position_id');
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_id,'main_cv_management','candidate_first_name') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_id,'main_cv_management','candidate_last_name') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_id,'main_cv_management','candidate_email') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->candidate_id,'main_cv_management','contact_number') ."</td>";
                                //print"<td id='catA" . $pdt . "'>" . $resume_type[$this->Common_model->get_name($this,$row->candidate_id,'main_cv_management','resume_type')] ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->requisition_id,'main_opening_position','requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$position_id,'main_jobtitles','job_title') ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_status[$row->interview_status]."</td>";
                                print"<td id='catA" . $pdt . "'>" . $candidate_status[$row->candidate_status]."</td>";
                                print"<td id='catA" . $pdt . "'>" . $rating_array[$row->rating_id]."</td>";
//                                print"<td><div class='action-buttons '><a title='Interview' href='" . base_url() . "Con_Interview_Candidate/set_Interview_panel/" . $row->id . "/" . "' ><i class='glyphicon glyphicon-check'>&nbsp;</i></a><a title='Preview' href='" . base_url() . "Con_Interview_Candidate/view_Candidate/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
    
    $("#rating_id").select2({
        placeholder: "Select rating",
        allowClear: true
    });

   
</script>
<!--=== End Content ===-->

