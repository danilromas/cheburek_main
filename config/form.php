<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Безупречная чебуречная</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@100;300;400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>


<?php
require_once 'databases.php';
session_start();
$sql = "SELECT * FROM `MenuItems` WHERE 1=1"; // '1=1' is used to simplify the WHERE clause construction
$result = mysqli_query($induction, $sql);

$sqlcategories = "SELECT * FROM `Categories` WHERE 1=1"; // '1=1' is used to simplify the WHERE clause construction
$resultcategories = mysqli_query($induction, $sqlcategories);
?>



<div class="container-fluid">
    <form id="productsForm">
        <div class="row">
            <div class="col-md-4">
                <label for="productCategory">Категория продукта:</label>
                <select class="form-control" id="productCategory">
                <?php
                $categories = mysqli_query($induction, "SELECT * FROM Categories");
                while($row = mysqli_fetch_array($categories)){ ?>
                    <option value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>                
                <?php } ?>
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="productName">Название продукта:</label>
                <select class="form-control" id="productName"></select>
            </div>
            
            <div class="col-md-2">
                <label for="productQuantity">Количество:</label>
                <input type="number" class="form-control" id="productQuantity" min="1" value="1">
            </div>
            
            <div class="col-md-2">
                <label for="productPrice">Цена:</label>
                <input type="text" class="form-control" id="productPrice" disabled>
            </div>
        </div>

        <div class="row">
    <div class="col-md-10">Итого:</div>
    <div class="col-md-2" id="totalSum">0</div>
</div>
        
        <hr>
        
        <button type="button" id="addProduct" class="btn btn-primary">Добавить</button>
        <button type="button" id="removeLastProduct" class="btn btn-danger">Удалить последний товар</button>
        <button type="button" id="placeOrder" class="btn btn-success">Заказать</button>
    </form>
    
    <hr>
    
    <div id="addedProducts"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
var totalSum = 0;
$(document).ready(function(){
    $('#productCategory').change(function(){
        var categoryId = $(this).val();
        $.ajax({
            url: "get_products.php",
            method: "POST",
            data: {categoryId:categoryId},
            success: function(data){
                $('#productName').html(data);
            }
        });
    });
    
    $('#productName').change(function() {
        var productId = $(this).val();
        $.ajax({
            url: "get_product_price.php",
            method: "POST",
            data: {productId:productId},
            success: function(data){
                $('#productPrice').val(data);
            }
        });
    });
    
    $('#addProduct').click(function() {
        var categoryId = $('#productCategory').val();
        var productId = $('#productName').val();
        var quantity = $('#productQuantity').val();
        var price = $('#productPrice').val();
        
        var productRow = '<div class="row"><div class="col-md-4">' + $('#productCategory option:selected').text() +
            '</div><div class="col-md-4">' + $('#productName option:selected').text() +
            '</div><div class="col-md-2">' + quantity +
            '</div><div class="col-md-2">' + price +
            '</div></div><hr>';

        $('#addedProducts').append(productRow);
        totalSum += quantity * price; // add to total sum
        $('#totalSum').text(totalSum); // update total sum on page
    });
    $('#removeLastProduct').click(function() {
        var lastProductRow = $('#addedProducts .row').last();
        
        var quantity = parseFloat(lastProductRow.children().eq(2).text()); // get quantity of the last product
        var price = parseFloat(lastProductRow.children().eq(3).text()); // get price of the last product
        
        totalSum -= quantity * price; // subtract from total sum
        $('#totalSum').text(totalSum); // update total sum on page

        lastProductRow.next().remove(); // remove <hr>
        lastProductRow.remove(); // remove product row
    });
    $('#placeOrder').click(function() {
                $.ajax({
                    type: "POST",
                    url: 'process_order.php',
                    data: $("#productsForm").serialize(),
                    success: function (response) {
                        alert("Order has been placed successfully!");
                    },
                });
            });
        });


</script>
</body>
</html>