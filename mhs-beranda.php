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
    <script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbe362NY_1XeP_q80kejQ3891jNhitXtc&callback=initMap&libraries=&v=weekly" defer></script>
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
                <h1>Content for Beranda goes here</h1>
                <!-- <input id="pac-input" class="controls" type="text" placeholder="Enter a location" /> -->
                <div id="map"></div>
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

<script>
  var infoWindow;
  var map;
  var marker;
  var polygon;
  var bounds;

  function initMap() {
    var center = new google.maps.LatLng(3.5250312, 98.6646724);
    var area = [
    { lat: 3.529934, lng: 98.663746 },
      { lat: 3.5304629, lng: 98.6712846 },
      { lat: 3.5250587, lng: 98.670648 },
      { lat: 3.5244463, lng: 98.6629224 },
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
    google.maps.event.addListenerOnce(map, "tilesloaded", function (evt) {
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

    //create button and append it into map
    const locationButton = document.createElement("button");
    locationButton.textContent = "Pan to Current Location";
    locationButton.classList.add("custom-map-control-button");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

    // add button click listener
    locationButton.addEventListener("click", () => {

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

            if (google.maps.geometry.poly.containsLocation(covertedPosition, polygon)) {
              alert("The area contains the address");
            } else {
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
      browserHasGeolocation
        ? "Error: The Geolocation service failed."
        : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
  }
</script>

<style>
  html,
  body {
    height: 50%;
    margin: 0;
    padding: 0;
  }
  #map {
    /* height: 100%; */
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