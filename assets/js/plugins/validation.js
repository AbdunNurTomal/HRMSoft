var Validation = function () {

    return {
        
        //Validation
        initValidation: function () {
                $("#sky-form12").validate({                   
	            // Rules for form validation
	            rules:
	            {
                        p_name:{required: true},
                        p_mobile:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        p_name:{required: 'Please Enter Your Name'},
                        p_mobile:{required: 'Please Enter Your Mobile Number'},
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
			});
			
			$("#sky-form11").validate({
	            // Rules for form validation
	            rules:
	            {
                        web_fee:{required: true},
                        process_fee:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
					web_fee:{required: 'Please enter web fee'},
					process_fee:{required: 'Please enter process fee'},
				},
				// Do not change code below
	            errorPlacement: function(error, element)
	            {
	                // error.insertAfter(element.parent());
	            }
	        });
			
			$("#sky-form10").validate({
	            // Rules for form validation
	            rules:
	            {
                        coy_no:{required: true},
                        route_id:{required: true},
                        bus_id:{required: true},
                        couch_no:{required: true,number: true},
                        journey_date:{required: true},
                        dept_time:{required: true},
                        arriv_time:{required: true},
                        c_status:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        coy_no:{required: 'Select Company Name'},
                        route_id:{required: 'Select Route'},
                        bus_id:{required: 'Select Bus'},
                        couch_no:{required: 'Enter Couch No'},
                        journey_date:{required: 'Select Journey Date'},
                        dept_time:{required: 'Select Departing Time'},
                        arriv_time:{required: 'Select Arrival Time'},
                        c_status:{required: 'Select Status'},
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
                $("#sky-form9").validate({                   
	            // Rules for form validation
	            rules:
	            {
                        id:{required: true},
                        dr_slno_e:{required: true,digits: true},
                        dr_name_e:{required: true},
                        dr_distance_e:{number: true},
                        dr_fare_e:{required: true,number: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        dr_slno_e:{required: 'Enter SL NO'}, 
                        dr_name_e:{required: 'Enter Dropping Point'}, 
                        dr_distance_e:{required: 'Enter Dropping Distance'}, 
                        dr_fare_e:{required: 'Enter Fare'}, 
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
                $("#sky-form8").validate({                   
	            // Rules for form validation
	            rules:
	            {
                        coy_no:{required: true},
                        route_id:{required: true},
                        dr_slno:{required: true,digits: true},
                        dr_name:{required: true},
                        dr_distance:{number: true},
                        dr_fare:{required: true},
                        c_status:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        coy_no:{required: 'Enter Company Name'}, 
                        route_id:{required: 'Enter Route'}, 
                        dr_slno:{required: 'Enter Dropping Point SL NO'}, 
                        dr_name:{required: 'Enter Dropping Point Name'}, 
                        dr_fare:{required: 'Enter Fare'}, 
                        c_status:{required: 'Select Status'}, 
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
                $("#sky-form7").validate({                   
	            // Rules for form validation
	            rules:
	            {
                        id:{required: true},
                        dep_slno_e:{required: true,digits: true},
                        dep_name_e:{required: true},
                        dep_time_e:{required: true},
                        c_status_e:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        dep_slno_e:{required: 'Enter SL No'}, 
                        dep_name_e:{required: 'Enter Departing Point Name'}, 
                        dep_time_e:{required: 'Enter Departing Time'}, 
                        c_status_e:{required: 'Select Status'}, 
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
                $("#sky-form6").validate({                   
	            // Rules for form validation
	            rules:
	            {
                        coy_no:{required: true},
                        route_id:{required: true},
                        dep_slno:{required: true,digits: true},
                        dep_name:{required: true},
                        dep_time:{required: true},
                        c_status:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        coy_no:{required: 'Enter Company Name'}, 
                        route_id:{required: 'Enter Route Name'}, 
                        dep_slno:{required: 'Enter Sl No'}, 
                        dep_name:{required: 'Enter Departing Point Name'}, 
                        dep_time:{required: 'Enter Departing Time'}, 
                        c_status:{required: 'Select Status'}, 
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
                $("#sky-form5").validate({                   
	            // Rules for form validation
	            rules:
	            {
                        route_no:{required: true},
                        coy_no:{required: true},
                        rate_full_is:{required: true},
                        dept_loc:{required: true},
                        dept_time:{required: true},
                        arriv_loc:{required: true},
                        arriv_time:{required: true},
                        fare:{required: true},
                        c_status:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        route_no:{required: 'Enter Route No'}, 
                        coy_no:{required: 'Select Company'}, 
                        rate_full_is:{required: 'Select Fare Type'},
                        dept_loc:{required: 'Enter Location'},
                        dept_time:{required: 'Enter Departing Time'},
                        arriv_loc:{required: 'Enter Location'},
                        arriv_time:{required: 'Enter Arrival Time'},
                        fare:{required: 'Enter Fare'},
                        c_status:{required: 'Select Status'},
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
                $("#sky-form4").validate({                   
	            // Rules for form validation
	            rules:
	            {
                        first_row_left:{required: true, digits: true, range: [1, 2]},
                        first_row_right:{required: true, digits: true, range: [1, 3]},
                        center_left:{required: true, digits: true, range: [1, 2]},
                        center_right:{required: true, digits: true, range: [1, 3]},
                        center_row:{required: true, digits: true, range: [5, 15]},
                        last_row_center:{digits: true, range: [1, 2]},
                        total_seat:{required: true, digits: true, max: 60},
                        c_status:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        first_row_left:{required: 'Enter Number of First Row Left Seat'},
                        first_row_right:{required: 'Enter Number of First Row Right Seat'},
                        center_left:{required: 'Enter Number of Center Row Left Seat'},
                        center_right:{required: 'Enter Number of Center Row Right Seat'},
                        center_row:{required: "Enter Number of Center Row's"},
                        total_seat:{required: 'Enter Total Seat Number'},
                        c_status:{required: 'Please select Status'},
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
                $("#sky-form3").validate({                   
	            // Rules for form validation
	            rules:
	            {
                        coy_no:{required: true},
                        bus_type:{required: true},
                        bus_serial:{required: true},
                        seat_type:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        coy_no:{required: 'Please select company'},
                        bus_type:{required: 'Please select bus type'},
                        bus_serial:{required: 'Please Enter Bus serial'},
                        seat_type:{required: 'Please select seat type'},
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
                $("#sky-form2").validate({                   
	            // Rules for form validation
	            rules:
	            {
                        c_name:{required: true},
                    },
                    // Messages for form validation
	            messages:
	            {
                        c_name:{required: 'Please enter type'},
                    },
                    // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
	        $("#sky-form1").validate({                   
	            // Rules for form validation
	            rules:
	            {
	                required:{required: true},
	                c_name:{required: true},
	                c_contact:{required: true},
	                c_mail:{email: true},
	                c_res_person:{ required: true },
	                c_setup_date:{ date: true },
	                c_status:{ required: true },
                        //
	                name:
	                {
	                    required: true
	                },
	                address:
	                {
	                    required: true
	                },
	                mobile:
	                {
	                    required: true
	                },
	                gender:
	                {
	                    required: true
	                },
	                age:
	                {
	                    required: true
	                },
	                email:
	                {
	                    required: true,
	                    email: true
	                },
	                myemail:
	                {
	                    email: true
	                },
	                url:
	                {
	                    required: true,
	                    url: true
	                },
	                date:
	                {
	                    required: true,
	                    date: true
	                },
	                min:
	                {
	                    required: true,
	                    minlength: 5
	                },
	                max:
	                {
	                    required: true,
	                    maxlength: 5
	                },
	                range:
	                {
	                    required: true,
	                    rangelength: [5, 10]
	                },
	                digits:
	                {
	                    required: true,
	                    digits: true
	                },
	                p_n_id:
	                {
	                    digits: true
	                },
	                number:
	                {
	                    required: true,
	                    number: true
	                },
	                minVal:
	                {
	                    required: true,
	                    min: 5
	                },
	                maxVal:
	                {
	                    required: true,
	                    max: 100
	                },
	                rangeVal:
	                {
	                    required: true,
	                    range: [5, 100]
	                }
	            },
	                                
	            // Messages for form validation
	            messages:
	            {
	                required:{required: 'Please enter something'},
	                c_name:{required: 'Please enter company name'},
	                c_contact:{required: 'Please enter contact number'},
	                c_res_person:{ required: 'Please enter a responsible person name for the company'},
	                c_status:{required: 'Please select status'},
                        
                        //
	                name:
	                {
	                    required: 'Please enter name'
	                },
	                address:
	                {
	                    required: 'Please enter your address'
	                },
	                mobile:
	                {
	                    required: 'Please enter your mobile number'
	                },
	                gender:
	                {
	                    required: 'Please select your gender'
	                },
	                age:
	                {
	                    required: 'Please select your gender'
	                },
	                email:
	                {
	                    required: 'Please enter your email address'
	                },
	                myemail:
	                {
	                    required: 'Please enter your email address'
	                },
	                url:
	                {
	                    required: 'Please enter your URL'
	                },
	                date:
	                {
	                    required: 'Please enter some date'
	                },
	                min:
	                {
	                    required: 'Please enter some text'
	                },
	                max:
	                {
	                    required: 'Please enter some text'
	                },
	                range:
	                {
	                    required: 'Please enter some text'
	                },
	                digits:
	                {
	                    required: 'Please enter some digits'
	                },
	                p_n_id:
	                {
	                    required: 'Please enter your Passport or National ID No'
	                },
	                number:
	                {
	                    required: 'Please enter some number'
	                },
	                minVal:
	                {
	                    required: 'Please enter some value'
	                },
	                maxVal:
	                {
	                    required: 'Please enter some value'
	                },
	                rangeVal:
	                {
	                    required: 'Please enter some value'
	                }
	            },                  
	            
	            // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
        }

    };
}();