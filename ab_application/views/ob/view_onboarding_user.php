<style>
    #radioBtn .notActive{
        color: #3276b1;
        background-color: #fff;
    }
  
</style>
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
            
                <!-- <div class="radio col-md-12">
                    <label>
                        <input id="entry_option" name="entry_option" value="1" type="radio" checked> Fill-up by Company
                    </label>
                </div>
                <div class="radio col-md-12">
                    <label>
                        <input id="entry_option" name="entry_option" value="2" type="radio"> Fill-up by Employee
                    </label>
                </div>-->

                <div class="form-group padding-top-5">
                    <label for="happy" class="col-sm-4 col-md-4 control-label text-right">  </label> 
                    <div class="col-sm-7 col-md-7">
                        <div class="input-group">
                            <div id="radioBtn" class="btn-group">
                                <a class="btn btn-info btn-lg active" data-toggle="happy" data-title="1"> Onboarding by Company </a>
                                <a class="btn btn-info btn-lg notActive" data-toggle="happy" data-title="2"> Onboarding by Email </a>
                            </div>
                            <input type="hidden" name="happy" id="happy" value="1">
                        </div>
                    </div>
                </div>

                </br>
                </br>
                </br>
                <a class="btn btn-u btn-md col-md-offset-5" onclick="add_entry_option()" href="#"><span class="glyphicon glyphicon-plus-sign"></span> Add New Onboarding</a>
        </div>
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->

<script type="text/javascript">
    
    $("#onboarding_user").select2({
        placeholder: "Onboarding User Option",
        allowClear: true,
    });
    
    function add_entry_option()
    {
        //var id=$('input[name=entry_option]:checked').val();
        
        var id=$('#happy').val();
        var url="<?php  echo base_url(); ?>";
        if(id==1)
        {
          window.location = url+"Con_Onboarding/view_onboarding_company_entry_function/";
        }
        else if(id==2)
        {
            window.location = url+"Con_Onboarding/view_onboarding_self_user_function/";
        }
        else
        {
            return;
        }
    }
    
    $('#radioBtn a').on('click', function(){
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
        $('#'+tog).prop('value', sel);

        $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
        $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
    })
    
</script>

