<?php
session_start();
require_once "config.php";
require_once "data/model/item.php";

$userId = $_SESSION['userId'];

// inserting items in the orders table
$totalAmount =$_SESSION['totalAmount'];
echo $totalAmount;
echo $userId;
$query = "INSERT INTO `orders` (`totalAmount`, `orderStatus`, `customerId`) VALUES ('$totalAmount', 'Ordered', '$userId');";
if (mysqli_query($conn, $query)) {
    echo "Payment Successful";
    $orderId = $conn->insert_id;
    echo $orderId;
} else {
    echo 'Unexpected Error'. $conn->error;
}
//unset($_SESSION['totalAmount']);

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

