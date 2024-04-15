<?php
session_start();
include "DBConnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['email_address'];
    $password = $_POST['shopper_password'];

    $sql = "SELECT * FROM shopper WHERE email_address = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['shopper_password'] == $password) {
            $_SESSION['email_address'] = $username;
            header("Location: mainpageshopper.php");
            exit();
        } else {
            header("Location:shopperlogin.php?error=1");
            exit();
        }
    } else {
        header("Location: shopperlogin.php?error=1");
        exit();
    }

    $stmt->close();
}

$db->close();
session_destroy();
?>
