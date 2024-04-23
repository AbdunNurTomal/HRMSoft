<?php //pr($csv_array[0]);           ?>

<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; padding-bottom: 15px;"> <!-- container well div -->
            <form id="import-emp_data" name="import-emp_data" action="<?php echo base_url(); ?>Con_Employee_Import/Import_employee" method="post">
            <div class="table-responsive col-md-12 col-centered">
                <table id="dataTables-example_csv_data" class="table table-striped table-bordered dt-responsive table-hover nowrap"> <!-- data table -->
                    <thead>
                        <tr>
                            <?php 
                            $k = 0;
                            foreach ($csv_array as $row) {
                                $row_array[$k] = array_values($row);
                            }
                            //pr($row_array,0);
                            foreach ($row_array as $key) { 
                                foreach ($key as $kk=>$vv) {
                                ?>
                                <td>
                                    <select name="dropdown_<?php echo $kk; ?>" id="dropdown_<?php echo $kk; ?>" class="col-sm-12 col-xs-12 myselect2 input-sm">
                                        <option></option>
                                        <?php
                                            foreach ($table_colum_array as $keyy => $val) {
                                                print"<option value='" . $keyy . "'>" . $val . "</option>";
                                            }
                                        ?>
                                    </select>  
                                </td>
                                <?php 
                                
                                } 
                                
                            }
                            
                            foreach ($row_array as $key) {
                                foreach ($key as $kk => $vv) {
                                    ?>
                                    <script>
                                        var kk =<?php echo $kk ?>;
                                        $("#dropdown_"+kk).select2({
                                            placeholder: " ------ Select ------ ",
                                            allowClear: true,
                                        });
                                    </script>

                                <?php
                                }
                            }
                        ?>
                        </tr>
                        <tr>
                            <?php
                            //pr($csv_array,0);
                            $dynamic_columns_header = $csv_array[0];
                            foreach ($dynamic_columns_header as $key => $data1) {
                                    echo '<th>'.$key.'</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //pr($csv_array[0]);
                        
                        if (!empty($csv_array)) {
                            $k = 0;
                            $csv_data_array=array();
                            foreach ($csv_array as $row) {
                                $csv_data_array[$k] = array_values($row);
                                $k++;
                            }
                            //pr($csv_data_array,0);
                        }
                        
                                                        
                        
                        foreach ($csv_data_array as $key) { 
                            echo '<tr>';
                            foreach ($key as $kk=>$vv) {
                                echo '<td>' . $vv . '</td>';
                            }
                            echo '</tr>';
                        } 
                        
//                        if (!empty($csv_array)) {
//                            foreach ($csv_array as $Row) {
//                                echo '<tr>';
//                                foreach ($dynamic_columns_header as $key => $data1) {
//                                    echo '<td>' .$Row[$key]. '</td>';
//                                }
//                                 echo '</tr>';
//                            }                            
//                        }
                        
                        
                        
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 

            <div class="modal-footer">
                <input type="hidden" name="emp_file_name" value="<?php echo $emp_file_name; ?>" />
                <input type="hidden" name="upload_file_type" value="<?php echo $upload_file_type; ?>" />

                <button type="submit" id="submit" class="btn btn-u"> Process </button>
                <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employee_Import" ?>">Close</a>
            </div>
            
            </form>
            
        </div>

    </div>
</div>


</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
    
    $(window).load(function () {
        $("#dataTables-example_csv_data").wrap('<div class="overflow-x"> </div>');
    });
    
    $(document).ready(function () {
        $('#dataTables-example_csv_data').dataTable({
            "order": [ 10, "desc" ],
            "pageLength": 10,
            "paginationType": "input"
        });
    });

    $("#upload_file_type").select2({
        placeholder: "Select File Type",
        allowClear: true,
    });

    var save_method; //for save method string
    function add_upload_file()
    {
        save_method = 'add';
        $('#emp_file_Modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Upload Document'); // Set Title to Bootstrap modal title
    }

    $(function () {
        $("#import-emp_data").submit(function (event) {
            loading_box(base_url);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: $("#import-emp_data").serialize(),
                type: $(this).attr('method')
            }).done(function (data) {

                var url='<?php echo base_url() ?>Con_Employee_Import';
                view_message(data, url, '', '');

            });
            event.preventDefault();
        });
    });
  

</script>

