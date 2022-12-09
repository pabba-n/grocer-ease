<?php
    session_start();
?>
<html>
<header>
        <title>Grocer-Ease</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name='viewport' content="width=device-width, initial scale=1">
        <link rel="stylesheet" href="style.css">
        
        <style>
                input[type=text] {
                border-color: #000;
                border-width: 1px;
                border-radius: 30px;
                width:60%;
                text-indent: 2%;
                }
                .center {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100px;
                }
               
                .btn {
                        margin-left: 70%;
                        margin-bottom: 2%;
                        height: 50px;
                        width: 200px;
                }

                .cont{
                        height: 35px;
                        width: 200px;
                }
                button,.cont,.btn {
                transition: all .5s ease;
                background-color: #133965;
                border: none;
                font-size: 20px;
                color: #fff;
                border-radius: 20px;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                text-indent: 2%;
                }
                button:hover,.btn:hover {
                color: #133965;
                background-color: #fff;
                }
                label, .cardbox2 div {
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                font-size: 20px;
                }
                .cardbox2 {
                height:auto;
                margin-bottom: 2.5%;
                }
                .done {
                margin-left: 70%;
                }
                .opt {
                margin-top: 3px;
                }
                h3 {
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                font-weight: 350;
                font-size: 25px;
                color:#444;
                margin-top: 0%;
                margin-bottom: 2%;
                }
                .cardbox2 div,.cardbox2 label,.cardbox2 input[type=text] {
                margin-left: 2%;
                }
                hr.order {
                margin-left: 2%;
                width: 50%;
                }
                .exp-wrapper input[type=text] {
                width:7.5%;
                margin-left: 0%;
                text-indent: 0%;
                text-align: center;
                }
        </style>
