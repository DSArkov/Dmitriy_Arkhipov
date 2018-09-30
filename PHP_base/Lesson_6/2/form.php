<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculator</title>
</head>
<body>

    <form action="" style="font-size: 16px;">
        <p>
            <label>Число 1:
                <input type="text" name="num1">
            </label>
        </p>
        <p>
            <label>Число 2:
                <input type="text" name="num2">
            </label>
        </p>
        <input type="submit" name="operator" value="+">
        <input type="submit" name="operator" value="-">
        <input type="submit" name="operator" value="*">
        <input type="submit" name="operator" value="/">
        <p>Результат: <?=calc($num1, $num2, $operator)?></p>
    </form>
</body>
</html>