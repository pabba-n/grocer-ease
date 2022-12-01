<?php
    session_start();
?>
<html>
<header>
    <title>Grocer-Ease</title>
    <link rel="stylesheet" href="style.css">
</header>
<style>
    #checkout, #priceLabel{
        text-align: right;
        padding-right: 30%;
        padding-top:3%;
        padding-bottom:1%;
    }
    #myform {
        /* float: right; */
        margin: auto;
        /* padding: 5%; */
        /* position: fixed; */
        position: absolute;
        bottom: 20px;
        left: 20px;
    }
    /* .column {
        float: left;
        width: 50%;
        height: 100%;
        position: absolute;
    } */
    .button {
                float: right;
                border-radius: 8px;
                background-color: #133965;
                color: #fff;
                padding: 8px;
    }
    .cardbox2{
        /* content: ""; */
        /* display: table;
        clear: both; */
        position:relative;
        

    }
    .qty {
        width: 30px;
        height: 25px;
        text-align: center;
        border: 0;
        font-size: 16px;
    }
    input.qtyplus { background-color: white; width:25px; height:25px; border-radius: 50%; border: 2px solid #585F67;}
    input.qtyminus { background-color: white; width:25px; height:25px; border-radius: 50%; border: 2px solid #585F67;}
</style>
<body>
    <div class="header">
        <h1 class="logo"><a href="index.html">GROCER-EASE</a></h1>
        <div class="nav-bar">
                <div class="catalog"><a href="catalog.php">Catalog</a></div>
                <div class="cart"><a href="cart.html">Shopping Cart</a></div>
        </div>
        <hr>
</div>
    <h2>Shopping Cart</h2>
    <div id="priceLabel"><p>Price</p></div>
    <div class="cardBox2">
        <div class="column">
            <p class="recipeName">Tomato Soup</p>
            <p class="ingredients">View Ingredients</p>
            <!-- <p>hello hello</p> -->
        </div>
        <div class="column">
            <form id='myform' method='POST' class='quantity' action='#'>
                <input type='button' value='-' class='qtyminus minus' field='quantity' />
                <input type='text' name='quantity' value='0' class='qty' />
                <input type='button' value='+' class='qtyplus plus' field='quantity' />
            </form>
        </div>
        

    </div>
    <div id="checkout"> <input class="button" type="submit" value="Checkout"></div>
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
    echo "Tomato Soup: " . $_SESSION["cart"]["Creamy Tomato Soup"] . "<br />";
    echo "Mushroom Lasagna: " . $_SESSION["cart"]["Mushroom Lasagna"] . "<br />";
    ?>

</body>
<html>