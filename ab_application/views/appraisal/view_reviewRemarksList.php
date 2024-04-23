
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="box-sizing:border-box">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_ReviewRemarks/edit_overallReviewRemarks/" . $this->uri->segment(3); ?>"><span class="glyphicon glyphicon-edit"></span> Overall Review Setting</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered dt-responsive table-hover nowrap">                                                
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Competency Name</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            $i = 0;
                            foreach ($query->result() as $row) {
                                echo "<tr>";
                                echo "<td>" . ++$i . "</td>";
                                echo "<td>" . $row->com_name . "</td>";
                                echo "<td>" . $this->hr_appraisal_model->get_eval_catgory_by_comId($row->com_id) . "</td>";
                                echo "<td>"
                                . "<div class='action-buttons '>"
                                . "<a title='Edit' href='" . base_url() . "Con_ReviewRemarks/edit_reviewRemarks/" . $row->com_id . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>"
                                /* . "<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->com_id . ")'><i class='fa fa-trash-o'></i></a>" */
                                . "</div>"
                                . "</td>";
                                echo "</tr>";
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
