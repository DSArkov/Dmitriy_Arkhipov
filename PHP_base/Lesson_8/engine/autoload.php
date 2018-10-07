<?php

/**
 * Функция подключает файлы из директории engine.
 */
function autoload() {
    //Сканируем директорию.
    $files = scandir(ENGINE_DIR);
    //Перебираем получившийся массив.
    foreach ($files as $file) {
        //Если это не ссылка на каталоги "выше" и "текущий".
        if (!in_array($file, ['..', '.'])) {
            //Проверям расширение файла.
            if (substr($file, -4) == ".php") {
                //Если это ".php" - подключаем.
                include_once ENGINE_DIR . DIRECTORY_SEPARATOR . $file;
            }
        }
    }
}

//Вызываем функцию.
autoload();