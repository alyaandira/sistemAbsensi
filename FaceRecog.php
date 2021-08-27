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
  <meta name="author" content="Alyen Andira">
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
</script>