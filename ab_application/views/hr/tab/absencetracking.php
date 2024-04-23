
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="absencetracking_div">
        <button class="btn btn-u btn-md" onClick="add_absencetracking()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-absencetracking" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
           <colgroup>
                <col width="5%">
                <col width="20%">
                <col width="20%">
                <col width="25%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Absent Type</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Total Days</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $absent_type_array = $this->Common_model->get_array('absent_type');
                $yes_no_array = $this->Common_model->get_array('yes_no');
                //$leave_type_query = $this->Common_model->listItem('main_employeeleavetypes');
                
                if ($this->user_group == 11 || $this->user_group == 12) {
                    $leave_type_query = $this->db->get_where('main_employeeleavetypes', array('company_id' => $this->company_id,'leavetype' => 1));
                } else {
                    $leave_type_query = $this->db->get_where('main_employeeleavetypes', array('leavetype' => 1));
                }

                $query = $this->db->get_where('main_emp_absencetracking', array('employee_id' => $employee_id,'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $absent_type_array[$row->absent_type] . "</td>";
                        print"<td id='catC" . $pdt . "'>" . $this->Common_model->show_date_formate($row->from_date) . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->to_date) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->total_days . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->details_reason) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_absencetracking(" . $row->id . ")' title='Edit' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_absencetracking(" . $row->id . ")' title='Delete'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade bd-example-modal-lg" id="Absencetracking_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Absence Tracking</h4>
            </div>
            <form id="emp_absencetracking" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_absencetracking"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">From Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="from_datea" id="from_datea" class="form-control dt_pick input-sm" onchange="calculate_date()" placeholder="From Date" data-toggle="tooltip" data-placement="bottom" title="From Date" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">To Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="to_datea" id="to_datea" class="form-control dt_pick input-sm" onchange="calculate_date()" placeholder="To Date" data-toggle="tooltip" data-placement="bottom" title="To Date" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Total Days</label>
                        <div class="col-sm-4">
                            <input type="text" name="total_days" id="total_days" class="form-control input-sm" placeholder="Total Days" data-toggle="tooltip" data-placement="bottom" title="Total Days" readonly>
                        </div>
                        <label class="col-sm-2 control-label">Absent Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="absent_type" id="absent_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($absent_type_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reason</label>
                        <div class="col-sm-4">
                            <textarea name="details_reason" id="details_reason" class="form-control input-sm" rows="2" placeholder="Details Reason" data-toggle="tooltip" data-placement="top" title="Details Reason"></textarea>
                        </div>
                        
                        <label class="col-sm-2 control-label">Consider as Leave</label>
                        <div class="col-sm-4">
                            <select name="is_leave" id="is_leave" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="change_is_leave(this.value)">
                                <option></option>
                                <?php
                                foreach ($yes_no_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div id="leave_type_div" class="form-group no-margin" style="display: none;">
                        <label class="col-sm-2 control-label">Leave Type</label>
                        <div class="col-sm-4">
                            <select name="leave_type" id="leave_type" class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                                <?php
                                foreach ($leave_type_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->leave_code ?></option>
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
         $('#dataTables-example-absencetracking').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5, 
            "paginationType": "input"   
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_absencetracking()
    {
        save_method = 'add';
        $('#emp_absencetracking')[0].reset(); // reset form on modals
        
        $("#absent_type").select2({
            placeholder: "Absent Type",
            allowClear: true,
        });

        $("#is_leave").select2({
            placeholder: "Consider as Leave ? ",
            allowClear: true,
        });

        $("#leave_type").select2({
            placeholder: "leave type ",
            allowClear: true,
        });
    
        $('#Absencetracking_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Absence Tracking'); // Set Title to Bootstrap modal title
        
        change_is_leave($('#leave_type').val());
    }
    
    function calculate_date()
    {
        var from_datea = $('#from_datea').val();
        var dates = from_datea.split( '-' );
	var date1 = new Date(dates[2] + '-' + dates[0] + '-' + dates[1]);
        //var date1 = new Date(from_datea);
        
        var to_datea = $('#to_datea').val();
        var datess = to_datea.split( '-' );
	var date2 = new Date(datess[2] + '-' + datess[0] + '-' + datess[1]);
        //var date2 = new Date(to_datea);

        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var diffDays = Math.abs((date1.getTime() - date2.getTime()) / (oneDay))+ 1;
        //alert(diffDays);
          if(diffDays)
          {
            $('#total_days').val(diffDays);
          }
    }
    
    
    function change_is_leave(val)
    {
      if(val==1)
      {
          $('#leave_type_div').removeAttr("style");
      }
      else
      {
          
          $('#leave_type_div').attr('style', 'display:none');
          $('#leave_type').val('');
      }
    }
    
    $("#absent_type").select2({
        placeholder: "Absent Type",
        allowClear: true,
    });
    
    $("#is_leave").select2({
        placeholder: "Consider as Leave ? ",
        allowClear: true,
    });
    
    $("#leave_type").select2({
        placeholder: "leave type ",
        allowClear: true,
    });
    
    
    
    
</script>