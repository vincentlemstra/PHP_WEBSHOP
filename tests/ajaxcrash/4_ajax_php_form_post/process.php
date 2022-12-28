<?php

// get db connection
$servername = "localhost";
$username = "root";
$password = "MAMPsetup0191";
$dbName = "vincent_database";

$dsn = 'mysql:host=' . $servername . ';dbname=' . $dbName;
$conn = new PDO($dsn, $username, $password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

echo 'Processing... ';

// check for GET variable
if (isset($_GET['name'])) {
    echo 'GET: your name is ' . $_GET['name'];
}

// check for POST variable
if (isset($_POST['name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    echo 'POST: your name is ' . $_POST['name'];

    $sql = 'INSERT INTO user (name) VALUES ('.$name.')';
    if($mysqli_query($conn, $sql)) {
        echo 'User Added... ';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

