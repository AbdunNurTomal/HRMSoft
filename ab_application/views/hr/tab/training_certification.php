
<div class="row">
    <!-- data table -->
    <div class="table-responsive col-md-12 col-centered" id="certification_div">
        <button class="btn btn-u btn-md" onClick="add_training()"><span class="glyphicon glyphicon-plus-sign"></span> Add </button><br><br>

        <table id="dataTables-example-certification" class="table table-striped table-bordered dt-responsive table-hover nowrap responsive-table table-wrap">
            <colgroup>
                <col width="5%">
                <col width="30%">
                <col width="20%">
                <col width="25%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>SL </th>
                    <th>Course Name</th>
                    <th>Course Level</th>
                    <th>Certification Name</th>
                    <th>Issued Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $this->db->get_where('main_emp_certification', array('employee_id' => $employee_id,'isactive' => 1));
                if ($query) {
                    $i = 0;
                    foreach ($query->result() as $row) {
                        $i++;
                        $pdt = $row->id;
                        print"<tr>";
                        print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                        print"<td id='catB" . $pdt . "'>" . ucwords($row->course_name) . "</td>";
                        print"<td id='catC" . $pdt . "'>" . ucwords($row->course_level) . "</td>";
                        print"<td id='catD" . $pdt . "'>" . ucwords($row->certification_name) . "</td>";
                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->issued_date) . "</td>";
                        print"<td><div class='action-buttons '><a href='javascript:void()' onclick='edit_certification(" . $row->id . ")' title='Edit' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a><a href='javascript:void(0)' onclick='delete_data_certification(" . $row->id . ")' title='Delete'><i class='fa fa-trash-o'></i></a></div> </td>";
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
<div class="modal fade bd-example-modal-lg" id="Certification_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Training & Certification</h4>
            </div>
            <form id="emp_certification" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_certification"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Course Name<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="course_name" id="course_name" class="form-control input-sm" placeholder="Course Name" data-toggle="tooltip" data-placement="bottom" title="Course Name">
                        </div>
                        <label class="col-sm-2 control-label">Course Level<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="course_level" id="course_level" class="form-control input-sm" placeholder="Course Level" data-toggle="tooltip" data-placement="bottom" title="Course Level">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Certification<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="certification_name" id="certification_name" class="form-control input-sm" placeholder="Certification Name" data-toggle="tooltip" data-placement="bottom" title="Certification Name">
                        </div>
                        <label class="col-sm-2 control-label">Issued Date<span class="req"/></label>
                        <div class="col-sm-4">
                            <input type="text" name="issued_datee" id="issued_datee" class="form-control dt_pick input-sm" placeholder="Issued Date" data-toggle="tooltip" data-placement="bottom" title="Issued Date" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-4">
                            <textarea name="description" id="description" class="form-control input-sm" rows="1" placeholder="Description" data-toggle="tooltip" data-placement="top" title="Description"></textarea>
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
         $('#dataTables-example-certification').dataTable({
            "order": [ 0, "asc" ],
            "pageLength": 5, 
            "paginationType": "input"   
        });
    });
    
    var save_method; //for save method string
    var table;
    function add_training()
    {
        save_method = 'add';
        $('#emp_certification')[0].reset(); // reset form on modals
        $('#Certification_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Training & Certification'); // Set Title to Bootstrap modal title
    }
  
</script>