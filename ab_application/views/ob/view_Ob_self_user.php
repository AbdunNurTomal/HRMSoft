
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
            
            <div id="signupbox" style=" margin-top:10px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

                <form id="selfuser_signup_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Ob_self_user/save_self_user" enctype="multipart/form-data" role="form">
                    
                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm" name="firstname" id="firstname" placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control input-sm" name="email" id="email" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control input-sm" name="passwd" id="passwd" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone_no" class="col-md-3 control-label">Phone No</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm" name="phone_no" id="phone_no" placeholder="Phone No">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Create Self User</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Ob_self_user" ?>">Close</a>
                    </div>
                </form>

            </div>
            
        </div>
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->

<script type="text/javascript">
    
   $(function() {
        $("#phone_no").mask("(999) 999-9999");
    });
    
    $(function(){
        $( "#selfuser_signup_form" ).submit(function( event ) {
            loading_box(base_url);
            var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#selfuser_signup_form").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                    var url='';
                    view_message(data,url);
                    
              });
            event.preventDefault();
        });
    });
    
    
</script>

