<div class="row">
    <!-- data table -->
        <div class="table-responsive col-md-12 col-centered" id="apisetting_div">
            <button class="btn btn-u btn-md" onClick="add_apisetting()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
            <table id="dataTables-example-apisetting" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
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
                        <th>ACCOUNTANT</th>
                        <th>SITE</th>
                        <!--<th>API SECRET</th>-->
                        <th>API SECRET TYPE</th> 
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $company_data = $this->session->userdata('company');
                    $this->company_settings_id = $company_data['company_settings_id'];

                    $api_secret_type_array = $this->Common_model->get_array('api_secret_type');
                    $query = $this->db->get_where('main_apisetting', array('company_id' => $this->company_settings_id, 'isactive' => 1));
                    //echo $this->db->last_query();

                    if ($query) {
                        $i = 0;
                        foreach ($query->result() as $row) {
                            $i++;
                            $pdt = $row->id;
                            print"<tr>";
                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                            print"<td id='catB" . $pdt . "'>" . $row->accountant . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $row->site . "</td>";
                            //print"<td id='catE" . $pdt . "'>" . $row->api_secret . "</td>";
                            print"<td id='catE" . $pdt . "'>" . $api_secret_type_array[$row->api_secret_type] . "</td>";
                            print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_apisetting(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_apisetting(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="apisetting_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add API Setting</h4>
            </div>
            <form id="apisetting_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="apisetting_id" id="apisetting_id"/>
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">API SECRET TYPE<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="secret_type" id="secret_type" class="col-sm-12 col-xs-8 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($api_secret_type_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">ACCOUNTANT<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="accountant" id="accountant" class="form-control input-sm" placeholder="Enter accountant number" data-toggle="tooltip" data-placement="bottom" title="Enter accountant number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">SITE<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="site" id="site" class="form-control input-sm" placeholder="Enter site number" data-toggle="tooltip" data-placement="bottom" title="Enter site number">
                        </div>
                        <label class="col-sm-2 control-label">API SECRET<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="api_secret" id="api_secret" class="form-control input-sm" placeholder="Enter api secret" data-toggle="tooltip" data-placement="bottom" title="Enter api secret">
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
         $('#dataTables-example-apisetting').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_apisetting()
    {
        save_method = 'add';
        $('#apisetting_form')[0].reset(); // reset form on modals
        $('#apisetting_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add API Setting'); // Set Title to Bootstrap modal title
    }
    
    $(function () {

        $("#secret_type").select2({
            placeholder: "API SECRET TYPE",
            allowClear: true,
        });

    });
    
</script>