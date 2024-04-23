<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="language_div">
        <button class="btn btn-u btn-md" onClick="add_languages()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-languages" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
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
                    <th>Languages Name</th>
                    <th>Languages Skill</th>
                    <th>Proficiency Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12 ||$this->user_group == 1) {
                    $language_query = $this->db->get_where('main_com_language', array('company_id' => $this->company_id,'isactive' => 1));
                    $competencylevel_query = $this->db->get_where('main_competencylevels', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $language_query = $this->db->get_where('main_com_language', array('isactive' => 1));
                    $competencylevel_query = $this->db->get_where('main_competencylevels', array('isactive' => 1));
                }
                
                
                $languages_skill_array = $this->Common_model->get_array('languages_skill');
                $query = $this->db->get_where('main_emp_languages', array('employee_id' => $employee_id,'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $languages_skill = "";
                        if ($row->languages_skill) {
                            $skill_arr = explode(',', $row->languages_skill);
                            //print_r($skill_arr);echo "<br>";

                            foreach ($skill_arr as $key) {
                                if ($languages_skill == "") {
                                    $languages_skill = $languages_skill_array[$key];
                                } else {
                                    $languages_skill = $languages_skill . " , " . $languages_skill_array[$key];
                                }
                            }
                        }

                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->languagesid, 'main_language', 'languagename') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($languages_skill) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->competencylevel, 'main_competencylevels', 'competencylevels') . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' title='Edit' onclick='edit_languages(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' title='Delete' onclick='delete_data_languages(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="languages_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add languages</h4>
            </div>
            <form id="emp_languages" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_languages"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Languages <span class="req"/> </label>
                        <div class="col-sm-6">
                            <select name="languagesid" id="languagesid" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php 
                                foreach ($language_query->result() as $key): ?>
                                    <option value="<?php echo $key->languagename ?>"><?php echo $this->Common_model->get_name($this, $key->languagename, 'main_language', 'languagename') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Languages Skill</label>
                        <div class="col-sm-6">
                            <select multiple name="languages_skill[]" id="languages_skill" class="col-sm-12 col-xs-12 myselect2 input-sm" title="Languages Skill (multiple)" >
                                <option></option>
                                <?php 
                                foreach ($languages_skill_array as $key => $val) {
                                    print"<option value='" . $key . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label"> Proficiency Level </label>
                        <div class="col-sm-6">
                            <select name="competencylevel" id="competencylevel" class="col-sm-12 col-xs-12 myselect2 input-sm" >
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
       $('#dataTables-example-languages').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5,
            "paginationType": "input"    
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_languages()
    {
        save_method = 'add';
        $('#emp_languages')[0].reset(); // reset form on modals
       
        $("#languagesid").select2({
            placeholder: "Select Languages",
            allowClear: true,
        });

        $("#languages_skill").select2({
            placeholder: "Select Languages Skill (multiple select)",
            allowClear: true,        
        });

        $("#competencylevel").select2({
            placeholder: "Select Proficiency Level",
            allowClear: true,
        });
        
        $('#languages_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Languages'); // Set Title to Bootstrap modal title
    }
    
    $("#languagesid").select2({
        placeholder: "Select Languages",
        allowClear: true,
    });
    
     $("#languages_skill").select2({
        placeholder: "Select Languages Skill (multiple select)",
        allowClear: true,        
    });
    
    $("#competencylevel").select2({
        placeholder: "Select Proficiency Level",
        allowClear: true,
    });
    
</script>