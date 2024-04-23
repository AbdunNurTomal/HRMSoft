<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_relationshipstatus_div">
        <button class="btn btn-u btn-md" onClick="add_relationshipstatus()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-relationshipstatus" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
               <col width="5%">
                <col width="35%">
                <col width="50%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Dependents</th>
                    <th>Description</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $query = $this->db->get_where('main_relationship_status', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catA" . $pdt . "'>" . ucwords($row->relationship_status) . "</td>";
                        print"<td id='catD" . $pdt . "'>" . ucwords($row->description) . "</td>";   
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_relationshipstatus(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_relationshipstatus(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="relationshipstatus_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Dependents</h4>
            </div>
            <form id="relationshipstatus_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="relationshipstatus_id" id="relationshipstatus_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Dependents <span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="relationship_status" id="relationship_status" class="form-control input-sm" placeholder="Dependents" />
                        </div>
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
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
        $('#dataTables-example-relationshipstatus').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_relationshipstatus()
    {
        save_method = 'add';
        $('#relationshipstatus_form')[0].reset(); // reset form on modals
        $('#relationshipstatus_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Dependents'); // Set Title to Bootstrap modal title
    }
    
    
</script>