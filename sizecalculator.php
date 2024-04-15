<?php
include "navbar.html";
?>

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
            justify-content: space-around; /* Adjusted to make side by side */
            align-items: center;
            height: 90vh;
        }

        .main {
            width: 350px;
            height: auto;
            background: rgb(116, 98, 82);
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .main h2 {
            margin-bottom: 20px;
        }

        .input-box {
            margin-bottom: 15px;
        }

        .input-box span {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
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

        img {
            max-width: 100%; /* Make sure the image doesn't exceed its container */
            height: auto; /* Maintain aspect ratio */
            border-radius: 10px; /* Optional: Add border radius to the image */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="main">
        <h2>Size Calculator</h2>
        <form method="post">
            Height (cm): <input type="text" name="height_cm"><br><br>
            Weight (kg): <input type="text" name="weight_kg"><br><br>
            <input type="submit" name="calculate" value="Calculate"> 
        </form>
        <?php
   
   function BMI($height, $weight) {
       $height_m = $height / 100; 
       $bmi = $weight / pow($height_m, 2);
       return $bmi;
   }

   if (isset($_POST['calculate'])) {
       $height = $_POST['height_cm'];
       $weight = $_POST['weight_kg'];
   
       if (empty($height) || empty($weight) || !is_numeric($height) || !is_numeric($weight)) {
           echo "<br><br>Please enter valid height (cm) and weight (kg).";
       } else {
           $bmi = BMI($height, $weight);
           echo "<br><br>The recommended clothing size is ";
   
           if ($bmi < 18.5) {
               echo "XS and S";
           } else if ($bmi >= 18.5 && $bmi < 24.9) {
               echo "M and L";
           } else if ($bmi >= 24.9 && $bmi < 30) {
               echo "XL and XXL";
           } else if ($bmi >= 30) {
               echo "3XL and 4XL";
           }
       }
   } else {
       echo "<br><br>Please enter your height (cm) and weight (kg).";
   }
   
   ?>
    </div>
    <img src="image/sizecalculator glamfetti.png" alt="Clothing Image" style="max-width: 58%; box-shadow: 5px 20px 50px #000;">

</div>

</body>
</html>
