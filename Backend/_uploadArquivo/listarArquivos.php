<?php

    include_once("../defines.php");

    // Lista os arquivos do diretório temporário e retorna uma lista em formato JSON
    $fileArray = scandir("../../".$tempDir); // volta dois diretórios na árvore de diretórios
    echo json_encode($fileArray);

?>
