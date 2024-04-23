
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
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_training_hr_feedback/add_Training_hr_Feedback" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Training Feedback </a></br></br>-->
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="1%">
                        <col width="30%">
                        <col width="20%">
                        <col width="20%">
                        <col width="30%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Training Name</th>
                            <th> Proposed Date </th>
                            <th>Total Training Period</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            $sl = 0;
                            foreach ($query->result() as $row) {
                                $sl++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($this->Common_model->get_selected_value($this,'training_id',$row->training_id,'main_training_requisition','proposed_date')). "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_selected_value($this,'id',$row->training_id,'main_new_training','duration'). "</td>";
                                print"<td><div class='action-buttons '><a title='Feedback' href='" . base_url() . "Con_training_hr_feedback/add_Training_hr_Feedback/" . $row->training_id . "/" . "' > Feedback </a>&nbsp;</div> </td>";
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
            window.location = base_url + "Con_training_hr_feedback/delete_Training_hr_Feedback/" + id;
        else
            return false;
    }

</script>
<!--=== End Content ===-->
