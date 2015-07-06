<?php
/**
 * Основной шаблон
 * ===============
 * $title - заголовок
 * $main - HTML страницы
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
</head>
<body>
    <header>
        <nav>
            <a href="/">Главная</a> |
            <a href="/gallery">Галерея</a> |
            <a href="/news/3">Новость 3</a>
        </nav>
    </header>
    <main>
        <h1><?=$title?></h1>
        <?=$main?>
    </main>
    <footer>
        <p>Все права защищены. Адрес. Телефон.</p>
    </footer>
</body>
</html>
