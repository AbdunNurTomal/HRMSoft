
<div class="col-md-10 main-content-div">
    <div class="main-content">
        
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
           <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_DB_Backup/DB_Backup" enctype="multipart/form-data" role="form">
                    <input type="hidden" value="" name="id" id="id"/>
                    <div class="col-sm-6">
                        <div class="form-group margin-top-20">
                            <!--<label class="col-sm-4 control-label">DB Name</label>-->
                            <!--<div class="col-sm-8"> <?php // echo $db_name = $this->db->database; ?></div>-->
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                    <div class="col-sm-12">
                        <div class="modal-footer">
                            <div class="col-sm-6">
                              <button type="submit" id="submit" class="btn btn-u">Backup</button>
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>
                    </div>
                </form> 
        </div><!-- end container well div -->
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

//   $(function(){
//        $( "#sky-form11" ).submit(function( event ) {
//            loading_box(base_url);
//           var url = $(this).attr('action');
//                $.ajax({
//                url: url,
//                data: $("#sky-form11").serialize(),
//                type: $(this).attr('method')
//              }).done(function(data) {
//                 
//                var url='<?php // echo base_url() ?>Con_DB_Backup';
//                view_message(data,url,'','sky-form11');
//                
//              });
//            event.preventDefault();
//        });
//    });

</script>
<!--=== End Content ===-->

