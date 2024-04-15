<?php
include "navbarseller.html";
if (isset($_GET['prod_id'])) {
    $prod_id = $_GET['prod_id'];
} else {
	echo "No product id were passed!";
	exit();
}

include("DBConnection.php");
?>
<html>
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
	<link rel='stylesheet' href='https://raw.githubusercontent.com/greenwoodents/quickbeam.js/master/demo/css/demo.css'><link rel="stylesheet" href="./style.css">
</head>
<body>
<?php
$query = "SELECT * FROM products WHERE id = '$prod_id'";

$query2 = "SELECT * FROM product_size_quantify WHERE product_id = '$prod_id'";

$result = mysqli_query($db, $query);
$result2 = mysqli_query($db, $query2);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_row($result);
?>
<header role="banner" aria-label="Heading">
  <div class="breadcrumb" role="navigation" aria-label="Breadcrumbs">
    <div class="_cont">
      <ol>
        <li><a title="Back to the frontpage">Home</a></li>
        <li><a title="">Product</a></li>
        <li><?php echo $row[1]; ?></li>
      </ol>
    </div>
  </div>
</header>
<section aria-label="Main content" role="main" class="product-detail">
  <div itemscope itemtype="http://schema.org/Product">
    <div class="shadow">
      <div class="_cont detail-top">
        <div class="cols">
          <div class="left-col">
            <div class="thumbs">
              <a class="thumb-image active" href="<?php echo $row[5]; ?>" data-index="0">
                <span><img src="<?php echo $row[5]; ?>" alt="<?php echo $row[1]; ?>"></span>
              </a>
            </div>
            <div class="big">
              <span id="big-image" class="img" quickbeam="image" style="background-image: url('<?php echo $row[5]; ?>')" data-src="<?php echo $row[5]; ?>"></span>
              <div id="banner-gallery" class="swipe">
                
              </div>
              <div class="detail-socials">
                <div class="social-sharing" data-permalink="http://html-koder-test.myshopify.com/products/tommy-hilfiger-t-shirt-new-york">
                  <a target="_blank"  class="share-facebook" title="Share"></a>
                  <a target="_blank"  class="share-twitter" title="Tweet"></a>
                  <a target="_blank"  class="share-pinterest" title="Pin it"></a>
                </div>
              </div>
            </div>
          </div>
          <div class="right-col">
            <h1 itemprop="name"><?php echo $row[1]; ?></h1>
            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
              <meta itemprop="priceCurrency" content="USD">
              <link itemprop="availability" href="http://schema.org/InStock">
              <div class="price-shipping">
                <div class="price" id="price-preview" quickbeam="price" quickbeam-price="800">
                  RM <?php echo $row[2]; ?>
                </div>
                <a>Limited product!</a>
              </div>
              <div class="swatches">
                <div class="swatch clearfix" data-option-index="0">
                  <div class="header">Size</div>
				  <div data-value="XS" class="swatch-element plain m available">
                    <input id="swatch-0-xs" type="radio" name="option-0" value="XS" checked  />
                    <label for="swatch-0-xs">
                      XS
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
				  <div data-value="S" class="swatch-element plain m available">
                    <input id="swatch-0-s" type="radio" name="option-0" value="S" checked  />
                    <label for="swatch-0-s">
                      S
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
                  <div data-value="M" class="swatch-element plain m available">
                    <input id="swatch-0-m" type="radio" name="option-0" value="M" checked  />
                    <label for="swatch-0-m">
                      M
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
                  <div data-value="L" class="swatch-element plain l available">
                    <input id="swatch-0-l" type="radio" name="option-0" value="L"  />
                    <label for="swatch-0-l">
                      L
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div><br>
                  <div data-value="XL" class="swatch-element plain xl available">
                    <input id="swatch-0-xl" type="radio" name="option-0" value="XL"  />
                    <label for="swatch-0-xl">
                      XL
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
                  <div data-value="XXL" class="swatch-element plain xxl available">
                    <input id="swatch-0-xxl" type="radio" name="option-0" value="XXL"  />
                    <label for="swatch-0-xxl">
                      XXL
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
				  <div data-value="3XL" class="swatch-element plain m available">
                    <input id="swatch-0-3xl" type="radio" name="option-0" value="3XL" checked  />
                    <label for="swatch-0-3xl">
                      3XL
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
				  <div data-value="4XL" class="swatch-element plain m available">
                    <input id="swatch-0-4xl" type="radio" name="option-0" value="4XL" checked  />
                    <label for="swatch-0-4xl">
                      4XL
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
				  
                </div>
                <div class="swatch clearfix" data-option-index="1">
                  <div class="header">Color</div>
                  <?php echo $row[3]; ?>
                </div>
                <div class="guide">
                  <a>Size guide</a>
                </div>
              </div>
              <!-- <form method="post" enctype="multipart/form-data" id="AddToCartForm"> -->
              <form id="AddToCartForm">
                
                <div class="btn-and-quantity-wrap">
                  <div class="btn-and-quantity">
                    <div class="spinner">
                      <input type="text" id="updates_2721888517" name="quantity" value="N\A" class="quantity-selector" disabled>
                      <input type="hidden" id="product_id" name="product_id" value="2721888517">
                      <span class="q">Qty.</span>
                    </div>
                    
                  </div>
                </div>
              </form>
              <div class="tabs">
                <div class="tab-labels">
                  <span data-id="1" class="active">Description</span>
                </div>
                <div class="tab-slides">
                  <div id="tab-slide-1" itemprop="description"  class="slide active">
                    <?php echo $row[4]; ?>
                  </div>
                </div>
              </div>
              <div class="social-sharing-btn-wrapper">
                <span id="social_sharing_btn">Share</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

