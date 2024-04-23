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
            <div class="table-responsive col-md-12 col-centered">
                <table id="dataTables-example" class="table table-striped table-bordered dt-responsive table-hover nowrap"> <!-- data table -->
                    <thead>
                        <tr>
                            <th>SL no.</th>
                            <th>SSN</th>
                            <th>First Name</th>
                            <th>Middle Initial</th>
                            <th>Last Name</th>
                            <th>Address 1</th>
                            <th>Address 2</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Pay Type</th>
                            <th>Hire Date</th>
                            <th>Pay Schedule</th>
                            <th>Dept Code</th>
                            <th>Reg Rate</th>
                            <th>Federal Filing Status</th>
                            <th>Federal Exemptions</th>
                            <th>Unemployment State</th>
                            <th>Withholding State</th>
                            <th>State Filing Status</th>
                            <th>State Exemptions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($csv_array)) {
                            $i = 0;
                            foreach ($csv_array as $row) {
                                echo '<tr>';
                                echo '<td>' . ++$i . '</td>';
                                echo '<td>' . $row['SSN'] . '</td>';
                                echo '<td>' . $row['First Name'] . '</td>';
                                echo '<td>' . $row['Middle Initial'] . '</td>';
                                echo '<td>' . $row['Last Name'] . '</td>';
                                echo '<td>' . $row['Address 1'] . '</td>';
                                echo '<td>' . $row['Address 2'] . '</td>';
                                echo '<td>' . $row['City'] . '</td>';
                                echo '<td>' . $row['State'] . '</td>';
                                echo '<td>' . $row['Zip'] . '</td>';
                                echo '<td>' . $row['Gender'] . '</td>';
                                echo '<td>' . $row['Date of Birth'] . '</td>';
                                echo '<td>' . $row['Pay Type'] . '</td>';
                                echo '<td>' . $row['Hire Date'] . '</td>';
                                echo '<td>' . $row['Pay Schedule'] . '</td>';
                                echo '<td>' . $row['Dept Code'] . '</td>';
                                echo '<td>' . $row['Reg Rate'] . '</td>';
                                echo '<td>' . $row['Federal Filing Status'] . '</td>';
                                echo '<td>' . $row['Federal Exemptions'] . '</td>';
                                echo '<td>' . $row['Unemployment State'] . '</td>';
                                echo '<td>' . $row['Withholding State'] . '</td>';
                                echo '<td>' . $row['State Filing Status'] . '</td>';
                                echo '<td>' . $row['State Exemptions'] . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- end data table --> 

            <div class="modal-footer">
                <form id="import-emp_data" name="import-emp_data" action="<?php echo base_url(); ?>Con_Employee_Import/Import_employee" method="post">
                    <input type="hidden" name="emp_file_name" value="<?php echo $emp_file_name; ?>" />
                    <input type="hidden" name="upload_file_type" value="<?php echo $upload_file_type; ?>" />

                    <button type="submit" id="submit" class="btn btn-u">Import Data</button>
                    <a class="btn btn-danger" href="<?php echo base_url() . "Con_Employee_Import" ?>">Close</a>
                </form>
            </div>
        </div>

    </div>
</div>


</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    $(window).load(function () {
        $("#dataTables-example").wrap('<div class="overflow-x"> </div>');
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

                var url = '';
                view_message(data, url, '', '');

            });
            event.preventDefault();
        });
    });

</script>

