<?php

include_once realpath(__DIR__ . '/../../app/models/pages.php');

$data = [];
$data = getContent($controller);

$mainContent = getHtml($controller, $data);
