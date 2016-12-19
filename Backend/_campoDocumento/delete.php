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

if( !isset($_POST['reg']) ){
    echo "Selecione os registros que deseja excluir";
    exit;
}

foreach($_POST['reg'] as $key=>$reg){
    if( !$campoDocumentoDAO->DeleteRecord($reg) ){
        echo "Não foi possivel efetuar a operação...";
        exit;
    }
}

echo "Operação efetuada com sucesso!";

// Fecha a conexão com o banco de dados
$dataConnector->CloseConnection();

?>
