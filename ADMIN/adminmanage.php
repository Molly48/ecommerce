<?php
include "navbaradmin.html";
?>

<!DOCTYPE HTML>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Jost', sans-serif;
            background: rgb(205, 192, 177);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
        }

        table {
            background: rgb(87, 65, 40);
        }
    </style>
</head>

<body>
    <br>

    <?php
    include("DBConnection.php");
    $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
    $query = "SELECT id, username, password FROM user WHERE id LIKE '%$search%'";

    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
    ?>

    <table border="2" align="center" cellpadding="12" cellspacing="">
        <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Password</th>
        
            <th colspan="2">Actions</th>
        </tr>
        <?php 
        $counter = 1; // Initialize the counter variable
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $counter++; ?></td>
                <td><?php echo $row["username"];?></td>
                <td><?php echo $row["password"];?></td>
             
                <td><a href="edit_shopper.php?id=<?php echo $row["id"];?>&action=edit">Edit</a></td>
                <td><a href="delete_shopper.php?id=<?php echo $row["id"];?>&action=delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a></td>
            </tr>
        <?php } ?>
    </table>

    <?php
    } else {
        echo "<center>No users found with ID: $search</center>";
    }
    ?>

    <br>
    <div style="text-align: center;">
        <a href="EnterUser.php" style="text-decoration: none; padding: 10px 20px; background-color: lightgreen; color: white; font-weight: bold;">Add User</a>
        <a href="borrowlist.php" style="text-decoration: none; padding: 10px 20px; background-color: lightgreen; color: white; font-weight: bold;">Borrow List</a>
    </div>
</body>
</html>
