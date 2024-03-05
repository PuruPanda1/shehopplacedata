<?php
session_start();
if(isset($_SESSION['adminlog'])){
    header("location:admin.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$username_error = $password_error = "";


if($_SERVER['REQUEST_METHOD']=='POST')
{
    // Checking for empty email id and password
    if(empty(trim($_POST['username'])) && empty(trim($_POST['password'])))
    {
        if(empty(trim($_POST['username'])))
        {
            $username_error = "Username cannot be empty";
        }
        else
        {
            $password_error = "Password cannot be empty";
        }
    }
    else
    {
        $username = trim($_POST["username"]);
        $sql = "SELECT * FROM `admin` WHERE admin_email='$username';";
        $result = mysqli_query($conn,$sql);
        // checking if the email id exits or not in the system
        if(mysqli_num_rows($result) < 1)
        {
            $email_error = "User not found, kindly register yourself";
        }
        // if user is present check for the password in else block
        else{
            $row = mysqli_fetch_assoc($result);
            if($_POST['password']!=$row['admin_password'])
            {
                $password_error = "Wrong Password! Try again";
            }
            else
            {
                // now we can log in the user to our system
                $_SESSION['adminusername']=$username;
                $_SESSION['adminlog']=true;
                header("location:admin.php");
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
    <title>Admin Panel Login</title>
    <!-- linking css file here-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/loginform.css">
</head>
<body>
<!-- Login Form -->
<div class="loginForm">
    <h1>Log In</h1>
    <h5 class="loginText">Enter your details here for login</h5>
    <form action="adminlogin.php" method="POST">
        <input type="text" class="user_input" placeholder="Username" name="username" id="email">
        <input type="password" class="user_input" placeholder="Password" name="password" id="password">
        <div class="buttons">
            <button type="submit" class="submit_button">Log In</button>
            <button type="reset" class="reset_button">Reset</button>
        </div>
    </form>
</div>
</body>
</html>
