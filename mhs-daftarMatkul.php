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
  <title>Sistem Absensi - Daftar Mata Kuliah</title>

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
    include '././ui-component/topbar-mhs.php';
    include '././ui-component/sidebar-mhs.php';
    ?>

    <!-- Page wrapper  -->
    <div class="page-wrapper">
      <!-- Container fluid  -->
      <div class="container-fluid">
        <h1>Daftar Mata Kuliah</h1>

        <?php

        include '././db-component/mhs-GetAllMatkulByNIP.php';

        if (count($RegisteredClassList) > 0) {
        ?>
          <section id="sushi-menu">
            <ul id="gallery">
              <?php
              foreach ($RegisteredClassList as $class) {
                $namaMatkul = $class[$matkul_nama];
                $kodeMatkul = $class[$matkul_kode];
                echo "
                    <li class='card'>
                        <h3 class='card-header'>$namaMatkul</h3>
                        <form method='POST' action='mhs-absensi.php'>
                          <input type='hidden' class='order-now' value='$namaMatkul' name='selectedMataKuliahNama'></button>
                          <button type='submit' class='order-now' value='$kodeMatkul' name='selectedMataKuliahKode'>Isi Absensi</button>
                        </form>
                    </li>";
              }
              ?>

            </ul>
          </section>

        <?php
        } else {
          echo "<h1>DAFTAR KELAS TERLEBIH DAHULU</h1>";
        }
        ?>

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

<style>
  /* Sushi Gallery */
  #gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 0;
    grid-auto-rows: auto;
    max-width: 950px;
    text-align: center;
    margin: 30px auto;
  }

  .card {
    position: relative;
    top: 0;
    box-sizing: border-box;
    list-style-type: none;
    background: #fefefe;
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 45px;
    margin: 10px;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;

    box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.3), 0 1px 4px rgba(0, 0, 0, 0.1);

  }

  .card:hover {
    top: -5px;
    box-shadow: 0 15px 10px -10px rgba(0, 0, 0, 0.5), 0 1px 4px rgba(0, 0, 0, 0.3);
  }

  .card-header {
    font: 700 16px "Roboto";
    text-transform: uppercase;
    margin-bottom: 6px;
    text-align: center;
  }

  .card-description {
    font: 300 14px "Roboto";
    text-align: center;
    line-height: 20px;
  }

  .order-now {
    position: relative;
    top: 0;
    left: 0;
    padding: 14px 22px;
    margin-top: 25px;
    border: 0 none;
    outline: none;
    border-radius: 50px;
    background: url(images/bluemarble.jpg) no-repeat;
    font: 700 12px "Overpass";
    color: rgb(0, 0, 0);
    text-transform: uppercase;
    cursor: pointer;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: all 150ms ease-in-out;
    transition: all 150ms ease-in-out;
  }

  .order-now:hover {
    background: #ffffff;
  }

  .image_card {
    width: 25px;
    height: 20px;
    margin-bottom: 15px;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
  }

  /* Lightbox section */
  img.mfp-img {
    height: 100px;
    width: 100px;
    padding: 100px;
    background-color: #fff;
    border-radius: 50%;
  }

  img.mfp-img:hover {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
  }

  .mfp-figure:after {
    border-radius: 50%;
  }

  .mfp-counter {
    display: none;
  }

  .mfp-title {
    font: 700 26px "Roboto";
    color: #000;
    text-align: center;
    padding-right: 0;
    position: relative;
    bottom: 375px;
  }

  /* Media queries */
  @media (max-width: 660px) {
    #gallery {
      grid-template-columns: repeat(1, 1fr);
      display: block;
      max-width: 300px;
    }
  }

  @media (max-width: 965px) {
    #gallery {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media screen and (max-width: 520px) {
    .sushi-header__header {
      font-size: 2em;
    }
  }
</style>