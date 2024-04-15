<?php
include "navbarseller.html";
?>

<!DOCTYPE HTML>
<html>

<center>
<style>
  body {
        background: rgb(205, 192, 177);
        margin: 0;
        padding: 0;
    }

    img {
        width: 100%; 
        height: auto; 
    }

    h1 {
        color: blue;
        text-align: center;
    }

    .button-container {
        text-align: center;
        margin-top: 20px;
    }

    .button-container a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3498db; /* You can change the background color */
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
</style>

<body>

    <?php
    include("DBConnection.php");

    $productName = isset($_POST["productName"]) ? $_POST["productName"] : "";
    $price = isset($_POST["price"]) ? $_POST["price"] : "";
    $color = isset($_POST["color"]) ? $_POST["color"] : "";
    $size = isset($_POST["size"]) ? $_POST["size"] : "";
    $description = isset($_POST["description"]) ? $_POST["description"] : "";
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : 0;
    if (isset($_FILES['fileToUpload'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $imagePath = $target_file;
    } else {
        // If no new image is uploaded, retain the existing path
        $imagePath = '';
    }
   
    $query = "INSERT INTO products (productName, price, color, size, description, image, quantity, created_at) 
              VALUES ('$productName', '$price', '$color', '$size', '$description', '$imagePath', $quantity, NOW())";

    $result = mysqli_query($db, $query);

    if ($result) {
        echo "<h1>Product inserted successfully !</h1>";
    } 
    ?>
 <div class="button-container">
        <a href='displayproducts.php'>Click here for product information</a>
    </div>
</body>
</center>
</html>
