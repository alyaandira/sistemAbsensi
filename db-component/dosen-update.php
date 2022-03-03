<?php
include "././db-component/config.php";
$input_dosen_nip = $_POST["DosenModal_NIP"];
$input_dosen_nama = $_POST["DosenModal_Nama"];
$input_dosen_pass = $_POST["DosenModal_Password"];
$input_dosen_email = $_POST["DosenModal_Email"];
$input_dosen_fakultas = $_POST["DosenModal_Fakultas"];
$input_dosen_jurusan = $_POST["DosenModal_Jurusan"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "UPDATE `$dosen_table` SET `$dosen_nip`='$input_dosen_nip',`$dosen_nama`='$input_dosen_nama',`$dosen_password`='$input_dosen_pass',`$dosen_email`='$input_dosen_email',`$dosen_fakultas`='$input_dosen_fakultas',`$dosen_jurusan`='$input_dosen_jurusan' WHERE `$dosen_nip`='$input_dosen_nip'";

$result = mysqli_query($conn, $SQL_query);


if ($result) {
  echo
  "<script>
  window.history.replaceState( null, null, window.location.href );
      iziToast.success({
          title: 'Success',
          message: 'Berhasil dirubah',
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
