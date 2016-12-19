<?php

class CampoDocumentoDAO{

    var $mysqlConnection;
    var $showErrors;

    #construtor
    function CampoDocumentoDAO($mysqlConnection){
        $this->mysqlConnection = $mysqlConnection;
        $this->showErrors = 0;
    }

    function StoreRecord($dto){
        // Monta a query dependendo do id como INSERT ou UPDATE
        $query = "INSERT INTO campoDocumento VALUES (NULL, '".$dto->modeloDocumento."', '".$dto->nome."', '".$dto->tipo."');";
        if ($dto->id > 0)
            $query = "UPDATE campoDocumento SET modeloDocumento = '".$dto->modeloDocumento."', nome = ".$dto->nome.", tipo = '".$dto->tipo."' WHERE id = ".$dto->id;

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
        $query = "DELETE FROM campoDocumento WHERE id = ".$id.";";
        $result = mysql_query($query, $this->mysqlConnection);

        if ((!$result) && ($this->showErrors)) {
            print_r(mysql_error());
            echo '<br/>';
        }
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
