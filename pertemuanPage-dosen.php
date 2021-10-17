<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Alya Andira Lubis">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Sistem Absensi - Beranda Admin</title>
    <!-- Custom CSS -->
    <link href="./assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="./assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="./assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/beranda-adminstyle.css">
    <script src="src\izitoast\dist\js\iziToast.js" type="text/javascript"></script>
    <link rel="stylesheet" href="src\izitoast\dist\css\iziToast.css">
    <!-- <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="./css/table-style.css"> -->
</head>

<body>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php
        include '././ui-component/topbar-dosen.php';
        include '././ui-component/sidebar-dosen.php';
        ?>

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div> Halaman Dosen </div>
            <h1>Meeting Management</h1>


            <?php

            // add class
            if (isset($_POST["PertemuanModal_ActionType"])) {

                // var_dump($_POST["PertemuanModal_ActionType"]);
                // var_dump($_POST["PertemuanModal_PrimaryKey"]);
                // var_dump($_POST["ClassModal_Kode"]);
                // var_dump($_POST["ClassModal_Nama"]);

                if ($_POST["PertemuanModal_ActionType"] == "Add") {
                    include '././db-component/pertemuan-add.php';
                } else if ($_POST["PertemuanModal_ActionType"] == "Update") {
                    include '././db-component/pertemuan-update.php';
                } else if ($_POST["PertemuanModal_ActionType"] == "Delete") {
                    include '././db-component/pertemuan-delete.php';
                }
            }

            include '././db-component/GetAllPertemuan.php';

            if (empty($FetchedPertemuanList)) {
                echo "<p>No class has been registered</p>";
            } else {

                echo "
        <div class='container-table'>
            <table class='table table-sm table-hover'>
                <thead class='thead-dark'>
                    <tr>
                        <th>No</th>
                        <th>Kode Pertemuan</th>
                        <th>Kode Mata Kuliah</th>
                        <th>ID Kelas</th>
                        <th>NIP Dosen</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Akhir</th>
                        <th>Batas Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";

                foreach ($FetchedPertemuanList as $primaryKey => $value) {
                    $nomor = $primaryKey + 1;
                    $pertemuanKode = $value["pert_kode"];
                    echo "
            <tr>
                <td>$nomor</td>
                <td id='pertkode_$primaryKey'>$value[pert_kode]</td>
                <td id='matkulkode_$primaryKey'>$value[matkul_kode]</td>
                <td id='kelasID_$primaryKey'>$value[kelas_id]</td>
                <td id='dosenNIP_$primaryKey'>$value[dosen_nip]</td>
                <td id='waktuMulai_$primaryKey'>$value[waktuMulai]</td>
                <td id='waktuAkhir_$primaryKey'>$value[waktuAkhir]</td>
                <td id='batasWaktu_$primaryKey'>$value[batasWaktu]</td>
                <td style='text-align:center;'>
                    <form method='POST'>
                        <button type='button' onclick='initializeDeletePertemuanModal(&#39;$pertemuanKode&#39;);' class='btn btn-danger'>Delete</button>
                        <button onclick='initializeUpdatePertemuanModal(&#39;$primaryKey&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#pertemuan_manage_modal' type='button'>
                            Update
                        </button>
                    </form>
                    
                </td>
            </tr>";
                } //end of foreach
                echo "
               
            </table>
      ";
            }

            ?>

            <h1>Tambah Mata Kuliah</h1>
            <button type="button" onclick="initializeAddPertemuanModal();" class="btn waves-effect waves-light btn-success" data-toggle="modal" data-target="#pertemuan_manage_modal">Add</button>

</body>

<!-- Class Modal -->
<div class="modal fade" id="pertemuan_manage_modal" tabindex="-1" aria-labelledby="pertemuan_manage_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Detail Pertemuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id='PertemuanModal_bodyForm'>

                    <input type="text" class="form-control" id="PertemuanModal_ActionType" name="PertemuanModal_ActionType">
                    <input type="text" class="form-control" id="PertemuanModal_PrimaryKey" name="PertemuanModal_PrimaryKey">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Kode Pertemuan:</label>
                        <input type="text" class="form-control" id="PertemuanModal_Kode" name="PertemuanModal_Kode">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Kode Mata Kuliah:</label>
                        <input type="text" class="form-control" id="ClassModal_Kode" name="ClassModal_Kode">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ID Kelas:</label>
                        <input type="text" class="form-control" id="ClassModal_ID" name="ClassModal_ID">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">NIP Dosen:</label>
                        <input type="text" class="form-control" id="DosenModal_NIP" name="DosenModal_NIP">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Waktu Mulai:</label>
                        <input type="datetime-local" class="form-control" id="PertemuanModal_StartTime" name="PertemuanModal_StartTime">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Waktu Akhir:</label>
                        <input type="datetime-local" class="form-control" id="PertemuanModal_EndTime" name="PertemuanModal_EndTime">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Batas Waktu:</label>
                        <input class="form-control" id="PertemuanModal_LimitTime" name="PertemuanModal_LimitTime">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="submitModal();" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>



