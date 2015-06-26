<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 26.06.2015
 * Time: 17:15
 */

define('DOC_ROOT', __DIR__);
$info = explode('/', $_GET['q']);
$params = [];

foreach ($info as $v) {
    if ($v != '') {
        $params[] = $v;
    }
}

include __DIR__ . '/lib/template.php';
include __DIR__ . '/app/controllers/' . $params[0] . '.php';
$response = template('main', ['content' => $content]);

echo $response;
