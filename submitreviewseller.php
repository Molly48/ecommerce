<?php
session_start();
include("DBConnection.php");

if(isset($_GET['rate']) && isset($_GET['comment']) && isset($_GET['prod_id']) && isset($_SESSION['email_address'])) {
    $rate = $_GET['rate'];
    $comment = $_GET['comment'];
    $prodid = $_GET['prod_id'];
 
    $query = "INSERT INTO product_review (product_id, rating, comment, posted_by) 
              VALUES ('$prodid', '$rate', '$comment', '" . $_SESSION['email_address'] . "')";
    $result = mysqli_query($db, $query);

    if ($result) {
        header("Location: detailsproductseller.php?prod_id=" . $prodid);
        exit;
    } else {
        echo "Error create review: " . mysqli_error($db);
    }
}
?>
