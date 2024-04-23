
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
            <form id="sky-form111" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Training_Requisition_Approval/update_Training_Requisition_Approval_Status" enctype="multipart/form-data" role="form" >

                <?php
                //if ($query) {
                    //foreach ($query->result() as $row) {
                        ?>
                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right">Status <span class="req"/> </label>
                                <div class="col-sm-3">
                                    <select name="req_status" id="req_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        $approver_status = $this->Common_model->get_array('approver_status');
                                        foreach ($approver_status as $key => $val):
                                            ?>
                                            <option value="<?php echo $key ?>" <?php //if($row->req_status==$key) echo "selected"; ?>><?php echo $val ?></option>
                                            <?php
                                        endforeach;
                                        ?>                        
                                    </select> 
                                </div>
                                <?php //if ($row->req_status!=1) { ?>
                                <div class="col-sm-2 no-padding-left">
                                    <button type="submit" id="submit" class="btn btn-u"> Process </button>                            
                                </div>
                                <?php //} ?>
                            </div>
                        </div>
                        <?php
                    //}
                //}
                ?>

                <div class="table-responsive col-md-12 col-centered">
                    <table id="training-requisition-approval" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" name="select_all" value="1" id="training-requisition-approval-table-select-all"></th>
                                <th>Training Name</th>
                                <th>Proposed Date</th>
                                <th>Employees</th>
                                <th>Training Objective</th>
                                <th>Status</th>
                                <th>Action</th>
                                <!-- <th>Actions</th>  -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- <table id="dataTables-example-requlisition-approval" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                       <colgroup>
                            <col width="1%">
                            <col width="20%">
                            <col width="10%">
                            <col width="25%">
                            <col width="25%">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th> <input name='all_check' id='all_check' type='checkbox' style="margin-left: -8px;"></th>
                                <th>Training Name</th>
                                <th>Proposed Date</th>
                                <th>Employees</th>
                                <th>Training Objective</th> -->
<!--                                <th>Training Output</th>
                                <th>Training Outcome</th>-->
                                <!-- <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $requisition_by_array = $this->Common_model->get_array('requisition_by');
                            $status_array = $this->Common_model->get_array('status');
                            if ($query) {
                                $sl = 0;
                                foreach ($query->result() as $row) {

                                    $employee = explode(",", $row->employee);
                                    $employees = '';
                                    foreach ($employee as $emp) {
                                        if ($employees == '') {
                                            $employees = $this->Common_model->employee_name($emp);
                                        } else {
                                            $employees = $employees . "," . $this->Common_model->employee_name($emp);
                                        }
                                    }

                                    $sl++;
                                    $pdt = $row->id;
                                    print"<tr>";
                                    print"<td id='catA" . $pdt . "'>" . "<input name='approver_id[]' id='approver_id' type='checkbox' value='$row->id'>" . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->training_id, 'main_new_training', 'training_name') . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->proposed_date) . "</td>";
                                    print"<td  id='catA" . $pdt . "'>" . $employees . "</td>"; //class='td-cw'
                                    print"<td id='catA" . $pdt . "'>" . $row->training_objective . "</td>";
                                    //print"<td id='catA" . $pdt . "'>" . $row->training_output . "</td>";
                                    //print"<td id='catA" . $pdt . "'>" . $row->training_outcome . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . $approver_status[$row->req_status] . "</td>";
                                    print"<td id='catB" . $pdt . "'><a title='Preview' href='" . base_url() . "Con_Training_Requisition_Approval/view_Training_Requisition/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a></td>";
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


    $("#req_status").select2({
        placeholder: " Select Status",
        allowClear: true,
    });

    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Training_Requisition_Approval';
                view_message(data, url, '', 'sky-form11');
            });
            event.preventDefault();
        });
    });

    /* $('body').on('change', '#all_check', function() {
        var rows, checked;
        rows = $('#dataTables-example-requlisition-approval').find('tbody tr');
        checked = $(this).prop('checked');
        $.each(rows, function() {
            var checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', checked);
        });
    });

    $(document).ready(function () {
        $('#dataTables-example-requlisition-approval').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });
 */
    /* datatable for contact employee by employee starts */
    $(document).ready(function () {
       
        var trainingRequisitionApprovalDatatable = $('#training-requisition-approval').DataTable({
            "pageLength": 10,
            "paginationType": "input",
            //"stateSave": true,
            // "serverSide": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'Con_Training_Requisition_Approval/showTrainingRequisitionApproval',
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
        $("#training-requisition-approval").wrap('<div class="overflow-x"> </div>');
        /* datatable for contact employee by employee ends */

        // Handle click on "Select all" control
        $('#training-requisition-approval-table-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = trainingRequisitionApprovalDatatable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
           
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#training-requisition-approval tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#training-requisition-approval-table-select-all').get(0);
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
            var selectedEmployees = trainingRequisitionApprovalDatatable.$('input[type="checkbox"]').serializeArray();
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
                var url='<?php echo base_url() ?>Con_Training_Requisition_Approval';
                view_message(data,url,'','sky-form111');
            });
            event.preventDefault();
        });

    });

</script>
<!--=== End Content ===-->

