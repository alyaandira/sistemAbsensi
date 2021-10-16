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
        include '././ui-component/topbar-admin.php';
        include '././ui-component/sidebar-admin.php';
        ?>

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div> Halaman Admin </div>
            <h1>Mahasiswa Management</h1>


            <?php
            if (isset($_POST["MahasiswaModal_ActionType"])) {

                // var_dump($_POST["MahasiswaModal_ActionType"]);
                // var_dump($_POST["MahasiswaModal_PrimaryKey"]);
                // var_dump($_POST["MahasiswaModal_NIM"]);
                // var_dump($_POST["MahasiswaModal_Nama"]);
                // var_dump($_POST["MahasiswaModal_Password"]);
                // var_dump($_POST["MahasiswaModal_Email"]);
                // var_dump($_POST["MahasiswaModal_Fakultas"]);
                // var_dump($_POST["MahasiswaModal_Jurusan"]);

                if ($_POST["MahasiswaModal_ActionType"] == "Add") {
                    include '././db-component/mhs-add.php';
                    echo "<br> Add to database";
                    // TODO: database action untuk add
                } else if ($_POST["MahasiswaModal_ActionType"] == "Update") {
                    include '././db-component/mhs-update.php';
                    echo "<br> Update to database";
                    // TODO: database action untuk update
                } else if ($_POST["MahasiswaModal_ActionType"] == "Delete") {
                    include '././db-component/mhs-delete.php';
                    echo "<br> Delete to database";
                    // TODO: database action untuk delete
                }
            }

            include '././db-component/GetAllMahasiswa.php';

            if (empty($FetchedMahasiswaList)) {
                echo "<p>No class has been registered</p>";
            } else {

                echo "
        <div class='container-table'>
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
                    
                </td>
            </tr>";
                } //end of foreach
                echo "</table>";
            }
            ?>

            <br>
            <h1>Tambah Mahasiswa</h1>
            <button type="button" onclick="initializeAddMahasiswaModal();" class="btn waves-effect waves-light btn-success" data-toggle="modal" data-target="#mahasiswa_manage_modal">Add</button>

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

                    <input type="text" class="form-control" id="MahasiswaModal_ActionType" name="MahasiswaModal_ActionType">
                    <input type="text" class="form-control" id="MahasiswaModal_PrimaryKey" name="MahasiswaModal_PrimaryKey">

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
                        <input type="password" class="form-control" id="MahasiswaModal_Password" name="MahasiswaModal_Password">
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


<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>


<script>
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

    function initializeAddMahasiswaModal(primaryKey) {
        document.getElementById("MahasiswaModal_ActionType").value = "Add";
        document.getElementById("MahasiswaModal_PrimaryKey").value = primaryKey;
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
        // console.log(primaryKey);
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

            // pakai value karena dia dialam <input>, kita ambil <input> dari value itu
            console.log("NIM mahasiswa baru : " + newNIMmahasiswa);
            console.log("nama mahasiswa baru : " + newNamaMahasiswa);
            console.log("password mahasiswa baru : " + newpassMahasiswa);

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
                window.alert("nothing changed, nothing to submit, pakai izzi toast")
            } else {
                document.getElementById("MhsModal_bodyForm").submit();
            }

        } else if (modalType == "Delete") {
            document.getElementById("MhsModal_bodyForm").submit();
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

<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>