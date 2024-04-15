<?php
session_start();

if (!isset($_SESSION['email_address'])) {
  header('Location: shopperlogin.php');
  exit; 
}

// include "navbarseller.html";
include "navbarloginshopper.html";
if (isset($_GET['prod_id'])) {
    $prod_id = $_GET['prod_id'];
} else {
	echo "No product id were passed!";
	exit();
}

include("DBConnection.php");

//get shoper information
$query6 = "SELECT * FROM shopper WHERE email_address = '" . $_SESSION['email_address'] . "'";


$result6 = mysqli_query($db, $query6);
$row6 = mysqli_fetch_row($result6);
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
<!-- <header role="banner" aria-label="Heading" style="z-index: -3;">
  <div class="breadcrumb" role="navigation" aria-label="Breadcrumbs">
    <div class="_cont">
      <ol>
        <li><a title="Back to the frontpage">Home</a></li>
        <li><a title="">Product</a></li>
        <li><?php echo $row[1]; ?></li>
      </ol>
    </div>
  </div>
</header> -->
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
              <!-- <div class="detail-socials">
                <div class="social-sharing" data-permalink="http://html-koder-test.myshopify.com/products/tommy-hilfiger-t-shirt-new-york">
                  <a target="_blank"  class="share-facebook" title="Share"></a>
                  <a target="_blank"  class="share-twitter" title="Tweet"></a>
                  <a target="_blank"  class="share-pinterest" title="Pin it"></a>
                </div>
              </div> -->
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
               
              </div>
              <div class="swatches">
                <div class="swatch clearfix" data-option-index="0">
                  <div class="header">Size</div>
				  <div data-value="XS" class="swatch-element plain m available">
                    <input id="swatch-0-xs" type="radio" name="option-0" value="XS" onchange="handleCheckboxSize()" checked  />
                    <label for="swatch-0-xs">
                      XS
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
				  <div data-value="S" class="swatch-element plain m available">
                    <input id="swatch-0-s" type="radio" name="option-0" value="S" onchange="handleCheckboxSize()" checked  />
                    <label for="swatch-0-s">
                      S
                      <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                    </label>
                  </div>
                  <div data-value="M" class="swatch-element plain m available">
                    <input id="swatch-0-m" type="radio" name="option-0" value="M" onchange="handleCheckboxSize()" checked  />
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
                  <div class="header">Color</div>
                  <?php echo $row[3]; ?>
                </div>
                <!-- <div class="guide">
                  <a>Size guide</a>
                </div> -->
              </div>

              <h4><p>Peices Available :<span id="calculatedQuantity">0</span></p></h4>
              <!-- <form method="post" enctype="multipart/form-data" id="AddToCartForm"> -->

              <span id="errorNoStock" style="color : red; font-size : 15px;">No Stock Available!</span>

              <form id="AddToCartForm">
                
                <div class="btn-and-quantity-wrap">
                  <div class="btn-and-quantity">
                    <div class="spinner">
                      <span onclick="minusQuantity()" class="btn minus" data-id="2721888517"></span>
                      <input type="text" id="updates_2721888517" name="quantity" value="0" class="quantity-selector">
                      <input type="hidden" id="product_id" name="product_id" value="2721888517">
                      <span class="q">Qty.</span>
                      <span onclick="plusQuantity()" class="btn plus" data-id="2721888517"></span>
                    </div>
                    <div id="AddToCart" onclick="addToCart()" quickbeam="add-to-cart">
                      <span id="AddToCartText">Add to Cart</span>
                    </div>
					<br>
					<!-- <a href="#" style="position : relative; left : 25px;"><span onclick="viewCarting()">View my Cart</span></a> -->
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
              <!-- <div class="social-sharing-btn-wrapper">
                <span id="social_sharing_btn">Share</span>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

</section>
<!-- Quickbeam cart-->

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

