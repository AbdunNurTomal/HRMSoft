<style>


.datepicker-inline {
    width: 100% !important;
    height: 100% !important;
}


div.datepicker-days > table{
    width: 100% !important;
    height: 100% !important;
    font-size:1.5em;
}

div.datepicker-days > table thead tr{
     font-size: 24px !important;
}

div.datepicker-days > table tbody tr{
    height:60px;
}

.activeClass{
    /*background: #ffcc00;*/ 
    /*background: #72c02c;*/ 
    
    background: #b4e391; /* Old browsers */
    background: -moz-linear-gradient(top, #b4e391 0%, #61c419 50%, #b4e391 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top, #b4e391 0%,#61c419 50%,#b4e391 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom, #b4e391 0%,#61c419 50%,#b4e391 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4e391', endColorstr='#b4e391',GradientType=0 ); /* IE6-9 */
  }
  

  
</style>
<div class="col-md-10 main-content-div">
    <div class="main-content">
        
        <div class="container conbre">
            <ol class="breadcrumb">
                <!--<li><a href="<?php // echo base_url() . 'Con_TimeAndAttendance' ?>">HRM</a></li>-->
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
            
            <div class="tab-pane fade in active" id="home-1">
                <form action="#" id="sky-form" class="sky-form">
                    <fieldset>
                        <section>
                            <!--<label class="label">Select single date with inline datepicker</label>-->
                            <div id="inline"></div>
                        </section>

                    </fieldset>
                </form>
            </div>
            
        </div>
            
            
<!--        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
         
            <div class="table-responsive col-md-12 col-centered">
                
                <h3><i>Training Manager Benefits</i></h3>
                <h5><u>Know who needs to be trained on what and when.</u></h5>
                <p>
                   Now you can plan and prepare for training without the last minute scrambling that occurs when recurring training becomes due. Run a report to show overdue and upcoming training for the next period of time that you define, and see what's coming up while you still have time to prepare and schedule.
                </p>
                <br>
                <h5><u>Easily track Employee Safety Training, HR Training, Internal/External Training, and more.</u></h5>
                <p>
                    Do you have employee training records stored in different systems, file cabinets, or within various groups? With Training Manager, you can consolidate these disparate systems into one and always know where to find all your training records. 
                </p>
                <br>
                <h5><u>Manage and share your training data across your company in a central repository.</u></h5>
                <p>
                    Whether you want to provide more transparency to training records for everyone or just standardize a back-office system for training records administrators and managers, Training Manager allows you to create login accounts to define who can login, view, or edit the training records database.
                </p>
                <br>
                <h5><u>Eliminate the tedious, time-consuming work spent preparing training compliance reports.</u></h5>
                <p>
                    If you have been working with a paper or Excel based tracking system, you know how much work it takes to determine whether an individual is compliant with required training. Summarizing compliance metrics for a Group or the entire Company can be a daunting task without a training records database. With Training Manager, you can print these reports at any time without the trouble of manually collating and preparing the data.
                </p>
                <br>
               
            </div>
            
        </div>-->

    </div>
</div>
		 
    </div><!--/end row-->
</div><!--/end container-->


<!-- Modal -->
<div class="modal fade" id="Coy_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Training Status</h4>
            </div>
            <div class="modal-body">
                
                <div class="table-responsive col-md-12 col-centered">
                    <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Training Name</th>
                                <th>Proposed Date</th>
                                <th>Employees</th>
                                <th>Training Objective</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="training_req">

                        </tbody>
                    </table>
                </div>
                   
            </div>
        </div>
    </div>
</div>
<?php 

    if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
        $query = $this->db->get_where('main_training_requisition', array('company_id' => $this->company_id,'isactive' => 1,'req_status' => 1 ));
    } else {
        $query = $this->db->get_where('main_training_requisition', array('isactive' => 1,'req_status' => 1));
    }
    
    $proposed_date="";
    if ($query) {
        foreach ($query->result() as $row) {
            
            if($proposed_date=="") $proposed_date='"' .date("n-j-Y",strtotime($row->proposed_date)). '"';
            else $proposed_date=$proposed_date.",". '"' .date("n-j-Y",strtotime($row->proposed_date)). '"';

        }
    }
    
    //echo $proposed_date;
    
    //  03-01-2017,04-27-2017,04-27-2017,05-03-2017,05-08-2017 
   // echo "===>> ".date("n-j-Y");
?>

<script type="text/javascript">

    
    var active_dates = [<?php echo $proposed_date; ?>];
    //var active_dates = [""];
    
    jQuery(document).ready(function() {
        
        $('#inline').datepicker({
            format: 'mm-dd-yyyy',
            todayHighlight: true,
            autoclose: true,
            beforeShowDay: function(date){
                    var d = date;
                    var curr_date = d.getDate();
                    var curr_month = d.getMonth() + 1; //Months are zero based
                    var curr_year = d.getFullYear();
                    var formattedDate = curr_month + "-" + curr_date + "-" + curr_year
                    //alert (formattedDate);
                    if ($.inArray(formattedDate, active_dates) != -1){
                      return {
                         classes: 'activeClass'
                      };
                    }
                 return;
             }
        }).on('changeDate', showTestDate);
        
        function showTestDate(){
            var tdate = $('#inline').datepicker('getFormattedDate');
            //alert (tdate);
            $.ajax({
                url: "<?php  echo site_url('Con_Training/ajax_training_Modal/') ?>/" + tdate,
                type: "POST"
            }).done(function (data) {
                //alert(data);
                $('#training_req').html(data);
                
                $('#Coy_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Training Status'); // Set title to Bootstrap modal title
            });
        }

    });
    

    
</script>
