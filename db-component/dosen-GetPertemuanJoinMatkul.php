<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $selectedDosenNIP = $_POST["selectedDosenNIP"];
$currentNIP = $_SESSION["currentNIP"];

$SQL_query = "SELECT * FROM $pert_table " .
  "LEFT JOIN $matkul_table " .
  "ON pertemuan.matkul_kode = mata_kuliah.matkul_kode " .
  "LEFT JOIN $ruangkelas_table " .
  "ON pertemuan.kelas_id = ruang_kelas.kelas_id " .
  "HAVING `$pert_dosen_nip` = $currentNIP ";

$result = mysqli_query($conn, $SQL_query);

if ($result) {
  $row_count = $result->num_rows;
  $pertemuanList = [];

  if ($row_count > 0) {
    $pertemuanList = $result->fetch_all(MYSQLI_ASSOC);
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
