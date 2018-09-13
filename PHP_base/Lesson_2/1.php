<?php
header("Content-type: text/html; charset=utf-8");

$a = 0;
$b = -5;

if (($a >= 0) && ($b >= 0)) {
    echo $a - $b;
} else if (($a < 0) && ($b < 0)) {
    echo $a * $b;
} else {
    echo $a + $b;
}