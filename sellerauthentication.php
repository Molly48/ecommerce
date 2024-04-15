<?php
session_start();
include "DBConnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['seller_name'];
    $password = $_POST['ic_number'];

    $sql = "SELECT * FROM seller WHERE seller_name = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['ic_number'] == $password) {
            $_SESSION['seller_name'] = $username;
			$_SESSION['seller_id'] = $row['seller_id'];
            header("Location: mainpageseller.php");
            exit();
        } else {
            header("Location: sellerlogin.php?error=1");
            exit();
        }
    } else {
        header("Location: sellerlogin.php?error=1");
        exit();
    }

    $stmt->close();
}

$db->close();
session_destroy();
?>
