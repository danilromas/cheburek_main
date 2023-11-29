<?php
session_start();
require_once 'databases.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $new_address = $_POST['new_address'];
    $customer_id = $_SESSION['customer_id'];

    $update_sql = "UPDATE Customers SET address = ? WHERE customer_id = ?";
    $update_stmt = mysqli_prepare($induction, $update_sql);

    if ($update_stmt) {
        mysqli_stmt_bind_param($update_stmt, "ss", $new_address, $customer_id);
        mysqli_stmt_execute($update_stmt);

        // После обновления адреса можно добавить код для перенаправления или отображения сообщения об успешном обновлении.
        header("location:/config/account.php"); 
    } else {
        echo "Ошибка при подготовке запроса: " . mysqli_error($induction);
    }

}