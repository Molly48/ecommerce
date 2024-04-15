<?php
include("DBConnection.php");

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $productName = mysqli_real_escape_string($db, $_POST['productName']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $color = mysqli_real_escape_string($db, $_POST['color']);
    $size = mysqli_real_escape_string($db, $_POST['size']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);

    // Handle image upload (modify as needed)
    if (isset($_FILES['fileToUpload'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $imagePath = $target_file;
    } else {
        // If no new image is uploaded, retain the existing path
        $imagePath = mysqli_real_escape_string($db, $_POST['image']);
    }

    $query = "UPDATE products 
              SET productName = '$productName', 
                  price = '$price', 
                  color = '$color', 
                  size = '$size', 
                  description = '$description', 
                  image = '$imagePath', 
                  quantity = '$quantity' 
              WHERE id = '$id'";
    
    $result = mysqli_query($db, $query);
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
