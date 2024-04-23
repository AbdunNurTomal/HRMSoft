var Datepicker = function () {

    return {
        //Datepickers
        initDatepicker: function () {
            
             //alert ('hhhh');
             
            //date
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
//            today = dd+'-'+mm+'-'+yyyy;//current date
            today = yyyy + '-' + mm + '-' + dd;//current date

            var r_date = new Date();
            r_date.setDate(r_date.getDate() + 14);
            var r_dd = r_date.getDate();
            var r_mm = r_date.getMonth() + 1; //January is 0!
            var r_yyyy = r_date.getFullYear();
            if (r_dd < 10) {
                r_dd = '0' + r_dd
            }
            if (r_mm < 10) {
                r_mm = '0' + r_mm
            }
//            r_date = r_dd+'-'+r_mm+'-'+r_yyyy;//Return date
            r_date = r_yyyy + '-' + r_mm + '-' + r_dd;//Return date

            // Regular datepicker
//	        $('#date').datepicker({
//	            dateFormat: 'dd.mm.yy',
//	            prevText: '<i class="fa fa-angle-left"></i>',
//	            nextText: '<i class="fa fa-angle-right"></i>'
//	        });

//            $('.dt_pick').datepicker({
//                dateFormat: 'mm-dd-yy', //js date format
//                todayHighlight: true,
//                changeMonth: true,
//                changeYear: true,
//                prevText: '<i class="fa fa-angle-left"></i>',
//                nextText: '<i class="fa fa-angle-right"></i>'
//            });

            //$.fn.modal.Constructor.prototype.enforceFocus = function () {};

           
//            $('#birthdate').datepicker({
//                dateFormat: 'mm-dd-yy', //js date format
//                todayHighlight: true,
//                changeMonth: true,
//                changeYear: true,
//                yearRange: '1920:2007',
//                prevText: '<i class="fa fa-angle-left"></i>',
//                nextText: '<i class="fa fa-angle-right"></i>'
//            });
            
//            $('#onboarding_dateofbirth').datepicker({
//                dateFormat: 'mm-dd-yy', //js date format
//                todayHighlight: true,
//                changeMonth: true,
//                changeYear: true,
//                yearRange: '1920:2007',
//                prevText: '<i class="fa fa-angle-left"></i>',
//                nextText: '<i class="fa fa-angle-right"></i>'
//            });
            
    
//	        $('#opening_date').datepicker({
//	            dateFormat: 'yy-mm-dd',//js date format
//	            prevText: '<i class="fa fa-angle-left"></i>',
//	            nextText: '<i class="fa fa-angle-right"></i>',
//                    
//	        });

//	        $('#issued_date').datepicker({
//	            dateFormat: 'yy-mm-dd',//js date format
//	            prevText: '<i class="fa fa-angle-left"></i>',
//	            nextText: '<i class="fa fa-angle-right"></i>',
//                    
//	        });

//                 $('#retuned_date').datepicker({
//	            dateFormat: 'yy-mm-dd',//js date format
//	            prevText: '<i class="fa fa-angle-left"></i>',
//	            nextText: '<i class="fa fa-angle-right"></i>',
//                    
//	        });

            // Date range
            $('#start').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
                onSelect: function (selectedDate)
                {
                    $('#finish').datepicker('option', 'minDate', selectedDate);
                }
            });
            $('#finish').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
                onSelect: function (selectedDate)
                {
                    $('#start').datepicker('option', 'maxDate', selectedDate);
                }
            });
            // Date range2

            $(document).ready(function () {
                $('#start2').datepicker('option', 'minDate', today);
                $('#start2').datepicker('option', 'maxDate', r_date);
                $('#finish2').datepicker('option', 'minDate', today);
                $('#finish2').datepicker('option', 'maxDate', r_date);
            });

            $('#start2').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
                onSelect: function (selectedDate)
                {
                    $('#finish2').datepicker('option', 'minDate', selectedDate);
                }
            });

            $('#finish2').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
                onSelect: function (selectedDate)
                {
                    $('#start2').datepicker('option', 'maxDate', selectedDate);
                }
            });
            
           //alert ('hhh');
            
            // Inline datepicker
            $('#inline').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>'
            });


            // Inline date range
            $('#inline-start').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
                onSelect: function (selectedDate)
                {
                    $('#inline-finish').datepicker('option', 'minDate', selectedDate);
                }
            });
            $('#inline-finish').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
                onSelect: function (selectedDate)
                {
                    $('#inline-start').datepicker('option', 'maxDate', selectedDate);
                }
            });
        }

    };
}();

