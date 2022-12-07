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
        <div class="header">
            <h1 class="logo"><a href="index.html">GROCER-EASE</a></h1>
            <div class="nav-bar">
                    <div><a href="catalog.php">Catalog</a></div>
                    <div><a href="cart.html">Shopping Cart</a></div>
            </div>
            <hr>
        </div>
        <div class="content">
            <img src="check icon.png" width="250">
            <h2 id="thankyou">Thank you for your order!</h2>
            <hr id="bar">
            <p id="info1">See your order details below.</p>
            <?php 
                    echo "<p style='color: black'>Creamy Tomato Soup&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty: " . $_SESSION["cart"]["Creamy Tomato Soup"] . "</p>";
                    echo "<p style='color: black'>Mushroom Lasagna&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty: " . $_SESSION["cart"]["Mushroom Lasagna"] . "</p><br />";
            ?>
            <p id="info2">Estimated Delivery Date: </p>
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
