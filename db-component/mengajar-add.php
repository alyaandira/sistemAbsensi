<?php
include "././db-component/config.php";
$matkulModal_mengajar_matkulKode = $_POST["matkulModal_mengajar_matkulKode"];
$input_dosen_nip = $_POST["selectedDosenNIP"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "INSERT INTO `$mengajar_table`(`$matkul_kode`,`$dosen_nip`) VALUES ('$matkulModal_mengajar_matkulKode','$input_dosen_nip')";

var_dump($SQL_query);
$result = mysqli_query($conn, $SQL_query);


if ($result) {
  echo
    "<script>
    iziToast.success({
        title: 'Success',
        message: 'Berhasil ditambah',
        
    });
  </script>";

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
