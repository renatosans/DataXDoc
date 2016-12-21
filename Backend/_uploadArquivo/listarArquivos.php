<?php

    include_once("../defines.php");

    // Lista os arquivos do diretório temporário e retorna uma lista em formato JSON
    $fileArray = array();
    foreach (new DirectoryIterator("../../".$tempDir) as $fileInfo) {
        if($fileInfo->isDir()) continue;
        array_push($fileArray, $fileInfo->getFilename());
    }
    echo json_encode($fileArray);

?>
