<?php
$find_bus = $this->session->userdata('find_bus'); 
//print_r($find_bus);
if((!array_key_exists('booking_no', $find_bus)) && (!array_key_exists('tkt_code', $find_bus))){
  redirect('chome/printSms'); 
}else if((!array_key_exists('booking_no', $find_bus)) && ($find_bus['tkt_code']=='') ){
  redirect('chome/printSms');
}else if((!array_key_exists('tkt_code', $find_bus)) && ($find_bus['booking_no']=='') ){
  redirect('chome/printSms');
}

?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/no_table.css" />
<style>
@media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
    
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
    width: 100%;
  }
  
}
</style>
<!--=== Head Files  ===-->

<!--=== Content ===-->
<div class="container content">
    <?php
    $find_bus = $this->session->userdata('find_bus');
        if(isset($find_bus['tkt_code'])){
            $find_bus = $this->session->userdata('find_bus');
             $condition = array('tkt_code' => $find_bus['tkt_code']);
             $query = $this->Common_model->get_selected_row('tbl_trans_details',$condition);
             $row = $query->row();
            $find_bus['booking_no'] = $row->booking_no;
            $this->session->set_userdata('find_bus', $find_bus); 
        }
    $find_bus = $this->session->userdata('find_bus');
    //print_r($find_bus);
    ?>
        <div id="printDiv"> 
            <div class="row">
                <div class="col-md-offset-4">
                    <span> <h2>&nbsp;&nbsp;&nbsp;&nbsp;Abokash.com(Online Ticket)</h2></span>  
                </div>

                <br><br>
            </div>
            <div class="row">
                <?php
                
                $query = $this->Common_model->get_printValue($find_bus['booking_no']);
                $row = $query->row();
                if(isset($row)){
                ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Journey Date :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><b><?php
                                    $j_date = date("D, j M Y", strtotime($row->journey_date));
                                    echo $j_date;
                                    ?></b></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Tracking No :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php echo $find_bus['booking_no']; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Ticket No :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php echo $row->tkt_code; ?></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Route :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><b><?php echo $row->dept_loc . '-' . $row->arriv_loc ?></b></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Passenger Name :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php echo $row->full_name; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Passenger Mobile :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php echo $row->mobile_no; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Bus Seat :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><b><?php echo $row->seat_id; ?></b></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Passenger Address :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php echo $row->address; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Bus Name :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><b><?php echo $row->bus_name; ?></b></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Bording Point:</span>
                        </div>
                        <div class="col-xs-6">
                            <span> <?php
                                $ldep_time = date("g:i A", strtotime($row->dep_time));
                                echo $row->dep_name . ' ' . $ldep_time
                                ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Total Distance :</span>
                        </div>
                        <div class="col-xs-6">
                            <span>45km</span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Ticket Price :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php echo $row->tkt_price; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Web fee :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php echo $row->web_fee; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Processing fee :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php echo $row->processing_fee; ?> 	</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Discount :</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php echo $row->discount; ?> </span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span></span>
                        </div>
                        <div class="col-xs-6">
                            <span>_________</span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-xs-6 go_right">
                            <span>Total</span>
                        </div>
                        <div class="col-xs-6">
                            <span><?php
                                $total =$row->tkt_price+$row->web_fee+$row->processing_fee-$row->discount; 
                                echo $total
                                ?></span>
                        </div>
                    </div> 
                </div>
                <?php 
                }
                ?>
            </div>
            </div><!-- end printDiv -->
            <div class="col-md-offset-5">
                <button id="to_print" class="btn btn-success" type="button">Print</button>
            </div>
        

</div><!--/container-->


<script type="text/javascript">
//start to Print
document.getElementById("to_print").onclick = function() {
    printElement(document.getElementById("printDiv"),true,"<hr />");
    window.print();
}
function printElement(elem, append, delimiter) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    if (append !== true) {
        $printSection.innerHTML = "";
    }

    else if (append === true) {
        if (typeof(delimiter) === "string") {
            $printSection.innerHTML += delimiter;
        }
        else if (typeof(delimiter) === "object") {
            $printSection.appendChlid(delimiter);
        }
    }

    $printSection.appendChild(domClone);
}

        $('#detailsModal').on('hidden.bs.modal', function (e) {
             var $printSection = document.getElementById("printSection");
             $printSection.innerHTML = '';
	});
      
//End print
</script>
<!--=== End Content ===-->

