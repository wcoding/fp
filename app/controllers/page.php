<?php

include_once realpath(__DIR__ . '/../../app/models/pages.php');

$data = getContent($alias);

return template($alias, $data);
