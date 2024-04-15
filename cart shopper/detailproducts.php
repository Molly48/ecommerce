<?php
include "navbarseller.html";
include "DBConnection.php";

// Retrieve the product ID from the URL parameter
$productID = isset($_GET['id']) ? $_GET['id'] : '';

// Fetch product information based on the product ID
$query = "SELECT * FROM products WHERE id = '$productID'";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $productDetails = mysqli_fetch_assoc($result);
} else {
    echo "<p>No product found with the given ID</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
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
    <?php
   if (isset($productDetails)) {
    echo '<div>';
    echo '<h2>' . $productDetails["productName"] . '</h2>';
    echo '<p>RM ' . $productDetails["price"] . '</p>';
    echo '<img src="' . $productDetails["image"] . '" alt="Product Image">';
    // Add more details as needed
    echo '</div>';
};
    ?>
    </div>

</body>

</html>
