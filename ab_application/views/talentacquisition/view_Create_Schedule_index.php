
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="text-center">
                            <div class="">Interview Schedule</div>
                        </h2>
                        <br>
                        <div class="">Schedule Interviews with candidates who have applied for the job openings.</div>
                        <br>
                        <div class=" padding-top-5">
                            <a class="btn btn-danger btn-md" href="<?php  echo base_url() . "Con_Create_Schedule/add_Create_Schedule" ?>"> Create Schedule </a>
                            
                        </div>
                        <br>
                        <br>
                    </div>
                </div>

                
                
                

            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script type="text/javascript">


</script>
<!--=== End Content ===-->

