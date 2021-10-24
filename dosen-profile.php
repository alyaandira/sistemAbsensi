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
    <title>Sistem Absensi - Profil</title>
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
        // include '././db-component/dosen-update.php';
        // $dosenEmail = $value["dosen_email"];
        ?>

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <h1>My Profile</h1>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td><?php echo $_SESSION["currentUsername"] ?></td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td><?php echo $_SESSION["currentNIP"] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $_SESSION["currentEmail"] ?>
                            <!-- <button onclick="updateEmail($dosenEmail);" type="button" class="btn btn-success btn-circle-lg" data-toggle="modal" data-target="#dosen_update_email"><i class="fa fa-edit"></i> </button> -->
                        </td>
                    </tr>
                    <tr>
                        <td>Fakultas</td>
                        <td><?php echo $_SESSION["currentFakultas"] ?></td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td><?php echo $_SESSION["currentJurusan"] ?></td>
                    </tr>
                </tbody>
            </table>
            <!-- <?php echo $_SESSION["currentUsername"] . "<br>" . $_SESSION["currentNIP"] . "<br>" . $_SESSION["currentPassword"] . "<br>" . $_SESSION["currentEmail"]; ?> -->
        </div>
    </div>
</body>

<div class="modal fade" id="dosen_update_email" tabindex="-1" aria-labelledby="dosen_update_email" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id='DosenModal_bodyForm'>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email Lama:</label>
                        <input type="text" class="form-control" id="DosenModal_Email" name="DosenModal_Email" placeholder="<?php echo $_SESSION["currentEmail"] ?>">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Email Baru:</label>
                        <input type="text" class="form-control" id="DosenModal_Email" name="DosenModal_Email">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>

<script>
    function updateEmail(dosenEmail) {
        const emailDosen = document.getElementById("dosenEmail_" + primaryKey).innerHTML;
        document.getElementById("DosenModal_Email").value = emailDosen;
    }

    function submitModal() {
        const newemailDosen = document.getElementById("DosenModal_Email").value;
        const oldemailDosen = document.getElementById("dosenEmail_" + primaryKey).innerHTML;

        console.log("Email dosen lama : " + oldemailDosen);
        console.log("Email dosen baru : " + newemailDosen);

        if (oldemailDosen == newemailDosen && oldfakultasDosen || newemailDosen == "") {
            window.alert("nothing changed, nothing to submit")
        } else {
            document.getElementById("DosenModal_bodyForm").submit();
        }
    }
</script>
<?php
include '././ui-component/dependenciesImport.php';
?>

</html>