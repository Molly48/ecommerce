<?php
  session_start();
  include "navbar.html";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cart</title>
  <style>
    body, ul {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif; 
    }

    body {
      background: rgb(205, 192, 177);
    }

    .navbar ul {
      list-style-type: none;
      display: flex;
      align-items: center;
      margin: 0;
      padding: 0;
    }

    h1 {
      color: rgb(0, 0, 0);
      margin: 0;
      flex-grow: 1;
      text-align: center; 
      font-family: 'sans-serif'; 
      font-size: 28px; 
    }

    table {
  width: 80%;
  border-collapse: collapse;
  margin-top: 20px;
  background-color: rgb(186, 169, 151);
  margin-left: auto;
  margin-right: auto;
}

    th, td {
      border: 1px solid black;
      padding: 10px;
    }

    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    .alert-success {
      color: #155724;
      background-color: #d4edda;
      border-color: #c3e6cb;
    }

    .badge-danger {
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
    }

    .btn-success {
      color: #fff;
      background-color: #28a745;
      border-color: #28a745;
    }

    .btn-info {
      color: #fff;
      background-color: #17a2b8;
      border-color: #000;
    }

    .text-danger {
      color: #fff;
    }

    .lead {
      font-size: 1.25em;
    }

    .close {
      float: right;
      font-size: 1.25rem;
      font-weight: 700;
      line-height: 1;
      color: #000;
      text-shadow: 0 1px 0 #fff;
      opacity: .5;
    }

    .fas {
      font-family: 'Font Awesome 5 Free';
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php echo isset($_SESSION['showAlert']) ? $_SESSION['showAlert'] : 'none'; ?>" class="alert alert-success alert-dismissible mt-3">
          <span class="close" data-dismiss="alert">&times;</span>
          <strong><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?></strong>
        </div>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>
                <a href="cart.php?" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?')"><span class="fas fa-trash"></span>&nbsp;&nbsp;Clear Cart
                </a>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
              require 'DBConnection.php';
              $stmt = $conn->prepare('SELECT * FROM cart');
              $stmt->execute();
              $result = $stmt->get_result();
              $grand_total = 0;
              while ($row = $result->fetch_assoc()):
            ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <input type="hidden" class="pid" value="<?= $row['id'] ?>">
              <td><img src="<?= $row['product_image'] ?>" width="50"></td>
              <td><?= $row['product_name'] ?></td>
              <td>
                <span class="fas fa-rupee-sign"></span>&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
              </td>
              <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
              <td>
                <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
              </td>
              <td>
                <span class="fas fa-rupee-sign"></span>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?>
              </td>
              <td>
                <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?')">
                  <span class="fas fa-trash-alt"></span>
                </a>
              </td>
            </tr>
            <?php $grand_total += $row['total_price']; ?>
            <?php endwhile; ?>
            <tr>
              <td colspan="3">
                <a href="index.php" class="btn btn-success"><span class="fas fa-cart-plus"></span>&nbsp;&nbsp;Continue Shopping</a>
              </td>
              <td colspan="2"><b>Grand Total</b></td>
              <td><b><span class="fas fa-rupee-sign"></span>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
              <td>
                <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>">
                  <span class="far fa-credit-card"></span>&nbsp;&nbsp;Checkout
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {
      // Change the item quantity
      $(".itemQty").on('change', function() {
        var $el = $(this).closest('tr');
        var pid = $el.find(".pid").val();
        var pprice = $el.find(".pprice").val();
        var qty = $el.find(".itemQty").val();
        location.reload(true);
        $.ajax({
          url: 'action.php',
          method: 'post',
          cache: false,
          data: {
            qty: qty,
            pid: pid,
            pprice: pprice
          },
          success: function(response) {
            console.log(response);
          }
        });
      });

      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        $.ajax({
          url: 'action.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function(response) {
            $("#cart-item").html(response);
          }
        });
      }
    });
  </script>
</body>

</html>
