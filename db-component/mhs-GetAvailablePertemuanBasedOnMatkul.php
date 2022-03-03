<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $selectedMataKuliah = $_POST["selectedMataKuliah"];
$currentNIP = $_SESSION["currentNIP"];

// $SQL_query =
//   "SELECT * FROM $absensi_table " .
//   "LEFT JOIN $pert_table " .
  // "ON " . $absensi_table . "." . $pert_kode . " = " . "$pert_table" . "." . $pert_kode . " " .
//   "HAVING `$matkul_kode` = '$selectedMataKuliahKode' " .
//   "UNION " .
//   "SELECT * FROM $absensi_table " .
//   "RIGHT JOIN $pert_table " .
//   "ON " . $absensi_table . "." . $pert_kode . " = " . "$pert_table" . "." . $pert_kode . " " .
//   "HAVING `$matkul_kode` = '$selectedMataKuliahKode' ";

// $SQL_query = "SELECT pertemuan.pert_kode, pertemuan.matkul_kode, pertemuan.kelas_id, pertemuan.dosen_nip, pertemuan.waktuMulai, pertemuan.waktuAkhir, pertemuan.batasWaktu, absensi.absensi_id, absensi.mhs_nim, absensi.absensi_status FROM $pert_table " . 
// "LEFT JOIN $absensi_table " . 
// "ON " . $absensi_table . "." . $pert_kode . " = " . "$pert_table" . "." . $pert_kode . " " .
// "HAVING `$matkul_kode` = '$selectedMataKuliahKode' " . 
// "AND (absensi.mhs_nim IS NULL OR absensi.mhs_nim = '$currentNIP') ";

$SQL_query = "SELECT pertemuan.pert_kode, pertemuan.matkul_kode, pertemuan.kelas_id, pertemuan.dosen_nip, pertemuan.waktuMulai, pertemuan.waktuAkhir, pertemuan.batasWaktu, absensi.absensi_id, absensi.mhs_nim, absensi.absensi_status FROM $pert_table " . 
"LEFT JOIN $absensi_table " . 
"ON " . $absensi_table . "." . $pert_kode . " = " . "$pert_table" . "." . $pert_kode . " " .
"AND absensi.mhs_nim = '$currentNIP' " .
"HAVING pertemuan.matkul_kode = '$selectedMataKuliahKode' ";

echo $SQL_query;

$result = mysqli_query($conn, $SQL_query);

// SELECT * FROM pertemuan LEFT JOIN absensi 
// ON absensi.pert_kode = pertemuan.pert_kode HAVING `matkul_kode` = 'ILK1234' 
// AND (absensi.mhs_nim IS NULL OR absensi.mhs_nim = '171401121')

// SELECT * FROM pertemuan LEFT JOIN absensi 
// ON absensi.pert_kode = pertemuan.pert_kode AND absensi.mhs_nim = '171401100'
// HAVING pertemuan.matkul_kode = 'ILK1234'

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
