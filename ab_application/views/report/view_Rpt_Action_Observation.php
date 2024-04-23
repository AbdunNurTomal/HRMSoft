
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
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Rpt_Action_Observation/action_filter" enctype="multipart/form-data" role="form" >
                    <div class="row" style=" margin-left: 100px">
                        <div class="col-md-10" >
                        <div class="col-md-4 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>Employee</h4></label>
                            <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>                           
                                <?php
                                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {//                                      
                                    $sql = "SELECT DISTINCT employee_id FROM main_observation_action WHERE company_id=" . $this->company_id;
                                    $amployee = $this->db->query($sql);
                                } else {
                                    $sql = "SELECT DISTINCT employee_id FROM main_observation_action";
                                    $amployee = $this->db->query($sql);
                                }
                                foreach ($amployee->result() as $row):
                                    ?>
                                    <option value="<?php echo $row->employee_id ?>"><?php echo $this->Common_model->get_name($this, $row->employee_id, 'main_employees', 'first_name') ?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                        <div class="col-md-4 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>Action Type</h4></label>
                            <select name="action_type" id="action_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>                           
                                <?php
                                $emp_action_type = array(1 => 'Incident', 2 => 'Accident');
                                foreach ($emp_action_type as $key => $val):
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left"><h4>Follow-up Date</h4></label>
                            <input type="text" name="observation_date" id="observation_date" class="form-control dt_pick input-sm" placeholder="Observation Date" data-toggle="tooltip" data-placement="bottom" style="height:  33px" autocomplete="off">
                        </div>
                    </div>
                        <div class="col-md-2" style="margin-top: 47px; margin-left: -50px">                            
                            <button type="submit" id="submit" class="btn btn-u">Search</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive col-md-12 col-centered">
                    <div class="overflow-x">
                        <table id="Action_Observation" class="table table-striped table-bordered dt-responsive table-hover nowrap" >
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Action Date</th>
                                    <th>Employee Name</th>
                                    <th>Follow-up Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Next Follow-up Date</th>
                                </tr>
                            </thead>
                            <tbody id="rpt_action_table" >

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>
</div><!--/row-->
</div><!--/container-->
<!--=== End Content ===-->



<!-- Follow-up Modal -->
<div class="modal fade" id="acObs_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Action Follow-up</h4>
            </div>

            <div class="modal-body" id="observation_action_list">
                <div class="overflow-x">
                    <table class="table table-striped actbl">

                        <tbody>
                            <!-------- Ajax Data Here -------->
                            <tr>
                                <td colspan="4" class="center-align"><i>- Please Wait -</i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="overflow-x">
                    <table class="table table-striped rptObsActionList">
                        <thead>
                            <tr>
                                <th>Sl. no.</th>
                                <th>Follow-up Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Next Follow-up Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-------- Ajax Data Here -------->
                            <tr>
                                <td colspan="7" class="center-align"><i>- Please Wait -</i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">



    $(function () {
        $("#sky-form11").submit(function (event) {

            var employee_id = $("#employee_id").val();
            var action_type = $("#action_type").val();
            var observation_date = $("#observation_date").val();

            if (employee_id || action_type || observation_date) {
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: $("#sky-form11").serialize(),
                    type: $(this).attr('method')
                }).done(function (data) {
//                alert(data);return;
                    $('#rpt_action_table').html(data);

                });
            } else {
                alert('Please Select At Least One Field');
            }
            event.preventDefault();
        });
    });

    $("#action_type").select2({
        placeholder: "Select Action Type",
        allowClear: true,
    });
    $("#employee_id").select2({
        placeholder: "Select Employee",
        allowClear: true,
    });

    var save_method; //for save method string
    function view_action_falloup(action_id) {
        save_method = 'add';

        var DATA = {
            "action_id": action_id
        };

        $.ajax({
            url: '<?php echo site_url('Con_Rpt_Action_Observation/get_acobservation_data'); ?>',
            data: DATA,
            type: 'POST'
        }).done(function (data) {
            var datas = data.split('##');
            $(".rptObsActionList tbody").html(datas[0]);
            $(".actbl tbody").html(datas[1]);
        });


        $('#acObs_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Action Follow-up'); // Set Title to Bootstrap modal title
    }

</script>