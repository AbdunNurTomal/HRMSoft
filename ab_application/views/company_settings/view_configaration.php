
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="row padding-top-5">
            <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">

                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header text-center">
                            <small>Configuration Wizard allows you to configure settings that reflect requirements unique to your organization and make your application ready to use</small>
                        </h2>
                    </div>
                </div>

                <a onclick="add_company_settings()" href="#">
                    <div class="col-lg-4 col-lg-offset-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shield fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
<!--                                        <div class="huge">2</div>-->
                                        <div><strong>Company Settings</strong></div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <span><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>

    </div>
</div>


</div><!--/end row-->
</div><!--/end container-->


<script type="text/javascript">

    //==========================================================================

    var save_method; //for save method string

    $(function () {
        $("#con_module").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('con_configaration/save_module') ?>";
            } else
            {
                url = "<?php echo site_url('con_Employees/edit_emp_pto') ?>";
            }
            loading_box(base_url);
            $.ajax({
                url: url,
                data: $("#con_module").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //$('#con_module')[0].reset();
                //$('#leave_Modal').modal('hide');
                // $("#dataTables-example-pto").load(location.href + " #dataTables-example-pto");

                var url = '';
                view_message(data, url,'module_Modal','con_module');
            });
            event.preventDefault();
        });
    });

    //==========================================================================

    //==========================================================================
    
    function add_company_settings()
    {
        window.location = base_url+"Con_configaration/view_company_setting_list/";
    }
    
  
    
</script>


