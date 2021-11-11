<?php
session_start();
if (!isset($_SESSION["currentNIP"])) {
    header("location: login.php");
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
            include '././ui-component/topbar-mhs.php';
            include '././ui-component/sidebar-mhs.php';
            ?>


            <!-- Page wrapper  -->
            <div class="page-wrapper">
                <!-- Bread crumb and right sidebar toggle -->
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-7 align-self-center">
                            <!-- <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning!</h3> -->
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb m-0 p-0">
                                        <!-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a> -->
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->

                <!-- Container fluid  -->
                <div class="container-fluid">

                    <?php
                    include './db-component/mhs-GetAllAbsensi.php';
                    var_dump($AbsensiList);

                    if (count($absensiPertemuanList) == 0) {
                        echo "<p>Saat ini tidak terdaftar di kelas manapun</p>";
                    } else {
                    ?>
                        <h1><?php echo $_POST["selectedMatkulKode"] . " " . $_POST["selectedMatkulNama"] ?></h1>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">ID Absensi</th>
                                    <th scope="col">Status Absensi</th>
                                    <th scope="col">Kode Pertemuan</th>
                                    <th scope="col">NIM Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selectedKode = $_POST["selectedMatkulKode"];
                                foreach ($absensiPertemuanList as $absensi) {
                                    $absensiID = $absensi[$absensi_id];
                                    $absensiStatus = $absensi[$absensi_status];
                                    $pertKode = $absensi[$pert_kode];
                                    $mahasiswaNIM = $absensi[$mhs_nim];
                                    echo "
                                <tr>
                                    <td>$absensiID</td>
                                    <td>$absensiStatus</td>
                                    <td>$pertKode</td>
                                    <td>$mahasiswaNIM</td>
                                    <td style='text-align:center;'>
                                        <form method='POST'>
                                            <input type='hidden' name='selectedMatkulKode' value='$selectedKode' />
                                        </form>
                                    </td>
                                </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
            <!-- End Page wrapper  -->
        </div>
        <!-- End Wrapper -->

        <?php
        include '././ui-component/dependenciesImport.php';
        ?>
    </body>

    </html>



<?php
}
?>