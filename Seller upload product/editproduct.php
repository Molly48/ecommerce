<?php
include "navbarseller.html";
?>

<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<center>
<style>
     body {
            background: rgb(205, 192, 177);
            margin: 0;
            margin: 0;
            padding: 0;
        }

    table {
        background-color: rgb(186, 169, 151);
    }
</style>

<body>

    <?php
    include("DBConnection.php");

    if (isset($_POST['submit'])) {
        $product_id = $_POST['product_id'];
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $quantity = $_POST['quantity'];
        
        // File upload logic
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow certain file formats
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowedFormats)) {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

            $query = "UPDATE products 
                      SET productName = '$productName', 
                          price = '$price', 
                          color = '$color', 
                          size = '$size', 
                          quantity = '$quantity', 
                          image = '$target_file'
                      WHERE id = '$product_id'";
            $result = mysqli_query($db, $query);

            var_dump($result);
            if ($result) {
                echo "Product information updated successfully.";
              
                exit;
            } else {
                echo "Error updating product information.";
            }
        } else {
            echo "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM products WHERE id = '$id'";
        $result = mysqli_query($db, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $productName = $row['productName'];
            $price = $row['price'];
            $color = $row['color'];
            $size = $row['size'];
            $description = $row['description'];
            $quantity = $row['quantity'];
            $image = $row['image'];  
            ?>
              <form method="post" action="updateproducts.php" enctype="multipart/form-data">
            <table border="2" align="center" cellpadding="20" cellspacing="">
                <tr>
                    <td colspan="2" style="text-align: center; font-size: 20px; font-weight: bold;">Edit Product</td>
                </tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <tr>
                        <td>Product Name:</td>
                        <td><input type="text" name="productName" size="48"value="<?php echo $productName; ?>"></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="text" name="price" name="price" size="48"value="<?php echo $price; ?>"></td>
                    </tr>
                    <tr>
                        <td>Color:</td>
                        <td><input type="text" name="color" name="color" size="48"value="<?php echo $color; ?>"></td>
                    </tr>
                    <tr>
                        <td>Size:</td>
                        <td><input type="text" name="size" size="48"value="<?php echo $size; ?>"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea type="text" name="description" rows="5" cols="46"value="<?php echo $description; ?>"></textarea></td>
                       
                    </tr>
                    <tr>
                        <td>Quantity:</td>
                        <td><input type="text" name="quantity" size="48"value="<?php echo $quantity; ?>"></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-box">
                            <span>Upload Image</span>
                               <td><input type="file" name="fileToUpload" required></td>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button type="submit" name="submit">Update</button>
                        </td>
                    </tr>
                </form>
            </table>
            <?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Invalid product ID.";
    }
    ?>

</body>
</center>

</html>
