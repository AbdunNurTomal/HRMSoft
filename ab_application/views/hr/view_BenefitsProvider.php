
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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_BenefitsProvider/add_Benefits_provider" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service Provider Name</th>
                            <th>Address1</th>                            
                            <th>Address2</th>                            
                            <th>City</th>                            
                            <th>States</th>                            
                            <th>Zipcode</th>                            
                            <th>Contact Name</th>                            
                            <th>Phone No.</th>                            
                            <th>Ext.</th>                            
                            <th>Fax</th>                            
                            <th>Email</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query) {
                            foreach ($query->result() as $row) {
                                $pdt = $row->id;
                                print"<tr>";
                                print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                print"<td id='catA" . $pdt . "'>" . ucwords($row->service_provider_name) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . ucwords($row->address1) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . ucwords($row->address2) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . ucwords($row->city) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->states,'main_state','state_name') . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->zipcode . "</td>";
                                print"<td id='catA" . $pdt . "'>" . ucwords($row->contact_name) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->phone_no . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->ext . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $row->fax . "</td>";
                                print"<td id='catD" . $pdt . "'>" . $row->email . "</td>";                                
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_BenefitsProvider/edit_Benefits_provider/" . $row->id ."/". $row->states. "/" .  "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
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


<script type="text/javascript">

    $("#from,#to").select2({
        placeholder: "Select a State",
        allowClear: true,
    });
    
     var url="<?php echo base_url();?>";
    function delete_data(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = url+"Con_BenefitsProvider/delete_Benefits_provider/"+id;
        else
          return false;
        } 


</script>
<!--=== End Content ===-->

