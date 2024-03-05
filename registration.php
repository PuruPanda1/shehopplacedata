<?php
require_once "config.php";

$username = $password = $email = $conf_password = "";
$username_error = $password_error = $email_error = $cnf_password_error = "";
$error = false;

// checking for the post request
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // checking username and email and password not empty
    if (empty(trim($_POST["email"])) || empty(trim($_POST["username"])) || empty(trim($_POST["password"]))) {
        if (empty(trim($_POST["email"]))) {
            $email_error = "Email cannot be empty";
        } else if (empty(trim($_POST["username"]))) {
            $username_error = "Username cannot be empty";
        } else {
            $password_error = "Password cannot be empty";
        }
    } else {
        //  checking if the email already exists
        $email = trim($_POST["email"]);
        $sql = "SELECT * FROM `users` WHERE email='$email';";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows >= 1) {
            $email_error = "Email is already used, Kindly try to log in";
        } else {
            $username = trim($_POST["username"]);
            $email = trim($_POST["email"]);
            // checking for the password in which password cant be less than 8 digits
            if (strlen(trim($_POST['password'])) < 8) {
                $password_error = "Password cannot be less than 8";
            } else {
                $password = trim($_POST['password']);
            }
        }
    }
    if (empty($email_error) && empty($password_error) && empty($password_error)) {
        // inserting data into mysql from the html form
        $sql = "INSERT INTO `users` (`userid`,`username`, `email`, `password`, `datetime`) VALUES (NULL,'$username', '$email', '$password', current_timestamp());";
        if (mysqli_query($conn, $sql)) {
            header("location:login.php");
        } else {
            echo 'Unexpected Error';
        }
    } else {
        $error = true;
        if (!empty($email_error)) {
            echo "<script>alert('$email_error')</script>";
        } else if (!empty($password_error)) {
            echo "<script>alert('$password_error')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SheShopPlace</title>
    <!-- linking css file here-->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loginform.css">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/images/logo/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!--===============================================================================================-->
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="registration.php" method="POST">
                    <span class="login100-form-title p-b-26">
						SheShopPlace
					</span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                    <input class="input100" type="text" name="username">
                    <span class="focus-input100" data-placeholder="Username"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100" data-placeholder="Email"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            Sign Up
                        </button>
                    </div>
                </div>

                <div class="text-center p-t-115">
						<span class="txt1">
							Have an account?
						</span>

                    <a class="txt2" href="./login.php">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/bootstrap/js/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="assets/js/main.js"></script>

</body>

</html>