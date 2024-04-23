<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="padding:15px;">
            <?php
            if ($type == 1) {//entry
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_User/save_user" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="form-group col-lg-8 no-padding-left">
                        <div class="col-md-12">
                            <div class="col-sm-6 find_mar">
                                <label class="control-label pull-left">User Name <span class="required">*</span></label>
                                <input type="text" name="name" id="name" class="form-control input-sm" placeholder="User Name" />
                            </div> 
                            <div class="col-sm-6 find_mar">
                                <label class="control-label pull-left">User Email <span class="required">*</span></label>
                                <input type="email" name="email" id="email" class="form-control input-sm" placeholder="User Email" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-6 find_mar">
                                <label class="control-label pull-left">Parent User</label>
                                <select name="parent_user" id="parent_user" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($main_users_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-6 find_mar">
                                <label class="control-label pull-left">User Group <span class="required">*</span></label>
                                <select name="user_group" id="user_group" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($main_usergroup_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->group_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-6 find_mar">
                                <label class="control-label pull-left">User Password <span class="required">*</span></label>
                                <input type="password" name="password" id="password" class="form-control input-sm" placeholder="User Password" />
                            </div> 
                            <div class="col-sm-6 find_mar">
                                <label class="control-label pull-left">Confirm Password <span class="required">*</span></label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control input-sm" placeholder="Confirm Password" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-6 find_mar">
                                <label class="control-label pull-left">Expiration Date</label>
                                <input type="text" name="expiration_date" id="expiration_date" class="form-control dt_pick input-sm" placeholder="Expiration Date" />
                            </div> 
                            <div class="col-sm-6 find_mar">
                                <label class="control-label pull-left">API Login ID</label>
                                <input type="text" name="api_login_id" id="api_login_id" class="form-control input-sm" placeholder="API Login ID" />
                            </div> 
                            
                        </div>
                        <div class="col-md-12">
                            <div class="col-sm-6 find_mar">
                             <label class="control-label pull-left">Phone No<span class="req"/></label>
                              <input type="text" name="phone_no" id="phone_no" class="form-control input-sm" placeholder="Mobile Phone" data-toggle="tooltip" data-placement="bottom" title="Mobile Phone">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-3 pull-right">
                        <div class="testimonial-info col-md-12 padding-top-15 center-align">
                            <div class="slim rounded-x" style="" 
                                 data-label="Drop your Image"
                                 data-size="240,240"
                                 data-ratio="1:1">
                                <input type="file" name="slim[]" id="image_name" required />
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                            <div class="modal-footer">
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Con_User" ?>">Close</a>
                        </div>
                    </div>
                    
                </form>
                <?php
            } else if ($type == 2) {//edit
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_User/edit_User" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>

                        <div class="form-group col-lg-8 no-padding-left">
                            <div class="col-md-12">
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">User Name</label>
                                    <input type="text" name="name" id="name" value="<?php echo ucwords($row->name) ?>" class="form-control" placeholder="User Name" />
                                </div> 
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">User Email</label>
                                    <input type="email" name="email" id="email" value="<?php echo $row->email ?>" class="form-control" placeholder="User Email" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">Parent User</label>
                                    <select name="parent_user" id="parent_user" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                            // foreach ($main_users_query->result() as $key):
                                            // ?>
                                            <option value="//<?php // echo $key->id ?>"<?php // if ($row->parent_user == $key->id) echo "selected"; ?>><?php // echo $key->name ?></option>
                                        <?php // endforeach; ?>
                                    </select>
                                </div> -->
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">User Group</label>
                                    <select name="user_group" id="user_group" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                        <option></option>
                                        <?php
                                        foreach ($main_usergroup_query->result() as $key):
                                            ?>
                                            <option value="<?php  echo $key->id ?>"<?php if ($row->user_group == $key->id) echo "selected"; ?>><?php echo $key->group_name ?></option>
                                        <?php  endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">Expiration Date</label>
                                    <input type="text" name="expiration_date" id="expiration_date" value="<?php echo $this->Common_model->show_date_formate($row->expiration_date); ?>" class="form-control dt_pick input-sm" placeholder="Expiration Date" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">User Password</label>
                                    <input type="password" name="password" id="password" value="" class="form-control" placeholder="User Password" />
                                </div> 
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control" placeholder="Confirm Password" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                 
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">API Login ID</label>
                                    <input type="text" name="api_login_id" id="api_login_id" value="<?php echo $row->api_login_id; ?>" class="form-control input-sm" placeholder="API Login ID" />
                                </div> 
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">Phone No</label>
                                    <input type="text" name="phone_no" id="phone_no" value="<?php echo $row->phone_no; ?>" class="form-control input-sm" placeholder="Mobile Phone" data-toggle="tooltip" data-placement="bottom" title="Mobile Phone">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-3 pull-right">
                            <?php
                            if ($row->user_image == "") {
                                $src = base_url() . "uploads/blank.png";
                            } else {
                                $src = base_url() . "uploads/user_image/" . $row->user_image;
                            }
                            ?>
                            <div class="testimonial-info col-md-12 padding-top-15 center-align">
                                
                                <div class="slim rounded-x" style="" 
                                     data-label="Drop your Image"
                                     data-size="240,240"
                                     data-ratio="1:1">
                                    <img src="<?php echo $src; ?>" alt=""/>
                                    <input type="file" name="slim[]" id="image_name" required />
                                </div>
                                
                            </div>
                            
                        </div>

                        <div class="col-sm-12">
                            <div class="modal-footer">
                                <button type="submit" id="submit" class="btn btn-u">Save</button>
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_User" ?>">Close</a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </form>
                <?php
            }
            else if ($type == 3) {//view
                ?>
                <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_User/edit_User" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>

                        <div class="form-group col-lg-8 no-padding-left">
                            <div class="col-md-12">
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">User Name : </label>
                                    <label class="control-label pull-left"> <?php echo ucwords($row->name) ?></label>
                                </div> 
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">User Email : </label>
                                    <label class="control-label pull-left"> <?php echo $row->email ?></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">Company : </label>
                                    <label class="control-label pull-left"> <?php echo $this->Common_model->get_name($this,$row->company_id,'main_company','company_full_name'); ?></label>
                                </div>
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">User Group : </label>
                                    <label class="control-label pull-left"> <?php echo $this->Common_model->get_name($this,$row->user_group,'main_usergroup','group_name'); ?></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">Phone No : </label>
                                    <label class="control-label pull-left"><?php echo $row->phone_no; ?></label>
                                </div> 
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">Created Date : </label>
                                    <label class="control-label pull-left"><?php echo $newDate = date("m-d-Y", strtotime($row->createddate)); ?></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-sm-6 find_mar">
                                    <label class="control-label pull-left">Expiration Date : </label>
                                    <label class="control-label pull-left"> <?php echo $this->Common_model->show_date_formate($row->expiration_date); ?></label>
                                </div> 
                            </div>
                        </div>

                        <div class="form-group col-lg-3 pull-right">
                            <?php
                            if ($row->user_image == "") {
                                $src = base_url() . "uploads/blank.png";
                            } else {
                                $src = base_url() . "uploads/user_image/" . $row->user_image;
                            }
                            ?>
                            <div class="testimonial-info col-md-12 padding-top-15 center-align">
                                <img id="my_user_image" class="rounded-x" src="<?php echo $src; ?>" alt="" height="100" width="95">
                            </div>
                            
                        </div>

                        <div class="col-sm-12">
                            <div class="modal-footer">
                                <!--<button type="submit" id="submit" class="btn btn-u">Save</button>-->
                                <a class="btn btn-danger" href="<?php echo base_url() . "Con_User" ?>">Close</a>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </form>
                <?php
            }
            ?>
        </div>

    </div>
</div>

<!--
 Modal 
<div class="modal fade" id="user_image_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add User Image</h4>
            </div>
            <form id="user_image_form" name="sky-form11" class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
                <input type="hidden" value="" name="id_emp_languages"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"> Select Image </label>
                        <div class="col-sm-8">
                            <input type="file" name="user_image_file" id="user_image_file" size="20" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>-->


</div><!--/row-->
</div><!--/container-->

<!--Add item script-->       
<script>


    $(function () {
        $("#sky-form11").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url = '<?php echo base_url() ?>Con_User';
                view_message(data, url, '', 'sky-form11');

            });
            event.preventDefault();
        });
    });

    function add_user_image()
    {
        $('#user_image_form')[0].reset(); // reset form on modals
        $('#user_image_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Upload Image'); // Set Title to Bootstrap modal title
    }

//    $(function () {
//        $('#user_image_form').submit(function (e) {
//            e.preventDefault();
//            var base_url = '<?php // echo base_url(); ?>';
//            $.ajaxFileUpload({
//                url: base_url + './Con_User/upload_user_image/',
//                secureuri: false,
//                fileElementId: 'user_image_file',
//                dataType: 'JSON',
//                success: function (data)
//                {
//                    
//                    var datas = data.split('__');
//                    $('#user_image').val(datas[1]);
//
//                    var path = 'http://' + '<?php // echo $_SERVER['HTTP_HOST']; ?>' + '/hrm/uploads/user_image/';
//                    $("#my_user_image").removeAttr("src").attr("src", path + datas[1]);
//
//                    $('#user_image_form')[0].reset();
//                    $('#user_image_Modal').modal('hide');
//
//                    var url = '';
//                    view_message(datas[0], url, '', '');
//                }
//            });
//            return false;
//        });
//    });

    $("#parent_user").select2({
        placeholder: "Parent User",
        allowClear: true,
    });

    $("#user_group").select2({
        placeholder: "User Group",
        allowClear: true,
    });
   $(function () {
        
        $("#phone_no").mask("(999) 999-9999");
    });
</script>
<!--=== End Script ===-->

