<?php


/**
 * Функция изменяет размер заданного изображения и сохраняет
 *
 * @param string $pathFile        - путь до изображения
 * @param string $destination    - путь куда сохранять миниатюру изображения
 * @param string $width          - задаваемая ширина миниатюры
 * @param string $height         - задаваемая высота миниатюры
 *
 * @return bool                  - true если миниатюра создана
 */
function imgResize($pathFile, $destination, $width, $height)
{
    list($widthOrig, $heightOrig, $type) = getimagesize($pathFile);// получить оригинальные размеры и тип изображения

    $ratioOrig = $widthOrig/$heightOrig; // вычислить соотношение сторон оригинала

    if (($width / $height) > $ratioOrig) {
        $width = $height * $ratioOrig;// если высота оригинала больше ширины, то уменьшить задаваемую ширину
    } else {
        $height = $width / $ratioOrig;// если высота оригинала меньше ширины, то уменьшить задаваемую высоту
    }

    // сформировать строку из пути и имени файла, для того, чтобы сохранить миниатюру
    $destination = $destination . basename($pathFile);

    // В $type содержится код типа файла, возвращяемого функцией getimagesize()
    switch ($type) {
        case 2:
            $newImage = imagecreatetruecolor($width, $height);// создать подложку
            $image = imagecreatefromjpeg($pathFile);
            // копирование и изменение размера изображения
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);
            $result = imagejpeg($newImage, $destination, 100);
            break;
        case 3:
            $newImage = imagecreatetruecolor($width, $height);
            imageAlphaBlending($newImage, false);
            imagesavealpha($newImage, true);
            $image = imagecreatefrompng($pathFile);
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);
            $result = imagepng($newImage, $destination, 0);// положить уменьшенное изображение в папку
            break;
        case 1:
            $newImage = imagecreate($width, $height);
            $color = imagecolorallocate($newImage, 0, 0, 0);// установить цвет подложки
            imagecolortransparent($newImage, $color);// указать прозрачность подложке
            $image = imagecreatefromgif($pathFile);// положить на подложку gif-изображение
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);
            $result = imagegif($newImage, $destination);
            break;
    }

    // освободить память
    imagedestroy($image);
    imagedestroy($newImage);

    return $result ;
}


/**
 * Функция возвращяет отформатированную строку количества просмотров картинки,
 * используя основную библиотеку функций.
 *
 * @param int $num  - количество просмотров
 *
 * @return string   - отформатированная строка
 */
function nouns($num)
{
    return addUnit($num, 'просмотор', 'просмотра', 'просмотров');
}
