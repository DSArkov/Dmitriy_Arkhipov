<?php

/**
 * Функция выполняет переадресацию на указанный URL.
 * @param string $url - страница, на которую переадресовываем.
 */
function redirect($url) {
    return header("Location: {$url}");
    exit;
}