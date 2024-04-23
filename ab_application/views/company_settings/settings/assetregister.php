<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_assetregister_div">
        <button class="btn btn-u btn-md" onClick="add_assetregister()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <div class="overflow-x" style="margin-bottom: 12px; max-height: 800px; ">
            <div id="ptr1">
                <table id="dataTables-example-assetregister" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>Asset Name</th>
                            <th>SL </th>
                            <th>Asset ID</th>                            
                            <th>Asset Type</th>
                            <th>Asset Category</th>
                            <th>Model Name</th>
                            <th>Value</th>
                            <th>Asset Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($this->user_group == 11 || $this->user_group == 12) {
                            $asset_type = $this->db->get_where('main_assets_type', array('company_id' => $this->company_id, 'isactive' => 1));
                        } else {
                            $asset_type = $this->db->get_where('main_assets_type', array('isactive' => 1));
                        }

                        $company_data = $this->session->userdata('company');
                        $this->company_settings_id = $company_data['company_settings_id'];

                        $this->db->select('main_asset_master.id,main_asset_master.asset_type_id,main_asset_master.asset_category_id,main_asset_master.asset_name_id,main_asset_master.quantity,'
                                . 'main_assets_detail.id as dtls_id,main_assets_detail.mid,main_assets_detail.asset_id,main_assets_detail.model_name,main_assets_detail.serial_no,main_assets_detail.value,main_assets_detail.description,main_assets_detail.IsAssigned');
                        $this->db->from('main_asset_master');
                        $this->db->join('main_assets_detail', 'main_asset_master.id = main_assets_detail.mid');
                        $this->db->where('main_asset_master.company_id', $this->company_settings_id);
                        $this->db->where('main_asset_master.isactive', 1);
                        $this->db->order_by('main_asset_master.id ');
                        $query = $this->db->get();
                        //echo $this->db->last_query();

                        if ($query) {
                            $i = 0;
                            $naua = $this->db->query("SELECT `mid`,count(`mid`) as ttl FROM `main_assets_detail` group by `mid`")->result_array();
                            $row_span = array();
                            foreach ($naua as $row_num) {
                                $row_span[$row_num['mid']] = $row_num['ttl'];
                            }
                          
                            
                            $same = '';
                            foreach ($query->result() as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <?php
                                    if ($row->mid != $same) {
                                        $same = $row->mid;
                                        ?>
                                        <td rowspan="<?php echo $row_span[$row->mid]; ?>"> 
                                        <!--<a href='<?php // echo base_url() . "Con_AssetsInformation/edit_AssetsInformation/" . $row->id . "/"  ?>' >-->
                                            <a href="#" onclick="edit_assetregister(<?php echo $row->id ?>)">
                                                <?php echo $this->Common_model->get_name($this, $row->asset_name_id, ' main_assets_name', 'asset_name') ?>  
                                            </a>
                                        </td>
                                        <?php
                                    }
                                    ?>                              
                                    <td rowspan=""><?php echo $i ?> </td>  
                                    <td><?php echo $row->asset_id ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->asset_type_id, 'main_assets_type', 'asset_type') ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->asset_category_id, 'main_assets_category', 'asset_category') ?></td>
                                    <td><?php echo $row->model_name ?></td>
                                    <td><?php echo $row->value ?></td>
                                    <td><?php echo $row->description ?></td>
                                    <td><?php
                                        if ($row->IsAssigned == 0) {
                                            echo ' Not Assign';
                                        } elseif ($row->IsAssigned == 1) {
                                            echo 'Assign';
                                        } elseif ($row->IsAssigned == 2) {
                                            echo 'Return';
                                        } elseif ($row->IsAssigned == 2) {
                                            echo 'writeoff';
                                        };
                                        ?></td>
                                    <td><div class='action-buttons'><a href="#" onclick="edit_asset_unique_register(<?php echo $row->id ?>,<?php echo $row->dtls_id ?>)" ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data("<?php echo $row->dtls_id ?>")'><i class='fa fa-trash-o'></i></a></div> </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="ptr" hidden>
                <table id="dataTables-example-assetregister" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>Asset Name</th>
                            <th>SL </th>
                            <th>Asset ID</th>                            
                            <th>Asset Type</th>
                            <th>Asset Category</th>
                            <th>Model Name</th>
                            <th>Value</th>
                            <th>Asset Description</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($this->user_group == 11 || $this->user_group == 12) {
                            $asset_type = $this->db->get_where('main_assets_type', array('company_id' => $this->company_id, 'isactive' => 1));
                        } else {
                            $asset_type = $this->db->get_where('main_assets_type', array('isactive' => 1));
                        }

                        $company_data = $this->session->userdata('company');
                        $this->company_settings_id = $company_data['company_settings_id'];

                        $this->db->select('main_asset_master.id,main_asset_master.asset_type_id,main_asset_master.asset_category_id,main_asset_master.asset_name_id,main_asset_master.quantity,'
                                . 'main_assets_detail.id as dtls_id,main_assets_detail.mid,main_assets_detail.asset_id,main_assets_detail.model_name,main_assets_detail.serial_no,main_assets_detail.value,main_assets_detail.description,main_assets_detail.IsAssigned');
                        $this->db->from('main_asset_master');
                        $this->db->join('main_assets_detail', 'main_asset_master.id = main_assets_detail.mid');
                        $this->db->where('main_asset_master.company_id', $this->company_settings_id);
                        $this->db->where('main_asset_master.isactive', 1);
                        $this->db->order_by('main_asset_master.id ');
                        $query = $this->db->get();
                        //echo $this->db->last_query();

                        if ($query) {
                            $i = 0;
                            $naua = $this->db->query("SELECT `mid`,count(`mid`) as ttl FROM `main_assets_detail` group by `mid`")->result_array();
                            $row_span = array();
                            foreach ($naua as $row_num) {
                                $row_span[$row_num['mid']] = $row_num['ttl'];
                            }
                            $same = '';
                            foreach ($query->result() as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <?php
                                    if ($row->mid != $same) {
                                        $same = $row->mid;
                                        ?>
                                        <td rowspan="<?php echo $row_span[$row->mid]; ?>"> 
                                        <!--<a href='<?php // echo base_url() . "Con_AssetsInformation/edit_AssetsInformation/" . $row->id . "/"  ?>' >-->
                                            <a href="#" onclick="edit_assetregister(<?php echo $row->id ?>)">
                                                <?php echo $this->Common_model->get_name($this, $row->asset_name_id, ' main_assets_name', 'asset_name') ?>  
                                            </a>
                                        </td>
                                        <?php
                                    }
                                    ?>                              
                                    <td rowspan=""><?php echo $i ?> </td>  
                                    <td><?php echo $row->asset_id ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->asset_type_id, 'main_assets_type', 'asset_type') ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->asset_category_id, 'main_assets_category', 'asset_category') ?></td>
                                    <td><?php echo $row->model_name ?></td>
                                    <td><?php echo $row->value ?></td>
                                    <td><?php echo $row->description ?></td>
                                    <td><?php
                                        if ($row->IsAssigned == 0) {
                                            echo ' Not Assign';
                                        } elseif ($row->IsAssigned == 1) {
                                            echo 'Assign';
                                        } elseif ($row->IsAssigned == 2) {
                                            echo 'Return';
                                        } elseif ($row->IsAssigned == 2) {
                                            echo 'writeoff';
                                        };
                                        ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">                    
        <div class="col-md-6 col-sm-6 find_mar" style="text-align: right;">                    
            <input class="btn btn-default" type='button' id='btn' value='Print' onclick='printDiv();'>
        </div>
    </div>
    <!-- end data table -->
