
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

             <form class="form-horizontal" action="<?php echo base_url() . 'Con_Rpt_I_9/action_filter/' . $menu_id; ?>" method="post">   
                 <div class="col-md-12" style="margin-top: 10px">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right">Employee </label>
                        <div class="col-sm-3">
                            <select name="employee_id" id="employee_id" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>                           
                                <?php
                                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {//                                      
                                    $sql = "SELECT DISTINCT onboarding_employee_id FROM main_ob_personal_information WHERE company_id=" . $this->company_id;
                                    $amployee = $this->db->query($sql);
                                } else {
                                    $sql = "SELECT DISTINCT onboarding_employee_id FROM main_ob_personal_information";
                                    $amployee = $this->db->query($sql);
                                }
                                foreach ($amployee->result() as $row):
                                    $slct = ($search_criteria['emp_id'] == $row->onboarding_employee_id) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $row->onboarding_employee_id ?>" <?php echo $slct; ?>><?php echo $this->Common_model->get_selected_value($this,'onboarding_employee_id',$row->onboarding_employee_id,'main_ob_personal_information','onboarding_firstname')." ". $this->Common_model->get_selected_value($this,'onboarding_employee_id',$row->onboarding_employee_id,'main_ob_personal_information','onboarding_middlename') ." ". $this->Common_model->get_selected_value($this,'onboarding_employee_id',$row->onboarding_employee_id,'main_ob_personal_information','onboarding_lastname'); ?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                        <div class="col-sm-2 no-padding-left">
                            <button type="submit" id="submit" class="btn btn-u">Search</button>                            
                        </div>
                    </div>
                </div>
            </form>

            <?php if ($show_result) { ?>
            <div class="table-responsive col-md-12 col-centered">
                <table class="table table-striped table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="10%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="I-9-table">
                        <?php
//                        if ($this->user_group == 11 || $this->user_group == 12) {//com //hr manager
//                            $sql = "SELECT a.id,a.onboarding_employee_id,a.onboarding_firstname,a.onboarding_middlename,a.onboarding_lastname,
//                                b.email_address,b.home_phone,b.street_address1,c.id as w4_id,c.isactive
//                                FROM main_ob_personal_information as a LEFT JOIN main_ob_contact_information as b ON a.onboarding_employee_id = b.onboarding_employee_id
//                                LEFT JOIN main_ob_i9 as c ON a.onboarding_employee_id = c.onboarding_employee_id
//                                where c.isactive='1' AND c.company_id = $this->company_id
//                                group by c.onboarding_employee_id";
//                        } else {
//                            $sql = "SELECT a.id,a.onboarding_employee_id,a.onboarding_firstname,a.onboarding_middlename,a.onboarding_lastname,
//                                b.email_address,b.home_phone,b.street_address1,c.id as w4_id,c.isactive
//                                FROM main_ob_personal_information as a LEFT JOIN main_ob_contact_information as b ON a.onboarding_employee_id = b.onboarding_employee_id
//                                LEFT JOIN main_ob_i9 as c ON a.onboarding_employee_id = c.onboarding_employee_id
//                                where c.isactive='1'                          
//                                group by c.onboarding_employee_id";
//                        }
//                        $query = $this->db->query($sql);
                        //echo $this->db->last_query();

                        if ($this->user_group == 11 || $this->user_group == 12) {
                            $this->db->where('company_id', $this->company_id);
                        }
                            
                        if (!empty($search_ids)) {
                           $this->db->where_in('id', $search_ids);
                        }
                        
                        $this->db->where('isactive', 1);
                        $this->db->order_by('onboarding_employee_id ', 'DESC');
                        $query = $this->db->get('main_ob_i9');
                        
                        //echo $this->db->last_query();
                        //exit();
                            
                        if ($query) {

                            foreach ($query->result() as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $this->Common_model->get_selected_value($this,'onboarding_employee_id',$row->onboarding_employee_id,'main_ob_personal_information','onboarding_firstname') . ' ' . $this->Common_model->get_selected_value($this,'onboarding_employee_id',$row->onboarding_employee_id,'main_ob_personal_information','onboarding_middlename') . ' ' . $this->Common_model->get_selected_value($this,'onboarding_employee_id',$row->onboarding_employee_id,'main_ob_personal_information','onboarding_lastname') ?></td>                                    
                                    <td><?php echo $this->Common_model->get_selected_value($this,'onboarding_employee_id',$row->onboarding_employee_id,'main_ob_contact_information','email_address') ?></td>                                    
                                    <td><?php echo $this->Common_model->get_selected_value($this,'onboarding_employee_id',$row->onboarding_employee_id,'main_ob_contact_information','mobile_phone') ?></td>                                    
                                    <td><?php echo $this->Common_model->get_selected_value($this,'onboarding_employee_id',$row->onboarding_employee_id,'main_ob_contact_information','street_address1') ?></td>                                    
                                    <td>                                       
                                        <?php
                                        print "<a title='W4 Report' href='" . base_url() . 'Con_ObI9/download_pdf/' . $row->id . "'><i class='fa fa-download' aria-hidden='true'></i></a>&nbsp;&nbsp;"
                                        ?>                                    
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 
            <?php } ?>
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script>
    
//    $(function () {
//        $("#sky-form11").submit(function (event) {
//
//            var employee_id = $("#employee_id").val();            
//
//            if (employee_id) {
//                var url = $(this).attr('action');
//                $.ajax({
//                    url: url,
//                    data: $("#sky-form11").serialize(),
//                    type: $(this).attr('method')
//                }).done(function (data) {
////                alert(data);return;
//                    $('#I-9-table').html(data); 
//
//                });
//            } else {
//                alert('Please Select Employee');
//            }
//            event.preventDefault();
//        });
//    });

    $("#employee_id").select2({
        placeholder: "Select Employee",
        allowClear: true,
    });


</script>