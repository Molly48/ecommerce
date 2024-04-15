<?php
session_start(); 
include('DBConnection.php');

if(isset($_GET['token']))
{
	$token = $_GET['token'];
	$verify_query = "SELECT verify_token, verify_status FROM seller WHERE verify_token='$token' LIMIT 1";
	$verify_query_run = mysqli_query($conn, $verify_query);

	if(mysqli_num_rows($verify_query_run) > 0)
	{
		$row = mysqli_fetch_array($verify_query_run);
		if($row['verify_status'] == "0")
		{
			$clicked_token = $row['verify_token'];
			$update_query = "UPDATE seller SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";
			$update_query_run = mysqli_query($conn, $update_query);

			if($update_query_run)
			{
		      $message =  "Your account has been verified successfully.";
		      header("Location: sellerlogin.php");
		    }

		    else
		    {
		      $message = "Verification failed.";
		    }

		}

		else
		{
			$message = "Email already verified. Please login";
		}

	}

	else
	{
		$message = 'This token does not exists';
		header("Location: sellerlogin.php");
	}


}

else
{
	$message = "Not Allowed";
	header("Location: sellerlogin.php");
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

</html>
