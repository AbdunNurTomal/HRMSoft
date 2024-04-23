<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/no_table.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/seat_cart.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/seat_manage.js"></script>
<style>

</style>
<!--=== Head Files  ===-->

<!--=== Content ===-->
<div class="container">
    <!--=== Modify Search ===-->
        <div id="modify_div">
            <form id="sky-form12" name="sky-form12" class="sky-form page-search-form" method="post" action="" enctype="multipart/form-data" role="form" >
                    <div class="row">
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 banner_search_ttl control-label pull-left">From</label>
                            <select name="from" id="from" class="col-sm-12 col-xs-8 myselect2">
                                <option></option>
                                <?php
                                $this->db->distinct();
                                $this->db->select('dept_loc');
                                $query = $this->db->get('tbl_route');
                                foreach ($query->result() as $row) {
                                    print"<option value='" . $row->dept_loc . "'>" . $row->dept_loc . "</option>";
                                }
                                ?>
                            </select>  
                        </div> 
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-4 banner_search_ttl control-label pull-left">To</label>
                            <select name="to" id="to" class="col-sm-12 col-xs-8 myselect2">
                                <option></option>
                                <?php
                                $query = $this->Common_model->to_location();
                                foreach ($query->result() as $row) {
                                    print"<option value='" . $row->loc . "'>" . $row->loc . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-12 banner_search_ttl control-label pull-left">Journey Date</label>
                            <section class="col-sm-12 col-xs-12 nopadding">
                                <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input class="dt_pick" type="text" name="start2" id="start2" placeholder="Start date">
                                </label>
                            </section>
                        </div>
                        <div class="col-md-3 col-sm-6 find_mar">
                            <label class="col-sm-12 col-xs-12 banner_search_ttl control-label pull-left">Return Date</label>
                            <section class="col-sm-12 col-xs-12 nopadding">
                                <label class="input">
                                    <i class="icon-append fa fa-calendar"></i>
                                    <input class="dt_pick" type="text" name="finish2" id="finish2" placeholder="Return Date">
                                </label>
                            </section>
                        </div> 
                    </div> 
                    <div class="row ">
                        <div class="inline-group">
                            <div class="col-md-2 col-sm-3 col-xs-12">
                                <label class="banner_search_ttl pull-left coach_tp">Coach Type: </label>
                            </div>
                            <div class="col-md-4  col-sm-6 col-xs-12">

                                <label class="checkbox"><input type="checkbox" id="coach_type1" name="coach_type1" value="1"><i></i>AC</label>
                                <label class="checkbox"><input type="checkbox" id="coach_type2" name="coach_type2" value="2"><i></i>Non AC</label>
                                <label class="checkbox"><input type="checkbox" id="coach_type3" name="coach_type3" value="3"><i></i>Sleeper</label>
                            </div>
                            <div class="col-md-3 col-md-offset-2">
                                <button type="submit" rel="hover-shadow" class=" btn-u btn-block btn-u-green rounded hover-shadow"><i class="icon-magnifier"></i> Find Buses</button>
                            </div>
                        </div>

                    </div>
                </form>
        </div>
        <!--=== End Modify Search ===-->
        <!--=== Content ===-->
	<div class="container content">
            <div class="row">
                <div class="col-sm-12 md-margin-bottom-50">
                    <div class="col-sm-9 headline"><h2>Search Result</h2></div>
                    <div class="col-sm-3">
                        <button id="modify_search" rel="hover-shadow" class=" btn-u  btn-u-green rounded hover-shadow"><i class="icon-magnifier"></i> Modify Search</button>
                        
                    </div>
                </div>
            </div>
        </div><!--/container-->
        <!--=== Search Result ===-->
            <div class="row">
                <div class="col-md-12" id="no-more-tables">
                    <?php
//                    echo $this->input->post('from');
                    if (isset($_POST['from']) and $_POST['from'] != '' and $_POST['to'] != '' and $_POST['start2'] != '') {
                        if (!isset($_POST['coach_type1']))
                            $_POST['coach_type1'] = null;
                        if (!isset($_POST['coach_type2']))
                            $_POST['coach_type2'] = null;
                        if (!isset($_POST['coach_type3']))
                            $_POST['coach_type3'] = null;

                        $form_data = array(
                            'from' => $this->input->post('from'),
                            'to' => $this->input->post('to'),
                            'journey_d' => $this->input->post('start2'),
                            'coach_type1' => $this->input->post('coach_type1'),
                            'coach_type2' => $this->input->post('coach_type2'),
                            'coach_type3' => $this->input->post('coach_type3'),
                        );
                        $this->session->set_userdata('find_bus', $form_data);
                    }

//                        //start add data to existing session
//                            $data = $this->session->userdata('find_bus');  
//                            $data['schedule_id'] = "10";  
//                            $this->session->set_userdata('find_bus', $data); 
//                        //end add data to session
//                            
//                        // start Removing Session Data
//                            $data = $this->session->userdata('find_bus');  
//                            unset($data['schedule_id']);  
//                            $this->session->set_userdata('find_bus', $data);
//                        // end Removing Session Data

                    $find_bus = $this->session->userdata('find_bus');
//                    print_r($find_bus);

                    if ($find_bus['from'] != '' and $find_bus['to'] != '' and $find_bus['journey_d'] != '') {

                        $query = $this->Common_model->find_bus($find_bus['coach_type1'], $find_bus['coach_type2'], $find_bus['coach_type3'], $find_bus['journey_d'], $find_bus['from'], $find_bus['to']);
//                            echo $this->db->last_query();
                        if ($query->num_rows() > 0) {
                            echo $find_bus['from'] . '*' . $find_bus['to'] . '*' . $find_bus['journey_d'];
                            echo ' Total Result: ';
                            echo $this->db->count_all_results() + 1;
                            ?>
                            <table class="col-md-12 table-striped table-condensed cf j_table"><!-- table-bordered -->
                                <thead class="cf th_bg">
                                    <tr>
                                        <th width="20%"></th>
                                        <th>DEPARTING<br>TIME</th>
                                        <th>ARRIVAL<br>TIME</th>
                                        <th>SEATS<br>AVAILABLE</th>
                                        <th>FARE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($query->result() as $row) {
                                        print"<tr class='" . $row->id . "'>";
                                        print"<td data-title='' class='text-left'>
                                                        <h5><b>" . $row->coy_name . "<b></h5>
                                                    <!--    <img src='" . base_url() . "bus_pic/bus_pic_1.jpg' width=130/><br>-->
                                                        <span class='ttl_1'>" . $row->bus_name . ' , ' . $row->bus_type . "</span><br>
                                                        <span class='ttl_2'>Route:</span>
                                                        <span class='ttl_1'>" . $row->dept_loc . '-' . $row->arriv_loc . "</span><br>
                                                        <a data-toggle='modal' data-target='#mModal' href='javascript:void(0)'><span class='ttl_3'> Cancellation Policy</span></a>
                                                        </td>";
                                        print"<td data-title='DEPARTING TIME' class='text-center'>
                                                    <span class='ttl_4'>" . date("g:i A", strtotime($row->dep_time)) . "</span><br>
                                                    <span class='ttl_2'>at</span><br>
                                                    <span class='ttl_2'>Start Counter</span>
                                                    </td>";
                                        print"<td data-title='ARRIVAL TIME' class='text-center'>
                                                    <span class='ttl_4'>" . date("g:i A", strtotime($row->arr_time)) . "</span><br>
                                                    <span class='ttl_2'>at</span><br>
                                                    <span class='ttl_2'>End Counter</span>
                                                    </td>";
                                        print"<td data-title='SEATS AVAILABLE' class='text-center'>
                                                    <span class='ttl_4'>". $row->available_seat."</span><br>
                                                    </td>";
                                        print"<td data-title='FARE' class='text-center'>
                                                    <span class='ttl_5'>" . $row->fare . " &#x9f3;</span><br>
                                                    <button rel='hover-shadow' onclick='open_seat(" . $row->id . ")' class='cal_" . $row->id . " btn-u  btn-u-green rounded hover-shadow' ><i class='icon-magnifier'></i> View Seats</button>
                                                    </td>";
                                        print "</tr>";
                                        ?>

                                    <?php } ?>
                                    <!-- -->

                                    <!-- -->
                                </tbody>
                            </table>
                            <?php
                        } else {
                            echo '<span style="color:#CD0100; font-size:120%;">No trips found. Please call our call centre @ 123456 and we might arrange the tickets for you.</span>';
                        }
                    }
                    ?>
                </div>
            </div>
            <br>
            <!--/Search Result -->
</div><!--/container-->
<!-- modal -->


<script type="text/javascript">

    var op = -1;
//    $("#modify_div").toggle("slow");
    $(".view_seatsX").click(function () {
        var first_class = $(this).attr('class').split(" ")[0];
        $('tr.' + first_class).toggle("slow");
    });

    $(".view_seats").click(function () {
        alert('asdf');
    });
    function open_seat(id) {

//       start for clear seat_manage.js
        seats = [];
        booking_seats = [];
        i = 0;
        allid = [];
//       end for clear seat_manage.js     

        if (op != id) {

            $.ajax({
                url: "<?php echo site_url('seat_plan/ajax_seat_arrange/') ?>/" + id,
                success: function (data)
                {
                    $(".tr_del").remove();

                    $('tr.' + id).after(data);
//            document.getElementById("add_form").innerHTML="newtext";
//            $("#add_form").html("xyz");

                    $("#bordind").select2({
                        placeholder: "Bording Point",
                        allowClear: true,
                    });
                    op = id;
                }

            });
        } else {
            $(".tr_del").remove();
            op = -1;
        }

//        $('tr.'+id).after(strVar);
    }

    $("#from,#to").select2({
        placeholder: "Select a State",
        allowClear: true,
    });
    
    $( "#modify_search" ).click(function() {
        $( "#modify_div" ).toggle( "slow" );
    });
    $( ".view_seats" ).click(function() {
        var first_class = $(this).attr('class').split(" ")[0];
       $('tr.' + first_class).toggle( "slow" );  
    });


</script>
<!--=== End Content ===-->

