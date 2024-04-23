<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">

                <form class="form-horizontal" action="<?php echo base_url() . 'Con_Request_for_Interviewer/search_Interviewer/'; ?>" method="post">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">  Schedule  </label>
                                <div class="col-sm-8">
                                    <select name="schedule_id" id="schedule_id" class="col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                        foreach ($schedule_query->result() as $key) {
                                            $requisition_code = $this->Common_model->get_name($this, $key->requisition_id, 'main_opening_position', 'requisition_code');
                                            //$position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                            //$position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');

                                            $slct = ($search_criteria['schedule_id'] == $key->id) ? 'selected' : '';
                                            echo '<option value="' . $key->id . '" ' . $slct . '>' . $requisition_code . "  ( " . $key->schedule_group . " ) " . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Request_for_Interviewer/save_Request_for_Interviewer" enctype="multipart/form-data" role="form" >

                    <div class="overflow-x" style=" overflow-y: scroll; margin-bottom: 12px; max-height: 600px; ">
                        <table id="" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th> <input name='all_check' id='all_check' type='checkbox' ></th>
                                    <th>Employee Name</th>
                                    <th>Position</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $candidate_status = $this->Common_model->get_array('candidate_status');

                                if (!empty($search_ids)) {

                                    $search_ids = explode(",", $search_ids);
                                    $search_ids = array_map('intval', $search_ids);
                                    $this->db->where_in('employee_id', $search_ids);

                                    if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
                                        $query = $this->db->get_where('main_employees', array('company_id' => $this->company_id, 'isactive' => 1));
                                    } else {
                                        $query = $this->db->get_where('main_employees', array('isactive' => 1));
                                    }

                                    if ($query) {
                                        $sl = 0;
                                        foreach ($query->result() as $row) {

                                            $sl++;
                                            $pdt = $row->id;
                                            print"<tr>";
                                            print"<td id='catA" . $pdt . "'>" . "<input name='employee_id[]' id='employee_id' type='checkbox' value='$row->employee_id'> <input name='schedule_id' id='schedule_id' type='hidden' value='$schedule_id'>" . "</td>";
                                            //print"<td id='catA" . $pdt . "'>" . $row->employee_id . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'first_name') . " " . $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'middle_name') . " " . $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'last_name') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position, 'main_jobtitles', 'job_title') . "</td>";
                                            print"<td id='catA" . $pdt . "'>" . $row->email . "</td>";
                                            print"</tr>";
                                        }
                                    }
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">                        
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Request_for_Interviewer" ?>"> Close </a>
                        <button type="submit" id="submit" class="btn btn-u"> Request </button>
                    </div>

                </form>

            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    $("#schedule_id").select2({
        placeholder: "Select schedule id",
        allowClear: true
    });


    $("#all_check").change(function () {
        if ($(this).prop('checked') == true) {
            $('input:checkbox').attr('checked', 'checked');
        } else {
            $('input:checkbox').removeAttr('checked');
        }
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

                var url = '<?php echo base_url() ?>Con_Request_for_Interviewer';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

</script>
<!--=== End Content ===-->

