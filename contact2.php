<?php
include "navbarloginshopper.html";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Website</title>
    <style>
        body {
            background: rgb(205, 192, 177);
        }

        h1 {
            text-align: center;
        }

        .testimonial-container {
            display: flex;
            justify-content: center;
            align-items: stretch; /* Align items to stretch vertically */
            padding: 50px;
        }

        .testimonial {
            border: 3px solid #fff;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            max-width: 400px;
            text-align: center;
            display: flex;
            flex-direction: column; /* Align content in a column */
            align-items: center;
        }

        .testimonial img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        /* Contact Info Styles */
        .contact-info {
            flex: 1;
            max-width: 400px;
            padding-left: 20px;
        }

        /* Footer Styles */
        footer {
            background: rgb(205, 192, 177);
            padding: 0px;
            text-align: center;
        }
    </style>
</head>

<body>

    <h1></h1>

    <div class="testimonial-container">
        <div class="testimonial">
        <img src="image/mira.png" alt="Testimonial 1">
            <h3>Nurul Amirah</h3>
            <p>Project Manager of Glamfetti</p>
        </div>

        <div class="testimonial">
        <img src="image/raudah.jpg" alt="Testimonial 2">
            <h3>Siti Raudah</h3>
            <p>Chief Executive Officer Glamfetti</p>
        </div>
    </div>

    <!-- Contact us form -->
    <center>
    <div>
            <h2> About Us </h2>
            <p>Our platform is not only to provide a marketplace for sellers to sell their items but also to act as a catalyst for growth.</p>
            <p>We serves well-informed customers who value exceptional design and one-of-a-kind designs that are hard to come by. </p>
            <p>We are always creating new collections and searching for the newest, greatest thing that our clients will adore.</p>
        </div>

        <div class="contact-info">
            <h2>Contact Info</h2>
            <p>Phone: 010-2345678</p>
            <p>Email: glamfetti23@gmail.com</p>
            <p>Address: Malaysia </p>
        </div>

    </center>

    <!-- Footer Section -->
    <footer>
        <div style="display: flex; justify-content: space-between; max-width:center; margin: 0 auto;">
        </div>
    </footer>

</body>

</html>
