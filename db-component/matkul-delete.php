<?php
include "././db-component/config.php";
$input_class_kode = $_POST["ClassModal_Kode"];
$input_class_nama = $_POST["ClassModal_Nama"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "DELETE FROM `$matkul_table` WHERE `$matkul_kode`= '$input_class_kode'";

$result = mysqli_query($conn, $SQL_query);


if ($result) {
  echo
    "<script>
    iziToast.success({
        title: 'Success',
        message: 'Berhasil dihapus',
        
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
