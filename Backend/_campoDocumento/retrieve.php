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

/* recupera a lista de registros em formato JSON */
$id = 0;
if ( isset($_POST["reg"]) && ($_POST["reg"] != 0) ) {
    $id = $_POST['reg'];
    $campoDocumentoDTO = $campoDocumentoDAO->RetrieveRecord($id);
    echo json_encode($campoDocumentoDTO);
}
if ($id == 0){ // nenhum registro especificado, retorna todos
    $lista = $campoDocumentoDAO->RetrieveRecordArray(null);
    echo json_encode($lista);
}

// Fecha a conexão com o banco de dados
$dataConnector->CloseConnection();

?>
