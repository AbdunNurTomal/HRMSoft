
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
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                   <colgroup>
                        <col width="1%">
                        <col width="30%">
                        <col width="30%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup> 
                    <thead>
                        <tr>
                            <th>SL </th>
                            <th>Personal Information</th>
                            <th>Contact Information</th>                            
                            <th>Education</th>                            
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4)
                        {
                            $sql = "SELECT a.id,a.onboarding_employee_id,a.onboarding_firstname,a.onboarding_middlename,a.onboarding_lastname,a.onboarding_dateofbirth,a.onboarding_socialsecuritynumber,
                            c.email_address,c.home_phone,c.mobile_phone,c.work_phone,b.status
                            FROM main_ob_personal_information as a JOIN main_ob_send_mail as b ON 
                            a.onboarding_employee_id = b.onboarding_employee_id 
                            LEFT JOIN main_ob_contact_information as c ON 
                            c.onboarding_employee_id = a.onboarding_employee_id 
                            WHERE b.status in ( 1,2,3 ) and a.company_id='" . $this->company_id . "' group by a.onboarding_employee_id ";
                        }
                        else {
                            $sql = "SELECT a.id,a.onboarding_employee_id,a.onboarding_firstname,a.onboarding_middlename,a.onboarding_lastname,a.onboarding_dateofbirth,a.onboarding_socialsecuritynumber,
                            c.email_address,c.home_phone,c.mobile_phone,c.work_phone,b.status
                            FROM main_ob_personal_information as a JOIN main_ob_send_mail as b ON 
                            a.onboarding_employee_id = b.onboarding_employee_id 
                            LEFT JOIN main_ob_contact_information as c ON 
                            c.onboarding_employee_id = a.onboarding_employee_id 
                            WHERE b.status in ( 1,2,3 ) group by a.onboarding_employee_id ";
                        }
                        $query = $this->db->query($sql);
                        //echo $this->db->last_query();
                        $i = 0;
                        if ($query) {
                            foreach ($query->result() as $row) {
                                $pdt = $row->id;
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <div class="container"><b>ID:</b> <?php echo $row->onboarding_employee_id; ?></div>
                                        <div class="container"><b>Name:</b> <?php echo ucwords($row->onboarding_firstname) . ' ' . ucwords($row->onboarding_middlename). ' ' . ucwords($row->onboarding_lastname); ?></div>
                                        <div class="container"><b>Date Of Birth: </b><?php echo $this->Common_model->show_date_formate($row->onboarding_dateofbirth); ?></div>
                                        <div class="container"><b>Social Security Number:</b> <?php echo $number = "XXX-XX-". substr($row->onboarding_socialsecuritynumber, -4); ?></div>
                                    </td>
                                    <td>
                                        <div class="container"><b>Email: </b><?php echo $row->email_address; ?></div>
                                        <div class="container"><b>Home Phon: </b><?php echo $row->home_phone; ?></div>
                                        <div class="container"><b>Mobile Phone: </b><?php echo $row->mobile_phone; ?></div>
                                        <div class="container"><b>Work Phone: </b><?php echo $row->work_phone; ?></div>
                                    </td>
                                    <td>
                                        <?php
                                        $education = $this->db->get_where('main_ob_education', array('onboarding_employee_id =' => $row->onboarding_employee_id));
                                        //echo $this->db->last_query();
                                        foreach ($education->result() as $edrow) {
                                            ?>
                                            <div class="container"><?php echo $this->Common_model->get_name($this, $edrow->educationlevel, 'main_educationlevelcode', 'educationlevelcode'); ?> </div> 
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="container"><?php if($row->status==1) { echo "Submitted"; } else if ($row->status==2) { echo "Hired"; } else if ($row->status==3) { echo "Rejected"; }?></div>
                                        <input type="hidden" name="status_<?php echo $row->status; ?>" id="status_<?php echo $row->status; ?>">
                                    </td>
                                    <td>
                                        
                                        <button id="hbutt_<?php echo $row->status; ?>" class="btn btn-u" onclick="hired_ob_employee(<?php echo $row->onboarding_employee_id; ?>)" <?php if( $row->status==2 || $row->status==3 ) { echo "disabled"; } ?> > Hire </button>
                                        <button id="rbutt_<?php echo $row->status; ?>" class="btn btn-danger" onclick="reject_ob_employee(<?php echo $row->onboarding_employee_id; ?>)" ​​​​​ <?php if( $row->status==2 || $row->status==3 ) { echo "disabled"; } ?> > Reject </button>
                                        <button id="hbutt_<?php echo $row->status; ?>" class="btn btn-u" onclick="view_ob_employee(<?php echo $row->onboarding_employee_id; ?>)"> View </button>


                                        <!--<a class="btn btn-u btn-md" href="#" onclick="show_hired_ob_employee(<?php //echo $row->onboarding_employee_id; ?>)">Hired</a>-->
                                        <!--<a class="btn btn-danger btn-md" id="Rejected_id" href="<?php //echo base_url() . "Con_Onboarding_Information/Rejected_ob_employee" ?>">Rejected</a>--> 
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



<!-- Modal -->
<div class="modal fade" id="hired_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Hired Employee</h4>
            </div>
            <form id="hired_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="hired_emp_id" id="hired_emp_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Date of Joining<span class="req"/></label>
                        <div class="col-sm-8">
                            <input type="text" name="date_of_joining" id="date_of_joining" class="form-control dt_pick" placeholder="Date of Joining" data-toggle="tooltip" data-placement="bottom" title="Date of Joining" autocomplete="off">
                        </div>
                    </div>
                   
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="reject_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Reject Reason</h4>
            </div>
            <form id="reject_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="reject_emp_id" id="reject_emp_id"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Reject Reason<span class="req"/></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="2" id="reject_reason" name="reject_reason"></textarea>
                        </div>
                    </div>
                   
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

		
    </div><!--/row-->
</div><!--/container-->

<script>
   
    var save_method; //for save method string
    var table;
    function hired_ob_employee(onboarding_employee_id)
    {
        save_method = 'add';
        $('#hired_form')[0].reset(); // reset form on modals
        
         $('#hired_emp_id').val(onboarding_employee_id);
         
        $('#hired_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Hired Employee'); // Set Title to Bootstrap modal title
    }
    
    $(function(){
        $("#hired_form" ).submit(function( event ) {
            loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Onboarding_Information/save_hired_ob_employee') ?>";
            }
            else
            {
                url = "<?php echo site_url('Con_Onboarding_Information/save_hired_ob_employee') ?>";
            }
                $.ajax({
                url: url,
                data: $("#hired_form").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  
//                    $('#hired_form')[0].reset();
//                    $('#hired_Modal').modal('hide');
                    
                    var url='<?php echo base_url() ?>Con_Onboarding_Information';
                    view_message(data,url,'hired_Modal','hired_form');
                    
              });
            event.preventDefault();
        });
    });
    
    
    function view_ob_employee(id)
    {       
       var url="<?php echo base_url();?>";
       var win = window.open(url+"Con_Onboarding_Information/view_od_data/"+id, '_blank');
       win.focus();
    }
    
    var save_method; //for save method string
    var table;
    function reject_ob_employee(onboarding_employee_id)
    {
        save_method = 'add';
        $('#reject_form')[0].reset(); // reset form on modals
        
         $('#reject_emp_id').val(onboarding_employee_id);
         
        $('#reject_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Reject Reason'); // Set Title to Bootstrap modal title
    }
    
    $(function(){
        $("#reject_form" ).submit(function( event ) {
            loading_box(base_url);
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_Onboarding_Information/reject_od_employee') ?>";
            }
            else
            {
                url = "<?php echo site_url('Con_Onboarding_Information/reject_od_employee') ?>";
            }
                $.ajax({
                url: url,
                data: $("#reject_form").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  
                    var url='<?php echo base_url() ?>Con_Onboarding_Information';
                    view_message(data,url,'reject_Modal','reject_form');
                    
              });
            event.preventDefault();
        });
    });
   
 
</script>
    

