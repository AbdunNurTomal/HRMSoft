<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="payfrequency_div">
        <button class="btn btn-u btn-md" onClick="add_payfrequency()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-payfrequency" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="40%">
                <col width="40%">
                <col width="15%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Frequency Type</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
                    $pay_freq = $this->db->get_where('main_payfrequency_type', array('company_id' => $this->company_id));
                } else {
                    $pay_freq = $this->db->get_where('main_payfrequency_type', array());
                }
                //echo $this->db->last_query();
                
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                $billing_cycle_array = $this->Common_model->get_array('billing_cycle');

                $query = $this->db->get_where('main_payfrequency', array('company_id' => $this->company_settings_id, 'isactive' => 1));
                //echo $this->db->last_query();

                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catD" . $pdt . "'>" . $this->Common_model->get_name($this, $row->freqtype, 'main_payfrequency_type', 'freqcode') . "</td>";
                        print"<td id='catE" . $pdt . "'>" . ucwords($row->freqdescription) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_payfrequency(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_payfrequency(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="payfrequency_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Pay Frequency</h4>
            </div>
            <form id="payfrequency_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="payfrequency_id" id="payfrequency_id"/>
                <div class="modal-body">
                    <div class="form-group"> 
                        <label class="col-sm-2 control-label">
                            <a href="#" onClick="add_new_payfrequency()"><span class="glyphicon glyphicon-plus-sign"></span> Add New </a>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Pay Period<span class="req"/> </label>
                        <div class="col-sm-4">
                            <div id="pay_frequency_divv">
                                <select name="pay_frequency" id="pay_frequency" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($pay_freq->result() as $row) :
                                        ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->freqcode; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control capitalize" rows="2" id="description" name="description" placeholder="Description"></textarea>
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
<div class="modal fade" id="new_payfrequency_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Pay Frequency</h4>
            </div>
            <form id="new_payfrequency_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="col-sm-2 control-label">Pay Frequency <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="freqcode" id="freqcode" class="form-control input-sm" placeholder="Pay Frequency "/>
                        </div>
                        <label class="col-sm-2 control-label">Wage Hour <span class="req"/> </label>
                        <div class="col-sm-4">
                            <input type="text" name="wage_houre" id="wage_houre" class="form-control input-sm" onkeypress="return numbersonly(this, event)" placeholder="Wage Hour "/>
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




<script type="text/javascript">

    $(document).ready(function () {
        $('#dataTables-example-payfrequency').dataTable({
            "order": [0, "asc"],
            "pageLength": 10,
            "paginationType": "input"
        });
        $('.modal').on('hidden.bs.modal', function (e) {
            if ($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });
    });

    var save_method; //for save method string
    var table;
    function add_payfrequency()
    {
        save_method = 'add';
        $('#payfrequency_form')[0].reset(); // reset form on modals

        $("#pay_frequency").select2({
            placeholder: "Pay Period",
            allowClear: true,
        });

        $('#payfrequency_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Pay Frequency'); // Set Title to Bootstrap modal title
    }

    $("#pay_frequency").select2({
        placeholder: "Pay Period",
        allowClear: true,
    });
    
    function add_new_payfrequency()
    {
        save_method = 'add';
        $('#new_payfrequency_form')[0].reset(); // reset form on modals
        $('#new_payfrequency_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add New Pay Frequency'); // Set Title to Bootstrap modal title
    }
    
     $(function () {
        $("#new_payfrequency_form").submit(function (event) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_configaration/save_new_payfrequency') ?>";
            } else
            {
                url = "<?php echo site_url('Con_configaration/save_new_payfrequency') ?>";
            }
            $.ajax({
                url: url,
                data: $("#new_payfrequency_form").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {
                //alert (data);
                $("#pay_frequency_divv").load(location.href + " #pay_frequency_divv");
            
                var url = '';
                view_message(data, url, 'new_payfrequency_Modal', 'new_payfrequency_form');
                
                setTimeout(function () {
                    $("#pay_frequency").select2({
                        placeholder: "Pay Period",
                        allowClear: true,
                    });
                }, 6000);
                
            });
            event.preventDefault();
        });
    });

</script>