</div>

<!-- Modal -->
<div class="modal fade" id="assetregister_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Asset Register</h4>
            </div>
            <form id="assetregister_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="asset_mst_id" id="asset_mst_id"/>
                <input type="hidden" value="" name="assetname_id" id="assetname_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asset Type</label>
                        <div class="col-sm-4">
                            <select name="asset_type_id" id="asset_type_id" onchange="load_asset_categori(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($asset_type->result() as $row) {
                                    print"<option value=" . $row->id . ">" . $row->asset_type . "</option>";
                                }
                                ?>
                            </select>    
                        </div>
                        <label class="col-sm-2 control-label">Asset Category</label>
                        <div class="col-sm-4">
                            <select name="asset_category_id" id="asset_category_id" onchange="load_asset_name(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="asset_name_load">
                            <label class="col-sm-2 control-label">Asset Name</label>
                            <div class="col-sm-4" >
                                <select name="asset_name_id" id="asset_name_id" onchange="set_asset_name(this.value);"  class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <option></option>
                                </select>    
                            </div>
                        </div>
                        <h5 class="col-sm-1"><a onClick="add_asset_entry()" href="#"><span class="badge badge-u" style="margin-left: -20px">Add Asset</span></a></h5>
                        <label class="col-sm-1 control-label">Quantity</label>
                        <div class="col-sm-4">
                            <input type="text" name="quantity" id="quantity"  class="form-control input-sm" placeholder="Quantity" />
                        </div>
                    </div>

                    <div class="table-responsive col-md-12 col-centered">
                        <table id="mytable" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>                                        
                                    <th class="mycol">Sl</th>
                                    <th class="mycol">Asset Name</th>
                                    <th class="mycol">Model No</th>
                                    <th class="mycol">Serial No</th>
                                    <th class="mycol">Value in $</th>
                                    <th class="mycol">Description</th>                                        
                                    <th class="mycol">Action</th>
                                </tr>
                            </thead>
                            <tbody id="mytbody">
                                <tr id="tr_1">
                                    <td class="mycol">1<input type='hidden' value='' name='dtls_id[]' id='dtls_id_1'/></td>
                                    <td class="mycol"><input class="form-control input-sm" type="text" readonly name="asset_name[]" id="asset_name_1" value="" placeholder="Asset Name" /></td>
                                    <td class="mycol"><input class="form-control input-sm" type="text" name="model_name[]" id="model_name_1"  placeholder="Model name" /></td>
                                    <td class="mycol"><input class="form-control input-sm" type="text" name="serial_no[]" id="serial_no_1"  placeholder="Serial no" /></td>
                                    <td class="mycol"><input class="form-control input-sm" value="" type="text"  name="value[]" id="value_1" placeholder="Value in $" /></td>
                                    <td class="mycol"><input class="form-control input-sm" type="text"name="description[]" id="description_1" placeholder="Description" /></td>
                                    <td class="mycol" id="action_td" style="width: 12%; "><a class="btn btn-sm btn-u" name="add" id="add_1" title="Add" onclick="add_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>&nbsp;<a class="btn btn-sm btn-danger" id="remove_1" title="Delete"  onclick="remove_row(1);"><i class="glyphicon glyphicon-minus" ></i></a></td>
                                </tr>
                            </tbody>
                        </table>
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

