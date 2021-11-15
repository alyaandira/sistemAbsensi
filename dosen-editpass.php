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
    <title>Sistem Absensi - Ubah Kata Sandi</title>

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

    <?php
    if (isset($_POST["dosen_changePassword_oldPassword"])) {
        include '././db-component/dosen-changePassword.php';
    }
    ?>

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
            <h1>Ubah Kata Sandi</h1>
            <br>

            <form method="POST">
                <input type="hidden" name="dosen_changePassword_NIP" value="<?php echo $_SESSION["currentNIP"]; ?>" />
                <input type="hidden" name="dosen_changePassword_newPassword" id="dosen_changePassword_newPassword" />

                <div class="form-group">
                    <h4>Sandi saat ini</h2>
                        <label for="message-text"><i class="col-form-label"></i></label>
                        <input type="password" name="dosen_changePassword_oldPassword" id="dosen_changePassword_oldPassword" placeholder="" />
                </div>

                <!-- <div class="form-group">
                    <h4>Kata sandi baru</h2>
                        <label for="message-text"><i class="col-form-label"></i></label>
                        <input type="password" name="dosen_changePassword_newPassword" id="dosen_changePassword_newPassword" placeholder="" />
                </div> -->

                <div class="form-group">
                    <h4>Kata sandi baru</h2>
                        <label for="message-text"><i class="col-form-label"></i></label>
                        <input type="password" name="dosen_changePassword_newPasswordConfirm" id="dosen_changePassword_newPasswordConfirm" placeholder="" />
                </div>

                <br>
                <button type="button" class="btn waves-effect waves-light btn-rounded btn-light">Batal</button>
                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success">Ubah kata sandi</button>
            </form>
        </div>
    </div>


</body>

</html>

<?php
include '././ui-component/dependenciesImport.php';
?>

</html>