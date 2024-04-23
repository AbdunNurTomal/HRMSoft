
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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_PtoPolicy/add_Pto_Policy" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID </th>
                            <th>Leave Code </th>
                            <th>Accrual Amt(hours)</th>
                            <th>Accrual period  </th>
                            <th>Start Days After Hire</th>
                            <th>Max Accrual</th>
                            <th>Max Available</th>
                            <th>Max Carryover</th>
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
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->leave_type, 'main_employeeleavetypes', 'leave_code') . "</td>";
                                print"<td id='catC" . $pdt . "'>" . $row->accrual_amt . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $accrual_period_array[$row->accrual_period] . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->start_days_after_hire . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->max_accrual . "</td>";
                                print"<td id='catC" . $pdt . "'>" . $row->max_available . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->max_carryover . "</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_PtoPolicy/edit_pto_policy/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
            window.location = url + "Con_PtoPolicy/delete_pto_policy/" + id;
        else
            return false;
    }

</script>