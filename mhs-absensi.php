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
        <title>Sistem Absensi - Pindai Absensi</title>
        <!-- Custom CSS -->
        <link href="./assets/extra-libs/c3/c3.min.css" rel="stylesheet">
        <link href="./assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
        <link href="./assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
        <!-- Custom CSS -->
        <link href="./dist/css/style.min.css" rel="stylesheet">
        <script src="src\izitoast\dist\js\iziToast.js" type="text/javascript"></script>
        <link rel="stylesheet" href="src\izitoast\dist\css\iziToast.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbe362NY_1XeP_q80kejQ3891jNhitXtc&callback=initMap&libraries=&v=weekly" defer></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
                    include './utils/dateUtils.php';

                    if (isset($_POST["selectedPertKode"]) && isset($_POST["selectedAwalWaktu"]) && isset($_POST["selectedWaktuBatas"])) {

                        $newDate = tambahWaktu($_POST["selectedAwalWaktu"], $_POST["selectedWaktuBatas"]);

                        // dalam batas
                        if (check_in_range($_POST["selectedAwalWaktu"], $newDate, date_default_timezone_get())) {
                            $tableAbsenStatus = 1;
                            include './db-component/absensi-add.php';
                        } else {
                            $tableAbsenStatus = 2;
                            include './db-component/absensi-add.php';
                        }
                    }

                    $selectedMataKuliahKode = $_POST["selectedMataKuliahKode"];
                    include './db-component/mhs-GetAvailablePertemuanBasedOnMatkul.php';

                    ?>
                    <table class="table table-sm">
                        <thead>
                            <tr>
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
                            $currentNIP = $_SESSION["currentNIP"];
                            // echo $currentNIP;

                            foreach ($absensiPertemuanList as $absensi) {

                                $tableMhsNim = $absensi[$absensi_mhs_nim];
                                $tableAbsenID = $absensi[$absensi_id];
                                $tableAbsenStatus = $absensi[$absensi_status];

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
                                                "<form method='POST' id='absensiForm_$pertKode' >
                                                    <input type='hidden' value='$selectedMataKuliahKode' name='selectedMataKuliahKode'>
                                                    <input type='hidden' value='$selectedMataKuliahNama' name='selectedMataKuliahNama'>
                                                    <input type='hidden' value='$currentNIP' name='currentNIP'>
                                                    <input type='hidden' value='$tableMhsNim' name='selectedMahasiswaNIM'>
                                                    <input type='hidden' value='$tableAbsenID' name='selectedAbsenID'>
                                                    <input type='hidden' value='$pertKode' name='selectedPertKode'>
                                                    <input type='hidden' value='$awalWaktu' name='selectedAwalWaktu'>
                                                    <input type='hidden' value='$waktuBatas' name='selectedWaktuBatas'>
                                                    <button type='button' name='absensiButton' class='btn waves-effect waves-light btn-dark'
                                                        onclick='initializeModal(&#39;$pertKode&#39;);'
                                                        data-toggle='modal' data-target='#exampleModal'>
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

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <input type="hidden" id="pertemuanKode">
                        <input type="hidden" id="currentNIPmhs" value="<?php echo $currentNIP ?>" >

                        <h5 class="modal-title" id="exampleModalLabel">Prepare your face:D</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <button type="button" onclick="initRecognition()">Start</button> -->
                        <div id="webcam-container"></div>
                        <div id="label-container"></div>
                        <div id="map"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="modalCheckLocationButton" type="button" class="btn btn-primary">START</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <?php
        include '././ui-component/dependenciesImport.php';
        ?>
    </body>

    </html>

    <script>
        function initializeModal(pertKode) {
            // const kodePertemuan = document.getElementById(selectedPertKode).innerHTML;
            document.getElementById("pertemuanKode").value = pertKode;
        }
    </script>

    <script>
        var infoWindow;
        var map;
        var marker;
        var polygon;
        var bounds;

        function initMap() {
            var center = new google.maps.LatLng(3.5250514, 98.6646126);
            var area = [{
                    lat: 3.525087,
                    lng: 98.664528
                },
                {
                    lat: 3.525078,
                    lng: 98.664677
                },
                {
                    lat: 3.525004,
                    lng: 98.664673
                },
                {
                    lat: 3.525008,
                    lng: 98.664524
                },
            ];

            // initiliaze google map and store it to variable map
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: -34.397,
                    lng: 150.644,
                },
                zoom: 6,
            });

            bounds = new google.maps.LatLngBounds();
            google.maps.event.addListenerOnce(map, "tilesloaded", function(evt) {
                bounds = map.getBounds();
            });

            // initialize block region
            polygon = new google.maps.Polygon({
                path: area,
                geodesic: true,
                strokeColor: "#FFd000",
                strokeOpacity: 1.0,
                strokeWeight: 4,
                fillColor: "#FFd000",
                fillOpacity: 0.35,
            });
            polygon.setMap(map);

            marker = new google.maps.Marker({
                position: center,
            });
            marker.setMap(map);

            infoWindow = new google.maps.InfoWindow();

            // const locationButton = document.createElement("button");
            // locationButton.textContent = "CLICK THIS";
            // locationButton.classList.add("custom-map-control-button");
            // map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

            // add button click listener
            document.getElementById("modalCheckLocationButton").addEventListener("click", () => {

                // check does browser support geolocation 
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {

                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };

                            infoWindow.setPosition(pos);
                            infoWindow.setContent("Location found.");
                            infoWindow.open(map);
                            map.setCenter(pos);
                            marker.setPosition(pos);
                            marker.setMap(map);

                            var covertedPosition = new google.maps.LatLng(pos);
                            var pertCode = document.getElementById("pertemuanKode").value;

                            if (google.maps.geometry.poly.containsLocation(covertedPosition, polygon)) {
                                alert("The area contains the address");
                                // $("#absensiForm_" + pertCode).submit()
                                // initRecognition()
                            } else {
                                window.history.replaceState(null, null, window.location.href);
                                initRecognition()
                                // Swal.fire({
                                //     title: 'Error!',
                                //     text: 'The address is outside of the area.',
                                //     icon: 'error',
                                //     confirmButtonText: 'Maap Pak'
                                // })
                                // $("#absensiForm_" + pertCode).submit()

                                alert("The address is outside of the area.");
                            }

                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            });

            // infoWindow = new google.maps.InfoWindow();
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: The Geolocation service failed." :
                "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
    <script type="text/javascript">
        // More API functions here:
        // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image
        var successCounter = 0;

        let model, webcam, maxPredictions;

        // Load the image model and setup the webcam
        async function initRecognition() {
            const modelURL = "src/face/model.json";
            const metadataURL = "src/face/metadata.json";

            // load the model and metadata
            // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
            // or files from your local hard drive
            // Note: the pose library adds "tmImage" object to your window (window.tmImage)
            model = await tmImage.load(modelURL, metadataURL);
            totalClasses = model.getTotalClasses();

            // Convenience function to setup a webcam
            const flip = true; // whether to flip the webcam
            webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
            await webcam.setup(); // request access to the webcam
            await webcam.play();
            window.requestAnimationFrame(loop);

            // append elements to the DOM
            document.getElementById("webcam-container").appendChild(webcam.canvas);
            // labelContainer = document.getElementById("label-container");
            for (let i = 0; i < totalClasses; i++) { // and class labels
                // labelContainer.appendChild(document.createElement("div"));
            }
        }

        async function loop() {
            webcam.update(); // update the webcam frame
            await predict();
            window.requestAnimationFrame(loop);
        }

        // run the webcam image through the image model
        async function predict() {
            // predict can take in an image, video or canvas html element
            const prediction = await model.predict(webcam.canvas);
            for (let i = 0; i < totalClasses; i++) {
                const classPrediction = prediction[i].className + ": " + prediction[i].probability.toFixed(2);
                // labelContainer.childNodes[i].innerHTML = classPrediction;
                // console.log(currentNIPmhs.value);

                //TODO: ganti jadi get NIP dari modal
                if (prediction[i].className === currentNIPmhs.value) {
                    var predictionRatio = parseFloat(classPrediction.split(": ")[1]);
                    console.log(predictionRatio);

                    if (predictionRatio >= 0.90) {
                        successCounter = successCounter + 1;
                        console.log(">= 0.90");
                    }

                    if (successCounter === 30) {

                        var pertCode = document.getElementById("pertemuanKode").value;
                        $("#absensiForm_" + pertCode).submit()
                        console.log("success");
                    }
                }


            }
        }
    </script>

<?php
}
?>

<style>
    html,
    body {
        height: 50%;
        margin: 0;
        padding: 0;
    }

    #map {
        /* height: 100%; */
        display: none;
        height: 500px;
        width: 100%;
    }

    .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    .pac-container {
        font-family: Roboto;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }
</style>