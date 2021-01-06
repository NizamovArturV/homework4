<?php

if (isset($_FILES['userfile']) && isset($_POST['upload'])) {
    //Преобразуем массив файлов
    foreach ($_FILES['userfile'] as $key => $file) {
        foreach ($file as $k => $v) {
            $_FILES['userfile'][$k][$key] = $v;
        }
        unset ($_FILES['userfile'][$key]);
    }
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
    $fileTypesAccept = ['image/jpeg', 'image/png', 'image/jpg'];
    //Проверяем ограничение по количеству файлов 
    if (count($_FILES['userfile']) > 5) {
        $results[] = ("Нельзя загружать более 5 файлов");
    }
    //Проверяем каждый файл поочереди
    foreach ($_FILES['userfile'] as $k => $v) {
        $fileName = $_FILES['userfile'][$k]['name'];
        $fileTmpName = $_FILES['userfile'][$k]['tmp_name'];
        $fileType = $_FILES['userfile'][$k]['type'];
        $fileSize = $_FILES['userfile'][$k]['size'];
        $errorCode = $_FILES['userfile'][$k]['error'];
        //Проверяем наличие ошибок
        if ($errorCode != 0) {
            $results[] = "Ошибка при загрузке файлов";
        }
        //Проверяем тип файла 
        if (!in_array($fileType,$fileTypesAccept)) {
            $results[] = "У файла $fileName недопустимый тип";
        }
        //Проверяем ограничение по размеру
        if ($fileSize > 5000000) {
            $results[] = "Размер изображения $fileName превышает 5 Мбайт";
        }
        //Если не возникло ошибок, загружаем файл
        if (empty($results)) {
            move_uploaded_file($fileTmpName, $uploadPath . $fileName);
        }
    }
    if (empty($results)) {
        $results[] = "Фотографии успешно загружены";
    }

}

