<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$currentNIP = $_SESSION["currentNIP"];

$SQL_query = "SELECT dosen.dosen_nip, dosen.dosen_nama FROM $pert_table " .
  "LEFT JOIN $dosen_table " .
  "ON pertemuan.dosen_nip = dosen.dosen_nip " .
  "HAVING `$pert_dosen_nip` = $currentNIP ";

  // var_dump($SQL_query);
$result = mysqli_query($conn, $SQL_query);

if ($result) {
  $row_count = $result->num_rows;
  $dosenPertemuanList = [];

  if ($row_count > 0) {
    $dosenPertemuanList = $result->fetch_all(MYSQLI_ASSOC);
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
