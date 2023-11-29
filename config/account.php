<?php
require_once 'databases.php';
session_start();

$session_id = $_SESSION['customer_id'];


// Проверка наличия customer_id в сессии
if (!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])) {
  header("Location: login.php"); // Перенаправление на страницу логина
  exit();
}

// Проверка, является ли текущий пользователь администратором
$is_admin = false;
if ($session_id == 1) {
    $_SESSION['admink'] = true;
    $is_admin = true;
}

// Получение информации о текущем пользователе
$findresult = mysqli_query($induction, "SELECT * FROM Customers WHERE `customer_id` = $session_id");

if ($res = mysqli_fetch_array($findresult)) {
    $name = $res['first_name'];
    $email = $res['email'];
    $phone_number = $res['phone_number'];
    $address = $res['address'];
}

// Запрос для получения заказов текущего пользователя (или всех заказов для администратора)
if ($is_admin) {
    // Запрос для администратора
    $orders_query = "SELECT Orders.order_id, Orders.orderstatus, Orders.order_date, Customers.first_name, Customers.last_name, Customers.email, Customers.phone_number, Customers.address
                    FROM Orders
                    JOIN Customers ON Orders.user_id = Customers.customer_id
                    ORDER BY Orders.order_date DESC";
} else {
    // Запрос для обычного пользователя
    $orders_query = "SELECT Orders.order_id, Orders.orderstatus, Orders.order_date
                    FROM Orders
                    WHERE Orders.user_id = $session_id
                    ORDER BY Orders.order_date DESC";
}

// Выполнение запроса для получения заказов
$orders_result = mysqli_query($induction, $orders_query);

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Личный кабинет</title>
  <link rel="stylesheet" href="../styles/styles.css"> <!-- Подключите свои стили -->
  <link rel="icon" href="images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <div class="login_form">
          <p>
            <a href="/"><img src="/images/zagruzheno.png" width="300" height="300" alt="logo"
                class="logo img-fluid"></a>
          </p>
          <div class="row">
            <div class="col"></div>
            <div class="col-6">
              <?php if (isset($_GET['profile_updated'])) { ?>
                <div class="successmsg">Профиль сохранен ..</div>
              <?php } ?>
              <?php if (isset($_GET['password_updated'])) { ?>
                <div class="successmsg">Пароль был изменен...</div>
              <?php } ?>
              <center>
                <p> Добро пожаловать! <br> <b style="color:black">
                    <?php echo $name; ?>
                  </b> </p>
              </center>
            </div>
            <div class="col">
              <p><a href="logout.php"><span style="color:red;">Выйти</span> </a></p>
            </div>
          </div>

          <table class="table">
            <tr>
              <th>ID: </th>
              <td>
                <?php echo $session_id; ?>
              </td>
            </tr>
            <tr>
              <th>Фамилия и имя </th>
              <td>
                <?php echo $name ?>
              </td>
            </tr>
            <tr>
              <th>Номер телефона </th>
              <td>
                <?php echo $phone_number ?>
              </td>
            </tr>
            <tr>
              <th>Адрес доставки </th>
              <td>
                <?php echo $address ?>
              </td>
            </tr>
          </table>
        </div>
        <form method="POST" action="update_address.php">
          <label for="new_address">Новый адрес доставки:</label>
          <input type="text" id="new_address" name="new_address" required>
          <input type="submit" value="Изменить адрес">
        </form>
        <form method="POST" action="delete_account.php">
          <input type="submit" value="Удалить аккаунт"
            onclick="return confirm('Вы уверены, что хотите удалить свой аккаунт?');">
        </form>
        <div class="col-sm-3">

        </div>
      </div>
    </div>

    <h3>Заказы:</h3>
        <?php
        while ($order = mysqli_fetch_assoc($orders_result)) {
            echo '<div style="border: 1px solid #ddd; padding: 10px; margin: 10px; background-color: #f9f9f9;">';
            echo '<strong>ID Заказа:</strong> ' . $order['order_id'] . '<br>';
            echo '<strong>Статус заказа:</strong> ' . $order['orderstatus'] . '<br>';
            echo '<strong>Время и дата заказа:</strong> ' . $order['order_date'] . '<br>';
            // Для администратора выводим данные о пользователе
            if ($is_admin) {
                echo '<strong>Имя пользователя:</strong> ' . $order['first_name'] . ' ' . $order['last_name'] . '<br>';
                echo '<strong>Email пользователя:</strong> ' . $order['email'] . '<br>';
                echo '<strong>Номер телефона пользователя:</strong> ' . $order['phone_number'] . '<br>';
                echo '<strong>Адрес пользователя:</strong> ' . $order['address'] . '<br>';
            }

            // Получение товаров внутри заказа
            $order_id = $order['order_id'];
            $order_items_query = "SELECT OrderItems.quantity, MenuItems.item_name, MenuItems.price
                                FROM OrderItems
                                JOIN MenuItems ON OrderItems.product_id = MenuItems.item_id
                                WHERE OrderItems.order_id = $order_id";
            $order_items_result = mysqli_query($induction, $order_items_query);

            echo '<strong>Товары в заказе:</strong><br>';
            echo '<ul>';
            $total_order_price = 0;
            while ($order_item = mysqli_fetch_assoc($order_items_result)) {
                echo '<li>';
                echo '<strong>Товар:</strong> ' . $order_item['item_name'] . '<br>';
                echo '<strong>Цена за единицу:</strong> ' . $order_item['price'] . '₽<br>';
                echo '<strong>Количество:</strong> ' . $order_item['quantity'] . '<br>';
                $item_total_price = $order_item['price'] * $order_item['quantity'];
                echo '<strong>Общая сумма за товар:</strong> ' . $item_total_price . '₽<br>';
                $total_order_price += $item_total_price;
                echo '</li>';
            }
            echo '</ul>';
            echo '<strong>Общая сумма заказа (без учета доставки):</strong> ' . $total_order_price . '₽<br>';

            echo '</div>';
        }
        ?>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

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