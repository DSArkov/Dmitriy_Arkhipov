<?php
header("Content-type: text/html; charset=utf-8");

$i = 0;
while ($i <= 100) {
    if ($i % 3 == 0) {
        echo $i . '<br>';
    }
    $i++;
}