<div class="containerzz" id="containerzz">
  <div class="feedback">
    <div class="rating">
      <input type="radio" name="rating" value="5" id="rating-5">
      <label for="rating-5"></label>
      <input type="radio" name="rating" value="4" id="rating-4">
      <label for="rating-4"></label>
      <input type="radio" name="rating" value="3" id="rating-3">
      <label for="rating-3"></label>
      <input type="radio" name="rating" value="2" id="rating-2">
      <label for="rating-2"></label>
      <input type="radio" name="rating" value="1" id="rating-1">
      <label for="rating-1"></label>
      <div class="emoji-wrapper">
        <div class="emoji">
          <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
          <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
          <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
          <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
          <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
          <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
          <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
          <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
          <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
        </svg>
          <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
          <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
          <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347"/>
          <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534"/>
          <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff"/>
          <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347"/>
          <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff"/>
          <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534"/>
          <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff"/>
          <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347"/>
          <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff"/>
        </svg>
          <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
          <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
          <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347"/>
          <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff"/>
          <circle cx="340" cy="260.4" r="36.2" fill="#3e4347"/>
          <g fill="#fff">
            <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10"/>
            <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z"/>
          </g>
          <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347"/>
          <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff"/>
        </svg>
          <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
    <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347"/>
    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
    <g fill="#fff">
      <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z"/>
      <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81"/>
    </g>
    <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
    <g fill="#fff">
      <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1"/>
      <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81"/>
    </g>
    <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
    <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff"/>
  </svg>
          <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
          <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
          <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
          <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f"/>
          <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
          <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
          <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f"/>
          <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
          <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347"/>
          <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b"/>
        </svg>
          <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <g fill="#ffd93b">
            <circle cx="256" cy="256" r="256"/>
            <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z"/>
          </g>
          <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4"/>
          <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea"/>
          <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88"/>
          <g fill="#38c0dc">
            <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z"/>
          </g>
          <g fill="#d23f77">
            <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z"/>
          </g>
          <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347"/>
          <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b"/>
          <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2"/>
        </svg>
        </div>
      </div>
    </div>
    <br>
    <div class="input-group mb-3">
      <input type="text" class="form-control" id="inputreview" placeholder="Your review's comment?" aria-label="comment" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" onclick="submitRating()" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
          <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
        </svg>
        </button>
      </div>
    </div>

  </div>
</div>

