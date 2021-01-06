<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/show_image_logic.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загруженные изображения</title>
</head>
<body>
    <h1>Просмотр и удаления изображений</h1>
    <a href="/index.php">На главную</a> <br>
    <?php if (!empty($results)) : ?>
    <?php foreach ($results as $result) : ?>
        <?= $result ?>
    <?php endforeach ?>
    <?php endif ?>
    <form enctype="multipart/form-data" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
        <?php foreach ($files as $file) : if ($file != '.' && $file != '..') :?>
            <img width="500px" height="500px" src="<?= '/upload/' . $file ?>">
            <p> <?=$file?> 
            <input name="deleteFile[]" type="checkbox" value="<?= $file ?>"></p>
        <?php endif ?>
        <?php endforeach ?>
        <input type="submit" name="delete" value="Удалить изображения">
    </form>
    
</body>
</html>