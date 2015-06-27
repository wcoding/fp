<?php

function template($fileName, $vars = [])
{
    foreach ($vars as $k => $v) {
        $$k = $v;
    }

    ob_start();
    include realpath(__DIR__ . '/../app/views/' . $fileName . '.php');

    return ob_get_clean();
}
