<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="department_divv">
        <button class="btn btn-u btn-md" onClick="add_department()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-department" class="table table-striped table-bordered dt-responsive table-hover">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Department Name</th>
                    <th>Location</th>
                    <th>Department Code</th>
                    <th>Started On</th>                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->user_type == 2) {
                    $location_query = $this->db->get_where('main_location', array('company_id' => $this->company_id,'isactive' => 1));
                    $department_head_query = $this->db->get_where('main_employees', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $location_query = $this->db->get_where('main_location', array('isactive' => 1));
                    $department_head_query = $this->db->get_where('main_employees', array('isactive' => 1));
                }

                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $query = $this->db->get_where('main_department', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . ucwords($row->department_name) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this,$row->location_id,'main_location','location_name') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->department_code) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->started_on) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_department(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_department(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="department_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Department</h4>
            </div>
            <form id="department_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="department_id" id="department_id"/>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Department Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="department_name" id="department_name" class="form-control input-sm" placeholder="Department Name" data-toggle="tooltip" data-placement="bottom" title="Department Name">
                        </div>
                        <label class="col-sm-2 control-label">Location </label>
                        <div class="col-sm-4">
                            <select name="department_location_id" id="department_location_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($location_query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->location_name . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Department Code</label>
                        <div class="col-sm-4">
                            <input type="text" name="department_code" id="department_code" class="form-control input-sm" placeholder="Department Code" />
                        </div> 
                        <label class="col-sm-2 control-label">Department Head</label>
                        <div class="col-sm-4">
                            <select name="department_head" id="department_head" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($department_head_query->result() as $row) {
                                    print"<option value='" . $row->employee_id . "'>" . $row->first_name." ".$row->middle_name . "</option>";
                                }
                                ?>
                            </select> 
                        </div> 
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Started On</label>
                        <div class="col-sm-4">
                            <input type="text" name="dep_started_on" id="dep_started_on" class="form-control dt_pick input-sm" placeholder="Started On" autocomplete="off" />
                        </div> 
                        <label class="col-sm-2 control-label">Time Zone</label>
                        <div class="col-sm-4">
                            <select name="department_time_zone" id="department_time_zone" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $timezones_query = $this->Common_model->listItem('main_timezones');
                                foreach ($timezones_query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->name . "</option>";
                                }
                                ?>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">County</label>
                        <div class="col-sm-4">                           
                            <select name="department_county_id" id="department_county_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $county_query = $this->Common_model->listItem('main_county');
                                foreach ($county_query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->county_name . "</option>";
                                }
                                ?>
                            </select>  
                        </div>  
                        <label class="col-sm-2 control-label">State</label>
                        <div class="col-sm-4">                            
                            <select name="department_state_id" id="department_state_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $state_query = $this->Common_model->listItem('main_state');
                                foreach ($state_query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->state_name . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">City </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="department_city" id="department_city" class="form-control input-sm" placeholder="Department City" />
                        </div>
                        <label class="col-sm-2 control-label">Zipcode </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="department_zipcode" id="department_zipcode" class="form-control input-sm" placeholder="Zipcode" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address1</label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control input-sm" rows="2" id="address_1" name="address_1" placeholder="Address 1"></textarea>
                        </div> 
                        <label class="col-sm-2 control-label">Address2</label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control input-sm" rows="2" id="address_2" name="address_2" placeholder="Address 2"></textarea>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description </label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control input-sm" rows="2" id="description" name="description" placeholder="Description"></textarea> 
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
         $('#dataTables-example-department').dataTable({
            "order": [ 0, "desc" ],
            "pageLength": 5,
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_department()
    {
        save_method = 'add';
        $('#department_form')[0].reset(); // reset form on modals
        $('#department_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Department'); // Set Title to Bootstrap modal title
    }
    
    $("#department_location_id").select2({
        placeholder: "Location ID",
        allowClear: true,
    });
    $("#department_head").select2({
        placeholder: "Department Head",
        allowClear: true,
    });
    $("#department_time_zone").select2({
        placeholder: "Time Zone",
        allowClear: true,
    });
    $("#department_county_id").select2({
        placeholder: "County ID",
        allowClear: true,
    });
    $("#department_state_id").select2({
        placeholder: "State ID",
        allowClear: true,
    });
    
    $(function() {
        $("#department_zipcode").mask("99999");
    });


</script>