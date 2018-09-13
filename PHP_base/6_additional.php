<?php
    header("Content-type: text/html; charset = utf-8");

    $name = 'Дмитрий';
    $age = 29;
    $date_today = date("d.m.Y");
    $time_now = date("G:i");

    $str = "<p>Меня зовут $name.<br>Через год мне будет $age лет.<br>На моих часах сейчас: $date_today $time_now</p>";
    $str2 = "<p>" . str_replace(' ', '_', $str) . "</p>";
    $str3 = substr($str, strpos($str, "На"));
    echo $str;
    echo $str2;
    echo $str3;