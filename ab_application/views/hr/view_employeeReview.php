
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
                <div class="pull-right" id="employee_name_div" ><?php
                    if ($type == 2) {
                        echo $return_name;
                    }
                    ?></div>
            </ol>
        </div>

        <div class="container" style="margin-top: 0px; padding-bottom: 15px;">
            <?php
            if ($type == 1 || $type == 2) { //entry and edit
                ?>
                <div class="row tab-v3">
                    <div class="col-sm-12">
                        <?php echo $content_inner; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->
