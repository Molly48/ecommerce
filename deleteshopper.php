<?php
include("DBConnection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM shopper WHERE shopper_id = '$id'";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "Shopper deleted successfully.";
    
        header("Location: displayshopper.php");
        exit;
    } else {
        echo "Error deleting Shopper.";
    }
} else {
    echo "Invalid shopper id.";
}
?>


