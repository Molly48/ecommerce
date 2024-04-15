<?php
session_start();
require('db.php');
include "navbarseller.html";

if (isset($_POST['REGISTER'])) {
    // Seller Registration
    $seller_name = $_POST['seller_name'];
    $shop_name = $_POST['shop_name'];
    $ic_number = $_POST['ic_number'];
    $ssm_number = $_POST['ssm_number'];
    $email_address = $_POST['email_address']; // Include email field
    $phone_number = $_POST['phone_number'];
    $shop_address = $_POST['shop_address'];
    $verification_code = generateVerificationCode(); // Implement your logic to generate verification code

    if (!empty($email_address) && !empty($phone_number) && is_numeric($phone_number)) {
        $query = "INSERT INTO seller (seller_name, shop_name, ic_number, ssm_number, email_address, phone_number, shop_address, verification_code) 
                  VALUES ('$seller_name', '$shop_name', '$ic_number', '$ssm_number', '$email_address', '$phone_number', '$shop_address', '$verification_code')";
        mysqli_query($con, $query);
        echo "<script type='text/javascript'>alert('Seller registered successfully');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Please enter valid seller information');</script>";
    }
}

function generateVerificationCode() {
    // Implement your logic to generate a unique verification code
    return md5(uniqid(rand(), true));
}
?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
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
      height: 100vh;
    }

    .main {
      width: 600px;
      height: auto;
      background: rgb(116, 98, 82);
      overflow: hidden;
      border-radius: 10px;
      box-shadow: 5px 20px 50px #000;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 30px; 
    }

    .main h2 {
      margin-bottom: 20px;
    }

    .input-box {
      margin-bottom: 15px;
      text-align: center; 
    }

    .input-box span {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="num"],
    input[type="password"],
    input[type="tel"] {
      width: calc(100% - 10px); /* Adjust width */
      padding: 15px; /* Adjust padding */
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      margin-bottom: 15px;
      font-size: 16px; 
      text-align: center; 
    }

    textarea[name="shop-address"] {
      width: calc(100% - 10px); /* Adjust width */
      padding: 15px; /* Adjust padding */
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      margin-bottom: 15px;
      font-size: 16px; 
      resize: vertical; 
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      color: #fff;
      background: rgb(70, 52, 32);
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease-in-out;
    }

    input[type="submit"]:hover {
      background: rgb(87, 65, 40);
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="main">
      <h2>Seller Registration Form</h2>
      <form class="form" action="verificationcode.php" method="post">
        <table>
          <tr>
            <td>
              <div class="input-box">
                <span>Seller Name</span>
                <input name="sellername" type="text" required>
              </div>
              <div class="input-box">
                <span>Shop Name</span>
                <input name="shopname" type="text" required>
              </div>
              <div class="input-box">
                <span>IC Number</span>
                <input name="icnumber" type="text" required>
              </div>
            </td>
            <td>
              <div class="input-box">
                <span>SSM Number</span>
                <input name="ssmnumber" type="text" required>
              </div>
              <div class="input-box">
                <span>Email Address</span>
                <input name="emailaddress" type="email" required>
              </div>
              <div class="input-box">
                <span>Number Phone</span>
                <input name="telnumber" type="tel" required>
              </div>
            </td>
          </tr>
        </table>

        <div class="input-box">
          <span>Shop Address</span>
          <textarea name="shop-address" rows="4" required></textarea>
        </div>

        <div class="button">
          <input type="submit" name="register" value="REGISTER">
     
        </div>
      </form>
      <p>Already have an account? <a href="sellerlogin.php">Login Here</a></p>
    </div>
  </div>
</body>
</html>
