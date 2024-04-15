<?php
session_start();
$toyyib_url = "https://dev.toyyibpay.com/";
$our_web_url = "http://localhost/fyp(diploma)/";
// Retrieve values from hidden input fields
$cartJson = isset($_POST['cartjson']) ? json_decode(json_decode($_POST['cartjson'])) : '[]';
$buyerEmail = isset($_POST['buyerEmail']) ? $_POST['buyerEmail'] : '';
$buyerPhone = isset($_POST['buyerPhone']) ? $_POST['buyerPhone'] : '';
$buyerName = isset($_POST['buyerName']) ? $_POST['buyerName'] : '';

// Now you can use these variables as needed
// var_dump($cartJson);
// echo "Buyer Email: " . $buyerEmail . "<br>";
// echo "Buyer Phone: " . $buyerPhone . "<br>";
// echo "Buyer Name: " . $buyerName . "<br>";

$sellingDesc = "";
$totalPayment = 0.0;

foreach($cartJson as $item)
{
    $totalPayment += $item->price * $item->quantity;
    $sellingDesc .= $item->quantity . "x" . $item->size . " - " . $item->product . "\n";
}

$totalPayment = number_format($totalPayment * 100, 2, '.', '');

//proceed to payment
  $params = array(
    'userSecretKey'=>'yes0w2gx-v01r-vips-dv91-3a5n0q7aimkd',
    'categoryCode'=>'h5lifb5o',
    'billName'=>'Glamfetti payment bill',
    'billDescription'=>$sellingDesc,
    'billPriceSetting'=>1,
    'billPayorInfo'=>1,
    'billAmount'=>$totalPayment,
    'billReturnUrl'=>$our_web_url . 'check-payment.php',
    'billCallbackUrl'=>'http://bizapp.my/paystatus',
    'billExternalReferenceNo' => '-',
    'billTo'=>$buyerName,
    'billEmail'=>$buyerEmail,
    'billPhone'=>$buyerPhone,
    'billSplitPayment'=>0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel'=>'0',
    'billContentEmail'=>'Thank you for purchasing our product!',
    'billChargeToCustomer'=>1,
    'billExpiryDate'=> date('Y-m-d H:i:s', strtotime('+3 days')),
    'billExpiryDays'=>3
  );  

$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_URL, $toyyib_url. 'index.php/api/createBill');  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

$result = curl_exec($curl);
$info = curl_getinfo($curl);  
curl_close($curl);
$obj = json_decode($result);

 echo $result;
$billcode = $obj[0]->BillCode;

$redirectURL = $toyyib_url . $billcode;

include("DBConnection.php");
//1. store payment information in payment table
$query = "INSERT INTO payment (bill_code, paid) 
            VALUES ('$billcode', 'N')";

$result = mysqli_query($db, $query);

if (!$result) {
    echo "Payment process failed!";
    exit;
}

// Get the ID of the last inserted record
$lastInsertedPaymentID = mysqli_insert_id($db);

//2. store all item in cart table with pay id above
foreach($cartJson as $item)
{
    $query2 = "INSERT INTO cart (product_id, size, quantity, payment_id, dealingWith) 
            VALUES ('$item->prod_id', '$item->size', '$item->quantity', '$lastInsertedPaymentID', '" . $_SESSION['email_address'] . "')";
    mysqli_query($db, $query2);
}

header("Location: $redirectURL");

