<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px; padding-top: 50px;">
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_AssetsInformation/save_AssetsInformation" enctype="multipart/form-data" role="form" >
                   <div class="col-md-10 col-md-offset-1">
                    <input type="hidden" value="" name="id"/>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asset Type </label>
                        <div class="col-sm-4">                            
                            <select name="asset_type_id" id="asset_type_id" onchange="load_asset_categori(this.value);" class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                                <?php
                                foreach ($asset_type->result() as $row) {
                                    print"<option value=" . $row->id . ">" . $row->asset_type . "</option>";
                                }
                                ?>
                            </select>                       
                        </div>
                        
                        <label class="col-sm-2 control-label"> Asset Category </label>
                        <div class="col-sm-4">                            
                            <select name="asset_category_id" id="asset_category_id" onchange="load_asset_name(this.value);" class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asset Name</label>
                        <div class="col-sm-4">                            
                            <select name="asset_name_id" id="asset_name_id"  class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                            </select> 
                        </div>
                        
                        <h5 class="col-sm-1"><a onClick="add_asset_entry()" href="#"><span class="badge badge-u" style="margin-left: -20px">Add Asset</span></a></h5>
                        <label class="col-sm-1 control-label">Quantity</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="quantity" id="quantity"  class="form-control" placeholder="Quantity" /> 
                        </div>
                    </div>
                    
                    <!-- data table -->
                    <div class="table-responsive col-md-12 col-centered">
                        <table id="mytable" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>                                        
                                    <th class="mycol">Sl</th>
                                    <th class="mycol">Asset Name</th>
                                    <th class="mycol">Model No</th>
                                    <th class="mycol">Serial No</th>
                                    <th class="mycol">Value</th>
                                    <th class="mycol">Description</th>                                        
                                    <th class="mycol">Action</th>
                                </tr>
                            </thead>
                            <tbody id="mytbody">
                                <tr id="tr_1">
                                    <td class="mycol">1</td>
                                    <td class="mycol"><input class="form-control input-sm" type="text" readonly name="asset_name[]" id="asset_name_1" value="" placeholder="Asset Name" /></td>
                                    <td class="mycol"><input class="form-control input-sm" type="text" name="model_name[]" id="model_name_1"  placeholder="Model name" /></td>
                                    <td class="mycol"><input class="form-control input-sm" type="text" name="serial_no[]" id="serial_no_1"  placeholder="Serial no" /></td>
                                    <td class="mycol"><input class="form-control input-sm" type="text" name="value[]" id="value_1" placeholder="Value" /></td>
                                    <td class="mycol"><input class="form-control input-sm" type="text"name="description[]" id="description_1" placeholder="Description" /></td>
                                    <td class="mycol">
                                        <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                        <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "con_AssetsInformation" ?>">Close</a>
                    </div>
                   </div>
                </form>
                <?php
            } else if ($type == 2) //edit
                {
                //print_r($query);
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_AssetsInformation/update_AssetsInformation" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Type </label>
                        <div class="col-sm-4">                            
                            <select disabled name="asset_type_id" id="asset_type_id" onchange="load_asset_categori(this.value);" class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                                <?php foreach ($asset_type->result() as $row1): ?>
                                            <option value="<?php echo $row1->id ?>"<?php if ($row->asset_type_id == $row1->id) echo "selected"; ?>><?php echo $row1->asset_type ?></option>
                                <?php endforeach; ?>
                            </select>                       
                        </div>
                        <label class="col-sm-2 control-label">Category </label>
                        <div class="col-sm-4">                            
                            <select disabled name="asset_category_id" id="asset_category_id" onchange="load_asset_name(this.value);" class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                                <?php foreach ($asset_category->result() as $row1): ?>
                                            <option value="<?php echo $row1->id ?>"<?php if ($row->asset_category_id == $row1->id) echo "selected"; ?>><?php echo $row1->asset_category ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asset Name</label>
                        <div class="col-sm-4">                            
                            <select disabled name="asset_name_id" id="asset_name_id"  class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                                <?php foreach ($asset_name->result() as $row1): ?>
                                            <option value="<?php echo $row1->id ?>"<?php if ($row->asset_name_id == $row1->id) echo "selected"; ?>><?php echo $row1->asset_name ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div> 
                        <label class="col-sm-2 control-label">Quantity</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="quantity" id="quantity" readonly value="<?php echo $row->quantity ?>"  class="form-control" placeholder="Quantity" /> 
                        </div>
                    </div>
                    
                    <!-- data table -->
                    <div class="table-responsive col-md-12 col-centered">
                        <table id="mytable" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>                                        
                                    <th class="mycol">Sl</th>
                                    <th class="mycol">Asset ID</th>
                                    <th class="mycol">Model No</th>
                                    <th class="mycol">Serial No</th>
                                    <th class="mycol">Value</th>
                                    <th class="mycol">Description</th>                                        
<!--                                    <th class="mycol">Action</th>-->
                                </tr>
                            </thead>
                            <tbody id="mytbody">
                                <?php
                                $i = 0;
                                $asset_query = $this->db->get_where('main_assets_detail', array('mid' => $row->id));
                                foreach ($asset_query->result() as $val):
                                    $i++;
                                    ?>
                                    <tr id="tr_<?php echo $i ?>">
                                        <input class="form-control input-sm" type="hidden" name="dtlid[]" id="dtlid_<?php echo $i ?>" value="<?php echo $val->id ?>"  />
                                        <td class="mycol"><?php echo $i ?></td>
                                        <td class="mycol"><input class="form-control input-sm" type="text" readonly name="asset_id[]" id="asset_id_<?php echo $i ?>" value="<?php echo $val->asset_id ?>" placeholder="Asset Name" /></td>
                                        <td class="mycol"><input class="form-control input-sm" type="text" name="model_name[]" id="model_name_<?php echo $i ?>" value="<?php echo $val->model_name ?>"  placeholder="Model name" /></td>
                                        <td class="mycol"><input class="form-control input-sm" readonly type="text" name="serial_no[]" id="serial_no_<?php echo $i ?>" value="<?php echo $val->serial_no ?>"  placeholder="Serial no" /></td>
                                        <td class="mycol"><input class="form-control input-sm" type="text" name="value[]" id="value_<?php echo $i ?>" value="<?php echo $val->value ?>" placeholder="Value" /></td>
                                        <td class="mycol"><input class="form-control input-sm" type="text"name="description[]" id="description_<?php echo $i ?>" value="<?php echo $val->description ?>" placeholder="Description" /></td>
 <!--                                       <td class="mycol">
                                            <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_row(<?php // echo $i ?>);"><i class="glyphicon glyphicon-plus" ></i></a>
                                            <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row(<?php // echo $i ?>);"><i class="glyphicon glyphicon-minus" ></i> </a>                                            
                                        </td>-->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "con_AssetsInformation" ?>">Close</a>
                    </div>
                    <?php endforeach; ?>
                    </div>
                </form>
                <?php
            }else if ($type == 3) //edit
                {
//                print_r($query);
                ?>            
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_AssetsInformation/update_AssetsUniqueInformation" enctype="multipart/form-data" role="form" >
                    <div class="col-md-10 col-md-offset-1">
                    <?php foreach ($query->result() as $row){ ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="mid"/>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Type </label>
                        <div class="col-sm-4">                            
                            <select disabled name="asset_type_id" id="asset_type_id" onchange="load_asset_categori(this.value);" class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                                <?php foreach ($asset_type->result() as $row1): ?>
                                            <option value="<?php echo $row1->id ?>"<?php if ($row->asset_type_id == $row1->id) echo "selected"; ?>><?php echo $row1->asset_type ?></option>
                                <?php endforeach; ?>
                            </select>                       
                        </div>
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-4">                            
                            <select disabled name="asset_category_id" id="asset_category_id" onchange="load_asset_name(this.value);" class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                                <?php foreach ($asset_category->result() as $row1): ?>
                                            <option value="<?php echo $row1->id ?>"<?php if ($row->asset_category_id == $row1->id) echo "selected"; ?>><?php echo $row1->asset_category ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asset Name</label>
                        <div class="col-sm-4">                            
                            <select disabled name="asset_name_id" id="asset_name_id"  class="col-sm-12 col-xs-12 myselect2">
                                <option></option>
                                <?php foreach ($asset_name->result() as $row1): ?>
                                            <option value="<?php echo $row1->id ?>"<?php if ($row->asset_name_id == $row1->id) echo "selected"; ?>><?php echo $row1->asset_name ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div> 
                        <label class="col-sm-2 control-label">Quantity</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="quantity" id="quantity" readonly value="1"  class="form-control" placeholder="Quantity" /> 
                        </div>
                    </div>
                <?php } ?>
                    <!-- data table -->
                    <div class="table-responsive col-md-12 col-centered">
                        <table id="mytable" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>                                        
                                    <th class="mycol">Sl</th>
                                    <th class="mycol">Asset ID</th>
                                    <th class="mycol">Model No</th>
                                    <th class="mycol">Serial No</th>
                                    <th class="mycol">Value</th>
                                    <th class="mycol">Description</th>                                        
<!--                                    <th class="mycol">Action</th>-->
                                </tr>
                            </thead>
                            <tbody id="mytbody">
                                <?php
//                                $i = 0;
//                                $asset_query = $this->db->get_where('main_assets_detail', array('id' => $dtlsid));
                                foreach ($dquery->result() as $val):
                                    
                                    ?>
                            <input type="hidden" value="<?php echo $val->id ?>" name="did"/>
                                    <tr>
                                        <td class="mycol"> 1 </td>
                                        <td class="mycol"><input class="form-control input-sm" type="text" readonly name="asset_id" id="asset_id" value="<?php echo $val->asset_id ?>" placeholder="Asset Name" /></td>
                                        <td class="mycol"><input class="form-control input-sm" type="text" name="model_name" id="model_name" value="<?php echo $val->model_name ?>"  placeholder="Model name" /></td>
                                        <td class="mycol"><input class="form-control input-sm" type="text" readonly name="serial_no" id="serial_no" value="<?php echo $val->serial_no ?>"  placeholder="Serial no" /></td>
                                        <td class="mycol"><input class="form-control input-sm" type="text" name="value" id="value" value="<?php echo $val->value ?>" placeholder="Value" /></td>
                                        <td class="mycol"><input class="form-control input-sm" type="text"name="description" id="description" value="<?php echo $val->description ?>" placeholder="Description" /></td>
 <!--                                       <td class="mycol">
                                            <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_row(<?php // echo $i ?>);"><i class="glyphicon glyphicon-plus" ></i></a>
                                            <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row(<?php // echo $i ?>);"><i class="glyphicon glyphicon-minus" ></i> </a>                                            
                                        </td>-->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "con_AssetsInformation" ?>">Close</a>
                    </div>
                    
                    </div>
                </form>
                <?php                
                }
            ?>
        </div>

    </div>
</div>
<div class="modal fade" id="asset_Modal_entry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Education</h4>
            </div>
            <form id="add_asset_entry" name="sky-form11" class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form" >
                <input type="hidden" value="" name="id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asset Type Name</label>
                        <div class="col-sm-4">                            
                            <select name="asset_type_id" id="asset_type" class="col-sm-12 col-xs-8 myselect2">
                                <option></option>
                                <?php
                                foreach ($asset_type->result() as $row) {
                                    print"<option value=" . $row->id . ">" . $row->asset_type . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                        <label class="col-sm-2 control-label">Asset Category Name</label>
                        <div class="col-sm-4">                            
                            <select name="asset_category_id" id="asset_category" class="col-sm-12 col-xs-8 myselect2">
                                <option></option>
                                <?php
//                                foreach ($asset_type->result() as $row) {
//                                    print"<option value=" . $row->id . ">" . $row->asset_type . "</option>";
//                                }
//                                
                                ?>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asset Name </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="asset_name" id="asset_name" class="form-control" placeholder="Asset Name" />
                        </div> 
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
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
</div><!--/row-->
</div><!--/container-->




<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {
            $('select').removeAttr('disabled');
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $('#sky-form11')[0].reset();
                
                var url = '<?php echo base_url() ?>con_AssetsInformation';
                view_message(data, url);
            });
            event.preventDefault();
        });
    });

    function load_asset_categori(id)
    {
        $.ajax({
            url: "<?php echo site_url('con_AssetsInformation/load_asset_category/') ?>/" + id,
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
            url: "<?php echo site_url('con_AssetsInformation/load_asset_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                //alert (data);
                
                $('#asset_name_id').html('');
                $('#asset_name_id').empty();
                
                $('#asset_name_id').html(data);

            }
        })
    } 
    
    $('#asset_name_id').change(function () {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('con_AssetsInformation/asset_name_find/') ?>/" + id,
                async: false,
                type: "POST",
                success: function (data) {
                    $('#asset_name_1').val(data);

                }
            })
        });
    



    function add_row(i)
    {
        var rowCount = $('#mytbody tr').length;
        var qty = $('#quantity').val();
        
        if ($('#asset_type_id').val() == "" || $('#asset_type_id').val() == " ")
        {
            alert('Asset Type Can not be empty.');
            $('#asset_type_id').focus();
            return;
        }
        else if ($('#asset_category_id').val() == "" || $('#asset_category_id').val() == " ")
        {
            alert('Asset Category Can not be empty.');
            $('#asset_category_id').focus();
            return;
        }
        else if ($('#asset_name_id').val() == "" || $('#asset_name_id').val() == " ")
        {
            alert('Asset Name Can not be empty.');
            $('#asset_name_id' + rowCount).focus();
            return;
        }
        else if ($('#model_name_' + rowCount).val() == "" || $('#model_name_' + rowCount).val() == " ")
        {
            alert('Modal Name Can not be empty.');
            $('#model_name_' + rowCount).focus();
            return;
        }
        else if ($('#serial_no_' + rowCount).val() == "" || $('#serial_no_' + rowCount).val() == " ")
        {
            alert('Serial Number Can not be empty.');
            $('#serial_no_' + rowCount).focus();
            return;
        }
        else if ($('#value_' + rowCount).val() == "" || $('#value_' + rowCount).val() == " ")
        {
            alert('Value Can not be empty.');
            $('#value_' + rowCount).focus();
            return;
        }
        else
        {
         var asset_name = $('#asset_name_'+rowCount).val();
         rowCount++;

         if(rowCount<=qty){
            $('#mytable').append(
                '<tr id="tr_' + rowCount + '">'
                + '<td>' + rowCount + '</td>'
                + '<td class="mycol"><input class="form-control input-sm" readonly type="text" name="asset_name[]" id="asset_name_' + rowCount + '"   placeholder="Asset Name"  /></td>'
                + '<td class="mycol"><input class="form-control input-sm" type="text" name="model_name[]" id="model_name_' + rowCount + '"  placeholder="Model name"   /></td>'
                + '<td class="mycol"><input class="form-control input-sm" type="text" name="serial_no[]" id="serial_no_' + rowCount + '"   placeholder="Serial no"  /></td>'
                + '<td class="mycol"><input class="form-control input-sm" type="text" name="value[]" id="value_' + rowCount + '"   placeholder="Value"  /></td>'
                + '<td class="mycol"><input class="form-control input-sm" type="text" name="description[]" id="description_' + rowCount + '"  autocomplete="off" placeholder="Description" /></td>'
                + '<td class="mycol">\n\
                    <a class="btn btn-sm btn-u" id="add_' + rowCount + '" title="Add" onclick="add_row(' + rowCount + ');"><i class="glyphicon glyphicon-plus" ></i></a>\n\
                    <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_row(' + rowCount + ');"><i class="glyphicon glyphicon-minus" ></i> </a>\n\
               </td>'
                + '</tr>'
                );
            }
            
            $('#asset_name_'+rowCount).val(asset_name);
        }
    }
    
    

    function  remove_row(i)
    {
        var rowCount = $('#mytbody tr').length;
        if (rowCount != 1)
        {
            $("#mytbody tr:last").remove();
            //$('#tr_' + i).remove();
        }
    }
    
    function add_asset_entry()
    {
        save_method = 'add';
        
        $('#add_asset_entry')[0].reset(); // reset form on modals
        $('#asset_Modal_entry').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Asset'); // Set Title to Bootstrap modal title
        
    }
    
    $(document).ready(function () {
        $('#asset_type').change(function () {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('con_AssetsName/asset_category_filter/') ?>/" + id,
                async: false,
                type: "POST",
                success: function (data) {
                    $('#asset_category').html(data);

                }
            })
        });
    });
    
    
    $(function(){
        $("#add_asset_entry" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_AssetsName/save_AssetsName') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_asset') ?>";
            }
                $.ajax({
                url: url,
                data: $("#add_asset_entry").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                    $('#add_asset_entry')[0].reset();
                    $('#asset_Modal_entry').modal('hide');
                  
                    var url='';
                    view_message(data,url);
              });
            event.preventDefault();
        });
    });

    

    $("#asset_type_id").select2({
        placeholder: "Asset Type",
        allowClear: true,
    });
    $("#asset_category_id").select2({
        placeholder: "Asset Category",
        allowClear: true,
    });
    $("#asset_name_id").select2({
        placeholder: "Asset Name",
        allowClear: true,
    });
    
    $("#asset_type").select2({
        placeholder: "Asset Type",
        allowClear: true,
    });
    $("#asset_category").select2({
        placeholder: "Asset Category",
        allowClear: true,
    });
</script>
<!--=== End Script ===-->

