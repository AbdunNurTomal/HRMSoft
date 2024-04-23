
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
                <!--<button class="btn btn-u btn-md" onClick="add_dependent()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>-->
                <table id="dataTables-example" class="table table-striped table-bordered dt-responsive nowrap responsive-table table-wrap">
                     <colgroup>
                        <col width="5%">
                        <col width="25%">
                        <col width="15%">
                        <col width="25%">
                        <col width="25%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL </th>
                            <th>User Name</th>
                            <th>User ID</th>
                            <th>Company Name</th>
                            <th>Company Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            $i=0;
                            foreach ($query->result() as $row) {
                                $i++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->name. "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->email. "</td>";
                                print"<td id='catG" . $pdt . "'>" . $row->company_full_name. "</td>";
                                print"<td id='catG" . $pdt . "'>" . $row->company_email. "</td>";
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_Subscription_Settings/edit_Subscription_Settings/" . $row->com_id . "/" . $row->usr_id . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a></div> </td>";
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
