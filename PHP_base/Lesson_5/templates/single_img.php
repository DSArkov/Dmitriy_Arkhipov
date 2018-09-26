<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Фотоальбом</title>
</head>
<body>

  <a href="../public/index.php" style="color: blueviolet; font-size: 18px;">⇁ На главную ↼</a>
  <p>Просмотров: <?= ++$res['count'] ?></p>
<div>
    <img src="<?= $res['url'] ?>" alt="img">
</div>

</body>
</html>