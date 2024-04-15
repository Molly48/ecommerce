<?php
session_start();

if (!isset($_SESSION['seller_id'])) {
  header('Location: sellerlogin.php');
  exit; // Stop script execution after redirection
}

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style-rating.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	  <link rel='stylesheet' href='https://raw.githubusercontent.com/greenwoodents/quickbeam.js/master/demo/css/demo.css'><link rel="stylesheet" href="./style.css">
</head>
<body>
<?php
$query = "SELECT * FROM products WHERE id = '$prod_id'";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_row($result);
?>

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
                <a></a>
              </div>
              <div class="swatches">
                <div class="swatch clearfix" data-option-index="0">
                  <div class="header">Size</div>
				  <div data-value="XS" class="swatch-element plain m available">
          <input id="swatch-0-xs" type="radio" name="option-0" value="XS" checked  onchange="handleCheckboxSize()" />
                    <label for="swatch-0-xs">
                      XS
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
				  <div data-value="S" class="swatch-element plain m available">
          <input id="swatch-0-s" type="radio" name="option-0" value="S" checked onchange="handleCheckboxSize()" />
                    <label for="swatch-0-s">
                      S
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
                  <div data-value="M" class="swatch-element plain m available">
                  <input id="swatch-0-m" type="radio" name="option-0" value="M" checked onchange="handleCheckboxSize()" />
                    <label for="swatch-0-m">
                      M
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
                  <div data-value="L" class="swatch-element plain l available">
                  <input id="swatch-0-l" type="radio" name="option-0" value="L" onchange="handleCheckboxSize()" />
                    <label for="swatch-0-l">
                      L
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div><br>
                  <div data-value="XL" class="swatch-element plain xl available">
                  <input id="swatch-0-xl" type="radio" name="option-0" value="XL" onchange="handleCheckboxSize()" />
                    <label for="swatch-0-xl">
                      XL
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
                  <div data-value="XXL" class="swatch-element plain xxl available">
                  <input id="swatch-0-xxl" type="radio" name="option-0" value="XXL" onchange="handleCheckboxSize()" />
                    <label for="swatch-0-xxl">
                      XXL
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
				  <div data-value="3XL" class="swatch-element plain m available">
          <input id="swatch-0-3xl" type="radio" name="option-0" value="3XL" checked onchange="handleCheckboxSize()" />
                    <label for="swatch-0-3xl">
                      3XL
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
				  <div data-value="4XL" class="swatch-element plain m available">
          <input id="swatch-0-4xl" type="radio" name="option-0" value="4XL" checked onchange="handleCheckboxSize()" />
                    <label for="swatch-0-4xl">
                      4XL
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
				  
                </div>
                <div class="swatch clearfix" data-option-index="1">
                  <h4><div class="header">Color</div></h4>
                  <?php echo $row[3]; ?>
                </div>
              </div>
              <h4><p>Peices Available :<span id="calculatedQuantity">0</span></p></h4>
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
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

</section>

<center>

<br>
<h1 style="font-size : 20px;">Product Ratings</h1>

<?php
if(isset($_SESSION['email_address']))
{
$queryRated = "SELECT * FROM product_review WHERE posted_by = '" . $_SESSION['email_address'] . "' AND product_id='$prod_id'";

$resultRated = mysqli_query($db, $queryRated);
if (!mysqli_num_rows($resultRated) > 0) {
?>


<?php
}
} else {
  echo "";
}
?>

<h2 style="font-size : 15px; margin-bottom : 15px; margin-top : 60px;">Other's review</h2>
<div style="border-radius : 25px; background-color : white; width : 800px; box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05); margin-bottom : 30px;">
<br>

<?php
$query3 = "SELECT * FROM product_review as pr
JOIN shopper as sp ON sp.email_address = pr.posted_by
WHERE product_id = '$prod_id'";
$result3 = mysqli_query($db, $query3);
if (mysqli_num_rows($result3) > 0) {
  while ($row5 = mysqli_fetch_assoc($result3)) {
?>

<div style="margin : 15px; border-style : solid; border-width : 1px; border-color : #e9ecef; border-radius : 25px;">
<div class="row">
  <div class="col-3">
    <img src="https://api.dicebear.com/7.x/pixel-art/svg?seed=<?php echo $row5['shopper_username'];?>" style="height : 100px; width : 100px; border-color"/>
  </div>
  <div class="col-6">
    <div class="row">
      <h4 style="font-size : 14px; margin-top : 15px; font-weight: bold;">@<?php echo $row5['shopper_username'];?></h4>
    </div>
    <div class="row">
      <p><?php echo $row5['comment'];?></p>
    </div>
  </div>
  <div class="col-3">
    <div class="row">
      <div class="col-4">
        <p style="font-size : 50px; margin-top : 40px;"><?php echo $row5['rating'];?></p>
      </div>
      <div class="col-8">
        <svg xmlns="http://www.w3.org/2000/svg" style="color : #bf8300; margin-top : 25px; position : relative; left : -30px;" width="50" height="50" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
        </svg>
      </div>
    </div>
  </div>
</div>
</div>

<?php
  }
}
?>

