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
                <!--<li><a href="<?php // echo base_url() . 'Con_Leave_Dashboard' ?>">HRM</a></li>-->
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        <div class="container tag-box tag-box-v3" style="margin-top:0px; width: 96%; padding-bottom: 15px;">
            
            <div class="tab-pane fade in active" id="home-1">
                <form action="#" id="sky-form" class="sky-form">
                    <fieldset>
                        <section>
                            <div id="inline"></div>
                        </section>

                    </fieldset>
                </form>
            </div>
            
        </div>

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
                <h4 class="modal-title" id="myModalLabel">Leave Status</h4>
            </div>
            <div class="modal-body">
                
                <div class="table-responsive col-md-12 col-centered">
                    <table id="dataTables-example" class="table table-striped table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee Name</th>
                                <th>Leave Type</th>
                                <th>Leave Date</th>
                                <th>Reason</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="leave_req">

                        </tbody>
                    </table>
                </div>
                   
            </div>
        </div>
    </div>
</div>
<?php 

    if ($this->user_group == 11 || $this->user_group == 12 || $this->user_group == 8 || $this->user_group == 4) {//Hr Manager //Company User //Admin //HR
        $this->db->order_by("number_of_days", "asc");
        $query = $this->db->get_where('main_leave_request', array('company_id' => $this->company_id,'isactive' => 1));//,'req_status' => 1 //'id' => 7
    } else {
        $this->db->order_by("number_of_days", "asc");
        $query = $this->db->get_where('main_leave_request', array('isactive' => 1));
    }
    //echo $this->db->last_query();
   
    $leave_date="";
    if ($query) {
        foreach ($query->result() as $row) {
           
            if($row->number_of_days==1)
            {
                if($leave_date=="") $leave_date='"' .date("n-j-Y",strtotime($row->from_date)). '"';
                else $leave_date=$leave_date.",". '"' .date("n-j-Y",strtotime($row->from_date)). '"';
            }
            else {
                
                for($k=0; $k<$row->number_of_days; $k++)
                {
                   $ddate=$this->Common_model->add_date($row->from_date,$k);
                   
                   if($leave_date=="") $leave_date='"' .date("n-j-Y",strtotime($ddate)). '"';
                   else $leave_date=$leave_date.",". '"' .date("n-j-Y",strtotime($ddate)). '"';
                
                }
            }

        }
    }
    
    //echo $leave_date;
   
?>

<script type="text/javascript">

    
    var active_dates = [<?php echo $leave_date; ?>];
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
                url: "<?php  echo site_url('Con_Leave_Dashboard/ajax_leave_Modal/') ?>/" + tdate,
                type: "POST"
            }).done(function (data) {
                //alert(data);return;
                
                $('#leave_req').html(data);
                
                $('#Coy_Modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Leave Status'); // Set title to Bootstrap modal title
            });
        }

    });
    

    
</script>

