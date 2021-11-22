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
    <title>Sistem Absensi - Mahasiswa</title>

    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/beranda-adminstyle.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- Izi Toast -->
    <script src="src\izitoast\dist\js\iziToast.js" type="text/javascript"></script>
    <link rel="stylesheet" href="src\izitoast\dist\css\iziToast.css">

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
            <h1>Mahasiswa Management</h1>

            <?php
            if (isset($_POST["MahasiswaModal_ActionType"])) {

                if ($_POST["MahasiswaModal_ActionType"] == "Add") {
                    include '././db-component/mhs-add.php';
                } else if ($_POST["MahasiswaModal_ActionType"] == "Update") {
                    include '././db-component/mhs-update.php';
                } else if ($_POST["MahasiswaModal_ActionType"] == "Delete") {
                    include '././db-component/mhs-delete.php';
                }
            }

            include '././db-component/GetAllMahasiswa.php';

            if (empty($FetchedMahasiswaList)) {
                echo "<p>No class has been registered</p>";
            } else {

                echo "
            <div class='table-responsive'>
                <table class='table table-sm table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>NIM</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Fakultas</th>
                            <th>Jurusan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

                foreach ($FetchedMahasiswaList as $primaryKey => $value) {
                    $nomor = $primaryKey + 1;
                    $mahasiswaNIM = $value["mhs_nim"];
                    $mahasiswaNama = $value["mhs_nama"];
                    echo "
                    <tr>
                        <td>$nomor</td>
                        <td id='mahasiswaNama_$primaryKey'>$value[mhs_nama]</td>
                        <td id='mahasiswaNIM_$primaryKey'>$value[mhs_nim]</td>
                        <td id='mahasiswaPass_$primaryKey'>$value[mhs_password]</td>
                        <td id='mahasiswaEmail_$primaryKey'>$value[mhs_email]</td>
                        <td id='mahasiswaFakultas_$primaryKey'>$value[mhs_fakultas]</td>
                        <td id='mahasiswaJurusan_$primaryKey'>$value[mhs_jurusan]</td>
                        <td style='text-align:center;'>
                            <form method='POST'>
                                <button type='button' onclick='initializeDeleteMahasiswaModal(&#39;$mahasiswaNIM&#39;);' class='btn btn-danger'>Delete</button>
                                <button onclick='initializeUpdateMahasiswaModal(&#39;$primaryKey&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#mahasiswa_manage_modal' type='button'>
                                    Update
                                </button>
                            </form>
                            <form method='POST' action='admin-manageDaftar.php'>
                                <input type='hidden' value='$mahasiswaNIM' name='selectedMahasiswaNIM'>
                                <input type='hidden' value='$mahasiswaNama' name='selectedMahasiswaName'>
                                <button type='submit' name='selectedNIM' class='btn waves-effect waves-light btn-dark' >Manage Class</button>
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

<!-- Mahasiswa Modal -->
<div class="modal fade" id="mahasiswa_manage_modal" tabindex="-1" aria-labelledby="mahasiswa_manage_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id='MhsModal_bodyForm'>

                    <input type="hidden" class="form-control" id="MahasiswaModal_ActionType" name="MahasiswaModal_ActionType">
                    <input type="hidden" class="form-control" id="MahasiswaModal_PrimaryKey" name="MahasiswaModal_PrimaryKey">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">NIM Mahasiswa:</label>
                        <input type="text" class="form-control" id="MahasiswaModal_NIM" name="MahasiswaModal_NIM">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Nama Mahasiswa:</label>
                        <input type="text" class="form-control" id="MahasiswaModal_Nama" name="MahasiswaModal_Nama">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Password Mahasiswa:</label>
                        <input type="text" class="form-control" id="MahasiswaModal_Password" name="MahasiswaModal_Password">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Email Mahasiswa:</label>
                        <input type="text" class="form-control" id="MahasiswaModal_Email" name="MahasiswaModal_Email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Fakultas:</label>
                        <input type="text" class="form-control" id="MahasiswaModal_Fakultas" name="MahasiswaModal_Fakultas">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Jurusan:</label>
                        <input type="text" class="form-control" id="MahasiswaModal_Jurusan" name="MahasiswaModal_Jurusan">
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
    document.getElementById("adminButton").addEventListener("click", initializeAddMahasiswaModal);

    function initializeUpdateMahasiswaModal(primaryKey) {
        const namaMahasiswa = document.getElementById("mahasiswaNama_" + primaryKey).innerHTML;
        const NIMmahasiswa = document.getElementById("mahasiswaNIM_" + primaryKey).innerHTML;
        const passMahasiswa = document.getElementById("mahasiswaPass_" + primaryKey).innerHTML;
        const emailMahasiswa = document.getElementById("mahasiswaEmail_" + primaryKey).innerHTML;
        const fakultasMahasiswa = document.getElementById("mahasiswaFakultas_" + primaryKey).innerHTML;
        const jurusanMahasiswa = document.getElementById("mahasiswaJurusan_" + primaryKey).innerHTML;

        document.getElementById("MahasiswaModal_ActionType").value = "Update";
        document.getElementById("MahasiswaModal_PrimaryKey").value = primaryKey;
        document.getElementById("MahasiswaModal_Nama").value = namaMahasiswa;
        document.getElementById("MahasiswaModal_NIM").value = NIMmahasiswa;
        document.getElementById("MahasiswaModal_Password").value = passMahasiswa;
        document.getElementById("MahasiswaModal_Email").value = emailMahasiswa;
        document.getElementById("MahasiswaModal_Fakultas").value = fakultasMahasiswa;
        document.getElementById("MahasiswaModal_Jurusan").value = jurusanMahasiswa;
    }

    function initializeAddMahasiswaModal() {
        $('#mahasiswa_manage_modal').modal('toggle')

        document.getElementById("MahasiswaModal_ActionType").value = "Add";
        document.getElementById("MahasiswaModal_PrimaryKey").value = "";
        document.getElementById("MahasiswaModal_Nama").value = "";
        document.getElementById("MahasiswaModal_NIM").value = "";
        document.getElementById("MahasiswaModal_Password").value = "";
        document.getElementById("MahasiswaModal_Email").value = "";
        document.getElementById("MahasiswaModal_Fakultas").value = "";
        document.getElementById("MahasiswaModal_Jurusan").value = "";

    }

    function initializeDeleteMahasiswaModal(mahasiswaNIM) {
        document.getElementById("MahasiswaModal_ActionType").value = "Delete";
        document.getElementById("MahasiswaModal_PrimaryKey").value = "";
        document.getElementById("MahasiswaModal_Nama").value = "";
        document.getElementById("MahasiswaModal_NIM").value = mahasiswaNIM;
        document.getElementById("MahasiswaModal_Password").value = "";
        document.getElementById("MahasiswaModal_Email").value = "";
        document.getElementById("MahasiswaModal_Fakultas").value = "";
        document.getElementById("MahasiswaModal_Jurusan").value = "";
        submitModal()
    }

    function submitModal() {
        const modalType = document.getElementById("MahasiswaModal_ActionType").value;
        const newNamaMahasiswa = document.getElementById("MahasiswaModal_Nama").value;
        const newNIMmahasiswa = document.getElementById("MahasiswaModal_NIM").value;
        const newpassMahasiswa = document.getElementById("MahasiswaModal_Password").value;
        const newemailMahasiswa = document.getElementById("MahasiswaModal_Email").value;
        const newfakultasMahasiswa = document.getElementById("MahasiswaModal_Fakultas").value;
        const newjurusanMahasiswa = document.getElementById("MahasiswaModal_Jurusan").value;

        if (modalType == "Add") {

            if (newNamaMahasiswa == "" || newNIMmahasiswa == "" || newpassMahasiswa == "" || newemailMahasiswa == "" || newfakultasMahasiswa == "" || newjurusanMahasiswa == "") {
                window.alert("Fill up the field!")
            } else {
                document.getElementById("MhsModal_bodyForm").submit();
            }

        } else if (modalType == "Update") {

            // dapatin primary key
            const primaryKey = document.getElementById("MahasiswaModal_PrimaryKey").value;

            // // pakai innetHTML karena dia dialam table, didalam html tag, di select berdasarkan primary key
            const oldNamaMahasiswa = document.getElementById("mahasiswaNama_" + primaryKey).innerHTML;
            const oldNIMmahasiswa = document.getElementById("mahasiswaNIM_" + primaryKey).innerHTML;
            const oldpassMahasiswa = document.getElementById("mahasiswaPass_" + primaryKey).innerHTML;
            const oldemailMahasiswa = document.getElementById("mahasiswaEmail_" + primaryKey).innerHTML;
            const oldfakultasMahasiswa = document.getElementById("mahasiswaFakultas_" + primaryKey).innerHTML;
            const oldjurusanMahasiswa = document.getElementById("mahasiswaJurusan_" + primaryKey).innerHTML;

            console.log("NIP dosen lama : " + oldNIMmahasiswa);
            console.log("Nama dosen lama : " + oldNamaMahasiswa);
            console.log("Pass dosen lama : " + oldpassMahasiswa);
            console.log("NIP dosen baru : " + newNIMmahasiswa);
            console.log("Nama dosen baru : " + newNamaMahasiswa);
            console.log("Pass dosen baru : " + newpassMahasiswa);

            if (oldNamaMahasiswa == newNamaMahasiswa && oldNIMmahasiswa == newNIMmahasiswa && oldpassMahasiswa == newpassMahasiswa && oldemailMahasiswa == newemailMahasiswa && oldfakultasMahasiswa == newfakultasMahasiswa && oldjurusanMahasiswa == newjurusanMahasiswa ||
                newNamaMahasiswa == "" || newNIMmahasiswa == "" || newpassMahasiswa == "" || newemailMahasiswa == "" || newfakultasMahasiswa == "" || newjurusanMahasiswa == "") {
                iziToast.warning({
                title: 'Caution',
                message: 'Nothing changed!',
                });
            } else {
                document.getElementById("MhsModal_bodyForm").submit();
            }

        } else if (modalType == "Delete") {
            document.getElementById("MhsModal_bodyForm").submit();
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