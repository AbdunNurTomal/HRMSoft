
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
                <div class="table-responsive col-md-12 col-centered" id="position_ot_div">
                    <button class="btn btn-u btn-md" onClick="add_position_ot()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
                    <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>Position ID</th>
                                <th>Position Name</th>
                                <th>Contract Hour</th>                            
                                <th>MAX OT Hour</th>                            
                                <th>OT Allow Hour</th>                            
                                <th>Status</th>                            
                                <th>Action</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query) {
                                foreach ($query->result() as $row) {
                                    $pdt = $row->id;
                                    print"<tr>";
                                    print"<td id='catA" . $pdt . "'>" . $row->position_id . "</td>";
                                    print"<td id='catA" . $pdt . "'>" . ucwords($this->Common_model->get_name($this, $row->position_id, 'main_positions','positionname')) . "</td>";
                                    print"<td id='catD" . $pdt . "'>" . $row->contract_hour . "</td>";
                                    print"<td id='catD" . $pdt . "'>" . $row->max_ot_hour . "</td>";
                                    print"<td id='catD" . $pdt . "'>" . $row->ot_allow_hour . "</td>";
                                    print"<td id='catD" . $pdt . "'>" . ucwords($row->status) . "</td>";
                                    print"<td><div class='action-buttons '><a href='javascript:void()' onClick='edit_position_ot($row->id)' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
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

<!-- Modal -->
<div class="modal fade" id="P_ot_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Position OT</h4>
            </div>
            <form id="position_ot" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="ot_position_id"/>
                <div class="modal-body">
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Position Name</label>
                        <div class="col-sm-4">
                            <select name="position_id" id="position_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($position_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->positionname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Contract Hour</label>
                        <div class="col-sm-4">
                            <input type="text" name="contract_hour" id="contract_hour" class="form-control input-sm" placeholder="Contract Hour" data-toggle="tooltip" data-placement="bottom" title="Contract Hour">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">MAX OT Hour</label>
                        <div class="col-sm-4">
                            <input type="max_ot_hour" name="max_ot_hour" id="percentage" class="form-control input-sm" placeholder="MAX OT Hour" data-toggle="tooltip" data-placement="bottom" title="MAX OT Hour">
                        </div> 
                        <label class="col-sm-2 control-label">OT Allow Hour</label>
                        <div class="col-sm-4">
                            <input type="ot_allow_hour" name="ot_allow_hour" id="percentage" class="form-control input-sm" placeholder="OT Allow Hour" data-toggle="tooltip" data-placement="bottom" title="OT Allow Hour">
                        </div>
                    </div> 
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                            <input type="status" name="status" id="percentage" class="form-control input-sm" placeholder="Status" data-toggle="tooltip" data-placement="bottom" title="Status">
                        </div>                         
                    </div> 
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    $("#from,#to").select2({
        placeholder: "Select a State",
        allowClear: true,
    });
    $("#position_id").select2({
        placeholder: "Position",
        allowClear: true,
    });
    function add_position_ot()
    {
        save_method = 'add';
        $('#position_ot')[0].reset(); // reset form on modals
        $('#P_ot_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Position OT'); // Set Title to Bootstrap modal title
    }

    $(function () {
        $("#position_ot").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Position_ot/save_Position_OT') ?>";
            }
            else
            {
                url = "<?php echo site_url('Con_Position_ot/update_Position_OT') ?>";
            }
            $.ajax({
                url: url,
                data: $("#position_ot").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                $("#position_ot_div").load(location.href + " #position_ot_div");
                reload_table('dataTables-example');
                
                var url = '';
                view_message(data, url, 'P_ot_Modal', 'position_ot');
            });
            event.preventDefault();
        });
    });
    
    function edit_position_ot(id){
        save_method = 'update';
        $('#position_ot')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_Position_ot/ajax_edit_position/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {                            
                $('[name="ot_position_id"]').val(data.id);
                $('[name="position_id"]').select2().select2('val',data.position_id);    
                $('[name="contract_hour"]').val(data.contract_hour);
                $('[name="max_ot_hour"]').val(data.max_ot_hour);
                $('[name="ot_allow_hour"]').val(data.ot_allow_hour);                
                $('[name="status"]').val(data.status);

                $('#P_ot_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Position OT'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    var url = "<?php echo base_url(); ?>";
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "Con_ManageHolidayGroup/delete_group/" + id;
        else
            return false;
    }


</script>
<!--=== End Content ===-->

