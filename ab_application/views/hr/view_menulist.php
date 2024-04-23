
    <div class="col-md-10 main-content-div">
        <div class="main-content">
            <div class="container conbre">
                <ol class="breadcrumb">
                    <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                    <li class="active"><?php echo $page_header; ?></li>
                </ol>
            </div>

            <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
                <!-- data table -->
                <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "con_MenuList/add_menulist" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap">                                                
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="20%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Menu Name</th>
                            <th>Menu Link</th>
                            <th>Module</th>
                            <th>Root Menu</th>
                            <th>Sequence</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            foreach ($query->result() as $row) {
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                print"<td id='catB" . $pdt . "'>" . ucwords($row->menu_name) . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->menu_link . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this,$row->module_id,'main_module','module_name'). "</td>";
                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this,$row->root_menu,'main_menu','menu_name') . "</td>";
                                print"<td style='text-align: right;' id='catE" . $pdt . "'>" . $row->sequence . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $status_array[$row->isactive] . " &nbsp;</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_MenuList/edit_entry/" . $row->id . "/" . $row->menu_name . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
                </div>
                <!-- end data table --> 
            </div>
        </div>
    </div>

</div><!--/row-->
</div><!--/container-->



<script type="text/javascript">
      
    function delete_data(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_MenuList/delete_entry/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                var url = '<?php echo base_url() ?>con_MenuList';
                view_message(data,url);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
          });
        }
        else
          return false;
      
    } 


</script>