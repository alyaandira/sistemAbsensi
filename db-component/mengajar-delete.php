<?php
include "././db-component/config.php";
$delete_mengajar = $_POST["delete_mengajar"];
$input_dosen_nip = $_POST["selectedDosenNIP"];


// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "DELETE FROM `$mengajar_table` WHERE `$mengajar_id` = '$delete_mengajar'";


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
