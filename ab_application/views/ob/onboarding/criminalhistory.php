<div class="row">
    <!-- data table -->
    <div class="col-md-12" id="ob_criminalhistory_div">
        <button class="btn btn-u btn-md" onClick="add_ob_criminalhistory()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-criminalhistory" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="15%">
                <col width="12%">
                <col width="13%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Offense Type</th>
                    <th>Offense</th>
                    <th>Date</th>
                    <th>City</th>
                    <th>County</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $county_query = $this->Common_model->listItem('main_county');
                $state_query = $this->Common_model->listItem('main_state');
                $offense_type_array = $this->Common_model->get_array('offense_type');
                
                if ($type == 1) {
                    $this->onboarding_employee_data = $this->session->userdata('onboarding_employee');
                    $ob_emp_id = $this->onboarding_employee_data['onboarding_employee_id'];
                } else if ($type == 2) {
                    $ob_emp_id = $ob_emp_id;
                }
                
                $query = $this->db->get_where('main_ob_criminalhistory', array('onboarding_employee_id' => $ob_emp_id,'isactive' => 1));
                if ($query) {
                    $i=0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $offense_type_array[$row->offense_type] . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->offense) . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->offense_date) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->city) . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->county,'main_county','county_name') . "</td>";
                        print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->offense_state,'main_state','state_name') . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_ob_criminalhistory(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_ob_criminalhistory(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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


<div class="modal fade bd-example-modal-lg" id="criminalhistory_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Criminal History</h4>
            </div>
            <form id="onboarding_criminalhistory_form" name="sky-form11" class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="criminalhistory_id"/>
                <input type="hidden" value="" name="onboarding_employee_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Offense Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="offense_type" id="offense_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option value=''></option>
                                <?php
                                foreach ($offense_type_array as $row => $val) {
                                    print"<option value='" . $row . "'>" . $val . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Offense<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="offense" id="offense" class="form-control input-sm"  placeholder="Offense" data-toggle="tooltip" data-placement="bottom" title="Offense">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Offense Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="offense_date" id="offense_date" class="form-control input-sm dt_pick"  placeholder="Offense Date" data-toggle="tooltip" data-placement="bottom" title="Offense Date" autocomplete="off">
                        </div>
                        <label class="col-sm-2 control-label">City<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="city" id="city" class="form-control input-sm"  placeholder="City" data-toggle="tooltip" data-placement="bottom" title="City">
                        </div>
                    </div>
                    <div class="form-group">                       
                        <div>                            
                            <label class="col-sm-2 control-label">State</label>
                            <div class="col-sm-4">
                                <select name="offense_state" id="offense_state" onchange="load_criminal_county(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php foreach ($state_query->result() as $keyy): ?>
                                        <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_abbr ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div id="crcounty_div">
                            <label class="col-sm-2 control-label">County</label>
                            <div class="col-sm-3" id="county_div">
                                <select name="county" id="county_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
//                                    foreach ($county_query->result() as $key):
                                        ?>
<!--                                        <option value="<?php // echo $key->id ?>"><?php // echo $key->county_name ?></option>-->
                                        <?php
//                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                            <a class="btn ntn-u col-sm-1" <a class="btn ntn-u " onClick="add_crcounty()" href="#" title="Add County"><span class="glyphicon glyphicon-plus-sign"></span></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea name="description" id="description" class="form-control" rows="2" placeholder="Description" data-toggle="tooltip" data-placement="top" title="Description"></textarea>
                        </div>
                        
                    </div>
                    
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <textarea class="ckeditor" name="editor1"></textarea>
                        </div>
                        <label class="col-sm-2 control-label"></label>
                    </div>-->

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
<div class="modal fade" id="crcounty_Modal_entry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add languages</h4>
            </div>
            <form id="add_crcounty_entry" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_languages"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label ">County Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="county_name" id="county_name" class="form-control input-sm" placeholder="County Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="2" id="description" name="description" placeholder="Description"></textarea>
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
        $('#dataTables-example-criminalhistory').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5,
            "paginationType": "input"    
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_ob_criminalhistory()
    {
        save_method = 'add';
        $('#onboarding_criminalhistory_form')[0].reset(); // reset form on modals
        
        $("#offense_type").select2({
            placeholder: "Offense Type",
            allowClear: true,
        });

        $("#county_id").select2({
            placeholder: "County",
            allowClear: true,
        });

        $("#offense_state").select2({
            placeholder: "State",
            allowClear: true,
        });
    
        $('#criminalhistory_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Criminal History'); // Set Title to Bootstrap modal title
    }
  
    
    $("#offense_type").select2({
        placeholder: "Offense Type",
        allowClear: true,
    });
    
    $("#county_id").select2({
        placeholder: "County",
        allowClear: true,
    });
    
    $("#offense_state").select2({
        placeholder: "State",
        allowClear: true,
    });
    
    function add_crcounty()
    {
        save_method = 'add';
        $('#add_crcounty_entry')[0].reset(); // reset form on modals
        $('#crcounty_Modal_entry').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add County'); // Set Title to Bootstrap modal title
    }
    
    $(function(){
        $("#add_crcounty_entry" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_County_Settings/save_County_Settings') ?>";
            }            
                $.ajax({
                url: url,
                data: $("#add_crcounty_entry").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {

                    var url='';
                    view_message(data,url,'crcounty_Modal_entry','add_crcounty_entry');
                    
                    $("#crcounty_div").load(location.href + " #crcounty_div");
                    
                    setTimeout(function () {
                        
                        $("#county_id").select2({
                            placeholder: "County",
                            allowClear: true,
                        });
                    
                    }, 1000);
                
                    
              });
            event.preventDefault();
        });
    });   
    
    function load_criminal_county(id) {
//        alert(id);
        $.ajax({
            url: "<?php echo site_url('Con_onboarding_list/load_county_name/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                $('#county_id').html('');
                $('#county_id').empty();

                $('#county_id').html(data);
            }
        });
    }
  
</script>
