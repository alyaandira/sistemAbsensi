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

$SQL_query = "INSERT INTO `$mhs_table`(`$mhs_nim`, `$mhs_nama`, `$mhs_password`, `$mhs_email`, `$mhs_fakultas`, `$mhs_jurusan`) 
VALUES ('$input_mahasiswa_nim','$input_mahasiswa_nama','$input_mahasiswa_pass','$input_mahasiswa_email','$input_mahasiswa_fakultas','$input_mahasiswa_jurusan')";

$result = mysqli_query($conn, $SQL_query);


if ($result) {
  echo
  "<script>
  window.history.replaceState( null, null, window.location.href );
      iziToast.success({
          title: 'Success',
          message: 'Berhasil ditambahkan',
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
