<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; padding-bottom: 15px;">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <?php if ($this->user_type != 2 && $this->user_group != 12 && $this->company_id==0) { ?>
                    <a class="btn btn-u btn-md" href="<?php echo base_url() . "con_configaration/add_company_setting" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                <?php } ?>
                <table id="dataTables-example" class="table table-striped table-hover responsive-table table-wrap" >
                     <colgroup>
                        <col width="1%">
                        <col width="25%">
                        <col width="25%">
                        <col width="20%">
                        <col width="25%">
                        <col width="5%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Billing</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $this->user_data = $this->session->userdata('hr_logged_in');
                        $this->user_id = $this->user_data['id'];
                        $this->company_id = $this->user_data['company_id'];
                        $company_data = $this->session->userdata('company');
                        $this->company_settings_id = $company_data['company_settings_id'];
                        //$this->user_type
                        //echo $this->user_group;
                        if ($this->user_group == 11 || $this->user_group == 12) {
                           
                            $query = $this->db->get_where('main_company',array("id"=>$this->company_id,'isactive' => '1'));
                            //$this->company_id)
                        }else if(($this->user_group == 1 ||$this->user_group == 2||$this->user_group == 3)){
                            if ($this->company_id == 0) {
                                $query = $this->db->get_where('main_company',array('isactive' => '1'));
                            } else {
                                $query = $this->db->get_where('main_company',array("id"=>$this->company_id,'isactive' => '1')); //$this->user_id
                            }

                        }else  {
                            //$query = $this->Common_model->listItem('main_company');
                            $query = $this->db->get_where('main_company',array("id"=>$this->company_id,'isactive' => '1')); //$this->user_id
                        }
                       
                        //echo $this->db->last_query(); 

                        //$billing_cycle_arr = $this->Common_model->get_array('billing_cycle');
                        $billing_type_arr = $this->Common_model->get_array('billing_type');

                        //pr($query->result());

                        if ($query) {
                            foreach ($query->result() as $row) {
                                
                                if ($row->company_logo == "") {
                                    $logo = base_url() . "uploads/blank.png";
                                } else {
                                    $logo = base_url() . "uploads/companylogo/" . $row->company_logo;
                                }
                                ?>
                                <tr onclick="edit_row('<?php echo $row->id; ?>');" style="cursor: pointer;">
                                    <td style="">
                                        <div class="testimonial-info">
                                            <img class="rounded-x" src="<?php echo $logo; ?>" alt="No Image" height="100" width="95">
                                        </div>
                                    </td>
                                    <td style="">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Legal Name : <?php echo ucwords($row->company_full_name); ?> </div>
                                            <div class="row">DBA Name : <?php echo ucwords($row->company_short_name) ?></div>
                                            <div class="row">Address : <?php echo ucwords($row->address_1) ?></div>
                                        </div>
                                    </td>
                                    <td style="">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Zip Code : <?php echo $row->zip_code ?></div>
                                            <div class="row">Phone : <?php echo $row->phone_1 ?></div>
                                            <div class="row">Fax NO  : <?php echo $row->fax_no ?></div>
                                        </div>
                                    </td>
                                    <td style="">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Company ID : <?php echo $row->id ?></div>
                                            <div class="row">Email : <?php echo $row->email ?></div>
                                            <div class="row">Mobile Phone : <?php echo $row->mobile_phone ?></div>
                                        </div>
                                    </td>
                                    <td style="">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Billing Cycle: <?php echo $this->Common_model->get_name($this, $row->billing_cycle, 'main_payfrequency_type', 'freqcode')?></div>
                                            <div class="row">Billing Type  : <?php if($row->billing_type!=0) { echo $billing_type_arr[$row->billing_type]; } else { echo ""; } ?></div>
                                            <div class="row">Rate: <?php echo $row->rate ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a title="Download Report" href="<?php echo base_url() . 'Con_configaration/download_company_info/' . $row->id; ?>"><i class="fa fa-lg fa-download"></i></a>
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
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">


    function edit_row(id)
    {
        window.location = base_url + "Con_configaration/edit_company_setting/" + id;
    }

</script>
<!--=== End Content ===-->
