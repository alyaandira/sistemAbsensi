<?php
include "././db-component/config.php";
$input_dosen_nip= $_POST["DosenModal_NIP"];
$input_dosen_nama = $_POST["DosenModal_Nama"];
$input_dosen_pass= $_POST["DosenModal_Password"];


// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "INSERT INTO `$dosen_table`(`$dosen_nip`, `$dosen_nama`, `$dosen_password`) VALUES ('$input_dosen_nip','$input_dosen_nama','$input_dosen_pass')";

$result = mysqli_query($conn, $SQL_query);


if ($result) {
  $row_count = $result->num_rows;
  $FetchedDosenList = [];

  if ($row_count > 0) {
    $FetchedDosenList = $result -> fetch_all(MYSQLI_ASSOC);
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
