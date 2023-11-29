<?php
require_once 'databases.php';
session_start();

// Получение данных из GET-запроса
$uniqueId = isset($_GET['uniqueId']) ? $_GET['uniqueId'] : '';

if (!empty($uniqueId)) {
    // Получение идентификатора пользователя из сессии
    $user_id = $_SESSION['customer_id'];

    // Проверка наличия активного заказа пользователя
    $check_order_sql = "SELECT order_id FROM Orders WHERE user_id = ? AND orderstatus = 'active'";
    $check_order_stmt = mysqli_prepare($induction, $check_order_sql);

    if (!$check_order_stmt || !mysqli_stmt_bind_param($check_order_stmt, "i", $user_id) || !mysqli_stmt_execute($check_order_stmt)) {
        die("Ошибка при выполнении запроса: " . mysqli_error($induction));
    }

    $check_order_result = mysqli_stmt_get_result($check_order_stmt);

    if (!$check_order_result) {
        die("Ошибка при получении результата запроса: " . mysqli_error($induction));
    }

    $check_order_row = mysqli_fetch_assoc($check_order_result);
    $order_id = $check_order_row['order_id'];

    // Удаление товара из корзины (OrderItems)
    $delete_item_sql = "DELETE FROM OrderItems WHERE order_id = ? AND unique_id = ?";
    $delete_item_stmt = mysqli_prepare($induction, $delete_item_sql);

    if (!$delete_item_stmt || !mysqli_stmt_bind_param($delete_item_stmt, "is", $order_id, $uniqueId) || !mysqli_stmt_execute($delete_item_stmt)) {
        die("Ошибка при выполнении запроса: " . mysqli_error($induction));
    }

    // Закрываем соединение с базой данных
    mysqli_close($induction);

    // Возвращаем сообщение об успешном удалении
    echo json_encode(array("message" => "Товар успешно удален из корзины"));
    exit();
} else {
    // Возвращаем сообщение об ошибке, если идентификатор товара не передан
    http_response_code(400);
    echo json_encode(array("message" => "Ошибка: Идентификатор товара не указан"));
}
?>