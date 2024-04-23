<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="com_bankaccounttype_div">
        <button class="btn btn-u btn-md" onClick="add_bankaccounttype()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>
        <table id="dataTables-example-bankaccounttype" class="table table-striped table-bordered dt-responsive table-hover responsive-table table-wrap">
            <colgroup>
               <col width="5%">
                <col width="50%">
                <col width="45%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Bank Account Type</th>
                    <!--<th>Description</th>-->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $company_data = $this->session->userdata('company');
                $this->company_settings_id = $company_data['company_settings_id'];
                
                $query = $this->db->get_where('main_bank_account_types', array('company_id' => $this->company_settings_id,'isactive' => 1));
                //echo $this->db->last_query();
                
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catD" . $pdt . "'>" . ucwords($row->bank_account_type) . "</td>";
//                        print"<td id='catB" . $pdt . "'>" . ucwords($row->description) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_bankaccounttype(" . $row->id . ")'  ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_bankaccounttype(" . $row->id . ")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade" id="bankaccounttype_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Bank Account Type</h4>
            </div>
            <form id="bankaccounttype_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="bankaccounttype_id" id="bankaccounttype_id"/>
                <div class="modal-body">

                    <div class="form-group">
                        <div class=" col-md-10 col-md-offset-1">
                        <label class="col-sm-4 control-label">Account Type<span class="req"/></label>
                        <div class="col-sm-7">
                            <input type="text" name="bank_account_type" id="bank_account_type" class="form-control input-sm" placeholder="Bank Account Type" />
                        </div>
<!--                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea class="form-control input-sm" rows="2" id="description" name="description" placeholder="Description"></textarea>
                        </div>-->
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
         $('#dataTables-example-bankaccounttype').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_bankaccounttype()
    {
        save_method = 'add';
        $('#bankaccounttype_form')[0].reset(); // reset form on modals
        $('#bankaccounttype_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Bank Account Type'); // Set Title to Bootstrap modal title
    }
    
   
    
</script>