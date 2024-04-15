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
            margin: 40px auto;
        }

        .card {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            max-width: 200px;
            text-decoration: none;
            color: black;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .img-container {
            position: relative;
        }

        .img-container img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 10px 10px 0 0;
        }

        .product-info {
            padding: 10px;
            text-align: center;
        }

        h3 {
            margin-top: 0;
            color: black;
            text-decoration: none;
            margin-bottom: 5px; /* Add margin-bottom to create space between the heading and price */
        }

        p {
            margin: 0; /* Reset margin to avoid extra space */
            font-size: 14px;
        }

        .size {
            margin-bottom: 9px;
        }

        .size h3,
        .color h3 {
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

        .size span:hover,
        .color span:hover {
            background-color: #eee;
        }

        .color span {
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="img-container">
                <a href="displaydetails.php" style="text-decoration: none;">
                    <img src="https://th.bing.com/th/id/OIP.U6nypwIrPc6kgUXB2KG5ewHaIg?rs=1&pid=ImgDetMainimg/">
                    <div class="product-info">
                        <h3>Dark Blue T-shirt</h3>
                        <p>RM20.00</p>
                    </div>
                </a>
            </div>
    </div>
        <div class="card">
            <div class="img-container">
                <a href="displaydetails.php" style="text-decoration: none;">
                    <img src="https://cdnp.sanmar.com/medias/sys_master/images/images/h01/h5d/8806071894046/4085-Black-5-2000LBlackFlatFront-1200W.jpg">
                    <div class="product-info">
                        <h3>Black Collar T-shirt</h3>
                        <p>RM20.00</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
