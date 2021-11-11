<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$selectedNIP = $_POST["selectedDosenNIP"];
// $currentNIP = $_SESSION["currentNIP"];

$SQL_query = "SELECT ruang_kelas.kelas_id, ruang_kelas.kelas_nama, `$pert_dosen_nip` FROM $pert_table " .
  "LEFT JOIN $ruangkelas_table " .
  "ON pertemuan.kelas_id = ruang_kelas.kelas_id " .
  "HAVING `$pert_dosen_nip` = '$selectedNIP' ";

  // SELECT * FROM `pertemuan` LEFT JOIN mata_kuliah ON pertemuan.matkul_kode = mata_kuliah.matkul_kode HAVING `dosen_nip` = '2021383902'
// var_dump($SQL_query);
$result = mysqli_query($conn, $SQL_query);

if ($result) {
  $row_count = $result->num_rows;
  $kelasTerdaftarList = [];

  if ($row_count > 0) {
    $kelasTerdaftarList = $result->fetch_all(MYSQLI_ASSOC);
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
