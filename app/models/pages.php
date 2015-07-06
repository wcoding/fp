<?php


function getContent($alias)
{
    $arr = [];

    $sql = "SELECT * FROM pages WHERE alias='" . $alias . "'";

    $result = mysqlQueryResult($sql);

    while ($row = mysql_fetch_assoc($result)) {
        $arr[] = $row;
    }

    return $arr[0];
}
