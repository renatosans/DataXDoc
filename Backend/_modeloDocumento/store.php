<?php

include_once("../defines.php");
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
if ( isset($_REQUEST["reg"]) && ($_REQUEST["reg"] != 0) ) {
    $id = $_REQUEST["reg"];
    $modeloDocumento = $modeloDocumentoDAO->RetrieveRecord($id);
    if (is_null($modeloDocumento)){ // O registro não existe ou foi deletado
        $modeloDocumento = new ModeloDocumentoDTO();
    }
}
$modeloDocumento->nome       = $_REQUEST["nome"];
$modeloDocumento->descricao  = $_REQUEST["descricao"];

$recordId = $modeloDocumentoDAO->StoreRecord($modeloDocumento);
if ($recordId == null) {
    echo "Não foi possivel efetuar a operação...";
    exit;
}
echo $recordId; // retorna o id do registro inserido para a página de edição

// Fecha a conexão com o banco de dados
$dataConnector->CloseConnection();

?>
