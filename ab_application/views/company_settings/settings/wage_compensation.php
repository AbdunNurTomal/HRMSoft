<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="WageCompensation_div">
        <!--<button class="btn btn-u btn-md" onClick="add_WageCompensation()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>-->
        <table id="dataTables-example-WageCompensation" class="table table-striped table-bordered dt-responsive table-hover">
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Position </th>
                    <th>GL Codes </th>
                    <th>Wages Type</th>
                    <th>Hourly Rate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                 $positions_query = $this->db->get_where('main_positions', array('company_id' => $this->company_id, 'isactive' => 1));
                 $wage_type_array = $this->Common_model->get_array('wage_type');
                 
                 
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $this->db->select('main_positions.id as idd,main_positions.positionname,main_positions.gl_code,main_wage_compensation.wage_type,main_wage_compensation.hourly_rate');
                $this->db->from('main_positions');
                $this->db->join('main_wage_compensation', 'main_wage_compensation.position = main_positions.positionname', 'left');
                $this->db->where('main_positions.company_id', $this->company_settings_id);
                $query = $this->db->get(); 
                //echo $this->db->last_query();
                
                //$query = $this->db->get_where('main_wage_compensation', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->idd;
                        
                        if($row->wage_type!=NULL){ $wage_type=$wage_type_array[$row->wage_type]; } else {$wage_type="";}
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->positionname, 'main_jobtitles', 'job_title') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->gl_code . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $wage_type . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $row->hourly_rate . "</td>";
                        print"<td><div class='action-buttons '><a href='#' onclick='edit_Wage(" . $row->positionname . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_WageCompensation(" . $row->positionname . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="WageCompensation_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Wage & Compensation</h4>
            </div>
            <form id="WageCompensation_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="wage_id" id="wage_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label"> Position <span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="wage_position" id="wage_position" onchange="set_gl_code(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                               <option></option>
                                <?php foreach ($positions_query->result() as $key): ?>
                                    <option value="<?php echo $key->positionname ?>"><?php echo $this->Common_model->get_name($this, $key->positionname, 'main_jobtitles', 'job_title'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label"> GL Code </label>
                        <div class="col-sm-4">
                            <input type="text" name="wage_gl_code" id="wage_gl_code" class="form-control input-sm" placeholder="GL Code " readonly />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Wage Type <span class="req"/> </label>
                        <div class="col-sm-4">
                            <select name="wage_type" id="wage_type" onchange="change_rate_option(this.value);" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($wage_type_array as $key => $val) {
                                    ?>
                                   <option value="<?php echo $key ?>" ><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label" id="rate_option"> Hourly Rate </label>
                        <div class="col-sm-4">
                            <input type="text" name="hourly_rate" id="hourly_rate" class="form-control input-sm" placeholder="Hourly Rate" />
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
         $('#dataTables-example-WageCompensation').dataTable({
            "order": [ 0, "desc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
        
        change_rate_option($("#wage_type").val());
    });
    
    function edit_Wage(id)
    {
        $.ajax({
            url: "<?php echo site_url('Con_configaration/check_po_Wage/') ?>/" + id,
            type: "POST"

        }).done(function (data) {
            
           //alert (data);
           
            if(data==1)
            {
                edit_WageCompensation(id);
            }
            else
            {
              add_WageCompensation(id);  
            }
        });
        
    }
    
    var save_method; //for save method string
    var table;
    function add_WageCompensation(position)
    {
        save_method = 'add';
        $('#WageCompensation_form')[0].reset(); // reset form on modals
    
        $('#WageCompensation_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Wage & Compensation'); // Set Title to Bootstrap modal title
        
        $('[name="wage_position"]').select2().select2('val',position);
        set_gl_code(position);
    }
    
    $("#wage_position").select2({
        placeholder: "Select Position",
        allowClear: true,
    });
    
    $("#wage_type").select2({
        placeholder: "Select Wage Type",
        allowClear: true,
    });
    
    function change_rate_option(id)
    {
        if(id==0){
            $("#rate_option").html('');
            $("#rate_option").html('Yearly Salary');
            $("#hourly_rate").attr("placeholder", "Yearly Salary ( $ )");
        }
        else
        {
            $("#rate_option").html('');
            $("#rate_option").html('Hourly Rate');
            $("#hourly_rate").attr("placeholder", "Hourly Rate ( % )");
        }
        
    }
    
    function set_gl_code(id)
    {
        $.ajax({
            url: "<?php echo site_url('Con_configaration/get_gl_code/') ?>/" + id,
            type: "POST"

        }).done(function (data) {
           //alert(data);
            $('#wage_gl_code').val(data);
        });
        
    }
   
    
</script>