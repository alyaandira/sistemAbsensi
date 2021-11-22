<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Alya Andira Lubis">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Sistem Absensi - Ruang Kelas</title>

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
            <h1>Class Management</h1>

            <?php

            // add class
            if (isset($_POST["ClassModal_ActionType"])) {

                if ($_POST["ClassModal_ActionType"] == "Add") {
                    include '././db-component/ruangKelas-add.php';
                } else if ($_POST["ClassModal_ActionType"] == "Update") {
                    include '././db-component/ruangKelas-update.php';
                } else if ($_POST["ClassModal_ActionType"] == "Delete") {
                    include '././db-component/ruangKelas-delete.php';
                }
            }

            include '././db-component/GetAllClass.php';

            if (empty($AllClassList)) {
                echo "<p>No class has been registered</p>";
            } else {

                echo "
                    <div class='table-responsive'>
                        <table class='table table-sm table-hover'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th>No</th>
                                    <th>ID Kelas</th>
                                    <th>Nama Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>";

                            foreach ($AllClassList as $primaryKey => $value) {
                                $nomor = $primaryKey + 1;
                                $kelasID = $value["kelas_id"];
                                echo "
                                <tr>
                                    <td>$nomor</td>
                                    <td id='kelasID_$primaryKey'>$value[kelas_id]</td>
                                    <td id='kelasNama_$primaryKey'>$value[kelas_nama]</td>
                                    <td style='text-align:center;'>
                                    <form method='POST'>
                                        <button type='button' onclick='initializeDeleteClassModal(&#39;$kelasID&#39;);' class='btn btn-danger'>Delete</button>
                                        <button onclick='initializeUpdateClassModal(&#39;$primaryKey&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#class_manage_modal' type='button'>
                                            Update
                                        </button>
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

                    <input type="hidden" class="form-control" id="ClassModal_ActionType" name="ClassModal_ActionType">
                    <input type="hidden" class="form-control" id="ClassModal_PrimaryKey" name="ClassModal_PrimaryKey">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">ID Kelas:</label>
                        <input type="text" class="form-control" id="ClassModal_ID" name="ClassModal_ID">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Kelas:</label>
                        <input type="text" class="form-control" id="ClassModal_Nama" name="ClassModal_Nama">
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
    document.getElementById("adminButton").addEventListener("click", initializeAddClassModal);

    function initializeUpdateClassModal(primaryKey) {

        const IDKelas = document.getElementById("kelasID_" + primaryKey).innerHTML;
        const namaKelas = document.getElementById("kelasNama_" + primaryKey).innerHTML;

        document.getElementById("ClassModal_ActionType").value = "Update";
        document.getElementById("ClassModal_PrimaryKey").value = primaryKey;
        document.getElementById("ClassModal_ID").value = IDKelas;
        document.getElementById("ClassModal_Nama").value = namaKelas;
    }

    function initializeAddClassModal() {

        $('#class_manage_modal').modal('toggle')
     
        document.getElementById("ClassModal_ActionType").value = "Add";
        document.getElementById("ClassModal_PrimaryKey").value = "";
        document.getElementById("ClassModal_ID").value = "";
        document.getElementById("ClassModal_Nama").value = "";
    }

    function initializeDeleteClassModal(kelasID) {
        document.getElementById("ClassModal_ActionType").value = "Delete";
        document.getElementById("ClassModal_PrimaryKey").value = "";
        document.getElementById("ClassModal_ID").value = kelasID;
        document.getElementById("ClassModal_Nama").value = "";
        submitModal()
    }

    function submitModal() {
        const modalType = document.getElementById("ClassModal_ActionType").value;
        const newIDKelas = document.getElementById("ClassModal_ID").value;
        const newNamaKelas = document.getElementById("ClassModal_Nama").value;

        if (modalType == "Add") {

            if (newIDKelas == "" || newNamaKelas == "") {
                window.alert("Fill up the field!")
            } else {
                document.getElementById("ClassModal_bodyForm").submit();
            }

        } else if (modalType == "Update") {

            // dapatin primary key
            const primaryKey = document.getElementById("ClassModal_PrimaryKey").value;
            const oldIDKelas = document.getElementById("kelasID_" + primaryKey).innerHTML;
            const oldNamaKelas = document.getElementById("kelasNama_" + primaryKey).innerHTML;

            if (oldIDKelas == newIDKelas && oldNamaKelas == newNamaKelas || newIDKelas == "" || newNamaKelas == "") {
                iziToast.warning({
                title: 'Caution',
                message: 'Nothing changed!',
                });
            } else {
                document.getElementById("ClassModal_bodyForm").submit();
            }

        } else if (modalType == "Delete") {
            document.getElementById("ClassModal_bodyForm").submit();
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