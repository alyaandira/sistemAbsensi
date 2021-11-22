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
    <link href="./dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/beranda-adminstyle.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

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

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <h1>My Profile</h1>
                <div class="table-responsive">
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
                        </tbody>
                    </table>
                </div>    
        </div>
    </div>
</body>

<?php
include '././ui-component/dependenciesImport.php';
?>

</html>