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
    <div class="table-responsive col-md-12 col-centered" id="asset_div">
        <button class="btn btn-u btn-md" onClick="add_assets()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-assets" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
           <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="15%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup> 
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Issued Date</th>
                    <th>Returned Date</th>
                    <th>Asset Id</th>
                    <th>Asset</th>
                    <th>Quantity</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if($this->user_group==11 || $this->user_group==12)
                {
                    $assets_type_query=$this->db->get_where('main_assets_type', array('company_id' => $this->company_id,'isactive' => 1));
                }
                else {
                    $assets_type_query=$this->db->get_where('main_assets_type', array('isactive' => 1));
                }
                $assets_query = $this->Common_model->listItem('main_assets');
                $query = $this->db->get_where('main_emp_assets', array('employee_id' => $employee_id,'isactive' => 1));
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        ?>
                        <tr>
                            <td> <?php echo $i ?> </td>
                            <td ><?php echo $this->Common_model->show_date_formate($row->issued_date) ?></td>
                            <td >
                                <?php if($row->IsAssigned!=2){
                                    echo 'Assigned';
                                        }else{
                                            echo $this->Common_model->show_date_formate($row->retuned_date);                                            
                                        }
                                    ?>
                            </td>
                            <td ><?php echo $this->Common_model->get_name($this, $row->asset_model_id, ' main_assets_detail', 'asset_id') ?></td>
                            <td><?php echo $this->Common_model->get_name($this, $row->asset_id, 'main_assets_name', 'asset_name') ?></td>
                            <td><?php echo $row->quantity ?></td>
                            <td><?php echo $row->value ?></td>
                            <td><?php if($row->IsAssigned==1){echo "Assigned";} else if($row->IsAssigned==2){echo "Return";} ?></td>
                            <td>
                                <div class='action-buttons '>
                                    <a href='javascript:void()' title="Edit" onclick='edit_assets("<?php echo $row->id ?>")'><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>
                                    <a href='javascript:void(0)' title="Delete" onclick='delete_data_assets("<?php echo $row->id ?>")'><i class='fa fa-trash-o'>&nbsp;&nbsp;</i></a>
                                    <?php if($row->IsAssigned!=2){?>
                                    <a href='javascript:void()' onclick='return_assets("<?php echo $row->id ?>")'><span title="Return" class="glyphicon glyphicon-share-alt">&nbsp;&nbsp;</span></a>
                                    <?php } else{?>
                                    <a><span title="Return" class="glyphicon glyphicon-share-alt">&nbsp;&nbsp;</span></a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        
              <?php
              }
                }
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
                <h4 class="modal-title" id="myModalLabel">Assign New Asset</h4>
            </div>
            <form id="emp_asset" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">    
                <input type="hidden" value="" name="id_emp_asset" id="id_emp_asset"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Issued Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="issued_date" id="issued_date" class="form-control dt_pick input-sm" placeholder="Issued Date" data-toggle="tooltip" data-placement="bottom" title="Issued Date">
                        </div>
                        <label class="col-sm-2 control-label">Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="asset_type_id" id="asset_type_id" onchange="load_asset_categori(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($assets_type_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->asset_type ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-4">
                            <select name="asset_category_id" id="asset_category_id" onchange="load_asset_name(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <
                            </select>
                        </div>
                        
                        <label class="col-sm-2 control-label">Asset</label>
                        <div class="col-sm-4">
                            <select name="asset_id" id="asset_id" onchange="load_model_id(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Model No<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="asset_model_id" id="asset_model_id" onchange="load_asset_value(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Quantity</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="quantity" id="quantity" class="form-control input-sm" value="1" onkeyup="calculate_amount()" placeholder="quantity" data-toggle="tooltip" data-placement="bottom" title="quantity" onkeypress="return numbersonly(this, event)">
                        </div>
                    </div>
                    <div class="form-group">
                        
                        <label class="col-sm-2 control-label">Value</label>
                        <div class="col-sm-4">
                            <input type="text" name="value" readonly id="value" class="form-control input-sm" onkeyup="calculate_amount()" placeholder="value" data-toggle="tooltip" data-placement="bottom" title="value" onkeypress="return numbersonly(this, event)">
                        </div> 
<!--                        <label class="col-sm-2 control-label">Total Value</label>
                        <div class="col-sm-4">
                            <input type="text" name="total_value" id="total_value" class="form-control input-sm" placeholder="Total Value" data-toggle="tooltip" data-placement="bottom" title="Total Value" readonly>
                        </div>-->
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


<div class="modal fade" id="assets_return_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Return Asset</h4>
            </div>
            <form id="return_asset" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">    
                <input type="hidden" value="" name="id_emp_asset" id="id_emp_asset"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Return Date</label>
                        <div class="col-sm-4">
                            <input type="text" name="retuned_date" id="retuned_date" class="form-control dt_pick input-sm" placeholder="Return Date" data-toggle="tooltip" data-placement="bottom" title="Issued Date">
                            <input type="text" name="emp_id" id="emp_id">
                            <input type="text" name="asset_model_id_r" id="asset_model_id_r" >
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
            "order": [ 0, "asc" ],
            "pageLength": 5,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_assets()
    {
        save_method = 'add';
        $('#emp_asset')[0].reset(); // reset form on modals
        
        $("#asset_type_id").select2({
            placeholder: "Select Asset Type",
            allowClear: true,
        });
        $("#asset_id").select2({
            placeholder: "Select Asset",
            allowClear: true,
        });
        $("#asset_category_id").select2({
            placeholder: "Select Asset Category",
            allowClear: true,
        });
        $("#asset_model_id").select2({
            placeholder: "Select Asset Model Name",
            allowClear: true,
        });
    
        $('#assets_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Assign New Asset'); // Set Title to Bootstrap modal title
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
    
    function load_asset_categori(id)
    {
        $.ajax({
            url: "<?php echo site_url('con_Employees/load_asset_category/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#asset_category_id').html('');
                $('#asset_category_id').empty();
        
                $('#asset_category_id').html(data);
            }
        })
    }
            
    function load_asset_name(id)
    {
        $.ajax({
            url: "<?php echo site_url('con_Employees/load_asset_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                //alert (data);
                
                $('#asset_id').html('');
                $('#asset_id').empty();
                
                $('#asset_id').html(data);

            }
        })
    } 
    function load_model_id(id)   
    {
        //alert (id);
        $.ajax({
            url: "<?php echo site_url('Con_Employees/load_model_id/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
//                alert (data);                
                $('#asset_model_id').html('');
                $('#asset_model_id').empty();
                
                $('#asset_model_id').html(data);
            }
        });
    } 
    function load_asset_value(id)
    {
        $.ajax({
            url: "<?php echo site_url('con_Employees/load_asset_value/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
               $('#value').val(data);
               
               var quantity = $('#quantity').val();
               var value = $('#value').val();

                    var sum = parseInt(quantity) * parseInt(value);
                    $('#total_value').val(sum);
            }
        });
    } 
    
    function return_assets(id)
    {
        save_method = 'update';
        $('#return_asset')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/get_return_asset/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
//                alert(data.id);
                $('[name="retuned_date"]').val(data.retuned_date);
                $('[name="emp_id"]').val(data.id);
                $('[name="asset_model_id_r"]').val(data.asset_model_id);
                
                $('#assets_return_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Return Asset'); // Set title to Bootstrap modal title
            }
            
        });
    }
    
    $("#asset_type_id").select2({
        placeholder: "Select Asset Type",
        allowClear: true,
    });
    
    $("#asset_id").select2({
        placeholder: "Asset",
        allowClear: true,
    });
    
    $("#asset_category_id").select2({
        placeholder: "Select Asset Category",
        allowClear: true,
    });
    
    $("#asset_model_id").select2({
        placeholder: "Select Asset Model Name",
        allowClear: true,
    });
    
</script>