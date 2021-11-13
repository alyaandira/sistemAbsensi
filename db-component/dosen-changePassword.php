<?php
include "././db-component/config.php";
$dosen_changePassword_NIP = $_POST["dosen_changePassword_NIP"];
$dosen_changePassword_oldPassword = $_POST["dosen_changePassword_oldPassword"];
$dosen_changePassword_newPassword = $_POST["dosen_changePassword_newPassword"];
$dosen_changePassword_newPasswordConfirm = $_POST["dosen_changePassword_newPasswordConfirm"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$SQL_query_getDosen = "SELECT * FROM `dosen` WHERE `$dosen_nip`='$dosen_changePassword_NIP'";
$result = mysqli_query($conn, $SQL_query_getDosen);

if ($result) {
    $row_count = $result->num_rows;
    $selectedDosenData = [];

    if ($row_count > 0) {

        $selectedDosenData = $result->fetch_row();

        if ($selectedDosenData[2] == $dosen_changePassword_oldPassword) {
            $SQL_query_changePassword = "UPDATE `$dosen_table` SET `$dosen_password`='$dosen_changePassword_newPasswordConfirm' WHERE `$dosen_nip`='$dosen_changePassword_NIP'";

            $result = mysqli_query($conn, $SQL_query_changePassword);

            if ($result) {
                echo
                "<script>
                    iziToast.success({
                        title: 'Success',
                        message: 'Berhasil diganti',
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
        } else {
            // $error_message = $conn->error;
            // echo ("Error is = " . $error_message);
            echo
            "<script>
            iziToast.warning({
                title: 'Caution',
                message: 'Old password doesnt match!',
            });
            </script>";
        }
    } else {
        // $error_message = $conn->error;
        // echo ("Error is = " . $error_message);
        echo
        "<script>
        iziToast.error({
            title: 'Error',
            message: 'No record found!',
        });
        </script>";
    }
}
