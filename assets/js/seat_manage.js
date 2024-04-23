/* javascript codes for seat_manage */
    var seats = [];
    var booking_seats = [];
    var i = 0;
    var allid = [];
  
function add_del_seat(seat_id,price,lr_id){ 
// alert(booking_seats);
aa = seats.indexOf(seat_id);//find product in array
bb = booking_seats.indexOf(seat_id);//find product in array
ss = allid.indexOf(lr_id);//find product in array
my_seat_id=seats[aa];
dell_id=seats[aa+1];

    if(aa===-1 || aa === undefined){
            var t1Val = (document.getElementById("a_total"));
            var t1 = parseInt(t1Val.innerHTML)+parseInt(price);
            var t2Val = (document.getElementById("s_total"));
            var t2 = parseInt(t2Val.innerHTML)+1;
    //        var t3Val = (document.getElementById("c_fee"));
    //        var t3 = parseInt(t3Val.innerHTML);
            var t3 =0;
        if(t2<=4 || t2===undefined){
            $(".seat_tab").append("<span id='catX"+i+"'><div class='c_tab_td'>"+seat_id+"</div><div class='c_tab_td'>"+price+" &#x9f3;</div></span>");
            $("#a_total").html(t1);
            $("#s_total").html(t2);
            $("#total").html(String(t3+t1).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
            seats.push(seat_id,i);
            allid.push(lr_id);
            booking_seats.push(seat_id);
            document.getElementById("seat_book").value = booking_seats;
            document.getElementById("seat_id").value = allid;
//            $('#'+seat_id).addClass(' seat_borrado');
            $('#'+lr_id).addClass(' seat_select');
            i++;
        }else{
           alert('Maxium of 4 seats can be booked at a time.'); 
        }
        
    }else{
//        alert('removed');
        $("#catX"+dell_id).remove();
        seats.splice(aa,2);//delete from array
        allid.splice(ss,1);//delete from array
        booking_seats.splice(bb,1);//delete from array
        var t1Val = (document.getElementById("a_total"));
        var t1 = parseInt(t1Val.innerHTML)-parseInt(price);
        $("#a_total").html(t1);
        var t2Val = (document.getElementById("s_total"));
        var t2 = parseInt(t2Val.innerHTML)-1;
        $("#s_total").html(t2);
//        var t3Val = (document.getElementById("c_fee"));
//        var t3 = parseInt(t3Val.innerHTML);
            var t3 =0;
        $("#total").html(String(t3+t1).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
        document.getElementById("seat_book").value = booking_seats;
        document.getElementById("seat_id").value = allid;
        $('#'+lr_id).removeClass('seat_select');
    }
//    document.getElementById("elements").value=booking_seats;
        
}