<?php

include './db-component/config.php';
$input_dosen_nip = $_POST["user_name"];
$input_dosen_password = $_POST["user_pass"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
// $conn = new mysqli("localhost", "root", ">zVe6S8[@w*pISjU", "SistemAbsensi");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//hard coded, nanti ubah sesuai input, employee_email pakai variable from config.php
$SQL_query = "SELECT * FROM `$dosen_table` WHERE `$dosen_nip`='$input_dosen_nip' AND `$dosen_password`='$input_dosen_password'";
$result = mysqli_query($conn, $SQL_query);

//if no problem with query, go to if scope
if ($result) {

  /* determine number of rows result set */
  $row_count = $result->num_rows;

  // user credentials correct/exist
  if ($row_count > 0) {

    // this function is used to get value from a row
    $dataRow = $result->fetch_row();

    // assign current user details to
    $_SESSION["currentNIP"] = $dataRow[0];
    $_SESSION["currentUsername"] = $dataRow[1];
    $_SESSION["currentPassword"] = $dataRow[2];
    $_SESSION["currentEmail"] = $dataRow[3];
    $_SESSION["currentFakultas"] = $dataRow[4];
    $_SESSION["currentJurusan"] = $dataRow[5];

    // var_dump($_SESSION["currentNIP"]);
    // var_dump($_SESSION["currentUsername"]);
    // var_dump($_SESSION["currentPassword"]);
    // var_dump($_SESSION["currentEmail"]);
    // var_dump($_SESSION["currentFakultas"]);
    // var_dump($_SESSION["currentJurusan"]);
    // redirect to home page
    header("Location: dosen-daftarMatkul.php");
    // exit;
  } else {
    echo
      "<script>
        iziToast.error({
            title: 'Error',
            message: 'user not registered on the system',
        });
    </script>";
  }
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
