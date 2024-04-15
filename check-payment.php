<?php
session_start();
include("DBConnection.php");

if(isset($_GET['billcode']) && isset($_GET['status_id'])) {
    $billcode = $_GET['billcode'];
    $statuscode = $_GET['status_id'];
 
    if($statuscode == 1) //mean success - in production later should check the transaction_id in toyyib pay - realistic situation - need check with payment gateway the payment status.
    {
        $query = "UPDATE payment 
          SET paid = 'Y'
          WHERE bill_code = '$billcode'";

        $result = mysqli_query($db, $query);

        if ($result) {
            echo "Payment status updated successfully!";
            //localStorage.removeItem("myCart");

            //clear carting
            echo '<html><body><script type="text/javascript">
                    localStorage.removeItem("myCart");
                    console.log("success!");
                </script></body></html>';

            header("Location: pay-history.php");
            exit;
        } else {
            echo "Error updating payment status, please contact administration team : " . mysqli_error($db);
        }
    } else {
        echo "Payment is unsuccessful! Please re-try again.";
    }
}
?>