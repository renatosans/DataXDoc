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

if( !isset($_POST['id']) ){
    echo "Selecione os registros que deseja excluir";
    exit;
}

foreach($_POST['id'] as $key=>$id){
    if( !$modeloDocumentoDAO->DeleteRecord($id) ){
        echo "Não foi possivel efetuar a operação...";
        exit;
    }
}

echo "Operação efetuada com sucesso!";

// Fecha a conexão com o banco de dados
$dataConnector->CloseConnection();

?>