<?php
}
} else {
  echo "Please login first to review!";
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
<form action="paycart.php" method="POST" enctype="application/x-www-form-urlencoded">
  <div style="width : 100%; display: flex; flex-direction: column;">
    <input type="text" name="cartjson" id="cartjson" value="[]" style="display : none;"/>
    <input type="text" name="buyerEmail" value="<?php echo $row6[3]; ?>" style="display : none;"/>
    <input type="text" name="buyerPhone" value="<?php echo $row6[4]; ?>" style="display : none;"/>
    <input type="text" name="buyerName" value="<?php echo $row6[1]; ?>" style="display : none;"/>
    <button type="submit" class="btn" style="background-color : rgb(116, 98, 82); margin-top : 5px;">Pay Now</button>
  </div>
</form>
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
  if(productStock[buttonRadioToProductStockIndex()] == 0)
  {
    document.getElementById("AddToCart").style.display = "none";
    document.getElementById("errorNoStock").style.display = "block";
  } else {
    document.getElementById("AddToCart").style.display = "block";
    document.getElementById("errorNoStock").style.display = "none";
  }
  
  document.getElementById("updates_2721888517").value = 0;
  let radioButtons = document.getElementsByName("option-0");
	let selectedRadioButton = null;

	  for (let i = 0; i < radioButtons.length; i++) {
		if (radioButtons[i].checked) {
		  selectedRadioButton = radioButtons[i];
		  break;
		}
  }

  if (selectedRadioButton) {
    let quantity = document.getElementById("updates_2721888517").value;
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
  let updatesElement = document.getElementById('updates_2721888517');
  if(productStock[buttonRadioToProductStockIndex()] - (parseInt(updatesElement.value) + 1) >= 0)
  {
    // Check if the value is greater than 0
    let currentValue = parseFloat(updatesElement.value);
    updatesElement.value = currentValue + 1;
    // console.log(buttonRadioToProductStockIndex()); 
  } else {
    alert("No stock!");
  }
}

function sizeToIndex(sizes)
{
  let size = "";
  switch(sizes) {
    case "xs":
    size = 0;
    break;
    case "s":
    size = 1;
    break;
    case "m":
    size = 2;
    break;
    case "l":
    size = 3;
    break;
    case "xl":
    size = 4;
    break;
    case "xxl":
    size = 5;
    break;
    case "3xl":
    size = 6;
    break;
    case "4xl":
    size = 7;
    break;
  }
  return size;
}

document.getElementById("errorNoStock").style.display = "none";

function productStockToUI()
{
  //productStock[buttonRadioToProductStockIndex()]
  document.getElementById('calculatedQuantity').innerHTML = productStock[buttonRadioToProductStockIndex()];
  // console.log('test');
  if(productStock[buttonRadioToProductStockIndex()] == 0)
  {
    document.getElementById("AddToCart").style.display = "none";
    document.getElementById("errorNoStock").style.display = "block";
  } else {
    document.getElementById("AddToCart").style.display = "block";
    document.getElementById("errorNoStock").style.display = "none";
  }
}

function buttonRadioToProductStockIndex()
{
  let radioButtons = document.getElementsByName("option-0");
	let selectedRadioButton = null;

	  for (let i = 0; i < radioButtons.length; i++) {
      if (radioButtons[i].checked) {
        selectedRadioButton = radioButtons[i];
        break;
      }
	  }
    let size = "";
	  if (selectedRadioButton) {
		  switch(selectedRadioButton.id) {
			  case "swatch-0-xs":
				size = 0;
				break;
			  case "swatch-0-s":
				size = 1;
				break;
			  case "swatch-0-m":
				size = 2;
				break;
			  case "swatch-0-l":
				size = 3;
				break;
			  case "swatch-0-xl":
				size = 4;
				break;
			  case "swatch-0-xxl":
				size = 5;
				break;
			  case "swatch-0-3xl":
				size = 6;
				break;
			  case "swatch-0-4xl":
				size = 7;
				break;
			}
	  }
    return size; //return index
}

var globalCart = [];//empty array nanti simpan object

function addToCart()
{
	var radioButtons = document.getElementsByName("option-0");
  let quantity = document.getElementById("updates_2721888517").value;
	var selectedRadioButton = null;

	  for (var i = 0; i < radioButtons.length; i++) {
		if (radioButtons[i].checked) {
		  selectedRadioButton = radioButtons[i];
		  break;
		}
	  }

	  if (selectedRadioButton) {
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
      // console.log((productStock[buttonRadioToProductStockIndex()] - parseInt(quantity)));
			if((productStock[buttonRadioToProductStockIndex()] - parseInt(quantity)) >= 0)
      {
        let newObj = { prod_id: "<?php echo $row[0]; ?>", product: "<?php echo $row[1]; ?>", size: size, quantity: quantity, price: "<?php echo $row[2]; ?>" };
			  globalCart.push(newObj);
        productStock[buttonRadioToProductStockIndex()] = productStock[buttonRadioToProductStockIndex()] - parseInt(quantity);
        //perlu refresh balik calculated
        productStockToUI();
        document.getElementById("updates_2721888517").value = 0;
      }
	  }
	localStorage.setItem("myCart", JSON.stringify(globalCart));
	initializeTable();
  //countTotalQuantity();
}

function startingJsonProductsStock()
{
  let index = 0;
  for (let element of globalCart) {
    // console.log(element);
    productStock[sizeToIndex(element.size)] = productStock[sizeToIndex(element.size)] - parseInt(element.quantity);
    index++;
  }
}

if (localStorage.getItem("myCart") !== null) {
  //console.log(localStorage.getItem("myCart"));
  //localStorage.removeItem("myCart");
  globalCart = JSON.parse(localStorage.getItem("myCart"));
  initializeTable();
  startingJsonProductsStock();
}

set4XL();

if(productStock[buttonRadioToProductStockIndex()] == 0)
{
  document.getElementById("AddToCart").style.display = "none";
  document.getElementById("errorNoStock").style.display = "block";
} else {
  document.getElementById("AddToCart").style.display = "block";
  document.getElementById("errorNoStock").style.display = "none";
}

// function countTotalQuantity()
// {
//   let cartJson = JSON.parse(localStorage.getItem("myCart"));
//   let totalQuantity = 0;
//   for (let element2 of cartJson) {
// 		totalQuantity += parseInt(element2.quantity);
// 	}

//   // console.log(totalQuantity);
//   document.getElementById("calculatedQuantity").innerHTML = totalQuantity;
// }

function initializeTable()
{
	let mycartoTable = document.getElementById("mycartlist");
	mycartoTable.innerHTML = "";
	let totalPrice = 0.0;
  let index = 1;
	for (var element of JSON.parse(localStorage.getItem("myCart"))) {
		//element.size
		//element.quantity
		setTable(element.product, element.size, element.quantity, element.price, index);
		totalPrice += parseFloat(element.price)*parseInt(element.quantity);
    index++;
	}
	
	setTable("", "", "", "Total: \nRM" + totalPrice.toFixed(2));
  document.getElementById("cartjson").value = JSON.stringify(localStorage.getItem("myCart"));
}

function setTable(row1, row2, row3, row4, id = '')
{
	let mycartoTable = document.getElementById("mycartlist");
	let newRow = document.createElement("tr");

		let nameCell = document.createElement("th");
		nameCell.setAttribute("scope", "row");
		nameCell.textContent = row1;
		
		let sizeCell = document.createElement("td");
		sizeCell.textContent = row2;
		
		let quantityCell = document.createElement("td");
    quantityCell.style.width = "130px";
    let plusButt = document.createElement("button");

    plusButt.style.borderRadius = "25px";
    plusButt.style.marginLeft = "10px";
    plusButt.style.color = "black";
    plusButt.style.height = "12px";
    plusButt.style.position = "relative";
    plusButt.style.width = "1px";
    plusButt.style.marginRight = "2px";
    plusButt.style.top = "5px"; // Adjust top property
    plusButt.onclick = function() {
      // console.log(id);
      addQuantityObj(id);
    };

    let plusSpan = document.createElement("span");
    plusSpan.textContent = "+";
    plusSpan.style.position = "relative";
    plusSpan.style.top = "-6px";
    plusSpan.style.left = "-3px";

    plusButt.appendChild(plusSpan);

		let priceCell = document.createElement("td");
		priceCell.textContent = row4;

    let minusButt = document.createElement("button");

    minusButt.style.borderRadius = "25px";
    minusButt.style.marginLeft = "10px";
    minusButt.style.color = "black";
    minusButt.style.height = "12px";
    minusButt.style.position = "relative";
    minusButt.style.width = "1px";
    minusButt.style.marginLeft = "2px";
    minusButt.style.top = "5px"; // Adjust top property
    minusButt.onclick = function() {
      // console.log(id);
      minusQuantityObj(id);
    };

    let minusSpan = document.createElement("span");
    minusSpan.textContent = "-";
    minusSpan.style.position = "relative";
    minusSpan.style.top = "-6px";
    minusSpan.style.right = "2px";

    minusButt.appendChild(minusSpan);

    if(id == '' || id == null)
    {
      //do nothing
    } else {
      quantityCell.appendChild(plusButt);
		  quantityCell.appendChild(document.createTextNode(row3));
      quantityCell.appendChild(minusButt);
    }

    // Create a button element
    if(id == '' || id == null)
    {
      //do nothing
    } else {
      let button = document.createElement("button");

      button.style.borderRadius = "25px";
      button.style.marginLeft = "10px";
      button.style.color = "black";
      button.onclick = function() {
        removeSpecificObject(id);
      };
      button.textContent = "x";

      // Append the button to the cell
      priceCell.appendChild(button);
    }


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

function removeSpecificObject(id)
{
  if (localStorage.getItem("myCart") !== null) {
    //console.log(localStorage.getItem("myCart"));
    //localStorage.removeItem("myCart");
    let cartingss = JSON.parse(localStorage.getItem("myCart"));
    let specificCart = JSON.parse(localStorage.getItem("myCart"))[id-1];

    productStock[sizeToIndex(specificCart.size)] = productStock[sizeToIndex(specificCart.size)] + parseInt(specificCart.quantity);
    productStockToUI();

    cartingss.splice((id-1), 1);
    // console.log(cartingss);
    globalCart = cartingss;
    localStorage.setItem("myCart", JSON.stringify(globalCart));
    initializeTable();
    //countTotalQuantity();
  }
}

function addQuantityObj(id)
{
  let cartingss = JSON.parse(localStorage.getItem("myCart"));
  let specificCart = JSON.parse(localStorage.getItem("myCart"))[id-1];

  if(productStock[sizeToIndex(specificCart.size)] - parseInt(1) >= 0)
  {
    specificCart.quantity = parseInt(specificCart.quantity) + 1;
    // Update the cartingss array
    cartingss[id - 1] = specificCart;

    // console.log(id);
    productStock[sizeToIndex(specificCart.size)] = productStock[sizeToIndex(specificCart.size)] - parseInt(1);
    productStockToUI();

    // Update the local storage with the modified array
    localStorage.setItem("myCart", JSON.stringify(cartingss));
    initializeTable();
  } else {
    alert ("No stock!");
  }
}

function minusQuantityObj(id)
{
  let cartingss = JSON.parse(localStorage.getItem("myCart"));
  let specificCart = JSON.parse(localStorage.getItem("myCart"))[id-1];
  if(parseInt(specificCart.quantity) > 1)
  {
    specificCart.quantity = parseInt(specificCart.quantity) - 1;
    // Update the cartingss array
    cartingss[id - 1] = specificCart;

    //index id - 1
    productStock[sizeToIndex(specificCart.size)] = productStock[sizeToIndex(specificCart.size)] + parseInt(1);
    productStockToUI();

    // Update the local storage with the modified array
    localStorage.setItem("myCart", JSON.stringify(cartingss));
    initializeTable();    
  }
}

function clearCart()
{
  let beforeDelete = JSON.parse(localStorage.getItem("myCart"));
  for (let element of beforeDelete) {
    productStock[sizeToIndex(element.size)] = productStock[sizeToIndex(element.size)] + parseInt(element.quantity);
  }

  productStockToUI();

	localStorage.removeItem("myCart");
  globalCart = [];
  document.getElementById("cartjson").value = JSON.stringify(globalCart);
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

      window.location.href = 'submitreviewshopper.php?rate=' + selectedValue + '&prod_id=<?php echo $_GET['prod_id']; ?>' + '&comment=' + valueReview;
    }
  });

  //submit all
  // location.reload();
}
</script>
</body>
</html>
