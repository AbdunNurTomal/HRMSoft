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
                <a class="btn btn-u btn-md" href="#" onClick="changeto_select_company(0)"><span class="glyphicon glyphicon-plus-sign"></span> Change</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="5%">
                        <col width="40%">
                        <col width="35%">
                        <col width="20%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Mobile Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            $i=0;
                            foreach ($query->result() as $row) {
                                $pdt = $row->id;$i++;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $i . "</td>";
                                print"<td id='catD" . $pdt . "'>" . ucwords($row->company_full_name) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->email . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->mobile_phone . "</td>";
                                print"<td><div class='action-buttons '><a class='btn btn-u btn-md' href='#' onClick='changeto_select_company(" . $row->id . ")' > Change </a></div> </td>";
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

<!-- Modal -->
<div class="modal fade" id="change_company_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Company</h4>
            </div>
            <form id="change_company_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                   
                    <div class="form-group no-margin">
                        <label class="col-sm-4 control-label">Change TO </label>
                        <div class="col-sm-6">
                            <select name="change_to" id="change_to" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php 
                                foreach ($query->result() as $key): ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->company_full_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                   
<!--                    <div class="form-group single-group">
                        <label for="login-pass" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" value="" placeholder="Password" id="login-pass" name="password">
                        </div>
                    </div>-->
                    
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Change</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    var save_method; //for save method string   
    function changeto_select_company(id){
        //alert (id);
        save_method = 'add';
        $('#change_company_form')[0].reset(); // reset form on modals
        
        $("#change_to").select2({
            placeholder: "Select Change TO",
            allowClear: true,
        });
        
        $('#change_company_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Change Company'); // Set Title to Bootstrap modal title
        if(id!=0)
        {
            $('[name="change_to"]').select2().select2('val', id);
        }
    }
    
    $("#change_to").select2({
        placeholder: "Select Change TO",
        allowClear: true,
    });
    
    
    $(function(){
        $("#change_company_form" ).submit(function( event ) {
            var url;
            if (save_method == 'add')
            {
                url = "<?php echo site_url('Con_ChangeCompany/change_company') ?>";
            }
            else
            {
                url = "<?php echo site_url('Con_ChangeCompany/change_company') ?>";
            }
                $.ajax({
                url: url,
                data: $("#change_company_form").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                    // alert (data);
                    // var url = '<?php echo base_url() ?>Con_ChangeCompany';
                    // view_message(data,url,'change_company_Modal','change_company_form');
                    var url = '<?php echo base_url() ?>Con_dashbord';
                    view_message(data,url);
              });
            event.preventDefault();
        });
    });
    


</script>
<!--=== End Content ===-->

