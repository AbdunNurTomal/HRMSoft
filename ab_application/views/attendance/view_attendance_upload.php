<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->
            <div id="signupbox" style=" margin-top:10px" class="mainbox col-md-12">
                
                <div class="row margin-bottom-10 margin-top-20">
                    <div class="col-md-5">
                        <div class="bg-light"><!-- You can delete "bg-light" class. It is just to make background color -->
                            <h4><i class="fa fa-align-justify "> </i> Instruction </h4>
                            <p> 1. Please download sample <a href="<?php echo base_url() . "Con_Attendence_Upload/download_temeplete" ?>"> Template </a>.</p>
                            <p> 2. Lookup/Setup is configured before upload. </p>
                            <p> 3. Lookup/Master Data like Employee ID / Attendance Date / In time / Out time . </p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="bg-light"><!-- You can delete "bg-light" class. It is just to make background color -->
                        <form id="Attendence_Upload" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Attendence_Upload/save_Attendence_Upload" enctype="multipart/form-data" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">File Type <span class="req"/> </label>
                                <div class="col-sm-6">                
                                    <select name="upload_file_type" id="upload_file_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        $upload_file_type = array(1 => 'CSV', 2 => 'Excel', 3 => 'TEXT');
                                        foreach ($upload_file_type as $key => $val):
                                            if ($key == 1) {
                                                ?>
                                                <option value="<?php echo $key ?>" <?php if ($key == 1) echo "selected"; ?> ><?php echo $val ?></option>
                                                <?php
                                            }
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" id="submit" class="btn btn-u"> Process </button>
                                </div>
                            </div>
                            <div class="form-group">
                                
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="center center-align">
                                        <a href="#" onclick="add_upload_file();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                            <button type="button" class="btn btn-u">Upload File</button>
                                        </a>   
                                        <input type="hidden" name="attendance_file_name" id="attendance_file_name" />
                                        <label id="attendance_file_label"></label>
                                    </div>
                                </div>
                            </div>
                        </form>    
                        </div>
                    </div>
                </div><!--/row-->
                <?php /* ?>
                <form id="Attendence_Upload" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Attendence_Upload/save_Attendence_Upload" enctype="multipart/form-data" role="form">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">File Type<span class="req"/></label>
                        <div class="col-sm-8">                
                            <select name="upload_file_type" id="upload_file_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $upload_file_type = array(1 => 'CSV', 2 => 'Excel', 3 => 'TEXT');
                                foreach ($upload_file_type as $key => $val):
                                    if ($key == 1) {
                                        ?>
                                        <option value="<?php echo $key ?>" <?php if ($key == 1) echo "selected"; ?> ><?php echo $val ?></option>
                                        <?php
                                    }
                                 endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="center center-align">
                                <a class="btn btn-u" href="<?php echo base_url() . "Con_Attendence_Upload/download_temeplete" ?>"> Download Template </a>
                                <a href="#" onclick="add_upload_file();" class="linkStyle" data-toggle="tooltip" title="Upload">
                                    <button type="button" class="btn btn-u">Upload File</button>
                                </a>   
                                <input type="hidden" name="attendance_file_name" id="attendance_file_name" />
                                <label id="attendance_file_label"></label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u"> Process </button>
                        <!--<a class="btn btn-danger" href="<?php // echo base_url() . "Con_Attendence_Upload" ?>">Close</a>-->
                    </div>

                </form>
                <?php */ ?>
            </div>

        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="attendence_file_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Document</h4>
            </div>
            <form id="attendence_file_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_languages"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Document </label>
                        <div class="col-sm-8">
                            <input type="file" name="userfile" id="userfile" size="20" />
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


<script type="text/javascript">

    $("#upload_file_type").select2({
        placeholder: "Select File Type",
        allowClear: true,
    });
    
    var save_method; //for save method string
    function add_upload_file()
    {
        save_method = 'add';
        $('#attendence_file_form')[0].reset(); // reset form on modals
        $('#attendence_file_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Upload Document'); // Set Title to Bootstrap modal title
    }
    
    $(function() {
        $('#attendence_file_form').submit(function(e) {
            e.preventDefault();
            loading_box(base_url);
            $.ajaxFileUpload({
                url             :base_url + './Con_Attendence_Upload/Attendence_file_Upload/', 
                secureuri       :false,
                fileElementId   :'userfile',
                dataType    : 'JSON',
                success : function (data)
                {
                    var datas = data.split( '__' );
                    $('#attendance_file_name').val(datas[1]);
                    
                    $('#attendance_file_label').empty();
                    $('#attendance_file_label').html(datas[1]);
                    
                    var url = '';
                    view_message(datas[0],url,'attendence_file_Modal','attendence_file_form');

                }
            });
            return false;
        });
    });
    
    
     $(function(){
        $( "#Attendence_Upload" ).submit(function( event ) {
            loading_box(base_url);
            var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#Attendence_Upload").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  
                    var url = '<?php echo base_url() ?>Con_Attendence_Upload';
                    view_message(data,url,'','');
                    
              });
            event.preventDefault();
        });
    });
    
</script>

