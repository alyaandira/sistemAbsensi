<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// 
// 
$NIM = $_SESSION["currentNIP"];

$SQL_query = "SELECT `$pert_kode`, `$matkul_kode`, `$kelas_id`, `$dosen_nip`, `$waktuMulai`, `$waktuAkhir`, `$batasWaktu` FROM $pertemuan_table WHERE ".
"$matkul_kode = '$matkulKodePost'";

$result = mysqli_query($conn, $SQL_query);



if ($result) {
  $row_count = $result->num_rows;
  $pertemuanList = [];

  if ($row_count > 0) {
    $pertemuanList = $result -> fetch_all(MYSQLI_ASSOC);
    // array_push($RegisteredClassList, $result -> fetch_all(MYSQLI_ASSOC));
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
