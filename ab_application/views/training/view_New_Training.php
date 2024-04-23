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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_New_Training/add_New_Training" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add New Training </a></br></br>
                <table id="dataTables-example-training" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                 <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>    
                <thead>
                        <tr>
                            <th>SL</th>
                            <th>Training Name</th>
                            <th>Training Level</th>
                            <th>Training Type</th>
                            <th>Duration (Hours)</th>
                            <th>Training Date</th>
                            <th>Estimation Costing</th>
                            <th>Eligibility</th>
                            <th>Training Documents</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $training_type_array= $this->Common_model->get_array('training_type');
                        $status_array = $this->Common_model->get_array('status');
                        if ($query) {
                            $sl = 0;
                            foreach ($query->result() as $row) {
                                
                                $eligible = explode(",", $row->eligible);
                                $eligibles = '';
                                /* foreach ($eligible as $elg) {
                                    if ($eligibles == '') {
                                        $eligibles = $this->Common_model->get_name($this, $elg, 'tbl_employmentstatus', 'employemnt_status');
                                    } else {
                                        $eligibles = $eligibles . "," . $this->Common_model->get_name($this, $elg, 'tbl_employmentstatus', 'employemnt_status');
                                    }
                                } */
                                 if (in_array("11",  $eligible)) {
                                    $this->db->select('main_employmentstatus.workcodename');
                                    $this->db->from('main_employmentstatus');
                                    $this->db->where('main_employmentstatus.company_id' , $this->company_id);
                                    $this->db->where('main_employmentstatus.isactive' , 1);
                                    $employees_status = $this->db->get();
                                    //print_r($employees_status); exit;
                                    foreach ($employees_status->result() as $elg) {
                                        if ($eligibles == '') {
                                            $eligibles = $this->Common_model->get_name($this, $elg->workcodename, 'tbl_employmentstatus', 'employemnt_status');
                                        } else {
                                            $eligibles = $eligibles . "," . $this->Common_model->get_name($this, $elg->workcodename, 'tbl_employmentstatus', 'employemnt_status');
                                            
                                        }
                                    }
                                } else {

                                    foreach ($eligible as $elg) {
                                        
                                        if ($eligibles == '') {
                                            $eligibles = $this->Common_model->get_name($this, $elg, 'tbl_employmentstatus', 'employemnt_status');
                                        } else {
                                            $eligibles = $eligibles . "," . $this->Common_model->get_name($this, $elg, 'tbl_employmentstatus', 'employemnt_status');
                                            
                                        }
                                    }
                                }
                                
                                $sl++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->training_name . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->training_level . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $training_type_array[$row->training_type]. "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->duration. "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->plan_date. "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->estimation_costing. "</td>";
                                print"<td id='catA" . $pdt . "'>" . $eligibles . "</td>";
                                print"<td id='catA" . $pdt . "'><a href='" . base_url() . "Con_New_Training/download_training_documents/" . $row->training_documents . "/" . "' > ". $row->training_documents_name ." </a></td>";
                                print"<td id='catA" . $pdt . "'>" . $status_array[$row->isactive]. "</td>";
                                print"<td><div class='action-buttons '><a title='Edit' href='" . base_url() . "Con_New_Training/edit_New_Training/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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


//    function delete_data(id) {
//        var r = confirm("Do you want to delete this?")
//        if (r == true)
//            window.location = base_url + "Con_New_Training/delete_New_Training/" + id;
//        else
//            return false;
//    }
   $(document).ready(function () {
        $('#dataTables-example-training').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "bLengthChange": false,
            "bInfo" : false,
            "paginationType": "input"
        });
    });
    
    function delete_data(id) { 
    
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
        .then((willDelete) => {
            if (willDelete) {
                window.location = base_url + "Con_New_Training/delete_New_Training/" + id;
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
              });
            } else {
              swal("Your imaginary file is safe!");
            }
        });
      
    }

</script>
<!--=== End Content ===-->

