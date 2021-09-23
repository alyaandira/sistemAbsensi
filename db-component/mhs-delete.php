<?php
include "././db-component/config.php";
$input_mahasiswa_nim= $_POST["MahasiswaModal_NIM"];
$input_mahasiswa_nama = $_POST["MahasiswaModal_Nama"];
$input_mahasiswa_pass= $_POST["MahasiswaModal_Password"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "DELETE FROM `$mhs_table` WHERE `$mhs_nim`='$input_mahasiswa_nim'";

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
  echo
    "<script>
        iziToast.error({
            title: 'Error',
            message: 'SQL error',
        });
    </script>";
}
