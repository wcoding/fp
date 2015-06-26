<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 26.06.2015
 * Time: 20:47
 */

include_once DOC_ROOT . '/app/models/pages.php';

$data = getContent($params[1]);
$content = template($data['alias'], $data);