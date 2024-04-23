<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="enrolling_div">
        <button class="btn btn-u btn-md" onClick="add_enrolling()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-enrolling" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
            <colgroup>
                <col width="1%">
                <col width="20%">
                <col width="20%">
                <col width="25%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Dependents</th>
                    <th>Gender</th>                            
                    <th>Date Of Birth</th>                            
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
                    $relation_query = $this->db->get_where('main_relationship_status', array('company_id' => $this->company_id, 'isactive' => 1));
                } else {
                    $relation_query = $this->db->get_where('main_relationship_status', array('isactive' => 1));
                }
                //echo $this->db->last_query();
               
                $gender_array = $this->Common_model->get_array('gender');
                $query = $this->db->get_where('main_emp_enrolling', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $row->fast_name . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $row->last_name . "</td>";
                        print"<td id='catC" . $pdt . "'>" . $this->Common_model->get_name($this, $row->relationship_id, 'main_relationship_status', 'relationship_status') . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $gender_array[$row->gender] . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->birthdate) . "</td>";
                        print"<td><div class='action-buttons '><a href='#' onclick='edit_empenrolling(" . $row->id . ")'  title='Edit'><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='#' onclick='delete_data_empenrolling(" . $row->id . ")' title='Delete'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade bd-example-modal-lg" id="enrolling_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Enrolling</h4>
            </div>
            <form id="emp_enrolling" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_enrolling" id="id_emp_enrolling" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">First Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="en_fast_name" id="en_fast_name" class="form-control input-sm" placeholder="First Name" data-toggle="tooltip" data-placement="bottom" title="First Name">
                        </div>
                        <label class="col-sm-2 control-label">Middle Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="en_middle_name" id="en_middle_name" class="form-control input-sm" placeholder="Middle Name" data-toggle="tooltip" data-placement="bottom" title="Middle Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="en_last_name" id="en_last_name" class="form-control input-sm" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Last Name">
                        </div>
                        <label class="col-sm-2 control-label">Suffix</label>
                        <div class="col-sm-4">
                            <input type="text" name="en_suffix" id="en_suffix" class="form-control input-sm" placeholder="Suffix" data-toggle="tooltip" data-placement="bottom" title="Suffix">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Dependents<span class="req"/></label>
                        <div id="relationship_div">
                            <div class="col-sm-4">
                                <select name="en_relationship" id="en_relationship" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                        foreach ($relation_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->relationship_status ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">Gender<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="en_gender" id="en_gender" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $gender_query = $this->Common_model->get_array('gender');
                                foreach ($gender_query as $keyy => $vall):
                                    ?>
                                    <option value="<?php echo $keyy ?>"><?php echo $vall ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date Of Birth<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="en_birthdate" id="en_birthdate" class="form-control dt_pick input-sm" placeholder="Date Of Birth" onchange="get_age(this.value);" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-4">
                            <input type="text" name="en_age" id="en_age" class="form-control input-sm" placeholder="Age" title="Age" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">SSN<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="en_ssn" id="en_ssn" class="form-control input-sm" placeholder="SSN" data-toggle="tooltip" data-placement="bottom" title="SSN" >
                        </div>
                        <label class="col-sm-2 control-label">Full Time College Student</label>
                        <div class="col-sm-4">
                            <select name="en_iscollage_student" id="en_iscollage_student" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $yesno_query = $this->Common_model->get_array('yes_no');
                                foreach ($yesno_query as $kkey => $vval):
                                    ?>
                                    <option value="<?php echo $kkey ?>"><?php echo $vval ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <label class="col-sm-2 control-label">Tobacco User </label>
                        <div class="col-sm-4">
                            <select name="en_istobacco_user" id="en_istobacco_user" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                               /* $yesno_query = $this->Common_model->get_array('yes_no');
                                foreach ($yesno_query as $keyyy => $valll):
                                    ?>
                                    <option value="<?php echo $keyyy ?>"><?php echo $valll ?></option>
                                <?php endforeach; */ ?>
                            </select>
                        </div> -->
                        <label class="col-sm-2 control-label">Employee Address</label>
                        <div class="col-sm-4">
                            <textarea name="en_employee_address" id="en_employee_address" class="form-control input-sm" rows="2" placeholder="Employee Address" ></textarea>
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
        $('#dataTables-example-enrolling').dataTable({
            "order": [0, "asc"],
            "pageLength": 5,
            "paginationType": "input"
        });
    });

    var save_method; //for save method string
    function add_enrolling()
    {
        save_method = 'add';
        $('#emp_enrolling')[0].reset(); // reset form on modals
        
        $("#en_relationship").select2({
            placeholder: "Select Dependents",
            allowClear: true,
        });

        $("#en_gender").select2({
            placeholder: "Select Gender",
            allowClear: true,
        });

        $("#en_iscollage_student").select2({
            placeholder: "Select Is Collage Student",
            allowClear: true,
        });

        $("#en_istobacco_user").select2({
            placeholder: "Is Tobacco User",
            allowClear: true,
        });
    
        $('#enrolling_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Enrolling'); // Set Title to Bootstrap modal title
    }


    $("#en_relationship").select2({
        placeholder: "Select Dependents",
        allowClear: true,
    });

    $("#en_gender").select2({
        placeholder: "Select Gender",
        allowClear: true,
    });

    $("#en_iscollage_student").select2({
        placeholder: "Select Is Collage Student",
        allowClear: true,
    });

    $("#en_istobacco_user").select2({
        placeholder: "Is Tobacco User",
        allowClear: true,
    });
    
    $(function() {
        $("#en_ssn").mask("999-99-9999");
    });
    
    function get_age(dob)
    {
        if(dob!="")
        {
            var dob_split = dob.split('-');
            var dob_date = dob_split[2] + '-' + dob_split[0] + '-' + dob_split[1];
            //alert (dob_date);
            var pday = new Date();
            var bday = new Date(dob_date);
            var ydiff = pday.getFullYear() - bday.getFullYear();
            var mdiff = pday.getMonth() - bday.getMonth();
            if (mdiff < 0) {
                mdiff += 12;
                ydiff--;
            }
            //var get_age = $('#lblAge').html('About ' + ydiff + ' years ' + mdiff + ' months');
            $('#en_age').val(ydiff + ' years ' + mdiff + ' months');
            //alert (ydiff + ' years ' + mdiff + ' months');
        }
    }

</script>