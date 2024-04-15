<?php
include "navbarseller.html";
include "DBConnection.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
<script>
        function showProductDetails(productName, price, image) {
           
            window.location.href = "detailsproductseller.php?productName=" + productName + "&price=" + price + "&image=" + image;
        }
    </script>
</head>
    <style>
        body {
            background: rgb(205, 192, 177);
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        img {
            width: 100%;
            height: auto;
        }

        img:not(:first-of-type) {
            border-top-left-radius: 50%;
            border-top-right-radius: 50%;
            width: 150%; /* Make the images a bit bigger */
            height: auto;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Center items horizontally */
            align-items: flex-start; /* Align items at the top */
            margin: 30px auto;
            max-width: 2000px; /* Set a maximum width for the container */
        }

        .card {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            width: 200px; /* Set a fixed width for each card */
            margin: 9px;
            text-align: center;
            text-decoration: none;
            color: black;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .img-container {
            position: relative;
        }

        .img-container img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 10px 10px 0 0;
        }

        .product-info {
            padding: 10px;
        }

        h5, p {
            margin: 10px 0;
            color: black;
        }

        a {
            text-decoration: none;
        }
    </style>


<body>

<img src="Fashion.png" alt="">

<div class="container" id="productList">
    <?php
    // Fetch product information from the database
    $query = "SELECT id, productName, price, image FROM products";
    $result = mysqli_query($db, $query);

    $counter = 0; // Counter for keeping track of the number of cards in a row

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <a href="detailsproductseller.php?prod_id=<?php echo $row["id"]; ?>" style="text-decoration: none;">
                <div class="card">
                    <div class="img-container">
                        <img src="<?php echo $row["image"]; ?>" alt="Product Image">
                    </div>
                    <div class="product-info">
                        <h5><?php echo $row["productName"]; ?></h5>
                        <h5>RM <?php echo $row["price"]; ?></h5>
                    </div>
                </div>
            </a>
            <?php
            $counter++;
            // Start a new row after every 6 cards
            if ($counter % 6 == 0) {
                echo '<br>';
            }
        }
    } else {
        echo "<p>No products found</p>";
    }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mySearch').on('keyup', function() {
            searchProducts();
        });
    });
    
    function searchProducts() {
        var searchTerm = $('#mySearch').val().toLowerCase();
        $('#productList .card').each(function() {
            var productName = $(this).find('.product-info h5:first').text().toLowerCase();
            if (productName.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
</script>

</body>

</html>
