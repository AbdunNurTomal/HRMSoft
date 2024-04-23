<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="department_divv">
        <button class="btn btn-u btn-md" onClick="add_department()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-department" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="40%">
                <col width="40%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Department Name</th>
                    <th>Description</th>                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php              

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
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
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
                        <label class="col-sm-2 control-label">Department Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="department_name" id="department_name" class="form-control input-sm" placeholder="Department Name" data-toggle="tooltip" data-placement="bottom" title="Department Name">
                        </div>
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
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
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
    
//    $("#department_location_id").select2({
//        placeholder: "Location ID",
//        allowClear: true,
//    });
//    $("#department_head").select2({
//        placeholder: "Department Head",
//        allowClear: true,
//    });
//    $("#department_time_zone").select2({
//        placeholder: "Time Zone",
//        allowClear: true,
//    });
//    $("#department_county_id").select2({
//        placeholder: "County ID",
//        allowClear: true,
//    });
//    $("#department_state_id").select2({
//        placeholder: "State ID",
//        allowClear: true,
//    });
//    
//    $(function() {
//        $("#department_zipcode").mask("99999");
//    });


</script>