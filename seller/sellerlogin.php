<?php
require('db.php');
session_start();
include "navbarseller.html";

if (isset($_POST['username'])) {
    $sellername = stripslashes($_POST['username']);
    $sellername = mysqli_real_escape_string($con, $sellername);
    $numberphone = stripslashes($_POST['number']);
    $numberphone = mysqli_real_escape_string($con, $numberphone);

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM `seller` WHERE seller_name=? AND phone_number=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $sellername, $numberphone);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $rows = mysqli_stmt_num_rows($stmt);

    if ($rows == 1) {
        $_SESSION['sellername'] = $sellername;
        header("Location: mainpage.php");
    } else {
        echo "<div class='form'>
              <h3>Incorrect Seller Name/Phone Number.</h3><br/>
              <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
              </div>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Your code for handling cases when the form is not submitted
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<style>
    body {
        background: rgb(205, 192, 177);
        margin: 0;
        padding: 0;
        color: #fff;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
    }

    .main {
        width: 500px;
        height: auto;
        background: rgb(116, 98, 82);
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 5px 20px 50px #000;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }

    #chk {
        display: none;
    }

    .signup {
        position: relative;
        width: 80%;
        height: 80%;
    }

    label {
        color: #fff;
        font-size: 2.3em;
        justify-content: center;
        display: flex;
        margin: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: .5s ease-in-out;
    }

    input[type="text"], input[type="tel"] {
        width: 60%;
        height: 20px;
        background: #e0dede;
        justify-content: center;
        display: flex;
        margin: 20px auto;
        padding: 10px;
        border: none;
        outline: none;
        border-radius: 5px;
    }

    button {
        width: 60%;
        height: 40px;
        margin: 10px auto;
        justify-content: center;
        display: block;
        color: #fff;
        background: rgb(87, 65, 40);
        font-size: 1em;
        font-weight: bold;
        margin-top: 50px;
        outline: none;
        border: none;
        border-radius: 5px;
        transition: .2s ease-in;
        cursor: pointer;
    }

    button:hover {
        background: rgb(87, 65, 40);
    }

    .login {
        height: 460px;
        background: rgb(87, 65, 40);
        border-radius: 60% / 10%;
        transform: translateY(-180px);
        transition: .8s ease-in-out;
    }

    .login label {
        background: rgb(87, 65, 40);
        transform: scale(.6);
    }

    #chk:checked ~ .login {
        transform: translateY(-500px);
    }

    #chk:checked ~ .login label {
        transform: scale(1);
    }

    #chk:checked ~ .signup label {
        transform: scale(.6);
    }
</style>

<body>
<div class="container">
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">
            <form method="POST">
                <label for="chk" aria-hidden="true">Seller Login</label>
                <input type="text" name="Seller Name" placeholder="Seller Name" required="">
                <input type="tel" name="number" placeholder="Phone Number" required="">
                <button>Login</button>
            </form>
            <center>
                <p>Not have an account? <a href="registerseller.php">Register Here</a></p>
            </center>
</div>
</div>
</div>
</body>
</html>