<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/logic.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файлов на сервер</title>
</head>
<body>
    <form enctype="multipart/form-data" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
    <span>Загрузите не более 5 картинок (размером не более 5 мб) </span>
    <input required accept=".png, .jpg, .jpeg" type="file" name="userfile[]" multiple>
    <?php if (!empty($results)) : ?>
    <?php foreach ($results as $result) : ?>
        <?= $result ?>
    <?php endforeach ?>
    <?php endif ?>
    <input type="submit" name="upload" value="Загрузить">
    </form>
    <a href="/show_image.php">Галлерея изображений</a>
</body>
</html>