
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "con_EmpCandidateScreening/add_EmpCandidateScreening" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Screening</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                   <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="30%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Screening Types</th>
                            <th>Agency</th>
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
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->employee_id,'main_employees','first_name') . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this,$row->screening_types,'main_screening_types','screening_type') . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this,$row->agency_id,'main_agencies','agency_name') . "</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url(). "con_EmpCandidateScreening/edit_EmpCandidateScreening/" . $row->id . "/" . "' title='Edit'><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(" . $row->id . ")' title='Delete'><i class='fa fa-trash-o'></i></a></div> </td>";
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

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "con_EmpCandidateScreening/delete_EmpCandidateScreening/" + id;
        else
            return false;
    }


</script>
<!--=== End Content ===-->

