<?php
session_start();
include "navbarseller.html";
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

        .card,
        .edit-form {
            width: calc(30% - 20px);
            margin: 30px;
            padding: 50px;
            background-color: rgb(186, 169, 151);
            border-radius: 10px;
            text-align: left;
            box-sizing: border-box;
        }

        .card h3 {
            margin-bottom: 10px;
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

        .edit-form label,
        .edit-form textarea {
            display: block;
            margin-bottom: 9px;
        }

        .edit-form input,
        .edit-form textarea {
            width: calc(100% - 20px); /* Adjust the width as needed */
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 15px;
            font-size: 16px;
            text-align: center;
            resize: vertical;
        }

        .edit-form {
            display: none; /* Initially hide all edit forms */
        }
    </style>
</head>
<body>
    <br>

    <?php
    include("DBConnection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
            $sellerId = mysqli_real_escape_string($db, $_POST['seller_id']);
            $sellerName = mysqli_real_escape_string($db, $_POST['seller_name']);
            $ssmNumber = mysqli_real_escape_string($db, $_POST['ssm_number']);
            $shopName = mysqli_real_escape_string($db, $_POST['shop_name']);
            $emailAddress = mysqli_real_escape_string($db, $_POST['email_address']);
            $icNumber = mysqli_real_escape_string($db, $_POST['ic_number']);
            $phoneNumber = mysqli_real_escape_string($db, $_POST['phone_number']);
            $shopAddress = mysqli_real_escape_string($db, $_POST['shop_address']);

            $query = "UPDATE Seller 
                      SET seller_name = '$sellerName', 
                          ssm_number = '$ssmNumber', 
                          shop_name = '$shopName', 
                          email_address = '$emailAddress', 
                          ic_number = '$icNumber', 
                          phone_number = '$phoneNumber', 
                          shop_address = '$shopAddress' 
                      WHERE seller_id = '$sellerId'";

            $result = mysqli_query($db, $query);

            if ($result) {
                echo "";
            } else {
                echo "Error updating seller information: " . mysqli_error($db);
            }
        }
    }

    $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
    $query = "SELECT seller_id, seller_name, ssm_number, shop_name, email_address, ic_number, phone_number, shop_address FROM Seller WHERE seller_id = '" . $_SESSION['seller_id'] . "' AND seller_name = '" . $_SESSION['seller_name'] . "'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
    ?>

        <body>
            <br>

            <div class="card-container">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="card" id="card-<?php echo $row["seller_id"]; ?>">
                        <p><strong>Name:</strong> <?php echo $row["seller_name"]; ?></p>
                        <p><strong>SSM Number:</strong> <?php echo $row["ssm_number"]; ?></p>
                        <p><strong>Shop Name:</strong> <?php echo $row["shop_name"]; ?></p>
                        <p><strong>Email Address:</strong> <?php echo $row["email_address"]; ?></p>
                        <p><strong>IC Number:</strong> <?php echo $row["ic_number"]; ?></p>
                        <p><strong>Phone Number:</strong> <?php echo $row["phone_number"]; ?></p>
                        <p><strong>Shop Address:</strong> <?php echo $row["shop_address"]; ?></p>
                        <button onclick="showEditForm(<?php echo $row["seller_id"]; ?>)">Edit</button>
                    </div>
                    <div class="edit-form" id="edit-form-<?php echo $row["seller_id"]; ?>">
                        <!-- Form for editing information -->
                        <form method="post" action="">
                            <input type="hidden" name="seller_id" value="<?php echo $row["seller_id"]; ?>">

                            <label for="edit-name">Name:</label>
                            <input type="text" name="seller_name" value="<?php echo $row["seller_name"]; ?>" required>

                            <label for="edit-ssmnumber">SSM Number:</label>
                            <input type="text" name="ssm_number" value="<?php echo $row["ssm_number"]; ?>" required>

                            <label for="edit-shopname">Shop Name:</label>
                            <input type="text" name="shop_name" value="<?php echo $row["shop_name"]; ?>" required>

                            <label for="edit-email">Email Address:</label>
                            <input type="tel" name="email_address" value="<?php echo $row["email_address"]; ?>" required>

                            <label for="edit-icnumber">IC Number:</label>
                            <input type="text" name="ic_number" value="<?php echo $row["ic_number"]; ?>" required>

                            <label for="edit-phone">Phone Number:</label>
                            <input type="tel" name="phone_number" value="<?php echo $row["phone_number"]; ?>" required>

                            <label for="edit-address">Shop Address:</label>
                            <textarea name="shop_address" rows="4" required><?php echo $row["shop_address"]; ?></textarea>

                            <button type="submit" name="submit">Update</button>
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>

            <br>
            <script>
                function showEditForm(sellerId) {
                    // Hide all edit forms
                    document.querySelectorAll('.edit-form').forEach(editForm => editForm.style.display = 'none');

                    // Hide all cards
                    document.querySelectorAll('.card').forEach(card => card.style.display = 'block');

                    // Show the edit form for the clicked seller
                    document.getElementById(`edit-form-${sellerId}`).style.display = 'block';

                    // Hide the corresponding card
                    document.getElementById(`card-${sellerId}`).style.display = 'none';
                }
            </script>
        </body>

        </html>
    <?php
    } else {
        echo "<center>Not found seller name: $search</center>";
    }
    ?>