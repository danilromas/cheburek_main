<?php
// process_order.php
//... ваш обычный код для обработки заказа

// После обработки заказа

// Содержимое письма
$to = "romashkan.d.i.21@gmail.com"; // Замените на ваш адрес
$subject = "Новый заказ";
$message = "Вы получили новый заказ. Пожалуйста, проверьте свой административный раздел для получения дополнительной информации."; 

// Не забудьте убедиться, что ваш сервер поддерживает отправку почты!
if(mail($to, $subject, $message)) {
    echo "Order has been placed successfully and email sent!";
} else {
    echo "Order placed but failed to send email.";
}

//... остальной код

?>
