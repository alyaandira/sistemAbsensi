<?php
include "././db-component/config.php";
$input_class_id = $_POST["ClassModal_ID"];
$input_class_nama = $_POST["ClassModal_Nama"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "UPDATE `$ruangkelas_table` SET `$ruangkelas_id`='$input_class_id',`$ruangkelas_nama`='$input_class_nama' WHERE `$ruangkelas_id`= '$input_class_id'";

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
