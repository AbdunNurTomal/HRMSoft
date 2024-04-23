
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
            <form id="sky-form111" name="sky-form111"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Requisitions_Approval/update_req_Status" enctype="multipart/form-data" role="form" >
                <div class="col-md-12" style="margin-top: 10px">
                    <div class="col-sm-4 no-padding-left">
                        <button type="submit" id="RejectForm" name="RejectForm" onclick="reject_form_submit(4)" value="4" class="btn btn-u"> <i class="fa fa-ban" aria-hidden="true"></i> Reject </button>
                        <button type="submit" id="ApproveForm" name="ApproveForm" onclick="approved_form_submit(1)" value="1" class="btn btn-u"> <i class="fa fa-check" aria-hidden="true"></i> Approve </button>
                    </div>
                </div>
                <input type="hidden" name="req_status" id="req_status">
                
                <div class="table-responsive col-md-12 col-centered">
                    <table id="requisition-approval" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" name="select_all" value="1" id="requisition-approval-table-select-all"></th>
                                <th>Requisition Id</th>
                                <th>Location</th>
                                <th>Department</th>
                                <th>Requisitions Date</th> 
                                <th>Due Date</th>
                                <th>Position</th> 
                                <th>Required no. of Positions</th> 
                                <th>Status</th>
                                <th>Action</th>
                                <!-- <th>Actions</th>  -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- <table id="dataTables-example-requlisitionApproval" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                       <colgroup>
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
                        <col width="10%">
                    </colgroup>
                        <thead>
                            <tr>
                                <th> <input name='all_check' id='all_check' type='checkbox' style="margin-left: -8px;"></th>
                                <th>Requisition Id</th>
                                <th>Location</th>
                                <th>Department</th>
                                <th>Requisitions Date</th> 
                                <th>Due Date</th>
                                <th>Position</th> 
                                <th>Required no. of Positions</th> 
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query) {
                                foreach ($query->result() as $row) {
                                    
                                    if($row->req_status==0){
                                        $status = $approver_status[$row->req_status];
                                    }  else {
                                        $status=$approver_status[$row->req_status];
                                    }
                                    
                                    $pdt = $row->id;
                                    print"<tr>";
                                    print"<td id='catA" . $pdt . "'>" . "<input name='approver_id[]' id='approver_id' type='checkbox' value='$row->id'>" . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $row->requisition_code . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->location_id,'main_location','location_name')."</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name') . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->requisitions_date). "</td>";
                                    print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->due_date) . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') . "</td>";
                                    print"<td id='catD" . $pdt . "'>" . $row->no_of_positions . "</td>";
                                    print"<td id='catB" . $pdt . "'>" . $status . "</td>";
                                    print"<td id='catB" . $pdt . "'><a title='Preview' href='" . base_url() . "Con_Requisitions_Approval/view_requisition/" . $row->id . "/' target='_blank' ><i class='fa fa-lg fa-eye'></i></a></td>";
                                    print"</tr>";
                                }
                            }
                            ?> 
                        </tbody>
                    </table> -->
                </div>
                
            </form>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
    
    function approved_form_submit(id)
       {
           $("#req_status").val('');
           $("#req_status").val(id);
           
            $("#sky-form11").submit(function (event) {
                loading_box(base_url);
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: $("#sky-form11").serialize(),
                    type: $(this).attr('method')
                }).done(function (data) {

                    var url = '<?php echo base_url() ?>Con_Requisitions_Approval';
                    view_message(data, url, '', 'sky-form11');

                });
                event.preventDefault();
            });
        
        }
       function reject_form_submit(id)
       {
           $("#req_status").val('');
           $("#req_status").val(id);
           
            $("#sky-form11").submit(function (event) {
                loading_box(base_url);
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: $("#sky-form11").serialize(),
                    type: $(this).attr('method')
                }).done(function (data) {

                    var url = '<?php echo base_url() ?>Con_Requisitions_Approval';
                    view_message(data, url, '', 'sky-form11');

                });
                event.preventDefault();
            });
        
        }

    
//    $("#req_status").select2({
//        placeholder: "Select Status",
//        allowClear: true,
//    });
//    
//    $(function () {
//        $("#sky-form11").submit(function (event) {
//            loading_box(base_url);
//            var url = $(this).attr('action');
//            $.ajax({
//                url: url,
//                data: $("#sky-form11").serialize(),
//                type: $(this).attr('method')
//            }).done(function (data) {
//
//                var url = '<?php // echo base_url() ?>Con_Requisitions_Approval';
//                view_message(data, url,'','sky-form11');
//            });
//            event.preventDefault();
//        });
//    });
/* 
$('body').on('change', '#all_check', function() {
        var rows, checked;
        rows = $('#dataTables-example-requlisitionApproval').find('tbody tr');
        checked = $(this).prop('checked');
        $.each(rows, function() {
            var checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', checked);
        });
    });

    $(document).ready(function () {
        $('#dataTables-example-requlisitionApproval').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    }); */

    /* datatable for contact employee by employee starts */
    $(document).ready(function () {
       
        var requisitionApprovalDatatable = $('#requisition-approval').DataTable({
            "pageLength": 10,
            "paginationType": "input",
            //"stateSave": true,
            // "serverSide": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'Con_Requisitions_Approval/showRequisitionApproval',
                type: 'GET'
            },
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center text-center',
                "width": "4%",
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox" name="approver_id" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            'order': [
                [1, 'asc']
            ]

        });
        $("#requisition-approval").wrap('<div class="overflow-x"> </div>');
        /* datatable for contact employee by employee ends */

        // Handle click on "Select all" control
        $('#requisition-approval-table-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = requisitionApprovalDatatable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
           
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#requisition-approval tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#requisition-approval-table-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if (el && el.checked && ('indeterminate' in el)) {
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
            
        });

        $("#sky-form111").submit(function (event) {
            loading_box(base_url);

            var url = $(this).attr('action');

            var employees = [];
            var selectedEmployees = requisitionApprovalDatatable.$('input[type="checkbox"]').serializeArray();
            selectedEmployees.forEach(function(item, key) {
                employees.push(item.value);
            });

            // Include extra data if necessary
            var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "approver_id").val(employees.join());
            $('#sky-form111').append(input);
            
            $.ajax({
                url: url,
                data: $("#sky-form111").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                var url='<?php echo base_url() ?>Con_Requisitions_Approval';
                view_message(data,url,'','sky-form111');
            });
            event.preventDefault();
        });

    });


</script>
<!--=== End Content ===-->

