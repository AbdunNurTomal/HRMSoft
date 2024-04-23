
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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Exit_Interview/add_Exit_Interview" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Exit Interview</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                   <colgroup>
                        <col width="1%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                            <th>Termination Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($Exit_Data)) {
                            $i = 0;
                            foreach ($Exit_Data as $row) {
                                print"<tr>";
                                print"<td>" . ( ++$i) . "</td>";
                                print"<td>" . $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . "</td>";
                                print"<td>" . (($row['termination_type'] == 0) ? 'Voluntary' : 'Involuntary') . "</td>";
                                print"<td>" . date_from_timestamp($row['createddate'], 'm-d-Y') . "</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_Exit_Interview/edit_termination/" . $row['id'] . "/" . $row['termination_type'] . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data(" . $row['id'] . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
            window.location = url + "Con_EmployeeTabs/delete_entry/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->

