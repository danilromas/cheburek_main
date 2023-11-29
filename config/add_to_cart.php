<?php

require_once 'databases.php';
session_start();
function addtocart($induction, $item_id, $quantity) {
    // Получаем идентификатор пользователя из сессии (замените это на ваш метод получения пользователя)
    $user_id = $_SESSION['customer_id'];
    if (!$user_id) {
        echo "ВНИМАНИЕ. ЧТОБЫ СДЕЛАТЬ ЗАКАЗ НУЖНО ВОЙТИ В ЛИЧНЫЙ КАБИНЕТ";
        return;
    }
    // Проверяем, есть ли у пользователя активный заказ
    $check_order_sql = "SELECT order_id FROM Orders WHERE user_id = ? AND orderstatus = 'active'";
    $check_order_stmt = mysqli_prepare($induction, $check_order_sql);

    if (!$check_order_stmt) {
        echo "Ошибка при подготовке запроса: " . mysqli_error($induction);
        return;
    }

    mysqli_stmt_bind_param($check_order_stmt, "i", $user_id);
    $execute_result = mysqli_stmt_execute($check_order_stmt);

    if (!$execute_result) {
        echo "Ошибка при выполнении запроса: " . mysqli_error($induction);
        return;
    }

    $check_order_result = mysqli_stmt_get_result($check_order_stmt);

    if ($check_order_result) {
        $check_order_row = mysqli_fetch_assoc($check_order_result);
        $order_id = $check_order_row['order_id'];
    } else {
        echo "Ошибка при получении результата запроса: " . mysqli_error($induction);
        return;
    }

    if (!$order_id) {
        // Создаем новый заказ
        $order_date = date("Y-m-d H:i:s"); // Текущая дата и время
        $create_order_sql = "INSERT INTO Orders (user_id, orderstatus, order_date) VALUES (?, 'active', ?)";
        $create_order_stmt = mysqli_prepare($induction, $create_order_sql);

        if (!$create_order_stmt) {
            echo "Ошибка при подготовке запроса: " . mysqli_error($induction);
            return;
        }

        mysqli_stmt_bind_param($create_order_stmt, "is", $user_id, $order_date);
        $execute_result = mysqli_stmt_execute($create_order_stmt);

        if (!$execute_result) {
            echo "Ошибка при выполнении запроса: " . mysqli_error($induction);
            return;
        }

        // Получаем ID только что созданного заказа
        $order_id = mysqli_insert_id($induction);
    }

    // Добавляем товар в заказ
    $order_items_sql = "INSERT INTO OrderItems (order_id, product_id, quantity) VALUES (?, ?, ?)";
    $order_items_stmt = mysqli_prepare($induction, $order_items_sql);

    if (!$order_items_stmt) {
        echo "Ошибка при подготовке запроса: " . mysqli_error($induction);
        return;
    }

    mysqli_stmt_bind_param($order_items_stmt, "iii", $order_id, $item_id, $quantity);
    $execute_result = mysqli_stmt_execute($order_items_stmt);

    if (!$execute_result) {
        echo "Ошибка при выполнении запроса: " . mysqli_error($induction);
        return;
    }

    echo "Добавлено в корзину";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['item_id']) && isset($_POST['quantity'])) {
        $item_id = $_POST['item_id'];
        $quantity = $_POST['quantity'];

        // Здесь вы можете выполнить операции добавления товара в корзину
        // Например, выполните SQL-запрос для добавления товара в таблицу cart

        // Ваша функция addtocart
        addtocart($induction, $item_id, $quantity);

        // echo "Товар успешно добавлен в корзину";
    } else {
        echo "Неверные данные";
    }
} else {
    echo "Недопустимый метод запроса";
}
?>