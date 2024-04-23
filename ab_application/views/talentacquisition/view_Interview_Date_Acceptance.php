<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <form id="sky-form111" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Interview_Date_Acceptance/save_allInterview_Date_Acceptance" enctype="multipart/form-data" role="form" >
            <div class="col-md-12" style="margin-top: 10px">
                <div class="form-group">
                    <label class="col-sm-4 control-label">   </label>
                    <div class="col-sm-3">
                        <select name="acceptance_status" id="acceptance_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <option></option>
                            <?php
                            foreach ($approver_status as $key => $val):
                                ?>
                                <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php
                            endforeach;
                            ?>                        
                        </select> 
                    </div>
                    <div class="col-sm-2 no-padding-left">
                        <button type="submit" id="submit" class="btn btn-u"> Process </button>                            
                    </div>
                </div>
            </div>
            
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <table id="interview-acceptance" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" name="select_all" value="1" id="interview-acceptance-table-select-all"></th>
                            <th>Requisition Id</th>
                            <th>Interviewer</th>
                            <th>Position</th>
                            <th>Candidate Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Acceptance Status</th>
                            <th>Action</th>
                            <!-- <th>Actions</th>  -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_ScheduledInterviews/add_ScheduledInterviews"  ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Interviews Scheduled </a></br></br>-->
               <!--  <table id="dataTables-example-interview-date" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th> <input name='all_check' id='all_check' type='checkbox' style="margin-left: -8px;"></th>
                            <th>Requisition Id</th>
                            <th>Interviewer</th>
                            <th>Position</th>
                            <th>Candidate Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Acceptance Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $interview_status = $this->Common_model->get_array('interview_status');
                        if ($query) {
                            $sl = 0;


                            foreach ($query->result() as $row) {
                                $position_id = $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'position_id');
                                $sl++;
                                $pdt = $row->id;
                                $exp_interviewer = explode(",", $row->interviewer);
                                $interviewer = "";
                                foreach ($exp_interviewer as $key => $val) {
                                    if ($interviewer == "") {
                                        $interviewer = $this->Common_model->get_selected_value($this, 'employee_id', $val, 'main_employees', 'first_name');
                                    } else {
                                        $interviewer = $interviewer . " , " . $this->Common_model->get_selected_value($this, 'employee_id', $val, 'main_employees', 'first_name');
                                    }
                                }
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . "<input name='approver_id[]' id='approver_id' type='checkbox' value='$row->id'>" . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'requisition_code') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $interviewer . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'candidate_first_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'candidate_email') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->candidate_name, 'main_cv_management', 'contact_number') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $interview_status[$row->interview_status] . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $approver_status[$row->acceptance_status] . "</td>";
                                print"<td><div class='action-buttons '>"
                                        . "<a title='Preview' href='" . base_url() . "Con_Interview_Date_Acceptance/view_Interview_Date_Acceptance/" . $row->id . "/' ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;"
                                        . "</div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table> -->
            </div>
            <!-- end data table --> 
            </form>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

   
    $("#acceptance_status").select2({
        placeholder: "Select Status",
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

                var url = '<?php echo base_url() ?>Con_Interview_Date_Acceptance';
                view_message(data, url,'','sky-form11');
            });
            event.preventDefault();
        });
    });
    
    /* $('body').on('change', '#all_check', function() {
        var rows, checked;
        rows = $('#dataTables-example-interview-date').find('tbody tr');
        checked = $(this).prop('checked');
        $.each(rows, function() {
            var checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', checked);
        });
    });

    $(document).ready(function () {
        $('#dataTables-example-interview-date').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    }); */

    /* datatable for contact employee by employee starts */
    $(document).ready(function () {
       
        var interviewAcceptanceDatatable = $('#interview-acceptance').DataTable({
            "pageLength": 10,
            "paginationType": "input",
            //"stateSave": true,
            // "serverSide": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: base_url + 'Con_Interview_Date_Acceptance/showInterviewDateAcceptance',
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
        $("#interview-acceptance").wrap('<div class="overflow-x"> </div>');
        /* datatable for contact employee by employee ends */

        // Handle click on "Select all" control
        $('#interview-acceptance-table-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = interviewAcceptanceDatatable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
           
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#interview-acceptance tbody').on('change', 'input[type="checkbox"]', function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#interview-acceptance-table-select-all').get(0);
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
            var selectedEmployees = interviewAcceptanceDatatable.$('input[type="checkbox"]').serializeArray();
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
                var url='<?php echo base_url() ?>Con_Interview_Date_Acceptance';
                view_message(data,url,'','sky-form111');
            });
            event.preventDefault();
        });
   });


</script>
<!--=== End Content ===-->

