<?php
include "././db-component/config.php";
echo "Import check";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  echo("Connection failed: " . $conn->connect_error);
  die("Connection failed: " . $conn->connect_error);
}else{
    echo"Connection established";
}

$SQL_query = "SELECT * FROM `$mhs_table`";
$result = mysqli_query($conn, $SQL_query);


if ($result) {
  $row_count = $result->num_rows;
  $FetchedMahasiswaList = [];

  if ($row_count > 0) {
    $FetchedMahasiswaList = $result -> fetch_all(MYSQLI_ASSOC);
  } 
} else {
  $error_message = $conn->error;
  echo ("Error is = " . $error_message);
}