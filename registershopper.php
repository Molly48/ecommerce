<?php
session_start();
include('DBConnection.php');
include('navbar.html');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\fyp(diploma)\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\fyp(diploma)\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\fyp(diploma)\PHPMailer-master\src\SMTP.php'; 

$shopperusernameError = $shopperpasswordError = $emailaddressError = $phonenumberError = $shopperaddressError  = "";

$shopper_username = $shopper_password = $email_address = $phone_number = $shopper_address = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["shopper_username"])) {
    $shopperusernameError = "Username is required";
  } else {
    $shopper_username = test_input($_POST["shopper_username"]);
  }

  if (empty($_POST["shopper_password"])) {
    $shopperpasswordError = "Password is required";
  } else {
    $shopper_password = test_input($_POST["shopper_password"]);
  }

  if (empty($_POST["email_address"])) {
    $emailaddressError = "Email address is required";
  } else {
    $email_address = test_input($_POST["email_address"]);

  if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    $emailaddressError = "Invalid email format";
    }
  }

  if (empty($_POST["phone_number"])) {
    $phonenumberError = "Phone number is required";
  } else {
    $phone_number = test_input($_POST["phone_number"]);

    if (!ctype_digit($phone_number)) {
      $phonenumberError = "Phone number should contain only numeric digits";
    }
  }

  if (empty($_POST["shopper_address"])) {
    $shopperaddressError = "Address is required";
  } else {
    $shopper_address = test_input($_POST["shopper_address"]);
  }
}

function sendemail_verify($shopper_username, $email_address, $verify_token)
{
  $mail = new PHPMailer(true);

  $mail->SMTPDebug = 0;
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = 'smtp.gmail.com';
  $mail->Username = 'sitiraudah2011@gmail.com';
  $mail->Password = 'aqbnfbhkxgtjubmp';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;
  $mail->setFrom('sitiraudah2011@gmail.com', 'Siti Raudah');
  $mail->addAddress($email_address);
  $mail->isHTML(true);
  $mail->Subject = 'Email verification from Glamfetti';
  $email_template = "<h2> Please verify your email address to login with the below given link </h2>
   <br/><br/> 
   <a href='http://localhost/fyp(diploma)/shopperverify.php?token=$verify_token'> Click Here </a>";

  $mail->Body = $email_template;
  $mail->send();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($shopperusernameError) && empty($shopperpasswordError) && 
    empty($emailaddressError) && empty($phonenumberError) && empty($shopperaddressError) ) {

    if(isset($_POST['register'])) {
        $shopper_username = $_POST['shopper_username'];
        $shopper_password = $_POST['shopper_password'];
        $email_address = $_POST['email_address'];
        $phone_number = $_POST['phone_number'];
        $shopper_address = $_POST['shopper_address']; 
        $verify_token = md5(rand());

        $check_email_query = "SELECT email_address FROM shopper WHERE email_address = '$email_address' LIMIT 1";
        $check_email_query_run = mysqli_query($conn, $check_email_query);

        if(mysqli_num_rows($check_email_query_run) > 0) {
            $message = "Email address already exists.";
        } else {
            $query = "INSERT INTO shopper (shopper_username, shopper_password, email_address, phone_number, shopper_address, verify_token) VALUES ('$shopper_username', '$shopper_password', '$email_address', '$phone_number' , '$shopper_address','$verify_token')";

            $query_run = mysqli_query($conn, $query);

            if($query_run) {
                sendemail_verify("$shopper_username", "$email_address", "$verify_token");
                $message = "Your registration with Glamfetti is now successful! Please verify your email address."; 
            } else {
                $message = "Registration failed";
            }
        }
    }
}

?>

<script>
    <?php
        if (!empty($message)) {
            echo "alert('$message');";
        }
    ?>
</script>

<!DOCTYPE html>
<html lang="en">

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
      height: 90vh;
    }

    .main {
      width: 600px;
      height: auto;
      background-color: rgb(186, 169, 151);
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

    .input-box span.error-message {
    color: red;
    font-weight: normal; 
}

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="password"],
    input[type="tel"] {
      width: calc(100% - 10px); 
      padding: 15px; 
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      margin-bottom: 15px;
      font-size: 16px; 
      text-align: center; 
    }

    textarea[name="shopper_address"] {
      width: calc(100% - 10px);
      padding: 15px; 
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
      background-color: rgb(116, 98, 82);
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
            <h2>Shopper Registration Form</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <table>
                <tr>
                  <td>
            <div class="input-box">
                    <span>Username</span>
                    <input name="shopper_username" type="text">
                    <span class="error-message"><?php echo $shopperusernameError ?></span>
                </div>
 
                <div class="input-box">
                    <span>Password</span>
                    <input name="shopper_password" type="text">
                    <span class="error-message"><?php echo $shopperpasswordError ?></span>
                </div>
  </td>
  <td>
                <div class="input-box">
                    <span>Email Address</span>
                    <input name="email_address" type="text">
                    <span class="error-message"><?php echo $emailaddressError ?></span>
                </div>
                
                <div class="input-box">
                    <span>Phone Number</span>
                    <input name="phone_number" type="tel" >
                    <span class="error-message"><?php echo $phonenumberError ?></span>
                </div>
                </td>
          </tr>
        </table>
                <div class="input-box">
                    <span>Shopper Address</span>
                    <textarea name="shopper_address" rows="4"></textarea>
                    <span class="error-message"><?php echo $shopperaddressError ?></span>
                </div>
                
                <div class="button">
                    <input type="submit" name="register" value="REGISTER">
                </div>
            </form>
            <p>Already have an account? <a href="shopperlogin.php">Login Here</a></p>
        </div>
    </div>
 
</body>

</html>
