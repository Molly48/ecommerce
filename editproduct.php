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
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        table {
            background-color: rgb(186, 169, 151);
            border-collapse: collapse;
            width: 59%;
            margin: 40px auto;
        }

        table, th, td {
            border: 3px solid #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: rgb(116, 98, 82);
            color: white;
        }

        td {
            background-color: rgb(186, 169, 151);
        }

        img {
            width: 100%;
            height: auto;
            max-width: 150px;
            max-height: 150px;
            border-radius: 5px;
        }

        textarea {
            width: 64%;
        }

        input[type="number"] {
        width: 50px;
        display: inline-block; /* Set display to inline-block */
        margin-right: 10px; /* Add some margin for spacing */
    }

        a, button {
            text-decoration: none;
            color: blue;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        a.add-product, button.add-product {
            background: rgb(116, 98, 82);
        }

        a.add-product:hover, button.add-product:hover {
            background-color: #0056b3;
        }

  
    </style>

<body>

    <?php
    include("DBConnection.php");

    //update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productId = isset($_POST["productId"]) ? $_POST["productId"] : "";
        $productName = isset($_POST["productName"]) ? $_POST["productName"] : "";
        $price = isset($_POST["price"]) ? $_POST["price"] : "";
        $color = isset($_POST["color"]) ? $_POST["color"] : "";
        //$sizes = isset($_POST["size"]) ? $_POST["size"] : [];
        $quantities = isset($_POST["quantity"]) ? $_POST["quantity"] : [];
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
    
        $qryUpdate = "";
        if (isset($_FILES['fileToUpload']) && $_FILES["fileToUpload"]["name"] != "") {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $imagePath = $target_file;

            $qryUpdate = "UPDATE products 
                            SET productName = '$productName', 
                                price = '$price', 
                                color = '$color', 
                                description = '$description', 
                                image = '$imagePath'
                            WHERE id = $productId";
        } else {
            // If no new image is uploaded, retain the existing path
            $qryUpdate = "UPDATE products 
                            SET productName = '$productName', 
                                price = '$price', 
                                color = '$color', 
                                description = '$description'
                            WHERE id = $productId";
        }
    
        // $query = "INSERT INTO products (productName, price, color, description, image, created_by, created_at) 
        //           VALUES ('$productName', '$price', '$color', '$description', '$imagePath', '$curr_id', NOW())";
    
        if (queryExecute($qryUpdate, $db)) {
            //step 2
            $last_product_id = mysqli_insert_id($db);
            foreach ($quantities as $index => $item) {
                // queryExecute("INSERT INTO product_size_quantify (product_id, size, quantity) 
                //             VALUES ('" . $last_product_id . "', '" . indexToSizeConverter($index) . "', '$item')", $db);
                queryExecute("UPDATE product_size_quantify 
                            SET quantity = '$item' 
                            WHERE product_id = '$productId' AND size = '" . indexToSizeConverter($index) . "'", $db);
            }
            
            echo "<h2>Product updated successfully !</h2>";
            $showLink = true;
        }
    }

    
    function queryExecute($sqlquery, $db)
    {
        $result = false;
        if(mysqli_query($db, $sqlquery))
        {
            $result = true;
        }
        return $result;
    }

    function indexToSizeConverter($index)
    {
        switch ($index) {
        case 0:
            return "XS";
            break;
        case 1:
            return "S";
            break;
        case 2:
            return "M";
            break;
        case 3:
            return "L";
            break;
        case 4:
            return "XL";
            break;
        case 5:
            return "XXL";
            break;
        case 6:
            return "3XL";
            break;
        default:
            return "4XL";
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
            $description = $row['description'];
            $image = $row['image'];


            $qry = "SELECT * FROM product_size_quantify WHERE product_id = '$id'";
            $res = mysqli_query($db, $qry);
            
            $sizeQuantity = [];
            while ($rw = mysqli_fetch_assoc($res)) {
                $sizeQuantity[$rw['size']] = $rw['quantity'];
            }

            ?>
              <form method="post" action="" enctype="multipart/form-data">
           <br>
         
        <table border="2" align="center" cellpadding="20" cellspacing="">
            <tr>
                <td colspan="2" style="text-align: center; font-size: 20px; font-weight: bold;">Edit Product</td>
            </tr>
            <tr>
                <input type="text" name="productId" size="60" value="<?php echo $id; ?>" style="display : none;">
                <td>Product Name :</td>
                <td> <input type="text" name="productName" size="60" value="<?php echo $productName; ?>"> </td>
            </tr>
            <tr>
                <td>Price :</td>
                <td> <input type="text" name="price" size="60" value="<?php echo $price; ?>"> </td>
            </tr>
            <tr>
                <td>Color :</td>
                <td> <input type="text" name="color" size="60" value="<?php echo $color; ?>"> </td>
            </tr>
            <tr>
                <td>Size & Quantity:</td>
                <td>
                    
                    <p>XS : <input type="number" name="quantity[]" size="10" value="<?php echo $sizeQuantity['XS']; ?>"> S : <input type="number" name="quantity[]" size="10" value="<?php echo $sizeQuantity['S']; ?>">M : <input type="number" name="quantity[]" size="10" value="<?php echo $sizeQuantity['M']; ?>">L : <input type="number" name="quantity[]" size="10" value="<?php echo $sizeQuantity['L']; ?>"></p> 

                    <p>XL :<input type="number" name="quantity[]" size="10" value="<?php echo $sizeQuantity['XL']; ?>">XXL :<input type="number" name="quantity[]" size="10" value="<?php echo $sizeQuantity['XXL']; ?>">3XL :<input type="number" name="quantity[]" size="10" value="<?php echo $sizeQuantity['3XL']; ?>">4XL :<input type="number" name="quantity[]" size="10" value="<?php echo $sizeQuantity['4XL']; ?>"></p>

                </td>
            </tr>
            <tr>
                <td>Description :</td>
                <td> <textarea name="description" rows="7" cols="40"><?php echo $description; ?></textarea> </td>
            </tr>
            <tr>
                <td>
                    <div class="input-box">
                        <span>Upload Image</span>
                        <td>
                            <img src="<?php echo $image; ?>"/><br>
                            <span>Update new picture?</span><br>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </td>
                    </div>
                </td>
            </tr>
            <tr>
                   
             
            </table>

            <button type="submit" name="submit" style="padding: 15px 30px; background: rgb(116, 98, 82); border: none; border-radius: 5px; font-weight: bold; color: white; cursor: pointer; font-size: 18px;">Update</button>

               </form>     
               
                   

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
