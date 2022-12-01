<?php
    session_start();
?>
<html>
<header>
    <title>Grocer-Ease</title>
    <link rel="stylesheet" href="style.css">
</header>
<style>
    body {
        margin-left: 10%;
        margin-right: 10%;
    }
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
    .quantity{
        margin: auto;
        position: absolute;
        bottom: 20px;
        left: 20px;
    }
    /* #price1, #price2 {
        text-align: right;
        margin
    } */
    .help {
        float: right;
        border-radius: 8px;
        background-color: #133965;
        color: #fff;
        padding: 8px;
        margin-bottom: 20px;
    }
    /* input #checkout {
        border-radius: 8px;
        background-color: #133965;
        color: #fff;
        padding: 8px;
    } */
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
    input.qtyplus { background-color: white; width:25px; height:25px; border-radius: 50%; border: 2px solid #585F67;}
    input.qtyminus { background-color: white; width:25px; height:25px; border-radius: 50%; border: 2px solid #585F67;}
</style>
<!-- <?php 
        echo "Tomato Soup: " . $_SESSION["cart"]["Creamy Tomato Soup"] . "<br />";
        echo "Mushroom Lasagna: " . $_SESSION["cart"]["Mushroom Lasagna"] . "<br />";
?> -->

<body>
    <div class="header">
        <h1 class="logo"><a href="index.html">GROCER-EASE</a></h1>
        <div class="nav-bar">
                <div class="catalog"><a href="catalog.php">Catalog</a></div>
                <div class="cart"><a href="cart.php">Shopping Cart</a></div>
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
                <form id='myform' method='POST' class='quantity' action='/order.html'>
                    <input type='button' value='-' class='qtyminus minus' field='quantity' />
                    <input type='text' name='quantity' value="<?php echo $_SESSION["cart"]["Creamy Tomato Soup"]; ?>" class='qty' />
                    <input type='button' value='+' class='qtyplus plus' field='quantity' />
                </form>
            </div>
            <div class="column">
                <p id="price1">9.50</p>
            </div>
        </div>   
    </div>
    <div class="cardBox2">
        <div class="row">
            <div class="column">
                    <p class="recipeName">Mushroom Lasagna</p>
                    <p class="ingredients">View Ingredients</p>
                    <form id='myform' method='POST' class='quantity' action='/order.html'>
                        <input type='button' value='-' class='qtyminus minus' field='quantity' />
                        <input type='text' name='quantity' value="<?php echo $_SESSION["cart"]["Mushroom Lasagna"]; ?>" class='qty' />
                        <input type='button' value='+' class='qtyplus plus' field='quantity' />
                    </form>
            </div>
            <div class="column">
                  <p id="price2">9.75</p>
            </div>
        </div>
    </div>
    <span> 
        <form id='myform' method='POST' class='submission' action='/order.html'>
            <div id="lastButton"><input class="help" type="submit" value="Checkout"><div>
        </form>
    </span>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
    jQuery(document).ready(($) => {

        
            // let $input = $(this).prev('input.qty');
            // let val = parseInt($input.val());
            // $input.val( val+1 ).change();
        $('.quantity').on('click', '.plus', function(e) {
            let $input = $(this).prev('input.qty');
            let val = parseInt($input.val());
            $input.val( val+1 ).change();
        });
        //once user adds more to the quantity, how do you update the session variable
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
    
</body>
<html>