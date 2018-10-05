<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="container">
        <div class="cart">
            <a class="come_back" href="../public/index.php"><i class="fas fa-arrow-left"></i></a>
            <a href="cart.php"><img src="../public/img/main/cart.png" alt="cart"></a>
        </div>
    </div>
</header>

<div class="container">
    <h1>Личный кабинет</h1>
    <div class="error_message"><?= $message ?></div>
    <div class="wrapper_login">
        <form action="" method="post">
            <label for="log">Логин</label>
            <input type="login" id="log" name="login">
            <label for="pas">Пароль</label>
            <input type="password" id="pas" name="password">
            <input type="submit" value="Войти">
        </form>
    </div>
</div>
</body>
</html>