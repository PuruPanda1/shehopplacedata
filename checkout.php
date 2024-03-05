<?php
session_start();
//unset($_SESSION['cart']);
//sets the empty array for the cart
//$_SESSION['cart'] = [];

require "./vendor/autoload.php";

$secretKey = 'sk_test_51OIAiUSEmsOQoT091xuPrQn0rbrNopx6OTCcKIXZ31ke5xAEkrXa24TTSCHzv7p6epGB2ymm8bzTbQwPTPYAq2VS00HCJcn76t';

\Stripe\Stripe::setApiKey($secretKey);

require_once "utils/loader.php";
require_once "config.php";
require "data/model/item.php";

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

$lineItems1 = array();
$totalAmount = 0;
foreach ($itemArray as $lineItem) {
    $totalAmount = $totalAmount + $lineItem->amount;
    $tempItem = [
        "quantity" => $lineItem->quantity,
        "price_data" => [
            "currency" => "inr",
            "unit_amount" => $lineItem->amount * 100,
            "product_data" => [
                "name" => $lineItem->name
            ]
        ]
    ];
    $lineItems1[] = $tempItem;
}

$_SESSION['totalAmount'] = $totalAmount;

try {
    $checkoutSession = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/sheshopplace/sheshopplace-ecommerce-website/orderPlaced.php",
        "line_items" => $lineItems1
    ]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo $e;
}

http_response_code(303);
header("Location: " . $checkoutSession->url);



