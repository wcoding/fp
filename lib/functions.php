<?php


/**
* Функция загрузки файла на сервер
*
* @param    array $file         - $_FILES['image']
* @param    string $ext         - допустимые расширение файла с точькой (.png)
* @param    string $path        - путь к директории загрузки файла
* @param    int $maxFileSize    - максимально допустимый размер файла в битах или "1Mb*(1024*1024)"(необязательный,
*                                 по умолчанию используется значение из php.ini)
*
* @return   string              - при успешной загрузки возвращает имя файла с расширением.
* @return   int                 - код ошибки при неудачной загрузки.
*/
function uploadFile($file, $path, $ext, $maxFileSize = MAXFILESIZE)
{
    if (false === is_uploaded_file($file['tmp_name'])) {
        return $file['error'];// выйти с кодом ошибки если файл небыл загружен
    }

    $maxFileSize = ($maxFileSize < MAXFILESIZE) ? $maxFileSize : MAXFILESIZE;
    
    if ($file['size'] > $maxFileSize) {
        return 1;// если файл весит больше чем положено
    }

    preg_match("/[^\.]+$/", $file['name'], $check);
    
    if (false === in_array($check[0], $ext)) {
        return 9;// если расширение файла не совпадает с разрешённым, отдать код ошибки
    }

    $fileName = time() . '.' . $check[0];// присвоить имя файлу
    
    if (false === move_uploaded_file($file['tmp_name'], $path . $fileName)) {
        return 5;// выйти с кодом ошибки если файл небыл сохранён
    }

    $mime = image_type_to_mime_type(exif_imagetype($path . $fileName));
    $mime = explode('/', $mime);

    if (false === in_array($mime[1], $ext)) {
        unlink($path . $fileName);
        return 9;// если тип файла не совпадает с разрешённым, удалить файл и отдать код ошибки
    }

    return $fileName;// если файл сохранён в указанную директорию, отдать его имя
}


/**
* Функция удаляет файлы
*
* @param array   - массив, каждый элемент которого путь до файла
*
* @return int    - количество файлов которые удалось удалить
*/
function deleteFiles($files)
{
    if (false === is_array($files)) {
        return 0;
    }
    
    $i = 0;
    foreach ($files as $file) {
        if (unlink($file)) $i++;
    }

    return $i;
}


/**
* Функция осуществляет SQL-запрос
*
* @param string      - текст SQL-запроса
*
* @return resource   - дескриптор результата запроса
*/
function mysqlQueryResult($sql)
{
    $result = mysql_query($sql);

    if (!$result) {
        die(mysql_error());
    }

    return $result;
}


/**
* Функция добавляет к числу слово с правильным суффиксом в одной из трёх форм
* (напр., просмотор\просмотра\просмотров) в соответствии с этим числом
*
* @param int $num        - число к которому нужно добавить суффикс
* @param string $sfx1    - слово с правильным суффиксом для чисел 1, 21, 31, 101 и тд
* @param string $sfx234  - слово с правильным суффиксом для чисел 2, 3, 4, 53, 102 и тд
* @param string $sfxX    - слово с правильным суффиксом для всех остальных чисел
*
* @return string         - строка состоящая из числа и слова
*/
function addUnit($num, $sfx1, $sfx234, $sfxX)
{
        $last2Digit = $num % 100;
        
        if ($last2Digit >= 10 and $last2Digit <= 20) {
            return $num . ' ' . $sfxX;
        } else {
            switch ($num % 10) {
                case 1:
                        return $num . ' ' . $sfx1;
                case 2:
                case 3:
                case 4:
                        return $num . ' ' . $sfx234;
                default:
                        return $num . ' ' . $sfxX;
            }
        }
}


function template($fileName, $vars = [])
{
    foreach ($vars as $k => $v) {
        $$k = $v;
    }

    ob_start();
    include realpath(__DIR__ . '/../app/views/' . $fileName . '.php');

    return ob_get_clean();
}
