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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning!</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
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
                $matkulKodePost = $_POST["selectedMataKuliah"];
                //buat data pos validation
                var_dump($matkulKodePost);
                include './db-component/mhs-GetPertemuanByAllMatkul.php';
                include './db-component/AbsensiJoinPertemuan.php';
                
                // var_dump($pertemuanList);
                var_dump($absensiPertemuanList);
                ?>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Kode Pertemuan</th>
                            <th scope="col">Kode Matkul</th>
                            <th scope="col">ID Kelas</th>
                            <th scope="col">NIP Dosen</th>
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col">Waktu Akhir</th>
                            <th scope="col">Batas Waktu</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //  <a target="" href="http://www.natures-health-foods.com/images/Sushi-RollSalmonAvacado.jpg" class="image_card">
                        //  <img src="images/bluemarble.jpg"></a>
                        foreach ($pertemuanList as $class) {
                            $pertKode = $class[$pert_kode];
                            $matkulKode = $class[$matkul_kode];
                            $kelasID = $class[$kelas_id];
                            $dosenNIP = $class[$dosen_nip];
                            $awalWaktu = $class[$waktuMulai];
                            $akhirWaktu = $class[$waktuAkhir];
                            $waktuBatas = $class[$batasWaktu];
                            $mahasiswaNIM = $class[$mhs_nim];
                            $mahasiswaNama = $class[$mhs_nama];
                            echo "
                            <tr>
                                <td>$pertKode</td>
                                <td>$matkulKode</td>
                                <td>$kelasID</td>
                                <td>$dosenNIP</td>
                                <td>$awalWaktu</td>
                                <td>$akhirWaktu</td>
                                <td>$waktuBatas</td>
                                <td style='text-align:center;'>
                                    <form method='POST' action='mhs-absensiPage.php'>
                                        <input type='hidden' value='$mahasiswaNIM' name='selectedMahasiswaNIM'>
                                        <input type='hidden' value='$mahasiswaNama' name='selectedMahasiswaName'>
                                        <button type='submit' name='selectedNIM' class='btn waves-effect waves-light btn-dark' >Manage Class</button>
                                    </form>
                                </td>
                            </tr>";
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