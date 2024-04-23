
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "con_AssetsName/add_AssetsName" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                      <colgroup>
                        <col width="5%">
                        <col width="25%">
                        <col width="20%">
                        <col width="20%">
                        <col width="30%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL </th>                            
                            <th>Asset Name</th>
                            <th>Asset Type</th>
                            <th>Asset Category</th>
                            <th>Asset Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if ($query) {
                            $i=0;
                            foreach ($query->result() as $row) {
                                $i++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->asset_name . "</td>";
                                print"<td id='catC" . $pdt . "'>" . $this->Common_model->get_name($this,$row->asset_type_id,'main_assets_type','asset_type') . "</td>";
                                print"<td id='catC" . $pdt . "'>" . $this->Common_model->get_name($this,$row->asset_category_id,'main_assets_category','asset_category') . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->description . "</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_AssetsName/edit_AssetsName/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                print"</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script type="text/javascript">

    var url = "<?php echo base_url(); ?>";
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "Con_AssetsName/delete_AssetsName/" + id;
        else
            return false;
    }

</script>