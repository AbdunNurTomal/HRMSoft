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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_ObI9/add_ObI9" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="1%">
                        <col width="15%">
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
                            <th>SL</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Apt.Number</th>
                            <th>City</th>
                            <th>Zip code</th>
                            <th>E-mail</th>
                            <th>Tel Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            $i = '';
                            foreach ($query->result() as $row) {
                                $i++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->fast_name . ' ' . $row->last_name . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->address . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->apt_number . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->city_town . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->zip_code . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->email_address . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->telephone_number . "</td>";
                                print"<td><div class='action-buttons'>"
                                        . "<a href='" . base_url() . "Con_ObI9/download_pdf/" . $row->id . "' ><i class='fa fa-lg fa-download'>&nbsp;&nbsp;</i></a>"
                                        . "<a href='" . base_url() . "Con_ObI9/edit_entry/" . $row->id . "' ><i class='fa fa-lg fa-pencil-square-o'>&nbsp;&nbsp;</i></a>"
                                        . "<a href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-lg fa-trash-o'></i></a>"
                                        . "</div> </td>";
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
            window.location = url + "Con_ObI9/delete_entry/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->

