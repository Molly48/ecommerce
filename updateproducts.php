<?php
include("DBConnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $productName = mysqli_real_escape_string($db, $_POST['productName']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $color = mysqli_real_escape_string($db, $_POST['color']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : array(); // Assuming quantity is an array

    // Handle image upload (modify as needed)
    $imagePath = $_POST['image']; // Retain the existing path by default

    if (isset($_FILES['fileToUpload'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        // Validate and sanitize file upload
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedFormats = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowedFormats)) {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $imagePath = $target_file;
        } else {
            echo "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }
    }

    // Update product information
    $query = "UPDATE products 
              SET productName = '$productName', 
                  price = '$price', 
                  color = '$color', 
                  description = '$description', 
                  image = '$imagePath' 
              WHERE id = '$id'";

    $result = mysqli_query($db, $query);

    // Update size and quantity in the product_size_quantify table
    foreach ($quantity as $size => $item) {
        $size = mysqli_real_escape_string($db, $size);
        $item = mysqli_real_escape_string($db, $item);
        $query = "UPDATE product_size_quantify 
                  SET quantity = '$item' 
                  WHERE product_id = '$id' AND size = '$size'";

        $result = mysqli_query($db, $query);
    }

    if ($result) {
        echo "Product information updated successfully.";
        // Redirect to the display page after update
        header("Location: displayproducts.php");
        exit;
    } else {
        echo "Error updating product information: " . mysqli_error($db);
    }
} else {
    echo "Invalid request.";
}
?>
