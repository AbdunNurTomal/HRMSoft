
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>


        <div class="container tag-box tag-box-v3" style="box-sizing:border-box">
            <div class="table-responsive col-md-12 col-centered">
                <!-- data table -->            
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_ReviewForm/add_reviewForm/" . $this->uri->segment(3); ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered dt-responsive table-hover nowrap">                                                
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Form Name</th>
                            <th>Evaluation Category</th>
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
                                echo "<td>" . $row->form_name . "</td>";

                                echo "<td><ol>";
                                $catData = $this->hr_appraisal_model->get_eval_category_byId($row->cat_id);
                                if (!empty($catData)) {
                                    foreach ($catData as $value) {
                                        echo '<li>' . $value->cat_name . '</li>';
                                    }
                                }
                                echo "</ol></td>";

                                echo "<td>"
                                . "<div class='action-buttons '>"
                                . "<a title='Edit' href='" . base_url() . "Con_ReviewForm/edit_reviewForm/" . $row->form_id . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>"
                                . "<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->form_id . ")'><i class='fa fa-trash-o'></i></a>"
                                . "</div>"
                                . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
                <!-- end data table -->            
            </div>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script type="text/javascript">

    function delete_data(id) {
        var r = confirm("Do you want to delete this?");
        if (r == true) {
            $.ajax({
                url: "<?php echo site_url('Con_ReviewForm/delete_ReviewForm'); ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    var url = '<?php echo base_url(); ?>Con_ReviewForm';
                    view_message(data, url);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        } else {
            return false;
        }
    }

</script>