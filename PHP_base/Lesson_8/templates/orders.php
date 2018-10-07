<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="../public/css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <div class="cart">
                <a class="come_back" href="../public/index.php"><i class="fas fa-arrow-left"></i></a>

                <!--Проверяем залогинен пользователь или нет-->
                <?php echo (!$user_id = $_SESSION['users']) ?
                    //Если нет, показываем ссылку на страницу авторизации.
                    "<a class='enter' href='../public/login.php'>Войти</a>" :
                    //Если да - приветствуем!
                    "<div class='enter'>Привет, {$login}!<br><a class='exit' href='../public/exit.php'>Выйти</a></div>" ?>

                <a href="cart.php"><img src="../public/img/main/cart.png" alt="cart"></a>
            </div>
        </div>
    </header>

    <div class="container">
        <h1>Заказы</h1>

        <div class="orders_wrapper">

            <div class="wrapper_titles">
                <div>Номер</div>
                <div>Дата</div>
                <div>Стоимость</div>
                <div>Статус</div>
                <div>Отменить_</div>
            </div>

            <?php foreach ($arr_order as $order): ?>
            <div class="order_item">
                <div><?= $order['id']; ?></div>
                <div><?php echo date('d.m.y', $order['date']); ?></div>
                <div><?= $order['total_cost']; ?></div>

                <?php if ($order['status'] == 'Новый'): ?>
                <div class="order_item_status"><?= $order['status']; ?></div>
                <div><button data-id='<?= $order['id']; ?>' class="cancel_order">Отменить</button></div>
                <?php else: ?>
                <div class="order_item_status"><?= $order['status']; ?></div>
                <div class="cancel_order">Отменить</div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <script>
      $(function() {
        $('.cancel_order').on('click', function() {
          let id_order = $(this).data('id');
          $.ajax({
            url: '../public/orders.php',
            type: 'POST',
            data: {
              id_order: id_order
            },
            success: () => {
              $(this).parent('div').find('.order_item_status').html('Отменен');
              $(this).parent('div').find('button').remove();
            }
          })
        });
      });
    </script>
</body>
</html>