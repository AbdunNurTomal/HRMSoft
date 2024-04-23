<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="position_div">
        <button class="btn btn-u btn-md" onClick="add_position()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-position" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
             <colgroup>
                <col width="5%">
                <col width="30%">
                <col width="30%">
                <col width="20%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Position</th>
                    <th>GL code</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];

                $query = $this->db->get_where('main_positions', array('company_id' => $this->company_settings_id, 'isactive' => 1));
                //echo $this->db->last_query();

                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->positionname, 'main_jobtitles', 'job_title') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->gl_code . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
                        print"<td><div class='action-buttons '><a href='#' onclick='edit_position(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='#' onclick='delete_position(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="position_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Position   </h4>
                <!--<a href="#" onClick="add_new_position()"> Add New </a>-->
            </div>
            <form id="position_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="position_id" id="position_id"/>
                <div class="modal-body">
                    <div class="form-group"> 
                        <label class="col-sm-2 control-label">
                            <a href="#" onClick="add_new_position()"><span class="glyphicon glyphicon-plus-sign"></span> Add New </a>
                        </label>
                    </div>
                    <div class="form-group"> 
                        <label class="col-sm-2 control-label">Department <span class="req"/> </label>
                        <div class="col-sm-4">
                            <div id="job_family_divv">
                                <select name="job_family" id="job_family" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="load_positionname(this.value)" >
                                    <option></option>
                                    <?php
                                    $this->db->distinct();
                                    $this->db->select('job_family');
                                    $job_family_query = $this->db->get('main_jobtitles');
                                    foreach ($job_family_query->result() as $keyy) :
                                        ?>
                                        <option value="<?php echo $keyy->job_family ?>"><?php echo $keyy->job_family ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">Position <span class="req"/> </label>
                        <div class="col-sm-4">
                            <select name="positionname" id="positionname" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <label class="col-sm-2 control-label">GL code </label>
                        <div class="col-sm-4">
                            <input type="text" name="gl_code" id="gl_code" class="form-control input-sm" placeholder="GL code "/>
                        </div>
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
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

