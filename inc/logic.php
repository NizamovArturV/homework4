<?php

// Преобразование массива
function FilesArr(&$filesArr)
{
    foreach ($filesArr as $key => $file) {
        foreach ($file as $k => $v) {
            $filesArr[$k][$key] = $v;
        }
        unset ($filesArr[$key]);
    }
    return $filesArr;
}

// Количество файлов
function CountFiles($filesArr)
{
    return (count($filesArr) > 5) ? false : true;
}

// Проверка ошибок 
function CheckErrors($fileError)
{
    return ($fileError != 0) ? false : true;
}

//Проверка типа файла 
function CheckType($fileType, $fileTypesAccept = ['image/jpeg', 'image/png', 'image/jpg'])
{
    return (!in_array($fileType,$fileTypesAccept)) ? false : true;
}

//Проверка размера файла 
function CheckSize($fileSize, $maxFileSize = 5000000)
{
    return ($fileSize > $maxFileSize) ? false : true;
}


if (isset($_FILES['userfile']) && isset($_POST['upload'])) {
    $files = FilesArr($_FILES['userfile']);
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
    $fileTypesAccept = ['image/jpeg', 'image/png', 'image/jpg'];
    
    if (CountFiles($files) === false) {
        $results[] = ("Нельзя загружать более 5 файлов");
    } else {
        foreach ($files as $k => $v) {
            $fileName = $files[$k]['name'];
            $fileTmpName = $files[$k]['tmp_name'];
            $fileType = $files[$k]['type'];
            $fileSize = $files[$k]['size'];
            $errorCode = $files[$k]['error'];

            if (CheckErrors($errorCode) === false) {
                $results[] = "Ошибка при загрузке файлов";
            }

            if (CheckType($fileType) === false) {
                $results[] = "У файла $fileName недопустимый тип";
            }

            if (CheckSize($fileSize) === false) {
                $results[] = "Размер изображения $fileName превышает 5 Мбайт";
            }
            if (empty($results)) {
                move_uploaded_file($fileTmpName, $uploadPath . $fileName);
            }
        }
        if (empty($results)) {
            $results[] = "Фотографии успешно загружены";
        }        
    }
}


