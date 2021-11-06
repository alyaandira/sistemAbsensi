<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$selectedMataKuliah = $_POST["selectedMataKuliah"];

$SQL_query = 
"SELECT * FROM $absensi_table " .
  "LEFT JOIN $pertemuan_table " .
  "ON absensi.pert_kode = pertemuan.pert_kode " .
  "HAVING `$matkul_kode` = '$selectedMataKuliah' " .
  "UNION " .
  "SELECT * FROM $absensi_table " .
  "RIGHT JOIN $pertemuan_table " .
  "ON absensi.pert_kode = pertemuan.pert_kode " .
  "HAVING `$matkul_kode` = '$selectedMataKuliah' ";

  // $SQL_query = 
  // "SELECT * FROM $absensi_table " .
  // "RIGHT JOIN $pertemuan_table " .
  // "ON absensi.pert_kode = pertemuan.pert_kode " .
  // "HAVING `$matkul_kode` = '$selectedMataKuliah'";

// SELECT * FROM `absensi` LEFT JOIN `pertemuan` ON absensi.pert_kode = pertemuan.pert_kode 
// UNION
// SELECT * FROM `absensi` RIGHT JOIN `pertemuan` ON absensi.pert_kode = pertemuan.pert_kode
var_dump($SQL_query);
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
