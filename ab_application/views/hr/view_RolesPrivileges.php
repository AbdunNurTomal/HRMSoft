   
    <div class="col-md-10 main-content-div">
        <div class="main-content">
            <div class="container conbre">
                <ol class="breadcrumb">
                    <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                    <li class="active"><?php echo $page_header; ?></li>
                </ol>
            </div>
            
            <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
                <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_RolesPrivileges/save_RolesPrivileges" enctype="multipart/form-data" role="form">
                    <input type="hidden" value="" name="id" id="id"/>
                    <div class="col-sm-6">
                        <div class="form-group margin-top-20">
                            <label class="col-sm-4 control-label">User Group</label>
                            <div class="col-sm-8">
                                <select name="user_group" id="user_group" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                    <option></option>
                                    <?php
                                    foreach ($main_usergroup_query->result() as $key):
                                        ?>
                                        <option value="<?php echo $key->id ?>"><?php echo $key->group_name ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Operation</label>
                            <div class="col-sm-8">
                                <label class="role-previledges-checkbox-item"><input type="checkbox" value="1" name="opration[]" id="opration1"/> Save</label>
                                <label class="role-previledges-checkbox-item"><input type="checkbox" value="2" name="opration[]" id="opration2"/> Edit</label>
                                <label class="role-previledges-checkbox-item"><input type="checkbox" value="3" name="opration[]" id="opration3"/> Delete</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="padding-top: 20px;">Menu</label>
                            <div id="pr_li" class="col-sm-8 well-sm">
                                <?php
                                if ($this->user_group == 12) {
                                    $user_menu = explode(",", $this->user_menu);
                                    $user_menu = array_map('intval', $user_menu);
                                    $this->db->where('isactive', 1);
                                    $this->db->where('root_menu', 0);
                                    $this->db->where_in('id', $user_menu);
                                    $this->db->order_by("module_id", "asc");
                                    $menu_query = $this->db->get('main_menu');
                                } else {
                                    // $this->db->order_by("module_id", "asc");
                                    $this->db->order_by("module_id asc, sequence asc");
                                    $menu_query = $this->db->get_where('main_menu', array('root_menu' => 0,'isactive' => 1));
                                }
                                //echo $this->db->last_query();
                               
                                $module_id = array();
                                foreach ($menu_query->result() as $key) {
                                    if (!in_array($key->module_id, $module_id)) {
                                        $module_id[] = $key->module_id;
                                        ?>
                                        <ul class="list-group">
                                            <li class="list-group-item list-toggle" onchange="mod_change(<?php echo $key->module_id; ?>);">
                                                <label class="role-previledges-checkbox-item">
                                                    <input type="checkbox" value="<?php echo $key->module_id ?>" name="module_id[]" id="<?php echo "mod" . $key->module_id ?>"/>
                                                    <?php echo $this->Common_model->get_name($this, $key->module_id, 'main_module', 'module_name'); ?>
                                                </label>
                                            </li>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                    <ul class="list-unstyled" style=" margin-left: 40px;">
                                       <label class="role-previledges-checkbox-item">
                                           <input type="checkbox" class="form-check-input" value="<?php echo $key->id ?>" id="<?php echo "menu" . $key->id ?>" name="menuid[]" onchange="menu_change(<?php echo $key->id; ?>);"/> <?php echo $key->menu_name ?>
                                        </label>
                                        <?php
                                        $root_menu_query = $this->db->get_where('main_menu', array('root_menu =' => $key->id, 'sub_root_menu =' => 0,'isactive' => 1))->result();
                                        //echo $this->db->last_query();
                                        foreach ($root_menu_query as $root) {
                                            ?>
                                            <li style=" margin-left: 20px; ">
                                                <label class="role-previledges-checkbox-item">
                                                    <input type="checkbox" value="<?php echo $root->id ?>" id="<?php echo "menu" . $root->id ?>" name="menuid[]" onchange="submenu_change(<?php echo $root->id; ?>);" /> <?php echo $root->menu_name ?>
                                                </label>
                                            </li>
                                            <?php
                                            $sub_root_menu_query = $this->db->get_where('main_menu', array('sub_root_menu =' => $root->id,'isactive' => 1))->result();
                                            foreach ($sub_root_menu_query as $sub_root) {
                                                ?>
                                                <li style=" margin-left: 30px;">
                                                    <label class="role-previledges-checkbox-item">
                                                        <input type="checkbox" value="<?php echo $sub_root->id ?>" id="<?php echo "menu" . $sub_root->id ?>" name="menuid[]"/> <?php echo $sub_root->menu_name ?>
                                                    </label>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                    <div class="col-sm-12">
                        <div class="modal-footer">
                            <div class="col-sm-6">
                              <button type="submit" id="submit" class="btn btn-u">Save</button>
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix margin-top-20"></div>
            
        </div>
    </div>

</div><!--/row-->
</div><!--/container-->



<script type="text/javascript">

     $(function(){
        $( "#sky-form11" ).submit(function( event ) {
           var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                  
                var datas = data.split( '_' );
                $('#id').val(datas[1]);
                var url='';
                view_message(datas[0],url);
                
              });
            event.preventDefault();
        });
    });
    
    $('#user_group').on('change', function() {
        var id= this.value;
            $.ajax({
            url: "<?php echo site_url('con_RolesPrivileges/set_value/') ?>/" + id,
            data: id,
            type: 'POST'
          }).done(function(data) {
           
            if(data!="")
            {
                
                var data = data.split( '_' );
                var user_group_id=data[0];
                var user_menu_id=data[1];
                var user_opration_id=data[2];
                var user_privilege_id=data[3];
                var user_mod_id=data[4];
                if(user_privilege_id)
                {
                    if(user_group_id)
                    {
                        $('#id').val(user_privilege_id);
                        //$('#user_group').val(user_group_id);

                        $("input[type='checkbox']").attr("checked",false);

                        var user_menu_id = user_menu_id.split( ',' );
                        for( var i = 0; i < user_menu_id.length; i++ ) 
                        {
                            $('#menu'+user_menu_id[i]).attr('checked', true);
                        }
                        var user_opration_id = user_opration_id.split( ',' );
                        for( var i = 0; i < user_opration_id.length; i++ ) 
                        {
                            $('#opration'+user_opration_id[i]).attr('checked', true);
                        }
                        
                        var user_mod_id = user_mod_id.split( ',' );
                        for( var i = 0; i < user_mod_id.length; i++ ) 
                        {
                            $('#mod'+user_mod_id[i]).attr('checked', true);
                        }
                    }  
                    else
                    {
                        $('#id').val('');
                        $("input[type='checkbox']").attr("checked",false);
                    }
                }
                else
                {
                   $('#id').val(''); 
                   $("input[type='checkbox']").attr("checked",false);
                }
            }
           
        });
        event.preventDefault();
    });
    
    $("#user_group").select2({
        placeholder: "Select User Group",
        allowClear: true,
    });
    
    function mod_change(id)
    {
        //alert (id);
        $.ajax({
           url: "<?php echo site_url('Con_RolesPrivileges/set_mod_change/') ?>/" + id,
           data: id,
           type: 'POST'
        }).done(function(data) {
            //alert (data);
            var data = data.split( '_' );
            for( var i = 0; i < data.length; i++ ) 
            {
                if($('#mod'+id).is(':checked'))
                {
                    $('#menu'+data[i]).attr('checked', true);
                }
                else
                {
                    $('#menu'+data[i]).attr('checked', false);
                }
            }
        });
    }
    
    function menu_change(id)
    {
        //alert (id);
        $.ajax({
           url: "<?php echo site_url('Con_RolesPrivileges/set_menu_change/') ?>/" + id,
           data: id,
           type: 'POST'
        }).done(function(data) {
            //alert (data);
            var data = data.split( '_' );
            for( var i = 0; i < data.length; i++ ) 
            {
                if($('#menu'+id).is(':checked'))
                {
                    $('#menu'+data[i]).attr('checked', true);
                }
                else
                {
                    $('#menu'+data[i]).attr('checked', false);
                }
            }
        });
    }
   
   function submenu_change(id)
    {
        //alert (id);
        $.ajax({
           url: "<?php echo site_url('Con_RolesPrivileges/set_submenu_change/') ?>/" + id,
           data: id,
           type: 'POST'
        }).done(function(data) {
            //alert (data);
            var data = data.split( '_' );
            for( var i = 0; i < data.length; i++ ) 
            {
                if($('#menu'+id).is(':checked'))
                {
                    $('#menu'+data[i]).attr('checked', true);
                }
                else
                {
                    $('#menu'+data[i]).attr('checked', false);
                }
            }
        });
    }

</script>