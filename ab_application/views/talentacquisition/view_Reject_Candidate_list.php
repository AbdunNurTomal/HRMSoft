<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <!--<form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php // echo base_url(); ?>Con_Reject_Candidate_list/update_Rejected_Candidates" enctype="multipart/form-data" role="form" >-->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Reject_Candidate_list/search_Reject_Candidate/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <!--<a href="#" onclick="notify_candidate()" class="btn btn-u"> Notify </a>-->
                                    <!--<button type="submit" id="RejectedForm" name="RejectedForm" onclick="notify_candidate()" class="btn btn-u"> <i class="fa fa-ban" aria-hidden="true"></i> Notify </button>-->
                                </div>
                            </div>
                        </div>
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
                        
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
                <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Reject_Candidate_list/notify_Reject_Candidate" enctype="multipart/form-data" role="form" >
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="1%">
                        <col width="25%">
                        <col width="25%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th> <input name='all_check' id='all_check' type='checkbox' > </th>
                            <!--<th>Resume Type</th>-->
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Skill</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $candidate_status = $this->Common_model->get_array('candidate_status');
                        if ($search_data) {
                            $sl = 0;
                            foreach ($search_data as $row) {
                                $position_id = $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'position_id');
                                if ($row->candidate_user_id == 0) {
                                    $is_user = "No";
                                } else {
                                    $is_user = "Yes";
                                }
                                
                                $skill_set_arr = explode(",", $row->skill_set);
                                $skill_set = '';
                                foreach ($skill_set_arr as $intr) {
                                    if ($skill_set == '') {
                                        $skill_set = $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                    } else {
                                        $skill_set = $skill_set . " , " . $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                    }
                                }
                                
                                $sl++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . "<input name='rejected_id[]' id='rejected_id' type='checkbox' value='$row->id'>" . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $resume_type[$row->resume_type] ."</td>";
                                //print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'requisition_code') . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_first_name ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_last_name ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_email."</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->contact_number . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $skill_set . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $candidate_status[$row->status] . "</td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Notify </button>
                    </div>
                </form>
            </div>
            <!-- end data table --> 
            <!--</form>-->
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
    
    function Recall_Rejected_Candidates(id) {
        var r = confirm("Do you want to Re-Call this?")
        if (r == true)
            window.location = base_url + "Con_Rejected_Candidates/Recall_Rejected_Candidates/" + id;
        else
            return false;
    }
    
    $(function () {
        
        $("#sky-form11").submit(function (event) {
             loading_box(base_url);
             var url = $(this).attr('action');
             $.ajax({
                 url: url,
                 data: $("#sky-form11").serialize(),
                 type: $(this).attr('method')
             }).done(function (data) {

                 var url = '<?php echo base_url() ?>Con_Reject_Candidate_list';
                 view_message(data, url, '', 'sky-form11');

             });
             event.preventDefault();
         });


    });
    
    $("#all_check").change(function() {
        if($(this).prop('checked') == true) {
            $('input:checkbox').attr('checked','checked');
        } else {
            $('input:checkbox').removeAttr('checked');
        }
    });

</script>

