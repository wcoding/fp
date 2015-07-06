<?php


/**
 * Функция делает выборку из БД одного изображения по его идентификатору
 *
 * @param int     - идентификатор изображения
 *
 * @return array  - массив с именем файла и количеством просмотров
 */
function getItem($id)
{
    $id = (int)$id;

    if ($id == 0) {
        return array();
    }

    $sql = 'SELECT name,views,title,description FROM gallery WHERE id=' . $id;
    $result = mysqlQueryResult($sql);

    return mysql_fetch_assoc($result);
}


/**
 * Функция делает выборку из БД изображений и сортирует по количеству просмотров
 *
 * @return array  - многомерный массив с названиями полей в качестве ключей массива
 */
function getList()
{
    $arr = array();

    $sql = 'SELECT * FROM gallery ORDER BY views DESC';
    $result = mysqlQueryResult($sql);

    while ($row = mysql_fetch_assoc($result)) {
        $arr[] = $row;
    }

    return $arr;
}


/**
 * Функция обновляет счётчик просмотров изображения
 *
 * @param int   - идентификатор изображения
 *
 * @return int  - количество модифицированных строк в БД
 */
function updateViewsCount($id)
{
    $id = (int)$id;

    if ($id == 0) {
        return 0;
    }

    $sql = 'UPDATE gallery SET views=views+1 WHERE id=' . $id;
    mysqlQueryResult($sql);

    return mysql_affected_rows();
}


/**
 * Функция добавляет новое изображение в БД
 *
 * @param array - $_FILES['image']
 *
 * @return int  - идентификатор нового изображения
 */
function add($file, $title, $description)
{
    $name = trim($file);

    if ($name == "") {
        return 0;
    }

    $title = trim(htmlspecialchars($title));
    $description = trim(htmlspecialchars($description));

    $sql = sprintf(
        "INSERT INTO gallery (name,title,description) VALUES ('%s','%s','%s')",
        mysql_real_escape_string($name),
        mysql_real_escape_string($title),
        mysql_real_escape_string($description)
    );
    mysqlQueryResult($sql);

    return mysql_insert_id();
}


/**
 * Функция обновляет информацию о картинке в БД
 *
 * @param int   - идентификатор изображения
 *
 * @return int  - количество модифицированных строк в БД
 */
function edit($id, $title, $description)
{
    $id = (int)$id;

    if ($id == 0) {
        return 0;
    }

    $title = trim(htmlspecialchars($title));
    $description = trim(htmlspecialchars($description));

    $sql = sprintf(
        "UPDATE gallery SET title='%s', description='%s' WHERE id=" . $id,
        mysql_real_escape_string($title),
        mysql_real_escape_string($description)
    );
    mysqlQueryResult($sql);

    return mysql_affected_rows();
}
