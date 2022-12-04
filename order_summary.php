<?php
    session_start();
?>
<html>
    <header>
        <title>Grocer-Ease</title>
        <link rel="stylesheet" href="style.css">
        <meta name='viewport' content="width=device-width, initial scale=1">
    </header>
    <body>
        <div class="header">
            <h1 class="logo"><a href="index.html">GROCER-EASE</a></h1>
            <div class="nav-bar">
                    <div><a href="catalog.php">Catalog</a></div>
                    <div><a href="cart.html">Shopping Cart</a></div>
            </div>
            <hr>
        </div>
        <div>
            <h2>Thank you for your order!</h2>
            <hr>
            <p>See your order details below.</p>
        </div>
        <div>
            <?php 
                    echo "Creamy Tomato Soup: " . $_SESSION["cart"]["Creamy Tomato Soup"] . "<br />";
                    echo "Mushroom Lasagna: " . $_SESSION["cart"]["Mushroom Lasagna"] . "<br /><br />";
            ?>
            <p id="eta">Estimated Delivery Date: </p>
        </div>
    </body>
    <script>
        var a = new Date();
        var b = new Date(a.setTime(a.getTime() + 86400000)).toISOString().split('T')[0];
        document.getElementById("eta").innerHTML += b;
    </script>
</html>
