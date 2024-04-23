        <div class="row main-body">
            <div class="col-md-12 main-content-div">
                <div class="main-content">
                    <div id="result"></div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(function () {
                var api_login_id = '<?php echo $api_login_id; ?>';
                var swipe_clock_id = '<?php echo $swipe_clock_id; ?>';

                var loginAs = "";
                var loginNameOrWebClockId = "";
                if (api_login_id) {
                    loginNameOrWebClockId = api_login_id;
                    loginAs = "supervisor";
                } else if (swipe_clock_id) {
                    loginNameOrWebClockId = swipe_clock_id;
                    loginAs = "employee";
                }
                // console.log("clint_site_id=>"+clint_site_id+"; api_login_id=>"+api_login_id+"; swipe_clock_id=>"+swipe_clock_id+"; clint_api_secret=>"+clint_api_secret+"; loginAs =>"+loginAs);

                //$('#btnSso').click(function () {
                    getJWT(clint_accountant, clint_site_id, loginNameOrWebClockId, clint_api_secret, loginAs, function (err, jwt) {
                        if (err) {
                            // console.log('Fail: ' + err);
                            $('#result').html('Fail: ' + err);
                            $('#result').html('Fail: ' + err);
                        } else {
                            // console.log("JWT authenticated received");
                            // JWT authenticated received.
                            // Access ESS via a new browser tab
                            var webClockUrl = 'https://payrollservers.us/pg/login.aspx?jwt=' + jwt;
                            // var webClockUrl = 'https://clock.payrollservers.us/?enclosed=1&compact=1&showess=1&jwt=' + jwt;

                            if (loginAs == "employee") {
                                webClockUrl = 'https://payrollservers.us/pg/ess?jwt=' + jwt;
                            }
                            $('#result').html('<iframe src="' + webClockUrl + '" style="height: 900px; width: 100%;"></iframe>');

                            // window.open(webClockUrl);
                        }
                    });
                //});
            });

            function getJWT(partnerID, siteID, login, apiSecret, loginAs, callback) {
                var header = { alg: "HS256", typ: "JWT" };
                var swipe_clock_id = 4052;
                // body/payload token being created is based on using a client api secret
                var token = {};
                if (loginAs == "supervisor") {
                    token = {
                        iss: siteID,
                        product: "twplogin",
                        sub: "client",
                        exp: Math.floor(Date.now() / 1000) + 60 * 5,
                        siteInfo: {
                            type: "id",
                            id: siteID
                        },
                        user: {
                            type: "login",
                            id: login
                        }
                    }
                } else if (loginAs == "employee") {
                    token = {
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
                            id: login
                        }
                    }
                } else {
                    var alertMsgHtml = '<br/><br/><div class="row"><div class="col-sm-2"></div><div class="col-sm-8">';
                    alertMsgHtml += '<div class="alert alert-danger text-center" role="alert">Your SwipeClock is not configured. Please contact administrator.</div>';
                    alertMsgHtml += '</div></div>';

                    $('#result').html(alertMsgHtml);
                }

                if (loginAs) {
                    var jwt = KJUR.jws.JWS.sign("HS256", JSON.stringify(header), JSON.stringify(token), apiSecret);

                    // console.log('Calling Authentication Service with ' + jwt);

                    $.ajax({
                        url: "https://clock.payrollservers.us/AuthenticationService/oauth2/userToken",
                        method: "POST",
                        headers: {
                            "Authorization": 'Bearer ' + jwt,
                            "Content-Type": "application/json"
                        },
                        success: function(result, status) {
                            if (result && result.token) {
                                // we received an access token!
                                callback(null, result.token);
                            } else {
                                // An access token was not issued
                                callback('Status: ' + status + ', Result: ' + JSON.stringify(result), null);
                            }
                        },
                        error: function(o, err) {
                            // An error occurred calling the token endpoint
                            console.log(o);
                            // console.log(err);
                            var responseHtml = '<br/><br/><div class="row"><div class="col-sm-2"></div><div class="col-sm-8">';
                            responseHtml += '<div class="alert alert-danger text-center" role="alert">SwipeClock API Login ID / SwipeClock ID is miss match. <br/>Please update API Login ID in SETUP > User Management > Setup Master User page. <br/>OR <br/>Swipeclock ID in HR > Employee Management > Employee List > Edit Employee.</div>';
                            responseHtml += '</div></div>';
                            $('#result').html(responseHtml);
                        }
                    })
                }
            }
        </script>

    </div><!--/end row-->
</div><!--/end container-->
