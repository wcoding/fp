<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 26.06.2015
 * Time: 20:38
 */

function template($fileName, $vars = [])
{
    foreach ($vars as $k => $v) {
        $$k = $v;
    }

    ob_start();
    include DOC_ROOT . '\app\views\\' . $fileName . '.php';

    return ob_get_clean();
}
