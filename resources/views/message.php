<html>
<head>
    <title>Ajax Example</title>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>

    <script>
        function storeTask() {
            $.ajax({
                type:'POST',
                url:'/tasks',
                data:{"_token": "<?php echo csrf_token(); ?>",
                        "name":$("#name").val(),
                        "hourly_rate":$("#hourly_rate").val()},
                success:function(data) {
                    $("#msg").html(data.msg);
                }
            });
        }
    </script>
</head>

<body>
<form onsubmit="return false;" action="/tasks" method="POST">
    <input id="name" name="name" type="text">
     <input id="hourly_rate" name="hourly_rate" type="text">
    <button onclick="storeTask();">submit</button>
</form>
</body>

</html>
