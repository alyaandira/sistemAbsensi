<?php
include "././db-component/config.php";
$delete_daftar = $_POST["delete_daftar"];
$input_nim_mhs = $_POST["selectedMahasiswaNIM"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "DELETE FROM `$daftar_table` WHERE `$daftar_id` = '$delete_daftar'";


// var_dump($SQL_query);
$result = mysqli_query($conn, $SQL_query);


if ($result) {
  echo
    "<script>
    window.history.replaceState( null, null, window.location.href );
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
       window.history.replaceState( null, null, window.location.href );
        iziToast.error({
            title: 'Error',
            message: 'SQL error',
        });
    </script>";
}
