<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <?php if ($type == 1) { //entry ?>
            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_New_Training/save_New_Training" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Training Name <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="training_name" id="training_name" class="form-control input-sm" placeholder="Training Name" />
                        </div>
                        <label class="col-sm-2 control-label">Training Level <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="training_level" id="training_level" class="form-control input-sm" placeholder="Training Level" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Training Type  </label> <!-- <span class="req"/> -->
                        <div class="col-sm-4">
                            <select name="training_type" id="training_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                $training_type_array= $this->Common_model->get_array('training_type');
                                foreach ($training_type_array as $key=>$val):
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Duration (Hours) </label> 
                        <div class="col-sm-4">
                            <input type="text" name="duration" id="duration" class="form-control input-sm" placeholder="Duration (Hours) " />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Company Cost </label> 
                        <div class="col-sm-4">
                            <input type="text" name="company_cost" id="company_cost" class="form-control input-sm" onblur="calculate_cost()" onkeypress="return numbersonly(this, event)" placeholder="Company Cost ( $ )" />
                        </div>
                        <label class="col-sm-2 control-label">Employee Cost </label>
                        <div class="col-sm-4">
                           <input type="text" name="employee_cost" id="employee_cost" class="form-control input-sm" onblur="calculate_cost()" onkeypress="return numbersonly(this, event)" placeholder="Employee Cost ( $ ) " />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Estimation Costing </label> 
                        <div class="col-sm-4">
                            <input type="text" name="estimation_costing" id="estimation_costing" class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Estimation Costing  ( $ ) " />
                        </div>
                        <label class="col-sm-2 control-label">Training Date </label>
                        <div class="col-sm-4">
                            <input type="text" name="plan_date" id="plan_date" class="form-control dt_pick input-sm" placeholder="Plan Date " autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Eligibility</label>
                        <div class="col-sm-4">
                            <select multiple name="eligible[]" id="eligible" class="col-sm-12 col-xs-12 myselect2 input-sm" title="Select Eligibility (multiple)">
                                <option></option>
                                <?php
                                $this->company_id = $this->user_data['company_id'];
                                 if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4 || $this->user_group == 1) {//Hr Manager //Company User //Admin //HR 
                                    $sql = "SELECT * FROM tbl_employmentstatus join main_employmentstatus where main_employmentstatus.workcodename = tbl_employmentstatus.id and main_employmentstatus.company_id = $this->company_id ORDER BY tbl_employmentstatus.employemnt_status ASC"; 
                                    $query_result = $this->db->query($sql);
                                    //$eligible_query = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_id,'isactive' => 1));
                                } else {
                                    $sql = "SELECT * FROM tbl_employmentstatus join main_employmentstatus where main_employmentstatus.workcodename = tbl_employmentstatus.id ORDER BY tbl_employmentstatus.employemnt_status ASC"; 
                                    $query_result = $this->db->query($sql);
                                    //$eligible_query = $this->db->get_where('main_employmentstatus', array('isactive' => 1));
                                }
                                $query_result = $this->db->query($sql);
                                $new_training = $query_result->result();//array_merge(array_splice($valArr, -1), $valArr);
                                foreach ($new_training  as $erow) {
                                    //$eligible_name = $this->Common_model->get_name($this, $erow->workcodename, 'tbl_employmentstatus', 'employemnt_status');
                                    
                                    ?>
                                    <option value="<?php echo $erow->workcodename ?>" ><?php echo $erow->employemnt_status ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Status </label>
                        <div class="col-sm-4">
                            <select name="status" id="status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <?php
                            $status_array = $this->Common_model->get_array('status');
                            foreach ($status_array as $key => $val) {
                                ?>
                                <option value="<?php echo $key ?>" <?php if ($key == 1) echo "selected" ?> ><?php echo $val ?></option>
                                <?php
                            }
                            ?>
                        </select> 
                        </div>
                    </div>
                    <div class="form-group">
<!--                        <label class="col-sm-2 control-label">Basic Information </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="basic_information" name="basic_information"></textarea>
                        </div>-->
                        <label class="col-sm-2 control-label">Course Information </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="course_information" name="course_information"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12 pull-right">
                        <label class="col-sm-12 pull-right"><u><h4>Upload Training Documents  </h4></u></label>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <a href="#" onclick="upload_training_documents();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                <button type="button" class="btn btn-u">Upload</button>
                            </a> 
                            <input type="hidden" name="training_documents" id="training_documents"/>
                            <input type="hidden" name="training_documents_name" id="training_documents_name"/>
                            <label id="training_documents_label"></label>
                        </div>
                    </div>
                    
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_New_Training" ?>">Close</a>
                    </div>
                </form>
            </div>
                <?php
            } else if ($type == 2) {//edit
                ?>
            <div class="col-md-11 col-md-offset-0" style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_New_Training/update_New_Training" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                    <input type="hidden" value="<?php echo $row->id ?>" name="id" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Training Name <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="training_name" id="training_name" value="<?php echo $row->training_name ?>" class="form-control input-sm" placeholder="Training Name" />
                        </div>
                        <label class="col-sm-2 control-label">Training Level <span class="req"/> </label>
                        <div class="col-sm-4">                            
                            <input type="text" name="training_level" id="training_level" value="<?php echo $row->training_level ?>" class="form-control input-sm" placeholder="Training Level" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Training Type  </label> <!-- <span class="req"/> -->
                        <div class="col-sm-4">                            
                            <select name="training_type" id="training_type" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $training_type_array= $this->Common_model->get_array('training_type');
                                foreach ($training_type_array as $key=>$val):
                                    ?>
                                    <option value="<?php echo $key ?>" <?php if ($key == $row->training_type) echo "selected" ?>><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Duration (Hours) </label> 
                        <div class="col-sm-4">                            
                            <input type="text" name="duration" id="duration" value="<?php echo $row->duration ?>" class="form-control input-sm" placeholder="Duration (Hours) " />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Company Cost </label> 
                        <div class="col-sm-4">                            
                            <input type="text" name="company_cost" id="company_cost" value="<?php echo $row->company_cost ?>" class="form-control input-sm" onblur="calculate_cost()" onkeypress="return numbersonly(this, event)" placeholder="Company Cost " />
                        </div>
                        <label class="col-sm-2 control-label">Employee Cost </label>
                        <div class="col-sm-4">
                           <input type="text" name="employee_cost" id="employee_cost" value="<?php echo $row->employee_cost ?>" class="form-control input-sm" onblur="calculate_cost()" onkeypress="return numbersonly(this, event)" placeholder="Employee Cost " />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Estimation Costing </label> 
                        <div class="col-sm-4">                            
                            <input type="text" name="estimation_costing" id="estimation_costing" value="<?php echo $row->estimation_costing ?>" class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Estimation Costing " />
                        </div>
                        <label class="col-sm-2 control-label">Training Date </label>
                        <div class="col-sm-4">
                            <input type="text" name="plan_date" id="plan_date" value="<?php echo $this->Common_model->show_date_formate($row->plan_date) ?>" class="form-control dt_pick input-sm" placeholder="Plan Date " autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Eligibility  </label>
                        <div class="col-sm-4">
                            <select multiple name="eligible[]" id="eligible" class="col-sm-12 col-xs-12 myselect2 input-sm" title="Select Eligibility (multiple)">
                                <option></option>
                                <?php
                                $this->company_id = $this->user_data['company_id'];

                               if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4 || $this->user_group == 1) {//Hr Manager //Company User //Admin //HR
                                    $sql = "SELECT * FROM tbl_employmentstatus join main_employmentstatus where main_employmentstatus.workcodename = tbl_employmentstatus.id and main_employmentstatus.company_id = $this->company_id ORDER BY tbl_employmentstatus.employemnt_status ASC"; 
                                    $query_result = $this->db->query($sql);
                                    //$eligible_query = $this->db->get_where('main_employmentstatus', array('company_id' => $this->company_id,'isactive' => 1));
                                } else {
                                    $sql = "SELECT * FROM tbl_employmentstatus join main_employmentstatus where main_employmentstatus.workcodename = tbl_employmentstatus.id ORDER BY tbl_employmentstatus.employemnt_status ASC"; 
                                    $query_result = $this->db->query($sql);
                                    //$eligible_query = $this->db->get_where('main_employmentstatus', array('isactive' => 1));
                                }
                                $query_result = $this->db->query($sql);
                                $new_training = $query_result->result();//array_merge(array_splice($valArr, -1), $valArr);
                                foreach ($new_training  as $erow) {
                                    
                                $eligible = explode(",", $row->eligible);
                                $isSel = '';
                                foreach($eligible as $is):
                                    if((int)$is == (int)$erow->workcodename){
                                        $isSel = 'selected';
                                        break;
                                    }
                                endforeach;
                                    
                                  //  $eligible_name=$this->Common_model->get_name($this, $erow->workcodename, 'tbl_employmentstatus', 'employemnt_status')
                                    ?>
                                    <option value="<?php echo $erow->workcodename ?>" <?php  echo $isSel; ?> ><?php echo $erow->employemnt_status ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Status </label>
                        <div class="col-sm-4">
                            <select name="status" id="status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                            <?php
                            $status_array = $this->Common_model->get_array('status');
                            foreach ($status_array as $key => $val) {
                                ?>
                                <option value="<?php echo $key ?>" <?php if ($key == $row->isactive) echo "selected" ?> ><?php echo $val ?></option>
                                <?php
                            }
                            ?>
                        </select> 
                        </div>
                    </div>
                    <div class="form-group">
<!--                        <label class="col-sm-2 control-label">Basic Information </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="basic_information" name="basic_information"> <?php // echo $row->basic_information ?> </textarea>
                        </div>-->
                        <label class="col-sm-2 control-label">Course Information </label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="course_information" name="course_information"> <?php echo $row->course_information ?> </textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12 pull-right">
                        <label class="col-sm-12 pull-right"><u><h4>Upload Training Documents  </h4></u></label>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <a href="#" onclick="upload_training_documents();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                <button type="button" class="btn btn-u">Upload</button>
                            </a> 
                            <input type="hidden" name="training_documents" id="training_documents" value="<?php echo $row->training_documents ?>"/>
                            <input type="hidden" name="training_documents_name" id="training_documents_name" value="<?php echo $row->training_documents_name; ?>"/>
                            <label id="training_documents_label"> <?php echo $row->training_documents ?> </label>
                        </div>
                    </div>
                    
                    
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u"> Save </button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_New_Training" ?>">Close</a>
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


<!-- Modal -->
<div class="modal fade" id="training_documents_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
            </div>
            <form id="training_documents_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Document </label>
                        <div class="col-sm-8">
                            <input type="file" name="training_documents_file" id="training_documents_file" size="20" />
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

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {
            
            loading_box(base_url);
            
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                
                var url='<?php echo base_url() ?>Con_New_Training';
                view_message(data,url,'','sky-form11');
               
            });
            event.preventDefault();
        });
    });

    $("#training_type").select2({
        placeholder: "Select Training Type",
        allowClear: true,
    });
    $("#eligible").select2({
        placeholder: "Select Eligibility",
        allowClear: true,
    });
    
    $("#status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });
    
    function upload_training_documents(){
        $('#training_documents_form')[0].reset(); // reset form on modals
        $('#training_documents_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Training Documents'); // Set Title to Bootstrap modal title
    }

    $(function() {
        $('#training_documents_form').submit(function(e) {
            e.preventDefault();
            
            loading_box(base_url);
            
            $.ajaxFileUpload({
                url             :base_url + './Con_New_Training/upload_training_documents/', 
                secureuri       :false,
                fileElementId   :'training_documents_file',
                dataType    : 'JSON',
                success : function (data)
                {
                    
                    var datas = data.split( '__' );
                    $('#training_documents').val(datas[1]);
                    $('#training_documents_label').html(datas[1]);

                    $('#training_documents_name').val(datas[2]);

                    var url='';
                    view_message(datas[0],url,'training_documents_Modal','training_documents_form');
                    
                }
            });
            return false;
        });
    });
    
    function calculate_cost()
    {
        var company_cost = parseFloat($('#company_cost').val(), 10);
        var employee_cost = parseFloat($('#employee_cost').val(), 10);
         
        var estimation_costing = (company_cost + employee_cost);
         
        $('#estimation_costing').val(estimation_costing);
    }
    
     

</script>
<!--=== End Script ===-->

