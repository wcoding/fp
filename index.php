<?php

include __DIR__ . '/lib/template.php';

$params = array_filter(
    explode('/', $_GET['q']),
    'strlen'
);

$controller = isset($params[0]) ? strtolower($params[0]) : 'page';
$alias = isset($params[1]) ? strtolower($params[1]) : 'home';

if (
    false === file_exists(__DIR__ . '/app/controllers/' . $controller . '.php')
    ||
    false === file_exists(__DIR__ . '/app/views/' . $alias . '.php')
) {
    header('HTTP/1.0 404 Not Found');
    $content = template('404');
} else {
    $content = include __DIR__ . '/app/controllers/' . $controller . '.php';
}

$response = template('main', ['content' => $content]);

echo $response;