<br>
</div>
</center>

<div id="carting" style="position : fixed; right : 80px; bottom : 20px; display : none;">
<div style="width : 100%; display : flex; justify-content: flex-end;">

<button type="button" class="btn" style="background-color : rgb(116, 98, 82); margin-bottom : 2px; height : 25px;" onclick="clearCart()">
<span style="position : relative; top : -5px; left : -5px;">
Clear Cart
</span>
</button>

<button type="button" class="btn" style="background-color : rgb(116, 98, 82); margin-bottom : 2px; width : 25px; height : 25px;" onclick="closeCarting()">
<span style="position : relative; top : -5px; left : -5px;">
X
</span>
</button>
</div>
<table class="table" style="width : 400px;">
  <thead>
    <tr>
      <th scope="col">Product</th>
      <th scope="col">Size</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody id="mycartlist">
  </tbody>
</table>
<div style="width : 100%; display: flex; flex-direction: column;">
<button type="button" class="btn" style="background-color : rgb(116, 98, 82); margin-top : 5px;">Pay Now</button>
</div>
</div>

<div id="quick-cart" quickbeam="cart">
  <a id="quick-cart-pay" quickbeam="cart-pay" class="cart-ico">
    <span>
      <strong class="quick-cart-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
	  <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
	</svg></strong>
      <span id="quick-cart-price"></span>
      <span id="quick-cart-pay-total-count"></span>
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

function minusQuantity()
{
	// Get the element by its ID
  var updatesElement = document.getElementById('updates_2721888517');

  // Check if the value is greater than 0
  var currentValue = parseFloat(updatesElement.value);
  if (currentValue > 0) {
    // Decrease the value by 1
    updatesElement.value = currentValue - 1;
  }
}

function handleCheckboxSize()
{
  let radioButtons = document.getElementsByName("option-0");
	let selectedRadioButton = null;

	  for (let i = 0; i < radioButtons.length; i++) {
		if (radioButtons[i].checked) {
		  selectedRadioButton = radioButtons[i];
		  break;
		}
  }

  if (selectedRadioButton) {
    // let quantity = document.getElementById("updates_2721888517").value;
    switch(selectedRadioButton.id) {
      case "swatch-0-xs":
      setXS();
      break;
      case "swatch-0-s":
      setS();
      break;
      case "swatch-0-m":
      setM();
      break;
      case "swatch-0-l":
      setL();
      break;
      case "swatch-0-xl":
      setXL();
      break;
      case "swatch-0-xxl":
      setXXL();
      break;
      case "swatch-0-3xl":
      set3XL();
      break;
      case "swatch-0-4xl":
      set4XL();
      break;
    }
  }
}

let productStock = 
<?php
$querySizeStock = "SELECT * FROM product_size_quantify WHERE product_id='$prod_id'";

$resultSizeStock = mysqli_query($db, $querySizeStock);
$arrTemps = [];
if (mysqli_num_rows($resultSizeStock) > 0) {
  while ($rowSizeStock = mysqli_fetch_assoc($resultSizeStock)) {
    $arrTemps[] = $rowSizeStock['quantity'];
  }
  if($arrTemps != [])
  {
    echo json_encode($arrTemps);
  }
} else {
  echo json_encode(['0','0','0','0','0','0','0','0']);
}
?> ;
// console.log(productStock);

function setXS()
{
  document.getElementById('calculatedQuantity').innerHTML = productStock[0];
}

function setS()
{
  document.getElementById('calculatedQuantity').innerHTML = productStock[1];
}

function setM()
{
  document.getElementById('calculatedQuantity').innerHTML = productStock[2];
}

function setL()
{
  document.getElementById('calculatedQuantity').innerHTML = productStock[3];
}

function setXL()
{
  document.getElementById('calculatedQuantity').innerHTML = productStock[4];
}

function setXXL()
{
  document.getElementById('calculatedQuantity').innerHTML = productStock[5];
}

