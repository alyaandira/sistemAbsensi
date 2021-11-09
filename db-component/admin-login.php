<?php

include './db-component/config.php';
$input_nim = $_POST["user_name"];
$input_password = $_POST["user_pass"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
// $conn = new mysqli("localhost", "root", ">zVe6S8[@w*pISjU", "SistemAbsensi");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//hard coded, nanti ubah sesuai input, employee_email pakai variable from config.php
$SQL_query = "SELECT * FROM `$admin_table` WHERE `$admin_username`='$input_nim' AND `$admin_pass`='$input_password'";
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
    $_SESSION["currentUsername"] = $dataRow[1];
    $_SESSION["currentNIP"] = $dataRow[0];

    // var_dump($_SESSION["currentUsername"]);
    // var_dump($_SESSION["currentNIP"]);
    // redirect to home page
    header("Location: admin-mataKuliah.php");
    exit;
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
