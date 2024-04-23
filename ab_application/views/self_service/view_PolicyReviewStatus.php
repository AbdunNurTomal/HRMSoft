        <div class="col-md-10 main-content-div">
            <div class="main-content">

                <div class="container conbre">
                    <ol class="breadcrumb">
                        <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                        <li class="active"><?php echo $page_header; ?></li>
                    </ol>
                </div>

                <!-- end container well div -->
                <div class="container tag-box tag-box-v3 content-div">
                    <div class="container tag-box" style="margin-bottom: 20px"><h2>Employee Policy Review:</h2></div>
                    <div class="table-responsive col-md-12 col-centered no-border">
                        <!-- <table id="mytable" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl responsive-table table-wrap" style="width: 100%;"> -->
                        <table id="dataTables-example" class="table table-striped table-bordered dt-responsive table-hover nowrap obrevtbl responsive-table table-wrap" style="width: 100%;">
                            <colgroup>
                                <col width="1%">
                                <col width="30%">
                                <col width="40%">
                                <col width="40%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Policy Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="leave_req_rep">
                                <?php
                                $sl=0;
                                foreach ($policy->result() as $row) {
                                    $sl++;
                                ?>
                                <tr>
                                    <td><?php echo $sl ?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->policy_id, 'main_company_policies', 'policy_name');?></td>
                                    <td><?php echo $this->Common_model->get_name($this, $row->policy_id, 'main_company_policies', 'description');?></td>                            
                                    <td><?php echo ($row->is_aggree=1 ? 'Agree':'Disagree');?></td>                            
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end container well div -->

            </div>
        </div>

    </div><!--/row-->
</div><!--/container-->


