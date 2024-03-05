<?php
session_start();
//unset($_SESSION['cart']);
//sets the empty array for the cart
$_SESSION['cart'] = [];
$_SESSION['totalAmount']=0;
exit();
