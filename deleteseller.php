<?php
include("DBConnection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM seller WHERE seller_id = $id";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "Seller deleted successfully.";
    
        header("Location: displayseller.php");
        exit;
    } else {
        echo "Error deleting Seller: " . mysqli_error($db);
    }
} else {
    echo "Invalid Seller id.";
}
?>




