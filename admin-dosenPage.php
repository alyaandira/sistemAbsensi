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
            <h1>Dosen Management</h1>


            <?php
            if (isset($_POST["DosenModal_ActionType"])) {

                var_dump($_POST["DosenModal_ActionType"]);
                var_dump($_POST["DosenModal_PrimaryKey"]);
                var_dump($_POST["DosenModal_NIP"]);
                var_dump($_POST["DosenModal_Nama"]);
                var_dump($_POST["DosenModal_Password"]);

                if ($_POST["DosenModal_ActionType"] == "Add") {
                    include '././db-component/dosen-add.php';
                    echo "<br> Add to database";
                    // TODO: database action untuk add
                } else if ($_POST["DosenModal_ActionType"] == "Update") {
                    include '././db-component/dosen-update.php';
                    echo "<br> Update to database";
                    // TODO: database action untuk update
                } else if ($_POST["DosenModal_ActionType"] == "Delete") {
                    include '././db-component/dosen-delete.php';
                    echo "<br> Delete to database";
                    // TODO: database action untuk delete
                }
            }

            include '././db-component/GetAllDosen.php';

            if (empty($FetchedDosenList)) {
                echo "<p>No class has been registered</p>";
            } else {

                echo "
        <div class='container-table'>
            <table class='table table-sm table-hover'>
                <thead class='thead-dark'>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";

                foreach ($FetchedDosenList as $primaryKey => $value) {
                    $nomor = $primaryKey + 1;
                    $dosenNIP = $value["dosen_nip"];
                    echo "
            <tr>
                <td>$nomor</td>
                <td id='dosenNama_$primaryKey'>$value[dosen_nama]</td>
                <td id='dosenNIP_$primaryKey'>$value[dosen_nip]</td>
                <td id='dosenPass_$primaryKey'>$value[dosen_password]</td>
                <td style='text-align:center;'>
                    <form method='POST'>
                        <button type='button' onclick='initializeDeleteDosenModal(&#39;$dosenNIP&#39;);' class='btn btn-danger'>Delete</button>
                        <button onclick='initializeUpdateDosenModal(&#39;$primaryKey&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#dosen_manage_modal' type='button'>
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
            <h1>Tambah Dosen</h1>
            <button type="button" onclick="initializeAddDosenModal();" class="btn waves-effect waves-light btn-success" data-toggle="modal" data-target="#dosen_manage_modal">Add</button>

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

                    <input type="text" class="form-control" id="DosenModal_ActionType" name="DosenModal_ActionType">
                    <input type="text" class="form-control" id="DosenModal_PrimaryKey" name="DosenModal_PrimaryKey">

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
                        <input type="password" class="form-control" id="DosenModal_Password" name="DosenModal_Password">
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
    function initializeUpdateDosenModal(primaryKey) {
        const namaDosen = document.getElementById("dosenNama_" + primaryKey).innerHTML;
        const NIPdosen = document.getElementById("dosenNIP_" + primaryKey).innerHTML;
        const passDosen = document.getElementById("dosenPass_" + primaryKey).innerHTML;

        document.getElementById("DosenModal_ActionType").value = "Update";
        document.getElementById("DosenModal_PrimaryKey").value = primaryKey;
        document.getElementById("DosenModal_Nama").value = namaDosen;
        document.getElementById("DosenModal_NIP").value = NIPdosen;
        document.getElementById("DosenModal_Password").value = passDosen;
    }
    
    function initializeAddDosenModal(primaryKey) {
        document.getElementById("DosenModal_ActionType").value = "Add";
        document.getElementById("DosenModal_PrimaryKey").value = primaryKey;
        document.getElementById("DosenModal_Nama").value = "";
        document.getElementById("DosenModal_NIP").value = "";
        document.getElementById("DosenModal_Password").value = "";

    }

    function initializeDeleteDosenModal (dosenNIP){
        document.getElementById("DosenModal_ActionType").value = "Delete";
        document.getElementById("DosenModal_PrimaryKey").value = "";
        document.getElementById("DosenModal_Nama").value = "";
        document.getElementById("DosenModal_NIP").value = dosenNIP;
        document.getElementById("DosenModal_Password").value = "";
        // console.log(primaryKey);
        submitModal()
    }
    
    function submitModal() {
        const modalType = document.getElementById("DosenModal_ActionType").value;
        const newNamaDosen = document.getElementById("DosenModal_Nama").value;
        const newNIPdosen = document.getElementById("DosenModal_NIP").value;
        const newpassDosen = document.getElementById("DosenModal_Password").value;

        if (modalType == "Add") {

            // pakai value karena dia dialam <input>, kita ambil <input> dari value itu
            console.log("NIP dosen baru : " + newNIPdosen);
            console.log("nama dosen baru : " + newNamaDosen);
            console.log("password dosen baru : " + newpassDosen);

            if (newNamaDosen == "" || newNIPdosen == "" || newpassDosen == "") {
                window.alert("Fill up the field!")
            } else {
                document.getElementById("DosenModal_bodyForm").submit();
            }

        } else if (modalType == "Update") {

            // dapatin primary key
            const primaryKey = document.getElementById("DosenModal_PrimaryKey").value;

            // // pakai innetHTML karena dia dialam table, didalam html tag, di select berdasarkan primary key
            const oldNamaDosen = document.getElementById("dosenNama_" + primaryKey).innerHTML;
            const oldNIPdosen = document.getElementById("dosenNIP_" + primaryKey).innerHTML;
            const oldpassDosen = document.getElementById("dosenPass_" + primaryKey).innerHTML;

            console.log("NIP dosen lama : " + oldNIPdosen);
            console.log("Nama dosen lama : " + oldNamaDosen);
            console.log("Pass dosen lama : " + oldpassDosen);
            console.log("NIP dosen baru : " + newNIPdosen);
            console.log("Nama dosen baru : " + newNamaDosen);
            console.log("Pass dosen baru : " + newpassDosen);

            if (oldNamaDosen == newNamaDosen && oldNIPdosen == newNIPdosen && oldpassDosen == newpassDosen || newNamaDosen == "" || newNIPdosen == "" || newpassDosen == "") {
                window.alert("nothing changed, nothing to submit, pakai izzi toast")
            } else {
                document.getElementById("DosenModal_bodyForm").submit();
            }

        } else if (modalType == "Delete") {
            document.getElementById("DosenModal_bodyForm").submit();
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