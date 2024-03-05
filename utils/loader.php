<?php
require_once 'config.php';

function loadBanner()
{
    global $conn;

    $query = 'SELECT * FROM `banner`';

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='slider-item'>";
        echo "<img src='" . $row['bannerImage'] . "' alt='women latest fashion sale' class='banner-img'>";
        echo "<div class='banner-content'>";
        echo "<p class='banner-subtitle'>{$row['bannerSubtitle']}</p>";
        echo "<h2 class='banner-title'>{$row['bannerTitle']}</h2>";
        echo "<p class='banner-text'>";
        echo "starting at ₹ <b>{$row['bannerPrice']}</b>";
        echo "</p>";
        echo "<a href={$row['bannerUrl']} class='banner-btn'>Shop now</a>";
        echo "</div>";
        echo "</div>";
    }

}

function loadCategory()
{
    global $conn;

    $query = 'SELECT * FROM `category`';

    $result = $conn->query($query);


    while ($row = $result->fetch_assoc()) {

        $cat = $row['categoryTitle'];
        echo "<div class='category-item' onclick='redirectToCategoryPage(".$row['categoryId'].")'>";
        echo "<div class='category-img-box'>";
        echo "<img src='" . $row['categoryImage'] . "' alt='dress & frock' width='30'>";
        echo "</div>";
        echo "<div class='category-content-box'>";
        echo "<div class='category-content-flex'>";
        echo "<h3 class='category-item-title'>{$row['categoryTitle']}</h3>";
        echo "<p class='category-item-amount'>({$row['categoryNumber']})</p>";
        echo "</div>";
        echo "<a href={$row['categoryUrl']} class='category-btn'>Show all</a>";
        echo "</div>";
        echo "</div>";

    }

}

function loadFashionCat()
{

    global $conn;

    $query = 'SELECT * FROM `fashioncat`';

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-showcase'>";
        echo "<h2 class='title'>{$row['catName']}</h2>";
        echo "<div class='showcase-wrapper has-scrollbar'>";
        echo "<div class='showcase-container'>";
        loadItemSmall($row['catName']);
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}

