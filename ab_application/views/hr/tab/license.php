
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="license_div">
        <button class="btn btn-u btn-md" onClick="add_license()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-license" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
             <colgroup>
                <col width="1%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>License Type</th>
                    <th>State Issued</th>
                    <th>Issued Date</th>
                    <th>Is Expirable</th>
                    <th>Expiration Date</th>
                    <!-- <th>Un Specific Date</th> -->
                    <th>License</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $yes_no_array = $this->Common_model->get_array('yes_no');
                $expirable_array = array(0=>"No Expirable",1=>"Expirable");
                $query = $this->db->get_where('main_emp_license', array('employee_id' => $employee_id,'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . ucwords($row->license_type) . "</td>";
                        print"<td id='catC" . $pdt . "'>" . $yes_no_array[$row->state_issued] . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->issued_date) . "</td>";
                        print"<td id='catC" . $pdt . "'>" . $expirable_array[$row->expirable] . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->expiration_date) . "</td>";
                        // print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->unspecific_date) . "</td>";
                        print"<td title='View License' id='catA" . $pdt . "'><a title='View License' href='" . base_url() . "Con_Employees/download_license/" . $row->license_image . "/" . "' > View License  </a></td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_license(" . $row->id . ")' title='Edit' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_license(" . $row->id . ")' title='Delete'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade bd-example-modal-lg" id="License_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <!--<div class="col-md-10 col-md-offset-2 pull-right" id='messagebox' style="text-align: center; position: absolute; z-index: 9999 !important;"> </div>-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add License</h4>
            </div>
            <form id="emp_license" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_license"/>
                <div class="modal-body">
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">License Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="license_type" id="license_type" class="form-control input-sm" placeholder="License Type" data-toggle="tooltip" data-placement="bottom" title="License Type">
                        </div>
                        <label class="col-sm-2 control-label">State Issued<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="state_issued" id="state_issued" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="change_statname(this.value);" >
                                <option></option>
                                <?php 
                                    foreach ($yes_no_array as $key => $val) {
                                        print"<option value='" . $key . "'>" . $val . "</option>";
                                    }
                                 ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">State Name</label>
                        <div class="col-sm-4">
                            <select name="state_name" id="state_name" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($state_query->result() as $keyy): ?>
                                    <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Issued Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="issued_dates" id="issued_dates" class="form-control dt_pick input-sm" placeholder="Issued Date" data-toggle="tooltip" data-placement="bottom" title="Issued Date" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Is Expirable</label>
                        <div class="col-sm-4">
                            <select name="expirable" id="expirable" onchange="change_expirable(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option value="1"> Expirable </option>
                                <option value="0"> No Expirable </option>                                
                            </select>
                        </div>
                        <div id="ex_id" style="display:none">
                            <label class="col-sm-2 control-label">Expiration Date<span class="req"/></label>
                            <div class="col-sm-4">
                                <input type="text" name="expiration_date" id="expiration_date" class="form-control dt_pick input-sm" placeholder="Expiration Date" data-toggle="tooltip" data-placement="bottom" title="Expiration Date" autocomplete="off">
                            </div>
                        </div>
                        <!-- <label class="col-sm-2 control-label">Un Specific Date </label>
                        <div class="col-sm-4">
                            <input type="text" name="unspecific_date" id="unspecific_date" class="form-control dt_pick input-sm" placeholder="Un Specific Date" data-toggle="tooltip" data-placement="bottom" title="Un Specific Date" autocomplete="off">
                        </div> -->
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea name="description" id="description" class="form-control input-sm" rows="1" placeholder="Description" data-toggle="tooltip" data-placement="top" title="Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label"></label>
                        <div class="col-sm-4">
                            <!--<input type="file" name="license_file" id="license_file" size="20" />-->
                            <a href="#" onclick="add_license_image();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                <button type="button" class="btn btn-u">Upload License</button>
                            </a>                
                            <input type="hidden" name="license_image_path" id="license_image_path" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <img src="<?php echo base_url(); ?>uploads/blank_license.jpg" id="my_license" class="twPc-avatarImg pull-right" alt="License" height="150" width="220">
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


<!-- Modal -->
<div class="modal fade" id="license_image_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
            </div>
            <form id="license_image_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_languages"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Document </label>
                        <div class="col-sm-8">
                            <input type="file" name="license_file" id="license_file" size="20" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



  
<script type="text/javascript">
    
    $(document).ready(function () {
        
        $('.modal').on('hidden.bs.modal', function (e) {
            if ($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });
        
         var table = $('#dataTables-example-license').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5, 
            "paginationType": "input"   
        });
        
    });
   
    var save_method; //for save method string
    var table;
    function add_license()
    {
        save_method = 'add';
        $('#emp_license')[0].reset(); // reset form on modals
        
        $("#state_issued").select2({
            placeholder: "State Issued",
            allowClear: true,
        });

        $("#state_name").select2({
            placeholder: "State Name",
            allowClear: true,
        });

        $("#expirable").select2({
            placeholder: "Is Expirable",
            allowClear: true,
        });

        change_expirable($("#expirable" ).val());
    
        $('#License_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add License'); // Set Title to Bootstrap modal title
    }
    
   
    function add_license_image()
    {
        $('#license_image_form')[0].reset(); // reset form on modals
        $('#license_image_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Upload Document'); // Set Title to Bootstrap modal title
    }
    
    $(function() {
        $('#license_image_form').submit(function(e) {
            e.preventDefault();
            var base_url='<?php echo base_url(); ?>';
            $.ajaxFileUpload({
                url             :base_url + './Con_Employees/upload_license_file/', 
                secureuri       :false,
                fileElementId   :'license_file',
                dataType        :'JSON',
                success : function (data)
                {
                    var datas = data.split( '__' );

                    if (!datas[1]) {
                        var path = base_url +'uploads/blank_license.jpg';
                    } else {
                        var path = base_url +'uploads/emp_license/'+ datas[1];
                    }

                    $("#my_license").removeAttr("src").attr("src", path );
                    $('#license_image_path').val(datas[1]);

                    $('#license_image_form')[0].reset(); 
                    $('#license_image_Modal').modal('hide');

                    var url='';
                    view_message(datas[0],url);
                }
            });
            return false;
        });
    });
 
 
 function change_statname(id)
 {
     if(id==1)
     {
         $( "#state_name" ).prop( "disabled", false );
     }
     else
     {
         $( "#state_name" ).val('');
         $( "#state_name" ).prop( "disabled", true );
     }
 }
 function change_expirable(id)
 {
     if(id==1)
     {
        $('#ex_id').show();
        // $( "#ex_id" ).prop( "disabled", false );
     }
     else
     {
        $('#ex_id').css('display','none');
         $("#expiration_date" ).val('');
         //$( "#state_name" ).prop( "disabled", true );
     }
 }
 
    $("#state_issued").select2({
        placeholder: "State Issued",
        allowClear: true,
    });
    
     $("#state_name").select2({
        placeholder: "State Name",
        allowClear: true,
    });
    
    
</script>