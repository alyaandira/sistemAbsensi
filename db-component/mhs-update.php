<?php
include "././db-component/config.php";
$input_mahasiswa_nim = $_POST["MahasiswaModal_NIM"];
$input_mahasiswa_nama = $_POST["MahasiswaModal_Nama"];
$input_mahasiswa_pass = $_POST["MahasiswaModal_Password"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "UPDATE `$mhs_table` SET `$mhs_nim`='$input_mahasiswa_nim',`$mhs_nama`='$input_mahasiswa_nama',`$mhs_password`='$input_mahasiswa_pass' WHERE `$mhs_nim`='$input_mahasiswa_nim'";

$result = mysqli_query($conn, $SQL_query);


if ($result) {
  echo
  "<script>
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
        iziToast.error({
            title: 'Error',
            message: 'SQL error',
        });
    </script>";
}
