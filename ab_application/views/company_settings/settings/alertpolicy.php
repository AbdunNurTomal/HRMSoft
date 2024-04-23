<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="alertpolicy_div">
        <button class="btn btn-u btn-md" onClick="add_alertpolicy()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-alertpolicy" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
             <colgroup>
               <col width="5%">
                <col width="35%">
                <col width="40%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Alert Policy</th>
                    <th>Message Template</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $status_array = $this->Common_model->get_array('status');
                $alert_type_array = $this->Common_model->get_array('alert_type');
                $query = $this->db->get_where('main_alert_policy', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        if($row->alert_item==0) {$al="";}else { $al=$alert_type_array[$row->alert_item]; }
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $al . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row ->alert_message_template . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $status_array[$row->alert_status] . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_alertpolicy(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_alertpolicy(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>

<!-- Modal -->
<div class="modal fade" id="alertpolicy_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Education</h4>
            </div>
            <form id="alertpolicy_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="alertpolicy_id" id="alertpolicy_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Alert Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <!--<input type="text" name="alert_item" id="alert_item" class="form-control input-sm" placeholder="Alert Policy" />-->
                            <select name="alert_item" id="alert_item" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($alert_type_array as $keyy => $vall) {
                                    ?>
                                   <option value="<?php echo $keyy ?>"><?php echo $vall ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">On Days</label>
                        <div class="col-sm-4">
                            <input type="text" name="alert_after_days" id="alert_after_days" class="form-control input-sm" placeholder="Number Of days" />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                            <select name="alert_status" id="alert_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                foreach ($status_array as $key => $val) {
                                    ?>
                                   <option value="<?php echo $key ?>" <?php if($key==1) echo "selected"?>><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label"> Message Template</label>
                        <div class="col-sm-4">
                            <textarea type="text" name="alert_message_template" id="alert_message_template" class="form-control input-sm" placeholder="Message Template"></textarea>
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
    
    $(document).ready(function () {
         $('#dataTables-example-alertpolicy').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_alertpolicy()
    {
        save_method = 'add';
        $('#alertpolicy_form')[0].reset(); // reset form on modals
        
        $("#alert_status").select2({
            placeholder: "Status",
            allowClear: true,
        });

        $("#alert_item").select2({
            placeholder: "Select Alert Type",
            allowClear: true,
        });
    
        $('#alertpolicy_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Alert Policy'); // Set Title to Bootstrap modal title
    }
    
    $("#alert_status").select2({
        placeholder: "Status",
        allowClear: true,
    });
    
    $("#alert_item").select2({
        placeholder: "Select Alert Type",
        allowClear: true,
    });
   
    
</script>