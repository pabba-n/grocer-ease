<?php
    session_start();
?>
<html>
    <header>
    <meta name='viewport' content="width=device-width, initial scale=1">
        <title>Grocer-Ease</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name='viewport' content="width=device-width, initial scale=1">
    </header>
    <style>
    .content {
        text-align: center;
    }
    #thankyou {
        font-size: 60px;
        color: #D1843C;
        padding: 10px;
        text-align: center;
    }

    #info1 {
        font-size: 25px;
        color: #585F67;
        padding: 20px;
    }

    #info2 {
        font-size: 25px;
        color: black;
        padding: 5px;
    }
    #bar {
        border: 0;
        background: #D1843C;
        height: 4px;
        width: 25%;
    }
    .cont{
        text-align: center;
    }
    
    </style>
    <body>
        <div class="header">
        <h1 class="logo"><a href="index.html">GROCER-EASE</a></h1>
        <div class="nav-bar">
                <a class="catalog"href="catalog.php"><div>Catalog</div></a>
                <a class="cart"href="cart.php"><i class="fa fa-shopping-cart" style="font-size:30px;color:#133965"></i></a>
                <!-- <div class="cart"><a href="cart.php">Shopping Cart</a></div> -->
        </div>
        <hr>
</div>
        <div class="content">
            <?php
                $server = "localhost";
                $userid = "uxzhryenrodc8";
                $pw = "&227f@#5k1*6";
                $db= "dbkqyfriigebv4";
    
                $conn = new mysqli($server, $userid, $pw);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }
    
                $conn->select_db($db);

                $sql = "SELECT SUM(PRICE) FROM `RECIPE` WHERE RecipeName = 'Creamy Tomato Soup';";

                $result = $conn->query($sql);
                $tsPrice = 0;
                if ($result->num_rows > 0) {
                        while($row = $result->fetch_array()) 
                        {
                                $tsPrice = $row[0];
                        }
                }

                $sql = "SELECT SUM(PRICE) FROM `RECIPE` WHERE RecipeName = 'Mushroom Lasagna';";

                $result = $conn->query($sql);
                $mlPrice = 0;
                if ($result->num_rows > 0) {
                        while($row = $result->fetch_array()) 
                        {
                                $mlPrice = $row[0];
                        }
                }
    
                $serverDate = $_SERVER['REQUEST_TIME'];
                $orderDate = date('Y-m-d', $serverDate);

                $orderDetails = "";

                foreach ($_SESSION["cart"] as $key => $value) {
                    if ($value > 0) {
                        $orderDetails .= $key . ": " . $value . ", ";
                    }
                }

                $sub = ($tsPrice * $_SESSION["cart"]["Creamy Tomato Soup"]) + ($mlPrice * $_SESSION["cart"]["Mushroom Lasagna"]);
                $tax = $sub * .0625;
                $total = $tax + $sub;

                $tax = bcdiv($tax,1, 2);
                $total = bcdiv($total,1, 2);
                
                $tsPrice = $tsPrice * $_SESSION["cart"]["Creamy Tomato Soup"];
                $mlPrice = $mlPrice * $_SESSION["cart"]["Mushroom Lasagna"];
                
                $orderSql = "INSERT INTO `orders` (`Order_Date`, `Name`, `Phone`, " 
                            . "`Address`, `City`, `State`, `Zip`, `Order_Details`, "
                            . "`Total_Cost`) "
                            . "VALUES ('$orderDate', '$_REQUEST[name]', '$_REQUEST[phone]', "
                            . "'$_REQUEST[stAddress]', '$_REQUEST[city]', '$_REQUEST[state]', "
                            . "'$_REQUEST[zip]', '$orderDetails', $total)";

                $conn->query($orderSql);
                $conn->close();
    
            ?>
            <img src="check icon.png" width="250">
            <?php
                $customerName = $_REQUEST['name'];
                echo "<h3 id='thankyou'>Thank you for your order, $customerName!</h2>";
            ?>
            <hr id="bar">
            <p id="info1">See your order details below.</p>
            <p id="info2">Estimated Delivery: </p><br />
            <?php
                    if ($_SESSION["cart"]["Creamy Tomato Soup"] > 0) {
                        echo "<p style='color: black'>Creamy Tomato Soup&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty: " . $_SESSION["cart"]["Creamy Tomato Soup"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price: $" . bcdiv($tsPrice,1, 2) . "</p>";
                    }
                    if ($_SESSION["cart"]["Mushroom Lasagna"] > 0) {
                        echo "<p style='color: black'>Mushroom Lasagna&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty: " . $_SESSION["cart"]["Mushroom Lasagna"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price: $" . bcdiv($mlPrice,1, 2) . "</p><br />";
                    }
                    echo "<p style='color: black'>Tax: $" . bcdiv($tax,1, 2) . "</p>";
                    echo "<p style='color: black'>Total: $" . bcdiv($total,1, 2) . "</p><br />";
            ?>
            <p id="info3" style="color: black">Shipping address: </p>
            <?php
                echo "<p style='color: black'>$_REQUEST[stAddress], $_REQUEST[city], $_REQUEST[state] $_REQUEST[zip]</p>";
            ?>
            <br />
            <a href="catalog.php"><button type="button" class="cont">Continue Shopping</button></a>
        </div>
    </body>
    <script>
        function formatTime (time) {
                minutes = time.getMinutes();
                if (minutes < 10) {
                    minutes = "0" + minutes;
                }

                hours = time.getHours();

                amPm = "";
                if (hours >= 12) {
                    amPm = "PM";
                } else {
                    amPm = "AM";
                }

                if (hours > 12) {
                    hours = hours - 12;
                }

                timeFormatted = hours + ":" + minutes + " " + amPm;
                return timeFormatted;
        }

        dateTime = new Date();
        dateTime.setMinutes(dateTime.getMinutes() + 15);
        deliveryTime = formatTime(dateTime);
        deliveryDate = dateTime.toISOString().split('T')[0];

        document.getElementById("info2").innerHTML += deliveryDate + " at " + deliveryTime;
    </script>
</html>
<?php
    session_destroy(); 
?>
