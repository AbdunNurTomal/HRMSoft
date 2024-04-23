<div class="row">
    <!-- data table -->
    <div class="col-md-12" id="ob_reference_div">
        <button class="btn btn-u btn-md" onClick="add_ob_reference()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-reference" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
              <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="30%">
                <col width="20%">
                <col width="20%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Name</th>
                    <th>Relationship</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                    $relationship_status_query = $this->db->get_where('main_relationship_status', array('company_id' => $this->company_id,'isactive' => 1));
                } else {
                    $relationship_status_query = $this->db->get_where('main_relationship_status', array('isactive' => 1));
                }
                
                $relationship_array = $this->Common_model->get_array('relationship_array');
                
                if ($type == 1) {
                    $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
                    $ob_emp_id = $this->onboarding_employee_data['onboarding_employee_id'];
                } else if ($type == 2) {
                    $ob_emp_id = $ob_emp_id;
                }
                
                $query = $this->db->get_where('main_ob_reference', array('onboarding_employee_id' => $ob_emp_id,'isactive' => 1));
                if ($query) {
                    $i=0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->name) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $relationship_array[$row->relationship]. "</td>";
                        print"<td id='catA" . $pdt . "'>" . $row->reference_email . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $row->phone_number . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_ob_reference(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_ob_reference(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>


<div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
    <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
    <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(1)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
</div>


<div class="modal fade bd-example-modal-lg" id="reference_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Reference</h4>
            </div>
            <form id="onboarding_reference_form" name="sky-form11" class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="onboarding_id"/>
                <input type="hidden" value="" name="onboarding_employee_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="name" id="name" class="form-control input-sm"  placeholder="Name" data-toggle="tooltip" data-placement="bottom" title="Name">
                        </div>
                        <label class="col-sm-2 control-label">Relationship<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="relationship" id="relationship" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($relationship_array as $key => $val):
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="email" name="reference_email" id="reference_email" class="form-control input-sm" placeholder="Email" data-toggle="tooltip" data-placement="bottom" title="Email">
                        </div>
                        <label class="col-sm-2 control-label">Phone Number<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="phone_number" id="phone_number" class="form-control input-sm" placeholder="Phone Number" data-toggle="tooltip" data-placement="bottom" title="Phone Number">
                        </div>
                    </div>
                    <div class="form-group">
                       <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="2" id="address" name="address" placeholder="Address"></textarea>
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
       $('#dataTables-example-reference').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5, 
            "paginationType": "input"   
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_ob_reference()
    {
        save_method = 'add';
        $('#onboarding_reference_form')[0].reset(); // reset form on modals
        
        $("#relationship").select2({
            placeholder: "Relationship",
            allowClear: true,
        });
    
        $('#reference_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Reference'); // Set Title to Bootstrap modal title
    }
  
    $(function() {
        $("#phone_number").mask("(999) 999-9999");
    });
    
    $("#relationship").select2({
        placeholder: "Relationship",
        allowClear: true,
    });
  
  
</script>
