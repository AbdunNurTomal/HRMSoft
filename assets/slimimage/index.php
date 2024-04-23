<html>
    <head><link href="slim/slim.min.css" rel="stylesheet"></head>
    <body>
<!--        
 <form action="post.php" method="post" enctype="multipart/form-data" class="avatar">

    <div class="slim"
         data-label="Drop your avatar here"
         data-size="240,240"
         data-ratio="1:1">
        <input type="file" name="slim[]" required />
    </div>

    <button type="submit">Upload now!</button>

</form>-->
<div style="width:500px; height:400px;">    
<div class="slim"
     data-service="server/async.php"
     data-ratio="16:9"
     data-size="640,640">
    <input type="file" name="slim[]"/>
</div>
        
    </div>    
        <script src="slim/slim.kickstart.min.js"></script>
        <script>
        new Slim(element, {
    ratio: '4:3',
    minSize: {
        width: 640,
        height: 480,
    },
    crop: {
        x: 0,
        y: 0,
        width: 100,
        height: 100
    },
    service: 'upload-async.php',
    download: false,
    willSave: function(data, ready) {
        alert('saving!');
        ready(data);
    },
    label: 'Drop your image here.',
    buttonConfirmLabel: 'Ok',
    meta: {
        userId:'1234'
    }
});</script>
    
    </body>
</html>
