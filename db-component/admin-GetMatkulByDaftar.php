<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$selectedMahasiswaNIM = $_POST["selectedMahasiswaNIM"];

// $SQL_query = "SELECT * FROM $mengajar_table WHERE ".
$SQL_query = "SELECT mata_kuliah.matkul_nama, mata_kuliah.matkul_kode, `$daftar_mhs_nim`, `$daftar_id` FROM $daftar_table " .
  "LEFT JOIN $matkul_table " .
  "ON daftar.matkul_kode = mata_kuliah.matkul_kode " .
  "HAVING `$daftar_mhs_nim` = '$selectedMahasiswaNIM' ";

// SELECT mata_kuliah.matkul_nama, mata_kuliah.matkul_kode, `mhs_nim` FROM `daftar` LEFT JOIN mata_kuliah ON daftar.matkul_kode= mata_kuliah.matkul_kode HAVING `mhs_nim`

// "$dosen_nip = '$NIP'";
$result = mysqli_query($conn, $SQL_query);

if ($result) {
  $row_count = $result->num_rows;
  $matkulTerdaftarList = [];

  if ($row_count > 0) {
    $matkulTerdaftarList = $result->fetch_all(MYSQLI_ASSOC);
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