function set3XL()
{
  document.getElementById('calculatedQuantity').innerHTML = productStock[6];
}

function set4XL()
{
  document.getElementById('calculatedQuantity').innerHTML = productStock[7];
}

function plusQuantity()
{
	// Get the element by its ID
  var updatesElement = document.getElementById('updates_2721888517');

  // Check if the value is greater than 0
  var currentValue = parseFloat(updatesElement.value);
  updatesElement.value = currentValue + 1;
}

var globalCart = [];//empty array nanti simpan object

function addToCart()
{
	var radioButtons = document.getElementsByName("option-0");
	var selectedRadioButton = null;

	  for (var i = 0; i < radioButtons.length; i++) {
		if (radioButtons[i].checked) {
		  selectedRadioButton = radioButtons[i];
		  break;
		}
	  }

	  if (selectedRadioButton) {
		  let quantity = document.getElementById("updates_2721888517").value;
		  let size = "";
		  switch(selectedRadioButton.id) {
			  case "swatch-0-xs":
				size = "xs";
				break;
			  case "swatch-0-s":
				size = "s";
				break;
			  case "swatch-0-m":
				size = "m";
				break;
			  case "swatch-0-l":
				size = "l";
				break;
			  case "swatch-0-xl":
				size = "xl";
				break;
			  case "swatch-0-xxl":
				size = "xxl";
				break;
			  case "swatch-0-3xl":
				size = "3xl";
				break;
			  case "swatch-0-4xl":
				size = "4xl";
				break;
			}
			let newObj = { prod_id: "<?php echo $row[0]; ?>", product: "<?php echo $row[1]; ?>", size: size, quantity: quantity, price: "<?php echo $row[2]; ?>" };
			globalCart.push(newObj);
	  }
	localStorage.setItem("myCart", JSON.stringify(globalCart));
	// initializeTable();
}

if (localStorage.getItem("myCart") !== null) {
  //console.log(localStorage.getItem("myCart"));
  //localStorage.removeItem("myCart");
  globalCart = JSON.parse(localStorage.getItem("myCart"));
  initializeTable();
}

function initializeTable()
{
	let mycartoTable = document.getElementById("mycartlist");
	mycartoTable.innerHTML = "";
	let totalPrice = 0.0;
	for (var element of JSON.parse(localStorage.getItem("myCart"))) {
		//element.size
		//element.quantity
		setTable(element.product, element.size, element.quantity, element.price);
		totalPrice += parseFloat(element.price)*parseInt(element.quantity);
	}
	
	setTable("", "", "", "Total: \nRM" + totalPrice.toFixed(2));
}

function setTable(row1, row2, row3, row4)
{
	let mycartoTable = document.getElementById("mycartlist");
	let newRow = document.createElement("tr");

		let nameCell = document.createElement("th");
		nameCell.setAttribute("scope", "row");
		nameCell.textContent = row1;
		
		let sizeCell = document.createElement("td");
		sizeCell.textContent = row2;
		
		let quantityCell = document.createElement("td");
		quantityCell.textContent = row3;

		let priceCell = document.createElement("td");
		priceCell.textContent = row4;

		newRow.appendChild(nameCell);
		newRow.appendChild(sizeCell);
		newRow.appendChild(quantityCell);
		newRow.appendChild(priceCell);

		mycartoTable.appendChild(newRow);
}

document.addEventListener('DOMContentLoaded', function () {
    var quickCartElement = document.getElementById('quick-cart');
    var cartingElement = document.getElementById('carting');

    quickCartElement.addEventListener('click', function () {
        cartingElement.style.display = 'block';
    });
});

function clearCart()
{
	localStorage.removeItem("myCart");
  globalCart = [];
	initializeTable();
}

function closeCarting()
{
	document.getElementById('carting').style.display = 'none';
}

function viewCarting()
{
	document.getElementById('carting').style.display = 'block';
}

function submitRating() {
  let radioButtons = document.getElementsByName('rating');

  radioButtons.forEach((radioButton) => {
    if (radioButton.checked) {
      // Get the value of the checked radio button
      let selectedValue = radioButton.value;
      // console.log('Selected value: ' + selectedValue);
      let valueReview = document.getElementById("inputreview").value;

      window.location.href = 'submitreview.php?rate=' + selectedValue + '&prod_id=<?php echo $_GET['prod_id']; ?>' + '&comment=' + valueReview;
    }
  });

  //submit all
  // location.reload();
}
</script>
</body>
</html>

