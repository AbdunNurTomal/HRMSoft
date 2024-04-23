<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            
            <div class="row text-center">
                <div class="col-md-1 col-md-offset-5" id='lodingbox' style=" position: absolute; z-index: 9999 !important; box-shadow: 5px 5px 5px rgba(0,0,0,.15);"> </div>
            </div>
            
            <?php
            if ($type == 1) {//entry
                ?>
            <div class="col-md-12" style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_CVManagement/save_CVManagement" enctype="multipart/form-data" role="form" >
                    <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Open Positions </h3>
                            </div>
                            <div class="panel-body">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Requisition ID<span class="req"/> </label>
                        <div class="col-sm-10">                            
                            <select name="requisition_id" id="requisition_id" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                foreach ($opening_position_query->result() as $key):
                                    $position_id=$this->Common_model->get_name($this, $key->id,'main_opening_position', 'position_id');
                                    $position_name=$this->Common_model->get_name($this, $position_id,'main_jobtitles','job_title');
                                    if($req_id)
                                    {
                                        $slct = ($key->id == $req_id) ? 'selected' : '';
                                    }
                                    else
                                    {
                                        $slct="";
                                    }
                                    ?>
                                    <option value="<?php echo $key->id ?>" <?php echo $slct; ?> ><?php echo $key->requisition_code . "  ( ". $position_name ." ) "; ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status </label>
                        <div class="col-sm-10">                            
                            <select name="candidate_status" id="candidate_status" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <?php
                                $candidate_status = $this->Common_model->get_array('candidate_status');
                                foreach ($candidate_status as $key=> $val):
                                    ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Candidate First Name<span class="req"/> </label>
                        <div class="col-sm-10">                            
                            <input type="text" name="candidate_first_name" id="candidate_first_name" class="form-control input-sm" placeholder="Candidate First Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Candidate Last Name<span class="req"/></label>
                        <div class="col-sm-10">                            
                            <input type="text" name="candidate_last_name" id="candidate_last_name" class="form-control input-sm" placeholder="Candidate Last Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="candidate_email" class="col-sm-2 control-label">Email<span class="req"/> </label>
                        <div class="col-sm-10">                            
                            <input type="email" name="candidate_email" id="candidate_email" class="form-control input-sm" placeholder="Email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_number" class="col-sm-2 control-label">Contact Number<span class="req"/> </label>
                        <div class="col-sm-10">                            
                            <input type="text" name="contact_number" id="contact_number" class="form-control input-sm" placeholder="Contact Number" />
                        </div>
                    </div>
                    
                            </div>
                    </div>
                    
                    <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Enter Candidate Details </h3>
                            </div>
                            <div class="panel-body">
                     
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Qualification<span class="req"/> </label>
                        <div class="col-sm-10">                            
                            <input type="text" name="qualification" id="qualification" class="form-control input-sm" placeholder="Qualification" />
                        </div>
                    </div>
                                <div class="form-group">
                        <label class="col-sm-2 control-label">Work Experience<span class="req"/> </label>
                        <div class="col-sm-10">                            
                            <input type="text" name="work_experience" id="work_experience" class="form-control input-sm" placeholder="Work Experience" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Skill Set<span class="req"/> </label>
                        <div class="col-sm-10">  
                            <textarea class="form-control" rows="2" id="skill_set" name="skill_set" placeholder="Skill Set"></textarea>
                        </div>
                    </div>
                                <div class="form-group">
                        <label class="col-sm-2 control-label">Education Summary </label>
                        <div class="col-sm-10"> 
                            <textarea class="form-control" rows="2" id="education_summary" name="education_summary" placeholder="Education Summary"></textarea>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">State </label>
                        <div class="col-sm-10"> 
                            <select name="state" id="state" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $state_query = $this->Common_model->listItem('main_state');
                                foreach ($state_query->result() as $keyy):
                                    ?>
                                    <option value="<?php echo $keyy->id ?>"><?php echo $keyy->state_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    
                    <div class="col-md-12 pull-right">
                        <label class="col-sm-12 pull-right"><u><h4>Upload resume  </h4></u></label>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Resume </label>
                        <div class="col-sm-4">
                            <a href="#" onclick="upload_resume();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                <button type="button" class="btn btn-u">Upload</button>
                            </a> 
                            <input type="hidden" name="upload_resume_path" id="upload_resume_path" />
                        </div>
                    </div>
                            </div>
                    </div>
                    
                    <div class="modal-footer">                        
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_CVManagement" ?>">Close</a>
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                    </div>
                </form>
            </div>
                <?php
            } else if ($type == 2) {//edit
                ?>
            
            <?php
            }
            ?>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="upload_resume_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
            </div>
            <form id="upload_resume_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="candidate_resume_id" id="candidate_resume_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Resume </label>
                        <div class="col-sm-8">
                            <input type="file" name="candidate_resume" id="candidate_resume" size="20" />
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
            $("#candidate_status").attr('disabled',false);
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                
                var url='<?php echo base_url() ?>Con_OpeningsPositions';
                view_message(data,url,'','sky-form11');
                
                $("#candidate_status").attr('disabled',true);
               
            });
            event.preventDefault();
        });
    });
    
    $("#requisition_id").select2({
        placeholder: "Select Requisition ID",
        allowClear: true,
    });
    
    $("#candidate_status").select2({
        placeholder: "Select Status",
        allowClear: true,
    });
    
//    $("#county_id").select2({
//        placeholder: "Select County",
//        allowClear: true,
//    });
    $("#state").select2({
        placeholder: "Select State",
        allowClear: true,
    });
    
    function upload_resume(){
        $('#upload_resume_form')[0].reset(); // reset form on modals
        $('#upload_resume_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Upload Resume'); // Set Title to Bootstrap modal title
    }
    
    $(function() {
        $("#contact_number").mask("(999) 999-9999");
        //$("#contact_number").mask('(999) 999-9999', {placeholder:'X'});
        $("#candidate_status").attr('disabled',true);
        
    });
    
    function load_status_dropdown(id){
        $.ajax({
            url: "<?php echo site_url('Con_CVManagement/load_status_dropdown/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                
                $('#requisitions_status').select2('val','');
                $("#requisitions_status").select2().select2('val',data).attr("disabled", true);
            }
        })
    }
    
    $(function() {
        $('#upload_resume_form').submit(function(e) {
            e.preventDefault();
            
            $.ajaxFileUpload({
                url             :base_url + './Con_CVManagement/upload_resume_file/', 
                secureuri       :false,
                fileElementId   :'candidate_resume',
                dataType    : 'JSON',
                success : function (data)
                {
                        var datas = data.split( '__' );
                        //var path = base_url + 'uploads/emp_license/';
                        $('#upload_resume_path').val(datas[1]);

                        var url='';
                        view_message(datas[0],url,'upload_resume_Modal','upload_resume_form');
                }
            });
            return false;
        });
    });
    
    function load_county(id) {
        $.ajax({
            url: "<?php echo site_url('Con_CVManagement/load_county_name/') ?>/" + id,
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
<!--=== End Script ===-->

