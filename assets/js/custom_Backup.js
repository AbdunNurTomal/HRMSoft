/* Write here your custom javascript codes */

//var operation_success_msg=new Array ();
//operation_success_msg[0]="Record is saved successful.";
//operation_success_msg[1]="Record is updated successful.";	
//operation_success_msg[2]="Your Application is record successful. Please waiting for approval/review."; 


$(document).ready(function () {
    $('ul.nav.navbar-nav').slicknav();

    /* JS for Common select2  */
    $(".common_select2").select2({
        placeholder: "Select Option",
        allowClear: true
    });
});


function isNumber(n)
{
    return /^-?[\d.]+(?:e-?\d+)?$/.test(n);
}


function isInt(value) {

    var er = /^-?[0-9]+$/;

    return er.test(value);
}

function numbersonly(myfield, e, dec)
{
    var key;
    var keychar;

    if (window.event)
        key = window.event.keyCode;
    else if (e)
        key = e.which;
    else
        return true;
    keychar = String.fromCharCode(key);

    // control keys
    if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27))
        return true;

    // numbers
    else if ((("0123456789.").indexOf(keychar) > -1))
        return true;
    else
        return false;
}

function reload_table()
{
    table.ajax.reload(null, false); //reload datatable ajax 
}


function load_drop_down(id, url, div, placeholder) {
    //alert (id);
    $.ajax({
        url: url + id,
        data: id,
        type: 'POST'
    }).done(function (data) {
        $('#' + div).html('');
        $('#' + div).empty();

        $('#' + div).select2({
            placeholder: placeholder,
            allowClear: true,
        });

        $('#' + div).html(data);

    });
    //event.preventDefault();

}

function view_message(data, url, modal_id, form_id) {

    if (data)
    {
        var datas = data.split('##');
        if (datas[1] == 1)//Successful==1
        {
            //alert (url);
//            $("#messagebox").fadeTo(200, 0.1, function () {
//                $(this).html(datas[0]).fadeTo(900, 1);
//                $('html, body').animate({scrollTop: 0}, 800);
//                $(this).fadeOut(4000);
//            });
            
            //swal("Good job!", datas[0], "success");
            
            swal("Good job!", datas[0], "success")
            .then((value) => {
                
                if (modal_id != '')
                {
                    $('#' + modal_id).modal('hide');
                    if (url != '')
                    {
                        window.location.href = url;
                    }
                    
                }
                else
                {
                    if (url != '')
                    {
                        window.location.href = url;
                    }
                    else
                    {
                        location.reload();
                    }
                }
                $('#messagebox').empty();
                $('html, body').animate({scrollTop: 0}, 800);
            });

//            if (url != '')
//            {
//                setTimeout(function () {
//                    window.location.href = url;
//                }, 4000);
//            }

//            if (modal_id != '')
//            {
//                $('#' + modal_id).modal('hide');
//            }

            if (form_id != '')
            {
                $('#' + form_id)[0].reset();
            }


        } else//Not Successful ==2
        {
//            $("#messagebox").fadeTo(200, 0.1, function () {
//                $(this).html(datas[0]).fadeTo(900, 1);
//                $('html, body').animate({scrollTop: 0}, 800);
//                //$(this).fadeOut(5000);
//            });

//            swal(datas[0], {
//                icon: "warning",
//                dangerMode: true,
//            });
            
            swal("Warning!", datas[0], "warning")
            .then((value) => {
                $('#messagebox').empty();
                $('html, body').animate({scrollTop: 0}, 800);
            });
        }
    } else
    {
        $("#messagebox").fadeTo(200, 0.1, function () {
            $(this).html('No Message Found').fadeTo(900, 1);
            $('html, body').animate({scrollTop: 0}, 800);
            //$(this).fadeOut(5000);
        });
    }
}


