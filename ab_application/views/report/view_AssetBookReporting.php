<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_AssetBookReporting/search_AssetBookReporting/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> From: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="action_from" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_from']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">To: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="action_to" class="form-control col-sm-12 dt_pick" value="<?php echo $search_criteria['action_to']; ?>" readonly="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Asset Type </label>
                                <div class="col-sm-8">
                                    <?php // print_r($search_criteria); exit; ?>
                                    <select name="asset_type_id" id="asset_type_id" onchange="load_asset_categori(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($asset_type->result() as $row) {
                                            $slct = ($search_criteria['asset_type_id'] == $row->id) ? 'selected' : '';
                                            print "<option value=" . $row->id . " " . $slct . ">" . $row->asset_type . "</option>";
                                        }
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Asset Category </label>
                                <div class="col-sm-8">
                                    <select name="asset_category_id" id="asset_category_id" onchange="load_asset_name(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($assets_category->result() as $row) {
                                            $slct = ($search_criteria['asset_category_id'] == $row->id) ? 'selected' : '';
                                            print"<option value=" . $row->id . " " . $slct . ">" . $row->asset_category . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Asset Name  </label>
                                <div class="col-sm-8">
                                    <select name="asset_name_id" id="asset_name_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($assets_name_query->result() as $row) {
                                            $slct = ($search_criteria['asset_name_id'] == $row->id) ? 'selected' : '';
                                            print"<option value=" . $row->id . " " . $slct . ">" . $row->asset_name . "</option>";
                                        }
                                        ?>
                                    </select>  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"> Value Min: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="min_value" class="form-control col-sm-12" value="<?php echo $search_criteria['min_value']; ?>"  autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Value Max: </label>
                                <div class="col-sm-8">
                                    <input type="text" name="max_value" class="form-control col-sm-12" value="<?php echo $search_criteria['max_value']; ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Status </label>
                                <div class="col-sm-8">
                                    <select name="isactive" id="isactive" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($status_array as $key=>$val):
                                            $slct = ($search_criteria['isactive'] == $key) ? 'selected' : '';
                                            ?>
                                            <option value="<?php echo $key ?>" <?php echo $slct; ?> ><?php echo $val; ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                    <button class="btn-u center-align" type='button' id='btn' onclick='printDiv();'> <i class="fa fa-print" aria-hidden="true"></i> PDF </button>
                                    <a href="#" class="btn-u center-align" onClick ="$('#print_to_Div').tableExport({type: 'excel', escape: 'false'});"><i class="fa fa-file-excel-o" aria-hidden="true"></i> XLS </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
                
                <div class="overflow-x" style="overflow-y: scroll; margin-bottom: 12px; max-height: 500px;">
                    <div id="print_to_Div">
                        <div>
                            <div class="col-md-3 col-xs-3">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div style="text-align: center; "> <h4> Asset Book Reporting </h4> </div>
                            </div>
                            <div class="col-md-3 col-xs-3">

                            </div>
                        </div>
                <table id="" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Asset Number</th>
                            <th>Asset Name</th>
                            <th>Category</th>
                            <th>Asset Type</th>
                            <th>Date of Purchase</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($search_data) {
                            $sl=0;
                            $total_value=0;
                            foreach ($search_data as $row) {
                               
                                $sl++; $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                ?>
                                <td><?php echo $row->asset_id ?></td>
                                <td><?php echo $this->Common_model->get_name($this,$row->asset_name_id,'main_assets_name','asset_name') ?></td>
                                <td><?php echo $this->Common_model->get_name($this,$row->asset_category_id,'main_assets_category','asset_category') ?></td>
                                <td><?php echo $this->Common_model->get_name($this,$row->asset_type_id,'main_assets_type','asset_type') ?></td>
                                <td><?php if($row->createddate) echo date("m-d-Y", strtotime($row->createddate)) ?></td>
                                <td><?php echo $row->value ?></td>
                                <?php
                                print"</tr>";
                                
                                $total_value+=$row->value;
                            }
                            
                            print"<tr>";
                                print"<td id='catA" . $pdt . "'></td>";
                                ?>
                                <td colspan="5" style=" text-align: right"> Total Value In USD </td>
                                <td><?php echo $total_value ?></td>
                                <?php
                                print"</tr>";
                        }
                        ?> 
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
    
    
    $("#isactive").select2({
        placeholder: "Select Status",
        allowClear: true
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
    
    function printDiv() {
        $.print("#print_to_Div");
    }
    
</script>
<!--=== End Content ===-->
