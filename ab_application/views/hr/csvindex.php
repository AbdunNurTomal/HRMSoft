
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <div class="container" style="margin-top:20px">    
                <?php 
                if (isset($error)):
                    $err=explode("##",$error); echo $err[0]; 
                endif; 
                 ?>
                
                <?php
                if ($this->session->flashdata('success') == TRUE):
                    $message = explode("##", $this->session->flashdata('success'));
                    echo $message[0];
                endif;
                ?>
                
                <h2>CSV Import System</h2> 
                <form method="post" action="<?php echo base_url() ?>csv/importcsv" enctype="multipart/form-data">
                    <input type="file" name="userfile" ><br><br>
                    <input type="submit" name="submit" value="UPLOAD" class="btn btn-u">
                </form>

                <br><br>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover responsive-table table-wrap" >
                    <colgroup>
                        <col width="5%">
                        <col width="25%">
                        <col width="40%">
                        <col width="35%">
                    </colgroup>
                    <!--<caption>Address Book List</caption>-->
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($addressbook) {
                            foreach ($addressbook as $row):
                                ?>
                                <tr>
                                    <td><?php echo $row['firstname']; ?></td>
                                    <td><?php echo $row['lastname']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                            <?php
                            endforeach;
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                <footer>
                    <p>&copy; CSV Import System</p>
                </footer>
            </div>

        </div>
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->
