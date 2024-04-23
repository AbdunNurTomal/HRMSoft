
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="skil_div">
        <button class="btn btn-u btn-md" onClick="add_skills()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-skills" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="30%">
                <col width="30%">
                <col width="25%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Skill Name</th>
                    <th>Years of Experience</th>
                    <th>Proficiency Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
                    $competencylevel_query = $this->db->get_where('main_competencylevels', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $competencylevel_query = $this->db->get_where('main_competencylevels', array('isactive' => 1));
                }
                
                $query = $this->db->get_where('main_emp_skills', array('employee_id' => $employee_id,'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->skillname) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->yearsofexp . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->competencylevelid, 'main_competencylevels', 'competencylevels') . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' title='Edit' onclick='edit_skills(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' title='Delete' onclick='delete_data_skills(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="skills_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Skills</h4>
            </div>
            <form id="emp_skills" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_skills"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Skill Name<span class="req"/></label>
                        <div class="col-sm-6">
                            <input type="text" name="skillname" id="skillname" class="form-control input-sm" placeholder="Skill Name" data-toggle="tooltip" data-placement="bottom" title="Skill Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Years of Experience<span class="req"/></label>
                        <div class="col-sm-6">
                            <input type="text" name="yearsofexp" id="yearsofexp" class="form-control input-sm" placeholder="Years of Experience " data-toggle="tooltip" data-placement="bottom" title="Years of Experience ">
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Proficiency Level<span class="req"/></label>
                        <div class="col-sm-6">
                            <select name="competencylevelid" id="competencylevelid" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php 
                                foreach ($competencylevel_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->competencylevels ?></option>
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
       $('#dataTables-example-skills').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5, 
            "paginationType": "input"   
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_skills()
    {
        save_method = 'add';
        $('#emp_skills')[0].reset(); // reset form on modals
        
        $("#competencylevelid").select2({
            placeholder: "Select Proficiency Level",
            allowClear: true,
        });
    
        $('#skills_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Skills'); // Set Title to Bootstrap modal title
    }
    
    $("#competencylevelid").select2({
        placeholder: "Select Proficiency Level",
        allowClear: true,
    });
 
</script>