<?php
if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
    $main_company_policies_query = $this->db->get_where('main_company_policies', array('company_id' => $this->company_id, 'isactive' => 1));
} 
else if ($this->user_group == 9 ) {//Onboarding User
    $main_company_policies_query = $this->db->get_where('main_company_policies', array('company_id' => $this->company_id, 'isactive' => 1));
}
else {
    $main_company_policies_query = $this->db->get_where('main_company_policies', array('isactive' => 1));
}

//echo $this->db->last_query();

if ($type == 1) {
    ?>
    <form id="onboarding_companypolicies_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_Onboarding/save_onboarding_companypolicies" enctype="multipart/form-data" role="form">
        <input type="hidden" value="" name="ob_cp_emp_id" id="ob_cp_emp_id"/>

        <table id="dataTables-example-companypolicies" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="15%">
                <col width="22%">
                <col width="23%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Policy Name</th>
                    <th>Signature</th>
                    <th>Policy</th>
                    <th>Download</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                if ($main_company_policies_query) {
                    foreach ($main_company_policies_query->result() as $row) {
                        $i++;
                        if ($row->is_singture == 1) {
                            $is_singture = "Yes";
                        } else if ($row->is_singture == 2) {
                            $is_singture = "No";
                        } else {
                            $is_singture = "";
                        }
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo ucwords($row->policy_name) ?> </td>
                            <td><?php echo $is_singture ?> </td>
                            <td><?php echo ucwords($row->custom_text) ?> </td>
                            <td>
                               <?php 
                               if($row->policy_file_path!="")
                               {
                               ?>
                                <a href="#" onclick="download_file('<?php echo $row->id; ?>');" class="btn btn-u" data-toggle="tooltip">Download File</a>
                                <?php
                               }
                                ?>
                            </td>
                            <td>
                                <input type="hidden" name="policy_id[]" id="policy_id<?php echo $i; ?>" value="<?php echo $row->id; ?>">
                                <div class="inline-group margin-left-10" style=" margin-left: 20px; ">
                                    <label class="radio"><input type="radio" name="is_aggree<?php echo $i; ?>" id="is_aggree<?php echo $i; ?>" value="1" checked> <i class="rounded-x"></i>Read</label>
                                    <label class="radio"><input type="radio" name="is_aggree<?php echo $i; ?>" id="is_aggree<?php echo $i; ?>" value="0"> <i class="rounded-x"></i>Not Read</label>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>

        <div class="modal-footer">
            <!--            <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php //echo base_url() . "Con_Onboarding"       ?>">Close</a>-->

            <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
            <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
        </div>
    </form>
    <?php
} else if ($type == 2) { //Update
    $query = $this->db->get_where('main_ob_company_policies', array('onboarding_employee_id' => $ob_emp_id));

    if ($query->num_rows() > 0) {
        $action_type = 2;
    } else {
        $action_type = 1;
    }

    if ($action_type == 2) {
        ?>
        <form id="onboarding_companypolicies_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/edit_onboarding_companypolicies" enctype="multipart/form-data" role="form">

            <table id="dataTables-example-companypolicies" class="table table-striped dt-responsive nowrap responsive-table table-wrap">
             <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="15%">
                    <col width="22%">
                    <col width="23%">
                    <col width="10%">
               </colgroup>
                <thead>
                    <tr>
                        <th>SL </th>
                        <th>Policy Name</th>
                        <th>Signature</th>
                        <th>Policy</th>
                        <th>Download</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if ($main_company_policies_query) {
                        foreach ($main_company_policies_query->result() as $row) {

                            $obquery = $this->db->get_where('main_ob_company_policies', array('onboarding_employee_id' => $ob_emp_id, 'policy_id' => $row->id))->row();
                            $eg_chk = "";
                            $deg_chk = "";
                            if ($obquery) {
                                if ($obquery->is_aggree == 1) {
                                    $eg_chk = "checked";
                                } else if ($obquery->is_aggree == 0) {
                                    $deg_chk = "checked";
                                } else {
                                    $eg_chk = "checked";
                                }
                            } else {
                                $eg_chk = "checked";
                            }
                            $i++;
                            if ($row->is_singture == 1) {
                                $is_singture = "Yes";
                            } else if ($row->is_singture == 2) {
                                $is_singture = "No";
                            } else {
                                $is_singture = "";
                            }
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo ucwords($row->policy_name) ?> </td>
                                <td><?php echo $is_singture ?> </td>
                                <td><?php echo ucwords($row->custom_text) ?> </td>
                                <td>
                                    <?php 
                                    if($row->policy_file_path!="")
                                    {
                                    ?>
                                     <a href="#" onclick="download_file('<?php echo $row->id; ?>');" class="btn btn-u" data-toggle="tooltip">Download File</a>
                                     <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <input type="hidden" name="policy_id[]" id="policy_id<?php echo $i; ?>" value="<?php echo $row->id ?>">
                                    <div class="inline-group margin-left-10" style=" margin-left: 20px; ">
                                        <label class="radio"><input type="radio" name="is_aggree<?php echo $i; ?>" id="is_aggree<?php echo $i; ?>" value="1" <?php echo $eg_chk; ?>> <i class="rounded-x"></i>Read</label>
                                        <label class="radio"><input type="radio" name="is_aggree<?php echo $i; ?>" id="is_aggree<?php echo $i; ?>" value="0" <?php echo $deg_chk; ?> > <i class="rounded-x"></i>Not Read</label>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>


            <div class="modal-footer">
                <!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php //echo base_url() . "Con_onboarding_list"       ?>">Close</a>-->

                <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>
            </div>
        </form>
        <?php
    } else {
        ?>
        <form id="onboarding_companypolicies_form" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_onboarding_list/save_onboarding_companypolicies" enctype="multipart/form-data" role="form">
            <table id="dataTables-example-companypolicies" class="table table-striped table-bordered dt-responsive nowrap responsive-table table-wrap">
                <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="15%">
                    <col width="22%">
                    <col width="23%">
                    <col width="10%">
               </colgroup>
                <thead>
                    <tr>
                        <th>SL </th>
                        <th>Policy Name</th>
                        <th>Signature</th>
                        <th >Policy</th>
                        <th>Download</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if ($main_company_policies_query) {
                        foreach ($main_company_policies_query->result() as $row) {
                            $i++;
                            if ($row->is_singture == 1) {
                                $is_singture = "Yes";
                            } else if ($row->is_singture == 2) {
                                $is_singture = "No";
                            } else {
                                $is_singture = "";
                            }
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo ucwords($row->policy_name) ?> </td>
                                <td><?php echo $is_singture ?> </td>
                                <td><?php echo ucwords($row->custom_text) ?> </td>
                                <td>
                                    <?php 
                                    if($row->policy_file_path!="")
                                    {
                                    ?>
                                     <a href="#" onclick="download_file('<?php echo $row->id; ?>');" class="btn btn-u" data-toggle="tooltip">Download File</a>
                                     <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <input type="hidden" name="policy_id[]" id="policy_id<?php echo $i; ?>" value="<?php echo $row->id; ?>">
                                    <div class="inline-group margin-left-10" style=" margin-left: 20px; ">
                                        <label class="radio"><input type="radio" name="is_aggree<?php echo $i; ?>" id="is_aggree<?php echo $i; ?>" value="1" checked> <i class="rounded-x"></i>Read</label>
                                        <label class="radio"><input type="radio" name="is_aggree<?php echo $i; ?>" id="is_aggree<?php echo $i; ?>" value="0"> <i class="rounded-x"></i>Not Read</label>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="modal-footer">
                <!--                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php //echo base_url() . "Con_onboarding_list"        ?>">Close</a>-->

                <button class="btn btn-danger btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
                <button class="btn btn-u btn-next pull-right" type="submit" id="submit"><span class="glyphicon glyphicon-arrow-right"></span> Next </button>

            </div>
        </form>
        <?php
    }
}
?>

<!--
<div class="row padding-top-5 margin-bottom-10 margin-left-10 margin-right-10">
    <button class="btn btn-u btn-prev pull-left" type="button" onclick="return showPrev()"><span class="glyphicon glyphicon-arrow-left"></span>Previous </button>
    <button class="btn btn-u btn-next pull-right" type="button" onclick="return showNext(is_employee)"><span class="glyphicon glyphicon-arrow-right"></span>Next </button>
</div>-->
<style type="text/css">
   /*  .table tbody tr td {white-space:normal !important } */
</style>
<script>
    
    $(document).ready(function () {
        $('#dataTables-example-companypolicies').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"    
        });
    });

    function download_file(id)
    {
        var b_url = "<?php echo base_url(); ?>";
        window.location = b_url + "Con_onboarding_list/download_policy_file/" + id;


    }
</script>

