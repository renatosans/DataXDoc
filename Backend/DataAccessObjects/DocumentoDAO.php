<?php

class DocumentoDAO{

    var $mysqlConnection;
    var $showErrors;

    #construtor
    function DocumentoDAO($mysqlConnection){
        $this->mysqlConnection = $mysqlConnection;
        $this->showErrors = 0;
    }

    function StoreRecord($dto){
        return null;
    }

    function DeleteRecord($id){
        return null;
    }

    function RetrieveRecord($id){
        return null;
    }

    function RetrieveRecordArray($filter = null){
        return null;
    }

}

?>
