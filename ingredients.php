<?php
    session_start();
?>
<html>
    <head>
        <title>Grocer-Ease - Ingredients</title>
        <link rel="stylesheet" href="style.css">
        <meta name='viewport' content="width=device-width, initial scale=1">
    </head>
    <script>
        function fetchIngredients(recipe) {
            const data = null;

            recipeFormatted = recipe.toLowerCase();

            console.log(recipeFormatted);

            const xhr = new XMLHttpRequest();
            xhr.withCredentials = true;

            xhr.addEventListener("readystatechange", function () {
                if (this.readyState === this.DONE) {
                    writeIngredients(JSON.parse(this.responseText).hits);
                }
            });

            xhr.open("GET", "https://edamam-recipe-search.p.rapidapi.com/search?q=" + recipeFormatted);
            xhr.setRequestHeader("X-RapidAPI-Key", "d9038fa0e3mshdbe05e8a8172552p1f1fafjsnada1cd09000f");

            xhr.send(data);
        }

        function writeIngredients (recipeArray) {
            console.log(recipeArray[0].recipe.ingredients);
            var t = "<ul>";
            for (i = 0; i < recipeArray[0].recipe.ingredients.length; i++) {
                t += "<li>" + recipeArray[0].recipe.ingredients[i].text + "</li>";
            }
            t += "</ul>";
            document.getElementById("ingredients").innerHTML = t;
        }

        window.onload= function() {
            params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });

            recipe = params.recipe;
            recipe = recipe.substring(1, recipe.length - 1);
            fetchIngredients(recipe);
            document.getElementById("recipe").innerHTML = recipe;
        }
    </script>
    <body>
        <div class="header">
            <h1 class="logo"><a href="index.html">HOME</a></h1>
            <div class="nav-bar">
                    <div><a href="catalog.php">Catalog</a></div>
                    <div><a href="cart.html">Shopping Cart</a></div>
            </div>
            <hr>
        </div>
        <h2 id="recipe"></h2>
        <div id="ingredients"></div>
        <?php 
            // echo "Tomato Soup: " . $_SESSION["cart"]["Creamy Tomato Soup"] . "<br />";
            // echo "Mushroom Lasagna: " . $_SESSION["cart"]["Mushroom Lasagna"] . "<br />";
        ?>
    </body>
</html>