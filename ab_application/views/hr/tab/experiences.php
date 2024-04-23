
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="experience_div">
        <button class="btn btn-u btn-md" onClick="add_experience()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-experience" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
            <colgroup>
                <col width="1%">
                <col width="20%">
                <col width="20%">
                <col width="10%">
                <col width="10%">
                <col width="15%">
                <col width="15%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Company Name</th>
                    <th>Position</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Reason for Leaving</th>
                    <th> May we Contact Your Previous Employer ? </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
                    $position_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $position_query = $this->db->get_where('main_positions', array('isactive' => 1));
                }
                $yes_no_query = $this->Common_model->get_array('yes_no');


                $query = $this->db->get_where('main_emp_experience', array('employee_id' => $employee_id,'isactive' => 1));
                //$yes_no_query = $this->Common_model->get_array('yes_no');
                if ($query) {
                    $i = 0;
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
                        print"<td id='catB" . $pdt . "'>" . $row->comp_name . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $row->emp_position . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->from_date) . "</td>";
                        print"<td id='catF" . $pdt . "'>" . $this->Common_model->show_date_formate($row->to_date) . "</td>";
                        print"<td id='catF" . $pdt . "'>" . $row->reason_for_leaving . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $contact_employee . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' title='Edit' onclick='edit_experience(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' title='Delete' onclick='delete_data_experience(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="Experience_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Previous Experience</h4>
            </div>
            <form id="emp_experience" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_experience"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Company Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="comp_name" id="comp_name" class="form-control input-sm" placeholder="Company Name" data-toggle="tooltip" data-placement="bottom" title="Company Name">
                        </div> 
                        <label class="col-sm-2 control-label">Position<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="emp_position" id="emp_position" class="form-control input-sm" placeholder="Position" data-toggle="tooltip" data-placement="bottom" title="Position">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">From Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="from_datee" id="from_datee" class="form-control dt_pick input-sm" placeholder="From Date" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">To Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="to_datee" id="to_datee" class="form-control dt_pick input-sm" placeholder="To Date" data-toggle="tooltip" data-placement="bottom" title="To Date" autocomplete="off">
                        </div>
                    </div>                                       
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reason for Leaving </label>
                        <div class="col-sm-4">
                            <textarea name="reason_for_leaving" id="reason_for_leaving" class="form-control input-sm" rows="2" placeholder="Reason for Leaving" data-toggle="tooltip" data-placement="top" title="Reason for Leaving"></textarea>
                        </div>
                        <label class="col-sm-2 control-label"> May we Contact Your Previous Employer? </label>
                        <div class="col-sm-4">
                            <select name="contact_employee" id="contact_employee" onchange="explain_check(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($yes_no_query as $key=>$val): ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group hidden" id="explain_div">
                        <label class="col-sm-2 control-label">Explain </label>
                        <div class="col-sm-4">
                            <textarea name="explain" id="explain" class="form-control input-sm" rows="2" placeholder="Explain"  title="Explain"></textarea>
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
        $('#dataTables-example-experience').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5,
            "paginationType": "input"    
        });
        
    });
    
    var save_method; //for save method string
    var table;
    function add_experience()
    {
        save_method = 'add';
        $('#emp_experience')[0].reset(); // reset form on modals
        
//        $("#emp_position").select2({
//            placeholder: "Select Position",
//            allowClear: true,
//        });

        $("#contact_employee").select2({
            placeholder: "Select Contact Empolyee",
            allowClear: true,
        });
        
        $('#Experience_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Previous Experience'); // Set Title to Bootstrap modal title
    }
    
    $(function() {
        $("#reference_contact").mask("(999) 999-9999");
    });
    
//    $("#emp_position").select2({
//        placeholder: "Select Position",
//        allowClear: true,
//    });
    
    $("#contact_employee").select2({
        placeholder: "Select Contact Empolyee",
        allowClear: true,
    });
    
    function explain_check(id)
    {
        if(id==1)
        {
           $('#explain_div').addClass("hidden");
           $('#explain').val("");
        }
        else
        {
            $('#explain_div').removeClass("hidden"); 
            $('#explain').val("");
        }
    }
    
</script>