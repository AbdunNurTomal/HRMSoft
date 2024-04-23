
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
            <?php 
            if($user_type==1)
            {
            ?>
                <li class="active" >Welcome <?php echo $this->name; ?></li>
            <?php 
            }
            else{
                ?>
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
                <?php
            }
            ?>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px; padding-top: 20px;">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL </th>
                            <th>Personal Information</th>
                            <th>Contact Information</th>                            
                            <th>Status</th>
                            <!--<th>Action</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($this->user_group==9 || $this->user_group_ParentId==9)//Onboarding User
                        {
                             $sql = "SELECT a.id,a.onboarding_employee_id,a.onboarding_firstname,a.onboarding_middlename,a.onboarding_lastname,a.onboarding_dateofbirth,a.onboarding_socialsecuritynumber,a.isactive,a.createdby,a.gender,
                                b.email_address,b.home_phone,b.mobile_phone,b.work_phone
                                FROM main_ob_personal_information as a LEFT JOIN main_ob_contact_information as b ON 
                                a.onboarding_employee_id = b.onboarding_employee_id  where a.createdby=$this->user_id and a.isactive='1'                           
                                group by a.onboarding_employee_id";
                        }
                        else if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                            $sql = "SELECT a.id,a.onboarding_employee_id,a.onboarding_firstname,a.onboarding_middlename,a.onboarding_lastname,a.onboarding_dateofbirth,a.onboarding_socialsecuritynumber,a.isactive,a.gender,
                                b.email_address,b.home_phone,b.mobile_phone,b.work_phone
                                FROM main_ob_personal_information as a LEFT JOIN main_ob_contact_information as b ON 
                                a.onboarding_employee_id = b.onboarding_employee_id where a.company_id=$this->company_id  and a.isactive='1'                              
                                group by a.onboarding_employee_id";
                        }
                        else if ($this->user_group == 1 || $this->user_group == 2 || $this->user_group == 3) {//Service Provider //Partner //Group
                           $sql = "SELECT a.id,a.company_id,a.onboarding_employee_id,a.onboarding_firstname,a.onboarding_middlename,a.onboarding_lastname,a.onboarding_dateofbirth,a.onboarding_socialsecuritynumber,a.isactive,a.gender,
                                b.email_address,b.home_phone,b.mobile_phone,b.work_phone
                                FROM main_ob_personal_information as a LEFT JOIN main_ob_contact_information as b ON 
                                a.onboarding_employee_id = b.onboarding_employee_id  where a.company_id='0' and a.isactive='1' and a.createdby IN (" . get_sub_users($this->user_id) . ")                            
                                group by a.onboarding_employee_id ";
                        }
                        else {
                            $sql = "SELECT a.id,a.onboarding_employee_id,a.onboarding_firstname,a.onboarding_middlename,a.onboarding_lastname,a.onboarding_dateofbirth,a.onboarding_socialsecuritynumber,a.isactive,a.gender,
                                b.email_address,b.home_phone,b.mobile_phone,b.work_phone
                                FROM main_ob_personal_information as a LEFT JOIN main_ob_contact_information as b ON 
                                a.onboarding_employee_id = b.onboarding_employee_id  where a.isactive='1'                            
                                group by a.onboarding_employee_id ";
                            
                        }
                        $query = $this->db->query($sql);
                        //echo $this->db->last_query();
                        
                        $gender_arr=$this->Common_model->get_array('gender');
                        $i = 0;
                        if ($query) {
                            foreach ($query->result() as $row) {
                                
                                if($row->gender==0)
                                {
                                   $genderr=""; 
                                }
                                else {
                                   $genderr=$gender_arr[$row->gender];
                                }
                                
                                $pdt = $row->id;
                                $i++;
                                ?>
                                <tr onclick="edit_ob_row('<?php echo $row->onboarding_employee_id; ?>');" style="cursor: pointer;">
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <div class="container"><b>ID:</b> <?php echo $row->onboarding_employee_id; ?></div>
                                        <div class="container"><b>Name:</b> <?php echo ucwords($row->onboarding_firstname) . ' ' . ucwords($row->onboarding_middlename). ' ' . ucwords($row->onboarding_lastname); ?></div>
                                        <div class="container"><b>Date Of Birth: </b><?php echo $this->Common_model->show_date_formate($row->onboarding_dateofbirth); ?></div>
                                        <div class="container"><b>SSN:</b> <?php echo $number = "XXX-XX-". substr($row->onboarding_socialsecuritynumber, -4); ?></div>
                                        <!--<div class="container"><b>Gender:</b> <?php // echo $genderr; ?></div>-->
                                    </td>
                                    <td>
                                        <div class="container"><b>Email: </b><?php echo $row->email_address; ?></div>
                                        <div class="container"><b>Mobile Phone: </b><?php echo $row->mobile_phone; ?></div>
                                        <div class="container"><b>Work Phone: </b><?php echo $row->work_phone; ?></div>
                                    </td>
                                    <td>
                                        <?php
                                        $ob_send = $this->db->get_where('main_ob_send_mail', array('onboarding_employee_id =' => $row->onboarding_employee_id))->row();
                                            ?>
                                            <div class="container">
                                                <?php
                                                if($ob_send->status==0) echo "In Progress";
                                                else if($ob_send->status==1) echo "Submited";
                                                else if($ob_send->status==2) echo "Hired";
                                                else if($ob_send->status==3) echo "Reject";
                                                else echo "In Progress";
                                                    ?>
                                            </div>
                                        
<!--                                        <div>
                                            <a onClick="review_ob_data('<?php // echo $row->onboarding_employee_id; ?>')" href="#"><span class="badge badge-u" style=" margin-top: 15px;">Review</span></a>
                                        </div>-->
                                    </td>                                    
<!--                                    <td>
                                        <?php
                                        //print"<div class='action-buttons'><a href='" . base_url() . "Con_onboarding_list/edit_onboarding_employee/" . $row->onboarding_employee_id . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div>";
                                        ?>
                                    </td>-->
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table -->
        </div>
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    var url="<?php echo base_url();?>";
//    function delete_data(id){
//    var r=confirm("Do you want to delete this?")
//    if (r==true)
//      window.location = url+"con_Employees/delete_entry/"+id;
//    else
//      return false;
//    }

    function edit_ob_row(ob_emp_id)
    {
        window.location = url+"Con_onboarding_list/edit_onboarding_employee/"+ob_emp_id;
    }
    
//    function review_ob_data(ob_emp_id)
//    {
//        window.location = url+"Con_onboarding_list/review_onboarding_employee/"+ob_emp_id;
//    }
   
</script>
<!--=== End Content ===-->
