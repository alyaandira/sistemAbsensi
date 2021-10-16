<?php
include "././db-component/config.php";
$input_mahasiswa_nim = $_POST["MahasiswaModal_NIM"];
$input_mahasiswa_nama = $_POST["MahasiswaModal_Nama"];
$input_mahasiswa_pass = $_POST["MahasiswaModal_Password"];
$input_mahasiswa_email = $_POST["MahasiswaModal_Email"];
$input_mahasiswa_fakultas = $_POST["MahasiswaModal_Fakultas"];
$input_mahasiswa_jurusan = $_POST["MahasiswaModal_Jurusan"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "UPDATE `$mhs_table` SET `$mhs_nim`='$input_mahasiswa_nim',`$mhs_nama`='$input_mahasiswa_nama',`$mhs_password`='$input_mahasiswa_pass',`$mhs_email`='$input_mahasiswa_email',`$mhs_fakultas`='$input_mahasiswa_fakultas',`$mhs_jurusan`='$input_mahasiswa_jurusan' WHERE `$mhs_nim`='$input_mahasiswa_nim'";

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
