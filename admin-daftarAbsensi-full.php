<?php
session_start();
?>

    <!DOCTYPE html>
    <html dir="ltr" lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Alya Andira Lubis">

        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
        <title>Sistem Absensi - Daftar Absensi</title>

        <!-- Custom CSS -->
        <link href="./dist/css/style.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./css/beranda-adminstyle.css">

        <!--Bootstrap CSS -->
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
            include '././ui-component/topbar-admin.php';
            include '././ui-component/sidebar-admin.php';
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
                    include './db-component/admin-GetAbsensiByPertemuan-full.php';
                    // var_dump($matkulTerdaftarList);
                    ?>
                    <h1> DAFTAR ABSENSI </h1>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Waktu Mulai</th>
                                    <th scope="col">Waktu Akhir</th>
                                    <th scope="col">Status Mahasiswa</th>
                                    <th scope="col">Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($absenTerdaftarList as $class) {
                                    $pertKode = $class[$pert_kode];
                                    $matkulKode = $class[$pert_matkul_kode];
                                    $kelasID = $class[$pert_kelas_id];
                                    $dosenNIP = $class[$pert_dosen_nip];
                                    $waktuMulai = $class[$pert_waktu_mulai];
                                    $waktuAkhir = $class[$pert_waktu_akhir];
                                    $batasWaktu = $class[$pert_batas_waktu];
                                    $matkulKode = $class[$pert_matkul_kode];
                                    $matkulNama = $class[$matkul_nama];
                                    $kelasID = $class[$pert_kelas_id];
                                    $kelasNama = $class[$ruangkelas_nama];
                                    $dosenNIP = $class[$pert_dosen_nip];
                                    $dosenNama = $class[$dosen_nama];
                                    $dosenPass = $class[$dosen_password];
                                    $dosenEmail = $class[$dosen_email];
                                    $dosenFakultas = $class[$dosen_fakultas];
                                    $dosenJurusan = $class[$dosen_jurusan];
                                    $absensiID = $class[$absensi_id];
                                    $absensiStatus = $class[$absensi_status];
                                    $mahasiswaNIM = $class[$absensi_mhs_nim];
                                    $pertKode = $class[$pert_kode];
                                    echo "
                                <tr>
                                    <td>$pertKode</td>
                                    <td>$matkulKode</td>
                                    <td>$kelasID</td>
                                    <td>$dosenNIP</td>
                                    <td>$waktuMulai</td>
                                    <td>$waktuAkhir</td>
                                    <td>$batasWaktu</td>
                                    <td>$matkulKode</td>
                                    <td>$matkulNama</td>
                                    <td>$kelasID</td>
                                    <td>$kelasNama</td>
                                    <td>$dosenNIP</td>
                                    <td>$dosenNama</td>
                                    <td>$dosenPass</td>
                                    <td>$dosenEmail</td>
                                    <td>$dosenFakultas</td>
                                    <td>$dosenJurusan</td>
                                    <td>$absensiStatus</td>
                                    <td>$mahasiswaNIM</td>
                                    <td>$pertKode</td>
                                </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>    
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