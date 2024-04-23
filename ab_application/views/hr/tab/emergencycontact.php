
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="emergencycontact_div">
        <button class="btn btn-u btn-md" onClick="add_emergencycontact()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-emergencycontact" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
           <colgroup>
                <col width="1%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Name</th>
                    <th>Occupation</th>
                    <th>Relationship</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
                    $relationship_status_query = $this->db->get_where('main_relationship_status', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $relationship_status_query = $this->db->get_where('main_relationship_status', array('isactive' => 1));
                }
                $relationship_array = $this->Common_model->get_array('relationship_array');

                $query = $this->db->get_where('main_emp_emergencycontact', array('employee_id' => $employee_id,'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . ucwords($row->first_name) . "</td>";
                        print"<td id='catC" . $pdt . "'>" . ucwords($row->occupation) . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $relationship_array[$row->relationship] . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->first_address) . "</td>";
                        print"<td id='catD" . $pdt . "'>" . ucwords($row->city) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->mobile . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_emergencycontact(" . $row->id . ")' title='Edit' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_emergencycontact(" . $row->id . ")' title='Delete'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade bd-example-modal-lg" id="Emergencycontact_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Training & Certification</h4>
            </div>
            <form id="emp_emergencycontact" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_emergencycontact"/>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">First Name<span class="req"/></label>
                            <div class="col-sm-8">
                                <input type="text" name="em_first_name" id="em_first_name" class="form-control input-sm" placeholder="First Name" data-toggle="tooltip" data-placement="bottom" title="First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="em_last_name" id="em_last_name" class="form-control input-sm" placeholder="Last Name" data-toggle="tooltip" data-placement="bottom" title="Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Primary Address </label>
                            <div class="col-sm-8">
                                <textarea name="em_first_address" id="em_first_address" class="form-control input-sm" rows="2" placeholder="Primary Address"> </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Secondary Address</label>
                            <div class="col-sm-8">
                                <textarea name="em_second_address" id="em_second_address" class="form-control input-sm" rows="2" placeholder="Secondary Address"> </textarea>
                            </div>     
                        </div>
                        <div class="form-group no-margin">
                            <label class="col-sm-4 control-label">State</label>
                            <div class="col-sm-8">
                                <select name="em_state" id="em_state" onchange="load_em_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php foreach ($state_query->result() as $keyy): ?>
                                        <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">County</label>
                            <div class="col-sm-8">
                                <select name="em_county" id="em_county" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>                                
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">City</label>
                            <div class="col-sm-8">
                                <input type="text" name="em_city" id="em_city" class="form-control input-sm" placeholder="City" data-toggle="tooltip" data-placement="bottom" title="City">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Zip Code</label>
                            <div class="col-sm-8">
                                <input type="text" name="em_zipcode" id="em_zipcode" class="form-control input-sm" placeholder="Zip Code" data-toggle="tooltip" data-placement="bottom" title="Zip Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Mobile<span class="req"/></label>
                            <div class="col-sm-8">
                                <input type="text" name="em_mobile" id="em_mobile" class="form-control input-sm" placeholder="Mobile" data-toggle="tooltip" data-placement="bottom" title="Mobile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Secondary Phone</label>
                            <div class="col-sm-8">
                                <input type="text" name="em_phone" id="em_phone" class="form-control input-sm" placeholder="Secondary Phone" data-toggle="tooltip" data-placement="bottom" title="Secondary Phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Relationship <span class="req"/> </label>
                            <div class="col-sm-8">
                                <!--<input type="text" name="em_relationship" id="em_relationship" class="form-control input-sm" placeholder="Relationship" data-toggle="tooltip" data-placement="bottom" title="Relationship">-->
                              <select name="em_relationship" id="em_relationship" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($relationship_array as $rkey=>$rval):
                                        ?>
                                        <option value="<?php echo $rkey ?>"><?php echo $rval ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>                          
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Occupation</label>
                            <div class="col-sm-8">
                                <input type="text" name="em_occupation" id="em_occupation" class="form-control input-sm" placeholder="Occupation" data-toggle="tooltip" data-placement="bottom" title="Occupation">
                            </div>
                        </div>
                        <div class="form-group">                       
                            <label class="col-sm-4 control-label">Comments</label>
                            <div class="col-sm-8">
                                <textarea name="em_description" id="em_description" class="form-control input-sm" rows="2" placeholder="Comments" data-toggle="tooltip" data-placement="top" title="Comments"></textarea>
                            </div>
                        </div>    
                    </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                               <button type="submit" id="submit" class="btn btn-u">Save</button>
                               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                           </div>
                        </div>
                </div>
                
                
                   
            </form>
        </div>
    </div>
</div>


  
<script type="text/javascript">
    
    $(document).ready(function () {
         $('#dataTables-example-emergencycontact').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5, 
            "paginationType": "input"   
        });
    });
    
    var save_method; //for save method string
    function add_emergencycontact()
    {
        save_method = 'add';
        $('#emp_emergencycontact')[0].reset(); // reset form on modals
        
         $("#em_state").select2({
            placeholder: "State",
            allowClear: true,
         });
         $("#em_county").select2({
            placeholder: "County",
            allowClear: true,
         });

         $("#em_relationship").select2({
             placeholder: "Relationship",
             allowClear: true,
         });
    
        $('#Emergencycontact_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Emergency Contact'); // Set Title to Bootstrap modal title
    }
    
   
    $(function() {
        $("#em_phone").mask("(999) 999-9999");
        $("#em_mobile").mask("(999) 999-9999");
        $("#em_zipcode").mask("99999");
    });
    
    function load_em_county(id) {
//        alert(id);
        $.ajax({
            url: "<?php echo site_url('Con_Employees/load_county_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#em_county').html('');
                $('#em_county').empty();

                $('#em_county').html(data);
            }
        });
    }
</script>