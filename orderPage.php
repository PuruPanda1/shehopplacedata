<?php
session_start();
?>
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
    <link rel="shortcut icon" href="./assets/images/logo/favicon.ico" type="image/x-icon">
    <!--
      - custom css link
    -->
    <link rel="stylesheet" href="./assets/css/style-prefix.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/myOrders.css">
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
<?php
require_once "components/header.php";
require_once "config.php";
?>
<header class="myordertext">
    <h1>My Orders</h1>
</header>

<section>
    <table>
        <thead>
        <tr>
            <th>Item Id</th>
            <th>Product</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_GET['orderId'])) {
            $orderId = urldecode($_GET['orderId']);
        }
        $userId = $_SESSION['userId'];
        $sql = 'SELECT * FROM `orderitems` WHERE orderId="' . $orderId . '";';
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        $total  =0;
        while ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $itemId = $row['itemId'];
            $productName = $row['itemName'];
            $price = $row['itemPrice'];
            $total = $total + $price;
            $qty = 1;

            echo "
                                <tr>
                                <td>$itemId</td>
                                <td>$productName</td>
                                <td>$price</td>
                                </tr>
                            ";
            $num--;
        }
        echo "
                                <tr>
                                <td>Total</td>
                                <td></td>
                                <td>$total</td>
                                </tr>
                            ";
        ?>
        </tbody>
    </table>
</section>

<!--
  - ionicon link
-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    function redirectToOrder(orderId) {
        window.location.href = `productPage.php?itemId=`+orderId;
    }
</script>
</body>
</html>
