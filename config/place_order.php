<?php
// connect to the database
include "databases.php";

// check if the form data exists
if (isset($_POST["customerName"], $_POST["phoneNumber"], $_POST["orderDetails"], $_POST["totalPrice"])) {

    // prepare and bind
    $stmt = $induction->prepare("INSERT INTO AdminOrders (customer_name, phone_number, customer_address, order_details, total_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $customerName, $phoneNumber, $customerAddress, $orderDetails, $totalPrice);
    

    // set parameters and execute
    $customerName = $_POST["customerName"];
    $phoneNumber = $_POST["phoneNumber"];
    $customerAddress = $_POST['customerAddress']; // добавлено здесь
    $orderDetails = $_POST["orderDetails"];
    $totalPrice = $_POST["totalPrice"];
    $stmt->execute();
    $stmt->close();
    echo "New order has been successfully added to the database.";
}
?>