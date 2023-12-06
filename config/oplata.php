<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/oplata.css">
    <style>
        
    </style>
    <title>Оплата заказа</title>
</head>
<body>
    
<?php
session_start(); // В начале файла, если сессия ещё не начата
$total_price = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0;
?>
<form method="POST" action="handle_cash_payment.php">
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
    <input type="hidden" name="total_price" value="<?php echo $total_price; ?>"/>
    <label><input type="radio" name="paymentType" value="cash"/>Наличными</label><br>
    <input type="submit" value="Оплатить наличными" onclick="sendSMS()"/>
</form>

<form method="POST" action="https://yoomoney.ru/quickpay/confirm">
    <input type="hidden" name="receiver" value="4100118447684098"/>
    <input type="hidden" name="label" value="$order_id"/>
    <input type="hidden" name="quickpay-form" value="button"/>
    <input type="hidden" name="sum" value="<?php echo $total_price; ?>" data-type="number"/>
    <label><input type="radio" name="paymentType" value="PC"/>ЮMoney</label><br>
    <label><input type="radio" name="paymentType" value="AC"/>Банковской картой</label><br>
    <input type="submit" value="Оплата картой" onclick="sendSMS()"/>
</form>

<script>
 function sendSMS() {
    // Здесь мы используем AJAX для отправки данных на сервер без перезагрузки страницы
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'phone.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('phone=79785192565&message=Новый_заказ!');
 }
</script>
</body>
</html>