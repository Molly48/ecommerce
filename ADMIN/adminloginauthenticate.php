<?php
session_start();
include "DBConnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['password'] == $password) {
            $_SESSION['username'] = $username;
            header("Location: mainpage.php");
            exit();
        } else {
            header("Location: adminlogin.php?error=1");
            exit();
        }
    } else {
        header("Location: adminlogin.php?error=1");
        exit();
    }

    $stmt->close();
}

$db->close();
session_destroy();
?>
