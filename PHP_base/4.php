<?php
    $title = "Lesson 1";
    $h1 = "Hello, world!";
    $date_today = date("Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
</head>
<body>
    <h1><?=$h1?></h1>
    <p><?="It's $date_today year."?></p>
</body>
</html>
