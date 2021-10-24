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
        include '././ui-component/topbar.php';
        include '././ui-component/sidebar.php';
        // include '././db-component/GetAllDosen.php';
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
                        <td>NIM</td>
                        <td><?php echo $_SESSION["currentNIP"] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $_SESSION["currentEmail"] ?></td>
                    </tr>
                    <tr>
                        <td>Fakultas</td>
                        <td><?php echo $_SESSION["currentFakultas"] ?></td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td><?php echo $_SESSION["currentJurusan"] ?></td>
                    </tr>
                    <!-- <tr>
                        <td><?php echo $_SESSION["currentUsername"] ?></td>
                        <td><?php echo $_SESSION["currentNIP"] ?></td>
                        <td><?php echo $_SESSION["currentEmail"] ?></td>
                        <td><?php echo $_SESSION["currentFakultas"] ?></td>
                        <td><?php echo $_SESSION["currentJurusan"] ?></td>
                    </tr> -->
                </tbody>
            </table>
            <!-- <?php echo $_SESSION["currentUsername"] . "<br>" . $_SESSION["currentNIP"] . "<br>" . $_SESSION["currentPassword"] . "<br>" . $_SESSION["currentEmail"]; ?> -->
            <br>
            <!-- <button type="button" class="btn waves-effect waves-light btn-dark">Ubah Profil</button> -->
        </div>
    </div>
</body>

</html>

<?php
include '././ui-component/dependenciesImport.php';
?>

</html>