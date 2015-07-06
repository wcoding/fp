<?php

include_once realpath(__DIR__ . '/../../app/models/pages.php');
$data = [];
$data = getContent($controller);

$ext = include realpath(__DIR__ . '/../config/extensions.php');
$data['gallery'] = include realpath(__DIR__ . '/../../ext/' . $ext['gallery']['dirName'] . '/controllers/all.php');

$mainContent = getHtml($controller, $data);
