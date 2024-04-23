
    <div class="col-md-10 main-content-div">
        <div class="main-content">
            <div class="container conbre">
                <ol class="breadcrumb">
                    <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                    <li class="active"><?php echo $page_header; ?></li>
                </ol>
            </div>

            <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
                <!-- data table -->
                <div class="table-responsive col-md-12 col-centered">
                <a class="btn btn-u btn-md" href="<?php echo base_url() . "con_User/add_User" ?>"><span class="glyphicon glyphicon-plus-sign"></span>Add</a></br></br>
                
                    <div style="overflow-x:scroll;">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Company</th>
                                    <th>User Email</th>
                                    <th>Parent User</th>
                                    <th>User Group</th>
                                    <th>Expiration Date</th>
                                    <th>Action</th>
                                    <th>Send</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($query) {
                                    foreach ($query->result() as $row) {
                                        $pdt = $row->id;
                                        print"<tr>";
                                        print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $row->name . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this,$row->company_id,'main_company','company_full_name') . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $row->email . "</td>";
                                        print"<td id='catB" . $pdt . "'>" . $this->Common_model->get_name($this,$row->parent_user,'main_users','name') . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this,$row->user_group,'main_usergroup','group_name') . "</td>";
                                        print"<td id='catE" . $pdt . "'>" . $this->Common_model->show_date_formate($row->expiration_date) . "</td>";
                                        print"<td><div class='action-buttons '><a href='" . base_url() . "Con_User/edit_entry/" . $row->id . "/" . $row->parent_user . "' title='Edit' ><i class='fa fa-pencil-square-o'>&nbsp;&nbsp;</i></a> <a href='" . base_url() . "Con_User/view_user_data/" . $row->id . "/" . $row->parent_user . "' title='View'><i class='fa fa-eye'>&nbsp;&nbsp;</i></a> <a href='#' onclick='delete_data(". $row->id .")' title='Delete' ><i class='fa fa-trash-o'></i></a></div> </td>";
                                        print"<td><div class='action-buttons '><a href='#' onclick='welcome_email(". $row->id .")' title='Welcome Email' >Welcome Email</a></div> </td>";
                                        print"</tr>";
                                    }
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end data table --> 
            </div>
        </div>
    </div>

</div><!--/row-->
</div><!--/container-->



<script type="text/javascript">
    

//    var url="<?php // echo base_url();?>";
//    function delete_data(id){
//       var r=confirm("Do you want to delete this?")
//        if (r==true)
//          window.location = url+"con_User/delete_entry/"+id;
//        else
//          return false;
//        } 
        
        
    function delete_data(id) { 
    
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
        .then((willDelete) => {
        if (willDelete) {
            window.location = base_url + "Con_User/delete_entry/" + id;
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    }
        

    function welcome_email(id){
       var r=confirm("Do you want to Email this User?")
        if (r==true)
        { 
           loading_box(base_url);
           //progress_bar();
           
           $.ajax({
            url: "<?php echo site_url('Con_User/welcome_email/') ?>/" + id,
            type: "POST",
            success: function(data)
            {
                var url = '<?php echo base_url() ?>Con_User';
                view_message(data,url,'','');
                  
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
            });
        }
        else
          return false;
      
    } 
        
</script>