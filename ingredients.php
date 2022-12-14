<?php
    session_start();
    header('Cache-Control: no-cache, must-revalidate, max-age=0');
?>
<html>
    <head>
        <title>Grocer-Ease - Ingredients</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name='viewport' content="width=device-width, initial scale=1">
    </head>
    <style>
        #wrapper {
            margin-right: 10%;
            margin-left: 10%;
            text-align: center;
        }

        .brown_line {
            border: 5px solid #E9C9AD;
            border-radius: 5px;
            width: auto;
        }

        #ingredients {
            color: #585F67;
        }

        #ingredients ul {
            list-style-type: none;
        }

        #ingredients ul li {
            margin-bottom: 7px;
        }

        #ingredients ul li:last-child {
            margin-bottom: 0px;
        }

        #ingredientsTitle {
            font-size: 30px;
        }

        #recipeYield {
            font-size: 1.5em;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #recipeURL {
            font-size: 1.5em;
            padding-top: 10px;
            padding-bottom: 20px;
        }
        #recipe {
            margin-left: 0;
        }
        #linkButton:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function fetchIngredients(recipe) {
            const data = null;
            recipeFormatted = recipe.toLowerCase();
            const xhr = new XMLHttpRequest();
            xhr.withCredentials = true;

            xhr.addEventListener("readystatechange", function () {
                if (this.readyState === this.DONE) {
                    writeFromAPI(JSON.parse(this.responseText).hits);
                }
            });

            xhr.open("GET", "https://edamam-recipe-search.p.rapidapi.com/search?q=" + recipeFormatted);
            xhr.setRequestHeader("X-RapidAPI-Key", "d9038fa0e3mshdbe05e8a8172552p1f1fafjsnada1cd09000f");

            xhr.send(data);
        }

        function writeFromAPI (recipeArray) {
            var t = "<ul>";
            for (i = 0; i < recipeArray[0].recipe.ingredients.length; i++) {
                t += "<li><p>" + recipeArray[0].recipe.ingredients[i].text + "</p></li>";
            }
            t += "</ul>";
            document.getElementById("ingredients").innerHTML = t;
            servingSize = recipeArray[0].recipe.yield;
            document.getElementById("recipeYield").innerHTML = "Serves " + servingSize + " people";
            recipeURL = recipeArray[0].recipe.url;
            document.getElementById("recipeURL").innerHTML = "To get the full recipe, click <a id='linkButton' href='" + recipeURL + "' target='_blank'>HERE</a>!";
        }

        function writeAddToCartButton(recipe) {
            var t = "<form method='post'>"
                    + "<input type='submit' name='" + recipe + "' class='button' value='Add to Cart' />"
                    + "</form>";
            document.getElementById("addToCart").innerHTML = t;
        }

        window.onload= function() {
            params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });

            recipe = params.recipe;
            recipe = recipe.substring(1, recipe.length - 1);
            writeAddToCartButton(recipe);
            fetchIngredients(recipe);
            document.getElementById("recipe").innerHTML = "Enjoy " + recipe + "!";

            recipeImageFormatted = recipe.replaceAll(' ', '_');
            document.getElementById("recipeImage").innerHTML = "<img src='" + recipeImageFormatted + ".png' height='300'>";

            document.getElementById("ingredientsTitle").innerHTML = "Ingredients for " + recipe;
        }
    </script>
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
        <div id="wrapper">
            <button onclick="window.location.href='catalog.php'">Back to Catalog</button>
            <br />
            <h2 id="recipe"></h2>
            <div id="recipeImage"></div>
            <br />
            <hr class="brown_line">
            <h3 id="ingredientsTitle"></h3>
            <div id="ingredients"></div>
            <div id="recipeYield"></div>
            <div id="recipeURL"></div>
            <br />
            <div id="addToCart"></div>
        </div>
        <?php
            for ($i = 0; $i < count($_POST); $i++) {
                if (array_keys($_POST)[$i] == "Creamy_Tomato_Soup") {
                    $_SESSION["cart"]["Creamy Tomato Soup"] += 1;
                }
                if (array_keys($_POST)[$i] == "Mushroom_Lasagna") {
                    $_SESSION["cart"]["Mushroom Lasagna"] += 1;
                }
            }
        ?>
    </body>
</html>