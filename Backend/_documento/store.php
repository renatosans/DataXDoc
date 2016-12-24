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

// Cria o objeto de mapeamento objeto-relacional
$documentoDAO = new DocumentoDAO($dataConnector->mysqlConnection);
$documentoDAO->showErrors = 1;

$id = 0;
$documento = new DocumentoDTO();
if ( isset($_REQUEST["reg"]) && ($_REQUEST["reg"] != 0) ) {
    $id = $_REQUEST["reg"];
    $documento = $documentoDAO->RetrieveRecord($id);
}
$documento->repositorio = $_REQUEST["repositorio"];
$documento->nome        = $_REQUEST["nome"];
$documento->arquivo     = $_REQUEST["arquivo"];

$recordId = $documentoDAO->StoreRecord($documento);
if ($recordId == null) {
    echo "Não foi possivel efetuar a operação...";
    exit;
}
echo $recordId; // retorna o id do registro inserido para a página de edição

// Fecha a conexão com o banco de dados
$dataConnector->CloseConnection();

?>
