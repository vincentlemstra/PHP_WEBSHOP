<?php
function getDatabase() {
  $servername = "localhost";
  $username = "root";
  $password = "MAMPsetup0191";
  $dbName = "vincent_database";
  
  // create connection
  $conn = mysqli_connect($servername, $username, $password, $dbName);
  
  // check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } else {
    return $conn;
  }
}
