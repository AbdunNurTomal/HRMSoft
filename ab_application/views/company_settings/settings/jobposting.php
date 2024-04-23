<div class="row">
    <!-- data table -->
        <div class="table-responsive col-md-12 col-centered" id="jobposting_div">
            <button class="btn btn-u btn-md" onClick="add_jobposting()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
            <table id="dataTables-example-jobposting" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
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
                        <th>job title</th>
                        <th>job type</th>
                        <th>location</th>
                        <th>posted</th>
                        <th>description</th>
                        <th>opening_date</th>
                        <th>deadline</th> 
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $company_data = $this->session->userdata('company');
                    $this->company_settings_id = $company_data['company_settings_id'];

                    $api_secret_type_array = $this->Common_model->get_array('api_secret_type');
                    $query = $this->db->get_where('main_job_posting', array('company_id' => $this->company_settings_id, 'isactive' => 1));
                    //echo $this->db->last_query();

                    if ($query) {
                        $i = 0;
                        foreach ($query->result() as $row) {
                            $i++;
                            $pdt = $row->id;
                            print"<tr>";
                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                            print"<td id='catB" . $pdt . "'>" . $row->job_title . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $row->job_type . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $row->location . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $row->posted . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $row->description . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $row->opening_date . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $row->deadline . "</td>";
                            print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_jobposting(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_apisetting(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="jobposting_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add API Setting</h4>
            </div>
            <form id="jobposting_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="jobposting_id" id="jobposting_id"/>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="job_title" id="job_title" class="form-control input-sm" placeholder="Enter accountant number" data-toggle="tooltip" data-placement="bottom" title="Enter title">
                        </div>
                        <label class="col-sm-2 control-label">Job Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="job_type" id="job_type" class="form-control input-sm" placeholder="Enter accountant number" data-toggle="tooltip" data-placement="bottom" title="Enter Job Type">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Location<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="location" id="location" class="form-control input-sm" placeholder="Enter location" data-toggle="tooltip" data-placement="bottom" title="Enter location">
                        </div>
                        <label class="col-sm-2 control-label">Posted<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="posted" id="posted" class="col-sm-12 col-xs-8 myselect2 input-sm">
                                <option value="1">Indeed</option>
                                <option value="2">Monster</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="description" id="description" class="form-control input-sm" placeholder="Enter description" data-toggle="tooltip" data-placement="bottom" title="Enter description">
                        </div>
                        <label class="col-sm-2 control-label">Opening Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="opening_date" id="opening_date" class="form-control input-sm" placeholder="Enter Opening Date" data-toggle="tooltip" data-placement="bottom" title="Enter Opening Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deadline<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="deadline" id="deadline" class="form-control input-sm" placeholder="Enter deadline" data-toggle="tooltip" data-placement="bottom" title="Enter deadline">
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
         $('#dataTables-example-jobposting').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_jobposting()
    {
        save_method = 'add';
        $('#jobposting_form')[0].reset(); // reset form on modals
        $('#jobposting_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Job Posting API'); // Set Title to Bootstrap modal title
    }
    
    $(function () {

        $("#secret_type").select2({
            placeholder: "API SECRET TYPE",
            allowClear: true,
        });

    });
    
</script>