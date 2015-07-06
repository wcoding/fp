<?php

include __DIR__ . '/lib/functions.php';
mysqlStartUp();

$paramsFromURL = array_filter(
    explode('/', $_GET['q']),
    'strlen'
);

$controller = isset($paramsFromURL[0]) ? strtolower($paramsFromURL[0]) : 'home';

if (false === file_exists(__DIR__ . '/app/controllers/' . $controller . '.php')) {
    include __DIR__ . '/app/controllers/404.php';
} else {
    include __DIR__ . '/app/controllers/' . $controller . '.php';
}

$response = getHtml(
    'template',
    [
        'main'  => $mainContent,
        'title' => $data['title']
    ]
);

echo $response;
