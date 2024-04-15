<?php
 include("DBConnection.php");
include "navbarloginshopper.html";
?>

<center>

<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Jost', sans-serif;
        background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
		background: rgb(205, 192, 177);
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

        .container {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		height: 100vh;
		margin: 0;
		padding: 0;
		font-family: 'Jost', sans-serif;
		background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
		background-image: url('');
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
	}

	.main {
		width: 500px;
		height: 500px;
		background: #993333;
		overflow: hidden;
		border-radius: 10px;
		box-shadow: 5px 20px 50px #000;
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
	font-size: 1.5 em;
	justify-content: center;
	display: flex;
	margin: 20px;
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
	background: #573b8a;
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
	background: #6d44b8;
}
.login{
	height: 460px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: #573b8a;
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
    <br>
    <?php
   // Create the shopper table if it doesn't exist
   $queryCreateTable = "CREATE TABLE IF NOT EXISTS shopper (
	   id INT PRIMARY KEY AUTO_INCREMENT,
	   username VARCHAR(255) NOT NULL,
	   password VARCHAR(255) NOT NULL,
	   email_address VARCHAR(255) NOT NULL,
	   phone_number VARCHAR(15) NOT NULL,
	   address VARCHAR(255) NOT NULL,
	   verification_code VARCHAR(50),
	   email_verified_at TIMESTAMP
   )";
   
   $resultCreateTable = mysqli_query($db, $queryCreateTable);
   
   if ($resultCreateTable) {
	   echo "Table 'shopper' created successfully.<br>";
   } else {
	   echo "Error creating table: " . mysqli_error($db) . "<br>";
   }
   
   $id = isset($_GET["id"]) ? $_GET["id"] : "";
   
   if ($id !== "") {
	   // Select user by ID from the database
	   $querySelectUser = "SELECT * FROM shopper WHERE id = '$id'";
	   $resultSelectUser = mysqli_query($db, $querySelectUser);
   
	   if (mysqli_num_rows($resultSelectUser) == 1) {
		   $row = mysqli_fetch_assoc($resultSelectUser);
		   $id = $row['id'];
		   $username = $row['username'];
		   $password = $row['password'];
		   ?>
   
		   <div class="container">
			   <div class="main">
				   <h1>Edit User</h1>
				   <form method="post" action="update_user.php">
					   <input type="hidden" name="id" value="<?php echo $id; ?>">
					   <label for="username">Username:</label>
					   <input type="text" name="username" id="username" value="<?php echo $username; ?>"><br><br>
					   <label for="password">Password:</label>
					   <input type="text" name="password" id="password" value="<?php echo $password; ?>"><br><br>
					   <input type="submit" name="submit" value="Update">
				   </form>
			   </div>
		   </div>
   
		   <?php
	   } else {
		   echo "User not found.";
	   }
   } else {
	   echo "Invalid User ID.";
   }
   
   // Close the database connection
   mysqli_close($db);
   ?>
   
   </body>
   <script src="path_to_your_script.js"></script>
   
</center>
