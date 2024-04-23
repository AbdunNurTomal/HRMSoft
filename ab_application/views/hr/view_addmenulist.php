<script>
    var base_url='<?php echo base_url(); ?>';
    var murl=base_url + './Con_MenuList/set_root_dropdown/';
    var url=base_url + './Con_MenuList/set_sub_root_dropdown/';
</script>
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="padding: 15px;">
            <?php
            if ($type == 1) {//entry
                ?>
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_MenuList/save_menulist" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Menu Name</label>
                            <input type="text" name="menu_name" id="menu_name" class="form-control" placeholder="Menu Name" />
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Menu Link</label>
                            <input type="text" name="menu_link" id="menu_link" class="form-control" placeholder="Menu Link" />
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Module</label>
                            <select name="module_id" id="module_id" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="load_root_menu(this.value);">
                                <option></option>
                                <?php
                                foreach ($main_module_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->module_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Root Menu</label>
                            <select name="root_menu" id="root_menu" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="load_sub_root_menu(this.value);" >
                                <option></option>
                                <?php
                                //foreach ($main_menu_query->result() as $key):
                                    ?>
                                    <!--<option value="<?php //echo $key->id ?>"><?php //echo $key->menu_name ?></option>-->
                                <?php //endforeach; ?>
                            </select>
                        </div> 
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Sub Root Menu</label>
                            <select name="sub_root_menu" id="sub_root_menu" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                            </select>
                        </div>

                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Menu Icon</label>
                            <select name="menu_icon" id="setup-select-menu-icon" class="col-sm-12 col-xs-12 myselect2 input-sm disabled">
                                <option value="default_icon">Default icon</option>
                                <?php // foreach ($main_menu_query->result() as $key) : ?>
                                    <!-- <option value="<?php // echo $key->menu_icon; ?>"><?php // echo $key->menu_name; ?></option> -->
                                <?php // endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Sequence</label>
                            <input type="text" name="sequence" id="sequence" class="form-control" placeholder="Sequence" />
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Status</label>
                            <select name="isactive" id="isactive" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                foreach ($status_array as $key => $val) {
                                    ?>
                                <option value="<?php echo $key ?>" <?php if($key==1) echo "selected" ?> ><?php echo $val ?></option>
                                <?php
                                }
                                ?>
                            </select> 
                        </div> 
                    </div> 
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "con_MenuList" ?>">Close</a>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                ?>
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>Con_MenuList/edit_MenuList" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <?php // print_r($row);exit; ?>
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Menu Name</label>
                            <input type="text" name="menu_name" id="menu_name" class="form-control" value="<?php echo ucwords($row->menu_name) ?>" placeholder="Menu Name" />
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Menu Link</label>
                            <input type="text" name="menu_link" id="menu_link" class="form-control" value="<?php echo $row->menu_link ?>" placeholder="Menu Link" />
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Module</label>
                            <select name="module_id" id="module_id" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="load_drop_down(this.value,murl,'root_menu','Root Menu');">
                                <option></option>
                                <?php
                                foreach ($main_module_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"<?php if ($row->module_id == $key->id) echo "selected"; ?>><?php echo $key->module_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Root Menu</label>
                            <select name="root_menu" id="root_menu" class="col-sm-12 col-xs-12 myselect2 input-sm" onchange="load_drop_down(this.value,url,'sub_root_menu','Sub Root Menu');">
                                <option></option>
                                <?php
                                $main_menu_query=$this->Common_model->get_selected_row('main_menu', array('root_menu' => 0,'module_id'=>$row->module_id));
                                foreach ($main_menu_query->result() as $key):
                                    ?>
                                    <option value="<?php echo $key->id ?>"<?php if ($row->root_menu == $key->id) echo "selected"; ?>><?php echo $key->menu_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Sub Root Menu</label>
                            <select name="sub_root_menu" id="sub_root_menu" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php
                                $sub_menu_query = $this->Common_model->get_selected_row('main_menu', array('root_menu' => $row->root_menu , 'sub_root_menu' => 0));
                                foreach ($sub_menu_query->result() as $keyy):
                                    ?>
                                    <option value="<?php echo $keyy->id ?>"<?php if ($row->sub_root_menu == $keyy->id) echo "selected"; ?>><?php echo $keyy->menu_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                         <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Menu Icon</label>
                            <select name="menu_icon" id="setup-select-menu-icon" class="col-sm-12 col-xs-12 myselect2 input-sm" >
                                <option></option>
                                <?php // $menuicons_query = $this->Common_model->get_selected_row('main_menu', array('menu_icon'));
                                    // $menuicons_query = $this->Common_model->get_all_row('main_menu');
                                    $this->db->select();
                                    $this->db->from('main_menu');
                                    $query = $this->db->get();

                                    $allMenus = $query->result();
                                    foreach ($allMenus as $menu):
                                        // print_r($menu);exit;
                                        $menuSlug = str_replace(" ", "_", trim($menu->menu_name));
                                        $menuValue = $menu->id . "_" . strtolower($menuSlug);

                                        $menuSelected = "";
                                        if ($row->id == $menu->id) {
                                            $menuSelected = "selected";
                                        }
                                        /* $menuName = str_replace("_", " ", $menu->menu_icon);
                                        $menuNameArr = explode(" ", $menuName);
                                        array_shift($menuNameArr);
                                        $menuName = ucfirst(implode(" ", $menuNameArr)); */
                                    ?>
                                    <option value="<?php echo $menuValue; ?>" <?= $menuSelected; ?>><?php echo $menuValue; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Sequence</label>
                            <input type="text" name="sequence" id="sequence" class="form-control" value="<?php echo $row->sequence ?>" placeholder="Sequence" />
                        </div> 
                        
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="control-label pull-left">Status</label>
                            <select name="isactive" id="isactive" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <?php
                                foreach ($status_array as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key ?>"<?php if ($row->isactive == $key) echo "selected"; ?>><?php echo $val ?></option>
                                    <?php
                                }
                                ?>
                            </select> 
                        </div> 
                    </div> 
                        <div class="modal-footer">                            
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "con_MenuList" ?>">Close</a>
                        </div>
                    <?php endforeach; ?>
                </form>
                    <?php
                }
                ?>
        </div>

    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->

 <!--Add item script-->       
 <script>
      $("#module_id").select2({
        placeholder: "Module ID",
        allowClear: true,
    });
    
      $("#root_menu").select2({
        placeholder: "Root Menu",
        allowClear: true,
    });
    
    $("#sub_root_menu").select2({
        placeholder: "Sub Root Menu",
        allowClear: true,
    });
    
    $("#isactive").select2({
        placeholder: "Status",
        allowClear: true,
    });

    $("#setup-select-menu-icon").select2({
        placeholder: "Menu Icons",
        allowClear: true,
    });

    $(function(){
        $( "#sky-form11" ).submit(function( event ) {
           var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {

                var url='<?php echo base_url() ?>Con_MenuList';
                view_message(data,url,'','sky-form11');
                   
              });
            event.preventDefault();
        });
    }); 
    
    function load_root_menu(id) {
        $.ajax({
            url: "<?php echo site_url('Con_MenuList/set_root_dropdown/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                
                $('#root_menu').html("");
                $('#root_menu').html(data);
                
                $("#root_menu").select2({
                    placeholder: "Select root menu",
                    allowClear: true,
                });
            }
        });
    }

    function load_sub_root_menu(id) {
        $.ajax({
            url: "<?php echo site_url('Con_MenuList/set_sub_root_dropdown/') ?>/" + id,
            async: false,
            type: "POST",
            success: function (data) {
                
                $('#sub_root_menu').html("");
                $('#sub_root_menu').html(data);
                
                $("#sub_root_menu").select2({
                    placeholder: "Select root menu",
                    allowClear: true,
                });
            }
        });
    }
    
</script>
<!--=== End Script ===-->

