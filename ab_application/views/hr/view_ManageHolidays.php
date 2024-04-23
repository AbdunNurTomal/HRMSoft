
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
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "Con_ManageHolidays/add_holiday" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="25%">
                        <col width="20%">
                        <col width="25%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Holiday</th>
                            <th>Holiday Group</th>
                            <th>Date</th>
                            <th>Description</th>                            
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
                                print"<td id='catA" . $pdt . "'>" . ucwords($row->holiday) . "</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->get_name($this,$row->group_id,'main_holiday_group','group_name')."</td>";
                                print"<td id='catA" . $pdt . "'>" . $this->Common_model->show_date_formate($row->holiday_date) . "</td>";
                                print"<td id='catD" . $pdt . "'>" . ucwords($row->description) . "</td>";                                
                                print"<td><div class='action-buttons '><a href='" . base_url() . "Con_ManageHolidays/edit_holidays/" . $row->id . "/" .$row->group_id . "' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a>&nbsp;<a href='javascript:void(0)' onclick='delete_data(". $row->id .")'><i class='fa fa-trash-o'></i></a></div> </td>";
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
    
    var url="<?php echo base_url();?>";
    function delete_data(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = url+"Con_ManageHolidays/delete_holidays/"+id;
        else
          return false;
        } 


</script>
<!--=== End Content ===-->

