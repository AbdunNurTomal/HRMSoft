<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/no_table.css" />
<style>

</style>
<!--=== Head Files  ===-->

<!--=== Content ===-->
<div class="container content">
    <?php
    $find_bus = $this->session->userdata('find_bus');
//    print_r($find_bus);
    ?>

    <div class="row">
        <form action="<?php // echo site_url('Seat_update/update_seat')    ?>" id="sky-form17" enctype="multipart/form-data" class="sky-form" method="post">
            <div class="col-md-3">
                <h4>Print/SMS Ticket</h4>
                <div id="cancel_ticket" class="clearfix">

                    <label for="t_number">Ticket no / Reservation Ref:</label>
                    <input id="t_number" class="form-control" type="text" required="" placeholder="Enter PNR or Reservation Ref." name="t_number" maxlength="12">
                    <br>
                    <button class="btn btn-success  btn-sm" onclick="searchTicket();" type="button">Search</button>
                    <div id="errordiv" class="error hide">
                        <i class="fa fa-exclamation-triangle"></i>
                        Please enter your PNR or Reservation Reference ID
                    </div>


                    <div id="cancel_tickt_shadow"> </div>
                </div>
            </div>
        </form>

        <br>
        <br>
        <div class="col-md-9">
            <?php
            //booking no is get then this div work?
            if (isset($find_bus['booking_no'])) {
                $condition = array('booking_no' => $find_bus['booking_no']);
                $query = $this->Common_model->get_selected_row('tbl_trans_details', $condition);
                $row = $query->row();
                if ($row->is_confirm == 0 && $row->tkt_code == null) {
                    ?>
                    <div class="row">
                        <form action="" id="sky-form18" enctype="multipart/form-data" class="sky-form" method="post">
                            <div class='col-md-8 shadow-wrapper col-md-offset-1'>
                                <div class="tag-box tag-box-v1 box-shadow shadow-effect-2">
                                    <div class="headline"><h2>Please Complete Payment Process</h2></div>
                                    <!-- Tab v1 -->
                                    <div class="tab-v1">
                                        <ul class="nav nav-tabs">
                                            <li class="active" onclick="open_payment('mob')"><a href="#mob" data-toggle="tab">Mobile</a></li>
                                            <li onclick="open_payment('cod')"><a href="#cod" data-toggle="tab">Cash On Delivery</a></li>
                                            <li onclick="open_payment('card')"><a href="#card" data-toggle="tab">Credit/Debit Cards</a></li>
                                            <li onclick="open_payment('ibank')"><a href="#ibank" data-toggle="tab">Internet Banking</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="mob"></div>
                                            <div class="tab-pane fade in" id="cod"></div>
                                            <div class="tab-pane fade in" id="card"></div>
                                            <div class="tab-pane fade in" id="ibank"></div>
                                        </div>
                                    </div>
                                    <!-- End Tab v1 -->
                                    <footer>
                                        <button type="button" onclick="get_passenger()" class="btn-u">Confirm Reservation</button>
                                        <button type="button" class="btn-u btn-u-default" onclick="window.history.back();">Back</button>
                                    </footer>
                                </div>

                            </div>
                        </form>
                    </div>
                    <?php
                } else if ($row->is_confirm == 1 && $row->tkt_code != null) {
                    ?>
                    <div class="row">
                        <div class='col-md-8 shadow-wrapper col-md-offset-1'>
                            <div class='tag-box tag-box-v1 box-shadow shadow-effect'>
                                <div class='row' id='search-ticket-info'>
                                    <div class='col-md-offset-2'>
                                        <span class='dropcap dropcap-bg rounded-x bg-color-grey'><i class='fa fa-info' aria-hidden='true'></i></span>
                                    </div>
                                    <section class='col col-12'>
                                        <p>If you have a confirmed ticket booked through www.obokash.com, 
                                            please enter your ticket PNR and you can get it printed, SMSed or emailed from this panel. </p>
                                        <p>In case you have reserved a ticket thorugh bKash and want to confirm your bKash transaction 
                                            ID to get your confirmed ticket, please enter your Reservation Reference ID.</p>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>   
                <?php } ?>

                <?php
                //booking no is null then show this information
            } else {
                ?>
                <div class="row">
                    <div class='col-md-8 shadow-wrapper col-md-offset-1'>
                        <div class='tag-box tag-box-v1 box-shadow shadow-effect'>
                            <div class='row' id='search-ticket-info'>
                                <div class='col-md-offset-2'>
                                    <span class='dropcap dropcap-bg rounded-x bg-color-grey'><i class='fa fa-info' aria-hidden='true'></i></span>
                                </div>
                                <section class='col col-12'>
                                    <p>If you have a confirmed ticket booked through www.obokash.com, 
                                        please enter your ticket PNR and you can get it printed, SMSed or emailed from this panel. </p>
                                    <p>In case you have reserved a ticket thorugh bKash and want to confirm your bKash transaction 
                                        ID to get your confirmed ticket, please enter your Reservation Reference ID.</p>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>


        </div>
    </div> 

</div><!--/container-->


<script type="text/javascript">

    $("#p_gender,#p_nation").select2({
        placeholder: "Select a State",
        allowClear: true,
    });
    window.onload = function () {
        open_payment('mob');
    };
    function open_payment(tab) {
        $.ajax({
            url: "<?php echo site_url('seat_plan/ajax_seat_process/') ?>/" + tab,
            success: function (data)
            {
                $("#del").remove();

                $('#' + tab).after(data);
//            document.getElementById("add_form").innerHTML="newtext";
//            $("#add_form").html("xyz");
            }

        });
    }

    function searchTicket()
    {
        var dt = document.getElementById("t_number").value;
        // ajax adding data to database
        var url, verify_pg;
        url = "<?php echo site_url('printsms/check_number') ?>";
        var print_pg = "<?php echo site_url('chome/printticket') ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: $('#sky-form17').serialize(),
            dataType: "JSON",
            success: function (data)
            {
//                alert(data.status);
                if (data.status == 'print_v') {

                    window.location.href = print_pg;
                } else if (data.status == 'print_t') {
                    window.location.href = print_pg;

                } else if (data.status == 'not_found') {
                    alert("Enter Booking / Ticket Number");
                } else {
                    window.location.reload();
                }



            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
        // end ajax adding data to database

    }
function get_passenger()
    {
        
            // ajax adding data to database
            var url,verify_pg;
            url = "<?php echo site_url('printsms/update_sess') ?>";
            verify_pg = "<?php echo site_url('chome/reserved') ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: $('#sky-form18').serialize(),
                dataType: "JSON",
                success: function(data)
                {
//                    alert(data);
                    if (data.status == 'set_session') {
                        window.location.href = verify_pg;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
            // end ajax adding data to database
        
        }
</script>
<!--=== End Content ===-->

