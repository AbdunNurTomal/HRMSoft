<?php
$employee_data = $this->session->userdata('employee');
$employee_id = $employee_data ['employee_id'];
if($employee_id=="" || $employee_id==null) {$chk_emp=0;} else {$chk_emp=1;}
?>

<script type="text/javascript">
    var is_employee = <?php echo $chk_emp; ?>;
    $(document).ready(function () {
        $("a[data-toggle='tab'").prop('disabled', true);

        $("a[data-toggle='tab'").click(function (e) {
            var target = $(e.target).html();
            if($('#employee_id').val()=="")
            {
                alert('Please add the Employee first to add his ' + target + ' .' );
            }
        });

    });

    function enable_tabs()
    {
        $("a[data-toggle='tab'").prop('disabled', false);
        //$('.nav-tabs a[href="#education"]').tab('show');
    }
    
    function activaTab(tab){
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };
    
    if(is_employee==1)
    {
        $(window).load(function(){
            enable_tabs(); 
        });
    }
    

</script>   
    
<div class="col-md-10 main-content-div">
    <div class="main-content">
        
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        
        <div class="container" style="margin-top: 0px; width: 100%; padding-bottom: 15px;">
            <?php
            if ($type == 1 || $type == 2) { //entry and edit
                $this->db->order_by("sequence", "asc");
                $tabs_query = $this->db->get_where('main_employee_tabs', array('isactive' => 1));
//                foreach ($tabs_query->result() as $row):
//                    echo $row->id."=".preg_replace('/\s+/', '', $row->tabs_name)."</br>";
//                endforeach;
                ?>
                <div class="col-lg-12">
                    <div class="main-content">
                        <div class="row no-margin no-padding">
                            <div class="col-xs-2 well no-margin no-padding" id="tabs"> <!-- required for floating -->
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tabs-left">
                                    <li class="active"><a href="#tabs-1" data-toggle="tab">Employee Details</a></li>
                                    <li class=""><a href="#workrelated" data-toggle="tab">Work Related</a></li>
                                    <li class=""><a href="#asset" data-toggle="tab">Asset Tracking</a></li>
                                    <li class=""><a href="#education" data-toggle="tab">Education</a></li>
                                    <li class=""><a href="#experience" data-toggle="tab">Experience</a></li>
                                    <li class=""><a href="#skills" data-toggle="tab">Skills</a></li>
                                    <li class=""><a href="#languages" data-toggle="tab">Languages</a></li>
                                    <li class=""><a href="#trainingcertification" data-toggle="tab">Training & Certification</a></li>
                                    <li class=""><a href="#license" data-toggle="tab">License</a></li>
                                    <li class=""><a href="#absencetracking" data-toggle="tab">Absence Tracking</a></li>
                                    <li class=""><a href="#emergencycontact" data-toggle="tab">Emergency Contact</a></li>
                                    <li class=""><a href="#actions" data-toggle="tab">Actions</a></li>
                                </ul>
                            </div>

                            <div class="col-xs-10">
                                <!-- Tab panes -->
                                <div class="tab-content well">
                                    <div class="tab-pane active" id="tabs-1"><?php include_once( "tab/emp_basic.php" ); ?>  </div>
                                    <div class="tab-pane" id="workrelated"><?php include_once( "tab/work_related.php" ); ?> </div>
                                    <div class="tab-pane" id="asset"><?php include_once( "tab/assets.php" ); ?> </div>
                                    <div class="tab-pane" id="education"><?php include_once( "tab/education.php" ); ?></div>
                                    <div class="tab-pane" id="experience"><?php include_once( "tab/experiences.php" ); ?></div>
                                    <div class="tab-pane" id="skills"><?php include_once("tab/skills.php"); ?></div>
                                    <div class="tab-pane" id="languages"><?php include_once("tab/emp_languages.php"); ?></div>
                                    <div class="tab-pane" id="trainingcertification"><?php include_once("tab/training_certification.php"); ?></div>
                                    <div class="tab-pane" id="license"><?php include_once("tab/license.php"); ?></div>
                                    <div class="tab-pane" id="absencetracking"><?php include_once("tab/absencetracking.php"); ?></div>
                                    <div class="tab-pane" id="emergencycontact"><?php include_once("tab/emergencycontact.php"); ?></div>
                                    <div class="tab-pane" id="actions"><?php include_once("tab/actions.php"); ?></div>
                                </div>
                            </div>

                            <!--<div class="clearfix"></div>-->

                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
   
    </div><!--/row-->
</div><!--/container-->

<script>
 
    $(function(){
        $( "#sky-form11" ).submit(function( event ) {
            var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  var datas = data.split( '_' );
                    $('#employee_id').val(datas[1]);
                    if(datas[1])
                    {
                          enable_tabs();
                    }
                    
                    $("#messagebox").fadeTo( 200, 0.1, function() {
			$(this).html(datas[0]).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
                    
                    //window.location.reload();
                    //$('#sky-form11')[0].reset();
              });
            event.preventDefault();
        });
    });
    
   $(function(){
        $( "#emp_image" ).submit(function( e ) {
            e.preventDefault();
            var base_url='<?php echo base_url(); ?>';
            $.ajaxFileUpload({
                url             :base_url + './con_Employees/upload_profile_pic/', 
                secureuri       :false,
                fileElementId   :'emp_profile_pic',
                dataType    : 'JSON',
                success : function (data)
                {
                    var datas = data.split( '__' );
                    var path = base_url + 'uploads/emp_image/';
                    $('#img_path').val(path + datas[1]);
                    $('#img_name').val(datas[1]);
                    $("#my_image").removeAttr("src").attr("src", path + datas[1]);
                    
                    $('#emp_image')[0].reset(); 
                    $('#image_Modal').modal('hide');
                }
            });
            return false;
        });
    });
    
    //===========================================work related==========================================
  
  $(function(){
        $("#work_related" ).submit(function( event ) {
            var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#work_related").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                    $("#messagebox").fadeTo( 200, 0.1, function() {
			$(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
                    //window.location.reload();
                    $('#work_related')[0].reset();
              });
            event.preventDefault();
        });
    });
    //===================================end work related===================================================

    //===================================asset===============================================================
    $(function(){
        $("#emp_asset" ).submit(function( event ) {
            var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#emp_asset").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                    $("#messagebox").fadeTo( 200, 0.1, function() {
			$(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
                    //window.location.reload();
                    $('#emp_asset')[0].reset();
              });
            event.preventDefault();
        });
    });
    
    //=====================================end asset==========================================================
   
    //=====================================education==========================================================
    
    $(function(){
        $("#emp_education" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_education') ?>";
                //var url = $(this).attr('action');
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_education') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_education").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                    $('#emp_education')[0].reset();
                    $('#Coy_Modal').modal('hide');
                  
                    $("#dataTables-example-edu").load(location.href + " #dataTables-example-edu");
                        
                    $("#messagebox").fadeTo( 200, 0.1, function() {
			$(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
    function edit_education(id)
    {
        //alert (id);
        save_method = 'update';
        $('#emp_education')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data.id);
                $('[name="id_emp_education"]').val(data.id);
                $('[name="educationlevel"]').select2().select2('val',data.educationlevel);
                $('[name="institution_name"]').val(data.institution_name);
                $('[name="course"]').val(data.course);
                $('[name="from_date"]').val(data.from_date);
                $('[name="to_date"]').val(data.to_date);
                $('[name="percentage"]').val(data.percentage);
                //$('[name="opening_date"]').val(data.setup_date);
                //$('[name="c_status"]').select2().select2('val', data.status);

                $('#Coy_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Company'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
   
    function delete_data_education(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_Employees/delete_entry_education/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                $("#dataTables-example-edu").load(location.href + " #dataTables-example-edu");
                $("#messagebox").fadeTo( 200, 0.1, function() {
                  $(this).html(data).fadeTo(900,1);
                  $('html, body').animate({scrollTop : 0},800);
                  $(this).fadeOut(5000);
                });
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
          });
        }
        else
          return false;
      
        } 

    
    //=======================================end education=====================================================
    
    //=====================================experience==========================================================
    
    $(function(){
        $("#emp_experience" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_experience') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_experience') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_experience").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  
                    $('#emp_experience')[0].reset();
                    $('#Experience_Modal').modal('hide');
                    
                    $("#dataTables-example-experience").load(location.href + " #dataTables-example-experience");
                    
                    $("#messagebox").fadeTo( 200, 0.1, function() {
                        $(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
    function edit_experience(id)
    {
        save_method = 'update';
        $('#emp_experience')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_experience/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data.id);
                $('[name="id_emp_experience"]').val(data.id);
                $('[name="comp_name"]').val(data.comp_name);
                $('[name="comp_website"]').val(data.comp_website);
                $('[name="designation"]').val(data.designation);
                $('[name="from_datee"]').val(data.from_date);
                $('[name="to_datee"]').val(data.to_date);
                $('[name="reason_for_leaving"]').val(data.reason_for_leaving);
                $('[name="reference_name"]').val(data.reference_name);
                $('[name="reference_contact"]').val(data.reference_contact);
                $('[name="reference_email"]').val(data.reference_email);
                
                //$('[name="competencylevelid"]').select2().select2('val',data.competencylevelid);
                //$('[name="c_status"]').select2().select2('val', data.status);

                $('#Experience_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Experience'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
    function delete_data_experience(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_Employees/delete_entry_experience/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                $("#dataTables-example-experience").load(location.href + " #dataTables-example-experience");
                $("#messagebox").fadeTo( 200, 0.1, function() {
                  $(this).html(data).fadeTo(900,1);
                  $('html, body').animate({scrollTop : 0},800);
                  $(this).fadeOut(5000);
                });
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
          });
        }
        else
          return false;
      
        } 

    //=======================================end experience================================================
    
    //=====================================skills==========================================================
    
    $(function(){
        $("#emp_skills" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_skills') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_skills') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_skills").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  
                    $('#emp_skills')[0].reset();
                    $('#skills_Modal').modal('hide');
                    
                    $("#dataTables-example-skills").load(location.href + " #dataTables-example-skills");
                    
                    $("#messagebox").fadeTo( 200, 0.1, function() {
                        $(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
    function edit_skills(id)
    {
        save_method = 'update';
        $('#emp_skills')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_skills/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data.id);
                $('[name="id_emp_skills"]').val(data.id);
                $('[name="skillname"]').val(data.skillname);
                $('[name="yearsofexp"]').val(data.yearsofexp);
                $('[name="competencylevelid"]').select2().select2('val',data.competencylevelid);
                //$('[name="c_status"]').select2().select2('val', data.status);

                $('#skills_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Skills'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
    function delete_data_skills(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_Employees/delete_entry_skills/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                $("#dataTables-example-skills").load(location.href + " #dataTables-example-skills");
                  $("#messagebox").fadeTo( 200, 0.1, function() {
                    $(this).html(data).fadeTo(900,1);
                    $('html, body').animate({scrollTop : 0},800);
                    $(this).fadeOut(5000);
                  });
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
            });
        }
        else
          return false;
      
        } 

    //=======================================end skills=====================================================

    //=====================================emp languages====================================================
   
    $(function(){
        $("#emp_languages" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_languages') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_languages') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_languages").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                   //alert (data);return;
                    $('#emp_languages')[0].reset();
                    $('#languages_Modal').modal('hide');
                    
                    //$('#dataTables-example-languages').DataTable({ajax: "data.json"}).ajax.reload();
                    $("#dataTables-example-languages").load(location.href + " #dataTables-example-languages");
                    
                    $("#messagebox").fadeTo( 200, 0.1, function() {
                        $(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
    function edit_languages(id)
    {
        save_method = 'update';
        $('#emp_languages')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_languages/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data.id);
                $('[name="id_emp_languages"]').val(data.id);
                $('[name="languagesid"]').select2().select2('val',data.languagesid);
                //$('[name="languages_skill"]').multiselect();
                //$('[name="languages_skill"]').select2().select2('val',data.languages_skill);
                
                $('#languages_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Languages'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
    function delete_data_languages(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_Employees/delete_entry_languages/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                $("#dataTables-example-languages").load(location.href + " #dataTables-example-languages");
                  $("#messagebox").fadeTo( 200, 0.1, function() {
                    $(this).html(data).fadeTo(900,1);
                    $('html, body').animate({scrollTop : 0},800);
                    $(this).fadeOut(5000);
                  });
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
            });
        }
        else
          return false;
      
        } 
    
    //=======================================end languages=================================================
    
    //=====================================emp Training & Certification====================================
    
    $(function(){
        $("#emp_certification" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_certification') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_certification') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_certification").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                   //alert (data);return;
                    $('#emp_certification')[0].reset();
                    $('#Certification_Modal').modal('hide');
                    
                    //$('#dataTables-example-languages').DataTable({ajax: "data.json"}).ajax.reload();
                    $("#dataTables-example-certification").load(location.href + " #dataTables-example-certification");
                    
                    $("#messagebox").fadeTo( 200, 0.1, function() {
                        $(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
    function edit_certification(id)
    {
        save_method = 'update';
        $('#emp_certification')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_certification/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data.id);course_name
                $('[name="id_emp_certification"]').val(data.id);
                $('[name="course_name"]').val(data.course_name);
                $('[name="course_level"]').val(data.course_level);
                $('[name="certification_name"]').val(data.certification_name);
                $('[name="issued_datee"]').val(data.issued_date);
                $('[name="description"]').val(data.description);
                //$('[name="languagesid"]').select2().select2('val',data.languagesid);
                
                $('#Certification_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Training & Certification'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
    function delete_data_certification(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_Employees/delete_entry_certification/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                $("#dataTables-example-certification").load(location.href + " #dataTables-example-certification");
                  $("#messagebox").fadeTo( 200, 0.1, function() {
                    $(this).html(data).fadeTo(900,1);
                    $('html, body').animate({scrollTop : 0},800);
                    $(this).fadeOut(5000);
                  });
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
            });
        }
        else
          return false;
      
        } 

    //=======================================end certification=====================================
    
    //=====================================emp License=============================================
    
    $(function(){
        $("#emp_license" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_license') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_license') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_license").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                    $('#emp_license')[0].reset();
                    $('#License_Modal').modal('hide');
                    
                    $("#dataTables-example-license").load(location.href + " #dataTables-example-license");
                   
                    $("#messagebox").fadeTo( 200, 0.1, function() {
                        $(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
    function edit_license(id)
    {
        save_method = 'update';
        $('#emp_license')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_license/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data.id);course_name
                $('[name="id_emp_license"]').val(data.id);
                $('[name="license_type"]').val(data.license_type);
                //$('[name="state_issued"]').val(data.state_issued);
                $('[name="state_issued"]').select2().select2('val',data.state_issued);
                $('[name="state_name"]').select2().select2('val',data.state_name);
                //$('[name="state_name"]').val(data.state_name);
                $('[name="issued_dates"]').val(data.issued_date);
                $('[name="expiration_date"]').val(data.expiration_date);
                $('[name="description"]').val(data.description);
                //$('[name="languagesid"]').select2().select2('val',data.languagesid);
                
                $('#License_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit License'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
   
     function delete_data_license(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_Employees/delete_entry_license/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                $("#dataTables-example-license").load(location.href + " #dataTables-example-license");
                  $("#messagebox").fadeTo( 200, 0.1, function() {
                    $(this).html(data).fadeTo(900,1);
                    $('html, body').animate({scrollTop : 0},800);
                    $(this).fadeOut(5000);
                  });
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
            });
        }
        else
          return false;
      
        } 
    
    //=======================================end License===============================================
    
    //=====================================emp Absence Tracking========================================
    
    $(function(){
        $("#emp_absencetracking" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_absencetracking') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_absencetracking') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_absencetracking").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                   //alert (data);return;
                    $('#emp_absencetracking')[0].reset();
                    $('#Absencetracking_Modal').modal('hide');
                    
                    //$('#dataTables-example-languages').DataTable({ajax: "data.json"}).ajax.reload();
                    $("#dataTables-example-absencetracking").load(location.href + " #dataTables-example-absencetracking");
                   
                    $("#messagebox").fadeTo( 200, 0.1, function() {
                        $(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
    function edit_absencetracking(id)
    {
        save_method = 'update';
        $('#emp_absencetracking')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_absencetracking/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data.id);course_name
                $('[name="id_emp_absencetracking"]').val(data.id);
                $('[name="absent_type"]').select2().select2('val',data.absent_type);
                $('[name="from_datea"]').val(data.from_date);
                $('[name="to_datea"]').val(data.to_date);
                $('[name="total_days"]').val(data.total_days);
                $('[name="details_reason"]').val(data.details_reason);
                
                $('#Absencetracking_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Absence Tracking'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
     function delete_data_absencetracking(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_Employees/delete_entry_absencetracking/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                $("#dataTables-example-absencetracking").load(location.href + " #dataTables-example-absencetracking");
                  $("#messagebox").fadeTo( 200, 0.1, function() {
                    $(this).html(data).fadeTo(900,1);
                    $('html, body').animate({scrollTop : 0},800);
                    $(this).fadeOut(5000);
                  });
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
            });
        }
        else
          return false;
      
        } 

    
    //=======================================end Absence Tracking===========================================
    
    //=====================================emp emergency contact============================================
    
    $(function(){
        $("#emp_emergencycontact" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_emergencycontact') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_emergencycontact') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_emergencycontact").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                   //alert (data);return;
                    $('#emp_emergencycontact')[0].reset();
                    $('#Emergencycontact_Modal').modal('hide');
                    
                    //$('#dataTables-example-languages').DataTable({ajax: "data.json"}).ajax.reload();
                    $("#dataTables-example-emergencycontact").load(location.href + " #dataTables-example-emergencycontact");
                   
                    $("#messagebox").fadeTo( 200, 0.1, function() {
                        $(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
    function edit_emergencycontact(id)
    {
        save_method = 'update';
        $('#emp_emergencycontact')[0].reset(); // reset form on modals

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_emergencycontact/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_emp_emergencycontact"]').val(data.id);
                $('[name="em_first_name"]').val(data.first_name);
                $('[name="em_last_name"]').val(data.last_name);
                $('[name="em_occupation"]').val(data.occupation);
                $('[name="em_relationship"]').val(data.relationship);
                $('[name="em_first_address"]').val(data.first_address);
                $('[name="em_second_address"]').val(data.second_address);
                $('[name="em_city"]').val(data.city);
                $('[name="em_state"]').select2().select2('val',data.state);
                $('[name="em_zipcode"]').val(data.zipcode);
                $('[name="em_phone"]').val(data.phone);
                $('[name="em_mobile"]').val(data.mobile);
                $('[name="em_description"]').val(data.description);
                
                $('#Emergencycontact_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Emergency Contact'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
     function delete_data_emergencycontact(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_Employees/delete_entry_emergencycontact/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                $("#dataTables-example-emergencycontact").load(location.href + " #dataTables-example-emergencycontact");
                $("#messagebox").fadeTo( 200, 0.1, function() {
                  $(this).html(data).fadeTo(900,1);
                  $('html, body').animate({scrollTop : 0},800);
                  $(this).fadeOut(5000);
                });
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
            });
        }
        else
          return false;
      
        } 

    
    //=======================================end emergency contact==============================================
    
    //=====================================emp Actions==========================================================
    
    $(function(){
        $("#emp_inc_action" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_inc_actions') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_inc_actions') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_inc_action").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                   //alert (data);return;
                    $('#emp_inc_action')[0].reset();
                    $('#Inc_Modal').modal('hide');
                    
                    //$('#dataTables-example-languages').DataTable({ajax: "data.json"}).ajax.reload();
                    $("#dataTables-example-actions").load(location.href + " #dataTables-example-actions");
                   
                    $("#messagebox").fadeTo( 200, 0.1, function() {
                        $(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
     $(function(){
        $("#emp_accident_action" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_Employees/save_emp_acc_actions') ?>";
            }
            else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_acc_actions') ?>";
            }
                $.ajax({
                url: url,
                data: $("#emp_accident_action").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                   //alert (data);return;
                    $('#emp_accident_action')[0].reset();
                    $('#accident_Modal').modal('hide');
                    
                    //$('#dataTables-example-languages').DataTable({ajax: "data.json"}).ajax.reload();
                    $("#dataTables-example-actions").load(location.href + " #dataTables-example-actions");
                   
                    $("#messagebox").fadeTo( 200, 0.1, function() {
                        $(this).html(data).fadeTo(900,1);
                        $('html, body').animate({scrollTop : 0},800);
                        $(this).fadeOut(5000);
                    });
              });
            event.preventDefault();
        });
    });
    
    function edit_action(id)
    {
        save_method = 'update';
        $('#emp_inc_action')[0].reset(); // reset form on modals
        $('#emp_accident_action')[0].reset();
        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('con_Employees/ajax_edit_actions/') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if(data.action_type==1)//incident
                {
                    $('[name="id_emp_inc"]').val(data.id);
                    $('[name="inc_action_date"]').val(data.action_date);
                    $('[name="incident_category"]').select2().select2('val',data.incident_category);
                    $('[name="tncident_type"]').select2().select2('val',data.tncident_type);
                    
                    $('[name="inc_report_supervisor"]').val(data.report_supervisor);
                    if(data.report_supervisor==1) {
                        $('#inc_report_supervisor').attr('checked', true);
                        $('#sup').removeClass("hidden");
                        $('#supp').removeClass("hidden");
                        $('[name="inc_supervisor_report_date"]').val(data.supervisor_report_date);
                        $('[name="inc_supervisor_reported_by"]').val(data.supervisor_reported_by);
                    } else {
                        $('#inc_report_supervisor').attr('checked', false);
                        $('#sup').addClass("hidden");
                        $('#supp').addClass("hidden");
                    }
                    
                    $('[name="inc_report_hr"]').val(data.report_hr);
                    if(data.report_hr==1) {
                        $('#inc_report_hr').attr('checked', true);
                        $('#hr').removeClass("hidden");
                        $('#hrr').removeClass("hidden");
                        $('[name="inc_hr_report_date"]').val(data.hr_report_date);
                        $('[name="inc_hr_reported_by"]').val(data.hr_reported_by);
                    } else {
                        $('#inc_report_hr').attr('checked', false);
                        $('#hr').addClass("hidden");
                        $('#hrr').addClass("hidden");
                    }
                    
                    $('[name="inc_short_description"]').val(data.short_description);
                    $('[name="inc_long_description"]').val(data.long_description);
                    $('[name="inc_employee_comments"]').val(data.employee_comments);
                    
                    
                    if(data.discipline_type)
                    {
                        $('[name="inc_discipline_type"]').select2().select2('val',data.discipline_type);
                        change_inc_data(data.discipline_type);
                    }
                    
                    $('[name="inc_verbal_warning_by"]').val(data.verbal_warning_by);
                    $('[name="inc_written_warning_by"]').val(data.written_warning_by);
                    $('[name="inc_counseled_by"]').val(data.counseled_by);
                    $('[name="inc_suspended_from"]').val(data.suspended_from);
                    $('[name="inc_suspended_to"]').val(data.suspended_to);
                    $('[name="inc_subject"]').val(data.subject);
                    $('[name="inc_description"]').val(data.description);
                    $('[name="inc_improvement_plan"]').val(data.improvement_plan);
                    $('[name="inc_further_actions"]').val(data.further_actions);

                    $('#Inc_Modal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Incident'); // Set title to Bootstrap modal title
                }
                else//accident
                {
                    $('[name="id_emp_accident"]').val(data.id);
                    $('[name="accident_action_date"]').val(data.action_date);
                    $('[name="accident_location"]').val(data.accident_location);
                    $('[name="acc_report_supervisor"]').val(data.report_supervisor);
                    if(data.report_supervisor==1) {
                        $('#acc_report_supervisor').attr('checked', true);
                        $('#accsup').removeClass("hidden");
                        $('#accsupp').removeClass("hidden");
                        $('[name="acc_supervisor_report_date"]').val(data.supervisor_report_date);
                        $('[name="acc_supervisor_reported_by"]').val(data.supervisor_reported_by);
                    } else {
                        $('#acc_report_supervisor').attr('checked', false);
                        $('#accsup').addClass("hidden");
                        $('#accsupp').addClass("hidden");
                    }
                    
                    $('[name="acc_report_hr"]').val(data.report_hr);
                    if(data.report_hr==1) {
                        $('#acc_report_hr').attr('checked', true);
                        $('#acchr').removeClass("hidden");
                        $('#acchrr').removeClass("hidden");
                        $('[name="acc_hr_report_date"]').val(data.hr_report_date);
                        $('[name="acc_hr_reported_by"]').val(data.hr_reported_by);
                    } else {
                        $('#acc_report_hr').attr('checked', false);
                        $('#acchr').addClass("hidden");
                        $('#acchrr').addClass("hidden");
                    }
                    
                    $('[name="acc_short_description"]').val(data.short_description);
                    $('[name="acc_long_description"]').val(data.long_description);
                    $('[name="acc_employee_comments"]').val(data.employee_comments);
                    $('[name="requires_hospitalization"]').val(data.requires_hospitalization);
                     if(data.requires_hospitalization==1) {
                        $('#requires_hospitalization').attr('checked', true); 
                        $('#clname').removeClass("hidden");
                        $('[name="clinic_name"]').val(data.clinic_name);
                     }
                     else
                     {
                        $('#requires_hospitalization').attr('checked', false);
                        $('#clname').addClass("hidden"); 
                     }
                     
                    if(data.discipline_type)
                    {
                        $('[name="acc_discipline_type"]').select2().select2('val',data.discipline_type);
                        change_acc_data(data.discipline_type);
                    }
                    
                    $('[name="acc_verbal_warning_by"]').val(data.verbal_warning_by);
                    $('[name="acc_written_warning_by"]').val(data.written_warning_by);
                    $('[name="acc_counseled_by"]').val(data.counseled_by);
                    $('[name="acc_suspended_from"]').val(data.suspended_from);
                    $('[name="acc_suspended_to"]').val(data.suspended_to);
                    $('[name="acc_subject"]').val(data.subject);
                    $('[name="acc_description"]').val(data.description);
                    $('[name="acc_improvement_plan"]').val(data.improvement_plan);
                    $('[name="acc_further_actions"]').val(data.further_actions);

                    $('#accident_Modal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Accident'); // Set title to Bootstrap modal title
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
     function delete_data_action(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
        { 
           $.ajax({
            url: "<?php echo site_url('con_Employees/delete_entry_actions/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                $("#dataTables-example-actions").load(location.href + " #dataTables-example-actions");
                  $("#messagebox").fadeTo( 200, 0.1, function() {
                    $(this).html(data).fadeTo(900,1);
                    $('html, body').animate({scrollTop : 0},800);
                    $(this).fadeOut(5000);
                  });
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
            });
        }
        else
          return false;
      
        } 

    
    //=======================================end Actions===============================================

</script>
