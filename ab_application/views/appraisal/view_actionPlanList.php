
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
                <a class="btn btn-u" href="<?php echo base_url() . "Con_ActionPlan/add_actionPlan"; ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered dt-responsive table-hover nowrap">                                                
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Plan Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            $sl = 0;
                            foreach ($query->result() as $row) {
                                $sl++;
                                $pdt = $row->plan_id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->plan_name . "</td>";
                                print"<td><div class='action-buttons'>"
                                        . "<a href='" . base_url() . "Con_ActionPlan/edit_actionPlan/" . $row->plan_id . "/" . "' ><i class='fa fa-pencil-square-o'></i></a>&nbsp;&nbsp;"
                                        . "<a href='javascript:void(0)' onclick='delete_data(" . $row->plan_id . ")'><i class='fa fa-trash-o'></i></a>"
                                        . "</div></td>";
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

    function delete_data(id) {
        var r = confirm("Do you want to delete this?");
        if (r == true) {
            $.ajax({
                url: "<?php echo site_url('Con_ActionPlan/delete_ActionPlan/') ?>/" + id,
                type: "POST",
                success: function (data)
                {
                    var url = '<?php echo base_url() ?>Con_ActionPlan';
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