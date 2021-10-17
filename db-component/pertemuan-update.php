<?php
include "././db-component/config.php";
$input_pertemuan_kode = $_POST["PertemuanModal_Kode"];
$input_class_kode = $_POST["ClassModal_Kode"];
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

// $SQL_query = "INSERT INTO `mata_kuliah`(`matkul_kode`, `matkul_nama`) VALUES ('ILK345','rendangkurus')";
$SQL_query = "UPDATE `$pertemuan_table` SET `$pert_kode`='$input_pertemuan_kode',`$matkul_kode`='$input_class_kode',`$kelas_id`='$input_class_id',
`$dosen_nip`='$input_dosen_nip',`$waktuMulai`='$input_class_waktumulai',`$waktuAkhir`='$input_class_waktuakhir',`$batasWaktu`='$input_class_bataswaktu' 
WHERE `$pert_kode`= '$input_pertemuan_kode'";

$result = mysqli_query($conn, $SQL_query);


if ($result) {
    echo
    "<script>
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
        iziToast.error({
            title: 'Error',
            message: 'SQL error',
        });
    </script>";
}
