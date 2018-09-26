<?php
header("Content-type: text/html; charset=utf-8");

include  __DIR__ . '/../config/main.php';
include ENGINE_DIR . "filename.php";
include ENGINE_DIR . "resize.php";
include ENGINE_DIR . "redirect.php";
include ENGINE_DIR . "connect_db.php";
include ENGINE_DIR . "query_db.php";
include ENGINE_DIR . "getImages_db.php";


//Константа для хранения абсолютного пути к папке c оригинальными изображениями.
define('UPLOADS_DIR_MAX', ROOT_DIR . 'public/img/max/');
//Константа для хранения абсолютного пути к папке с уменьшенными копиями.
define('UPLOADS_DIR_MIN', ROOT_DIR . 'public/img/min/');
//Константа для хранения относительного пути к папке с оригиналами изображений.
define('IMG_MAX_DIR', '/public/img/max/');
//Константа для хранения относительного пути к папке с уменьшенными копиями.
define('IMG_MIN_DIR', '/public/img/min/');
//Определяем допустимый тип изображения.
$file_type = IMAGETYPE_JPEG;
//Определяем максимальный размер загружаемого файла в байтах.
$max_size = 700000;


//Проверяем была ли отправлена форма.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Проверяем был ли отправлен файл.
    if (isset($_FILES['file'])) {

        //Сохраняем в переменную путь к временному файлу.
        $path = $_FILES['file']['tmp_name'];
        //Проверяем тип изображения.
        if (exif_imagetype($path) == $file_type) {

            //Сохраняем в переменную размер изображения.
            $sizeImg = filesize($path);
            //Проверяем размер загружаемого файла.
            if ($sizeImg < $max_size) {

                //Сохраняем в переменную оригинальное название файла либо имя с префиксом, если
                //такой уже существует.
                $filename = newFileName($_FILES['file']['name'], UPLOADS_DIR_MAX);
                //Меняем размер изображения и помещаем его в папку "min".
                img_resize($path, UPLOADS_DIR_MIN . $filename, 320, 180);
                //Перемещаем оригинал изображения из временной памяти в папку "max".
                move_uploaded_file($path, UPLOADS_DIR_MAX . $filename);
                //Создаем url для изображения.
                $urlImg = 'http://' . $_SERVER['HTTP_HOST'] . IMG_MAX_DIR . $_FILES['file']['name'];
                //Добавляем данные изображения в базу данных.
                query("INSERT INTO big_small_img.images (url, size, title) 
                                    VALUES ('{$urlImg}', '{$sizeImg}', '{$filename}')");
                //Делаем редирект страницы на саму себя для обновления содержимого.
                redirect('index.php');
                //Останавливаем скрипт.
                exit;

            //Если размер больше максимального - выводим сообщение об ошибке.
            } else {
                echo "<p>Размер файла не должен превышать {$max_size} Кбайт.</p>";
            }

        //Если тип файла не допустимый - выводим сообщение об ошибке.
        } else {
            echo '<p>Для загрузки доступны только изображения типа JPEG.</p>';
        }
    }
}

//Подключаем галерею.
include TEMPLATES_DIR . 'gallery.php';



