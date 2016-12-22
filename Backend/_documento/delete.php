<?php

include_once("../defines.php");
include_once("../DataConnector.php");
include_once("../DataAccessObjects/DocumentoDAO.php");
include_once("../DataTransferObjects/DocumentoDTO.php");

// Abre a conexao com o banco de dados
$dataConnector = new DataConnector('mySql');
$dataConnector->OpenConnection();
if ($dataConnector->mysqlConnection == null) {
    echo 'Não foi possível se connectar ao bando de dados!';
    exit;  
}





// Fecha a conexão com o banco de dados
$dataConnector->CloseConnection();

?>
