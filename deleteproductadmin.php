<?php
include("DBConnection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM products WHERE id = '$id'";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "Product deleted successfully.";
    
        header("Location: displayproductsadmin.php");
        exit;
    } else {
        echo "Error deleting product.";
    }
} else {
    echo "Invalid product id.";
}
?>


