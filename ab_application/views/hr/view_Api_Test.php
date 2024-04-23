<script src="http://kjur.github.io/jsrsasign/jsrsasign-latest-all-min.js"></script>
<div class="col-md-10 main-content-div">
    <div class="main-content">
        
        <div class="container conbre">
            <ol class="breadcrumb">
                <li><?php echo $this->Common_model->get_header_module_name($this,$module_id); ?></li>
                <li class="active"><?php echo $page_header; ?></li>
            </ol>
        </div>
        
        <div class="container tag-box tag-box-v3" style="margin-top: 0px; width: 96%; padding-bottom: 15px;"> <!-- container well div -->
<!--           <form id="sky-form11" name="sky-form11" class="form-horizontal" method="post" action="" enctype="multipart/form-data" role="form">
                    <input type="hidden" value="" name="id" id="id"/>
                    <div class="col-sm-6">
                        <div class="form-group margin-top-20">
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                    <div class="col-sm-12">
                        <div class="modal-footer">
                            <div class="col-sm-6">
                              <button type="submit" id="submit" class="btn btn-u"> Submit </button>
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>
                    </div>
                </form> -->

                <p class="u-full-width center">
                   <button class="button button-primary" onClick="getJWTcall()">Show Web Clock</button>
                </p>
                
                <div id="embedcontainer" class="container center" style="display: none"><div class="cssload-box-loading"></div></div>
                
        </div><!-- end container well div -->
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->


<script type="text/javascript">
    
    function getJWTcall() {
        
        var token = {
            iss: parseInt('1086'),
            product: "twpclient",
            sub: "client",
            exp: Math.floor(Date.now() / 1000) + 60 * 5,
            siteInfo: {
              type: "id",
              id: '33172'
            }
        }

        var header = {alg: "HS256", typ: "JWT"}
        var JWT = KJUR.jws.JWS.sign("HS256", JSON.stringify(header), JSON.stringify(token), 'oiUY744EbYEWnHSGRZw5pVdjIYkJPQMoFKOqighfkuuEByn7PWbKKRC85ynsgfKl')
        //alert (JWT);
        
        var data = {
            "EmployeeCode": "80000014",
            "FirstName": "API_Monotosh_001",
            "LastName": "Roy",
            "Designation": "DE001",
            "Phone": "01730082104",
            "Email": "MONOTOSH.ROY@GMAIL.COM",
          }
    
        $.ajax({
            url: "https://twpapi.payrollservers.us/api/33172/Employees",
            //https://twpapi.payrollservers.us/api/33172/employees
            //url: "https://twpapi.payrollservers.us/swagger/ui/index#!/Employees/CreateEmployee",
            headers: {
               "Authorization":'Bearer ${jwt}',
               "Content-Type": "application/json"
            },
            type: 'POST',
            data: JSON.stringify(data),
            success: function(data) {
                alert (data);
                // Decode and show the returned data nicely.
            },
            error: function() {
                alert('error');
            }
        });
    
    }
    
    function getJWT() {
        
      var token = {
        iss: parseInt('1086'),
        product: "twpclient",
        sub: "client",
        exp: Math.floor(Date.now() / 1000) + 60 * 5,
        siteInfo: {
          type: "id",
          id: '33172'
        }
      }

      var header = {alg: "HS256", typ: "JWT"}
      
      var JWT = KJUR.jws.JWS.sign("HS256", JSON.stringify(header), JSON.stringify(token), 'oiUY744EbYEWnHSGRZw5pVdjIYkJPQMoFKOqighfkuuEByn7PWbKKRC85ynsgfKl')

      //console.log(`Calling Authentication Service with ${JWT}`)
      
    var data = {
        "EmployeeCode": "80000014",
        "FirstName": "API_Monotosh_001",
        "LastName": "Roy",
        "Designation": "DE001",
        "Phone": "01730082104",
        "Email": "MONOTOSH.ROY@GMAIL.COM",
      }
      
//      var data = {
//            "EmployeeCode": "454545",
//            "FirstName": "TEST_API_Employee",
//            "MiddleName": "TEST_API_Employee",
//            "LastName": "TEST_API_Employee",
//            "Designation": "TEST_API",
//            "Phone": "01739622655",
//            "Email": "sohelbijay@yahoo.com"
//          }
          
      $.ajax({
        url: "${CONFIG.https://twpapi.payrollservers.us/api}/${CONFIG.68113}/employees",
        //url: "https://twpapi.payrollservers.us/swagger/ui/index#!/Employees/CreateEmployee",
        method: "POST",
        port: 443,
        data: JSON.stringify(data),
        headers: {
          "Authorization":'Bearer ${jwt}',
          "Content-Type": "application/json"
        },
        success: (result, status) => {
            
            alert (result);
            alert (status);
            
//          if (result && result.token) {
//            callback(null, result.token)
//          } else {
//            callback(`Status: ${status} Result: ${JSON.stringify(result)}`, null)
//          }
        },
        error: (o, err) => {
            alert (err);
          //callback(`Failed to obtain JWT: ${err}`)
        }
      })
      
      
    }

    function showControl(control){
      $("#embedcontainer").fadeIn(800)
      getJWT((err, jwt) => {
        if (err) {
          console.log(`Fail: ${err}`)
        } else {
          let dataObj = '<object style="width: 100%; height: 500px;" data="https://clock.payrollservers.us/?enclosed=1&compact=1&showess=1&jwt=${jwt}"/>'
          console.log(`Loading ${dataObj}`)
          $("#embedcontainer").html(dataObj)
        }
      })
    }
    
    function CreateEmployee(employee){
        return new Promise((resolve, reject) => {
        if (!JWT) return reject("JWT is not set")

            // Some config is site-specific. In order to POST with the correct data, first obtain the schema from /api/{siteId}/employees/schema

            let options = {
                uri: `${CONFIG.twpApiURL}/${CONFIG.siteId}/employees`,
                port: 443,
                method: "POST",
                headers: {
                "Authorization": `Bearer ${JWT}`,
                "Content-Type": "application/json"
                },
                body: employee,
                json: true
                }

                request.post(options, (err, req, body) => {
                if (err) return reject(`Error creating employee: ${err}`)
                if (req.statusCode != 201) return reject(`CreateEmployee: bad request.`)
                return resolve()
            })
        })
    }


    $(function(){
        $( "#sky-form11" ).submit(function( event ) {
            var data = {
                "EmployeeCode": "454545",
                "FirstName": "TEST_API_Employee",
                "MiddleName": "TEST_API_Employee",
                "LastName": "TEST_API_Employee",
                "Designation": "TEST_API",
                "Phone": "01739622655",
                "Email": "sohelbijay@yahoo.com"
              }

            $.ajax({
                type: "POST",
                data: JSON.stringify(data),
                url: "https://twpapi.payrollservers.us/api/68113/",
                contentType: "application/json"
            }).done(function(res) {  
                
                alert (res);    
                //console.log('res', res);
                // Do something with the result :)
            });
        });
    });
    




</script>
<!--=== End Content ===-->


