
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
                <table id="dataTables-example" class="table table-striped table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="5%">
                        <col width="35%">
                        <col width="20%">
                        <col width="30%">
                        <col width="30%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Billing</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $this->company_id = $this->user_data['company_id'];
                        if ($this->user_group == 11 || $this->user_group == 12) {
                            $this->db->order_by("id", "asc");
                            $query = $this->db->get_where('main_company', array('id' => $this->company_id,'isactive' => '1'));
                        }else if($this->user_group == 1|| $this->user_group == 2 ||$this->user_group == 3) {
                            if($this->company_id==0){
                                $query = $this->db->get_where('main_company', array('isactive' => '1'));
                            }else{
                                $query = $this->db->get_where('main_company', array('id' => $this->company_id,'isactive' => '1'));
                            }
                        }else {
                            //$this->db->order_by("id", "asc");
                            //$query = $this->db->get_where('main_company', array());
                            $this->db->select('com.id as com_id,usr.id as usr_id,com.email as company_email,com.*, usr.*');
                            $this->db->from('main_company as com');
                            $this->db->join('main_users as usr', 'com.company_user_id = usr.id');
                            $this->db->where('usr.parent_user', $this->user_id);
                            $this->db->where('isactive', 1);
                            $this->db->order_by("com.id", "asc");
                            $query = $this->db->get();
                        }
                        //echo $this->db->last_query();

                        //$billing_cycle_arr = $this->Common_model->get_array('billing_cycle');
                        $billing_type_arr = $this->Common_model->get_array('billing_type');

                        //pr($query->result());

                        if ($query) {
                            foreach ($query->result() as $row) {
                                ?>
                                <tr>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row"> Full Name : <?php echo ucwords($row->company_full_name); ?>  </div>
                                            <div class="row"> Short Name : <?php echo ucwords($row->company_short_name) ?></div>
                                        </div>
                                    </td>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Zip Code : <?php echo $row->zip_code ?></div>
                                            <div class="row">Phone : <?php echo $row->phone_1 ?></div>
                                        </div>
                                    </td>
                                    <td style="width: 27%;">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Email : <?php echo $row->email ?></div>
                                            <div class="row">Mobile Phone : <?php echo $row->mobile_phone ?></div>
                                        </div>
                                    </td>
                                    <td style="">
                                        <div class="container" style="text-align: left; margin-left: 20px;">
                                            <div class="row">Billing Cycle: <?php echo $this->Common_model->get_name($this, $row->billing_cycle, 'main_payfrequency_type', 'freqcode'); ?></div>
                                            <div class="row">Billing Type  : <?php if($row->billing_type!=0) { echo $billing_type_arr[$row->billing_type]; } ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php //echo $row->id; ?>
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
        </div><!-- end container well div -->
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->
