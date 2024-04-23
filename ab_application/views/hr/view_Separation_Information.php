
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                <!--<button class="btn btn-u btn-md" onClick="add_Separation_Information()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>-->
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_Separation_Information/add_separation_information" ?>"><span class="glyphicon glyphicon-plus-sign"></span> Add Separation </a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                   <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="10%">
                        <col width="25%">
                        <col width="25%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee</th>
                            <th>Separation Type</th>
                            <th>Description</th>
                            <th>Documents</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 4) {
                            $this->db->select('em.employee_id,em.first_name');
                            $this->db->from('main_employees as em');
                            $this->db->join('main_emp_separation as ems', 'em.employee_id = ems.employee_id');
                            $this->db->where('em.company_id', $this->company_id);
                            $employees_query = $this->db->get();
                        } else {
                            $this->db->select('em.employee_id,em.first_name');
                            $this->db->from('main_employees as em');
                            $this->db->join('main_emp_separation as ems', 'em.employee_id = ems.employee_id');
                            $employees_query = $this->db->get();
                        }
                        //echo $this->db->last_query();

                        $termination_type_array = $this->Common_model->get_array('termination_type');
                        if ($query) {
                            $i = 0;
                            //pr($query->result());

                            foreach ($query->result() as $row) {
                                $i++;
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_selected_value($this, 'employee_id', $row->employee_id, 'main_employees', 'first_name') . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $termination_type_array[$row->termination_type] . "</td>";
                                print"<td id='catE" . $pdt . "'>" . $row->description . "</td>";
                                print"<td title='View License' id='catA" . $pdt . "'><a title='View Documents' href='" . base_url() . "Con_Separation_Information/download_documents/" . $row->documents . "/" . "' >" . $row->documents . "</a></td>";
                                print"<td><div class='action-buttons '>"
                                        . "<a href='" . base_url() . "Con_Separation_Information/edit_separation_information/" . $row->employee_id . "' ><i class='fa fa-lg fa-pencil-square-o'>&nbsp;&nbsp;</i></a>"
                                        . "<a href='" . base_url() . "Con_Separation_Information/download_exit_pdf/" . $row->id . '/' . $row->termination_type . "' ><i class='fa fa-lg fa-download'>&nbsp;&nbsp;</i></a>"
                                        . "<a href='javascript:;' onclick='delete_data(" . $row->id . ")'><i class='fa fa-trash-o'></i></a>"
                                        . "</div></td>";
                                print"</tr>";
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
<script>

    var url = "<?php echo base_url(); ?>";
    function delete_data(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "Con_Separation_Information/delete_entry/" + id;
        else
            return false;
    }

</script>
