<?php
session_start();
session_unset();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance System</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <script src="src\izitoast\dist\js\iziToast.js" type="text/javascript"></script>
    <link rel="stylesheet" href="src\izitoast\dist\css\iziToast.css">

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>

    <?php
    if (isset($_POST["user_name"])) {

        if (isset($_POST["user_type"])) {

            if ($_POST["user_type"] == "Mahasiswa") {
                include '.\.\db-component\mhs-login.php';
            } elseif ($_POST["user_type"] == "Dosen") {
                include '.\.\db-component\dosen-login.php';
            } elseif ($_POST["user_type"] == "Admin") {
                include '.\.\db-component\admin-login.php';
                var_dump("include alien");
            }
        } else {
            echo "select user type (ubah ini jadi izitoast)";
        }
    }
    ?>
    <!-- <img src="./source/image/image.jpg" alt=""> -->
    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <!-- <a href="#" class="signup-image-link">Create an account</a> -->
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Log In</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="user_name" id="your_name" placeholder="NIP" />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="user_pass" id="your_pass" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <input type="radio" id="radio_mhs" name="user_type" value="Mahasiswa">
                                <label for="radio_mhs">Mahasiswa</label><br>
                            </div>
                            <div class="form-group">

                                <input type="radio" id="radio_dosen" name="user_type" value="Dosen">
                                <label for="radio_dosen">Dosen</label><br>
                            </div>

                            <div class="form-group">

                                <input type="radio" id="radio_admin" name="user_type" value="Admin">
                                <label for="radio_admin">Admin</label><br>
                            </div>

                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>