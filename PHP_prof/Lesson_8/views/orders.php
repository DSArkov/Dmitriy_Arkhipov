<header>
    <div class="container">
        <div class="cart">
            <a class="come_back" href="/product"><i class="fas fa-arrow-left"></i></a>

            <!--Проверяем залогинен пользователь или нет-->
            <?php echo (!$user_id = $_SESSION['users']) ?
                //Если нет, показываем ссылку на страницу авторизации.
                "<a class='enter' href='/login'>Войти</a>" :
                //Если да - приветствуем!
                "<div class='enter'>Привет, {$login}!<br><a class='exit' href='/exit'>Выйти</a></div>" ?>
            <a href="/cart"><img src="/img/main/cart.png" alt="cart"></a>
        </div>
    </div>
</header>

<div class="container">
    <h1>Заказы</h1>
    <?php if ($arr_order): ?>
        <div class="orders_wrapper">

            <div class="wrapper_titles">
                <div>Номер</div>
                <div>Дата</div>
                <div>Стоимость</div>
                <div>Статус</div>
                <div></div>
            </div>

            <?php foreach ($arr_order as $order): ?>
                <div class="order_item">
                    <div>Заказ <?= $order['id']; ?></div>
                    <div><?php echo date('d.m.y', $order['date']); ?></div>
                    <div><?= $order['total_cost']; ?></div>

                    <?php if ($order['status'] == 'Новый'): ?>
                        <div class="order_item_status"><?= $order['status']; ?></div>
                        <div>
                            <button data-id='<?= $order['id']; ?>' class="cancel_order">Отменить</button>
                        </div>
                    <?php else: ?>
                        <div class="order_item_status"><?= $order['status']; ?></div>
                        <div>
                            <button disabled data-id='<?= $order['id']; ?>' class="cancel_order">Отменить</button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>
    <?php else: ?>
        <div class="empty_cart_wrapper">
            <p class="empty_cart">Пусто.<br>
                <span>Надо что-то менять...</span>
            </p>
        </div>
    <?php endif; ?>
</div>

<script>
    //Дожидаемся полной загрузки DOM
    $(function () {
        //Устанавливаем обработчик события на кнопку "Отменить".
        $('.cancel_order').on('click', function () {
            //Получаем id заказа из data-атрибута.
            let id_order = $(this).data('id');
            //Осуществляем запрос к серверу без перезугрузки страницы.
            $.ajax({
                //URL скрипта, которому будет отправлен запрос.
                url: '/order',
                //Метод передачи запроса.
                type: 'POST',
                //Передаваемы данные.
                data: {
                    //id заказа.
                    id_order: id_order
                },
                //В случае удачно выполненного запроса.
                success: () => {
                    //Меняем статус заказа в текущей строке на "Отменен".
                    $(this).parent('div').parent('div').find('.order_item_status').html('Отменен');
                    //Делаем кнопку "Отменить" не активной.
                    $(this).parent('div').find('button').attr('disabled', '');
                }
            })
        });
    });
</script>
