<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="businesstype_div">
        <button class="btn btn-u btn-md" onClick="add_businesstype()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-businesstype" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
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
                    <th>Business Type</th>
                    <th>Sub Categories</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $this->db->distinct();
                $this->db->select('main_type');
                $business_type_query = $this->db->get('main_business_type');
                                
               //echo $this->db->last_query();
                                
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                $billing_cycle_array = $this->Common_model->get_array('billing_cycle');
                
                $query = $this->db->get_where('main_com_business_type', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $row->business_type . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->sub_categories, 'main_business_type', 'sub_type') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->description) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_businesstype(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_businesstype(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="businesstype_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Business Type</h4>
            </div>
            <form id="businesstype_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="businesstype_id" id="businesstype_id"/>
                <div class="modal-body">
                    <div class="form-group"> 
                        <label class="col-sm-2 control-label">
                            <a href="#" onClick="add_new_business_type()"><span class="glyphicon glyphicon-plus-sign"></span> Add New </a>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Business Type<span class="req"/> </label>
                        <div class="col-sm-4">
                            <div id="business_type_divv">
                                <select name="business_type" id="business_type" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="load_business_type_categories(this.value)" >
                                    <option></option>
                                    <?php 
                                    foreach ($business_type_query->result() as $keyy) : 
                                        ?>
                                        <option value="<?php echo $keyy->main_type ?>"><?php echo $keyy->main_type ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">Sub Categories<span class="req"/> </label>
                        <div class="col-sm-4">
                            <select name="sub_categories" id="sub_categories" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control capitalize" rows="2" id="description" name="description" placeholder="Description"></textarea>
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
<div class="modal fade" id="new_business_type_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Business Type</h4>
            </div>
            <form id="new_business_type_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 padding-top-5">
                            <div class="form-group">                        
                                <label class="col-sm-3 control-label">Exist Type ?  </label>
                                <div class="col-sm-3 padding-top-5">
                                    <input type="radio" id="exist_business_type" name="exist_business_type" value="1" onclick="toggleSetbusiness_type(this)"> Yes
                                    <input type="radio" id="exist_business_type" name="exist_business_type" value="2" onclick="toggleSetbusiness_type(this)" checked="" > No
                                </div>
                                <label class="col-sm-2 control-label">Business Type<span class="req"/></label>
                                <div id="new_business_type_texbox" class="col-sm-4"> 
                                    <input type="text" name="new_business_type" id="new_business_type" class="form-control input-sm" placeholder="Business Type "/>
                                </div>
                                <div id="new_business_type_dropdown" class="col-sm-4 hidden">
                                    <select name="new_business_type_select" id="new_business_type_select" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($business_type_query->result() as $keyy) :
                                            ?>
                                            <option value="<?php echo $keyy->main_type ?>"><?php echo $keyy->main_type ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" style="margin-top: 20px; margin-bottom: 20px;">
                            <table id="new_sub_categories_table" class="table table-striped table-bordered dt-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th class="mycol">Sub Categories </th>
                                        <th class="mycol" style="width: 11%;"> Action </th>
                                    </tr>
                                </thead>
                                <tbody id="new_sub_categories_tbody">
                                    <tr id="tr_1">
                                        <td>
                                            <div class="col-sm-12">
                                                <input type="text" name="new_sub_categories[]" id="new_sub_categories_1" class="form-control input-sm" placeholder="Sub Categories "/>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-u" id="add_1" title="Add" onclick="add_new_sub_categories_row(1);"><i class="glyphicon glyphicon-plus" ></i></a>
                                            <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_new_sub_categories_row(1);"><i class="glyphicon glyphicon-minus" ></i> </a>
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
        $('#dataTables-example-businesstype').dataTable({
            "order": [ 0, "asc" ],
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
    function add_businesstype()
    {
        save_method = 'add';
        $('#businesstype_form')[0].reset(); // reset form on modals
        
        $("#business_type").select2({
            placeholder: "Select Business Type",
            allowClear: true,
        });

        $("#sub_categories").select2({
            placeholder: "Select Sub Categories",
            allowClear: true,
        });
    
        $('#businesstype_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Business Type'); // Set Title to Bootstrap modal title
    }
    
    $("#business_type").select2({
        placeholder: "Select Business Type",
        allowClear: true,
    });
    
    $("#sub_categories").select2({
        placeholder: "Select Sub Categories",
        allowClear: true,
    });
    
    $("#new_business_type_select").select2({
        placeholder: "Select Business Type",
        allowClear: true,
    });
    
    function load_business_type_categories(id)
    {
        //alert (id);
        loading_box(base_url);
        $.ajax({
            url: "<?php echo site_url('Con_configaration/business_type_categories/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                //alert (data);
                if(data)
                {
                    $('#sub_categories').html(data);
                    loading_box('');
                }
                else
                {
                    loading_box('');
                }
            }
        })
    }
    
    function add_new_business_type()
    {
        save_method = 'add';
        $('#new_business_type_form')[0].reset(); // reset form on modals
        $('#new_business_type_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add New Business Type'); // Set Title to Bootstrap modal title
        
        toggleSetbusiness_type($('input[name="exist_business_type"]:checked').val());
        $("#new_sub_categories_tbody").find("tr:gt(0)").remove();
    }
    
    function toggleSetbusiness_type(rad)
    {
        var type = rad.value;
        if(type==1)
        {
            $("#new_business_type_texbox").addClass("hidden");
            $("#new_business_type_dropdown").removeClass("hidden");
        }
        else
        {
            $("#new_business_type_dropdown").addClass("hidden");
            $("#new_business_type_texbox").removeClass("hidden");
        }
    }
    
    $(function () {
        $("#new_business_type_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_new_business_type') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/save_new_business_type') ?>";
            }
            $.ajax({
                url: url,
                data: $("#new_business_type_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                $("#business_type_divv").load(location.href + " #business_type_divv");
            
                var url = '';
                view_message(data, url, 'new_business_type_Modal', 'new_business_type_form');
                
                setTimeout(function () {
                    $("#business_type").select2({
                        placeholder: "Select Business Type",
                        allowClear: true,
                    });
                }, 4000);
                
            });
            event.preventDefault();
        });
    });
    
    function add_new_sub_categories_row(i){
        var rowCount = $('#new_sub_categories_tbody tr').length;
        if ($('#new_sub_categories_' + rowCount).val() == "")
        {
            alert('Sub categories Feald Can not be empty.');
            $('#new_sub_categories_' + rowCount).focus();
            return;
        } else
        {
            rowCount++;
            $('#new_sub_categories_table').append(
            '<tr id="tr_' + rowCount + '">'
            + '<td><div class="col-sm-12"><input class="form-control input-sm" type="text" name="new_sub_categories[]" id="new_sub_categories_' + rowCount + '"  autocomplete="off" placeholder="Sub Categories " /></div></td>'
            + '<td>\n\
                    <a class="btn btn-sm btn-u" id="add_' + rowCount + '" title="Add" onclick="add_new_sub_categories_row(' + rowCount + ');"><i class="glyphicon glyphicon-plus" ></i></a>\n\
                    <a class="btn btn-sm btn-danger"  title="Delete"  onclick="remove_new_sub_categories_row(' + rowCount + ');"><i class="glyphicon glyphicon-minus" ></i> </a>\n\
                </td>'
            + '</tr>'
            );
        }

    }
    
    function  remove_new_sub_categories_row(i){
        var rowCount = $('#new_sub_categories_tbody tr').length;
        if (rowCount != 1)
        {
            $("#new_sub_categories_tbody tr:last").remove();
            //$('#tr_' + i).remove();
        }
    }
    
</script>