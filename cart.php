<?php
    session_start();
?>
<html>
<header>
    <title>Grocer-Ease</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name='viewport' content="width=device-width, initial scale=1">
    <link rel="stylesheet" href="style.css">
</header>
<style>
    #lastButton, #price1, #price2{
        text-align: right;
        padding-right: 30%;
        padding-top:0%;
        padding-bottom:1%;
    }
    #priceLabel {
        text-align: right;
        padding-right: 32%;
        padding-top:0%;
        padding-bottom:1%;
    }
    .hideTomato, .hideMushroom {
        font-size: 15px;
        line-height: 105%;
    }
    .ingredients {
        text-decoration: underline;
        font-size: 15px;
    }
    .quantity{
        margin: auto;
        position: absolute;
        bottom: 20px;
        left: 20px;
    }
    .help {
        float: right;
        border-radius: 8px;
        background-color: #133965;
        color: #fff;
        padding: 8px;
        margin-bottom: 20px;
    }
    .cardbox2{
        position:relative;
        margin: 15px auto;
    }
    .qty {
        width: 30px;
        height: 25px;
        text-align: center;
        border: 0;
        font-size: 16px;
    }
    .row {
        display: flex;
    }
    .column {
        flex: 50%;
    }
    .hideTomato {
        display: none;
    }

    .ingredients:hover + .hideTomato {
        display: block;
        color: gray;
        font-size: 15px;
        text-decoration: none;
    }

    .hideMushroom {
        display: none;
    }

    .ingredients:hover{
        text-decoration: none;
    }
    .ingredients:hover + .hideMushroom {
        display: block;
        color: gray;
        font-size: 15px;
        text-decoration: none;
    }
    input.qtyplus { background-color: white; width:25px; height:25px; border-radius: 50%; border: 2px solid #585F67;}
    input.qtyminus { background-color: white; width:25px; height:25px; border-radius: 50%; border: 2px solid #585F67;}
</style>

<body>
    <?php
        for ($i = 0; $i < count($_POST); $i++) {
            if (array_keys($_POST)[$i] == "tomato_soup_minus") {
                $_SESSION["cart"]["Creamy Tomato Soup"] -= 1;
            }
            if (array_keys($_POST)[$i] == "tomato_soup_plus") {
                $_SESSION["cart"]["Creamy Tomato Soup"] += 1;
            }
            if (array_keys($_POST)[$i] == "mushroom_lasagna_minus") {
                $_SESSION["cart"]["Mushroom Lasagna"] -= 1;
            }
            if (array_keys($_POST)[$i] == "mushroom_lasagna_plus") {
                $_SESSION["cart"]["Mushroom Lasagna"] += 1;
            }
        }
    ?>
    <div class="header">
        <h1 class="logo"><a href="index.html">GROCER-EASE</a></h1>
        <div class="nav-bar">
                <a class="catalog"href="catalog.php"><div>Catalog</div></a>
                <a class="cart"href="cart.php"><i class="fa fa-shopping-cart" style="font-size:30px;color:#133965"></i></a>
                <!-- <div class="cart"><a href="cart.php">Shopping Cart</a></div> -->
        </div>
        <hr>
</div>
    <h2>Shopping Cart</h2>
    <div id="priceLabel"><p>Price</p></div>
    <div class="cardBox2">
        <div class="row">
            <div class="column">
                <p class="recipeName">Creamy Tomato Soup</p>
                <p class="ingredients">View Ingredients</p>
                <p class="hideTomato"> <?php
    $server = "localhost";
    $userid = "uxzhryenrodc8";
    $pw = "&227f@#5k1*6";
    $db= "dbkqyfriigebv4";
    
    // Create connection
    $conn = new mysqli($server, $userid, $pw );
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    //select the database
    $conn->select_db($db);
    $tomato = "SELECT * FROM `RECIPE` WHERE RecipeName = 'Creamy Tomato Soup';";
    $result = $conn->query($tomato);
    if ($result->num_rows > 0) {
        $counter = 0;
       while($row = $result->fetch_array()) 
       {
            $ingredients = $row[1];
            echo "$ingredients, ";
       }
    }
    $conn->close();
    ?></p>
                <form method='POST' class='quantity'>
                    <input type='submit' value='-' name="tomato_soup_minus" class='qtyminus minus' field='quantity' />
                    <input id='tomato' type='text' name='quantity' value="<?php echo $_SESSION["cart"]["Creamy Tomato Soup"]; ?>" class='qty' />
                    <input type='submit' value='+' name="tomato_soup_plus" class='qtyplus plus' field='quantity' />
                </form>
            </div>
            <div class="column">
                <p id="price1"><?php echo "$" . bcdiv(($_SESSION["cart"]["Creamy Tomato Soup"] * 9.50),1, 2)?></p>
            </div>
        </div>   
    </div>
    <div class="cardBox2">
        <div class="row">
            <div class="column">
                    <p class="recipeName">Mushroom Lasagna</p>
                    <p class="ingredients">View Ingredients</p>
                    <p class="hideMushroom"><?php
    $server = "localhost";
    $userid = "uxzhryenrodc8";
    $pw = "&227f@#5k1*6";
    $db= "dbkqyfriigebv4";
    
    // Create connection
    $conn = new mysqli($server, $userid, $pw );
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    //select the database
    $conn->select_db($db);
    $mushroom = "SELECT * FROM `RECIPE` WHERE RecipeName = 'Mushroom Lasagna';";
    $result = $conn->query($mushroom);
    if ($result->num_rows > 0) {
        $counter = 0;
       while($row = $result->fetch_array()) 
       {
            $ingredients = $row[1];
            echo "$ingredients, ";
       }
    }
    $conn->close();
    ?></p>
                    <form method='POST' class='quantity'>
                        <input type='submit' value='-' name='mushroom_lasagna_minus' class='qtyminus minus' field='quantity' />
                        <input id='mushroom' type='text' name='quantity' value="<?php echo $_SESSION["cart"]["Mushroom Lasagna"]; ?>" class='qty' />
                        <input type='submit' value='+' name='mushroom_lasagna_plus' class='qtyplus plus' field='quantity' />
                    </form>
            </div>
            <div class="column">
                  <p id="price2"><?php echo "$". bcdiv(($_SESSION["cart"]["Mushroom Lasagna"] * 9.75),1, 2)?></p>
            </div>
        </div>
    </div>
    <span> 
        <form id='myform' method='POST' class='submission' action='order.php'>
            <div id="lastButton"><input class="help" type="submit" value="Checkout"><div>
        </form>
    </span>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
    jQuery(document).ready(($) => {

        $('.quantity').on('click', '.plus', function(e) {
            let $input = $(this).prev('input.qty');
            let val = parseInt($input.val());
            $input.val( val+1 ).change();
        });
        $('.quantity').on('click', '.minus', 
            function(e) {
            let $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            if (val > 0) {
                $input.val( val-1 ).change();
            } 
        });
       
    });
   </script>
   <?php 
            // echo "Tomato Soup: " . $_SESSION["cart"]["Creamy Tomato Soup"] . "<br />";
            // echo "Mushroom Lasagna: " . $_SESSION["cart"]["Mushroom Lasagna"] . "<br />";
    ?>
</body>
<html>