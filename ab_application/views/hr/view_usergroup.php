
        <div class="col-md-10 main-content-div">
            <div class="main-content">
                <div class="container conbre">
                    <ol class="breadcrumb">
                        <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                        <li class="active"><?php echo $page_header; ?></li>
                    </ol>
                </div>

                <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
                    <!-- data table starts -->
                    <div class="table-responsive col-md-12 col-centered">
                        <?php if ($this->KurunthamModel->checkUserGroupCreateAccess()): ?>
                            <a class="btn btn-u btn-md" href="<?php echo base_url() . "con_UserGroup/add_UserGroup" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                        <?php endif; ?>
                        <?php if ($this->KurunthamModel->isSuperAdmin()): ?>
                            <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                                <colgroup>
                                    <col width="1%">
                                    <col width="50%">
                                    <col width="50%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Group Name</th>
                                        <th>Description</th>
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if ($query) {
                                            foreach ($query->result() as $row) {
                                                $pdt = $row->id;
                                                print "<tr>";
                                                print "<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                                print "<td id='catB" . $pdt . "'>" . ucwords($row->group_name) . "</td>";
                                                print "<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
                                                // print "<td><div class='action-buttons '><a href='" . base_url() . "con_UserGroup/edit_entry/" . $row->id . "/" . $row->group_name . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                                print "</tr>";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php elseif ($this->KurunthamModel->isCompanyAdmin()): ?>
                            <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                                <colgroup>
                                    <col width="1%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="50%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Group Name</th>
                                        <th>Alias Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if ($query) {
                                            foreach ($query->result() as $row) {
                                                $pdt = $row->id;
                                                print "<tr>";
                                                print "<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                                print "<td id='catB" . $pdt . "'>" . ucwords($row->group_name) . "</td>";
                                                print "<td id='catB" . $pdt . "'>" . ucwords($row->alias_name) . "</td>";
                                                print "<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
                                                print "<td><div class='action-buttons '><a href='" . base_url() . "con_UserGroup/edit_entry/" . $row->id . "/" . $row->group_name . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                                print "</tr>";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    <!-- end datatable ends -->
                    </div>
                </div>
            </div>
        </div>

    </div><!--/row-->
</div><!--/container-->

<!-- scripts starts -->
<script type="text/javascript">
    var url="<?php echo base_url();?>";
    function delete_data(id){
        var r=confirm("Do you want to delete this?")
        if (r == true)
            window.location = url+"con_UserGroup/delete_entry/"+id;
        else
            return false;
        }
</script>
<!-- scripts ends -->
