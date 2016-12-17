<?php

include_once("../DataConnector.php");
include_once("../DataAccessObjects/ModeloDocumentoDAO.php");
include_once("../DataTransferObjects/ModeloDocumentoDTO.php");

// Abre a conexao com o banco de dados
$dataConnector = new DataConnector('mySql');
$dataConnector->OpenConnection();
if ($dataConnector->mysqlConnection == null) {
    echo 'Não foi possível se connectar ao bando de dados!';
    exit;  
}

// Cria o objeto de mapeamento objeto-relacional
$modeloDocumentoDAO = new ModeloDocumentoDAO($dataConnector->mysqlConnection);
$modeloDocumentoDAO->showErrors = 1;

$id = 0;
$modeloDocumento = new ModeloDocumentoDTO();
if ( isset($_REQUEST["id"]) && ($_REQUEST["id"] != 0) ) {
    $id = $_REQUEST["id"];
    $modeloDocumento = $modeloDocumentoDAO->RetrieveRecord($id);
}

$modeloDocumento->

    $supplyRequest->codigoCartaoEquipamento  = $_REQUEST["equipmentCode"];
    $supplyRequest->data                     = $_REQUEST["data"];
    $supplyRequest->hora                     = $_REQUEST["hora"];
    $supplyRequest->status                   = $_REQUEST["status"];
    $supplyRequest->observacao               = $_REQUEST["observacao"];

    $recordId = $supplyRequestDAO->StoreRecord($supplyRequest);
    if ($recordId == null) {
        echo "N�o foi possivel efetuar a opera��o...";
        exit;
    }
echo $recordId; // retorna o id do registro inserido para a p�gina de edi��o

// Fecha a conex�o com o banco de dados
$dataConnector->CloseConnection();

?>
