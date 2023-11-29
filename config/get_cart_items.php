<?php
// Подключение к базе данных
require_once 'databases.php';
session_start();

// Получение идентификатора сессии пользователя
$user_session_id = $_SESSION['customer_id'];

// Запрос к базе данных для получения товаров в корзине
$sql = "SELECT MenuItems.item_name, MenuItems.price, MenuItems.image_url, MenuItems.item_id, OrderItems.unique_id, OrderItems.quantity FROM OrderItems
        JOIN Orders ON OrderItems.order_id = Orders.order_id
        JOIN MenuItems ON OrderItems.product_id = MenuItems.item_id
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

$cart_items = array();

while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = array(
        'item_id' => $row['item_id'],
        'item_name' => $row['item_name'],
        'quantity' => $row['quantity'],
        'image_url' => $row['image_url'], // Добавление URL изображения
        'price' => $row['price'],
        'unique_id' => $row['unique_id'],
    );
}

// Закрытие соединения с базой данных
mysqli_close($induction);

// Отправка данных в формате JSON
header('Content-Type: application/json');
echo json_encode($cart_items);
?>