<?php
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://test213.talentlms.com/api/v1/users/id:1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic NzlkajE2OEt4SXFwZGl6RnFaSnB0TGcyNXozaE5pOg=="
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $userRecord = json_decode($response);

    $talent_lms_auto_login_url = "";
    if ($userRecord) {
        $talent_lms_auto_login_url = $userRecord->login_key;
    }
    // echo "<pre>". print_r($talent_lms_auto_login_url, 1) . "</pre>";exit;

?>

<div class="col-md-10 main-content-div web-clock-div">
    <div class="main-content">
        <div id="talent_lms_result"></div>
    </div>
</div>
		
    </div><!--/row-->
</div><!--/container-->

<script type="text/javascript">
    $(function () {
        var talent_lms_auto_login_url = '<?php echo $talent_lms_auto_login_url; ?>';
        console.log(talent_lms_auto_login_url);

        $('#talent_lms_result').html('<iframe src="' + talent_lms_auto_login_url + '" class="webclock-height" style="width: 100%;"></iframe>');
    });
</script>
