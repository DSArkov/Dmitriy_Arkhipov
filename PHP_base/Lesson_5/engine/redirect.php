<?php

/**
 * Функция делает редирект на указанный адрес.
 * @param string $url - ссылка.
 */
function redirect ($url){
    header("Location: {$url}");
    exit;
}
