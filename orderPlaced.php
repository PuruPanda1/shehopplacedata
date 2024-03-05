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
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<?php
require_once "config.php";
require_once "data/model/item.php";

$userId = $_SESSION['userId'];

// inserting items in the orders table
$totalAmount =$_SESSION['totalAmount'];
echo $totalAmount;
echo $userId;
$query = "INSERT INTO `orders` (`totalAmount`, `orderStatus`, `customerId`) VALUES ('$totalAmount', 'Ordered', '$userId');";
if (mysqli_query($conn, $query)) {
    $orderId = $conn->insert_id;
} else {
    echo 'Unexpected Error'. $conn->error;
}

// inserting items in the orderItems table

$itemArray = array();

$ids = $_SESSION['cart'];
$count = 0;

function addItems($productId)
{
    global $conn;
    global $itemArray;

    $query = "SELECT * FROM `items` WHERE itemId = ${productId}";

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $arrayItem = new Item($row['itemTitle'], $row['salePrice'], 1);
    }
    $itemArray[] = $arrayItem;
}

foreach ($ids as $id) {
    $count = $count + 1;
}

if ($count == 0) {
    echo 'empty cart';
} else {
    foreach ($ids as $id) {
        addItems($id);

    }
}
foreach ($itemArray as $lineItem) {
    $itemName = $lineItem->name;
    $itemAmount = $lineItem->amount;
    $query = "INSERT INTO `orderitems` (`orderId`, `itemName`, `itemPrice`) VALUES ('$orderId', '$itemName', '$itemAmount');";
    $result = mysqli_query($conn, $query);
}

$_SESSION['cart'] = [];
$_SESSION['totalAmount']=0;

?>
<div id="animation-container">
    <!-- Replace the following line with your "lottifie" animation -->
    <!--        <div style="width: 100px; height: 100px; background-color: #3498db;"></div>-->
    <p id="order-placed-text">Order Placed Successfully!</p>
    <lottie-player src="https://lottie.host/3bcec805-3d0c-4940-b80b-953213de7eed/8TqJe8vyF7.json"
                   background="transparent"
                   speed="1" autoplay></lottie-player>
</div>

<a href="index.php" id="continue-shopping-button">Continue Shopping</a>

<script>


    function redirectToHomePage() {
        window.location.href = `index.php`;
    }
</script>


</body>
</html>