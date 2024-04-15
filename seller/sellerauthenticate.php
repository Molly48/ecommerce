<?php
    session_start();
    if(!isset($_SESSION["sellername"])) {
        header("Location: sellerlogin.php");
        exit();
    }
?>

