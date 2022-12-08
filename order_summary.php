<?php
    session_start();
?>
<html>
    <header>
        <title>Grocer-Ease</title>
        <link rel="stylesheet" href="style.css">
        <meta name='viewport' content="width=device-width, initial scale=1">
    </header>
    <style>
    .content {
        text-align: center;
    }
    #thankyou {
        font-size: 60px;
        color: #D1843C;
        padding: 15px;
    }

    #info1 {
        font-size: 25px;
        color: #585F67;
        padding: 15px;
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
    
    </style>
    <body>
        <h2>Hello</h2>
        <div class="header">
            <h1 class="logo"><a href="index.html">GROCER-EASE</a></h1>
            <div class="nav-bar">
                    <div><a href="catalog.php">Catalog</a></div>
                    <div><a href="cart.php">Shopping Cart</a></div>
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

                // $sql = "SELECT SUM(PRICE) FROM `RECIPE` WHERE RecipeName = 'Creamy Tomato Soup';";

                // $result = $conn->query($sql);
                // if ($result->num_rows > 0) {
                //     $counter = 0;
                //     while($row = $result->fetch_array()) 
                //     {
                //         $tsPrice = $row[0];
                //         echo $tsPrice;
                //     }
                // }
    
                $serverDate = $_SERVER['REQUEST_TIME'];
                $orderDate = date('Y-m-d', $serverDate);

                $orderDetails = "";

                foreach ($_SESSION["cart"] as $key => $value) {
                    if ($value > 0) {
                        $orderDetails .= $key . ": " . $value . ", ";
                    }
                }

                $sub = (9.5 * $_SESSION["cart"]["Creamy Tomato Soup"]) + (9.75 * $_SESSION["cart"]["Mushroom Lasagna"]);
                $tax = $sub * .0625;
                $total = $tax + $sub;
    
                $orderSql = "INSERT INTO `orders` (`Order_Date`, `Name`, `Phone`, " 
                            . "`Address`, `City`, `State`, `Zip`, `Order_Details`, "
                            . "`Total_Cost`) "
                            . "VALUES ('$orderDate', '$_REQUEST[name]', '$_REQUEST[phone]', "
                            . "'$_REQUEST[stAddress]', '$_REQUEST[city]', '$_REQUEST[state]', "
                            . "'$_REQUEST[zip]', $orderDetails, $total)";

                $conn->query($orderSql);
                $conn->close();
    
            ?>
            <img src="check icon.png" width="250">
            <?php
                $customerName = $_REQUEST['name'];
                echo "<h2 id='thankyou'>Thank you for your order, $customerName!</h2>";
            ?>
            <hr id="bar">
            <p id="info1">See your order details below.</p>
            <?php 
                    if ($_SESSION["cart"]["Creamy Tomato Soup"] > 0) {
                        echo "<p style='color: black'>Creamy Tomato Soup&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty: " . $_SESSION["cart"]["Creamy Tomato Soup"] . "</p>";
                    }
                    if ($_SESSION["cart"]["Mushroom Lasagna"] > 0) {
                        echo "<p style='color: black'>Mushroom Lasagna&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty: " . $_SESSION["cart"]["Mushroom Lasagna"] . "</p><br />";
                    }
            ?>
            <p id="info2">Estimated Delivery Date: </p>
            <p id="info3">Shipping address: </p>
        </div>
    </body>
    <script>
        var a = new Date();
        var b = new Date(a.setTime(a.getTime() + 86400000)).toISOString().split('T')[0];
        document.getElementById("info2").innerHTML += b;
    </script>
</html>
<?php
    session_destroy(); 
?>
