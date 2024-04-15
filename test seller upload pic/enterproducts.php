<?php
session_start();
error_reporting(0);

$curr_id = $_SESSION['seller_id'];

if(!isset($curr_id))
	exit();

include "navbarseller.html";

$showLink = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("DBConnection.php");

    $productName = isset($_POST["productName"]) ? $_POST["productName"] : "";
    $price = isset($_POST["price"]) ? $_POST["price"] : "";
    $color = isset($_POST["color"]) ? $_POST["color"] : "";
    //$sizes = isset($_POST["size"]) ? $_POST["size"] : [];
    $quantities = isset($_POST["quantity"]) ? $_POST["quantity"] : [];
    $description = isset($_POST["description"]) ? $_POST["description"] : "";

    if (isset($_FILES['fileToUpload'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $imagePath = $target_file;
    } else {
        // If no new image is uploaded, retain the existing path
        $imagePath = '';
    }

    $query = "INSERT INTO products (productName, price, color, description, image, created_by, created_at) 
              VALUES ('$productName', '$price', '$color', '$description', '$imagePath', '$curr_id', NOW())";

    if (queryExecute($query, $db)) {
		//step 2
		$last_product_id = mysqli_insert_id($db);
		foreach ($quantities as $index => $item) {
			queryExecute("INSERT INTO product_size_quantify (product_id, size, quantity) 
						VALUES ('" . $last_product_id . "', '" . indexToSizeConverter($index) . "', '$item')", $db);
		}
		
        echo "<h2>Product inserted successfully !</h2>";
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
?>

<!DOCTYPE HTML>
<html>

<head>
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
            color: #fff;
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
</head>

<body>
    <div class="link-container" style="<?php echo $showLink ? 'display:block;' : 'display:none;'; ?>">
        <a href='displayproducts.php'>Click here for product information</a>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <table border="2" align="center" cellpadding="20" cellspacing="">
            <tr>
                <td colspan="2" style="text-align: center; font-size: 20px; font-weight: bold;">Selling Product</td>
            </tr>
            <tr>
                <td>Product Name :</td>
                <td> <input type="text" name="productName" size="60"> </td>
            </tr>
            <tr>
                <td>Price :</td>
                <td> <input type="text" name="price" size="60"> </td>
            </tr>
            <tr>
                <td>Color :</td>
                <td> <input type="text" name="color" size="60"> </td>
            </tr>
            <tr>
                <td>Size & Quantity:</td>
                <td>
                    
                    <p>XS : <input type="number" name="quantity[]" size="10"> S : <input type="number" name="quantity[]" size="10">M : <input type="number" name="quantity[]" size="10">L : <input type="number" name="quantity[]" size="10"></p> 

                    <p>XL :<input type="number" name="quantity[]" size="10">XXL :<input type="number" name="quantity[]" size="10">3XL :<input type="number" name="quantity[]" size="10">4XL :<input type="number" name="quantity[]" size="10"></p>

                </td>
            </tr>
            <tr>
                <td>Description :</td>
                <td> <textarea name="description" rows="7" cols="40"></textarea> </td>
            </tr>
            <tr>
                <td>
                    <div class="input-box">
                        <span>Upload Image</span>
                        <td><input type="file" name="fileToUpload" id="fileToUpload" required></td>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" value="Add">
                    <input type="Reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
