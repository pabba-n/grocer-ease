<?php
    session_start();
    if (isset($_SESSION["cart"])) {
        //echo "cart set";
    } else {
        //echo "cart not set";
        $_SESSION["cart"] = array(
            "Creamy Tomato Soup" => 0,
             "Mushroom Lasagna" => 0,
        );
    }
?>
<html>
    <head>
        <title>Grocer-Ease - Catalog</title>
        <link rel="stylesheet" href="style.css">
        <meta name='viewport' content="width=device-width, initial scale=1">
        <style>
            body {
                margin-left: 10%;
                margin-right: 10%;
            }

            .recipe-info h3 {
                color: #133965;
            }

            .recipe table td:first-child {
                padding-right: 15px;
            }

            .recipe-info p {
                padding-left: 20px;
                color: #585F67;
            }

            .recipe {
                width: 100%;
                padding: 2% 5% 2% 2%;
                border-radius: 8px;
                background-color: #F3E9D9;
                border: 0;
                cursor: pointer;
                margin: 1em;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            }

            .button {
                float: right;
                border-radius: 8px;
                background-color: #133965;
                color: #fff;
                padding: 8px;
            }
        </style>
        <script>
            function Recipe(name, image, description) {
                this.name = name;
                this.image = image;
                this.description = description;
            }

            recipeArray = new Array(
                new Recipe("Creamy Tomato Soup", "tomatosoup.png", "A delicious tomato soup recipe. A delicious tomato soup recipe. A delicious tomato soup recipe."),
                new Recipe("Mushroom Lasagna", "lasagna.png", "A delicious lasagna recipe."),
            );

            function makeRecipe(name, image, description) {
                var t= "";
                t = "<button class='recipe' name='" + name + "' onclick='" + "location.href = &quot;ingredients.php?recipe=&apos;" 
                    + name + "&apos;&quot;;" + "'>" + "<table><tr><td><img src='" + image + "' alt= " + name 
                    + " height='150'></td><td><div class='recipe-info'>" + "<h3>" + name + "</h3><p>" + description 
                    + "</p></div></td></tr></table>"
                    + "<form method='post'>"
                    + "<input type='submit' name='" + name + "' class='button' value='Add to Cart' />"
                    + "</form>"
                    + "</button><br />" 
                return t;
            }

            window.onload= function() {
                for (i=0; i<recipeArray.length; i++) {
                    var s = "";
                    s += makeRecipe(recipeArray[i].name, recipeArray[i].image, recipeArray[i].description);
                    document.getElementById("wrapper").innerHTML += s;
                }
            }
        </script>
    </head>
    <body>
        <?php
            for ($i = 0; $i < count($_POST); $i++) {
                if (array_keys($_POST)[$i] == "Creamy_Tomato_Soup") {
                    $_SESSION["cart"]["Creamy Tomato Soup"] += 1;
                }
                if (array_keys($_POST)[$i] == "Mushroom_Lasagna") {
                    $_SESSION["cart"]["Mushroom Lasagna"] += 1;
                }
                // echo array_keys($_POST)[$i];
                // echo "<br />";
            }
        ?>
        <div class="header">
            <h1 class="logo"><a href="index.html">HOME</a></h1>
            <div class="nav-bar">
                    <div><a href="catalog.php">Catalog</a></div>
                    <div><a href="cart.html">Shopping Cart</a></div>
            </div>
            <hr>
        </div>
        <h2>Catalog</h2>
        <div id="wrapper">
        </div>
        <?php 
            // echo "Tomato Soup: " . $_SESSION["cart"]["Creamy Tomato Soup"] . "<br />";
            // echo "Mushroom Lasagna: " . $_SESSION["cart"]["Mushroom Lasagna"] . "<br />";
        ?>
    </body>
</html>