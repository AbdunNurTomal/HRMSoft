<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">

            <div class="col-md-12" style="margin-top: 10px">
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Close_Requisition/update_Close_Requisition" enctype="multipart/form-data" role="form" >

                    <div id="employee_review_div">   
                        <div class="panel panel-u margin-bottom-40">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks"></i> Requisition Information </h3>
                            </div>
                            <div class="panel-body">
                                <table id="PersonalInformation" class="table table-responsive table-striped table-bordered table-hover">
                                    <tbody>
                                        <?php
                                        foreach ($query->result() as $row) {
                                            ?>
                                        <input type="hidden" id="requisition_id" name="requisition_id" value="<?php echo $row->id ?>">
                                        <tr>
                                            <th style=" width: 400px; ">Requisition Id : </th>
                                            <td><?php echo $row->requisition_code ?></td>
                                        </tr>
                                        <tr>
                                            <th>Requisitions Date : </th>
                                            <td><?php echo $this->Common_model->show_date_formate($row->requisitions_date) ?> </td>
                                        </tr>
                                        <tr>
                                            <th>Due Date : </th>
                                            <td><?php echo $this->Common_model->show_date_formate($row->due_date) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Location : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $row->location_id, 'main_location', 'location_name'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Department : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $row->department_id, 'main_department', 'department_name'); ?></td>
                                        </tr>
                                        <tr>    
                                            <th>Position : </th>
                                            <td><?php echo $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') ?></td>
                                        </tr>
                                        <tr>    
                                            <th>No. of Positions : </th>
                                            <td><?php echo $row->no_of_positions ?></td>
                                        </tr>
                                        <tr>
                                            <th>Reporting Manager : </th>
                                            <td>
                                                <?php echo $this->Common_model->get_selected_value($this, 'employee_id', $row->reporting_manager_id, 'main_employees', 'first_name'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Employee Category : </th>
                                            <td>
                                                <?php
                                                $employee_type_array = $this->Common_model->get_array('employee_type');
                                                echo ($row->employee_category == 0 ? 'Not Define' : $employee_type_array[$row->employee_category]);
                                                ?>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Wages : </th>
                                            <td>
                                                <?php
                                                $wages_array = array(1 => 'Salary', 2 => 'Hourly');
                                                echo ($row->employee_category == 0 ? 'Not Define' : $wages_array[$row->wages]);
                                                ?>
                                            </td>                                                    </tr>
                                        <tr>
                                            <th>Salary Range : </th>
                                            <td><?php echo $row->salary_range ?></td>
                                        </tr>
                                        <tr>    
                                            <th>Posting : </th>
                                            <td>
                                                <?php
                                                $posting_array = array(1 => 'Internal', 2 => 'Internal & External');
                                                echo ($row->posting == 0 ? 'Not Define' : $employee_type_array[$row->posting]);
                                                ?>
                                            </td>
                                        </tr>
                                        
                                        <tr>    
                                            <th>No Of Application : </th>
                                            <td>
                                                <?php
                                                $this->db->select('id');
                                                $this->db->from('main_cv_management');
                                                $this->db->where('requisition_id',$row->id);
                                                $this->db->where('isactive',1);
                                                $this->db->where('is_close',0);
                                                echo $num_results = $this->db->count_all_results();
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>    
                                            <th>Selected Candidates : </th>
                                            <td>
                                                <?php
                                                $this->db->select('id');
                                                $this->db->from('main_cv_management');
                                                $this->db->where('requisition_id',$row->id);
                                                $this->db->where('status',3);
                                                $this->db->where('isactive',1);
                                                $this->db->where('is_close',0);
                                                echo $num_results = $this->db->count_all_results();
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>    
                                            <th>Rejected Candidates : </th>
                                            <td>
                                                <?php
                                                $this->db->select('id');
                                                $this->db->from('main_cv_management');
                                                $this->db->where('requisition_id',$row->id);
                                                $this->db->where('status',4);
                                                $this->db->where('isactive',1);
                                                $this->db->where('is_close',0);
                                                echo $num_results = $this->db->count_all_results();
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                  
                    <div class="modal-footer">                        
                        <a class="btn btn-danger" href="<?php echo base_url() . "Con_Close_Requisition" ?>"> Close </a>
                        <button type="submit" id="submit" name="submit" class="btn btn-u"> <i class="fa fa-ban" aria-hidden="true"></i> Close Requisition </button>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>

    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_Close_Requisition';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

 
</script>
<!--=== End Script ===-->

