
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container active">
            <?php
            $i = 0;
            $company_query = $this->db->get_where('main_company', array('createdby ' => $this->user_id));
            foreach ($company_query->result() as $row) {
                $i++;
                ?>
            <div class="container tag-box tag-box-v3" style="margin-top: 10px; width: 96%; padding-bottom: 15px;">
                <h1 style="margin-left: 400px"><?php echo $row->company_full_name; ?></h1>
            </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 10px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            
                <div class="col-lg-6 padding-top-5">                    
                    <div class="panel panel-primary">
                        <div class="panel-heading">Company Information</div> 
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="" class="table table-responsive table-striped table-bordered table-hover">
                                    <tbody>                                            
                                        <tr>
                                            <td>Company Name : </td>
                                            <td><?php echo $row->company_full_name; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Short Name : </td>
                                            <td><?php echo $row->company_short_name; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Address : </td>
                                            <td><?php echo $row->address_1; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>County : </td>
                                            <td><?php echo $this->Common_model->get_name($this, $row->county_id, 'main_county', 'county_name'); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>State : </td>
                                            <td><?php echo $this->Common_model->get_name($this, $row->state, 'main_state', 'state_name'); ?> </td>
                                        </tr>
                                        <tr>
                                            <td>city : </td>
                                            <td><?php echo $row->city; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Zip Code : </td>
                                            <td><?php echo $row->zip_code; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number : </td>
                                            <td><?php echo $row->phone_1; ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>       
                    </div>
                </div>
            
        </div>




        <div class="container tag-box tag-box-v3" style="margin-top: 10px; width: 96%; padding-bottom: 15px;"> 
            <?php
            $company_query = $this->db->get_where('main_location', array('company_id' => $row->id));
            foreach ($company_query->result() as $key) {
                ?>
                <div class="col-lg-6 padding-top-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Location : <?php echo $key->location_name; ?></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="" class="table table-responsive table-striped table-bordered table-hover">
                                    <tbody>                                            
                                        <tr>
                                            <td>Location Name : </td>
                                            <td><?php echo $key->location_name; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Location Code : </td>
                                            <td><?php echo $key->location_code; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Contact Parson : </td>
                                            <td><?php echo $key->contact_person; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Contact Number : </td>
                                            <td><?php echo $key->contact_number; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>County : </td>
                                            <td><?php echo $this->Common_model->get_name($this, $key->county_id, 'main_county', 'county_name'); ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                                             
                    </div>
                </div>
                <?php
            }
            ?> 
        </div><!-- end container well div -->
        <div class="container tag-box tag-box-v3" style="margin-top: 10px; width: 96%; padding-bottom: 15px;"> 
            <?php
            $company_query = $this->db->get_where('main_department', array('company_id' => $row->id));
            foreach ($company_query->result() as $val) {
                ?>
                <div class="col-lg-6 padding-top-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Department : <?php echo $val->department_name; ?></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="" class="table table-responsive table-striped table-bordered table-hover">
                                    <tbody>                                            
                                        <tr>
                                            <td>Department Name : </td>
                                            <td><?php echo $val->department_name; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Department Code : </td>
                                            <td><?php echo $val->department_code; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Start Date : </td>
                                            <td><?php echo $val->started_on; ?> </td>
                                        </tr>                                        
                                        <tr>
                                            <td>Location : </td>
                                            <td><?php echo $this->Common_model->get_name($this, $val->location_id, 'main_county', 'county_name'); ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                                             
                    </div>
                </div>
                <?php
            }
            ?> 
        </div><!-- end container well div -->
    <?php } ?>
        </div>
</div>
</div>

</div><!--/row-->
</div><!--/container-->
