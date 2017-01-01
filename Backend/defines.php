<?php

    // Tipos de banco de dados suportados no sistema
    $databaseType = Array(
        "mySql",
        "sqlServer",
        "both"
    );

    // Parâmetros de login no banco de dados
    $mysqlAuthentication = Array(
        "host"=>"localhost",
        "username"=>"root",
        "password"=>"P@ssw0rd",
        "database"=>"dataxdoc"
    );

    // Parâmetros de login no banco de dados
    $sqlserverAuthentication = Array(
        "host"=>"localhost",
        "username"=>"sapBusinessOne",
        "password"=>"P@ssw0rd",
        "database"=>"SBO_DATACOPY"
    );

    // Caminho para o diretório temporário
    $tempDir = "Backend/_tempDir";

?>
