<?php
session_start();
include('DBConnection.php');
include('navbar.html');


if (isset($_POST['login'])) {

    if (!empty(trim($_POST['seller_name'])) && !empty(trim($_POST['ic_number']))) {

        $email_address = mysqli_real_escape_string($conn, $_POST['seller_name']);
        $ic_number = mysqli_real_escape_string($conn, $_POST['ic_number']);

        $login_query = "SELECT * FROM seller WHERE seller_name ='$seller_name' AND ic_number='$ic_number' LIMIT 1";

        $login_query_run = mysqli_query($conn, $login_query);

        if (mysqli_num_rows($login_query_run) > 0) {
            $row = mysqli_fetch_array($login_query_run);

            if ($row['verify_status'] == "1") {

                $_SESSION['user_authenticated'] = true;
                $_SESSION['id'] = $row['id'];

                header("Location: mainpage.php");

            } else {

                $message = "Please verify your email address first.";

            }

        } else {

            $message = "Invalid seller name or Ic number";

        }
    } else {

        $message = "All fields are mandatory";

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
      background-color: rgb(186, 169, 151);
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
input{
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
    background-color: rgb(116, 98, 82);
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
			<form method="POST" action="sellerauthentication.php">
				<label for="chk" aria-hidden="true">Seller Login</label>
				<input type="text" name="seller_name" placeholder="Seller Name" required="">
				<input type="text" name="ic_number" placeholder="Ic Number" required="">
				<button>Login</button>
			</form>
			<center>
			<p>Not have an account? <a href="registerseller.php">Register Here</a></p>
            </center>
		</div>
	</div>
</div>
</div>
</div>
</body>
</html>