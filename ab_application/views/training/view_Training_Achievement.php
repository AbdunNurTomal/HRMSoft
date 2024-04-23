
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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Training_Achievement/add_Training_Achievement" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Training Achievement </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="10%">
                        <col width="30%">
                        <col width="25%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Training Name</th>
                            <th>Date OF Training</th>
                            <th>Total Training Period</th>
                            <th>Training Output</th>
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
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->training_date) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->total_training_period. "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->training_output. "</td>";
                                print"<td><div class='action-buttons '><a title='Edit' href='" . base_url() . "Con_Training_Achievement/edit_Training_Achievement/" . $row->id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a title='Delete' href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
//            window.location = base_url + "Con_Training_Achievement/delete_Training_Achievement/" + id;
//        else
//            return false;
//    }
    
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
                window.location = base_url + "Con_Training_Achievement/delete_Training_Achievement/" + id;
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


