<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3 content-div">
            <?php
            if ($type == 1) {//entry
                ?>
            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_LeaveRequest/save_LeaveRequest" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee</label>
                        <div class="col-sm-4">
                            <select name="employee" id="employee" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($employe->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->first_name . ' ' . $key->last_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>                        
                        <label class="col-sm-2 control-label">Leave Type</label>
                        <div class="col-sm-4">
                            <select name="leave_type" id="leave_type" onchange="value_receive(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($leave_type_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->leave_code ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>   
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Available Leaves </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="available_leaves" id="available_leaves"  class="form-control" placeholder="Available Leaves" readonly />
                        </div>
                        <label class="col-sm-2 control-label">From Date</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="from_date" id="from_date" class="form-control dt_pick" onchange="calculate_date()" placeholder="From Date" autocomplete="off" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">To Date</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="to_date" id="to_date" class="form-control dt_pick" onchange="calculate_date()" placeholder="To Date" autocomplete="off" />
                        </div>
                        <label class="col-sm-2 control-label">Number of Days</label>
                        <div class="col-sm-4">                            
                            <input type="text" name="number_of_days" id="number_of_days" class="form-control" placeholder="Number of Days" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reason </label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="2" id="reason" name="reason"></textarea>
                        </div>
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">                            
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                        </div> 
                    </div> 
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "con_LeaveRequest" ?>">Close</a>
                    </div>
                </form>
            </div>
                <?php
            } else if ($type == 2) {//edit
                ?>
            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_LeaveRequest/edit_LeaveRequest" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Employee</label>
                            <div class="col-sm-4">
                                <select name="employee" id="employee" class="col-sm-12 col-xs-12 myselect2 input-sm" disabled>
                                    <option></option>
                                    <?php
                                    foreach ($employe->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"<?php if ($row->employee_id == $key->id) echo "selected"; ?>><?php echo $key->first_name . ' ' . $key->last_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                        
                            <label class="col-sm-2 control-label">Leave Type</label>
                            <div class="col-sm-4">
                                <select name="leave_type" id="leave_type" onchange="value_receive(this.value)" class="col-sm-12 col-xs-12 myselect2 input-sm" disabled >
                                    <option></option>
                                    <?php
                                    foreach ($leave_type_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"<?php if ($row->leave_type == $key->id) echo "selected"; ?>><?php echo $key->leave_code ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>   
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Available Leaves </label>
                            <div class="col-sm-4">                            
                                <input type="text" name="available_leaves" id="available_leaves" class="form-control" value="<?php echo $row->available_leaves ?>" placeholder="Available Leaves" readonly/>
                            </div>
                            <label class="col-sm-2 control-label">From Date</label>
                            <div class="col-sm-4">                            
                                <input type="text" name="from_date" id="from_date" class="form-control dt_pick" value="<?php echo $this->Common_model->show_date_formate($row->from_date) ?>" onchange="calculate_date()" placeholder="From Date" autocomplete="off" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">To Date</label>
                            <div class="col-sm-4">                            
                                <input type="text" name="to_date" id="to_date" class="form-control dt_pick" value="<?php echo $this->Common_model->show_date_formate($row->to_date) ?>" onchange="calculate_date()" placeholder="To Date" autocomplete="off" />
                            </div>
                            <label class="col-sm-2 control-label">Number of Days</label>
                            <div class="col-sm-4">                            
                                <input type="text" name="number_of_days" id="number_of_days" class="form-control" value="<?php echo $row->number_of_days ?>" placeholder="Number of Days" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Reason </label>
                            <div class="col-sm-4">                            
                                <textarea class="form-control" rows="2" id="reason" name="reason"><?php echo ucwords($row->reason) ?></textarea>
                            </div>
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-4">                            
                                <textarea class="form-control" rows="2" id="description" name="description"> <?php echo ucwords($row->description) ?> </textarea>
                            </div> 
                        </div>
                        <div class="modal-footer">                            
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "con_LeaveRequest" ?>">Close</a>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
                <?php
            }
            ?>
        </div>

    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {
            $('select').removeAttr('disabled');
            var url = $(this).attr('action');
            loading_box(base_url);
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>con_LeaveRequest';
                view_message(data, url,'','#sky-form11');

            });
            event.preventDefault();
        });
    });

    function calculate_date()
    {
        var from_datea = $('#from_date').val();
        var date1 = new Date(from_datea);

        var to_datea = $('#to_date').val();
        var date2 = new Date(to_datea);

        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var diffDays = Math.abs((date1.getTime() - date2.getTime()) / (oneDay));
        //alert(diffDays);
        if (diffDays)
        {
            $('#number_of_days').val(diffDays);
        }
    }

    function value_receive(id)    
    {
//        alert(id);
        var emp_id = $('#employee').val();
        alert(emp_id);
        var data = id +'_'+ emp_id;
        $.ajax({ 
            url: "<?php echo site_url('con_LeaveRequest/get_leave_information/') ?>/" + data,
            type: "POST"          
            
        }).done(function (data) {
            alert(data);
            $('#available_leaves').val(data);
        });
    }


    $("#leave_type").select2({
        placeholder: "Leave Type",
        allowClear: true,
    });
    $("#employee").select2({
        placeholder: "Employee",
        allowClear: true,
    });
</script>
<!--=== End Script ===-->

