<?php
require_once 'databases.php';
session_start();

$session_id = $_SESSION['customer_id'];

// Запрос товаров в корзине с использованием JOIN
$sql = "SELECT * FROM Orders 
        JOIN OrderItems ON Orders.order_id = OrderItems.order_id
        JOIN MenuItems ON OrderItems.product_id = MenuItems.item_id
        WHERE Orders.user_id = ? AND Orders.orderstatus = 'active'";
$stmt = mysqli_prepare($induction, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $session_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    echo "Ошибка: " . mysqli_error($induction);
    exit();
}

$items_in_cart = [];
$total_price = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $items_in_cart[] = $row;
    $total_price += $row['price'] * $row['quantity'];
    $_SESSION['order_id'] = $row['order_id'];
}

// Получение информации о пользователе из таблицы Customers
$user_sql = "SELECT first_name, email, phone_number, address FROM Customers WHERE customer_id = ?";
$user_stmt = mysqli_prepare($induction, $user_sql);

if ($user_stmt) {
    mysqli_stmt_bind_param($user_stmt, "s", $session_id);
    mysqli_stmt_execute($user_stmt);
    $user_result = mysqli_stmt_get_result($user_stmt);

    if ($user_row = mysqli_fetch_assoc($user_result)) {
        $customer_name = $user_row['first_name'];
        $phone_number = $user_row['phone_number'];
        $customer_address = $user_row['address'];
    }
} else {
    echo "Ошибка: " . mysqli_error($induction);
    exit();
}

$city_dwell = 'unknown';
if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['submit_order'])) {
    $city_dwell = $_POST['city_dwell'];
    if ($city_dwell == 'leninsky') {
        $total_price += 200;
    } elseif ($city_dwell == 'nakhimovsky') {
        $total_price += 250;
    } elseif ($city_dwell == 'nakhimovsky'){
        $total_price += 300;
    }
    elseif ($city_dwell == 'drygoe'){
        $total_price += 500;
    }
    else{

    }
}
if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['submit_order'])) {

    $_SESSION['total_price'] = $total_price;
    header('Location: oplata.php');
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Мета-теги и стили -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@100;300;400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/cart_page.css">
    <title>Оформление заказа</title>
</head>

<body>
    <p><a href="/"><img src="/images/zagruzheno.png" alt="bezuprecnho" class="logo img-fluid"></a></p>
    <h2>Корзина</h2>

    <?php if (count($items_in_cart) > 0): ?>
        <table>
            <tr>
                <th>Товар</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Итого</th>
            </tr>

            <?php foreach ($items_in_cart as $key => $value): ?>

                <tr>
                    <td>
                        <?php echo $value['item_name']; ?>
                    </td>
                    <td>
                        <?php echo $value['price'] ?>₽
                    </td>
                    <td>
                        <?php echo $value['quantity']; ?>
                    </td>
                    <td>
                        <?php echo $value['price'] * $value['quantity']; ?>₽
                    </td>
                </tr>

            <?php endforeach; ?>

            <tr>
                <td colspan="3" style="text-align: right;"><b>Общая сумма:</b></td>
                <td><b>
                        <?php echo $total_price; ?>₽
                    </b></td>
            </tr>
        </table>
        <p style="color: #ff0000; font-size: 18px; font-weight: bold;">Примечание. Учтите, что цена доставки в городе +200 рублей, а за его пределами +500 рублей.</p>

    <?php else: ?>
        <p>Корзина пуста</p>
    <?php endif; ?>




    <?php if (count($items_in_cart)) { ?>
    <form method="POST" action="">
        <h2>Информация о заказчике</h2>
        <input type="text" name="customer_name" placeholder="Ваше имя" required value="<?= $customer_name ?? '' ?>">
        <input type="text" name="phone_number" placeholder="Ваш телефон" required value="<?= $phone_number ?? '' ?>">
        <input type="text" name="customer_address" placeholder="Ваш адрес" required
            value="<?= $customer_address ?? '' ?>">
        <label for="city_dwell">Выберите район:</label>
            <select name="city_dwell" id="city_dwell">
                <option value="" selected disabled>Выберите район...</option>
                <option value="leninsky">Ленинский</option>
                <option value="nakhimovsky">Нахимовский</option>
                <option value="gagarinsky">Гагаринский</option>
                <option value="drygoe">Другое</option>
        </select>
        <input type="submit" name="submit_order" value="Оформить заказ">
    </form>
    <?php } ?>

</body>
<style>
    .btn {

        background-color: brown;
        border-color: black;
        color: white;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        background-color: brown;
    }
</style>

</html>