<?php
    echo '<p>Before: <br>';
    echo 'a = ' . ($a = 10) . '<br>';
    echo 'b = ' . ($b = 250) . '</p>';

    echo '<p>After: <br>';
    $a += $b;
    $b = $a - $b;
    $a -= $b;
    echo "a = $a<br>";
    echo "b = $b</p>";