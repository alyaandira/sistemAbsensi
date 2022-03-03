<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $selectedDosenNIP = $_POST["selectedDosenNIP"];

$SQL_query = "SELECT $pert_matkul_kode, `$pert_dosen_nip`, `$pert_kelas_id`, `$pert_waktu_mulai`, `$pert_waktu_akhir`, absensi.absensi_status, absensi.mhs_nim FROM $pert_table " .
  "LEFT JOIN $absensi_table " .
  "ON pertemuan.pert_kode = absensi.pert_kode ";

// echo $SQL_query;

$result = mysqli_query($conn, $SQL_query);

if ($result) {
  $row_count = $result->num_rows;
  $absenTerdaftarList = [];

  if ($row_count > 0) {
    $absenTerdaftarList = $result->fetch_all(MYSQLI_ASSOC);
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
