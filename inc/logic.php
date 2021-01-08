<?php

// Преобразование массива
function filesArr($filesArr)
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
function countFiles($filesArr)
{
    return $filesArr < 6;
}

// Проверка ошибок 
function checkErrors($fileError)
{
    return ($fileError === 0);
}

//Проверка типа файла 
function checkType($fileType, $fileTypesAccept = ['image/jpeg', 'image/png', 'image/jpg'])
{
    return (in_array($fileType,$fileTypesAccept));
}

//Проверка размера файла 
function checkSize($fileSize, $maxFileSize = 5000000)
{
    return ($fileSize < $maxFileSize);
}


if (isset($_FILES['userfile']) && isset($_POST['upload'])) {
    $files = filesArr($_FILES['userfile']);
    $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
    $fileTypesAccept = ['image/jpeg', 'image/png', 'image/jpg'];
    
    if (countFiles(count($files)) === false) {
        $results[] = ("Нельзя загружать более 5 файлов");
    } else {
        foreach ($files as $k => $v) {
            $fileName = $files[$k]['name'];
            $fileTmpName = $files[$k]['tmp_name'];
            $fileType = $files[$k]['type'];
            $fileSize = $files[$k]['size'];
            $errorCode = $files[$k]['error'];

            if (checkErrors($errorCode) === false) {
                $results[] = "Ошибка при загрузке файлов";
            }

            if (checkType($fileType) === false) {
                $results[] = "У файла $fileName недопустимый тип";
            }

            if (checkSize($fileSize) === false) {
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


