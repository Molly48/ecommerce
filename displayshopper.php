<?php
include "navbaradmin.php";
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

        table, th, td {
            border: 2px solid #fff;
        }

        td.table-cell {
            max-width: 200px; /* Set a fixed width for all cells */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        th, td {
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

        a, button {
            text-decoration: none;
            color: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        a.edit, button.edit {
            background: rgb(116, 98, 82); 
        }

        a.delete, button.delete {
            background: rgb(116, 98, 82); 
        }


        button:hover.delete {
            background-color: #c82333; 
        }

        div.add-product-btn {
            text-align: center;
            margin: 20px;
        }

        a.add-product, button.add-product {
            background: rgb(116, 98, 82);
        }

        a.add-product:hover, button.add-product:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <br>

    <?php
    include("DBConnection.php");
    $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
    $query = "SELECT shopper_id, shopper_username, shopper_password, email_address, phone_number, shopper_address FROM shopper WHERE shopper_username LIKE '%$search%'";

    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
    ?>

    <table>
        <tr>
            <th>No.</th>
            <th>Shopper Name</th>
            <th>Password</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th>Shopper Address</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php 
        $counter = 1; 
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
               <tr>
                <td class="table-cell"><?php echo $counter++; ?></td>
                <td class="table-cell"><?php echo $row["shopper_username"];?></td>
                <td class="table-cell"><?php echo $row["shopper_password"];?></td>
                <td class="table-cell"><?php echo $row["email_address"];?></td>
                <td class="table-cell"><?php echo $row["phone_number"];?></td>
                <td class="table-cell"><?php echo $row["shopper_address"];?></td>
     
               
                <td class="table-cell"><button onclick="confirmDelete(<?php echo $row['shopper_id']; ?>)" class="delete">Delete</button><i class="fas fa-trash-alt"></i></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php
    } else {
        echo "<center>Not found shopper name: $search</center>";
    }
    ?>
    <br>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this shopper?")) {
                window.location.href = "deleteshopper.php?id=" + id;
            }
        }
    </script>

</body>
</html>

