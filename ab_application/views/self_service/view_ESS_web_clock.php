
<div class="col-md-10 main-content-div web-clock-div">
    <div class="main-content">
        <div id="result"></div>
       
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->

<script type="text/javascript">
    $(function () {
        var swipe_clock_id = '<?php echo $swipe_clock_id; ?>';
        // console.log(swipe_clock_id);
        // console.log("clint_accountant=>"+clint_accountant+"; clint_site_id=>"+clint_site_id+"; employee_id=>"+employee_id+"; clint_api_secret=>"+clint_api_secret);

        // Invoked when the document is ready
        getJWT(clint_accountant, clint_site_id, swipe_clock_id, clint_api_secret, function(err, jwt) {
            if (err) {
                //alert (err);
                console.log('Fail: ' + err);
                $('#result').html('Fail: ' + err);
            } else {
                // JWT authenticated received.
                // Host SwipeClock as an embedded iframe
                let webClockUrl = 'https://clock.payrollservers.us/?enclosed=1&compact=1&showess=1&jwt=' + jwt;
                // let webClockUrl = 'https://payrollservers.us/pg/Ess/Home.aspx';
                // let webClockUrl = 'https://payrollservers.us/pg/ess?jwt=' + jwt;
                $('#result').html('<iframe src="' + webClockUrl + '" class="webclock-height" style="width: 100%;"></iframe>');
                $('#processingText').text('Please use the web clock below');
            }
        });
    });

    function getJWT(partnerID, siteID, empcode, apiSecret, callback) {
        // console.log(empcode);
        let header = {alg: "HS256", typ: "JWT"};
        let token = {
            iss: siteID,
            product: "twpemp",
            sub: "client",
            exp: Math.floor(Date.now() / 1000) + 60 * 5,
            siteInfo: {
                type: "id",
                id: siteID
            },
            user: {
                type: "empcode",
                id: empcode
            }
        }

        let jwt = KJUR.jws.JWS.sign("HS256", JSON.stringify(header), JSON.stringify(token), apiSecret);
        // console.log('Calling Authentication Service with jwt: ' + jwt);

        $.ajax({
            url: "https://clock.payrollservers.us/AuthenticationService/oauth2/userToken",
            method: "POST",
            headers: {
                "Authorization": 'Bearer ' + jwt,
                "Content-Type": "application/json"
            },
            success: (result, status) => {
                if (result && result.token) {
                    // we received an access token!
                    callback(null, result.token);
                } else {
                    // An access token was not issued
                    callback('Status: ' + status + ', Result: ' + JSON.stringify(result), null);
                }
            },
            error: (o, err) => {
                // An error occurred calling the token endpoint
                //alert (err.statusText);
                //callback('Status: ' + status + ', Result: ' + JSON.stringify(result), null);
                console.log(o);
                $('#result').html('<h3 style="color: red;"> Unauthorized Employee ID for Swipe Clock. See the console log for error details.</h3>')
            }
        })
    }
</script>