</header>
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

        <h2>
                Checkout
        </h2>
        <form method='get' action='order_summary.php' onSubmit='return getVals()'>
        <div class="cardbox2">
                <h3>1 Shipping Address</h3>
                <label for="name">Full Name </label></br>
                <input type="text" id="name" name="name" value=""></br>
                <label for="phone">Phone Number </label></br>
                <input type="text" id="phone" name="phone" value=""></br>
                <label for="stAddress">Address </label></br>
                <input type="text" id="stAddress" name="stAddress" value="" placeholder="Street Address"></br>
                <input class="opt" type="text" id="optAddress" name="optAddress" value="" placeholder="Apt, suite, unit, building, floor, etc."></br>
                <label for="city">City </label></br>
                <input type="text" id="city" name="city" value=""></br>
                <label for="state">State </label></br>
                <input type="text" id="state" name="state" value=""></br>
                <label for="zip">ZIP Code </label></br>
                <input type="text" id="zip" name="zip" value=""></br>
                <label for="country">Country/Region</label></br>
                <input type="text" id="country" name="country" value=""></br>
        </div>
        <div class="cardbox2">
                <h3>2 Payment Method</h3>
                <label for="card">Credit/Debit Card Number</label></br>
                <input type="text" id="card" name="card" value=""></br>
                <label for="cardName">Name on Card</label></br>
                <input type="text" id="cardName" name="cardName" value=""></br>
                <label for="cardName">Expiration Date</label></br>
                <div class="exp-wrapper">
                        <input type="text" id="month" name="month" maxlength="2" inputmode="numerical" placeholder="MM" type="number" />
                         / 
                        <input type="text" id="year" name="year" maxlength="2" inputmode="numerical" placeholder="YY" type="number" />
                      </div>
        </div>
        <div class="cardbox2">
                <h3>3 Order Summary</h3>
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

                $tsQty = $_SESSION["cart"]["Creamy Tomato Soup"];
                $mlQty = $_SESSION["cart"]["Mushroom Lasagna"];

                if ($tsQty > 0) {
                        $tsSub = $tsPrice * $tsQty;
                        echo "<div>Creamy Tomato Soup x $tsQty : $". bcdiv($tsSub,1, 2) . "</div>";
                }
                if ($mlQty > 0) {
                        $mlSub = $mlPrice * $mlQty;
                        echo "<div>Mushroom Lasagna x $mlQty : $" . bcdiv($mlSub,1, 2) . "</div>";
                }

                echo "<hr class='order'>";

                $sub = ($tsPrice * $tsQty) + ($mlPrice * $mlQty);
                echo "<div>Subtotal: $" . bcdiv($sub,1, 2) . "</div>";
                echo "<div>Shipping: $0</div><hr class='order'>";

                $tax = $sub * .0625;
                $total = $tax + $sub;
                echo "<div>Tax: $" . bcdiv($tax,1, 2) . "</div><hr class='order'>";
                echo "<div>Total: $" . bcdiv($total,1, 2) . "</div>";
                ?>
                <input type="submit" class="btn" value='Place Your Order' />
                
        </div>
        
        
        <div class="center">
                <a href="catalog.php"><button type="button" class="cont">Continue Shopping</button></a>
                <!-- onClick="getVals(this.form)" -->
        </div>
        </form>
        <script>
                function goCatalog() {
                        window.location.href="catalog.php";
                }
                let errorMessage = "";
                function validateCountry() {
                        var country = document.getElementsByName('country')[0].value;
                        if (country == "") {
                                errorMessage += "Please enter your country\n";
                                return false;
                        }
                        var valid =  /^[A-Za-z\s]*$/.test(country);
                                if (!valid) {
                                        errorMessage += "A country  \n";
                                }
                        return valid;
                }
                function validateName() {
                        var name = document.getElementsByName('name')[0].value;
                        if (name == "") {
                                errorMessage += "Please enter your name\n";
                                return false;
                        }
                        var valid =  /^[A-Za-z]*\s[A-Za-z]*$/.test(name);
                        if (!valid) {
                                errorMessage += "Please enter your first and last name\n";
                        }
                        return valid;
                }
                function validatePhone() {
                        var phone = document.getElementsByName('phone')[0].value;
                        if (phone == "") {
                                errorMessage += "Please enter your phone number\n";
                                return false;
                        }
                        var valid =  /^[0-9]*$/.test(phone);
                        if (!valid) {
                                errorMessage += "Please enter a valid phone number\n";
                        }
                        return valid;
                }
                function validateSt() {
                        var st = document.getElementsByName('stAddress')[0].value;
                        if (st == "") {
                                errorMessage += "Please enter your street address\n";
                                return false;
                        }
                        var valid =  /^[A-Za-z0-9\s]*$/.test(st);
                        if (!valid) {
                                errorMessage += "Please enter a valid street address\n";
                        }
                        return valid;
                }
                function validateCity() {
                        var city = document.getElementsByName('city')[0].value;
                        if (city == "") {
                                errorMessage += "Please enter your city\n";
                                return false;
                        }
                        var valid =  /^[A-Za-z\s]*$/.test(city);
                        if (!valid) {
                                errorMessage += "Please enter a valid city\n";
                        }
                        return valid;
                }
                function validateState() {
                        var state = document.getElementsByName('state')[0].value;
                        if (state == "") {
                                errorMessage += "Please enter your state\n";
                                return false;
                        }
                        var valid =  /^[A-Za-z\s]*$/.test(state);
                        if (!valid) {
                                errorMessage += "Please enter a valid state\n";
                        }
                        return valid;
                }
                function validateZip() {
                        var zip = document.getElementsByName('zip')[0].value;
                        if (zip == "") {
                                errorMessage += "Please enter your zip code\n";
                                return false;
                        }
                        var valid =  /^[0-9]*$/.test(zip);
                        if (!valid) {
                                errorMessage += "Please enter a valid zip code\n";
                        }
                        return valid;
                }
                function validateCard() {
                        var card = document.getElementsByName('card')[0].value;
                        if (card == "") {
                                errorMessage += "Please enter your credit/debit card number\n";
                                return false;
                        }
                        var valid =  /^[0-9]*$/.test(card);
                        if (!valid) {
                                errorMessage += "Please enter a valid credit/debit card number\n";
                        }
                        return valid;
                }
                function validateCardName() {
                        var cardName = document.getElementsByName('cardName')[0].value;
                        if (cardName == "") {
                                errorMessage += "Please enter your credit/debit card name\n";
                                return false;
                        }
                        var valid =  /^[A-Za-z]*\s[A-Za-z]*$/.test(cardName);
                        if (!valid) {
                                errorMessage += "Please enter a valid name for your credit card\n";
                        }
                        return valid;
                }
                function validateExp() {
                        var month = document.getElementsByName('month')[0].value;
                        var year = document.getElementsByName('year')[0].value;
                        if (month == "" || year == "") {
                                errorMessage += "Please enter your card expiration date\n";
                                return false;
                        }
                        var valid = /^[0-9]*$/.test(month) & /^[0-9]*$/.test(year);
                        valid &= (year >= 23);
                        if (!valid) {
                                errorMessage += "Please enter a valid expiration date\n";
                        }
                        return valid;
                }
                function getVals() {
                        errorMessage = "";
                        let valid = true;
                        valid &= validateCountry() & validateName() & validatePhone();
                        valid &= validateSt() & validateCity() & validateState();
                        valid &= validateZip() & validateCard() & validateCardName();
                        valid &= validateExp();
                        console.log(valid);
                        // match with one of us given certain answers
                        if (valid) {
                                return true;
                        } else {
                                alert(errorMessage);
                                return false;
                        }

                }
        </script>
</body>
</html>