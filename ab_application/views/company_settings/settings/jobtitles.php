<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="jobtitles_div">
        <button class="btn btn-u btn-md" onClick="add_jobtitles()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-jobtitles" class="table table-striped table-bordered dt-responsive table-hover">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Job Title Code</th>
                    <th>Job Title</th>
                    <th>Job Description</th>
                    <th>Job Pay Frequency</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $query = $this->db->get_where('main_jobtitles', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . ucwords($row->jobtitlecode) . "</td>";
                        print"<td id='catD" . $pdt . "'>" . ucwords($row->jobtitlename) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->jobdescription) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->jobpayfrequency, 'main_payfrequency', 'freqtype') . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_jobtitle(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_jobtitle(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="jobtitle_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Job Title</h4>
            </div>
            <form id="jobtitle_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="jobtitle_id" id="jobtitle_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Job Title </label>
                        <div class="col-sm-4">
                            <input type="text" name="jobtitlename" id="jobtitlename" class="form-control input-sm" placeholder="Job Title" />
                        </div>
                        <label class="col-sm-2 control-label">Job Title Code</label>
                        <div class="col-sm-4">
                            <input type="text" name="jobtitlecode" id="jobtitlecode" class="form-control input-sm" placeholder="Job Title Code" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Min Experience Required</label>
                        <div class="col-sm-4">
                            <input type="text" name="minexperiencerequired" id="minexperiencerequired" class="form-control input-sm" placeholder="Min Experience Required" />
                        </div> 
                        <label class="col-sm-2 control-label">Job Pay Grade Code</label>
                        <div class="col-sm-4">
                            <input type="text" name="jobpaygradecode" id="jobpaygradecode" class="form-control input-sm" placeholder="Job Pay Grade Code " />
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Job Pay Frequency</label>
                        <div class="col-sm-4">
                            <select name="jobpayfrequency" id="jobpayfrequency" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $payfrequency_query = $this->Common_model->listItem('main_payfrequency');
                                foreach ($payfrequency_query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->freqtype . "</option>";
                                }
                                ?>
                            </select>  
                        </div> 
                        <label class="col-sm-2 control-label">Job Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="jobdescription" name="jobdescription" placeholder="Job Description"></textarea>
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
         $('#dataTables-example-jobtitles').dataTable({
            "order": [ 0, "desc" ],
            "pageLength": 5,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_jobtitles()
    {
        save_method = 'add';
        $('#jobtitle_form')[0].reset(); // reset form on modals
        $('#jobtitle_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Job Titles'); // Set Title to Bootstrap modal title
    }
    
    $("#jobpayfrequency").select2({
        placeholder: "Job Pay Frequency",
        allowClear: true,
    });
    
    
</script>