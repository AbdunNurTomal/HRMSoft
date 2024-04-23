
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
                <div class="table-responsive col-md-12 col-centered" id="employee_ot_div">
                <button class="btn btn-u btn-md" onClick="add_employee_ot()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
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
                                print"<td id='catA" . $pdt . "'>" . $row->employee_id . "</td>";
                                print"<td id='catA" . $pdt . "'>" . ucwords($this->Common_model->get_name($this, $row->employee_id, 'main_employees','first_name')).''.ucwords($this->Common_model->get_name($this, $row->employee_id, 'main_employees','last_name')). "</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->contract_hour . "</td>";                                
                                print"<td id='catD" . $pdt . "'>" . $row->max_ot_hour . "</td>";                                
                                print"<td id='catD" . $pdt . "'>" . $row->ot_allow_hour . "</td>";                                
                                print"<td id='catD" . $pdt . "'>" . ucwords($row->status) . "</td>";                                
                                print"<td><div class='action-buttons '><a href='javascript:void()' onClick='edit_employee_ot($row->id)' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
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

<div class="modal fade" id="A_ot_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Employee OT</h4>
            </div>
            <form id="employee_ot" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="ot_employee_id"/>
                <div class="modal-body">
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Employee Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($employee_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->first_name.''.$key->last_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Contract Hour<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="contract_hour" id="contract_hour" class="form-control input-sm" placeholder="Contract Hour" data-toggle="tooltip" data-placement="bottom" title="Contract Hour">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">MAX OT Hour<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="max_ot_hour" name="max_ot_hour" id="percentage" class="form-control input-sm" placeholder="MAX OT Hour" data-toggle="tooltip" data-placement="bottom" title="MAX OT Hour">
                        </div> 
                        <label class="col-sm-2 control-label">OT Allow Hour<span class="req"/></label>
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

    $("#employee_id").select2({
            placeholder: "Employee",
            allowClear: true,
        });
    function add_employee_ot()
    {
        save_method = 'add';
        $('#employee_ot')[0].reset(); // reset form on modals
        $('#A_ot_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Employee OT'); // Set Title to Bootstrap modal title
    }
    
    $(function () {
        $("#employee_ot").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Employee_ot/save_Employee_OT') ?>";
            }
            else
            {
                url = "<?php echo site_url('Con_Employee_ot/update_Employee_OT') ?>";
            }
            $.ajax({
                url: url,
                data: $("#employee_ot").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                // alert (data);return;
                //$('#location_form')[0].reset();s
                //$('#location_Modal').modal('hide');

                $("#employee_ot_div").load(location.href + " #employee_ot_div");
                reload_table('dataTables-example');

                var url = '';
                view_message(data, url, 'A_ot_Modal', 'employee_ot');
            });
            event.preventDefault();
        });
    });
    
    function edit_employee_ot(id){
        save_method = 'update';
        $('#employee_ot')[0].reset(); // reset form on modals
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('Con_Employee_ot/ajax_edit_employee_ot/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {  
                alert(data.id);
                $('[name="ot_employee_id"]').val(data.id);
                $('[name="employee_id"]').select2().select2('val',data.employee_id);    
                $('[name="contract_hour"]').val(data.contract_hour);
                $('[name="max_ot_hour"]').val(data.max_ot_hour);
                $('[name="ot_allow_hour"]').val(data.ot_allow_hour);                
                $('[name="status"]').val(data.status);

                $('#A_ot_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Employee OT'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
     var url="<?php echo base_url();?>";
    function delete_data(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = url+"Con_ManageHolidayGroup/delete_group/"+id;
        else
          return false;
        } 


</script>
<!--=== End Content ===-->