<!-- Modal -->
<div class="modal fade" id="new_position_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Position</h4>
            </div>
            <form id="new_position_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="position_id" id="position_id"/>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 padding-top-5">
                            <div class="form-group">                        
                                <label class="col-sm-3 control-label">Exist Department ?  </label>
                                <div class="col-sm-3 padding-top-5">
                                     <input type="radio" id="exist_job_family" name="exist_job_family" value="1" onclick="toggleSet(this)"> Yes
                                     <input type="radio" id="exist_job_family" name="exist_job_family" value="2" onclick="toggleSet(this)" checked="" > No
                                </div>
                                <label class="col-sm-2 control-label">Department <span class="req"/> </label>
                                <div id="new_job_family_texbox" class="col-sm-4"> 
                                    <input type="text" name="new_job_family" id="new_job_family" class="form-control input-sm" placeholder="Department "/>
                                </div>
                                <div id="new_job_family_dropdown" class="col-sm-4 hidden">
                                    <select name="new_job_family_select" id="new_job_family_select" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $this->db->distinct();
                                        $this->db->select('job_family');
                                        $job_family_query = $this->db->get('main_jobtitles');
                                        foreach ($job_family_query->result() as $keyy) :
                                            ?>
                                            <option value="<?php echo $keyy->job_family ?>"><?php echo $keyy->job_family ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" style="margin-top: 20px; margin-bottom: 20px;">
                            <table id="new_position_table" class="table table-striped table-bordered dt-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th class="mycol">Position </th>
                                        <th class="mycol" style="width: 11%;"> Action </th>
                                    </tr>
                                </thead>
                                <tbody id="new_position_tbody">
                                    <tr id="tr_1">
                                        <td>
                                            <div class="col-sm-12">
                                                <input type="text" name="position_name[]" id="position_name_1" class="form-control input-sm" placeholder="Position " autocomplete="off" />
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_new_position_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                            <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_new_position_row(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
        $('#dataTables-example-position').dataTable({
            "order": [0, "asc"],
            "pageLength": 10,
            "paginationType": "input"
        });
        
        $('.modal').on('hidden.bs.modal', function (e) {
            if ($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });
        
    });

    var save_method; //for save method string
    var table;
    function add_position()
    {
        save_method = 'add';
        $('#position_form')[0].reset(); // reset form on modals
        $('#position_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Position'); // Set Title to Bootstrap modal title
        
        $("#job_family").select2({
            placeholder: "Select Department",
            allowClear: true,
        });
        $("#positionname").select2({
            placeholder: "Select Position",
            allowClear: true,
        });
    }
    function add_new_position()
    {
        save_method = 'add';
        $('#new_position_form')[0].reset(); // reset form on modals
        $('#new_position_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add New Position'); // Set Title to Bootstrap modal title
        
        toggleSet($('input[name="exist_job_family"]:checked').val());
        $("#new_position_tbody").find("tr:gt(0)").remove();
    }
    
    $(function () {
        $("#new_position_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_new_position') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/edit_new_position') ?>";
            }
            $.ajax({
                url: url,
                data: $("#new_position_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#job_family_divv").load(location.href + " #job_family_divv");
            
                var url = '';
                view_message(data, url, 'new_position_Modal', 'new_position_form');
                
                setTimeout(function () {
                    $("#job_family").select2({
                        placeholder: "Job Family",
                        allowClear: true,
                    });
                }, 4000);
                
            });
            event.preventDefault();
        });
    });
    
    
    function load_positionname(id){
      
//        if (ID != '') {
//            var DATA = {
//                "job_family": ID
//            };
//            loading_box(base_url);
//            $.ajax({
//                url: '<?php // echo site_url('Con_configaration/load_positionname'); ?>',
//                data: DATA,
//                dataType: "json",
//                type: "POST",
//                success: function (data) {
//                    $('#positionname').html(data['response']);
//                    loading_box('');
//                }
//            });
//        }
        
        loading_box(base_url);
        $.ajax({
            url: "<?php echo site_url('Con_configaration/load_positionname/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                if(data)
                {
                    $('#positionname').html(data);
                    loading_box('');
                }
                else
                {
                    loading_box('');
                }
            }
        })
    }
    
    $("#job_family").select2({
      placeholder: "Select Department",
      allowClear: true,
    });

    $("#positionname").select2({
        placeholder: "Select Position",
        allowClear: true,
    });
    
    $("#new_job_family_select").select2({
        placeholder: "Select Department",
        allowClear: true,
    });
    
    function toggleSet(rad)
    {
        var type = rad.value;
        if(type==1)
        {
            $("#new_job_family_texbox").addClass("hidden");
            $("#new_job_family_dropdown").removeClass("hidden");
        }
        else
        {
            $("#new_job_family_dropdown").addClass("hidden");
            $("#new_job_family_texbox").removeClass("hidden");
        }
    }
    
    function add_new_position_row(i){
        var rowCount = $('#new_position_tbody tr').length;
        if ($('#position_name_' + rowCount).val() == "")
        {
            alert('Position name Feald Can not be empty.');
            $('#position_name_' + rowCount).focus();
            return;
        } else
        {
            rowCount++;
            $('#new_position_table').append(
            '<tr id="tr_' + rowCount + '">'
            + '<td><div class="col-sm-12"><input class="form-control input-sm" type="text" name="position_name[]" id="position_name_' + rowCount + '"  autocomplete="off" placeholder="Position " /></div></td>'
            + '<td>\n\
                    <a class="btn btn-sm btn-u" id="add_' + rowCount + '" title="Add" onclick="add_new_position_row(' + rowCount + ');"><i class="glyphicon glyphicon-plus" ></i></a>\n\
                    <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_new_position_row(' + rowCount + ');"><i class="glyphicon glyphicon-minus" ></i> </a>\n\
                </td>'
            + '</tr>'
            );
        }

    }
    
    function  remove_new_position_row(i){
        var rowCount = $('#new_position_tbody tr').length;
        if (rowCount != 1)
        {
            $("#new_position_tbody tr:last").remove();
            //$('#tr_' + i).remove();
        }
    }


</script>