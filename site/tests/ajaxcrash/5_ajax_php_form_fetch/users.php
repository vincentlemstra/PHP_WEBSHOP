<?php

// get db connection
$servername = "localhost";
$username = "root";
$password = "MAMPsetup0191";
$dbName = "vincent_database";

$dsn = 'mysql:host=' . $servername . ';dbname=' . $dbName;
$conn = new PDO($dsn, $username, $password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// query
$sql = 'SELECT * FROM user';

// get result
$result = mysqli_query($conn, $query);

// fetch data
$users = mysqli_fetch(); // ....

// ! json_encode !
echo json_encode($users);



