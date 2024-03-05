<?php
// mysql Connection work
$server = "localhost";
$username = "root";
$password = "";
// creating a connection
$conn = mysqli_connect($server,$username,$password,"login");
if(!$conn)
{
    die("Error! Cannot connect to database".mysqli_connect_error());
//    $sql = "INSERT INTO `users` (`id`,`username`, `email`, `password`, `datetime`) VALUES (NULL,'PurabModi', 'purabmodi1992@gmail.com', '12345678', current_timestamp());";
//    $result = mysqli_query($conn,$sql);
}
?>