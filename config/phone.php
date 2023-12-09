<?php
include('smspilot.php');

$phone = $_POST['phone'];
$message = $_POST['message'];

sms($phone, $message);