<?php
include "././db-component/config.php";
$mahasiswa_changePassword_NIM = $_POST["mahasiswa_changePassword_NIM"];
$mahasiswa_changePassword_oldPassword = $_POST["mahasiswa_changePassword_oldPassword"];
$mahasiswa_changePassword_newPassword = $_POST["mahasiswa_changePassword_newPassword"];
$mahasiswa_changePassword_newPasswordConfirm = $_POST["mahasiswa_changePassword_newPasswordConfirm"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$SQL_query_getMahasiswa = "SELECT * FROM `mahasiswa` WHERE `$mhs_nim`='$mahasiswa_changePassword_NIM'";
$result = mysqli_query($conn, $SQL_query_getMahasiswa);

if ($result) {
    $row_count = $result->num_rows;
    $selectedMahasiswaData = [];

    if ($row_count > 0) {

        $selectedMahasiswaData = $result->fetch_row();

        if ($selectedMahasiswaData[2] == $mahasiswa_changePassword_oldPassword) {
            $SQL_query_changePassword = "UPDATE `$mhs_table` SET `$mhs_password`='$mahasiswa_changePassword_newPasswordConfirm' WHERE `$mhs_nim`='$mahasiswa_changePassword_NIM'";

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
            echo
            "<script>
            iziToast.warning({
                title: 'Caution',
                message: 'Old password doesnt match!',
            });
            </script>";
            // var_dump("old password does not match");
        }
    } else {
        echo
            "<script>
            iziToast.error({
                title: 'Error',
                message: 'No record found!',
            });
            </script>";
        // var_dump("no record found");
    }
}
