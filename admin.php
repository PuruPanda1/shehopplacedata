<?php
require_once("config.php");
session_start();
if (!isset($_SESSION['adminlog']) || $_SESSION['adminlog'] != true) {
    header("location: adminlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- linking css file here-->
    <link rel="stylesheet" href="./assets/css/adminstyle.css">
</head>

<body style="background-color: #DDE7F2;">
    <h1 style="width: 80%;
    margin: auto;
      margin-top: auto;
      text-align: center;
      font-family: 'Roboto', sans-serif;
        color: black;
margin-top: 40px;">ADMIN PANEL</h1>
    <section class="adminheadsection">
        <div class="dashboard_container">
            <h1>Dashboard</h1>
            <div class="dropdown">
                <button class="dropbtn"><?php echo $_SESSION["adminusername"] ?> </button>
                <div class="dropdown-content">
                    <a href="./logout.php">Log Out</a>
                </div>
            </div>
        </div>
        <div>
            <ul class="progress">
                <li>
                    <div class="statuselement st2">
                        <h4>Active</h4>
                        <p><?php
                            $num1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders` WHERE orderStatus='Ordered';"));
                            echo $num1;
                            ?></p>
                    </div>
                </li>
                <li>
                    <div class="statuselement st3">
                        <h4>Completed</h4>
                        <p><?php
                            $num2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders` WHERE orderStatus='Completed';"));
                            echo $num2;
                            ?></p>
                    </div>
                </li>
                <li>
                    <div class="statuselement st4">
                        <h4>Cancelled</h4>
                        <p><?php
                            $num3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders` WHERE orderStatus='Cancelled';"));
                            echo $num3;
                            ?></p>
                    </div>
                </li>
                <li>
                    <div class="statuselement st1">
                        <h4>Total</h4>
                        <p><?php
                            echo $num1 + $num2 + $num3;
                            ?></p>
                    </div>
                </li>
            </ul>
        </div>
        <div>
            <ul class="p2">
                <li>
                    <div class="options" onclick="showUsers()">
                        <h4>Users</h4>
                    </div>
                </li>
                <li>
                    <div class="options" onclick="showFoodItems()">
                        <h4>Items</h4>
                    </div>
                </li>
                <li>
                    <div class="options" onclick="showOrders()">
                        <h4>Orders</h4>
                    </div>
                </li>
            </ul>
        </div>
        <script>
            function showUsers() {
                document.getElementById("users").style.display = "block";
                document.getElementById("fooditems").style.display = "none";
                document.getElementById("orders").style.display = "none";
            }

            function showFoodItems() {
                document.getElementById("fooditems").style.display = "block";
                document.getElementById("users").style.display = "none";
                document.getElementById("orders").style.display = "none";
            }

            function showOrders() {
                document.getElementById("orders").style.display = "block";
                document.getElementById("users").style.display = "none";
                document.getElementById("fooditems").style.display = "none";
            }
        </script>
    </section>
    <!-- show users details to admin section -->
    <section class="ordersection" style="display: none;" id="users">
        <h2>Users</h2>
        <table border=1 class="order_table">
            <tr>
                <th>User Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Account Creation</th>
            </tr>
            <?php
            require_once ("./utils/loader.php");
            loadUsers();
            ?>
        </table>
    </section>
    <!-- food items section -->
    <section class="ordersection" style="display: none;" id="fooditems">
        <h2>Items</h2>
        <table border=0 class="order_table">
            <tr>
                <th>Item Id</th>
                <th>Title</th>
                <th>Category</th>
                <th>Current Price</th>
            </tr>
            <?php
            require_once("./utils/loader.php");
            loadItems();
            ?>
        </table>
    </section>
    <!-- orders section -->
    <section class="ordersection" style="display: none;" id="orders">
        <h2>Orders</h2>
        <div id="orderid"></div>
        <table border=0 class="order_table">
                <tr>
                    <th>TimeStamp</th>
                    <th>Order No.</th>
                    <th>Items</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                </tr>
                <?php
                require_once ("./utils/loader.php");
                loadOrders();
                ?>
            </table>
    </section>
    <script src="./jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#orderid").load("./orderdetails.php");
        });
    </script>
</body>

</html>