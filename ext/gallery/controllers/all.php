<?php
include_once realpath(__DIR__ . '/../../../ext/gallery/models/gallery.php');

return getHtml(
    'all',
    ['images' => getList()],
    'ext/gallery/views/'
);