</section>
<!-- Quickbeam cart-->

<div id="quick-cart" quickbeam="cart">
  <a id="quick-cart-pay" quickbeam="cart-pay" class="cart-ico">
    <span>
      <strong class="quick-cart-text">Pay<br></strong>
      <span id="quick-cart-price">0</span>
      <span id="quick-cart-pay-total-count">0</span>
    </span>
  </a>
</div>
<?php
}
?>

<!-- Quickbeam cart end -->
<!-- partial -->
  <script src='//raw.githubusercontent.com/greenwoodents/quickbeam.js/master/dist/quickbeam.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js'></script><script  src="./script.js"></script>
<script>
const sizeQuantityData = [
<?php
$strs = "";
while ($row2 = mysqli_fetch_assoc($result2)) {
    $strs .= $row2['quantity'] . ",";
}
echo rtrim($strs, ",");
?>
];

document.addEventListener("DOMContentLoaded", function() {
  var radioButtons = document.getElementsByName("option-0");

  radioButtons.forEach(function(radio) {
    radio.addEventListener("change", function() {
      checkRadioButton();
    });
  });
});

function checkRadioButton() {
  var radioButtons = document.getElementsByName("option-0");
  var selectedRadioButton = null;

  for (var i = 0; i < radioButtons.length; i++) {
    if (radioButtons[i].checked) {
      selectedRadioButton = radioButtons[i];
      break;
    }
  }

  if (selectedRadioButton) {
	  switch(selectedRadioButton.id) {
		  case "swatch-0-xs":
			document.getElementById("updates_2721888517").value = sizeQuantityData[0];
			break;
		  case "swatch-0-s":
			document.getElementById("updates_2721888517").value = sizeQuantityData[1];
			break;
		  case "swatch-0-m":
			document.getElementById("updates_2721888517").value = sizeQuantityData[2];
			break;
		  case "swatch-0-l":
			document.getElementById("updates_2721888517").value = sizeQuantityData[3];
			break;
		  case "swatch-0-xl":
			document.getElementById("updates_2721888517").value = sizeQuantityData[4];
			break;
		  case "swatch-0-xxl":
			document.getElementById("updates_2721888517").value = sizeQuantityData[5];
			break;
		  case "swatch-0-3xl":
			document.getElementById("updates_2721888517").value = sizeQuantityData[6];
			break;
		  case "swatch-0-4xl":
			document.getElementById("updates_2721888517").value = sizeQuantityData[7];
			break;
	  }
    //alert("Selected Radio Button ID: " + selectedRadioButton.id);
  } 
}
</script>
</body>
</html>