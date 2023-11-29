<?php
session_start();
require_once 'databases.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $order_id = $_SESSION['order_id'];
    var_dump($order_id);
    $total_price = $_POST['total_price'];

    // Выполните дополнительные действия по обработке оплаты наличными, если необходимо.
    // Например, обновление статуса заказа.

    $update_sql = "UPDATE Orders SET orderstatus = 'Оплата наличкой' WHERE order_id = ?";
    $update_stmt = mysqli_prepare($induction, $update_sql);

    if ($update_stmt) {
        mysqli_stmt_bind_param($update_stmt, "s", $order_id);
        mysqli_stmt_execute($update_stmt);
        // После успешного обновления статуса заказа можно добавить код для перенаправления или отображения сообщения.
        header("location:/config/account.php"); 
    } else {
        echo "Ошибка при подготовке запроса: " . mysqli_error($induction);
    }
}
?>