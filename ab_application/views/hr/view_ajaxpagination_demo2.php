
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3">
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">

                <table id="example-test" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Middle name</th>
                            <th>Last name</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <!--<tfoot>
                        <tr>
                            <th>First name</th>
                            <th>Middle name</th>
                            <th>Last name</th>
                            <th>Address</th>
                        </tr>
                    </tfoot>-->
                </table>

            </div>
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
<style type="text/css">
    .dataTables_wrapper .dataTables_paginate .paginate_button{padding:0 !important}
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover{border:1px solid #fff !important}
</style>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $('#example-test').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 30,
            "ajax": "<?php echo base_url(); ?>Con_ajaxpagination_demo/pagination2"
        });
    });

</script>


<!--=== End Content ===-->

