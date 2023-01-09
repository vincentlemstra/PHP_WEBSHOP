<?php
    include 'dbh.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My test page</title>
    <link href="styles/style.css" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"
        integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            
            // GET:
            // $("#btn").click(function() {
            //     $.get("text.txt", function(data, status) {
            //         $("#test").html(data);
            //         // alert(status);
            //     });
            // });


            // POST:
            $("input").keyup(function() { 
                var name = $("input").val();
                $.post("suggestions.php", {
                    suggestion: name
                }, function(data, status) {
                    $("#test").html(data);
                });
            });
        });
    </script>
</head>

<body>

    
    <!-- GET: -->
    <!-- <button id="btn">Click me to get data</button>
    <p id="test"></p> -->
    
    <!-- POST: -->
    <input type="text" name="name">
    <p id="test"></p>
    

</body>

</html>