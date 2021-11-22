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
    <title>Sistem Absensi - Dosen</title>

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
        include '././ui-component/topbar-admin.php';
        include '././ui-component/sidebar-admin.php';
        ?>

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <h1 class="main_title">Dosen Management</h1>

            <?php
            if (isset($_POST["DosenModal_ActionType"])) {

                if ($_POST["DosenModal_ActionType"] == "Add") {
                    include '././db-component/dosen-add.php';
                } else if ($_POST["DosenModal_ActionType"] == "Update") {
                    include '././db-component/dosen-update.php';
                } else if ($_POST["DosenModal_ActionType"] == "Delete") {
                    include '././db-component/dosen-delete.php';
                }
            }

            include '././db-component/GetAllDosen.php';

            if (empty($FetchedDosenList)) {
                echo "<p>No class has been registered</p>";
            } else {

                echo "
                <div class='table-responsive'>
                    <table class='table table-sm table-hover'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Fakultas</th>
                                <th>Jurusan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

                        foreach ($FetchedDosenList as $primaryKey => $value) {
                            $nomor = $primaryKey + 1;
                            $dosenNIP = $value["dosen_nip"];
                            $dosenNama = $value["dosen_nama"];
                            echo "
                            <tr>
                                <td>$nomor</td>
                                <td id='dosenNama_$primaryKey'>$value[dosen_nama]</td>
                                <td id='dosenNIP_$primaryKey'>$value[dosen_nip]</td>
                                <td id='dosenPass_$primaryKey'>$value[dosen_password]</td>
                                <td id='dosenEmail_$primaryKey'>$value[dosen_email]</td>
                                <td id='dosenFakultas_$primaryKey'>$value[dosen_fakultas]</td>
                                <td id='dosenJurusan_$primaryKey'>$value[dosen_jurusan]</td>
                                <td style='text-align:center;'>
                                    <form method='POST'>
                                        <button type='button' onclick='initializeDeleteDosenModal(&#39;$dosenNIP&#39;);' class='btn btn-danger'>Delete</button>
                                        <button onclick='initializeUpdateDosenModal(&#39;$primaryKey&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#dosen_manage_modal' type='button'>
                                            Update
                                        </button>
                                    </form>
                                    <form method='POST' action='admin-manageMengajar.php'>
                                        <input type='hidden' value='$dosenNIP' name='selectedDosenNIP'>
                                        <input type='hidden' value='$dosenNama' name='selectedDosenName'>
                                        <button type='submit' name='selectedNIP' class='btn waves-effect waves-light btn-dark' >Manage Mengajar</button>
                                    </form>
                                </td>
                            </tr>";
                        } //end of foreach
                        echo "
                    </table>
                </div>";
            }
            ?>
        </div>
    </div>        
</body>

<!-- Dosen Modal -->
<div class="modal fade" id="dosen_manage_modal" tabindex="-1" aria-labelledby="dosen_manage_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id='DosenModal_bodyForm'>

                    <input type="hidden" class="form-control" id="DosenModal_ActionType" name="DosenModal_ActionType">
                    <input type="hidden" class="form-control" id="DosenModal_PrimaryKey" name="DosenModal_PrimaryKey">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">NIP Dosen:</label>
                        <input type="text" class="form-control" id="DosenModal_NIP" name="DosenModal_NIP">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Nama Dosen:</label>
                        <input type="text" class="form-control" id="DosenModal_Nama" name="DosenModal_Nama">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Password Dosen:</label>
                        <input type="text" class="form-control" id="DosenModal_Password" name="DosenModal_Password">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Email Dosen:</label>
                        <input type="text" class="form-control" id="DosenModal_Email" name="DosenModal_Email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Fakultas:</label>
                        <input type="text" class="form-control" id="DosenModal_Fakultas" name="DosenModal_Fakultas">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Jurusan:</label>
                        <input type="text" class="form-control" id="DosenModal_Jurusan" name="DosenModal_Jurusan">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="submitModal();" type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>

<?php
include '././ui-component/dependenciesImport.php';
?>

</html>

