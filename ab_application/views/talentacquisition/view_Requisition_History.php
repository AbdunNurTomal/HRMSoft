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
                <!--<a class="btn btn-u btn-md" href="<?php // echo base_url() . "Con_Close_Requisition/add_job_Requisition" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add New Requisition </a></br></br>-->
                
                <form class="form-horizontal" action="<?php echo base_url(). 'Con_Requisition_History/search_requisition/'; ?>" method="post">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Requisition </label>
                                    <div class="col-sm-8">
                                        <select name="requisition_id" id="requisition_id" class="col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($query->result() as $key) {
                                                $position_id = $this->Common_model->get_name($this, $key->id, 'main_opening_position', 'position_id');
                                                $position_name = $this->Common_model->get_name($this, $position_id, 'main_jobtitles', 'job_title');
                                                
                                                $slct = ($search_criteria['requisition_id'] == $key->id) ? 'selected' : '';
                                                echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->requisition_code . "  ( " . $position_name . " ) " . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Skill Set </label>
                                    <div class="col-sm-8">
                                       <select name="skill_set" id="skill_set" class="col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($skill_query->result() as $key) {
                                                $slct = ($search_criteria['skill_set'] != "" && $search_criteria['skill_set'] == $key->id) ? 'selected' : '';
                                                echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->skill_name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"> Qualification </label>
                                    <div class="col-sm-8">
                                        <select name="qualification" id="qualification" class="col-xs-12 myselect2 input-sm">
                                            <option></option>
                                            <?php
                                            foreach ($educationlevel_query->result() as $key) {
                                                $slct = ($search_criteria['qualification'] != "" && $search_criteria['qualification'] == $key->id) ? 'selected' : '';
                                                echo '<option value="' . $key->id . '" ' . $slct . '>' . $key->educationlevelcode . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn-u center-align"><i class="fa fa-search"></i> Search </button> 
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                <div class="overflow-x">
                <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requisition Id</th>
                            <th>Requisitions Date</th>
                            <th>Due Date</th>
                            <th>Position</th> 
                            <!--<th>Qualification</th>--> 
                            <th>Required Skill</th> 
                            <th>Requisition Status</th> 
                            <th>Is Close</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $approver_status_array= $this->Common_model->get_array('approver_status');
                        if ($query) {
                            $sl = 0;
                            foreach ($query->result() as $row) {
                                $sl++;
                                $pdt = $row->id;
                                $is_close=($row->is_close == '0') ?  'NO' :  'YES';
                                
                                $skill_set_arr = explode(",", $row->required_skills);
                                $skill_set = '';
                                foreach ($skill_set_arr as $intr) {
                                    if ($skill_set == '') {
                                        $skill_set = $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                    } else {
                                        $skill_set = $skill_set . " , " . $this->Common_model->get_name($this, $intr, 'main_skill_setup', 'skill_name');
                                    }
                                }
                                
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $sl . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->requisition_code . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->requisitions_date) . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->due_date) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this, $row->position_id, 'main_jobtitles', 'job_title') . "</td>";
//                                print"<td id='catD" . $pdt . "'>" . $row->required_qualification . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $skill_set . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $approver_status_array[$row->req_status] . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $is_close . "</td>";
                                print"<td><div class='action-buttons '> &nbsp; <a title='Preview' href='" . base_url() . "Con_Requisition_History/view_Requisition_History/" . $row->id . "/'  ><i class='fa fa-lg fa-eye'></i></a>&nbsp;&nbsp;</div> </td>";
                                print"</tr>";
                            }
                        }
                        ?> 
                    </tbody>
                </table>
                </div>
            </div>
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<script type="text/javascript">

    $("#requisition_id").select2({
        placeholder: "Select requisition",
        allowClear: true
    });
    
    $("#skill_set").select2({
        placeholder: "Select skill set",
        allowClear: true
    });
    
    $("#qualification").select2({
        placeholder: "Select qualification",
        allowClear: true
    });
    
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = base_url + "Con_Job_Requisition/delete_job_Requisition/" + id;
        else
            return false;
    }
    
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
<!--=== End Content ===-->

