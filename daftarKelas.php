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
  <meta name="author" content="Alyen Andiren">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
  <title>Sistem Absensi - Pindai Absensi</title>
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
      <!-- Container fluid  -->
      <div class="container-fluid">
        <h1>Content for scan attendance goes here</h1>

        <?php

        include '././db-component/GetAllClassByNIP.php';

        if (count($RegisteredClassList) > 0) {
        ?>
          <section id="sushi-menu">
            <ul id="gallery">
              <?php
              //  <a target="" href="http://www.natures-health-foods.com/images/Sushi-RollSalmonAvacado.jpg" class="image_card">
              //  <img src="images/bluemarble.jpg"></a>
              foreach ($RegisteredClassList as $class) {
                $namaMatkul = $class[$matkul_nama];
                $kodeMatkul = $class[$matkul_kode];
                echo "
                    <li class='card'>
                        <h3 class='card-header'>$namaMatkul</h3>
                        <p class='card-description'>Hari<br> 08.00-10.30</p>
                        <form method='POST' action='pindaiAbsensi.php'>
                          <button type='submit' class='order-now' value='$kodeMatkul' name='btn-select-kelas'>Isi Absensi</button>
                        </form>
                    </li>";
              }
              ?>

            </ul>
          </section>

        <?php
        } else {
          echo "<h1>DAFTAR KELAS DLU BARU ABSEN !</h1>";
        }
        ?>
        <div>Teachable Machine Image Model</div>
        <button type="button" onclick="init()">Start</button>
        <div id="webcam-container"></div>
        <div id="label-container"></div>
        <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
        <script type="text/javascript">
          // More API functions here:
          // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image


          let model, webcam, labelContainer, maxPredictions;

          // Load the image model and setup the webcam
          async function init() {
            const modelURL = "src/face/model.json";
            const metadataURL = "src/face/metadata.json";

            // load the model and metadata
            // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
            // or files from your local hard drive
            // Note: the pose library adds "tmImage" object to your window (window.tmImage)
            model = await tmImage.load(modelURL, metadataURL);
            maxPredictions = model.getTotalClasses();

            // Convenience function to setup a webcam
            const flip = true; // whether to flip the webcam
            webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
            await webcam.setup(); // request access to the webcam
            await webcam.play();
            window.requestAnimationFrame(loop);

            // append elements to the DOM
            document.getElementById("webcam-container").appendChild(webcam.canvas);
            labelContainer = document.getElementById("label-container");
            for (let i = 0; i < maxPredictions; i++) { // and class labels
              labelContainer.appendChild(document.createElement("div"));
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
            for (let i = 0; i < maxPredictions; i++) {
              const classPrediction =
                prediction[i].className + ": " + prediction[i].probability.toFixed(2);
              labelContainer.childNodes[i].innerHTML = classPrediction;
            }
          }
        </script>

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

<script>
  $(".image").magnificPopup({
    type: "image",
    removalDelay: 300,

    gallery: {
      enabled: true,
      preload: [0, 2]
    }
  });

  $(document).ready(function() {
    var $orderNowBtn = $(".order-now");
    var $card = $(".card");

    $orderNowBtn.on("click", function() {
      $(this).parent($card).css("transform", "rotateY(180deg)");
    });

    console.log('hi');
  });
  // () => {
  //     var value = $(this).val()
  //     console.log(value);
  //   }
  // $(".btn-select-kelas").click(
  //   console.log("test")
  // );


  // $(".btn-select-kelas").click(function() {
  //   window.alert("Handler for .click() called.");
  // });

  // const selectBtn = () => {
  //   window.alert("Handler for .click() called.");
  // }

  // function SelectMatkul(kodeMatkul) {
  //   console.log(valaa)
  // }

//   $('.btn-select-kelas').on('click', function() {
//     // var val = $(this).prev().val();
//     console.log('hi');

// });
</script>