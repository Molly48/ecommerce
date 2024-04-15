<?php
include("DBConnection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM shopper WHERE id = '$id'";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "User deleted successfully.";
    
        header("Location: DisplayUser.php");
        exit;
    } else {
        echo "Error deleting shopper.";
    }
} else {
    echo "Invalid user ID.";
}
?>


