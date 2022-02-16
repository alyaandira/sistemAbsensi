<?php
session_start();
if (!isset($_SESSION["currentNIP"])) {
    header("location: index.php");
} else if (!isset($_POST["selectedDosenNIP"])) {
    header("location: admin-dosenPage.php");
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
        <title>Sistem Absensi - Dosen - Mengajar</title>
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

        <!-- floating action button -->
        <div class="adminActions" id="adminButton">
            <input type="checkbox" name="adminToggle" class="adminToggle" />
            <a class="adminButton" href="#!">+</a>
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

                <?php

                if (isset($_POST["matkulModal_mengajar_matkulKode"])) {
                    // $matkulModal_mengajar_matkulKode = $_POST["matkulModal_mengajar_matkulKode"];
                    // $input_dosen_nip = $_POST["selectedDosenNIP"];
                    // var_dump($_POST["matkulModal_mengajar_matkulKode"]);
                    // var_dump($input_dosen_nip);
                    include '././db-component/mengajar-add.php';
                }

                if (isset($_POST["delete_mengajar"])) {
                    include '././db-component/mengajar-delete.php';
                    // $matkulModal_daftar_matkulKode = $_POST["matkulModal_daftar_matkulKode"];
                    // var_dump($matkulModal_daftar_matkulKode);
                    var_dump($_POST["delete_mengajar"]);
                }

                ?>
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <h1> <?php

                            if (!isset($_POST["selectedDosenName"])) {
                                echo "No name retrieved";
                            } else {
                                echo $_POST["selectedDosenName"];
                            }

                            ?> </h1>

                    <?php
                    include './db-component/admin-GetMatkulByMengajar.php';
                    include './db-component/GetAllMatkul.php';
                    // var_dump($AllCourseList);
                    // var_dump($matkulTerdaftarList);

                    $selectedNIP = $_POST["selectedDosenNIP"];
                    $selectedName = $_POST["selectedDosenName"];

                    if (count($matkulTerdaftarList) == 0) {
                        echo "<p>Saat ini tidak terdaftar di kelas manapun</p>";
                    } else {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Mata Kuliah</th>
                                    <th scope="col">Nama Mata Kuliah</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($matkulTerdaftarList as $matkul) {
                                    $mengajarID = $matkul[$mengajar_id];
                                    $matkulKode = $matkul[$matkul_kode];
                                    $matkulNama = $matkul[$matkul_nama];
                                    echo "
                                <tr>
                                    <td>$matkulKode</td>
                                    <td>$matkulNama</td>
                                    <td style='text-align:center;'>
                                        <form method='POST'>
                                            <input type='hidden' name='selectedDosenName' value='$selectedName' />
                                            <input type='hidden' name='selectedDosenNIP' value='$selectedNIP' />
                                            <button type='submit' value='$mengajarID' name='delete_mengajar' class='btn btn-danger'>Delete</button>
                                        </form>
                                    </td>
                                </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>    
                    <?php } ?>

                    <?php

                    for ($i = 0; $i < count($AllCourseList); $i++) {
                        for ($j = 0; $j < count($matkulTerdaftarList); $j++) {
                            if ($AllCourseList[$i]["matkul_kode"] == $matkulTerdaftarList[$j]["matkul_kode"]) {
                                unset($AllCourseList[$i]);
                                break;
                            } else {
                            }
                        }
                    }

                    // encode -> array or object into string
                    // decode -> string into array or object
                    // echo json_encode($AllCourseList);

                    ?>
                </div>
            </div>
            <!-- End Page wrapper  -->
        </div>
        <!-- End Wrapper -->

        <?php
        include '././ui-component/dependenciesImport.php';
        ?>
    </body>


    <div class="modal fade" id="dosenMengajar_manage_modal" tabindex="-1" aria-labelledby="dosenMengajar_manage_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id='ClassModal_bodyForm'>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" value="<?php echo $selectedNIP ?>" name="selectedDosenNIP">
                        <input type="hidden" class="form-control" value="<?php echo $selectedName ?>" name="selectedDosenName">

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Daftar Mata Kuliah:</label>
                            <select class="form-control form-control-lg" name="matkulModal_mengajar_matkulKode">
                                <?php
                                foreach ($AllCourseList as $course) {
                                    $course_matkulKode = $course["matkul_kode"];
                                    $course_matkulNama = $course["matkul_nama"];
                                    $value_to_display = $course_matkulKode . " - " . $course_matkulNama;

                                    echo '<option value="' . $course_matkulKode . '">' . $value_to_display . '</option>';

                                    // echo '<option value="'.$postResult["page_id"].'">'.$postResult["name"].'</option>';
                                    // echo "<option>$value_to_display</option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" value="load page" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </html>
<?php
}
?>

<script>
    document.getElementById("adminButton").addEventListener("click", initializeAddMatkulMengajarModal);

    function initializeAddMatkulMengajarModal() {

        $('#dosenMengajar_manage_modal').modal('toggle')
    }

</script>

<style>
    body {
        background-color: #f5f5f5;
    }

    .adminActions {
        position: fixed;
        bottom: 45px;
        right: 55px;
        z-index: 10;
    }

    .adminButton {
        background-color: rgba(67, 83, 143);
        border-radius: 50%;
        display: block;
        color: #fff;
        text-align: center;
        position: relative;
        text-decoration: none;
        padding: 25px 30px;
    }

    .adminButton i {
        font-size: 22px;
    }

    .adminToggle {
        -webkit-appearance: none;
        position: absolute;
        border-radius: 50%;
        top: 0;
        left: 0;
        margin: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        background-color: transparent;
        border: none;
        outline: none;
        z-index: 2;
        transition: box-shadow 0.2s ease-in-out;
        box-shadow: 0 3px 5px 1px rgba(51, 51, 51, 0.3);
    }

    .adminToggle:hover {
        box-shadow: 0 3px 6px 2px rgba(51, 51, 51, 0.3);
    }

    .adminToggle:checked~.adminButtons a {
        opacity: 1;
        visibility: visible;
    }
</style>