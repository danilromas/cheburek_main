<?php
session_start();
require_once 'databases.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $street = isset($_POST['street']) ? $_POST['street'] : "";
    $house_number = isset($_POST['house_number']) ? $_POST['house_number'] : "";
    $apartment = isset($_POST['apartment']) ? $_POST['apartment'] : "";
    $intercom = isset($_POST['intercom']) ? $_POST['intercom'] : "";
    $floor = isset($_POST['floor']) ? $_POST['floor'] : "";
    $entrance = isset($_POST['entrance']) ? $_POST['entrance'] : "";

    // Concatenate address components into a single string
    $new_address = $street . ', ' . $house_number;
    if (!empty($apartment)) {
        $new_address .= ', Квартира ' . $apartment;
    }
    if (!empty($intercom)) {
        $new_address .= ', Домофон: ' . $intercom;
    }
    if (!empty($floor)) {
        $new_address .= ', Этаж ' . $floor;
    }
    if (!empty($entrance)) {
        $new_address .= ', Подъезд: ' . $entrance;
    }

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
?>