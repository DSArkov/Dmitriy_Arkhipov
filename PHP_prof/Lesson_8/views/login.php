<?php /** @var \app\models\User $model */?>

<header>
    <div class="container">
        <div class="cart">
            <a class="come_back" href="/product"><i class="fas fa-arrow-left"></i></a>
            <a href="cart.php"><img src="/img/main/cart.png" alt="cart"></a>
        </div>
    </div>
</header>

<div class="container">
    <h1>Авторизация</h1>
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