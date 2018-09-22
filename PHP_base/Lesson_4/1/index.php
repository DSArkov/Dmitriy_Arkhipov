<?php
header("Content-type: text/html; charset=utf-8");

//Константа для хранения абсолютного пути к корневой папке.
define('DOCUMENT_ROOT', __DIR__ . '/');
//Константа для хранения абсолютного пути к папке "uploads".
define('UPLOADS_DIR', DOCUMENT_ROOT . 'uploads/');

function render() {
    define('IMG_MIN_DIR', __DIR__ . '/img/min/');
    define('IMG_MAX_DIR', __DIR__ . '/img/max/');
    $files = scandir(IMG_MIN_DIR);
    echo '<a href="' . IMG_MAX_DIR . '1_max.jpg"><img src="php_base/lesson_4/1/img/min/' . $files[2] . '"></a>';
}
render();

//Проверяем была ли отправлена форма.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Проверяем был ли отправлен файл.
    if (isset($_FILES['file'])) {
        //Сохраняем в переменную путь к временному файлу.
        $path = $_FILES['file']['tmp_name'];
        //Проверяем тип изображения.
        if (exif_imagetype($path) == IMAGETYPE_JPEG) {
            //Проверяем размер файла.
            if (filesize($path) < 256000) {
            //Проверяем существование директории для загрузок.
                if (!file_exists(UPLOADS_DIR)) {
                    //Если такой дериктирии нет - создаем её.
                    mkdir(UPLOADS_DIR);
                }
                //Переменная хранящая путь до директории + оригинальное имя файла.
                $filename = UPLOADS_DIR . $_FILES['file']['name'];
                //Перемещаем файл из врменного места хранения в необходимую папку.
                move_uploaded_file($path, $filename);
            //Если размер больше 256 Кбайт - выводим сообщение об ошибке.
            } else {
                echo '<p>Размер файла не должен превышать 256 Кбайт.</p>';
            }
        //Если тип файла не "JPEG" - выводим сообщение об ошибке.
        } else {
            echo '<p>Для загрузки доступны только изображения типа JPEG.</p>';
        }
    }
}





/***********************************************************************************
Функция img_resize(): генерация thumbnails
Параметры:
$src             - имя исходного файла
$dest            - имя генерируемого файла
$width, $height  - ширина и высота генерируемого изображения, в пикселях
Необязательные параметры:
$rgb             - цвет фона, по умолчанию - белый
$quality         - качество генерируемого JPEG, по умолчанию - максимальное (100)
 ***********************************************************************************/

function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {
    if (!file_exists($src)) return false;

    $size = getimagesize($src);

    if ($size === false) return false;

    // Определяем исходный формат по MIME-информации, предоставленной
    // функцией getimagesize, и выбираем соответствующую формату
    // imagecreatefrom-функцию.
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
    $icfunc = "imagecreatefrom" . $format;
    if (!function_exists($icfunc)) return false;

    $x_ratio = $width / $size[0];
    $y_ratio = $height / $size[1];

    $ratio       = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);

    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

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

<form action="" enctype="multipart/form-data" method="post">
    <input type="file" name="file">
    <input type="submit">
</form>
