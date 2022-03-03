<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $selectedDosenNIP = $_POST["selectedDosenNIP"];

$SQL_query = "SELECT * FROM $pert_table " .
  "LEFT JOIN $matkul_table " .
  "ON pertemuan.matkul_kode = mata_kuliah.matkul_kode " . 
  "LEFT JOIN $ruangkelas_table " .
  "ON pertemuan.kelas_id = ruang_kelas.kelas_id " . 
  "LEFT JOIN $dosen_table " .
  "ON pertemuan.dosen_NIP = dosen.dosen_NIP " . 
  "LEFT JOIN $absensi_table " .
  "ON pertemuan.pert_kode = absensi.pert_kode ";

// echo $SQL_query;

// SELECT * FROM pertemuan LEFT JOIN mata_kuliah ON pertemuan.matkul_kode = mata_kuliah.matkul_kode LEFT JOIN ruang_kelas 
// ON pertemuan.kelas_id = ruang_kelas.kelas_id LEFT JOIN dosen ON pertemuan.dosen_NIP = dosen.dosen_NIP LEFT JOIN absensi 
// ON pertemuan.pert_kode = absensi.pert_kode


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
