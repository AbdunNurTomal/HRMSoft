
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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "con_AssetsInformation/add_AssetsInformation" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                <table id="" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                     <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="20%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL </th>
                            <th>Asset Name</th>
                            <th>Asset ID</th>                            
                            <th>Asset Type</th>
                            <th>Asset Category</th>
                            <th>Model Name</th>
                            <th>Value</th>
                            <th>Asset Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $this->db->select('main_asset_master.id,main_asset_master.asset_type_id,main_asset_master.asset_category_id,main_asset_master.asset_name_id,main_asset_master.quantity,'
                                . 'main_assets_detail.id as dtls_id,main_assets_detail.mid,main_assets_detail.asset_id,main_assets_detail.model_name,main_assets_detail.serial_no,main_assets_detail.value,main_assets_detail.description,main_assets_detail.IsAssigned');
                        $this->db->from('main_asset_master');
                        $this->db->join('main_assets_detail', 'main_asset_master.id = main_assets_detail.mid');
                        $this->db->order_by('main_asset_master.id ');
                        $query = $this->db->get();
                       //echo $this->db->last_query();
                        //$this->db->order_by('asset_name_id');                        
                        //$query = $this->db->get('main_assets');
                        
                        if ($query) {
                            $i = 0;

                            
                            $naua=$this->db->query("SELECT `mid`,count(`mid`) as ttl FROM `main_assets_detail` group by `mid`")->result_array();
                            $row_span=array();
                            foreach ($naua as $row_num ) {
                                $row_span[$row_num['mid']]=$row_num['ttl'];
                            }
                            
                            $same='';
                            foreach ($query->result() as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td rowspan=""><?php echo $i ?> </td><?php
                                    if($row->mid!=$same){
                                    $same=$row->mid;
                                    ?>
                                    <td rowspan="<?php echo $row_span[$row->mid]; ?>">
                                        <a href='<?php echo base_url() . "Con_AssetsInformation/edit_AssetsInformation/" . $row->id . "/" ?>' >
                                        <?php echo $this->Common_model->get_name($this, $row->asset_name_id, ' main_assets_name', 'asset_name') ?>  
                                        </a>
                                        </td>
                                   <?php 
                                    }
                                   ?>
                                    <td><?php echo $row->asset_id ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->asset_type_id, 'main_assets_type', 'asset_type') ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->asset_category_id, 'main_assets_category', 'asset_category') ?></td>
                                    <td><?php echo $row->model_name ?></td>
                                    <td><?php echo $row->value ?></td>
                                    <td><?php echo $row->description ?></td>
                                    <td><div class='action-buttons'><a href='<?php echo base_url(). "Con_AssetsInformation/edit_AssetsUniqueInformation/" . $row->id . "/" . $row->dtls_id . "/" ?>' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data("<?php echo $row->dtls_id ?>")'><i class='fa fa-trash-o'></i></a></div> </td>
                                </tr>
                                <?php
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
            window.location = url + "Con_AssetsInformation/delete_AssetsInformation/" + id;
        else
            return false;
    }

</script>