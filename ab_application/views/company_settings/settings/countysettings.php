<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered">
        <button class="btn btn-u btn-md" onClick="add_countysettings()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-countysettings" class="table table-striped table-bordered dt-responsive table-hover">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>County Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $this->db->get_where('main_county', array('company_id' => $this->company_id,'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . ucwords($row->county_name) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>"; 
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_countysettings(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_countysettings(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="countysettings_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Relationship Status</h4>
            </div>
            <form id="countysettings_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="countysettings_id" id="countysettings_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">County Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="county_name" id="county_name" class="form-control input-sm" placeholder="County Name" />
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
         $('#dataTables-example-countysettings').dataTable({
            "order": [ 0, "desc" ],
            "pageLength": 5,
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_countysettings()
    {
        save_method = 'add';
        $('#countysettings_form')[0].reset(); // reset form on modals
        $('#countysettings_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add County Name'); // Set Title to Bootstrap modal title
    }
    
    
</script>