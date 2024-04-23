
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_dependentinformation_div">
        <button class="btn btn-u btn-md" onClick="add_dependent()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-dependentinformation" class="table table-striped table-bordered dt-responsive table-hover">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Name</th>
                    <th>Relationship</th>
                    <th>Gender</th>                            
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                if($this->user_group == 11 || $this->user_group == 12) {
                    $relation_query = $this->db->get_where('main_relationship_status', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $relation_query = $this->db->get_where('main_relationship_status', array('isactive' => 1));
                }
                
                $yesno_query = $this->Common_model->get_array('yes_no');
                $gender_query = $this->Common_model->get_array('gender');            
                
                $query = $this->db->get_where('main_depandent_information', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i=0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . ucwords($row->fast_name).' '.ucwords($row->middle_name).' '.ucwords($row->last_name). "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this,$row->relationship,'main_relationship_status','relationship_status'). "</td>";
                        print"<td id='catG" . $pdt . "'>" .  $gender_query[$row->gender] . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_dependent(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_dependent(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade bd-example-modal-lg" id="dependent_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Dependent Information</h4>
            </div>
           
            <form id="dependent_information" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_dependent"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="fast_name" id="fast_name" class="form-control input-sm" placeholder="First Name" data-toggle="tooltip" data-placement="bottom" title="First Name">
                        </div>
                        <label class="col-sm-2 control-label">Middle Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="middle_name" id="middle_name" class="form-control input-sm" placeholder="Middle Name" data-toggle="tooltip" data-placement="bottom" title="Middle Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Last Name">
                        </div>
                        <label class="col-sm-2 control-label">Suffix</label>
                        <div class="col-sm-4">
                            <input type="text" name="suffix" id="suffix" class="form-control input-sm" placeholder="Suffix" data-toggle="tooltip" data-placement="bottom" title="Suffix">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Relationship</label>
                        <div id="relationship_div">
                            <div class="col-sm-4">
                                <select name="relationship" id="relationship" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php foreach ($relation_query->result() as $key): ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->relationship_status ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-4">
                            <select name="gender" id="gender" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($gender_query as $key=>$val): ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date Of Birth</label>
                        <div class="col-sm-4">
                            <input type="text" name="dependent_birthdate" id="dependent_birthdate" class="form-control input-sm" placeholder="Date Of Birth" title="Date Of Birth" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-4">
                            <input type="text" name="dependent_age" id="dependent_age" class="form-control input-sm" placeholder="Age" data-toggle="tooltip" data-placement="bottom" title="Age">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">SSN</label>
                        <div class="col-sm-4">
                            <input type="text" name="ssn" id="ssn" class="form-control input-sm" placeholder="SSN" data-toggle="tooltip" data-placement="bottom" title="SSN" >
                        </div>
                        <label class="col-sm-2 control-label">Full Time College Student</label>
                        <div class="col-sm-4">
                            <select name="is_collage_student" id="is_collage_student" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($yesno_query as $key=>$val): ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tobacco User </label>
                        <div class="col-sm-4">
                            <select name="is_tobacco_user" id="is_tobacco_user" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($yesno_query as $key=>$val): ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Employee Address</label>
                        <div class="col-sm-4">
                            <textarea name="employee_address" id="employee_address" class="form-control input-sm" rows="2" placeholder="Employee Address" data-toggle="tooltip" data-placement="top" title="Reason for Leaving"></textarea>
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
        $('#dataTables-example-dependentinformation').dataTable({
            "order": [ 0, "desc" ],
            "pageLength": 5,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_dependent()
    {
        save_method = 'add';
        $('#dependent_information')[0].reset(); // reset form on modals
        
        $("#relationship").select2({
            placeholder: "Select Relationship",
            allowClear: true,
        });
        $("#gender").select2({
            placeholder: "Select Gender",
            allowClear: true,
        });
        $("#is_collage_student").select2({
            placeholder: "College Student",
            allowClear: true,
        });
        $("#is_tobacco_user").select2({
            placeholder: "Tobacco User",
            allowClear: true,
        });

        $('#dependent_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Dependent Information'); // Set Title to Bootstrap modal title
    }
    
    $("#relationship").select2({
        placeholder: "Select Relationship",
        allowClear: true,
    });
    $("#gender").select2({
        placeholder: "Select Gender",
        allowClear: true,
    });
    $("#is_collage_student").select2({
        placeholder: "College Student",
        allowClear: true,
    });
    $("#is_tobacco_user").select2({
        placeholder: "Tobacco User",
        allowClear: true,
    });
    $(function() {
        $("#ssn").mask("999-99-9999");
    });
    
    
</script>