<script>
    function initializeUpdatePertemuanModal(primaryKey) {

        //get value from the table row based on selected Key
        // mengambil data dari table berdasarkan primary Key yang kita pegang
        const kodePertemuan = document.getElementById("pertkode_" + primaryKey).innerHTML;
        const kodeKelas = document.getElementById("matkulkode_" + primaryKey).innerHTML;
        const IDKelas = document.getElementById("kelasID_" + primaryKey).innerHTML;
        const NIPdosen = document.getElementById("dosenNIP_" + primaryKey).innerHTML;
        const waktuMulaiPertemuan = document.getElementById("waktuMulai_" + primaryKey).innerHTML;
        const waktuAkhirPertemuan = document.getElementById("waktuAkhir_" + primaryKey).innerHTML;
        const batasWaktuPertemuan = document.getElementById("batasWaktu_" + primaryKey).innerHTML;

        // get timezone offset
        var tzoffset = (new Date()).getTimezoneOffset() * 60000;

        // //set the input value in the modal
        // memasukkan data kedalam modal
        document.getElementById("PertemuanModal_ActionType").value = "Update";
        document.getElementById("PertemuanModal_PrimaryKey").value = primaryKey;
        document.getElementById("PertemuanModal_Kode").value = kodePertemuan;
        document.getElementById("ClassModal_Kode").value = kodeKelas;
        document.getElementById("ClassModal_ID").value = IDKelas;
        document.getElementById("DosenModal_NIP").value = NIPdosen;
        document.getElementById("PertemuanModal_StartTime").value = new Date(new Date(waktuMulaiPertemuan) - tzoffset).toISOString().slice(0, 16);
        document.getElementById("PertemuanModal_EndTime").value = new Date(new Date(waktuAkhirPertemuan) - tzoffset).toISOString().slice(0, 16);
        document.getElementById("PertemuanModal_LimitTime").value = batasWaktuPertemuan;
    }

    function initializeAddPertemuanModal() {
        //set all the field to empty, because it is a frehs new modal
        document.getElementById("PertemuanModal_ActionType").value = "Add";
        document.getElementById("PertemuanModal_PrimaryKey").value = "";
        document.getElementById("PertemuanModal_Kode").value = "";
        document.getElementById("ClassModal_Kode").value = "";
        document.getElementById("ClassModal_ID").value = "";
        document.getElementById("DosenModal_NIP").value = "";
        document.getElementById("PertemuanModal_StartTime").value = "";
        document.getElementById("PertemuanModal_EndTime").value = "";
        document.getElementById("PertemuanModal_LimitTime").value = "";
    }

    function initializeDeletePertemuanModal(pertemuanKode) {
        document.getElementById("PertemuanModal_ActionType").value = "Delete";
        document.getElementById("PertemuanModal_PrimaryKey").value = "";
        document.getElementById("PertemuanModal_Kode").value = pertemuanKode;
        document.getElementById("ClassModal_Kode").value = "";
        document.getElementById("ClassModal_ID").value = "";
        document.getElementById("DosenModal_NIP").value = "";
        document.getElementById("PertemuanModal_StartTime").value = "";
        document.getElementById("PertemuanModal_EndTime").value = "";
        document.getElementById("PertemuanModal_LimitTime").value = "";
        // console.log(primaryKey);
        submitModal()
    }

    function submitModal() {
        const modalType = document.getElementById("PertemuanModal_ActionType").value;
        const newKodePertemuan = document.getElementById("PertemuanModal_Kode").value;
        const newKodeKelas = document.getElementById("ClassModal_Kode").value;
        const newIDKelas = document.getElementById("ClassModal_ID").value;
        const newNIPdosen = document.getElementById("DosenModal_NIP").value;
        const newWaktuMulai = document.getElementById("PertemuanModal_StartTime").value;
        const newWaktuAkhir = document.getElementById("PertemuanModal_EndTime").value;
        const newBatasWaktu = document.getElementById("PertemuanModal_LimitTime").value;

        if (modalType == "Add") {

            if (newKodePertemuan == "" || newKodeKelas == "" || newIDKelas == "" || newNIPdosen == "" || newWaktuMulai == "" || newWaktuAkhir == "" || newBatasWaktu == "") {
                window.alert("Fill up the field!")
            } else {
                document.getElementById("PertemuanModal_bodyForm").submit();
            }

        } else if (modalType == "Update") {

            // dapatin primary key
            const primaryKey = document.getElementById("PertemuanModal_PrimaryKey").value;

            // // pakai innetHTML karena dia dialam table, didalam html tag, di select berdasarkan primary key
            const oldKodePertemuan = document.getElementById("pertkode_" + primaryKey).innerHTML;
            const oldKodeKelas = document.getElementById("matkulkode_" + primaryKey).innerHTML;
            const oldIDKelas = document.getElementById("kelasID_" + primaryKey).innerHTML;
            const oldNIPdosen = document.getElementById("dosenNIP_" + primaryKey).innerHTML;
            const oldWaktuMulai = document.getElementById("waktuMulai_" + primaryKey).innerHTML;
            const oldWaktuAkhir = document.getElementById("waktuAkhir_" + primaryKey).innerHTML;
            const oldBatasWaktu = document.getElementById("batasWaktu_" + primaryKey).innerHTML;

            if (oldKodePertemuan == newKodePertemuan && oldKodeKelas == newKodeKelas && oldIDKelas == newIDKelas && oldNIPdosen == newNIPdosen && oldWaktuMulai == newWaktuMulai && oldWaktuAkhir == newWaktuAkhir && oldBatasWaktu == newBatasWaktu ||
                newKodePertemuan == "" || newKodeKelas == "" || newIDKelas == "" || newNIPdosen == "" || newWaktuMulai == "" || newWaktuAkhir == "" || newBatasWaktu == "") {
                window.alert("nothing changed, nothing to submit, pakai izzi toast")
            } else {
                document.getElementById("PertemuanModal_bodyForm").submit();
            }

        } else if (modalType == "Delete") {
            document.getElementById("PertemuanModal_bodyForm").submit();
        }
    }
</script>

</div>
<!-- End Container fluid  -->
</div>
<!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->
<?php
include '././ui-component/dependenciesImport.php';
?>

</html>

<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>