<div class="row">
    <!-- data table -->
    <div class="col-md-12" id="od_education_div">
        <button class="btn btn-u btn-md" onClick="add_ob_education()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-education" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Education Level</th>
                    <th>Institution Name</th>
                    <th>No of Years</th>
                    <th>Graduated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 9 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                    $educationlevel_query = $this->db->get_where('main_educationlevelcode', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $educationlevel_query = $this->db->get_where('main_educationlevelcode', array('isactive' => 1));
                }

                $type_of_school_array = $this->Common_model->get_array('type_of_school');
                $yes_no_array = $this->Common_model->get_array('yes_no');
                
                if ($type == 1) {
                    $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
                    $ob_emp_id = $this->onboarding_employee_data['onboarding_employee_id'];
                } else if ($type == 2) {
                    $ob_emp_id = $ob_emp_id;
                }
                
                $query = $this->db->get_where('main_ob_education', array('onboarding_employee_id' => $ob_emp_id,'isactive' => 1));
                if ($query) {
                    $i=0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        if($row->graduated==0)$graduated=""; else $graduated=$yes_no_array[$row->graduated];
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->educationlevel, 'main_educationlevelcode', 'educationlevelcode') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->institution_name) . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $row->no_of_years . "</td>"; 
                        print"<td id='catE" . $pdt . "'>" . $graduated . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_ob_education(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_ob_education(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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


<div class="modal fade bd-example-modal-lg" id="education_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Education</h4>
            </div>
            <form id="onboarding_education_form" name="sky-form11" class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="education_id"/>
                <input type="hidden" value="" name="onboarding_employee_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Education Level<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="educationlevel" id="educationlevel" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($educationlevel_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->educationlevelcode ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Institution Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="institution_name" id="institution_name" class="form-control" placeholder="Institution Name" data-toggle="tooltip" data-placement="bottom" title="Institution Name">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">No. Of Years</label>
                        <div class="col-sm-4">
                            <input type="text" name="no_of_years" id="no_of_years" class="form-control input-sm" placeholder="No. Of Years"  title="No. Of Years">
                        </div> 
                        <label class="col-sm-2 control-label">Graduated</label>
                        <div class="col-sm-4">
                            <select name="graduated" id="graduated" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($yes_no_array as $key=>$val): ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div>                    
                    <div class="form-group"> 
                        <label class="col-sm-2 control-label">Degree Obtained</label>
                        <div class="col-sm-4">
                            <input type="text" name="degree_obtained" id="degree_obtained" class="form-control input-sm" placeholder="Degree Obtained"  title="Degree Obtained">
                        </div> 
                        <label class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-4">
                            <textarea name="edu_remarks" id="edu_remarks" class="form-control input-sm"></textarea>
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
        $('#dataTables-example-education').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5,
            "paginationType": "input"    
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_ob_education()
    {
        save_method = 'add';
        $('#onboarding_education_form')[0].reset(); // reset form on modals
        
        $("#educationlevel").select2({
            placeholder: "Education Level",
            allowClear: true,
        });
        $("#graduated").select2({
            placeholder: "Select Graduated",
            allowClear: true,
        });
    
        $('#education_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Education'); // Set Title to Bootstrap modal title
    }
  
    $(function() {
        $("#phone_number").mask("(999) 999-9999");
    });
    
    $("#educationlevel").select2({
        placeholder: "Education Level",
        allowClear: true,
    });
    
    $("#graduated").select2({
        placeholder: "Select Graduated",
        allowClear: true,
    });
  
</script>
