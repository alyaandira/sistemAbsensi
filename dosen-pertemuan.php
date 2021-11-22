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
    <title>Sistem Absensi - Daftar Pertemuan</title>
   
    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/beranda-adminstyle.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- Izi Toast -->
    <script src="src\izitoast\dist\js\iziToast.js" type="text/javascript"></script>
    <link rel="stylesheet" href="src\izitoast\dist\css\iziToast.css">
</head>

<body>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- floating action button -->
    <div class="adminActions" id="adminButton">
        <input type="checkbox" name="adminToggle" class="adminToggle" />
        <a class="adminButton" href="#!">+</a>
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
            <h1>Meeting Management</h1>

            <?php

            // add class
            if (isset($_POST["PertemuanModal_ActionType"])) {

                if ($_POST["PertemuanModal_ActionType"] == "Add") {
                    include '././db-component/dosen-pertemuan-add.php';
                } else if ($_POST["PertemuanModal_ActionType"] == "Update") {
                    include '././db-component/dosen-pertemuan-update.php';
                }
            }

            if (isset($_POST["delete_pertemuan_action"])) {
                include '././db-component/pertemuan-delete.php';
            }

            include '././db-component/GetAllClass.php';
            include '././db-component/dosen-GetPertemuanJoinMatkul.php';
            include '././db-component/dosen-GetMatkulByMengajar.php';

            if (empty($pertemuanList)) {
                echo "<p>No class has been registered</p>";
            } else {

                echo "
            <div class='table-responsive'>
                <table class='table table-sm table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Akhir</th>
                            <th>Batas Waktu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

                foreach ($pertemuanList as $primaryKey => $value) {
                    $nomor = $primaryKey + 1;
                    $pertemuanKode = $value["pert_kode"];
                    $matkulKode = $value["matkul_kode"];
                    $matkulNama = $value["matkul_nama"];
                    $DisplayMatkul = $matkulKode . " - " . $matkulNama;
                    $pertemuan_classID = $value["kelas_id"];
                    $pertemuan_classNama = $value["kelas_nama"];
                    $value_to_display = $pertemuan_classID . " - " . $pertemuan_classNama;
                    echo "
                        <tr>
                            <td>$nomor</td>
                            <td> $DisplayMatkul </td>
                            <td> $value_to_display </td>
                            <td id='waktuMulai_$primaryKey'>$value[waktuMulai]</td>
                            <td id='waktuAkhir_$primaryKey'>$value[waktuAkhir]</td>
                            <td id='batasWaktu_$primaryKey'>$value[batasWaktu]</td>
                            <input type='hidden' id='pertKode_$primaryKey' value='$pertemuanKode' />
                            <input type='hidden' id='matkulKode_$primaryKey' value='$matkulKode' />
                            <input type='hidden' id='kelasID_$primaryKey' value='$pertemuan_classID' />
                            <td style='text-align:center;'>
                                <form method='POST'>
                                    <button type='submit' value='$pertemuanKode' name='delete_pertemuan_action' class='btn btn-danger'>Delete</button>
                                    <button onclick='initializeUpdatePertemuanModal(&#39;$primaryKey&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#pertemuan_manage_modal' type='button'>
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>";
                } //end of foreach
                echo "
                    </tbody>
                </table>
            </div>";
            }

            ?>
            <!-- End Wrapper -->
        </div>
    </div>
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

                    <input type="hidden" class="form-control" value="<?php echo $selectedNIP ?>" name="selectedDosenNIP">
                    <input type="hidden" class="form-control" id="PertemuanModal_ActionType" name="PertemuanModal_ActionType">
                    <input type="hidden" class="form-control" id="PertemuanModal_PrimaryKey" name="PertemuanModal_PrimaryKey">
                    <input type="hidden" class="form-control" id="PertemuanModal_Kode" name="PertemuanModal_Kode">
                    <input type="hidden" class="form-control" id="ClassModal_Dosen" name="ClassModal_Dosen">

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Mata Kuliah:</label>
                        <select class="form-control" name="MatkulModal_Kode" id="MatkulModal_Kode">
                            <?php
                            foreach ($matkulTerdaftarList as $matkul) {
                                $matkulKode = $matkul["matkul_kode"];
                                $matkulNama = $matkul["matkul_nama"];
                                $DisplayMatkul = $matkulKode . " - " . $matkulNama;
                                echo "<option value='$matkulKode'>$DisplayMatkul</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Kelas:</label>
                        <select class="form-control" id="ClassModal_ID" name="ClassModal_ID">
                            <?php
                            foreach ($AllClassList as $class) {
                                $pertemuan_classID = $class["kelas_id"];
                                $pertemuan_classNama = $class["kelas_nama"];
                                $value_to_display = $pertemuan_classID . " - " . $pertemuan_classNama;
                                echo '<option value="' . $pertemuan_classID . '">' . $value_to_display . '</option>';
                            }
                            ?>
                        </select>
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

<?php
include '././ui-component/dependenciesImport.php';
?>

</html>

<script>
    document.getElementById("adminButton").addEventListener("click", initializeAddPertemuanModal);

    function initializeUpdatePertemuanModal(primaryKey) {

        // get value from the table row based on selected Key
        // mengambil data dari table berdasarkan primary Key yang kita pegang
        const kodePertemuan = document.getElementById("pertKode_" + primaryKey).value;
        const kodeKelas = document.getElementById("matkulKode_" + primaryKey).value;
        const IDKelas = document.getElementById("kelasID_" + primaryKey).value;
        const waktuMulaiPertemuan = document.getElementById("waktuMulai_" + primaryKey).innerHTML;
        const waktuAkhirPertemuan = document.getElementById("waktuAkhir_" + primaryKey).innerHTML;
        const batasWaktuPertemuan = document.getElementById("batasWaktu_" + primaryKey).innerHTML;


        // get timezone offset
        var tzoffset = (new Date()).getTimezoneOffset() * 60000;

        // // set the input value in the modal
        // // memasukkan data kedalam modal
        document.getElementById("PertemuanModal_ActionType").value = "Update";
        document.getElementById("PertemuanModal_PrimaryKey").value = $.trim(primaryKey);
        document.getElementById("PertemuanModal_Kode").value = $.trim(kodePertemuan);
        document.getElementById("MatkulModal_Kode").value = $.trim(kodeKelas);
        document.getElementById("ClassModal_ID").value = $.trim(IDKelas);
        document.getElementById("PertemuanModal_StartTime").value = new Date(new Date(waktuMulaiPertemuan) - tzoffset).toISOString().slice(0, 16);
        document.getElementById("PertemuanModal_EndTime").value = new Date(new Date(waktuAkhirPertemuan) - tzoffset).toISOString().slice(0, 16);
        document.getElementById("PertemuanModal_LimitTime").value = batasWaktuPertemuan.toString();
    }

    function initializeAddPertemuanModal() {
        $('#pertemuan_manage_modal').modal('toggle')

        //set all the field to empty, because it is a frehs new modal
        document.getElementById("PertemuanModal_ActionType").value = "Add";
        document.getElementById("PertemuanModal_PrimaryKey").value = "";
        document.getElementById("PertemuanModal_Kode").value = "";
        document.getElementById("MatkulModal_Kode").value = "";
        document.getElementById("ClassModal_ID").value = "";
        document.getElementById("PertemuanModal_StartTime").value = "";
        document.getElementById("PertemuanModal_EndTime").value = "";
        document.getElementById("PertemuanModal_LimitTime").value = "";
    }

    function submitModal() {
        const modalType = document.getElementById("PertemuanModal_ActionType").value;
        const newKodePertemuan = document.getElementById("PertemuanModal_Kode").value;
        const newKodeKelas = document.getElementById("MatkulModal_Kode").value;
        const newIDKelas = document.getElementById("ClassModal_ID").value;
        const newWaktuMulai = document.getElementById("PertemuanModal_StartTime").value;
        const newWaktuAkhir = document.getElementById("PertemuanModal_EndTime").value;
        const newBatasWaktu = document.getElementById("PertemuanModal_LimitTime").value;
        console.log(modalType);
        console.log(newKodePertemuan);
        console.log(newKodeKelas);
        console.log(newIDKelas);
        console.log(newWaktuMulai);
        console.log(newWaktuAkhir);
        console.log(newBatasWaktu);
        if (modalType == "Add") {

            if (newKodeKelas == "" || newIDKelas == "" || newWaktuMulai == "" || newWaktuAkhir == "" || newBatasWaktu == "") {
                window.alert("Fill up the field!")
            } else {
                document.getElementById("PertemuanModal_bodyForm").submit();
            }

        } else if (modalType == "Update") {

            // dapatin primary key
            const primaryKey = document.getElementById("PertemuanModal_PrimaryKey").value;

            // // pakai innetHTML karena dia dialam table, didalam html tag, di select berdasarkan primary key
            const oldKodePertemuan = document.getElementById("pertKode_" + primaryKey).value;
            const oldKodeKelas = document.getElementById("matkulKode_" + primaryKey).value;
            const oldIDKelas = document.getElementById("kelasID_" + primaryKey).value;
            const oldWaktuMulai = document.getElementById("waktuMulai_" + primaryKey).innerHTML;
            const oldWaktuAkhir = document.getElementById("waktuAkhir_" + primaryKey).innerHTML;
            const oldBatasWaktu = document.getElementById("batasWaktu_" + primaryKey).innerHTML;

            if (oldKodePertemuan == newKodePertemuan && oldKodeKelas == newKodeKelas && oldIDKelas == newIDKelas && oldWaktuMulai == newWaktuMulai && oldWaktuAkhir == newWaktuAkhir && oldBatasWaktu == newBatasWaktu ||
                newKodePertemuan == "" || newKodeKelas == "" || newIDKelas == "" || newWaktuMulai == "" || newWaktuAkhir == "" || newBatasWaktu == "") {
                iziToast.warning({
                    title: 'Caution',
                    message: 'Nothing changed!',
                });
            } else {
                document.getElementById("PertemuanModal_bodyForm").submit();
            }
        }
    }
</script>

<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>
<style>
    body {
        background-color: #f5f5f5;
    }

    .adminActions {
        position: fixed;
        bottom: 45px;
        right: 55px;
        z-index: 10;
    }

    .adminButton {
        background-color: rgba(67, 83, 143);
        border-radius: 50%;
        display: block;
        color: #fff;
        text-align: center;
        position: relative;
        text-decoration: none;
        padding: 25px 30px;
    }

    .adminButton i {
        font-size: 22px;
    }

    .adminToggle {
        -webkit-appearance: none;
        position: absolute;
        border-radius: 50%;
        top: 0;
        left: 0;
        margin: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        background-color: transparent;
        border: none;
        outline: none;
        z-index: 2;
        transition: box-shadow 0.2s ease-in-out;
        box-shadow: 0 3px 5px 1px rgba(51, 51, 51, 0.3);
    }

    .adminToggle:hover {
        box-shadow: 0 3px 6px 2px rgba(51, 51, 51, 0.3);
    }

    .adminToggle:checked~.adminButtons a {
        opacity: 1;
        visibility: visible;
    }
</style>