function loadItemSmall($itemCat)
{

    global $conn;

    $query = "SELECT * FROM `items` where itemCat ='" . $itemCat . "'";

    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        echo "<div class='showcase' onclick='redirectToProductPage(" . $row['itemId'] . ")'>";
        echo "<a href='#' class='showcase-img-box'>";
        echo "<img src='" . $row['itemImage'] . "'alt='relaxed short full sleeve t-shirt' width='70' class='showcase-img'>";
        echo "</a>";
        echo "<div class='showcase-content'>";
        echo "<a href='#'>";
        echo "<h4 class='showcase-title'>{$row['itemTitle']}</h4>";
        echo "</a>";
        echo "<a href='#' class='showcase-category'>Clothes</a>";
        echo "<div class='price-box'>";
        echo "<p class='price'>₹{$row['salePrice']}</p>";
        echo "<del>₹{$row['usualPrice']}</del>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}

function loadFeaturedProduct()
{

    global $conn;

    $query = "SELECT * FROM `items` ORDER BY itemId DESC LIMIT 3";

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {

        echo "<div class='showcase-container' >";
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
        echo "<input type='hidden' name='product_id' value='" . $row['itemId'] . "'>";
        echo "<button class='add-cart-btn' type='submit'>add to cart</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }

}

function loadNewProducts()
{
    $count = 12;

    global $conn;

    $query = "SELECT * FROM `items` ORDER BY itemId DESC LIMIT $count";

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {

        echo "<div class='showcase' onclick='redirectToProductPage(" . $row['itemId'] . ")'>";
        echo "<div class='showcase-banner'>";
        echo "<img src='" . $row['itemImage'] . "' alt='Mens Winter Leathers Jackets' width='300' class='product-img default'>";
        echo "<img src='" . $row['itemImage'] . "' alt='Mens Winter Leathers Jackets' width='300' class='product-img hover'>";
        echo "</div>";
        echo "<div class='showcase-content'>";
        echo "<a href='#' class='showcase-category'>${row['itemType']}</a>";
        echo "<a href='#'>";
        echo "<h3 class='showcase-title'>${row['itemTitle']}</h3>";
        echo "</a>";
        echo "<div class='price-box'>";
        echo "<p class='price'>₹${row['salePrice']}</p>";
        echo "<del>₹${row['usualPrice']}</del>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }


}

function loadProduct($productId)
{

    global $conn;

    $query = "SELECT * FROM `items` WHERE itemId = ${productId}";

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
        echo "<button class='add-cart-btn'>add to cart</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }

}


function loadItemInCart($productId)
{

    global $conn;

    $query = "SELECT * FROM `items` WHERE itemId = ${productId}";

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {

        echo "<div class='flex justify-between items-center mt-6 pt-6'>";
        echo "<div class='flex  items-center'>";
        echo "<img src='".$row['itemImage']."' width='60' class='rounded-full '>";
        echo "<div class='flex flex-col ml-3'>";
        echo "<span class='md:text-md font-medium'>${row['itemTitle']}</span>";
        echo "</div>";
        echo "</div>";
        echo "<div class='flex justify-center items-center'>";
        echo "<div class='pr-8 '>";
        echo "<span class='text-xs font-medium'>₹${row['salePrice']}</span>";
        echo "</div>";
        echo "<div>";
        echo "<i class='fa fa-close text-xs font-medium'></i>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

}

function loadCatProducts($cat)
{
    global $conn;

    $query = "SELECT * FROM `items` WHERE itemCat = '".$cat."'";

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {

        echo "<div class='showcase cursor-pointer' onclick='redirectToProductPage(" . $row['itemId'] . ")'>";
        echo "<div class='showcase-banner'>";
        echo "<img src='" . $row['itemImage'] . "' alt='Mens Winter Leathers Jackets' width='300' class='product-img default'>";
        echo "<img src='" . $row['itemImage'] . "' alt='Mens Winter Leathers Jackets' width='300' class='product-img hover'>";
        echo "</div>";
        echo "<div class='showcase-content'>";
        echo "<a href='#' class='showcase-category'>${row['itemType']}</a>";
        echo "<a href='#'>";
        echo "<h3 class='showcase-title'>${row['itemTitle']}</h3>";
        echo "</a>";
        echo "<div class='price-box'>";
        echo "<p class='price'>₹${row['salePrice']}</p>";
        echo "<del>₹${row['usualPrice']}</del>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }


}

function loadUsers()
{
    global $conn;

    $query = 'SELECT * FROM `users`';

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>${row['userid']}</td>";
        echo "<td>${row['username']}</td>";
        echo "<td>${row['email']}</td>";
        echo "<td>${row['password']}</td>";
        echo "<td>${row['datetime']}</td>";
        echo "</tr>";
    }
}

function loadItems()
{
    global $conn;

    $query = 'SELECT * FROM `items`';

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>${row['itemId']}</td>";
        echo "<td>${row['itemTitle']}</td>";
        echo "<td>${row['itemCat']}</td>";
        echo "<td>Rs. ${row['salePrice']}</td>";
        echo "</tr>";
    }
}

function loadOrders()
{
    global $conn;

    $query = 'SELECT * FROM `orders`';

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $timestamp = $row['orderDate'];
        $totalAmount = $row['totalAmount'];
        $orderStatus = $row['orderStatus'];
        $customerId = $row['customerId'];
        $orderId = $row['orderId'];

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
            $productName = $itemName;
        }

        $getCustomer = 'SELECT * FROM `users` WHERE userId="' . $customerId . '";';
        $customer = mysqli_query($conn, $getCustomer);
        $row3 = mysqli_fetch_assoc($customer);

        $customerName = $row3['username'];

        $itemCount = $itemCount + 1;
        echo "<tr>";
        echo "<td>${timestamp}</td>";
        echo "<td>${orderId}</td>";
        echo "<td>${productName}</td>";
        echo "<td>${itemCount}</td>";
        echo "<td>${totalAmount}</td>";
        echo "<td>${customerName}</td>";
        echo "<td>${orderStatus}</td>";
        echo "</tr>";
    }
}

?>
