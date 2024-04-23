<div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
<!-- <div class="row"> -->
    <!-- data table -->
    <!-- <div class="col-md-12" id="employmenthistory_div"> -->
        <button class="btn btn-u btn-md" onClick="add_ob_employmenthistory()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-employmenthistory" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
             <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Employer</th>
                    <th>Position</th>                    
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Supervisor Name</th>
                    <th>Reason Of leave</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                    $positions_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $positions_query = $this->db->get_where('main_positions', array('isactive' => 1));
                }
                $yes_no_query = $this->Common_model->get_array('yes_no');
                
                if ($type == 1) {
                    $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
                    $ob_emp_id = $this->onboarding_employee_data['onboarding_employee_id'];
                } else if ($type == 2) {
                    $ob_emp_id = $ob_emp_id;
                }

                $query = $this->db->get_where('main_ob_employmenthistory', array('onboarding_employee_id' => $ob_emp_id,'isactive' => 1));
                if ($query) {
                    $i=0;
                    foreach ($query->result() as $row) {
                        if ($row->contact_employee == 0) {
                            $contact_employee = "";
                        } else {
                            $contact_employee = $yes_no_query[$row->contact_employee];
                        }
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->employer) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->position . "</td>";                        
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->start_date) . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->end_date) . "</td>";
                        print"<td id='catB" . $pdt . "'>" . ucwords($row->supervisor_name) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->reason_for_leaving) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_ob_employmenthistory(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_ob_employmenthistory(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>


<div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
    <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
    <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(1)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
</div>


<div class="modal fade bd-example-modal-lg" id="employmenthistory_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Employment History</h4>
            </div>
            <form id="onboarding_employmenthistory_form" name="sky-form11" class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="onboarding_employee_id"/>
                <input type="hidden" value="" name="employmenthistory_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employer<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="employer" id="employer" class="form-control input-sm"  placeholder="Employer" data-toggle="tooltip" data-placement="bottom" title="Employer">
                        </div>
                        <label class="col-sm-2 control-label">Position <span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="position" id="position" class="form-control input-sm"  placeholder="Position" title="Position">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Start Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="start_date" id="start_date" class="form-control dt_pick input-sm" placeholder="Start Date" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">End Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="end_date" id="end_date" class="form-control dt_pick input-sm" placeholder="End Date" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Supervisor Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="supervisor_name" id="supervisor_name" class="form-control input-sm" placeholder="Supervisor Name" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">Phone No</label>
                        <div class="col-sm-4">
                            <input type="text" name="phone_no" id="phone_no" class="form-control input-sm" placeholder="Phone No" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Starting Compensation</label>
                        <div class="col-sm-4">
                            <input type="text" name="starting_compensation" id="starting_compensation" class="form-control input-sm" placeholder=" ( $ ) Starting Compensation" onkeypress="return numbersonly(this, event)">
                        </div>
                        <label class="col-sm-2 control-label">Ending Compensation</label>
                        <div class="col-sm-4">
                            <input type="text" name="ending_compensation" id="ending_compensation" class="form-control input-sm" placeholder=" ( $ ) Ending Compensation"  onkeypress="return numbersonly(this, event)" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reason for Leaving </label>
                        <div class="col-sm-4">
                            <textarea name="reason_for_leaving" id="reason_for_leaving" class="form-control input-sm" rows="2" placeholder="Reason for Leaving" data-toggle="tooltip" data-placement="top" title="Reason for Leaving"></textarea>
                        </div>
                        <label class="col-sm-2 control-label">May we contact your previous employer ? </label>
                        <div class="col-sm-4">
                            <select name="contact_employee" id="contact_employee" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($yes_no_query as $key=>$val): ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function () {
       $('#dataTables-example-employmenthistory').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5,
            "paginationType": "input"    
        });
        
    });
    
    var save_method; //for save method string
    var table;
    function add_ob_employmenthistory()
    {
        save_method = 'add';
        $('#onboarding_employmenthistory_form')[0].reset(); // reset form on modals
        
//        $("#position").select2({
//            placeholder: "Position",
//            allowClear: true,
//        });
        
        $("#contact_employee").select2({
            placeholder: "Contact Previous Employer",
            allowClear: true,
        });
    
        $('#employmenthistory_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Employment History'); // Set Title to Bootstrap modal title
    }
    
//    $("#position").select2({
//        placeholder: "Position",
//        allowClear: true,
//    });

    $("#contact_employee").select2({
        placeholder: "Contact Previous Employer",
        allowClear: true,
    });
   
    $(function() {
        $("#employer_phone").mask("(999) 999-9999");
        $("#phone_no").mask("(999) 999-9999");
    });
  
</script>
