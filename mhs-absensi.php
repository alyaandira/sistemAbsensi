<?php
session_start();
if (!isset($_SESSION["currentNIP"])) {
    header("location: login.php");
} else if (!isset($_POST["selectedMataKuliahKode"]) || !isset($_POST["selectedMataKuliahNama"])) {
    header("location: mhs-daftarMatkul.php");
} else {
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
            ?>

            <!-- Page wrapper  -->
            <div class="page-wrapper">
                <!-- Bread crumb and right sidebar toggle -->
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-7 align-self-center">
                            <h3><?php echo $_POST["selectedMataKuliahKode"] . " - " . $_POST["selectedMataKuliahNama"] ?></h1>
                                <div class="d-flex align-items-center">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb m-0 p-0">
                                            <li class="breadcrumb-item"><a href="index.html">Absensi</a>
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
                    // $tableAbsenID = $_POST["selectedAbsenID"];
                    // $tableAbsenStatus = $_POST["selectedAbsenStatus"];
                    // $tableMhsNim = $_POST["selectedMahasiswaNIM"];
                    $selectedPertKode = $_POST["selectedPertKode"];
                    var_dump($selectedPertKode);
                    $selectedMataKuliahKode = $_POST["selectedMataKuliahKode"];
                    // var_dump($selectedMataKuliahKode);

                    include './db-component/mhs-GetAvailablePertemuanBasedOnMatkul.php';
                    include './utils/dateUtils.php';
                    // echo json_encode($absensiPertemuanList);

                    if (isset($_POST["selectedPertKode"]) && isset($_POST["selectedAwalWaktu"]) && isset($_POST["selectedWaktuBatas"])) {

                        $newDate = tambahWaktu($_POST["selectedAwalWaktu"], $_POST["selectedWaktuBatas"]);

                        if (check_in_range($_POST["selectedAwalWaktu"], $newDate, date_default_timezone_get())) {
                            // include './db-component/absensi-add.php';
                            var_dump($selectedPertKode);
                        } else {
                            var_dump("2 status telat");
                        }
                    }

                    ?>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Mhs Nim</th>
                                <th scope="col">ID Kelas</th>
                                <th scope="col">Waktu Mulai</th>
                                <th scope="col">Waktu Akhir</th>
                                <th scope="col">Batas Waktu</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selectedMataKuliahKode = $_POST["selectedMataKuliahKode"];
                            $selectedMataKuliahNama = $_POST["selectedMataKuliahNama"];
                            // $tableAbsenID = $_POST["selectedAbsenID"];
                            // $tableAbsenStatus = $_POST["selectedAbsenStatus"];
                            // $tableMhsNim = $_POST["selectedMahasiswaNIM"];
                            $selectedPertKode = $_POST["selectedPertKode"];

                            foreach ($absensiPertemuanList as $absensi) {

                                $tableMhsNim = $absensi[$absensi_mhs_nim];
                                $tableAbsenID = $absensi[$absensi_id];
                                $tableAbsenStatus = $absensi[$absensi_status];
                                // var_dump ($tableMhsNim);
                                // echo"<br>";
                                // var_dump ($tableAbsenID);
                                // echo"<br>";
                                // var_dump ($tableAbsenStatus);

                                if ($tableMhsNim == $_SESSION["currentNIP"] || $tableMhsNim == Null) {

                                    $pertKode = $absensi[$pert_kode];
                                    $kelasID = $absensi[$pert_kelas_id];
                                    $dosenNIP = $absensi[$pert_dosen_nip];
                                    $awalWaktu = $absensi[$pert_waktu_mulai];
                                    $akhirWaktu = $absensi[$pert_waktu_akhir];
                                    $waktuBatas = $absensi[$pert_batas_waktu];
                                    $matkulKode = $absensi[$pert_matkul_kode];

                                    if ($absensi[$absensi_status] == null) {
                                        $displayMatkulKode = "-";
                                        if (check_in_range($awalWaktu, $akhirWaktu, date_default_timezone_get())) {
                                            $ActionRow =
                                                "<form method='POST'>
                                                    <input type='hidden' value='$selectedMataKuliahKode' name='selectedMataKuliahKode'>
                                                    <input type='hidden' value='$selectedMataKuliahNama' name='selectedMataKuliahNama'>
                                                    <input type='hidden' value='$tableMhsNim' name='selectedMahasiswaNIM'>
                                                    <input type='hidden' value='$tableAbsenID' name='selectedAbsenID'>
                                                    <input type='hidden' value='$tableAbsenStatus' name='selectedAbsenStatus'>
                                                    <input type='hidden' value='$pertKode' name='selectedPertKode'>
                                                    <input type='hidden' value='$awalWaktu' name='selectedAwalWaktu'>
                                                    <input type='hidden' value='$waktuBatas' name='selectedWaktuBatas'>
                                                    <button type='submit' value='$pertKode' class='btn waves-effect waves-light btn-dark'>
                                                        Isi Absensi
                                                    </button>
                                                 </form>";
                                        } else {
                                            $ActionRow = "-";
                                        }
                                    } else if ($absensi[$absensi_status] == 1) {
                                        $displayMatkulKode = "Hadir";
                                        $ActionRow = "-";
                                    } else if ($absensi[$absensi_status] == 2) {
                                        $displayMatkulKode = "Terlambat";
                                        $ActionRow = "-";
                                    } else {
                                        $displayMatkulKode = "undefined";
                                        $ActionRow = "-";
                                    }

                                    echo "
                                <tr>
                                    <td>$tableMhsNim</td>
                                    <td>$kelasID</td>
                                    <td>$awalWaktu</td>
                                    <td>$akhirWaktu</td>
                                    <td>$waktuBatas</td>
                                    <td>$displayMatkulKode</td>
                                    <td style='text-align:center;'>$ActionRow</td>
                                </tr>";
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
                <!-- End Container fluid  -->
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