<?php
    include 'dbh.php';
    $conn = getDatabase();

    $userNewCount = $_POST['userNewCount'];

    $sql = "SELECT name, email FROM user LIMIT $userNewCount";
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