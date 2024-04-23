<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_SelectedCandidates/add_ScheduledInterviews"      ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>-->
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                     <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="10%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
<!--                            <th>Requisition Id</th>
                            <th>Position</th>-->
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Skill</th>
                            <th>Status</th>
                            <th>Is User</th>
                            <th>Is Send</th>
                            <th>Profile Progress</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $candidate_status = $this->Common_model->get_array('candidate_status');
                        $Yes_no_array = array(0 => 'No', 1 => 'Yes');
                        if ($query) {
                            $sl = 0;
                            foreach ($query->result() as $row) {
                                $position_id = $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'position_id');
                                if ($row->candidate_user_id == 0) {
                                    $is_user = "No";
                                } else {
                                    $is_user = "Yes";
                                }

                                if($row->is_send==1){
                                    $button_title="Resend to Candidate";
                                    $deletebuttondisabled="style='display:none'";
                                }else{
                                    $button_title="Send to Candidate";
                                    $deletebuttondisabled="";
                                }
                                
                                $skill_set_arr = explode(",", $row->skill_set);
                                $skill_set = '';
                                foreach ($skill_set_arr as $intr) {
                                    if ($skill_set == '') {
                                        $skill_set = $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                    } else {
                                        $skill_set = $skill_set . " , " . $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                    }
                                }
                                $sl++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->requisition_id, 'main_opening_position', 'requisition_code') . "</td>";
                                //print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_first_name ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_last_name ."</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->candidate_email."</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->contact_number . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $skill_set . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $candidate_status[$row->status] . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $is_user . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $Yes_no_array[$row->is_send] . "</td>";
                                print"<td id='catA" . $pdt . "'>" . "In Progress" . "</td>";
                                if ($row->status == 2) {
                                    print"<td><div class='action-buttons '><a href='" . base_url() . "Con_SelectedCandidates/edit_SelectedCandidates/" . $row->id . "/" . $row->requisition_id . "/" . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                } else if ($row->status == 3) {           
                                    print"<td><div class='action-buttons '><a href='#' onclick='add_ob_user(" . $row->id . ")' title='$button_title'><i class='fa fa-user'>&nbsp;&nbsp;</i></a> <a href='#' onclick='add_ob_info(" . $row->id . ")' title='Onboarding By HR'><i class='fa fa-info-circle'>&nbsp;&nbsp;</i></a> &nbsp;<a href='#' onclick='delete_data(" . $row->id . ")' $deletebuttondisabled ><i class='fa fa-trash-o'></i></a></div> </td>";
                                } else {
                                    print"<td><div class='action-buttons '><a href='#' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                }
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<!-- Modal -->
<div class="modal fade" id="obuser_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Request employee for onboarding </h4>
            </div>
            <form id="ob_user" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="candidate_id" id="candidate_id"/>
                <input type="hidden" value="" name="requisition_id" id="requisition_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-4 control-label">First Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" readonly>                        
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="passwd" id="passwd" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Phone No</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone No" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u"> Create Onboarding </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Close </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">

    function add_ob_user(id) { 
        
        swal({
            title: "Are you sure?",
            text: "Request to user for Onboarding!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = base_url + "Con_SelectedCandidates/save_selfuser_otp/" + id;
                swal("Request has been sent to candidate.", {
                    icon: "success",
                });
            } else {
                swal("No Request to user for Onboarding");
            }
        });
    }

    function add_ob_user_backup(id) {
        //alert (id);
        save_method = 'update';
        $('#ob_user')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_SelectedCandidates/ajax_edit_candidate/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data)
            {

                //alert(data.id);
                $('[name="candidate_id"]').val(data.id);
                $('[name="requisition_id"]').val(data.requisition_id);
                $('[name="firstname"]').val(data.candidate_first_name);
                $('[name="email"]').val(data.candidate_email);
                $('[name="phone_no"]').val(data.contact_number);

                $('#obuser_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Request employee for onboarding'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    function add_ob_info(id) {

        var Link = base_url + "Con_Onboarding/view_onboarding_company_entry_function/" + id;
        window.open(Link, '_blank');
    }

    $(function () {
        $("#phone_no").mask("(999) 999-9999");
    });

    $(function () {
        $("#ob_user").submit(function (event) {
            loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_SelectedCandidates/save_selfuser_signup') ?>";
            } else
            {
                url = "<?php echo site_url('Con_SelectedCandidates/save_selfuser_signup') ?>";
            }
            $.ajax({
                url: url,
                data: $("#ob_user").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                //$('#emp_asset')[0].reset();
                //$('#assets_Modal').modal('hide');
                //$("#asset_div").load(location.href + " #asset_div");                
                //reload_table('dataTables-example-assets');

                var url = '<?php echo base_url() ?>Con_SelectedCandidates';
                view_message(data, url, 'obuser_Modal', 'ob_user');

            });
            event.preventDefault();
        });
    });


</script>
<!--=== End Content ===-->

