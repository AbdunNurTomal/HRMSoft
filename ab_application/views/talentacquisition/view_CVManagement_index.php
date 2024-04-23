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
                            <div class="">Candidates</div>
                        </h2>
                        <br>
                        <div class="">Track Candidates who have applied to job openings or have registered their details to apply for future.</div>
                        <br>
                        <div class=" padding-top-5">
                            <a class="btn btn-danger btn-md" href="<?php  echo base_url() . "Con_CVManagement/add_CVManagement" ?>"> Create Candidate </a>
                            <span>or</span>
                            <a class="btn btn-danger btn-md" href="<?php // echo base_url() . "Con_Job_Requisition/add_job_Requisition" ?>"> Import Candidates </a>
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

