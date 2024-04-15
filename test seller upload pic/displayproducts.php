<?php
session_start();
error_reporting(0);

$curr_id = $_SESSION['seller_id'];

if(!isset($curr_id))
	exit();

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
		
		#myTable_filter {
			display : none;
		}
    </style>
	<link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
	


</head>

<body>
    <br>

    <?php
    include("DBConnection.php");
    $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
    $query = "SELECT id, productName, price, color, description, image FROM products WHERE productName LIKE '%$search%' AND created_by = '$curr_id'";

    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
    ?>
	
    <div style="margin : 50px; padding : 30px; background-color : rgb(222, 210, 197); border-radius : 30px;">
	<table id="myTable">
		<thead>
        <tr>
            <th>No.</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Color</th>
            <th>Size & Quantity</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
			<th></th>
        </tr>
		</thead>
		<tbody>
        <?php 
        $counter = 1; 
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
               <tr>
                <td class="table-cell"><?php echo $counter++; ?></td>
                <td class="table-cell"><?php echo $row["productName"];?></td>
                <td class="table-cell"><?php echo $row["price"];?></td>
                <td class="table-cell"><?php echo $row["color"];?></td>
                <td class="table-cell">
				<?php
				$query2 = "SELECT size, quantity FROM product_size_quantify WHERE product_id='" . $row["id"] . "'";

				$result2 = mysqli_query($db, $query2);
				while ($row2 = mysqli_fetch_assoc($result2)) {
					echo "Size : " . $row2["size"] . "  -  Quantity : " . $row2["quantity"] . " <br> ";
				}
				?>
				</td>
                <td class="table-cell"><?php echo $row["description"];?></td>
                <td class="table-cell"><img src="<?php echo $row["image"]; ?>" alt="Image"></td>
                <td class="table-cell"><a href="editproduct.php?id=<?php echo $row["id"];?>" class="edit">Edit</a></td>
                <td class="table-cell"><button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="delete">Delete</button><i class="fas fa-trash-alt"></i></td>
            </tr>
            <?php
        }
        ?>
		</tbody>
    </table>
	</div>

    <?php
    } else {
        echo "<center>No products found with the name: $search</center>";
    }
    ?>
    <br>

    <div class="add-product-btn">
        <a href="enterproducts.php" class="add-product">Add Product</a>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = "deleteproducts.php?id=" + id;
            }
        }
		
		let table = new DataTable('#myTable', {
			searching: true
		});
		
		//mySearch
		document.getElementById('mySearch').addEventListener('input', function() {
			let searchTerm = this.value.trim();
			table.search(searchTerm).draw();
		});
    </script>

</body>
</html>