<script>
    document.getElementById("adminButton").addEventListener("click", initializeAddDosenModal);

    function initializeUpdateDosenModal(primaryKey) {
        const namaDosen = document.getElementById("dosenNama_" + primaryKey).innerHTML;
        const NIPdosen = document.getElementById("dosenNIP_" + primaryKey).innerHTML;
        const passDosen = document.getElementById("dosenPass_" + primaryKey).innerHTML;
        const emailDosen = document.getElementById("dosenEmail_" + primaryKey).innerHTML;
        const fakultasDosen = document.getElementById("dosenFakultas_" + primaryKey).innerHTML;
        const jurusanDosen = document.getElementById("dosenJurusan_" + primaryKey).innerHTML;

        document.getElementById("DosenModal_ActionType").value = "Update";
        document.getElementById("DosenModal_PrimaryKey").value = primaryKey;
        document.getElementById("DosenModal_Nama").value = namaDosen;
        document.getElementById("DosenModal_NIP").value = NIPdosen;
        document.getElementById("DosenModal_Password").value = passDosen;
        document.getElementById("DosenModal_Email").value = emailDosen;
        document.getElementById("DosenModal_Fakultas").value = fakultasDosen;
        document.getElementById("DosenModal_Jurusan").value = jurusanDosen;
    }

    function initializeAddDosenModal() {
        $('#dosen_manage_modal').modal('toggle')

        document.getElementById("DosenModal_ActionType").value = "Add";
        document.getElementById("DosenModal_PrimaryKey").value = "";
        document.getElementById("DosenModal_Nama").value = "";
        document.getElementById("DosenModal_NIP").value = "";
        document.getElementById("DosenModal_Password").value = "";
        document.getElementById("DosenModal_Email").value = "";
        document.getElementById("DosenModal_Fakultas").value = "";
        document.getElementById("DosenModal_Jurusan").value = "";

    }

    function initializeDeleteDosenModal(dosenNIP) {
        document.getElementById("DosenModal_ActionType").value = "Delete";
        document.getElementById("DosenModal_PrimaryKey").value = "";
        document.getElementById("DosenModal_Nama").value = "";
        document.getElementById("DosenModal_NIP").value = dosenNIP;
        document.getElementById("DosenModal_Password").value = "";
        document.getElementById("DosenModal_Email").value = "";
        document.getElementById("DosenModal_Fakultas").value = "";
        document.getElementById("DosenModal_Jurusan").value = "";
        // console.log(primaryKey);
        submitModal()
    }

    function submitModal() {
        const modalType = document.getElementById("DosenModal_ActionType").value;
        const newNamaDosen = document.getElementById("DosenModal_Nama").value;
        const newNIPdosen = document.getElementById("DosenModal_NIP").value;
        const newpassDosen = document.getElementById("DosenModal_Password").value;
        const newemailDosen = document.getElementById("DosenModal_Email").value;
        const newfakultasDosen = document.getElementById("DosenModal_Fakultas").value;
        const newjurusanDosen = document.getElementById("DosenModal_Jurusan").value;

        if (modalType == "Add") {

            if (newNamaDosen == "" || newNIPdosen == "" || newpassDosen == "" || newemailDosen == "" || newfakultasDosen == "" || newjurusanDosen == "") {
                window.alert("Fill up the field!")
            } else {
                document.getElementById("DosenModal_bodyForm").submit();
            }

        } else if (modalType == "Update") {

            // dapatin primary key
            const primaryKey = document.getElementById("DosenModal_PrimaryKey").value;

            // pakai innetHTML karena dia dialam table, didalam html tag, di select berdasarkan primary key
            const oldNamaDosen = document.getElementById("dosenNama_" + primaryKey).innerHTML;
            const oldNIPdosen = document.getElementById("dosenNIP_" + primaryKey).innerHTML;
            const oldpassDosen = document.getElementById("dosenPass_" + primaryKey).innerHTML;
            const oldemailDosen = document.getElementById("dosenEmail_" + primaryKey).innerHTML;
            const oldfakultasDosen = document.getElementById("dosenFakultas_" + primaryKey).innerHTML;
            const oldjurusanDosen = document.getElementById("dosenJurusan_" + primaryKey).innerHTML;

            console.log("NIP dosen lama : " + oldNIPdosen);
            console.log("Nama dosen lama : " + oldNamaDosen);
            console.log("Pass dosen lama : " + oldpassDosen);
            console.log("Email dosen lama : " + oldemailDosen);
            console.log("Fakultas dosen lama : " + oldfakultasDosen);
            console.log("Jurusan dosen lama : " + oldjurusanDosen);
            console.log("NIP dosen baru : " + newNIPdosen);
            console.log("Nama dosen baru : " + newNamaDosen);
            console.log("Pass dosen baru : " + newpassDosen);
            console.log("Email dosen baru : " + newemailDosen);
            console.log("Fakultas dosen baru : " + newfakultasDosen);
            console.log("Jurusan dosen baru : " + newjurusanDosen);

            if (oldNamaDosen == newNamaDosen && oldNIPdosen == newNIPdosen && oldpassDosen == newpassDosen && oldemailDosen == newemailDosen && oldfakultasDosen == newfakultasDosen && oldjurusanDosen == newjurusanDosen ||
                newNamaDosen == "" || newNIPdosen == "" || newpassDosen == "" || newemailDosen == "" || newfakultasDosen == "" || newjurusanDosen == "") {
                iziToast.warning({
                title: 'Caution',
                message: 'Nothing changed!',
                });
            } else {
                document.getElementById("DosenModal_bodyForm").submit();
            }

        } else if (modalType == "Delete") {
            document.getElementById("DosenModal_bodyForm").submit();
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