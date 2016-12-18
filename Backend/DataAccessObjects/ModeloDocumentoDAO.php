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
        $dto = null;

        $query = "SELECT * FROM modelodocumento WHERE id = ".$id.";";
        $recordSet = mysql_query($query, $this->mysqlConnection);
        if ((!$recordSet) && ($this->showErrors)) {
            print_r(mysql_error());
            echo '<br/><br/>';
        }
        $recordCount = mysql_num_rows($recordSet);
        if ($recordCount != 1) return null;

        $record = mysql_fetch_array($recordSet);
        if (!$record) return null;
        $dto = new CounterDTO();
        $dto->id       = $record['id'];
        $dto->nome     = $record['nome'];
        mysql_free_result($recordSet);

        return $dto;
    }

    function RetrieveRecordArray($filter = null){
        return null;
    }

}

?>
