<!DOCTYPE html>
<?php require_once 'databases.php'; ?>

<head><br>
  <title> Личный кабинет </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-4">
        <div class="login_form">
          <form action="login_process.php" method="POST">
            <div class="form-group">
              <p><a href="/"><img src="/images/zagruzheno.png" alt="bezuprecnho" class="logo img-fluid"></a></p>
              <?php

              if (isset($_GET['loginerror'])) {
                $loginerror = $_GET['loginerror'];
              }
              if (!empty($loginerror)) {
                echo '<p class="errmsg">Аккаунт не найден. Повторите попытку или зарегистрируйтесь.</p>';
              } ?>

              <label class="label_txt"> Электронная почта </label>
              <input type="text" name="login_var" value="<?php if (!empty($loginerror)) {
                                                            echo  $loginerror;
                                                          } ?>" class="form-control" required="">
            </div>
            <div class="form-group">
              <label class="label_txt">Пароль </label>
              <input type="password" name="password" class="form-control" required="">
            </div>
            <button type="submit" name="sublogin" class="btn btn-primary btn-group-lg form_btn">Войти</button>
          </form>

          <br>
          <p>Нет аккаунта? <a href="signup.php">Создать</a> </p>
        </div>
        <div class="col-sm-4">
        </div>
      </div>
    </div>
  </div>
</body>
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


    /* Main Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

.container {
    margin-top: 30px;
}

.login_form {
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login_form p {
    text-align: center;
}

.successmsg {
    color: #28a745;
    text-align: center;
    margin-bottom: 20px;
}

.row {
    margin-bottom: 20px;
}

/* User Information Table */
.table th,
.table td {
    text-align: left;
}

/* Forms */
form {
    margin-top: 20px;
}

form label {
    font-weight: bold;
}

form input[type="text"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

form input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Orders Section */
h3 {
    margin-top: 30px;
    margin-bottom: 15px;
    font-size: 24px;
}

.order-details {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 20px 0;
    background-color: #f9f9f9;
}

.order-details strong {
    font-weight: bold;
}

.order-items {
    margin-top: 10px;
}

.order-items ul {
    list-style-type: none;
    padding: 0;
}

.order-items li {
    margin-bottom: 15px;
}

.order-total {
    font-weight: bold;
    margin-top: 10px;
}

</style>

</html>