<?php
include "././db-component/config.php";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$NIP = $_SESSION["currentNIP"];

$SQL_query = "SELECT * FROM $mengajar_table WHERE ".
"$dosen_nip = '$NIP'";
// "LEFT JOIN mata_kuliah ".
// "ON mengajar.matkul_kode = mata_kuliah.matkul_kode ".
// 4097901
$result = mysqli_query($conn, $SQL_query);
// SELECT mata_kuliah.matkul_nama, mata_kuliah.matkul_kode FROM
// mengajar LEFT JOIN mata_kuliah
// ON mengajar.matkul_kode = mata_kuliah.matkul_kode
// HAVING mengajar.dosen_nip = 4097901

// SELECT * FROM mengajar LEFT JOIN mata_kuliah ON mengajar.matkul_kode = mata_kuliah.matkul_kode HAVING `dosen_nip` = 4097901

if ($result) {
  $row_count = $result->num_rows;
  $matkulList = [];

  if ($row_count > 0) {
    $matkulList = $result -> fetch_all(MYSQLI_ASSOC);
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
