<?php

$uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
$files = scandir($uploadPath);

if (isset($_POST['deleteFile']) && isset($_POST['delete'])) {
    
    $results = [];
    
    foreach ($_POST['deleteFile'] as $file) {
        if (!is_file($uploadPath . $file)) {
            $results[] = 'Такого файла не существует!';   
        } else {
            unlink ($uploadPath . $file);
            $results[] = "Файл $file успешно удален";
        }
    }
}
