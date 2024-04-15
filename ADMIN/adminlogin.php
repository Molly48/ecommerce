
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
      width: 450px;
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


	#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
}
label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 30px;
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
    background: rgb(87, 65, 40);
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
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
			<form method="POST" action="adminloginauthenticate.php">
				<label for="chk" aria-hidden="true">Admin Login</label>
				<input type="text" name="username" placeholder="Username" required="">
				<input type="password" name="password" placeholder="Password" required="">
				<button>Login</button>
			</form>
		</div>
	</div>
</div>




	<script src="path_to_your_script.js"></script>
</body>
</html>
