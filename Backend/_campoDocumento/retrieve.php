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
$modeloDocumento = 0;
if ( isset($_POST["modeloDocumento"]) && ($_POST["modeloDocumento"] != 0) ) {
    $modeloDocumento = $_POST['modeloDocumento'];
    $lista = $campoDocumentoDAO->RetrieveRecordArray("modeloDocumento=".$modeloDocumento); // filtra os campos por modelo de documento
    echo json_encode($lista);
}
if ($modeloDocumento == 0){ // filtro não especificado, retorna todos os registros
    $lista = $campoDocumentoDAO->RetrieveRecordArray(null);
    echo json_encode($lista);
}

// Fecha a conexão com o banco de dados
$dataConnector->CloseConnection();

?>
