<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comments</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial;
        }
        .container {
            margin: 20px auto;
            max-width: 600px;
        }
        .title {
            text-align: center;
            margin-bottom: 10px;
        }
        .item {
            border: 1px solid darkgrey;
            padding: 5px;
            margin-bottom: 20px;
            min-height: 100px;
        }
        textarea, input {
            display: block;
            margin-bottom: 10px;
            padding: 5px;
            outline: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="title">Отзывы посетителей</h2>
        <!--Перебираем массив в цикле.-->
        <?php foreach ($comments as $value): ?>
                <div class="item">
                    <!--Вставляем необходимые данные в шаблон.-->
                    <h4><?= $value['name'] ?></h4>
                    <p><?= $value['text'] ?></p>
                </div>
        <!--Завершаем цикл.-->
        <?php endforeach; ?>

        <form action="" method="post">
            <textarea name="comment" cols="40" rows="10" placeholder="Введите комментарий..."></textarea>
            <input type="text" name="name" autocomplete="off" placeholder="Ваше имя">
            <input type="submit" name="submit">
        </form>
    </div>
</body>
</html>