<?php
include "././db-component/config.php";
$input_class_id = $_POST["ClassModal_ID"];
$input_class_nama = $_POST["ClassModal_Nama"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "INSERT INTO `$ruangkelas_table`(`$ruangkelas_id`,`$ruangkelas_nama`) VALUES ('$input_class_id','$input_class_nama')";

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
