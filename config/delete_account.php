<?php
session_start();
require_once 'databases.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $customer_id = $_SESSION['customer_id'];

    // Дополнительные действия по удалению аккаунта, например, удаление связанных данных в базе данных.

    $delete_sql = "DELETE FROM Customers WHERE customer_id = ?";
    $delete_stmt = mysqli_prepare($induction, $delete_sql);

    if ($delete_stmt) {
        mysqli_stmt_bind_param($delete_stmt, "s", $customer_id);
        mysqli_stmt_execute($delete_stmt);

        // После удаления аккаунта можно добавить код для перенаправления на главную страницу или отображения сообщения.
        session_destroy();
        header("location:/"); 

    } else {
        echo "Ошибка при подготовке запроса: " . mysqli_error($induction);
    }
    
}
