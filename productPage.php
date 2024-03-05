<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="no-cache">
    <title>SheShopPlace - eCommerce Website</title>

    <!--
      - favicon
    -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.ico" type="image/x-icon">

    <!--
      - custom css link
    -->
    <link rel="stylesheet" href="assets/css/style-prefix.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!--    <link rel="stylesheet" href="./assets/css/main.css">-->
    <!--    <link rel="stylesheet" href="./assets/css/util.css">-->
    <!--    <link rel="stylesheet" href="./assets/css/loginform.css">-->


    <!--
      - google font link
    -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

</head>

<body>

<!--
  - HEADER
-->

<?php
session_start();
require_once "components/header.php";

require_once 'config.php';


if (isset($_GET['itemId'])) {
    $received_data = urldecode($_GET['itemId']);
    echo '<div class="product-featured">';
    echo "<div class='showcase-wrapper has-scrollbar'>";
    loadProduct($received_data);
    echo "</div>";
    echo "</div>";
}

function loadProduct($productId)
{

    global $conn;
    $query = "SELECT * FROM `items` where itemId ='" . $productId . "'";

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {

        echo "<div class='showcase-container'>";
        echo "<div class='showcase'>";
        echo "<div class='showcase-banner'>";
        echo "<img src='" . $row['itemImage'] . "' alt='shampoo, conditioner & facewash packs' class='showcase-img'>";
        echo "</div>";
        echo "<div class='showcase-content'>";
        echo "<a href='#'>";
        echo "<h3 class='showcase-title'> {$row['itemTitle']} </h3>";
        echo "</a>";
        echo "<p class='showcase-desc'>";
        echo "{$row['itemDesc']}";
        echo "</p>";
        echo "<div class='price-box'>";
        echo "<p class='price'>₹{$row['salePrice']}</p>";
        echo "<del>₹{$row['usualPrice']}</del>";
        echo "</div>";
        echo "<form action='utils/addToCart.php' method='post'>";
        echo "<input type='hidden' name='product_id' value='".$row['itemId']."'>";
        echo "<button class='add-cart-btn' type='submit'>add to cart</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }

}




?>

<!--
  - custom js link
-->
<script src="assets/js/script.js"></script>

<!--
  - ionicon link
-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>


</html>
