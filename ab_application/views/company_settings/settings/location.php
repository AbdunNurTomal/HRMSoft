<div class="row">
    <!-- data table -->
    <form id="delete_location_forms" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_configaration/delete_multiple_location" enctype="multipart/form-data" role="form">

        <div class="table-responsive col-md-12 col-centered" id="location_div">
            <a href='#' onClick="add_location()" class="btn btn-u"><span class="glyphicon glyphicon-plus-sign"></span> Add </a>
            <button type="submit" id="submit" class="btn btn-u"> <i class='fa fa-trash-o'></i> Delete </button><br><br>
                
                <table id="new_location" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" name="select_all" value="1" id="new_location-table-select-all"></th>
                                <th>SL </th>
                                <th>Location Name</th>
                                <th>Contact Person</th>
                                <th>Contact Number</th>
                                <th>Email</th> 
                                <th>Start Date</th> 
                                <th>Action</th>
                                <!-- <th>Actions</th>  -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
            <!-- <table id="dataTables-example-location" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
                <colgroup>
                    <col width="1%">
                    <col width="10%">
                    <col width="25%">
                    <col width="15%">
                    <col width="25%">
                    <col width="25%">
                    <col width="10%">
                    <col width="5%">
                </colgroup>
                <thead>
                    <tr>
                       <th> <input name='all_check' id='all_check' type='checkbox' style="margin-left: -8px;"></th>
                        <th>SL </th>
                        <th>Location Name</th>
                        <th>Contact Person</th>
                        <th>Contact Number</th>
                        <th>Email</th> 
                        <th>Start Date</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $company_data = $this->session->userdata('company');
                    $this->company_settings_id = $company_data['company_settings_id'];

                    $query = $this->db->get_where('main_location', array('company_id' => $this->company_settings_id, 'isactive' => 1));
                    //echo $this->db->last_query();

                    if ($query) {
                        $i = 0;
                        foreach ($query->result() as $row) {
                            $i++;
                            $pdt = $row->id;
                            print"<tr>";
                            print"<td id='catA" . $pdt . "'><input name='lCheck[]' id='lCheck' type='checkbox' value='" . $row->id . "'></td>";
                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                            print"<td id='catB" . $pdt . "'>" . ucwords($row->location_name) . "</td>";
                            print"<td id='catE" . $pdt . "'>" . ucwords($row->contact_person) . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $row->contact_number . "</td>";
                            print"<td id='catE" . $pdt . "'>" . ucwords($row->email) . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->started_on) . "</td>";
                            print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_location(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_location(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                            print"</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table> -->
<!--            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-u"> Delete </button>
            </div>-->

        </div>
        <!-- end data table -->
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="location_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Location</h4>
            </div>
            <form id="location_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="location_id" id="location_id"/>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Location Name<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="location_name" id="location_name" class="form-control input-sm" placeholder="Location Name" data-toggle="tooltip" data-placement="bottom" title="Location Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Contact Person<span class="req"/></label>
                                <div class="col-sm-8">
                                    <input type="text" name="contact_person" id="contact_person" class="form-control input-sm" placeholder="Contact Person" data-toggle="tooltip" data-placement="bottom" title="Contact Person">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Address 1<span class="req"/></label>
                                <div class="col-sm-8">
                                    <textarea name="address_1" id="address_1" class="form-control input-sm" rows="2" placeholder="Address 1" data-toggle="tooltip" data-placement="top" title="Address 1"></textarea>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Address 2</label>
                                <div class="col-sm-8">
                                    <textarea name="address_2" id="address_2" class="form-control input-sm" rows="2" placeholder="Address 2" data-toggle="tooltip" data-placement="top" title="Address 2"></textarea>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">City</label>
                                <div class="col-sm-8">
                                    <input type="text" name="location_city" id="location_city" class="form-control input-sm" placeholder="Location City" />
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">State</label>
                                <div class="col-sm-8">
                                    <select name="location_state_id" id="location_state_id" onchange="load_lo_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
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
                                <div id="lcounty_div">
                                    <label class="col-sm-4 control-label">County</label>
                                    <div class="col-sm-7" >
                                        <select name="location_county_id" id="location_county_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                            <option></option>

                                        </select>  
                                    </div> 
                                    <a class="btn ntn-u col-sm-1" onClick="add_lcounty()" href="#" title="Add County"><span class="glyphicon glyphicon-plus-sign"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Zip Code </label>
                                <div class="col-sm-8">                            
                                    <input type="text" name="location_zipcode" id="location_zipcode" class="form-control input-sm" placeholder="Zipcode" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Time Zone</label>
                                <div class="col-sm-8">
                                    <select name="location_time_zone" id="location_time_zone" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        $timezones_query = $this->Common_model->listItem('main_timezones');
                                        foreach ($timezones_query->result() as $row) {
                                            print"<option value='" . $row->id . "'>" . $row->timezone . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Contact Number</label>
                                <div class="col-sm-8">
                                    <input type="text" name="contact_number" id="contact_number" class="form-control input-sm" placeholder="Contact Number" data-toggle="tooltip" data-placement="bottom" title="Contact Number">
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email" data-toggle="tooltip" data-placement="bottom" title="Email">
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Start Date</label>
                                <div class="col-sm-8">
                                    <input type="text" name="started_on" id="started_on" class="form-control dt_pick input-sm" placeholder="Start Date" data-toggle="tooltip" data-placement="bottom" title="Start Date" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Description </label>
                                <div class="col-sm-8">                            
                                    <textarea class="form-control input-sm" rows="2" id="description" name="description" placeholder="Description"></textarea> 
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

<!-- Modal -->
<div class="modal fade" id="lcounty_Modal_entry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add County</h4>
            </div>
            <form id="add_lcounty_entry" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_languages"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label ">County Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="county_name" id="county_name" class="form-control input-sm" placeholder="County Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="2" id="description" name="description" placeholder="Description"></textarea>
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
        $('#dataTables-example-location').dataTable({
            "order": [0, "asc"],
            "pageLength": 10,
            "paginationType": "input"
        });
    });

    var save_method; //for save method string
    var table;
    function add_location()
    {
        save_method = 'add';
        $('#location_form')[0].reset(); // reset form on modals

        $("#location_time_zone").select2({
            placeholder: "Select time zone",
            allowClear: true,
        });

        $("#location_county_id").select2({
            placeholder: "Select country",
            allowClear: true,
        });

        $("#location_state_id").select2({
            placeholder: "Select state",
            allowClear: true,
        });

        $('#location_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Location'); // Set Title to Bootstrap modal title
    }


    $("#location_time_zone").select2({
        placeholder: "Select time zone",
        allowClear: true,
    });

    $("#location_county_id").select2({
        placeholder: "Select country",
        allowClear: true,
    });

    $("#location_state_id").select2({
        placeholder: "Select state",
        allowClear: true,
    });

    $(function () {
        $("#contact_number").mask("(999) 999-9999");
        $("#location_zipcode").mask("99999");
    });

    function add_lcounty()
    {
        save_method = 'add';
        $('#add_lcounty_entry')[0].reset(); // reset form on modals
        $('#lcounty_Modal_entry').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add County'); // Set Title to Bootstrap modal title
    }

    $(function () {
        $("#add_lcounty_entry").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_County_Settings/save_County_Settings') ?>";
            }
            $.ajax({
                url: url,
                data: $("#add_lcounty_entry").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '';
                view_message(data, url, 'lcounty_Modal_entry', 'add_lcounty_entry');

//                    $("#lcounty_div").load(location.href + " #lcounty_div");

                setTimeout(function () {

                    $("#location_county_id").select2({
                        placeholder: "Select County",
                        allowClear: true,
                    });

                }, 1000);


            });
            event.preventDefault();
        });
    });

    function load_lo_county(id) {
//        alert(id);
        $.ajax({
            url: "<?php echo site_url('Con_configaration/load_county_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#location_county_id').html('');
                $('#location_county_id').empty();

                $('#location_county_id').html(data);
            }
        });
    }
    
     $(function () {
        $("#delete_location_form").submit(function (event) {
            
            var r = confirm("Do you want to delete this?")
            if (r == true)
            {
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: $("#delete_location_form").serialize(),
                    type: $(this).attr('method')
                }).done(function (data) {
                    //alert (data);
                   // $("#location_div").load(location.href + " #location_div");

                    var url = '';
                    view_message(data, url, '', '');
                     var oTable = $('#new_location').DataTable( );
                        // to reload
                        oTable.ajax.reload();
                    setTimeout(function(){ 
                        reload_table('dataTables-example-location');
                    }, 4000);

                });
                event.preventDefault();
            }
            else
            {
                return false;
            }
        });
    });
    
   /*  $('body').on('change', '#all_check', function() {
        var rows, checked;
        rows = $('#dataTables-example-location').find('tbody tr');
        checked = $(this).prop('checked');
        $.each(rows, function() {
            var checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', checked);
        });
    }); */

    /* datatable for contact employee by employee starts */
    $(document).ready(function () {
       
        var locationDatatable = $('#new_location').DataTable({
            "pageLength": 10,
            "paginationType": "input",
            //"stateSave": true,
            // "serverSide": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'Con_configaration/showLocation',
                type: 'GET'
            },
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center text-center',
                "width": "4%",
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox" name="lCheck" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            'order': [
                [1, 'asc']
            ]

        });
        $("#new_location").wrap('<div class="overflow-x"> </div>');
        /* datatable for contact employee by employee ends */

        // Handle click on "Select all" control
        $('#new_location-table-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = locationDatatable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
           
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#new_location tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#new_location-table-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if (el && el.checked && ('indeterminate' in el)) {
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
            
        });

        $("#delete_location_forms").submit(function (event) {
            loading_box(base_url);

            var url = $(this).attr('action');

            var location = [];
            var selectedLocation = locationDatatable.$('input[type="checkbox"]').serializeArray();
            selectedLocation .forEach(function(item, key) {
                location.push(item.value);
            });

            // Include extra data if necessary
            var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "lCheck").val(location.join());
            $('#delete_location_forms').append(input);
            
            $.ajax({
                url: url,
                data: $("#delete_location_forms").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                //$("#location_div").load(location.href + " #location_div");
                //var url='<?php echo base_url() ?>Con_configaration/edit_company_setting';
                var url = '';
                view_message(data,url,'','delete_location_forms');

                setTimeout(function(){ 
                        reload_table('#new_location');
                    }, 4000);
            });
            event.preventDefault();
        });


    });

    $("#checkBoxID").click(function() {
        $("#buttonID").attr("disabled", !this.checked);
    });

</script>