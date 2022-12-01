<?php
    session_start();
?>
<header>
        <title>Grocer-Ease</title>
        <link rel="stylesheet" href="style.css">
        <script>
                let errorMessage = "";
                
                function getVals() {
                        errorMessage = "";
                        let valid = true;
                        // match with one of us given certain answers
                        if (valid) {
                                alert("Thank you for your response! We'll" +
                                " reach out with more details when we" + 
                                " find a good match!");
                        } else {
                                alert(errorMessage);
                        }

                }
        </script>
        <style>
                h2 {
                margin-left:25%;
                }
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
                button {
                background-color: #133965;
                border: none;
                font-size: 30px;
                color: #fff;
                border-radius: 25px;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                height: 75px;
                width: 300px;
                text-indent: 2%;
                }
                label {
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
                .exp-wrapper input[type=text] {
                width:7.5%;
                text-indent: 0%;
                text-align: center;
                }
        </style>
</header>
<body>
        <div class="header">
                <h1 class="logo"><a href="index.html">GROCER-EASE</a></h1>
                <div class="nav-bar">
                        <div class="catalog"><a href="catalog.php">Catalog</a></div>
                        <div class="cart"><a href="cart.html">Shopping Cart</a></div>
                </div>
                <hr>
        </div>

        <h2>
                Checkout
        </h2>
        <form>
        <div class="cardbox2">
                <label for="country">Country/Region</label></br>
                <input type="text" id="country" name="country" value=""></br>
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
        </div>
        <div class="cardbox2">
                <label for="card">Credit/Debit Card Number</label></br>
                <input type="text" id="card" name="card" value=""></br>
                <label for="cardName">Name on Card</label></br>
                <input type="text" id="cardName" name="cardName" value=""></br>
                <label for="cardName">Expiration Date</label></br>
                <div class="exp-wrapper">
                        <input autocomplete="off" id="month" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="MM" type="text" data-pattern-validate />
                        /
                        <input autocomplete="off" id="year" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="YY" type="text" data-pattern-validate />
                      </div>
                </br>
        </div>
        <div class="center">
                <button type="button" onClick="getVals(this.form)">Place Your Order</button>

        </div>
        </form>
</body>

