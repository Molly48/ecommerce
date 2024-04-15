<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Navigation Bar</title>
    <style>
        /* Your existing styles */

        .navbar {
            background: rgb(205, 192, 177);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3px;
        }

        .navbar ul {
            list-style-type: none;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin: 0 5px;
        }

        .navbar ul li:last-child {
            margin-left: auto;
        }

        .navbar ul li a {
            text-decoration: none;
            color: rgb(19, 18, 18);
            padding: 5px;
            display: block;
        }

        .navbar ul li a img.icon {
            width: 20px;
            height: 20px;
        }

        h1 {
            color: rgb(0, 0, 0);
            margin: 0;
            text-align: center;
            font-family: 'sans-serif';
            font-size: 28px;
        }

        h1 a {
            text-decoration: none;
            color: black;
        }

        .nav_cont {
            text-align: center;
        }

        .nav {
            display: flex;
            align-items: center;
            flex-direction: row;
            font-family: 'sans-serif';
        }

        .nav a {
            margin: 0 10px;
            text-decoration: none;
            color: rgb(19, 18, 18);
        }

        .welcome-container {
            margin-right: auto;
            margin-left: auto;
            color: black;
            text-align: center;
            margin-top: 10px; 
        }
    </style>
</head>

<body>
    <?php
    session_start(); 

    $curr_id = $_SESSION['seller_id'];

    if (!isset($curr_id))
        exit();
    ?>
    <!-- Navigation Bar -->
    <nav class="navbar">

        <h1><a href="">Glamfetti</a></h1>
        <div class="welcome-container">

            <?php
            // Check if the username is set in the session
            if (isset($_SESSION['username'])) {
                echo 'Welcome ' . $_SESSION['username'];
            }
            ?>
        </div>

        <div class="nav_cont">
            <nav class="nav">
                <h3>
                    <b><a href="displayproductsadmin.php">Manage Products</a></b>
                    <b><a href="displayshopper.php">Shopper</a></b>
                    <b><a href="displayseller.php">Seller</a></b>
                    <b><a href="adminlogin.php">Log Out</a></b>
                </h3>
            </nav>
        </div>
    </nav>
</body>
</html>
