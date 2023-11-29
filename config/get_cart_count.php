<?php
session_start();

require_once 'databases.php';

// Получаем идентификатор пользователя из сессии (замените на ваш метод получения пользователя)
$user_session_id = $_SESSION['customer_id'];

// Запрос к базе данных для получения количества товаров в корзине
$sql = "SELECT SUM(OrderItems.quantity) AS cart_count 
        FROM OrderItems 
        INNER JOIN Orders ON OrderItems.order_id = Orders.order_id 
        WHERE Orders.user_id = ? AND Orders.orderstatus = 'active'";
$stmt = mysqli_prepare($induction, $sql);

if (!$stmt) {
    die("Ошибка при подготовке SQL-запроса: " . mysqli_error($induction));
}

mysqli_stmt_bind_param($stmt, "i", $user_session_id);
$execute_result = mysqli_stmt_execute($stmt);

if (!$execute_result) {
    die("Ошибка при выполнении SQL-запроса: " . mysqli_error($induction));
}

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$cart_count = $row['cart_count'];

// Возвращаем количество товаров в корзине
if (!$cart_count) {
    echo '';
}
else {echo $cart_count;}

// Закрываем соединение с базой данных
mysqli_close($induction);
?>