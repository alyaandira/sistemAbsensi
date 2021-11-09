<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$selectedDosenNIP = $_POST["selectedDosenNIP"];

$SQL_query = "SELECT mata_kuliah.matkul_nama, mata_kuliah.matkul_kode, `$dosen_nip`, `$mengajar_id` FROM $mengajar_table " .
  "LEFT JOIN $matkul_table " .
  "ON mengajar.matkul_kode = mata_kuliah.matkul_kode " .
  "HAVING `$dosen_nip` = '$selectedDosenNIP' ";

$result = mysqli_query($conn, $SQL_query);

if ($result) {
  $row_count = $result->num_rows;
  $matkulTerdaftarList = [];

  if ($row_count > 0) {
    $matkulTerdaftarList = $result->fetch_all(MYSQLI_ASSOC);
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
