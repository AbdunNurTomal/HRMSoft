

<div class="col-md-10 main-content-div">
    <div class="main-content">
        
        <div class="container conbre">
            <ol class="breadcrumb">
                <!--<li><a href="<?php // echo base_url() . 'Con_Manage_Module' ?>">HRM</a></li>-->
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
         
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header text-center">
                         <small>You can manage your HR Management system by selecting or de-selecting the below modules.</small>
                    </h2>
                </div>
            </div>
            
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Manage_Module/save_module" enctype="multipart/form-data" role="form" >
                <div class="col-xl-12">
                    <?php
                    $panel_class = array(1 => 'panel-primary', 2 => 'panel-green', 3 => 'panel-yellow', 4 => 'panel-red', 5 => 'panel-blue', 6 => 'panel-red', 7 => 'panel-success', 8 => 'panel-info', 9 => 'panel-success', 10 => 'panel-info', 11 => 'panel-yellow', 12 => 'panel-green', 13 => 'panel-green', 14 => 'panel-info');
                    $panel_icon = array(1 => 'fa-tachometer', 2 => 'fa-shield', 3 => 'fa-book', 4 => 'fa-cog', 5 => 'fa-comments', 6 => 'fa-tasks', 7 => 'fa-shopping-cart', 8 => 'fa-support', 9 => 'fa-comments', 10 => 'fa-tasks', 11 => 'fa-support', 12 => 'fa-tasks', 13 => 'fa-tasks',14 => 'fa-tasks');
                    if ($query) {
                        foreach ($query->result() as $row) {
                            ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel <?php echo $panel_class[$row->id]; ?>">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa <?php echo $panel_icon[$row->id]; ?> fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php //echo $row->id ?></div>
                                                <div><strong><?php echo $row->module_name ?></strong></div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">
                                                <input type="checkbox" value="<?php echo $row->id ?>" id="<?php echo "mod" . $row->id ?>" name="moduleid[]" <?php if($row->status==1){ echo "checked";}?>/> <?php echo $row->module_name ?>
                                            </span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="row text-center">
                    <div class="col-lg-12">
                        <button type="submit" id="submit" class="btn btn-u">Save Configuration</button>
                    </div>
                </div>
            </form>
            
            
        </div>

    </div>
</div>
		 
    </div><!--/end row-->
</div><!--/end container-->

<script type="text/javascript">
    
    $(function(){
        $( "#sky-form11" ).submit(function( event ) {
            //alert ('jhgjh');
           var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                    //alert (data);
                    var url='<?php echo base_url() ?>Con_Manage_Module';
                    view_message(data,url,'','sky-form11');
                   
              });
            event.preventDefault();
        });
    });
    
     
    
</script>