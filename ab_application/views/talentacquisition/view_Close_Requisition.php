<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <form id="sky-form111" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Close_Requisition/multiple_Close_Requisition" enctype="multipart/form-data" role="form" >
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <button type="submit" id="submit" name="submit" class="btn btn-u"> <i class="fa fa-ban" aria-hidden="true"></i> Close Requisition </button>
                </br>
                </br>
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_Close_Requisition/add_job_Requisition" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add New Requisition </a></br></br>-->
                <table id="close-requisition" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" name="select_all" value="1" id="close-requisition-table-select-all"></th>
                            <th>Requisition Id</th>
                            <th>Location</th>
                            <th>Department</th>
                            <th>Requisitions Date</th>
                            <th>Due Date</th>
                            <th>Position</th> 
                            <th>Required Positions</th> 
                            <th>Requisition Status</th> 
                            <th>Action</th>
                            <!-- <th>Actions</th>  -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- <table id="dataTables-example-closeRequlisition" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
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
                            <th>Required Positions</th> 
                            <th>Requisition Status</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $approver_status_array= $this->Common_model->get_array('approver_status');
                        if ($query) {
                            $sl = 0;
                            foreach ($query->result() as $row) {
                                $sl++;
                                $pdt = $row->id;
                                
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" ." <input name='requisition_id[]' id='requisition_id' type='checkbox' value='$row->id'>" . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->requisition_code . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->location_id, 'main_location', 'location_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->requisitions_date) . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->due_date) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->no_of_positions . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $approver_status_array[$row->req_status] . "</td>";
                                print"<td><div class='action-buttons '> &nbsp; <a title='Preview' href='" . base_url() . "Con_Close_Requisition/view_requisition/" . $row->id . "/'  ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;</div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table> -->
            </div>
            <!-- end data table --> 
            </form>
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script type="text/javascript">

    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_Job_Requisition/delete_job_Requisition/" + id;
        else
            return false;
    }
    
    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Close_Requisition';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    /* $('body').on('change', '#all_check', function() {
        var rows, checked;
        rows = $('#dataTables-example-closeRequlisition').find('tbody tr');
        checked = $(this).prop('checked');
        $.each(rows, function() {
            var checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', checked);
        });
    });

    $(document).ready(function () {
        $('#dataTables-example-closeRequlisition').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    }); */

    /* datatable for contact employee by employee starts */
    $(document).ready(function () {
       
        var closeRequisitionDatatable = $('#close-requisition').DataTable({
            "pageLength": 10,
            "paginationType": "input",
            //"stateSave": true,
            // "serverSide": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'Con_Close_Requisition/showCloseRequisition',
                type: 'GET'
            },
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center text-center',
                "width": "4%",
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox" name="requisition_id" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            'order': [
                [1, 'asc']
            ]

        });
        $("#close-requisition").wrap('<div class="overflow-x"> </div>');
        /* datatable for contact employee by employee ends */

        // Handle click on "Select all" control
        $('#close-requisition-table-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = closeRequisitionDatatable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
           
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#close-requisition tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#close-requisition-table-select-all').get(0);
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
            var selectedEmployees = closeRequisitionDatatable.$('input[type="checkbox"]').serializeArray();
            selectedEmployees.forEach(function(item, key) {
                employees.push(item.value);
            });

            // Include extra data if necessary
            var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "requisition_id").val(employees.join());
            $('#sky-form111').append(input);
            
            $.ajax({
                url: url,
                data: $("#sky-form111").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                var url='<?php echo base_url() ?>Con_Close_Requisition';
                view_message(data,url,'','sky-form111');
            });
            event.preventDefault();
        });



    });


</script>
<!--=== End Content ===-->

