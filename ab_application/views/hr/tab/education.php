
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="education_div">
        <button class="btn btn-u btn-md" onClick="add_education()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-edu" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="30%">
                <col width="20%">
                <col width="10%">
                <col width="10%">
            </colgroup> 
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Education Level</th>
                    <th>Institution Name</th>
                    <th>No of Years</th>
                    <th>Certification or Degree</th>                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
                    $educationlevel_query = $this->db->get_where('main_educationlevelcode', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $educationlevel_query = $this->db->get_where('main_educationlevelcode', array('isactive' => 1));
                }
                
                $query = $this->db->get_where('main_emp_education', array('employee_id' => $employee_id,'isactive' => 1));
                //$query = $this->db->get('main_employees'); 
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->educationlevel, 'main_educationlevelcode', 'educationlevelcode') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->institution_name) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->no_of_years . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->certification_degree) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' title='Edit' onclick='edit_education(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' title='Delete' onclick='delete_data_education(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="Coy_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Education</h4>
            </div>
            <form id="emp_education" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_education"/>
                <div class="modal-body">
                    <div class="form-group no-margin">
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
                            <input type="text" name="institution_name" id="institution_name" class="form-control input-sm" placeholder="Institution Name" data-toggle="tooltip" data-placement="bottom" title="Institution Name">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">No. Of Year</label>
                        <div class="col-sm-4">
                            <input type="no_of_years" name="no_of_years" id="percentage" class="form-control input-sm" placeholder="No. Of Year" data-toggle="tooltip" data-placement="bottom" title="No. Of Year">
                        </div> 
                        <label class="col-sm-2 control-label">Certification or Degree </label>
                        <div class="col-sm-4">
                            <input type="text" name="certification_degree" id="certification_degree" class="form-control input-sm" placeholder="Certification or Degree" title="Certification or Degree">
                        </div>
                    </div> 
                    <div class="form-group">                        
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
         $('#dataTables-example-edu').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_education()
    {
        save_method = 'add';
        $('#emp_education')[0].reset(); // reset form on modals
        
        $("#educationlevel").select2({
            placeholder: "Select Education level",
            allowClear: true,
        });
    
        $('#Coy_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Education'); // Set Title to Bootstrap modal title
    }
    
    $("#educationlevel").select2({
        placeholder: "Select Education level",
        allowClear: true,
    });
    
</script>