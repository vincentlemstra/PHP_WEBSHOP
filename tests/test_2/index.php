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
        $(document).ready(function() {
            var userCount = 2;
            $("#btn").click(function() {
                userCount += 2;
                $("#users").load("load_users.php", {
                    userNewCount: userCount
                });
            });
        });
    </script>
</head>

<body>

    <div id="users">
        <!-- Show name (autheur) + email (message) -->
        <?php
            $conn = getDatabase();
            $sql = "SELECT name, email FROM user LIMIT 2";
            $data = mysqli_query($conn, $sql);
            if (mysqli_num_rows($data) > 0) {
                while ($user = mysqli_fetch_assoc($data)) {
                    echo "<p>";
                        echo $user['name'];
                        echo '<br>';
                        echo $user['email'];
                    echo "</p>";
                }
            } else {
                echo 'There are no users';
            }
        ?>

    </div>

    <button id="btn">Show more users</button>

</body>

</html>