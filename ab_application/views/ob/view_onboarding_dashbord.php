
<div class="col-md-10 main-content-div">
    <div class="main-content">
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Onboarding/add_Onboarding" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th> </th>
                            <th>Company</th>
                            <th>Name</th>
                            <th>Date OF Birth</th>
                            <th>Social Security Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $this->db->get_where('main_ob_personal_information', array('isactive' => 1));
                        if ($query) {
                            foreach ($query->result() as $row) {
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->company_id,'main_company','company_full_name') . "</td>";
                                print"<td id='catD" . $pdt . "'>" . ucwords($row->onboarding_firstname) . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $row->onboarding_dateofbirth . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->onboarding_socialsecuritynumber . "</td>";
                                //print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this,$row->jobpayfrequency,'main_payfrequency','freqtype'). "</td>";
                                print"<td><div class='action-buttons'><a href='" . base_url() . "Con_Onboarding/edit_entry/" . $row->onboarding_employee_id . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
                                print"</tr>"; 
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
