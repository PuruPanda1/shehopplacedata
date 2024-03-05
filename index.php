<!DOCTYPE html>
<html lang="en">

<?php
session_start()
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="no-cache">
    <title>SheShopPlace - eCommerce Website</title>

    <!--
      - favicon
    -->
    <link rel="shortcut icon" href="./assets/images/logo/favicon.ico" type="image/x-icon">

    <!--
      - custom css link
    -->
    <link rel="stylesheet" href="./assets/css/style-prefix.css">
    <link rel="stylesheet" href="./assets/css/style.css">
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
require_once "components/header.php"
?>


<!--
  - MAIN
-->

<main>

    <!--
      - BANNER
    -->

    <?php
    // require_once "components/banner.php"
    require "components/banner.php"
    ?>

    <!--
      - CATEGORY
    -->

    <?php
    require_once "components/category.php"
    ?>

    <!--
      - PRODUCT
    -->

    <?php
        require_once "components/productContainer.php"
    ?>

    <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

    <div>

        <div class="container">

            <?php
            //                require_once "components/testimonals.php"
            ?>


        </div>

    </div>


    <!--
      - BLOG -- for future if needed!
    -->

    <?php
        require_once "components/productContainer.php"
    ?>

</main>


<!--
  - FOOTER
-->

<?php
    require_once "components/footer.php"
?>

<!--
    custom functions for jumping to page!
-->

<script>
    function redirectToProductPage(itemId) {
        window.location.href = `productPage.php?itemId=`+itemId;
    }

    function redirectToCategoryPage(itemCat) {
        console.log("inside cate switch");
        window.location.href = `CategoryPage.php?cat=`+itemCat;
    }

    function redirectToCart() {
        window.location.href = `cart.php`;
    }

    function addToCart(productId, qty){
        console.log("inside add to Cart")
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.push({ id: productId, qty: qty });
        localStorage.setItem('cart', JSON.stringify(cart));
    }


</script>

<!--
  - custom js link
-->
<script src="./assets/js/script.js"></script>

<!--
  - ionicon link
-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>