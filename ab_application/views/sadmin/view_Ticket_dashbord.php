<div class="row main-body">
<div class="col-md-12 main-content-div">
    <div class="main-content">
        <div id="result">
            <!--<iframe src="http://www.hr360.com/autologin.aspx?GUID=2eeedad1-885d-4abf-8b57-56f99320af44" style="height: 900px; width: 100%;"></iframe>-->
        </div>
        <script type="text/javascript">
            
            $(function () {
                if(user_group==1){
                    var ticketUrl = '<?php echo base_url() ?>ticket/index.php/admin/index';
                }else
                {
                    var ticketUrl = '<?php  echo base_url() ?>ticket';
                }
                //var webClockUrl = 'https://www.hr360.com/autologin.aspx?GUID=2eeedad1-885d-4abf-8b57-56f99320af44';
                $('#result').html('<iframe src="' + ticketUrl + '" style="height: 600px; width: 100%;"></iframe>');

            });
                
        </script>
    </div>
</div>
</div>
		 
    </div><!--/end row-->
</div><!--/end container-->

