<?php
session_start();

// Destroy the session
session_destroy();

// Redirect the user to the main page
header("Location: adminlogin.php");
exit;
?>
