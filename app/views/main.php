<?php
/**
 * Основной шаблон
 * ===============
 * $title - заголовок
 * $content - HTML страницы
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
</head>
<body>
    <header>
        <h1><?=$title?></h1>
    </header>
    <nav>
        <a href="page/index/1">Страница 1</a> |
        <a href="page/index/2">Страница 2</a> |
        <a href="page/index/3">Страница 3</a>
    </nav>
    <main>
        <?=$content?>
    </main>
    <footer>
        <p>Все права защищены. Адрес. Телефон.</p>
    </footer>
</body>
</html>
