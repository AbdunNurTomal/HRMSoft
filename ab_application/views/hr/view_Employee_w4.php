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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Employee_w4/add_Employee_w4" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Candidate Name</th>
                            <th>Location</th>
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
                                print"<td id='catB" . $pdt . "'>" . ucwords($row->first_middle_name . ' ' . $row->last_name) . "</td>";
                                print"<td id='catE" . $pdt . "'>" . ucwords($row->city_state_zip) . "</td>";
                                print"<td><div class='action-buttons'>"
                                        . "<a href='" . base_url() . "Con_Employee_w4/download_pdf/" . $pdt . "' ><i class='fa fa-lg fa-download'>&nbsp;&nbsp;</i></a>"
                                        . "<a href='" . base_url() . "Con_Employee_w4/edit_Employeew4/" . $pdt . "' ><i class='fa fa-lg fa-pencil-square-o'>&nbsp;&nbsp;</i></a>"
                                        . "<a href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-lg fa-trash-o'></i></a>"
                                        . "</div></td>";
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
            window.location = url + "Con_Employee_w4/delete_entry/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->

