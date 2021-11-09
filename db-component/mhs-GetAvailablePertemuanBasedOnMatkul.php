<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $selectedMataKuliah = $_POST["selectedMataKuliah"];
$currentNIP = $_SESSION["currentNIP"];

$SQL_query =
  "SELECT * FROM $absensi_table " .
  "LEFT JOIN $pert_table " .
  "ON " . $absensi_table . "." . $pert_kode . " = " . "$pert_table" . "." . $pert_kode . " " .
  "HAVING `$matkul_kode` = '$selectedMataKuliahKode' " .
  "UNION " .
  "SELECT * FROM $absensi_table " .
  "RIGHT JOIN $pert_table " .
  "ON " . $absensi_table . "." . $pert_kode . " = " . "$pert_table" . "." . $pert_kode . " " .
  "HAVING `$matkul_kode` = '$selectedMataKuliahKode' ";

// var_dump($SQL_query);
$result = mysqli_query($conn, $SQL_query);

if ($result) {
  $row_count = $result->num_rows;
  $absensiPertemuanList = [];

  if ($row_count > 0) {
    $absensiPertemuanList = $result->fetch_all(MYSQLI_ASSOC);
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
