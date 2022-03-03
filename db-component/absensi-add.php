<?php
include "././db-component/config.php";
$selectedPertKode = $_POST["selectedPertKode"];
$tableMhsNim = $_SESSION["currentNIP"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "INSERT INTO `$absensi_table`(`$absensi_status`,`$absensi_mhs_nim`,`$absensi_pert_kode`) 
VALUES ('$tableAbsenStatus','$tableMhsNim','$selectedPertKode')";

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