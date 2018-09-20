<?php
header("Content-type: text/html; charset=utf-8");


//Константа для хранения абсолютного пути к папке c оригинальными изображениями.
define('UPLOADS_DIR_MAX', __DIR__ . '/img/max/');
//Константа для хранения абсолютного пути к папке с уменьшенными копиями.
define('UPLOADS_DIR_MIN', __DIR__ . '/img/min/');
//Константа для хранения относительного пути к папке с оригиналами изображений.
define('IMG_MAX_DIR', '/img/max/');
//Константа для хранения относительного пути к папке с уменьшенными копиями.
define('IMG_MIN_DIR', '/img/min/');
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
            //Проверяем размер загружаемого файла.
            if (filesize($path) < $max_size) {
                //Сохраняем в переменную имя загружаемого файла.
                $filename = $_FILES['file']['name'];
                //Переменная хранящая путь до директории "max" + оригинальное имя файла.
                $filename_max = UPLOADS_DIR_MAX . $filename;
                //Переменная хранящая путь до директории "min" + оригинальное имя файла.
                $filename_min = UPLOADS_DIR_MIN . $filename;
                //Меняем размер изображения и помещаем его в папку "min".
                img_resize($path, $filename_min, 320, 180);
                //Перемещаем оригинал изображения из временной памяти в папку "max".
                move_uploaded_file($path, $filename_max);

                //Делаем редирект страницы на саму себя для обновления содержимого.
                header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);
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

/**
 *Функция изменяет размер изображения.
 * @param string $src имя исходного файла.
 * @param string $dest имя генерируемого файла.
 * @param int $width ширина генерируемого изображения.
 * @param int $height высота генерируемого изображения.
 * @param int $rgb цвет фона, по умолчанию - белый.
 * @param int $quality качество генерируемого JPEG, по умолчанию - максимальное (100).
 * @return boolean true - успешно, false - ошибка.
 */
function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {

    if (!file_exists($src)) return false;

    $size = getimagesize($src);
    if ($size === false) return false;

    //Определяем исходный формат по MIME-информации, предоставленной
    //функцией getimagesize, и выбираем соответствующую формату
    //imagecreatefrom-функцию.
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
    $icfunc = "imagecreatefrom" . $format;
    if (!function_exists($icfunc)) return false;

    $x_ratio = $width / $size[0];
    $y_ratio = $height / $size[1];

    $ratio = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);

    $new_width = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $new_height = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
    $new_top = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

    $isrc = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);

    imagefill($idest, 0, 0, $rgb);
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0,
        $new_width, $new_height, $size[0], $size[1]);

    imagejpeg($idest, $dest, $quality);

    imagedestroy($isrc);
    imagedestroy($idest);

    return true;
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Фотоальбом</title>
</head>
<body>

<?php
//Получаем массив изображений из директории, убрав 2 первых элемента: "." и "..".
$arr_min_img = array_slice(scandir(UPLOADS_DIR_MIN), 2);
//Выводим изображения на страницу.
for($i = 0; $i < count($arr_min_img); $i++) {
    ?> <a href="<?= IMG_MAX_DIR . $arr_min_img[$i] ?>" target="_blank">
    <img src="<?= IMG_MIN_DIR . $arr_min_img[$i] ?>" alt="image"></a> <?;
}
?>

<!--Форма для загрузки изображений-->
<form action="" enctype="multipart/form-data" method="post" style="margin: 20px">
    <input type="file" name="file" style="outline: none">
    <input type="submit">
</form>
</body>
</html>