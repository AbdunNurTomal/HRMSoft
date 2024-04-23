
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_benefitsprovider_div">
        <button class="btn btn-u btn-md" onClick="add_benefitsprovider()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-benefitsprovider" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
               <col width="5%">
                <col width="25%">
                <col width="10%">
                <col width="10%">
                <col width="15%">
                <col width="10%">
                <col width="15%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Service Provider Name</th>
                    <th>City</th>                            
                    <th>States</th>                            
                    <th>Contact Name</th>                            
                    <th>Phone No.</th>                            
                    <th>Email</th>    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];

                $query = $this->db->get_where('main_benefits_provider', array('company_id' => $this->company_settings_id, 'isactive' => 1));
                //echo $this->db->last_query();

                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catA" . $pdt . "'>" . ucwords($row->service_provider_name) . "</td>";
                        print"<td id='catA" . $pdt . "'>" . ucwords($row->city) . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->states, 'main_state', 'state_name') . "</td>";
                        print"<td id='catA" . $pdt . "'>" . ucwords($row->contact_name) . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $row->phone_no . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $row->email . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_benefitsprovider(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_benefitsprovider(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="benefitsprovider_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Benefits Provider</h4>
            </div>
            <form id="benefitsprovider_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="benefitsprovider_id" id="benefitsprovider_id"/>
                <div class="modal-body">


                    <div class="form-group">                        
                        <label class="col-sm-2 control-label ">Provider Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="service_provider_name" id="service_provider_name" class="form-control input-sm" placeholder="Service Provider Name" />
                        </div>
                        <label class="col-sm-2 control-label">Zip Code</label>
                        <div class="col-sm-4">
                            <input type="text" name="zipcode" id="zipcode" class="form-control input-sm" placeholder="Zip Code" />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Contact Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="contact_name" id="contact_name" class="form-control input-sm" placeholder="Contact Name" />
                        </div> 
                        <label class="col-sm-2 control-label">State</label>
                        <div class="col-sm-4">
                            <select name="states" id="states" onchange="load_bp_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $states = $this->Common_model->listItem('main_state');
                                foreach ($states->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->state_name . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Email<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email" />
                        </div> 
                        <label class="col-sm-2 control-label">County</label>
                        <div class="col-sm-4">
                            <select name="county" id="county" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>                                
                            </select>  
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Phone No.<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="phone_no" id="phone_no" class="form-control input-sm" placeholder="Phone Number" />
                        </div>
                        <label class="col-sm-2 control-label">City</label>
                        <div class="col-sm-4">
                            <input type="text" name="city" id="city" class="form-control input-sm" placeholder="City " />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Address 1<span class="req"/></label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="address1" name="address1" placeholder="Address 1"></textarea>
                        </div> 
                        <label class="col-sm-2 control-label">Ext.</label>
                        <div class="col-sm-4">
                            <input type="text" name="ext" id="ext" class="form-control input-sm" placeholder="Ext." />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Address 2</label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="address2" name="address2" placeholder="Address 2"></textarea>
                        </div>
                        <label class="col-sm-2 control-label">Fax</label>
                        <div class="col-sm-4">
                            <input type="text" name="fax" id="fax" class="form-control input-sm" placeholder="Fax" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Account Number</label>
                        <div class="col-sm-4">
                            <input type="text" name="acc_number" id="acc_number" class="form-control input-sm" placeholder="Account Number" />
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
        $('#dataTables-example-benefitsprovider').dataTable({
            "order": [0, "asc"],
            "pageLength": 10,
            "paginationType": "input"
        });
    });

    var save_method; //for save method string
    var table;
    function add_benefitsprovider()
    {
        save_method = 'add';
        $('#benefitsprovider_form')[0].reset(); // reset form on modals

        $("#states").select2({
            placeholder: "States",
            allowClear: true,
        });

        $('#benefitsprovider_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Benefits Provider'); // Set Title to Bootstrap modal title
    }

    $("#states").select2({
        placeholder: "States",
        allowClear: true,
    });
    $("#county").select2({
        placeholder: "County",
        allowClear: true,
    });

    function load_bp_county(id) {
        $.ajax({
            url: "<?php echo site_url('Con_configaration/load_county_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#county').html('');
                $('#county').empty();

                $('#county').html(data);
            }
        });
    }

    $(function () {
        $("#zipcode").mask("99999");
        $("#phone_no").mask("(999) 999-9999");
        $("#ext").mask("999999");
        $("#fax").mask("(999) 999-9999");

    });

</script>