function view_message_backup(data, url, modal_id, form_id) {

    if (data)
    {
        var datas = data.split('##');
        if (datas[1] == 1)//Successful==1
        {
            $("#messagebox").fadeTo(100, 0.1, function () {
                $(this).html(datas[0]).fadeTo(400, 1);
                $('html, body').animate({scrollTop: 0}, 400);
                $(this).fadeOut(1000);
            });

            if (url != '')
            {
                setTimeout(function () {
                    window.location.href = url;
                }, 1000);
            }

            if (modal_id != '')
            {
                $('#' + modal_id).modal('hide');
            }

            if (form_id != '')
            {
                //alert (form_id);
                $('#' + form_id)[0].reset();
            }


        } else//Not Successful ==2
        {
            $("#messagebox").fadeTo(100, 0.1, function () {
                $(this).html(datas[0]).fadeTo(400, 1);
                $('html, body').animate({scrollTop: 0}, 400);
                //$(this).fadeOut(5000);
            });
        }
    } else
    {
        $("#messagebox").fadeTo(100, 0.1, function () {
            $(this).html('No Message Found').fadeTo(400, 1);
            $('html, body').animate({scrollTop: 0}, 400);
            //$(this).fadeOut(5000);
        });
    }
}

function loading_box(base_url) {

    if (base_url != "")
    {
        $('html, body').animate({scrollTop: 0}, 800);
        $('#messagebox').html('<img src="' + base_url + 'assets/img/loader.gif" />');
    }
    else
    {
       $('html, body').animate({scrollTop: 0}, 800);
       $('#messagebox').html(''); 
    }

}

function progress_bar() {
    
    $('#messagebox').html(' <div class="progress progress-striped active">\n\
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%">\n\
        <span class="sr-only">55% Complete (success)</span>\n\
        </div>\n\
    </div>');
    
}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length >= 2)
        return parts.pop().split(";").shift();
}

function check_date_of_birth(field_id) {
    $('#' + field_id).change(function () {
        var dob = $('#' + field_id).val();

        var dob_split = dob.split('-');
        var dob_date = dob_split[0] + '-' + dob_split[1] + '-' + dob_split[2];
        var pday = new Date();
        var bday = new Date(dob_date);
        var ydiff = pday.getFullYear() - bday.getFullYear();
        var mdiff = pday.getMonth() - bday.getMonth();
        if (mdiff < 0) {
            mdiff += 12;
            ydiff--;
        }
        var get_age = $('#lblAge').html('About ' + ydiff + ' years ' + mdiff + ' months');
        $('#hidden_age').val(ydiff);
        if (ydiff * 1 < 18) {
            document.getElementById('lblAge').style.backgroundColor = "red";
        } else
            document.getElementById('lblAge').style.backgroundColor = "";
    });
}

function show_date_formate_js(date_field) {
    //2016-11-29
    //01-03-2017

    if (date_field != '') {
        var dates = date_field.split("-");
        return dates[1] + "-" + dates[2] + "-" + dates[0];
    } else
    {
        return date_field;
    }

}

function add_days(n) {
    n = n + 1;
    var t = new Date();
    t.setDate(t.getDate() + n);
    var date = ((t.getDate() < 10) ? '0' + t.getDate() : t.getDate()) + "-" + (((t.getMonth() + 1) < 10) ? '0' + (t.getMonth() + 1) : (t.getMonth() + 1)) + "-" + t.getFullYear();
    //alert(date);

    //16-03-2017

    if (date != '') {
        var dates = date.split("-");
        return dates[1] + "-" + dates[0] + "-" + dates[2];
    } else
    {
        return date;
    }

    //return (date);
    //var twoDigitMonth = ((to_datea.getMonth().length+1) === 1)? (to_datea.getMonth()+1) : '0' + (to_datea.getMonth()+1);

}

$('input[type=text], textarea').blur(function () {
    if ($(this).attr('id') != 'login-name')
    {
        var string = $(this).val();
        $(this).val(string.charAt(0).toUpperCase() + string.slice(1));
    }
});



