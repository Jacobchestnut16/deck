<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Network Scanner</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function f() {
            var ipBase = "172.16.183";
            var resultsDiv = $("#scanResults");
            resultsDiv.html("<p>Scanning...</p>");

            // Array to store promises for each AJAX request
            var requests = [];

            // Send AJAX requests for each IP
            for (var i = 1; i <= 255; i++) {
                var ip = ipBase + "." + i;
                var request = $.ajax({
                    url: 'BackEnd/Network.php',
                    type: 'POST',
                    data: { ip: ip },
                    dataType: 'json'
                });

                // Store the promise in the requests array
                requests.push(request);

                // Handle each request as it completes
                request.done(function(data) {
                    document.getElementById(data.ip).className = data.result
                });
            }
            ipBase = "192.168.46"
            for (var i = 1; i <= 255; i++) {
                var ip = ipBase + "." + i;
                var request = $.ajax({
                    url: 'BackEnd/Network.php',
                    type: 'POST',
                    data: { ip: ip },
                    dataType: 'json'
                });

                // Store the promise in the requests array
                requests.push(request);

                // Handle each request as it completes
                request.done(function(data) {
                    document.getElementById(data.ip).className = data.result
                });
            }
        }
        $(document).ready(function() {
            $("#startScan").click(function() {
                var ipBase = "172.16.183";
                var resultsDiv = $("#scanResults");
                resultsDiv.html("<p>Scanning...</p>");

                // Array to store promises for each AJAX request
                var requests = [];

                // Send AJAX requests for each IP
                for (var i = 1; i <= 255; i++) {
                    var ip = ipBase + "." + i;
                    var request = $.ajax({
                        url: 'BackEnd/Network.php',
                        type: 'POST',
                        data: { ip: ip },
                        dataType: 'json'
                    });

                    // Store the promise in the requests array
                    requests.push(request);

                    // Handle each request as it completes
                    request.done(function(data) {
                        document.getElementById(data.ip).className = data.result
                    });
                }
                ipBase = "192.168.46"
                for (var i = 1; i <= 255; i++) {
                    var ip = ipBase + "." + i;
                    var request = $.ajax({
                        url: 'BackEnd/Network.php',
                        type: 'POST',
                        data: { ip: ip },
                        dataType: 'json'
                    });

                    // Store the promise in the requests array
                    requests.push(request);

                    // Handle each request as it completes
                    request.done(function(data) {
                        document.getElementById(data.ip).className = data.result
                    });
                }

                // Wait for all requests to complete
                $.when.apply($, requests).then(function() {
                    resultsDiv.append("<p>Scan complete.</p>");
                });
            });
        });
    </script>
</head>
<body onload="f()">
<table>
    <?php
    $ending = 0;
    for ($i = 1; $i < 15; $i++) {
        echo "<tr>";
        for ($j = 1; $j < 17; $j++) {
            $ending = $ending +1;
            echo "<td>";
            echo "<div id='172.16.183.".$ending."' class='down'>";
            echo "172.16.183.".$ending."</div>";
        }
        echo "</tr>";
    }
    ?>
</table>
<table>
    <?php
    $ending = 0;
    for ($i = 1; $i < 15; $i++) {
        echo "<tr>";
        for ($j = 1; $j < 17; $j++) {
            $ending = $ending +1;
            echo "<td>";
            echo "<div id='192.168.46.".$ending."' class='down'>";
            echo "192.168.46.".$ending."</div>";
        }
        echo "</tr>";
    }
    ?>
</table>

<style>
    .up{
        background-color: rgba(50,150,46,40%);
    }
    .down{
        background-color: rgba(250,100,146,40%);
    }
    table{
        width: 100%;
    }
    tr{
        width: 100%;
    }
    td{
        border: black 1px solid;
    }
</style>
</body>
</html>
