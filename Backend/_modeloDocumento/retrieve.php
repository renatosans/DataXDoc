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

/* recupera a lista de registros em formato JSON */
$id = 0;
if( isset($_POST['reg']) ){
    $id = $_POST['reg'];
    $modeloDocumentoDTO = $modeloDocumentoDAO->RetrieveRecord($id);
    echo json_encode($modeloDocumentoDTO);
}
if ($id == 0){ // nenhum registro especificado, retorna todos
    $lista = $modeloDocumentoDAO->RetrieveRecordArray(null);
    echo json_encode($lista);
}

// Fecha a conexão com o banco de dados
$dataConnector->CloseConnection();

?>
