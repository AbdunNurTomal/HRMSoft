
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
            <!-- data table -->
             <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_County_Settings/add_county" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                
                    <div style="overflow-x:scroll;">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>County Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($query) {
                                    $i = 0;
                                    foreach ($query->result() as $row) {
                                    $i++;
                                    $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . ucwords($row->county_name) . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
                                        print"<td><div class='action-buttons '><a href='" . base_url() . "Con_County_Settings/edit_county/" . $row->id . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_county(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                        print"</tr>";
                                    }
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />-->
<style type="text/css">
/*    .dataTables_wrapper .dataTables_paginate .paginate_button{padding:0 !important}
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover{border:1px solid #fff !important}
    */


</style>

<!--<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>-->

<script type="text/javascript">

    // $(document).ready(function () {
        
    //     var EDIT_URL = base_url + 'Con_County_Settings/edit_county/';
    //     var DELETE_URL = base_url + 'Con_County_Settings/delete_county/';

    //     $('#county_table').DataTable({
    //         "processing": true,
    //         "serverSide": true,
    //         "bLengthChange": false,
    //         "bInfo" : false,
    //         "pageLength": 10,
    //         "ajax": base_url + "Con_County_Settings/county_paginate",
    //         "columnDefs": [{"targets": 3, "data": 0, "render": function (data, type, full, meta)
    //                 {
    //                     return '<a href="' + EDIT_URL + data + '" title="Edit"><i class="fa fa-lg fa-edit"></i></a>&nbsp&nbsp' +
    //                             '<a href="' + DELETE_URL + data + '" title="Delete"><i class="fa fa-trash-o"></i></a>'
    //                 }}]
    //     });
    // });

//    var url = "<?php // echo base_url(); ?>";
//    function delete_county(id) {
//        var r = confirm("Do you want to delete this?")
//        if (r == true)
//            window.location = url + "Con_County_Settings/delete_county/" + id;
//        else
//            return false;
//    }
    
    // function delete_county(id) { 
    
    //     swal({
    //         title: "Are you sure?",
    //         text: "Once deleted, you will not be able to recover this imaginary file!",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //       })
    //     .then((willDelete) => {
    //         if (willDelete) {
    //             window.location = base_url + "Con_County_Settings/delete_county/" + id;
    //             swal("Poof! Your imaginary file has been deleted!", {
    //             icon: "success",
    //           });
    //         } else {
    //           swal("Your imaginary file is safe!");
    //         }
    //     });
        
    // }

</script>
<!--=== End Content ===-->

