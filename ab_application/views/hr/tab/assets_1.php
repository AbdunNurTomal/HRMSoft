<script>
function calculate_amount()
{
    var quantity = $('#quantity').val();
    var value = $('#value').val();

    var sum = parseInt(quantity) * parseInt(value);
    $('#total_value').val(sum);
}
</script>

<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered">
        <button class="btn btn-u btn-md" onClick="add_assets()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Issued Date</th>
                    <th>Retuned Date</th>
                    <th>Asset Type</th>
                    <th>Asset Name</th>
                    <th>Quantity</th>
                    <th>Value</th>
                    <th>Total Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $assets_query = $this->Common_model->listItem('main_assets');
                $assets_type_query = $this->Common_model->listItem('main_assets_type');
//                $query = $this->db->get_where('main_emp_assets', array('employee_id' => $employee_id));
//                if ($query) {
//                    $i = 0;
//                    foreach ($query->result() as $row) {
//                        $i++;
//                        $pdt = $row->id;
//                        print"<tr>";
//                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
//                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->show_date_formate($row->issued_date) . "</td>";
//                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->retuned_date) . "</td>";
//                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->asset_type_id, ' main_assets_type', 'asset_type') . "</td>";
//                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this, $row->asset_id, 'main_assets', 'asset_name') . "</td>";
//                        print"<td id='catE" . $pdt . "'>" . $row->quantity . "</td>";
//                        print"<td id='catB" . $pdt . "'>" . $row->value . "</td>";
//                        print"<td id='catE" . $pdt . "'>" . $row->total_value . "</td>";
//                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_assets(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_assets(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
//                        print"</tr>";
//                    }
//                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>




<!-- Modal -->
<div class="modal fade" id="assets_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Asset</h4>
            </div>
            <form id="emp_asset" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">    
                <input type="hidden" value="" name="id_emp_asset" id="id_emp_asset"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Issued Date</label>
                        <div class="col-sm-4">
                            <input type="text" name="issued_date" id="issued_date" class="form-control dt_pick input-sm" placeholder="Issued Date" data-toggle="tooltip" data-placement="bottom" title="Issued Date">
                        </div>
                        <label class="col-sm-2 control-label">Asset Type</label>
                        <div class="col-sm-4">
                            <select name="asset_type_id" id="asset_type_id" class="col-sm-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($assets_type_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->asset_type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Asset Category</label>
                        <div class="col-sm-4">
                            <select name="asset_category_id" id="asset_category_id" class="col-sm-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($assets_type_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->asset_type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <label class="col-sm-2 control-label">Asset</label>
                        <div class="col-sm-4">
                            <select name="asset_id" id="asset_id" class="col-sm-12 myselect2 input-sm" >
                                <option></option>
                               <?php foreach ($assets_query->result() as $row): ?>
                                    <option value="<?php echo $row->id ?>"><?php //echo $row->asset_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Asset Model No</label>
                        <div class="col-sm-4">
                            <select name="asset_model_id" id="asset_model_id" class="col-sm-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($assets_type_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->asset_type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Quantity</label>
                        <div class="col-sm-4">
                            <input type="text" name="quantity" id="quantity" class="form-control input-sm" onkeyup="calculate_amount()" placeholder="quantity" data-toggle="tooltip" data-placement="bottom" title="quantity" onkeypress="return numbersonly(this, event)">
                        </div>
                    </div>
                    <div class="form-group">
                        
                        <label class="col-sm-2 control-label">Value</label>
                        <div class="col-sm-4">
                            <input type="text" name="value" id="value" class="form-control input-sm" onkeyup="calculate_amount()" placeholder="value" data-toggle="tooltip" data-placement="bottom" title="value" onkeypress="return numbersonly(this, event)">
                        </div> 
                        <label class="col-sm-2 control-label">Total Value</label>
                        <div class="col-sm-4">
                            <input type="text" name="total_value" id="total_value" class="form-control input-sm" placeholder="Total Value" data-toggle="tooltip" data-placement="bottom" title="Total Value" readonly>
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
        $('#dataTables-example-assets').dataTable({
            "order": [ 0, "desc" ],
            "pageLength": 5,
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_assets()
    {
        save_method = 'add';
        $('#emp_asset')[0].reset(); // reset form on modals
        $('#assets_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Assets'); // Set Title to Bootstrap modal title
    }
    
    $(document).ready(function () {
        $('#asset_type_id').change(function () {
            var id = $(this).val(); 
            $.ajax({
                url: "<?php echo site_url('con_Employees/asset_type_filter/') ?>/" + id,
                async: false,
                type: "POST",
                success: function (data) {
                    $('#asset_id').html(data);
                }
            })
        });
    });  
    
    
    $("#asset_type_id").select2({
        placeholder: "Asset Type",
        allowClear: true,
    });
    $("#asset_id").select2({
        placeholder: "Asset",
        allowClear: true,
    });
    $("#asset_category_id").select2({
        placeholder: "Asset Category",
        allowClear: true,
    });
    $("#asset_model_id").select2({
        placeholder: "Asset Model Name",
        allowClear: true,
    });
    
</script>