<?php
include "navbarloginshopper.html";

include 'db.php';

if (isset($_POST["verify"])) {
    $email = $_GET["email"]; 
    $user_entered_code = $_POST["shopperverify.php"];

    $conn = mysqli_connect("localhost:3306", "root", "", "fypdiploma");

    $sql = "SELECT fypdiploma FROM users WHERE shopper = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $stored_code);
    mysqli_stmt_fetch($stmt);

    if ($user_entered_code == $stored_code) {
 
        $update_sql = "UPDATE users SET email_verified_at = NOW() WHERE email = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "s", $email);
        mysqli_stmt_execute($update_stmt);

        header("Location: mainpage.php");
        exit();
    } else {
        echo "Verification code does not match. Please try again.";
    }
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


	#chk{
	display: none;
}
.signup{
	position: relative;
	width:80%;
	height: 80%;
}
label{
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
button{
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
button:hover{
    background: rgb(87, 65, 40);
}
.login{
	height: 460px;
    background: rgb(87, 65, 40);
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
    background: rgb(87, 65, 40);
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}
</style>



<body>
<div class="container">
	<div class="main">
		<input type="checkbox" id="chk" aria-hidden="true">
		<div class="signup">
			<form method="POST" action="sellerloginauthenticate.php">
				<label for="chk" aria-hidden="true">OTP Verification</label>
				<input type="text" name="code" placeholder="Enter verification code" required="">
				<button>Submit</button>
			</form>
		</div>
	</div>
</div>

	<script src="path_to_your_script.js"></script>
</body>
</html>
