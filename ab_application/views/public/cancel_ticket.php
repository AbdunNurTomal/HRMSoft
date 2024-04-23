<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/no_table.css" />
<style>

</style>
<!--=== Head Files  ===-->

<!--=== Content ===-->
<div class="container content">
    <form action="<?php // echo site_url('Seat_update/update_seat') ?>" id="sky-form12" enctype="multipart/form-data" class="sky-form" method="post">
        <div class="row">
            <div class="col-md-3">
            <div class="row">
                <div class="col col-md">
                    <h4>Cancel Ticket</h4>
                    <div id="cancel_ticket" class="clearfix">
                        <label for="t_number">Ticket PNR</label>
                        <input id="t_number" class="form-control" type="text" required="" placeholder="Enter PNR " name="t_number" maxlength="10">
                        <br>
                        <div id="cancel_tickt_shadow"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md">
                    <div id="cancel_ticket" class="clearfix">
                        <label for="t_number">Mobile Number</label>
                        <input id="t_number" class="form-control" type="text" required="" placeholder="Enter Mobile Number " name="t_number" maxlength="10">
                        <br>
                        <button class="btn btn-success  btn-sm" onclick="searchTicket();" type="submit">Get Ticket Details</button>
                        <div id="cancel_tickt_shadow"> </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-9 shadow-wrapper">
                <div class="tag-box tag-box-v1 box-shadow shadow-effect">
                    <div class="row" id="search-ticket-info">
                        <div class="col-md-offset-5">
                        <span class="dropcap dropcap-bg rounded-x bg-color-grey"><i class="fa fa-info" aria-hidden="true"></i></span>
                        </div>
                        <section class="col col-12">
                            <p>If you have a confirmed ticket booked through www.obokash.com, 
                                please enter your ticket PNR and you can get it printed, SMSed or emailed from this panel. </p>
                            <p>In case you have reserved a ticket thorugh bKash and want to confirm your bKash transaction 
                                ID to get your confirmed ticket, please enter your Reservation Reference ID.</p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div><!--/container-->
<!-- modal -->


<script type="text/javascript">

</script>
<!--=== End Content ===-->

