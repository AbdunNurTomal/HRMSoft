<?php 

$state_query = $this->Common_model->listItem('main_state');

if ($user_type == 1) {
    $email_id = $this->username;
} else {
    $email_id = "";
}

if ($type == 1) {
    
    ?>
        <form id="onboarding_documents_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/save_onboarding_documents" enctype="multipart/form-data" role="form">
            <div class="container">
                <input type="hidden" value="" name="ob_con_emp_id" id="ob_con_emp_id"/>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label class="col-sm-5 control-label"><u><h4>  Attachment Name:</h4></u></label>
                    </div>
                    <?php
                    $this->company_id = $this->user_data['company_id'];
                    $sql = "SELECT * FROM main_company_documents where isactive=1"; 
                    $query_result = $this->db->query($sql);
                    $new_doc_attch = $query_result->result();
                    foreach ($new_doc_attch  as $erow) {
                        ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> <?php echo $erow->document_name ?>  </label>
                        <div class="col-sm-8">
                            <input type="file" name="<?php echo $erow->input_name ?> " id="<?php echo $erow->input_name ?> " size="20" />
                        </div>                   
                    </div>
                        <?php                            
                        }
                    ?>
                </div>

                <div class="col-sm-12">
                    <div class="modal-footer">
                        <!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                        <a class="btn btn-danger" href="<?php //echo base_url() . "Con_Onboarding"  ?>">Close</a>-->

                        <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                        <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>

                    </div>
                </div>
                
            </div>
            
        </form>
    <?php
}else if ($type == 2) { //Update
    ?>

    <form id="onboarding_documents_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/save_onboarding_documents" enctype="multipart/form-data" role="form">
            <div class="container">
            <input type="hidden" value="<?php //echo $row->onboarding_employee_id ?>" name="ob_con_emp_id" id="ob_con_emp_id"/>
                <div class="col-sm-8">
                    
                    <div class="form-group">
                        <label class="col-sm-5 control-label"><u><h4>  Attachment Name:</h4></u></label>               
                    </div>
                    <?php
                    $this->company_id = $this->user_data['company_id'];
                    $sql = "SELECT * FROM main_company_documents where isactive=1"; 
                    $query_result = $this->db->query($sql);
                    $new_doc_attch = $query_result->result();
                    foreach ($new_doc_attch  as $erow) {
                    ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"> <?php echo $erow->document_name ?>  </label>
                            <div class="col-sm-8">
                                <input type="hidden" value="<?php echo $erow->id ?>" name="documents_id[]" id="documents_id"/>
                                <input type="file" name="<?php echo $erow->input_name ?>[]" id="<?php echo $erow->input_name ?> " size="20" />
                            </div>                   
                        </div>
                        <?php                            
                        }
                    ?>
                </div>
                
                <div class="col-sm-12">
                    <div class="modal-footer">
                        <!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                        <a class="btn btn-danger" href="<?php //echo base_url() . "Con_Onboarding"  ?>">Close</a>-->

                        <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                        <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>

                    </div>
                </div>
                
            </div>
            
        </form>

<?php
}
?>


