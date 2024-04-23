
<div class="col-md-10 main-content-div">
    <div class="main-content">
        
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
                
                <table id="dataTables-example-ajaxpagination_demo" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Menu Name</th>
                            <th>Menu Link</th>
                            <th>Module</th>
                            <th>Root Menu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="tb">
                        <?php
//                        if ($query) {
//                            foreach ($query->result() as $row) {
//                                $pdt = $row->id;
//                                print"<tr>";
//                                print"<td id='catA" . $pdt . "'>" . $row->id . "</td>";
//                                print"<td id='catB" . $pdt . "'>" . ucwords($row->menu_name) . "</td>";
//                                print"<td id='catE" . $pdt . "'>" . $row->menu_link . "</td>";
//                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this,$row->module_id,'main_module','module_name'). "</td>";
//                                print"<td id='catE" . $pdt . "'>" . $this->Common_model->get_name($this,$row->root_menu,'main_menu','menu_name') . "</td>";
//                                print"<td id='catE" . $pdt . "'>" . $status_array[$row->isactive] . "</td>";
//                                print"</tr>";
//                            }
//                        }
                        ?> 
                    </tbody>
                </table>
                
                <div class="row clear-fix">
                    <div class="col-md-4 pull-right">
                        <button  id="previous" class="btn btn-sm btn-primary">Previous</button>
                        <lable>Page <lable id="page_number"></lable> of <lable id="total_page"></lable></lable>
                        <button  id="next" class="btn btn-sm btn-primary">Next</button>
                    </div>
                </div>

                <div style="text-align: center">
                    <img id="load_ajax_png" src="http://sanwebe.com/assets/ajax-load-more-results/ajax-loader.gif" alt="loading" style="display: none"/>
                </div>
                
            </div>
        </div>
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->



<script>
    
    
    $(document).ready(function () {
        
         setTimeout(function () {
             
            var table = $('#dataTables-example-ajaxpagination_demo').dataTable({
               "paging":   false,
               "ordering": false,
               "info":     false
           });
           
        }, 1000);
        
    });
    
    
            var page_number = 0;
            var total_page = null;
            var sr = 0;
            var sr_no = 0;


            var getReport = function (page_number) {
                if (page_number == 0) {
                    $("#previous").prop('disabled', true);
                } else {
                    $("#previous").prop('disabled', false);
                }

                if (page_number == (total_page - 1)) {
                    $("#next").prop('disabled', true);
                } else {
                    $("#next").prop('disabled', false);
                }

                $("#page_number").text(page_number + 1);

                $.ajax({
                    url: "<?php echo base_url() ?>Con_ajaxpagination_demo/pagination",
                    type: "POST",
                    dataType: 'json',
                    data: 'page_number=' + page_number,
                    success: function (data) {
                        window.mydata = data;
                        total_page = mydata[0].TotalRows;
                        $("#total_page").text(total_page);
                        var record_par_page = mydata[0].Rows;
                        $.each(record_par_page, function (key, data) {
                            sr = (key + 1);
                            $(".tb").append('<tr><td>' + sr + '</td><td>' + data.menu_name + '</td><td>' + data.menu_link + '</td><td>' + data.module_id + '</td><td>' + data.root_menu + '</td><td>' + data.isactive + '</td></tr>');

                        });
                    }
                });
            };

            var search = function (str) {
                if (str != '') {
    //                                   $.ajax({
    //                                       url:"<?php echo base_url() ?>index.php/welcome/pagination",
    //                                     type:"POST",
    //                                     dataType: 'json',
    //                                     data:'search='+str,
    //                                     success:function(data){
    //                                         window.mydata = data;
    //                                          total_page= mydata[0].TotalRows;
    //                                         $("#total_page").text(total_page);
    //                                         var record_par_page = mydata[0].Rows;
    //                                          $.each(record_par_page, function (key, data) {
    //                                               sr =(key+1);    
    //                                                $(".tb").append('<tr><td>'+sr+'</td><td>'+data.id+'</td><td>'+data.name+'</td></tr>');
    //                                           });
    //                                      }
    //                                   });
                }
            };


            $(document).ready(function (e) {

                getReport(page_number);
                console.log(sr);

                $("#next").on("click", function () {
                    $(".tb").html("");
                    page_number = (page_number + 1);
                    getReport(page_number);
                    console.log(sr);

                });

                $("#previous").on("click", function () {
                    $(".tb").html("");
                    page_number = (page_number - 1);
                    getReport(page_number);
                });


                $("#search").on('keyup', function () {
                    var str = $.trim($(this).val());

                    search(str);
                });
            });
        </script>
        
  
<!--=== End Content ===-->

