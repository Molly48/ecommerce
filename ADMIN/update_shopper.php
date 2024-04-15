<?php
include("DBConnection.php");

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];

    $query = "UPDATE user SET username = '$newUsername', password = '$newPassword' WHERE id = '$id'";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "Shopper information updated successfully.";
        header("Location: shopperlogindisplay.php");
        exit;
    } else {
        echo "Error updating shopper information.";
    }
}
?>
