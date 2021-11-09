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
    <title>Sistem Absensi - Mata Kuliah</title>
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
            <!-- <div> Halaman Admin </div> -->
            <h1>Course Management</h1>


            <?php
            // add class
            if (isset($_POST["ClassModal_ActionType"])) {

                // var_dump($_POST["ClassModal_ActionType"]);
                // var_dump($_POST["ClassModal_PrimaryKey"]);
                // var_dump($_POST["ClassModal_Kode"]);
                // var_dump($_POST["ClassModal_Nama"]);

                if ($_POST["ClassModal_ActionType"] == "Add") {
                    include '././db-component/matkul-add.php';
                } else if ($_POST["ClassModal_ActionType"] == "Update") {
                    include '././db-component/matkul-update.php';
                } else if ($_POST["ClassModal_ActionType"] == "Delete") {
                    include '././db-component/matkul-delete.php';
                }
            }

            include '././db-component/GetAllMatkul.php';

            if (empty($AllCourseList)) {
                echo "<p>No class has been registered</p>";
            } else {

                echo "
        <div class='container-table'>
            <table class='table table-sm table-hover'>
                <thead class='thead-dark'>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Kode</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";

                foreach ($AllCourseList as $primaryKey => $value) {
                    $nomor = $primaryKey + 1;
                    $matkulKode = $value["matkul_kode"];
                    echo "
            <tr>
                <td>$nomor</td>
                <td id='matkulNama_$primaryKey'>$value[matkul_nama]</td>
                <td id='matkulkode_$primaryKey'>$value[matkul_kode]</td>
                <td style='text-align:center;'>
                    <form method='POST'>
                        <button type='button' onclick='initializeDeleteClassModal(&#39;$matkulKode&#39;);' class='btn btn-danger'>Delete</button>
                        <button onclick='initializeUpdateClassModal(&#39;$primaryKey&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#class_manage_modal' type='button'>
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

            <!-- <h1>Tambah Mata Kuliah</h1>
            <button type="button" onclick="initializeAddClassModal();" class="btn waves-effect waves-light btn-success" data-toggle="modal" data-target="#class_manage_modal">Add</button> -->

</body>

<!-- Class Modal -->
<div class="modal fade" id="class_manage_modal" tabindex="-1" aria-labelledby="class_manage_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Detail Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id='ClassModal_bodyForm'>

                    <input type="text" class="form-control" id="ClassModal_ActionType" name="ClassModal_ActionType">
                    <input type="text" class="form-control" id="ClassModal_PrimaryKey" name="ClassModal_PrimaryKey">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Kode Kelas:</label>
                        <input type="text" class="form-control" id="ClassModal_Kode" name="ClassModal_Kode">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Nama Kelas:</label>
                        <input type="text" class="form-control" id="ClassModal_Nama" name="ClassModal_Nama">
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
    document.getElementById("adminButton").addEventListener("click", initializeAddClassModal);

    function initializeUpdateClassModal(primaryKey) {
        //get value from the table row based on selected Key
        const namaKelas = document.getElementById("matkulNama_" + primaryKey).innerHTML;
        const kodeKelas = document.getElementById("matkulkode_" + primaryKey).innerHTML;

        // //set the input value in the modal
        document.getElementById("ClassModal_ActionType").value = "Update";
        document.getElementById("ClassModal_PrimaryKey").value = primaryKey;
        document.getElementById("ClassModal_Nama").value = namaKelas;
        document.getElementById("ClassModal_Kode").value = kodeKelas;
    }

    function initializeAddClassModal() {
        $('#class_manage_modal').modal('toggle')
        //set all the field to empty, because it is a frehs new modal
        document.getElementById("ClassModal_ActionType").value = "Add";
        document.getElementById("ClassModal_PrimaryKey").value = primaryKey;
        document.getElementById("ClassModal_Nama").value = "";
        document.getElementById("ClassModal_Kode").value = "";
    }

    function initializeDeleteClassModal(matkulKode) {
        document.getElementById("ClassModal_ActionType").value = "Delete";
        document.getElementById("ClassModal_PrimaryKey").value = "";
        document.getElementById("ClassModal_Nama").value = "";
        document.getElementById("ClassModal_Kode").value = matkulKode;
        // console.log(primaryKey);
        submitModal()
    }

    function submitModal() {
        const modalType = document.getElementById("ClassModal_ActionType").value;
        const newNamaKelas = document.getElementById("ClassModal_Nama").value;
        const newKodeKelas = document.getElementById("ClassModal_Kode").value;

        if (modalType == "Add") {

            // pakai value karena dia dialam <input>, kita ambil <input> dari value itu
            console.log("kode kelas baru: " + newKodeKelas);
            console.log("nama kelas baru : " + newNamaKelas);

            if (newNamaKelas == "" || newKodeKelas == "") {
                window.alert("Fill up the field!")
            } else {
                document.getElementById("ClassModal_bodyForm").submit();
            }

        } else if (modalType == "Update") {

            // dapatin primary key
            const primaryKey = document.getElementById("ClassModal_PrimaryKey").value;

            // // pakai innetHTML karena dia dialam table, didalam html tag, di select berdasarkan primary key
            const oldNamaKelas = document.getElementById("matkulNama_" + primaryKey).innerHTML;
            const oldKodeKelas = document.getElementById("matkulkode_" + primaryKey).innerHTML;

            console.log("Kode kelas lama: " + oldKodeKelas);
            console.log("Nama kelas lama: " + oldNamaKelas);
            console.log("Kode kelas baru: " + newKodeKelas);
            console.log("Nama kelas baru: " + newNamaKelas);

            if (oldNamaKelas == newNamaKelas && oldKodeKelas == newKodeKelas || newNamaKelas == "" || newKodeKelas == "") {
                window.alert("nothing changed, nothing to submit, pakai izzi toast")
            } else {
                document.getElementById("ClassModal_bodyForm").submit();
            }

        } else if (modalType == "Delete") {
            document.getElementById("ClassModal_bodyForm").submit();
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