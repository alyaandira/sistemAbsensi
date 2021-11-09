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

$SQL_query = "INSERT INTO `$dosen_table`(`$dosen_nip`, `$dosen_nama`, `$dosen_password`, `$dosen_email`, `$dosen_fakultas`, `$dosen_jurusan`) 
VALUES ('$input_dosen_nip','$input_dosen_nama','$input_dosen_pass','$input_dosen_email','$input_dosen_jurusan','$input_dosen_fakultas')";

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
