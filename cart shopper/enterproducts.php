<?php
include "navbarseller.html";
?>

<br>
<!DOCTYPE HTML>
<html>

<style>
   body {
            background: rgb(205, 192, 177);
            margin: 0;
            margin: 0;
            padding: 0;
        }

    table {
        background-color: rgb(186, 169, 151);
    }
</style>

<body>

<form action="insertproducts.php" method="post" enctype="multipart/form-data">
    <table border="2" align="center" cellpadding="20" cellspacing="">
        <tr>
            <td colspan="2" style="text-align: center; font-size: 20px; font-weight: bold;">Selling Product</td>
        </tr>
        <tr>
            <td>Product Name :</td>
            <td> <input type="text" name="productName" size="48"> </td>
        </tr>
        <tr>
            <td>Price :</td>
            <td> <input type="text" name="price" size="48"> </td>
        </tr>
        <tr>
            <td>Color :</td>
            <td> <input type="text" name="color" size="48"> </td>
        </tr>
        <tr>
            <td>Size :</td>
            <td> <input type="text" name="size" size="48"> </td>
        </tr>
        <tr>
            <td>Description :</td>
            <td> <textarea name="description" rows="5" cols="46"></textarea> </td>
        </tr>
        <tr>
            <td>Quantity :</td>
            <td> <input type="number" name="quantity" size="48"> </td>
        </tr>

        <tr>
            <td>
                <div class="input-box">
                    <span>Upload Image</span>
                    <td><input type="file" name="fileToUpload" id="fileToUpload" required></td>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" value="Add">
                <input type="Reset" value="Reset">
            </td>
        </tr>
    </table>
</form>

</body>

</html>
