<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    body {
      background: rgb(205, 192, 177);
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
    }

    table {
      margin: auto; /* Center the table */
      border-collapse: collapse;
      width: 80%; /* Set a width for the table */
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <center>
    <?php
    session_start();
    include("DBConnection.php");

    $query = "SELECT * FROM cart
              JOIN payment as pay ON pay.id = cart.payment_id
              JOIN shopper as sp ON sp.email_address = cart.dealingWith
              JOIN products as pd ON pd.id = cart.product_id
              WHERE dealingWith = '" . $_SESSION['email_address'] . "'";

    ?>
    <br><br>
    <table>
      <tr>
        <th>Product Name</th>
        <th>Size</th>
        <th>Quantity</th>
        <th>Price/pcs</th>
        <th>Total Price</th>
        <th>Paid Status</th>
      </tr>
      <?php
      $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
          <tr>
            <td><?php echo $row['productName']; ?></td>
            <td><?php echo $row['size']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo "RM" . $row['price'] * $row['quantity']; ?></td>
            <td><?php echo $row['paid']; ?></td>
          </tr>
      <?php
        }
      }
      ?>
    </table>

    <script>
      localStorage.removeItem("myCart");
    </script>
<br><br>
<button type="button" class="btn" style="background-color: rgb(116, 98, 82); color: white; margin-top: 5px; font-size: 1.2em;" onclick="window.location.href='mainpageshopper.php'">Home Page</button>


  </center>
</body>

</html>
