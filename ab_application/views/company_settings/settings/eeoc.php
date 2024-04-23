<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="eeoccategories_div">
        <button class="btn btn-u btn-md" onClick="add_eeoccategories()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
       <!--  <div class="overflow-x" style=" overflow-y: scroll; margin-bottom: 12px; max-height: 800px; "> -->
            <table id="dataTables-example-eeoccategories" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
                <colgroup>
                    <col width="5%">
                    <col width="35%">
                    <col width="50%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>SL </th>
                        <th>EEOC Categories</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $company_data = $this->session->userdata('company');
                    $this->company_settings_id = $company_data['company_settings_id'];

                    $query = $this->db->get_where('main_eeoc_categories', array('company_id' => $this->company_settings_id, 'isactive' => 1));
                    //echo $this->db->last_query();

                    if ($query) {
                        $i = 0;
                        foreach ($query->result() as $row) {
                            $i++;
                            $pdt = $row->id;
                            print"<tr>";
                            print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                            print"<td id='catB" . $pdt . "'>" . ucwords($row->eeoc_categories) . "</td>";
                            print"<td class='eeoc' id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
                            print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_eeoc(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_eeoc(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                            print"</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
       <!--  </div> -->
    </div>
    <!-- end data table -->
</div>

<!-- Modal -->
<div class="modal fade" id="eeoc_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add EEOC</h4>
            </div>
            <form id="eeoc_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_eeoc" id="id_eeoc"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">EEOC Categories<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="eeoc_categories" id="eeoc_categories" class="form-control input-sm" placeholder="EEOC Categories " />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control input-sm capitalize" rows="2" id="description" name="description" placeholder="EEOC Categories"></textarea>
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
<style type="text/css">
    td.eeoc{white-space:normal !important}
</style>
<script type="text/javascript">
    
    $(document).ready(function () {
         $('#dataTables-example-eeoccategories').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });

    var save_method; //for save method string
    var table;
    function add_eeoccategories()
    {
        save_method = 'add';
        $('#eeoc_form')[0].reset(); // reset form on modals
        $('#eeoc_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add EEOC'); // Set Title to Bootstrap modal title
    }
    
    
    
</script>