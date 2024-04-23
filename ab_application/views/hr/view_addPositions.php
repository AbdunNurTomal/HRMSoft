<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb" >
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;">
            <?php
            if ($type == 1) {//entry
                ?>
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_Positions/save_positions" enctype="multipart/form-data" role="form" >
                    <input type="hidden" value="" name="id"/>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Job Title</label>
                            <select name="jobtitleid" id="jobtitleid" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                <option></option>
                                <?php
                                $this->db->distinct();
                                $this->db->select('*');
                                $query = $this->db->get('main_jobtitles');
                                foreach ($query->result() as $row) {
                                    print"<option value='" . $row->id . "'>" . $row->jobtitlename . "</option>";
                                }
                                ?>
                            </select>  
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 control-label pull-left">Position </label>
                            <input type="text" name="positionname" id="positionname" class="form-control" placeholder="Position Name " />
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-12 control-label pull-left">Description</label>
                            <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                        </div>
                    </div> 
                    <div class="modal-footer">                        
                        <button type="submit" id="submit" class="btn btn-u">Save</button>
                        <a class="btn btn-danger" href="<?php echo base_url() . "con_Positions" ?>">Close</a>
                    </div>
                </form>
                <?php
            } else if ($type == 2) {//edit
                //print_r($query);
                ?>
            <form id="sky-form11" name="sky-form11"  class="form-horizontal" method="post" action="<?php echo base_url(); ?>con_Positions/edit_Positions" enctype="multipart/form-data" role="form" >
                    <?php foreach ($query->result() as $row): ?> 
                        <input type="hidden" value="<?php echo $row->id ?>" name="id"/>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Job Title</label>
                                <select name="jobtitleid" id="jobtitleid" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                    <?php foreach ($listquery->result() as $row1): ?>
                                        <option value="<?php echo $row1->id ?>"<?php if ($jobtitleid == $row1->id) echo "selected"; ?>><?php echo $row1->jobtitlename ?></option>
                                    <?php endforeach; ?>
                                </select>  
                            </div>
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-4 control-label pull-left">Position </label>
                                <input type="text" name="positionname" id="positionname" value="<?php echo ucwords($row->positionname) ?>" class="form-control" placeholder="Position Name " />
                            </div> 
                            <div class="col-md-3 col-sm-6 find_mar">
                                <label class="col-sm-12 col-xs-12 control-label pull-left">Description</label>
                                <textarea class="form-control" rows="2" id="description" name="description"><?php echo ucwords($row->description) ?></textarea>
                            </div>
                        </div> 
                        <div class="modal-footer">                            
                            <button type="submit" id="submit" class="btn btn-u">Save</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . "con_Positions" ?>">Close</a>
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
     
    $(function(){
        $( "#sky-form11" ).submit(function( event ) {
           var url = $(this).attr('action');
                $.ajax({
                url: url,
                data: $("#sky-form11").serialize(),
                type: $(this).attr('method')
              }).done(function(data) {
                    
                    $('#sky-form11')[0].reset();
                    var url='<?php echo base_url() ?>con_Positions';
                   view_message(data,url);
              });
            event.preventDefault();
        });
    }); 

    $("#jobtitleid").select2({
        placeholder: "Job Title",
        allowClear: true,
    });
</script>
<!--=== End Script ===-->

