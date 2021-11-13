<?php
session_start();
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Alya Andira Lubis">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Sistem Absensi - Beranda</title>
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

<div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div> Halaman Dosen </div>
            <h1>Dosen Panel</h1>


            <?php

            if (isset($_POST["ClassModal_Kode"])) {
                // var_dump($_POST["ClassModal_Kode"]);
                // var_dump($_POST["ClassModal_Nama"]);

            } elseif (isset($_POST["deleteClass"])) {
                // var_dump($_POST["deleteClass"]);
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

                //belajar tentang foreach
                foreach ($AllCourseList as $key => $value) {
                    $nomor = $key + 1;
                    echo "
                            <tr>
                                <td>$nomor</td>
                                <td id='matkulNama_$key'>$value[matkul_nama]</td>
                                <td id='matkulkode_$key'>$value[matkul_kode]</td>
                                <td style='text-align:center;'>
                                    <form method='POST'>
                                        <button name='deleteClass' value='$value[matkul_kode]' class='btn btn-danger'>Delete</button>
                                        <button onclick='fillupUpdateClassModal(&#39;$key&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#update_class_modal' type='button'>
                                            Update
                                        </button>
                                    </form>
                                    
                                </td>
                            </tr>";
                } //end of foreach
                echo
                "   </tbody>
                    </table>
                </div>";
            }

            ?>
        </div>

</body>

<!-- Update Class Modal -->
<div class="modal fade" id="update_class_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="ClassModal_activeKey" value="0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Detail Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id='ClassModal_bodyForm'>
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
                <button onclick="submitUpdateClassForm();" type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</html>

<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>

<script>
    function fillupUpdateClassModal(key) {

        //get value from the table row based on selected Key
        const namaKelas = document.getElementById("matkulNama_" + key).innerHTML;
        const kodeKelas = document.getElementById("matkulkode_" + key).innerHTML;

        //set the input value in the modal
        document.getElementById("ClassModal_activeKey").value = key;
        document.getElementById("ClassModal_Nama").value = namaKelas;
        document.getElementById("ClassModal_Kode").value = kodeKelas;

    }

    function submitUpdateClassForm() {

        const activeKey = document.getElementById("ClassModal_activeKey").value;

        // pakai innetHTML karena dia dialam table, didalam html tag
        const oldNamaKelas = document.getElementById("matkulNama_" + activeKey).innerHTML;
        const oldKodeKelas = document.getElementById("matkulkode_" + activeKey).innerHTML;

        // pakai value karena dia dialam <input>, kita ambil <input> dari value itu
        const newNamaKelas = document.getElementById("ClassModal_Nama").value;
        const newKodeKelas = document.getElementById("ClassModal_Kode").value;

        // console.log("old Kode kelas : " + oldKodeKelas);
        // console.log("old Nama kelas : " + oldNamaKelas);
        // console.log("new kode kelas : " + newKodeKelas);
        // console.log("new nama kelas : " + newNamaKelas);

        if (oldNamaKelas == newNamaKelas && oldKodeKelas == newKodeKelas) {
            iziToast.warning({
                title: 'Caution',
                message: 'Nothing changed!',
                });
        } else {
            document.getElementById("ClassModal_bodyForm").submit();
        }
    }
</script>

    <?php
    include '././ui-component/dependenciesImport.php';
    ?>