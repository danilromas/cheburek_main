<!DOCTYPE html>
<?php
require_once 'databases.php'; ?>
<html>

<head>
    <title> Регистрация </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
            <p><a href="/"><img src="/images/zagruzheno.png" alt="bezuprecnho" class="logo img-fluid"></a></p>

            </div>

            <div class="col-sm-4">
            </div>
        </div>

        <div class="row">
            <?php
            if (isset($_POST['signup'])) {

                extract($_POST);

                if (strlen($name) < 3) { 
                    $error[] = 'Минимум три символа.';
                }
                if (strlen($name) > 40) {
                    $error[] = 'Имя больше 20 символов запрещено.';
                }
                if (!preg_match("/^[А-ЯЁ][а-яё]+\s[А-ЯЁ][а-яё]+$/u", $name)) {
                    $error[] = 'Имя и Фамилия должны составлять из двух слов на русском языке. Первая буква каждого слова должна быть заглавной. Без цифр или специальных символов (1,2,3#,$,%,&,*,!,~,`,^,-,)';
                }
                
                if (strlen($email) > 30) {
                    $error[] = 'Адрес электронной почты не может быть длиннее 30 символов';
                }
                if ($passwordConfirm == '') {
                    $error[] = 'Подтвердите пароль.';
                }
                if ($password != $passwordConfirm) {
                    $error[] = 'Введенные пароли не совпадают.';
                }
                if (strlen($password) < 5) { // min 
                    $error[] = 'Длина пароля - минимум 6 символов.';
                }

                if (strlen($password) > 20) { // Max 
                    $error[] = 'Длина пароля больше 20 символов запрещена.';
                }

                $cleaned_phone_number = preg_replace("/[^\d+]/", "", $phone);

                if (!preg_match("/^\+7\d{10}$/", $cleaned_phone_number)) {
                    $error[] = 'Номер телефона указан неверно. Пишите в формате +79780000000';
                }
                $sql = "SELECT * FROM `Customers` WHERE 1=1";

                $result = mysqli_query($induction, $sql);
                 while ($row = mysqli_fetch_assoc($result)) {
                    if ($email == $row['email']) {
                        $error[] = 'Адрес уже зарегистрирован.';
                    }
                }
                if (!isset($error)) {

                    $jopa = "INSERT into Customers (customer_id, first_name, last_name, email, phone_number, address, password) VALUES (NULL, '$name', 'Фамилия', '$email','$phone','Впишите адрес' ,'$password' )";

                    $result = mysqli_query($induction, $jopa);
                    if ($result) {
                        $done = 2;
                    } else {
                        $error[] = 'Неудачно: Что-то пошло не так';
                    }
                }
            }
            ?>

            <div class="col-sm-4">

                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<p class="errmsg">&#x26A0;' . $error . ' </p>';
                    }
                }
                ?>
            </div>


            <div class="col-sm-4">
                <?php if (isset($done)) { ?>
                    <div class="successmsg"><span style="font-size:100px;">&#9989;</span> <br> Регистрация успешна. <br> <a href="login.php" style="color:green">Войти </a> </div>

                <?php } else { ?>

                    <div class="signup_form">
                        <form action="" method="POST">

                            <div class="form-group">
                                <label class="label_txt">Имя и Фамилия</label>
                                <input type="text" class="form-control" name="name" value="<?php if (isset($error)) {
                                                                                                echo $_POST['name'];
                                                                                            } ?>" required="">
                            </div>
                            <div class="form-group">
                                <label class="label_txt">Электронная почта </label>
                                <input type="email" class="form-control" name="email" value="<?php if (isset($error)) {
                                    echo $_POST['email'];
                                } ?>" required="">
                            </div>
                            <div class="form-group">
                                <label class="label_txt">Номер телефона в формате +79780000000</label>
                                <input type="text" class="form-control" name="phone" value="<?php if (isset($error)) {
                                                                                                echo $_POST['phone'];
                                                                                            } ?>" required="">
                            </div>

                            <div class="form-group">
                                <label class="label_txt">Пароль </label>
                                <input type="password" name="password" class="form-control" required="">
                            </div>

                            <div class="form-group">
                                <label class="label_txt">Подтвердить пароль </label>
                                <input type="password" name="passwordConfirm" class="form-control" required="">
                            </div>

                            <button type="submit" name="signup" class="btn btn-primary btn-group-lg form_btn">Зарегистрироваться</button>

                            <p>Уже есть аккаунт? <a href="login.php">Войти</a> </p>
                        </form>
                    <?php } ?>
                    </div>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>


<style>
    body {
        background: #EAE9E5;
    }

    .login_form {
        margin-top: 25%;
        background: #fff;
        padding: 30px;
        box-shadow: 0px 1px 36px 5px rgba(0, 0, 0, 0.28);
        border-radius: 5px;
    }

    .form_btn {
        background: #fb641b;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .2);
        border: none;
        color: #fff;
        width: 100%
    }

    .label_txt {
        font-size: 12px;
    }

    .form-control {
        border-radius: 25px
    }

    .signup_form {
        background: #fff;
        padding-left: 25px;
        padding-right: 25px;
        padding-bottom: 5px;
        box-shadow: 0px 1px 36px 5px rgba(0, 0, 0, 0.28);
        border-radius: 5px;
    }

    .logo {
        width: auto;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .errmsg {
        margin: 2px auto;
        border-radius: 5px;
        border: 1px solid red;
        background: pink;
        text-align: left;
        color: brown;
        padding: 1px;
    }

    .successmsg {
        margin: 5px auto;
        border-radius: 5px;
        border: 1px solid green;
        background: #33CC00;
        text-align: left;
        color: white;
        padding: 10px;
    }


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

    .btn:hover {
        background-color: green;
        border-color: green;
        color: black;
    }
</style>

</html>