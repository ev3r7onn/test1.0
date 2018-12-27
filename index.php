<!DOCTYPE html>
<html>
<head>
    <title>Ajax Progress</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

    <!-- Google CDN -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/black-tie/jquery-ui.css"/>

    <!--<script src="js/jquery.ajax-progress.js"></script>-->
    <script>
        var request = {
            checkStatus: function () {
                $.ajax({
                    method: 'GET',
                    url: 'server/status.php',
                    dataType: 'json',
                    success: function (data) {
                        if(data)
                            request.setStatus(data);
                    }
                });
            },
            setStatus: function (status) {
                $('#prog')
                .progressbar('option', 'value', status)
                .children('.ui-progressbar-value')
                .html(status.toPrecision(3) + '%')
                .css('display', 'block');
            },
            _interval: null,
            clearInterval: function () {
                clearInterval(request._interval);
            }

        };

        
        $(function () {
            $('#prog').progressbar({value: 0});

            request._interval = setInterval(request.checkStatus, 1000);

            $.ajax({
                method: 'GET',
                url: 'server/progress.php',
                dataType: 'json',
                success: function () {
                    request.clearInterval();
                    request.setStatus(100);
                    console.log("WoW! Success")
                },
                error: function () {
                    request.setStatus(0);
                    request.clearInterval();
                    console.log('AWWW! Error!!');
                }
            });
        });
    </script>
</head>
<body>
    <div id="prog"></div>
</body>
</html>