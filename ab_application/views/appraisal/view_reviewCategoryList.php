
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
                <a class="btn btn-u" href="<?php echo base_url() . "Con_ReviewCategory/add_reviewCategory/" . $this->uri->segment(3); ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered dt-responsive table-hover nowrap">                                                
                    <thead>
                        <tr>
                            <th>Sl No.</th>
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
                                echo "<td>" . $row->cat_name . "</td>";
                                echo "<td>"
                                . "<div class='action-buttons'>"
                                . "<a title='Edit' href='" . base_url() . "Con_ReviewCategory/edit_reviewCategory/" . $row->cat_id . "' ><i class='fa fa-pencil-square-o'></i></a>&nbsp;"
                                . "<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->cat_id . ")'><i class='fa fa fa-trash-o'></i></a>"
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

<script type="text/javascript">

    function delete_data(id) {
        var r = confirm("Do you want to delete this?");
        if (r == true) {
            $.ajax({
                url: "<?php echo site_url('Con_ReviewCategory/delete_ReviewCategory'); ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    var url = '<?php echo base_url(); ?>Con_ReviewCategory';
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