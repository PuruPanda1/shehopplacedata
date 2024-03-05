<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['id_array'] = array();
    }

    // Add the selected product to the cart
    $_SESSION['cart'][] = $productId;

//    foreach ($_SESSION['cart'] as $item) {
//        echo "<br>" . $item;
//    }
    header("Location: ../index.php");
    exit();
}
?>