<!-- Asset Add Modal -->

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
                        <label class="col-sm-2 control-label">Asset Type<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <select name="aasset_type" onchange="load_aasset_categori(this.value);" id="aasset_type" class="col-sm-12 col-xs-8 myselect2">
                                <option></option>
                                <?php
                                foreach ($asset_type->result() as $row) {
                                    print"<option value=" . $row->id . ">" . $row->asset_type . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                        <label class="col-sm-2 control-label">Asset Category<span class="req"/></label>
                        <div class="col-sm-4">                            
                            <select name="aasset_category" id="aasset_category" class="col-sm-12 col-xs-8 myselect2">
                                <option></option>
                            </select>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asset Name<span class="req"/> </label>
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

<script type="text/javascript">

//    function handleChange() {
//        var myValue = document.getElementById("value_1").value;
//
//        if (myValue.indexOf("$") != 0)
//        {
//            myValue = "$" + myValue;
//        }
//
//        document.getElementById("name").value = myValue;
//    }
//  }
//    .value_1:before, .value_1::before {
//  content: '$';

//var test = document.getElementById("value_1");
//document.write("$"+test.value);


    var save_method; //for save method string
    var table;
    function add_assetregister()
    {
        save_method = 'add';
        $('#assetregister_form')[0].reset(); // reset form on modals

//        $('[name="asset_name"]').val('');
//        $('[name="model_name"]').val('');
//        $('[name="serial_no"]').val('');
//        $('[name="value"]').val('');
//        $('[name="description"]').val('');        
//        $('[name="add"]').val('');        

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

        $('#assetregister_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Asset Register'); // Set Title to Bootstrap modal title
    }

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
    $("#aasset_type").select2({
        placeholder: "Asset Type",
        allowClear: true,
    });
    $("#aasset_category").select2({
        placeholder: "Asset Category",
        allowClear: true,
    });

    function load_aasset_categori(id) {
        //alert(id);
        $.ajax({
            url: "<?php echo site_url('Con_configaration/load_asset_category/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#asset_category_id').html('');
                $('#asset_category_id').empty();

                $('#aasset_category').html(data);
            }
        });
    }
    function load_asset_categori(id) {
        $.ajax({
            url: "<?php echo site_url('Con_configaration/load_asset_category/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#asset_category_id').html('');
                $('#asset_category_id').empty();

                $('#asset_category_id').html(data);
            }
        })
    }

    function load_asset_name(id) {
        $.ajax({
            url: "<?php echo site_url('Con_configaration/load_asset_name/') ?>/" + id,
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

    function set_asset_name(id) {
        $.ajax({
            url: "<?php echo site_url('Con_configaration/asset_name_find/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#asset_name_1').val(data);
            }
        })
    }

    function add_row(i) {

        var rowCount = $('#mytbody tr').length;
        var qty = $('#quantity').val();

        if ($('#asset_type_id').val() == "" || $('#asset_type_id').val() == " ")
        {
            alert('Asset Type Can not be empty.');
            $('#asset_type_id').focus();
            return;
        } else if ($('#asset_category_id').val() == "" || $('#asset_category_id').val() == " ")
        {
            alert('Asset Category Can not be empty.');
            $('#asset_category_id').focus();
            return;
        } else if ($('#asset_name_id').val() == "" || $('#asset_name_id').val() == " ")
        {
            alert('Asset Name Can not be empty.');
            $('#asset_name_id').focus();
            return;
        } else if ($('#quantity').val() == "" || $('#quantity').val() == " ")
        {
            alert('Asset Quantity Can not be empty.');
            $('#quantity').focus();
            return;
        } else if ($('#model_name_' + rowCount).val() == "" || $('#model_name_' + rowCount).val() == " ")
        {
            alert('Modal Name Can not be empty.');
            $('#model_name_' + rowCount).focus();
            return;
        } else if ($('#serial_no_' + rowCount).val() == "" || $('#serial_no_' + rowCount).val() == " ")
        {
            alert('Serial Number Can not be empty.');
            $('#serial_no_' + rowCount).focus();
            return;
        } else if ($('#value_' + rowCount).val() == "" || $('#value_' + rowCount).val() == " ")
        {
            alert('Value Can not be empty.');
            $('#value_' + rowCount).focus();
            return;
        } else
        {
            var asset_name = $('#asset_name_' + rowCount).val();
            rowCount++;

            if (rowCount <= qty) {
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

            $('#asset_name_' + rowCount).val(asset_name);
        }
    }

    function  remove_row(i) {

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

        $("#aasset_type").select2({
            placeholder: "Asset Type",
            allowClear: true,
        });
        $("#aasset_category").select2({
            placeholder: "Asset Category",
            allowClear: true,
        });

        $('#asset_Modal_entry').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Asset'); // Set Title to Bootstrap modal title

    }

    function printDiv() {
        $.print("#ptr");
    }
    ;
</script>