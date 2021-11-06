<?php
session_start();
if (!isset($_SESSION["currentNIP"])) {
    header("location: login.php");
} else if (!isset($_POST["selectedMahasiswaNIM"])) {
    header("location: pindaiAbsensi.php");
} else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Alya Andira Lubis">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
        <title>Sistem Absensi - Ubah Pertemuan</title>
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
    
</body>
</html>



<?php
}
?>