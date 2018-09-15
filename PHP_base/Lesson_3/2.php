<?php
header("Content-type: text/html; charset=utf-8");

$i = 0;
do {
    if ($i == 0) {
        echo $i . ' - это ноль.<br>';
    } else if ($i % 2 != 0) {
        echo $i . ' - нечетное число.<br>';
    } else {
        echo $i . ' - четное число.<br>';
    }
    $i++;
} while ($i <= 10);