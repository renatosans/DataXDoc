<?php

class ModeloDocumentoDAO{

    var $mysqlConnection;
    var $showErrors;

    #construtor
    function ModeloDocumentoDAO($mysqlConnection){
        $this->mysqlConnection = $mysqlConnection;
        $this->showErrors = 0;
    }

    function StoreRecord($dto){
        // Monta a query dependendo do id como INSERT ou UPDATE
        $query = "INSERT INTO modelodocumento VALUES (NULL, '".$dto->nome."', '".$dto->descricao."');";
        if ($dto->id > 0)
            $query = "UPDATE modelodocumento SET nome = '".$dto->nome."', descricao = '".$dto->descricao."' WHERE id = ".$dto->id.";";

        $result = mysql_query($query, $this->mysqlConnection);
        if ($result) {
            $insertId = mysql_insert_id($this->mysqlConnection);
            if ($insertId == null) return $dto->id;
            return $insertId;
        }

        if ((!$result) && ($this->showErrors)) {
            print_r(mysql_error());
            echo '<br/>';
        }
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
