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
            <th>Order ID</th>
            <th>Product</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $userId = $_SESSION['userId'];
        $sql = 'SELECT * FROM `orders` WHERE customerId="' . $userId . '";';
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        while ($num > 0) {
            $row = mysqli_fetch_assoc($result);
            $datetime = explode(" ", $row['orderDate']);
            $date = $datetime[0];
            $time = $datetime[1];
            $orderId = $row['orderId'];
            $price = $row['totalAmount'];
            $qty = 1;
            $total = $row['totalAmount'];
            $status = $row['orderStatus'];

            $getCountQuery = 'SELECT * FROM `orderitems` WHERE orderId="' . $orderId . '";';
            $countResult = mysqli_query($conn, $getCountQuery);
            $row2 = mysqli_fetch_assoc($countResult);
            $num2 = mysqli_num_rows($countResult);

            $itemName = $row2['itemName'];
            $itemCount=-1;
            while ($num2 > 0) {
                $row2 = mysqli_fetch_assoc($countResult);
                $itemCount++;
                $num2--;
            }
            if($itemCount>0){
                $productName = $itemName . " + $itemCount";
            }else{
                $productName =$itemName;
            }

            echo "
                                <tr>
                                <td>$orderId</td>
                                <td>$productName</td>
                                <td>$date</td>
                                <td>Rs. $total/-</td>
                                <td><span class='order-status $status'>$status</span></td>
                                <td><span class='order-status Completed' onclick='redirectToOrder($orderId)'>View Details</span></td>
                                </tr>
                            ";
            $num--;
        }
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
        window.location.href = `orderPage.php?orderId=` + orderId;
    }
</script>
</body>
</html>
