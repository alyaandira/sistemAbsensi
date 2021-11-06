<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "SELECT * FROM `$absensi_table`";
$result = mysqli_query($conn, $SQL_query);


if ($result) {
  $row_count = $result->num_rows;
  $AbsensiList = [];

  if ($row_count > 0) {
    $AbsensiList = $result -> fetch_all(MYSQLI_ASSOC);
  } 
} else {
  $error_message = $conn->error;
  echo ("Error is = " . $error_message);
  echo
    "<script>
        iziToast.error({
            title: 'Error',
            message: 'SQL error',
        });
    </script>";
}
