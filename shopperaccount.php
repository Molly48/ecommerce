<?php
session_start();
include "navbarloginshopper.html";
?>
<!DOCTYPE HTML>
<html>

<head>
    <style>
        body {
            background: rgb(205, 192, 177);
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        table {
            background-color: rgb(186, 169, 151);
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        table,
        th,
        td {
            border: 2px solid #fff;
        }

        td.table-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: rgb(116, 98, 82);
            color: white;
        }

        td {
            background-color: rgb(186, 169, 151);
        }

        img {
            width: 100%;
            height: auto;
            max-width: 150px;
            max-height: 150px;
            border-radius: 5px;
        }

        a,
        button {
            text-decoration: none;
            color: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        a.edit,
        button.edit {
            background: rgb(116, 98, 82);
        }

        a.delete,
        button.delete {
            background: rgb(116, 98, 82);
        }

        button:hover.delete {
            background-color: #c82333;
        }

        div.add-product-btn {
            text-align: center;
            margin: 20px;
        }

        a.add-product,
        button.add-product {
            background: rgb(116, 98, 82);
        }

        a.add-product:hover,
        button.add-product:hover {
            background-color: #0056b3;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            width: calc(30% - 20px);
            margin: 10px;
            padding: 10px;
            background-color: rgb(186, 169, 151);
            border-radius: 10px;
            text-align: left;
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .card button {
            margin-top: 10px;
            width: 100%;
            background: rgb(116, 98, 82);
            font-size: 16px;
            font-weight: bold;
        }

        .edit-form {
            display: none;
            width: calc(30% - 20px);
            margin: 10px;
            padding: 20px;
            background-color: rgb(186, 169, 151);
            border-radius: 10px;
            text-align: left;
            box-sizing: border-box;
        }

        .edit-form label,
        .edit-form textarea {
            display: block;
            margin-bottom: 9px;
        }

        .edit-form input,
        .edit-form textarea {
            width: calc(100% - 20px); 
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 15px;
            font-size: 16px;
            text-align: center;
            resize: vertical; 
        }

        .card button,
        .edit-form button {
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

        .edit-form button:hover {
            background: rgb(87, 65, 40);
        }
    </style>
</head>

<body>
    <br>

    <?php
   include "DBConnection.php";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (isset($_POST['submit'])) {
           $shopperid = mysqli_real_escape_string($db, $_POST['shopper_id']);
           $shopperusername = mysqli_real_escape_string($db, $_POST['shopper_username']);
           $shopperpassword = mysqli_real_escape_string($db, $_POST['shopper_password']);
           $emailaddress = mysqli_real_escape_string($db, $_POST['email_address']);
           $phonenumber = mysqli_real_escape_string($db, $_POST['phone_number']);
           $shopperaddress = mysqli_real_escape_string($db, $_POST['shopper_address']);
   
           $query = "UPDATE shopper 
                     SET shopper_username = '$shopperusername', 
                         shopper_password = '$shopperpassword', 
                         email_address = '$emailaddress', 
                         phone_number = '$phonenumber', 
                         shopper_address = '$shopperaddress' 
                     WHERE shopper_id = '$shopperid'";
   
           $result = mysqli_query($db, $query);
   
           if ($result) {
               echo "";
           } else {
               echo "Error updating shopper information: " . mysqli_error($db);
           }
       
       }
   }

//    var_dump($_SESSION['email_address']);
   
   $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
   $query = "SELECT shopper_id, shopper_username, shopper_password, email_address, phone_number, shopper_address FROM shopper WHERE email_address = '" . $_SESSION['email_address'] . "'";
   $result = mysqli_query($db, $query);
   
   if (mysqli_num_rows($result) > 0) {
   ?>

<body>
    <br>

    <div class="card-container">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="card" id="card-<?php echo $row["shopper_id"]; ?>">
                <p><strong>Name:</strong> <?php echo $row["shopper_username"]; ?></p>
                <p><strong>Password:</strong> <?php echo $row["shopper_password"]; ?></p>
                <p><strong>Email Address:</strong> <?php echo $row["email_address"]; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $row["phone_number"]; ?></p>
                <p><strong>Address:</strong> <?php echo $row["shopper_address"]; ?></p>
                <button onclick="showEditForm(<?php echo $row["shopper_id"]; ?>)">Edit</button>
            </div>
            <div class="edit-form" id="edit-form-<?php echo $row["shopper_id"]; ?>">
                <!-- Form for editing information -->
                <form method="post" action="">
                    <input type="hidden" name="shopper_id" value="<?php echo $row["shopper_id"]; ?>">

                    <label for="edit-username">Name:</label>
                    <input type="text" name="shopper_username" value="<?php echo $row["shopper_username"]; ?>" required>

                    <label for="edit-password">Password:</label>
                    <input type="text" name="shopper_password" value="<?php echo $row["shopper_password"]; ?>" required>

                    <label for="edit-email">Email Address:</label>
                    <input type="email" name="email_address" value="<?php echo $row["email_address"]; ?>" required>

                    <label for="edit-phone">Phone Number:</label>
                    <input type="tel" name="phone_number" value="<?php echo $row["phone_number"]; ?>" required>

                    <label for="edit-address">Address:</label>
                    <textarea name="shopper_address" rows="4" required><?php echo $row["shopper_address"]; ?></textarea>

                    <button type="submit" name="submit">Update</button>
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <br>
    <script>
        function showEditForm(shopperId) {
            // Hide all cards
            document.querySelectorAll('.card').forEach(card => card.style.display = 'none');
            
            // Show the edit form for the clicked shopper
            document.getElementById(`edit-form-${shopperId}`).style.display = 'block';
        }
    </script>
</body>

</html>
<?php
} else {
    echo "<center>Not found shopper name: $search</center>";
}
?>