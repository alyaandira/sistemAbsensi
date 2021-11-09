<?php
include "././db-component/config.php";
$input_pertemuan_kode = $_POST["delete_pertemuan_action"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "DELETE FROM `$pert_table` WHERE `$pert_kode`= '$input_pertemuan_kode'";

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
