<?php

include_once("../defines.php");
include_once("../DataConnector.php");
include_once("../DataAccessObjects/CampoDocumentoDAO.php");
include_once("../DataTransferObjects/CampoDocumentoDTO.php");

// Abre a conexao com o banco de dados
$dataConnector = new DataConnector('mySql');
$dataConnector->OpenConnection();
if ($dataConnector->mysqlConnection == null) {
    echo 'Não foi possível se connectar ao bando de dados!';
    exit;  
}

// Cria o objeto de mapeamento objeto-relacional
$campoDocumentoDAO = new CampoDocumentoDAO($dataConnector->mysqlConnection);
$campoDocumentoDAO->showErrors = 1;

$id = 0;
$campoDocumento = new CampoDocumentoDTO();
if ( isset($_REQUEST["reg"]) && ($_REQUEST["reg"] != 0) ) {
    $id = $_REQUEST["reg"];
    $campoDocumento = $campoDocumentoDAO->RetrieveRecord($id);
}
$campoDocumento->modeloDocumento  = $_REQUEST["modeloDocumento"];
$campoDocumento->nome              = $_REQUEST["nome"];
$campoDocumento->tipo              = $_REQUEST["tipo"];

$recordId = $campoDocumentoDAO->StoreRecord($campoDocumento);
if ($recordId == null) {
    echo "Não foi possivel efetuar a operação...";
    exit;
}
echo $recordId; // retorna o id do registro inserido para a página de edição

// Fecha a conexão com o banco de dados
$dataConnector->CloseConnection();

?>
