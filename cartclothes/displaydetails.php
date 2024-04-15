<?php
include "navbar.html";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Creative Product Card UI Design</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: rgb(205, 192, 177);
        }

        .container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 90px auto;
        }

        .card {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            max-width: 800px;
            display: flex;
            flex-direction: row;
        }

        .img-container {
            flex: 1;
            position: relative;
        }

        .img-container img {
            
            width: 100%;
            height: auto;
            display: block;
            border-radius: 10px 10px 0 0;
        }

        .product-info {
            
            padding: 30px;
            flex: 2;
        }

        h2 {
            margin-top: 0;
        }

        .size,
        .color,
        .quantity {
            margin-bottom: 30px;
        }

        .size h3,
        .color h3,
        .quantity h3 {
            margin: 0;
        }

        .size span,
        .color span {
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 5px;
            padding: 8px;
            border: 1px solid #ccc;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .size span.selected,
        .color span.selected {
            background: rgb(205, 192, 177);
        }

        .color span {
            border-radius: 50%;
        }

        .quantity-input {
            display: flex;
            align-items: center;
        }

        .quantity-input input {
            width: 40px;
            text-align: center;
            margin: 0 5px;
        }

        .product-description {
            margin-bottom: 20px;
        }

        .add-to-cart-btn {
            display: inline-block;
            padding: 10px;
            background-color: #4caf50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .add-to-cart-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="img-container">
                <img src="https://th.bing.com/th/id/OIP.U6nypwIrPc6kgUXB2KG5ewHaIg?rs=1&pid=ImgDetMainimg/">
            </div>
            <div class="product-info">
                <h2>CLOTHES</h2>
                <div class="size">
                    <h3>Size:</h3>
                    <span data-size="XS" onclick="selectOption(this)">XS</span>
                    <span data-size="S" onclick="selectOption(this)">S</span>
                    <span data-size="M" onclick="selectOption(this)">M</span>
                    <span data-size="L" onclick="selectOption(this)">L</span>
                </div>
                <div class="color">
                    <h3>Color:</h3>
                    <span data-color="Blue" onclick="selectOption(this)">Blue</span>
                    <span data-color="Red" onclick="selectOption(this)">Red</span>
                    <span data-color="Yellow" onclick="selectOption(this)">Yellow</span>
                    <span data-color="Green" onclick="selectOption(this)">Green</span>
                </div>
                <div class="quantity">
                    <h3>Quantity:</h3>
                    <div class="quantity-input">
                        <button onclick="decrementQuantity()">-</button>
                        <input type="number" value="1" id="quantity" min="1" max="100">
                        <button onclick="incrementQuantity()">+</button>
                    </div>
                </div>
                <div class="product-description">
                    <p>hddhevduwveewfvweyfvefyvewhajwiewueywidabwu
                        dwigqugqdgwuqgdwqudgqwuidgwq</p>
                </div>
                <a href="cart.php" class="add-to-cart-btn">Add to Cart</a>
            </div>
        </div>
    </div>

    <script>
        function incrementQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity < 100) {
                quantityInput.value = currentQuantity + 1;
            }
        }

        function decrementQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
            }
        }

        function selectOption(element) {
            // Remove the 'selected' class from all siblings
            var siblings = element.parentNode.childNodes;
            siblings.forEach(function (sibling) {
                if (sibling.nodeType === 1 && sibling !== element) {
                    sibling.classList.remove('selected');
                }
            });

            // Toggle the 'selected' class for the clicked element
            element.classList.toggle('selected');
        }
    </script>
</body>

</html>
