<?php
// require_once "components/navbar.php";
if(isset($_SESSION['email'])){
    header("location:index.php");
    exit;
}
require_once "config.php";

$email = $password = "";
$email_error = $password_error = "";


if($_SERVER['REQUEST_METHOD']=='POST')
{
    // Checking for empty email id and password
    if(empty(trim($_POST['email'])) && empty(trim($_POST['password'])))
    {
        if(empty(trim($_POST['email'])))
        {
            $email_error = "Email cannot be empty";
        }
        else
        {
            $password_error = "Password cannot be empty";
        }
    }
    else
    {
        $email = trim($_POST["email"]);
        $sql = "SELECT * FROM `users` WHERE email='$email';";
        $result = mysqli_query($conn,$sql);
        // checking if the email id exits or not in the system
        if(mysqli_num_rows($result) < 1)
        {
            $email_error = "User not found, kindly register yourself";
        }
        // if user is present check for the password in else block
        else{
            $row = mysqli_fetch_assoc($result);
            if($_POST['password']!=$row['password'])
            {
                $password_error = "Wrong Password! Try again";
            }
            else
            {
                // now we can log in the user to our system
                $username = $row['username'];
                echo "$sql result data is $username";
                session_start();
                $_SESSION['email']=$email;
                $_SESSION['username']=$row['username'];
                $_SESSION['loggedin']=true;
                $_SESSION['userId'] = $row['userid'];
                header("location:index.php");
            }
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
            <form class="login100-form validate-form" action="login.php" method="POST">
					<span class="login100-form-title p-b-26">
						SheShopPlace
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
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
                            Login
                        </button>
                    </div>
                </div>

                <div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>

                    <a class="txt2" href="./registration.php">
                        Sign Up
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