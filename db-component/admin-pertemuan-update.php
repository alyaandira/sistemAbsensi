<?php
include "././db-component/config.php";
$input_pertemuan_kode = $_POST["PertemuanModal_Kode"];
$input_class_kode = $_POST["MatkulModal_Kode"];
$input_class_id = $_POST["ClassModal_ID"];
$input_dosen_nip = $_POST["DosenModal_NIP"];
$input_class_waktumulai = $_POST["PertemuanModal_StartTime"];
$input_class_waktuakhir = $_POST["PertemuanModal_EndTime"];
$input_class_bataswaktu = $_POST["PertemuanModal_LimitTime"];

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$SQL_query = "UPDATE `$pert_table` SET `$pert_kode`='$input_pertemuan_kode',`$pert_matkul_kode`='$input_class_kode',`$pert_kelas_id`='$input_class_id',
`$pert_dosen_nip`='$input_dosen_nip',`$pert_waktu_mulai`='$input_class_waktumulai',`$pert_waktu_akhir`='$input_class_waktuakhir',`$pert_batas_waktu`='$input_class_bataswaktu' 
WHERE `$pert_kode`= '$input_pertemuan_kode'";

$result = mysqli_query($conn, $SQL_query);


if ($result) {
    echo
    "<script>
        window.history.replaceState( null, null, window.location.href );
        iziToast.success({
          title: 'Success',
          message: 'Berhasil diupdate',
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
