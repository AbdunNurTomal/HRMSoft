<link rel="stylesheet" href="<?php echo base_url() ?>assets/fullcalendar/fullcalendar.min.css" />
<script src="<?php echo base_url() ?>assets/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>assets/fullcalendar/gcal.js"></script>
               
<div class="col-md-10 main-content-div">
    <div class="main-content">

        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this, $module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>

        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> 
            <!-- data table -->
            <div class="table-responsive col-md-12 col-centered">
               <div id="calendar"> </div>
            </div>
            <!-- end data table --> 
        </div>
    </div>
</div>

</div><!--/row-->
</div><!--/container-->


<script type="text/javascript">

    $(document).ready(function() {
        
        $('#calendar').fullCalendar({
            eventSources: [
                {
                    events: function(start, end, timezone, callback) {
                        $.ajax({
                        url: '<?php echo base_url() ?>Con_Event_Calendar/get_events',
                        dataType: 'json',
                        data: {
                            // our hypothetical feed requires UNIX timestamps
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(msg) {
                            var events = msg.events;
                            callback(events);
                        }
                        });
                    }
                },
            ],
            header: {
               left: 'prev,next today',
               center: 'title',
               right: 'month,basicWeek,basicDay'
            },
            navLinks: true,
            editable: true,
        });
    });
    

</script>
<!--=== End Content ===-->

