<?php
include "././db-component/config.php";
$matkulModal_daftar_matkulKode = $_POST["matkulModal_daftar_matkulKode"];
$input_nim_mhs = $_POST["selectedMahasiswaNIM"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "INSERT INTO `$daftar_table`(`$daftar_matkul_kode`,`$daftar_mhs_nim`) VALUES ('$matkulModal_daftar_matkulKode','$input_nim_mhs')";

// var_dump($SQL_query);
$result = mysqli_query($conn, $SQL_query);


if ($result) {
  echo
    "<script>
      window.history.replaceState( null, null, window.location.href );
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
        window.history.replaceState( null, null, window.location.href );
        iziToast.error({
            title: 'Error',
            message: 'SQL error',
        });
    </script>";
}
