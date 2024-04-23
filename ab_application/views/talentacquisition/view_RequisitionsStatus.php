
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->

            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form" >
                <div class="col-md-12" style="margin-top: 10px">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right">Status  </label>
                        <div class="col-sm-3">
                            <select name="req_status" id="req_status" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                foreach ($approver_status as $key => $val):
                                    if($key==0 || $key==1 || $key==4)
                                    {
                                        ?>
                                        <option value="<?php echo $key ?>"><?php echo $val ?></option>
                                        <?php
                                    }
                                endforeach;
                                ?>                        
                            </select> 
                        </div>
                        <div class="col-sm-2 no-padding-left">
                            <!--<button type="submit" id="submit" class="btn btn-u"> Process </button>-->                            
                        </div>
                    </div>
                </div>
            </form>
            <!-- data table -->
                <div class="table-responsive col-md-12 col-centered">

                    <table id="dataTables-example-requisition" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                        <colgroup>
                            <col width="5%">
                            <col width="10%">
                            <col width="20%">
                            <col width="15%">
                            <col width="10%">
                            <col width="15%">
                            <col width="10%">
                            <col width="10%">
                            <col width="5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Requisition Id</th>
                                <th>Due Date</th>
                                <th>Department</th> 
                                <th>Requisitions Date</th> 
                                <th>Position</th> 
                                <th>No. of Positions</th> 
                                <th>Status</th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody id="req_tbody">
                            
                        </tbody>
                    </table>
                </div>               
            
            <!-- end data table --> 
        </div><!-- end container well div -->
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
    
    var table;
    
    $(document).ready(function () {
        var selDpto = null; 
        $.ajax({
            url: "<?php echo site_url('Con_RequisitionsStatus/data_load_rwq/') ?>/" + selDpto,
            async: false,
            type: "POST",
            success: function(data) {
                
                $('#req_tbody').find('tr').remove();
                $('#req_tbody').html(data);
            }
        })
    });
    

    $(document).ready(function () {
        $('#req_status').change(function () {

            var selDpto = $(this).val(); // <-- change this line
            //alert (selDpto);

            $.ajax({
                url: "<?php echo site_url('Con_RequisitionsStatus/data_load_rwq/') ?>/" + selDpto,
                async: false,
                type: "POST",
                success: function(data) {
                    //alert (data);return;
                    $('#req_tbody').find('tr').remove();
                    $('#req_tbody').html(data);
                    
                    //reload_table();
                }
            })
        });
    });
    
    $("#req_status").select2({
        placeholder: "Select status for search",
        allowClear: true,
    });
    
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }
</script>
<!--=== End Content ===-->

