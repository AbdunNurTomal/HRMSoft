<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="benefit_div">
        <button class="btn btn-u btn-md" onClick="add_benefit()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-benefit" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
           <colgroup>
                <col width="1%">
                <col width="20%">
                <col width="20%">
                <col width="25%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Enrolling</th>
                    <th>Provider</th>
                    <th>Benefit Type</th>
                    <th>Eligible Date</th>
                    <th>Enrolled Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->user_group == 4 || $this->user_group == 8 || $this->user_group == 10 || $this->user_group == 11 || $this->user_group == 12) {
                    $benefits_provider_query = $this->db->get_where('main_benefits_provider', array('company_id' => $this->company_id, 'isactive' => 1));
                    $benefit_type_query = $this->db->get_where('main_benefit_type', array('company_id' => $this->company_id, 'isactive' => 1));
                    //$depandent_information_query = $this->db->get_where('main_emp_enrolling', array('company_id' => $this->company_id, 'isactive' => 1));
                } else {
                    $benefits_provider_query = $this->db->get_where('main_benefits_provider', array('isactive' => 1));
                    $benefit_type_query = $this->db->get_where('main_benefit_type', array('isactive' => 1));
                    //$depandent_information_query = $this->db->get_where('main_emp_enrolling', array('isactive' => 1));
                }

                $percent_dollars_array = $this->Common_model->get_array('percent_dollars');

                $query = $this->db->get_where('main_emp_benefit', array('employee_id' => $employee_id, 'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->enrolling, 'main_emp_enrolling', 'fast_name') . "</td>";
                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this, $row->provider, 'main_benefits_provider', 'service_provider_name') . "</td>";
                        print"<td id='catC" . $pdt . "'>" . $this->Common_model->get_name($this, $row->benefit_type, 'main_benefit_type', 'benefit_type') . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->show_date_formate($row->eligible_date) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->enrolled_date) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_benefit(" . $row->id . ")' title='Edit' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_benefit(" . $row->id . ")' title='Delete'><i class='fa fa-trash-o'></i></a></div> </td>";
                        print"</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end data table -->
</div>



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="benefit_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Benefit</h4>
            </div>
            <form id="emp_benefit" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_benefit" id="id_emp_benefit" />
                <div class="modal-body">
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Enrolling<span class="req"/></label>
                        <div id="ben_enrolling_div">
                            <div class="col-sm-4">
                                <select name="ben_enrolling" id="ben_enrolling" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    $emp_enrolling_query = $this->db->get_where('main_emp_enrolling', array('isactive' => 1,'employee_id' => $employee_id));
                                    foreach ($emp_enrolling_query->result() as $key):
                                        $relationship = $this->Common_model->get_name($this, $key->relationship_id, 'main_relationship_status', 'relationship_status')
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->fast_name ." (". $relationship .")"; ?></option> 
                                    <?php endforeach; ?>
                                </select> 
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">Provider<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="provider" id="provider" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($benefits_provider_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->service_provider_name ?></option> 
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Benefit Type<span class="req"/></label>
                        <div class="col-sm-4">
                            <select name="benefit_type" id="benefit_type" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php foreach ($benefit_type_query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->benefit_type ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                        <label class="col-sm-2 control-label">Eligible Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="eligible_date" id="eligible_date" class="form-control input-sm dt_pick" placeholder="Eligible Date" data-toggle="tooltip" data-placement="bottom" title="Eligible Date">
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label class="col-sm-2 control-label">Enrolled Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="enrolled_date" id="enrolled_date" class="form-control input-sm dt_pick" placeholder="Enrolled Date" data-toggle="tooltip" data-placement="bottom" title="Enrolled Date">
                        </div>
                        <label class="col-sm-2 control-label">Percent or Dollars</label>
                        <div class="col-sm-4">
                            <select name="percent_dollars" id="percent_dollars" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option value="">- Select Option -</option>
                                <?php foreach ($percent_dollars_array as $key => $val): ?>
                                    <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee Portion<span class="calc"> </span></label>
                        <div class="col-sm-4">
                            <input type="text" name="employee_portion" id="employee_portion" class="form-control input-sm employee-employer" placeholder="Employee Portion" data-toggle="tooltip" data-placement="bottom" title="Employee Portion" onkeypress="return numbersonly(this, event)">
                        </div>
                        <label class="col-sm-2 control-label">Employer Portion<span class="calc"> </span> </label>
                        <div class="col-sm-4">
                            <input type="text" name="employer_portion" id="employer_portion" class="form-control input-sm employee-employer" placeholder="Employer Portion" data-toggle="tooltip" data-placement="bottom" title="Employer Portion" onkeypress="return numbersonly(this, event)">
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="1" id="description" name="description"></textarea>
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

<style type="text/css">
    .calc{text-align:left !important;padding-left:0 !important;padding-top:0 !important;font-size:12px !important;line-height:30px !important}
</style>

<script type="text/javascript">


    $(document).ready(function () {
        $('#dataTables-example-benefit').dataTable({
            "order": [0, "asc"],
            "pageLength": 5,
            "paginationType": "input"
        });

        $('#percent_dollars').change(function () {
            var value = $(this).val();

            $('.calc').text('');
            if (value == 1) {
                $('.calc').text('(%)');
            } else if (value == 2) {
                $('.calc').text('($)');
            }
        });

      

        $('.employee-employer').on('keyup', function(e) {
             var value = $('#percent_dollars').val();

            if (value == 1) {
                var a = parseInt($('#employee_portion').val());
                var b = parseInt($('#employer_portion').val());
                var c = (a+b);

                if(c >= 101){
                    $('#employee_portion').val("");
                    $('#employer_portion').val("")
                    alert("Percent can not greater than 100.");
                    return;
                }
            } 
        });

    });

    var save_method; //for save method string
    function add_benefit()
    {
        save_method = 'add';
        $('#emp_benefit')[0].reset(); // reset form on modals
        
        $("#ben_enrolling").select2({
            placeholder: "Enrolling",
            allowClear: true,
        });

        $("#provider").select2({
            placeholder: "Provider",
            allowClear: true,
        });

        $("#benefit_type").select2({
            placeholder: "Benefit Type",
            allowClear: true,
        });

        $("#percent_dollars").select2({
            placeholder: "Percent or Dollars",
            allowClear: true,
        });
    
        $('#benefit_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Benefit'); // Set Title to Bootstrap modal title
    }


    $("#ben_enrolling").select2({
        placeholder: "Enrolling",
        allowClear: true,
    });

    $("#provider").select2({
        placeholder: "Provider",
        allowClear: true,
    });

    $("#benefit_type").select2({
        placeholder: "Benefit Type",
        allowClear: true,
    });

    $("#percent_dollars").select2({
        placeholder: "Percent or Dollars",
        allowClear: true,
    });

</script>