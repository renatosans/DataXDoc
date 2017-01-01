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
        $query = "INSERT INTO campodocumento VALUES (NULL, ".$dto->modeloDocumento.", '".$dto->nome."', ".$dto->tipo.");";
        if ($dto->id > 0)
            $query = "UPDATE campodocumento SET modeloDocumento = ".$dto->modeloDocumento.", nome = '".$dto->nome."', tipo = ".$dto->tipo." WHERE id = ".$dto->id;

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
        $query = "DELETE FROM campodocumento WHERE id = ".$id.";";
        $result = mysql_query($query, $this->mysqlConnection);

        if ((!$result) && ($this->showErrors)) {
            print_r(mysql_error());
            echo '<br/>';
        }
        return $result;
    }

    function RetrieveRecord($id){
        $dto = null;

        $query = "SELECT * FROM campodocumento WHERE id = ".$id.";";
        $recordSet = mysql_query($query, $this->mysqlConnection);
        if ((!$recordSet) && ($this->showErrors)) {
            print_r(mysql_error());
            echo '<br/><br/>';
        }
        $recordCount = mysql_num_rows($recordSet);
        if ($recordCount != 1) return null;

        $record = mysql_fetch_array($recordSet);
        if (!$record) return null;
        $dto = new CampoDocumentoDTO();
        $dto->id              = $record['id'];
        $dto->modeloDocumento = $record['modeloDocumento'];
        $dto->nome            = $record['nome'];
        $dto->tipo            = $record['tipo'];
        mysql_free_result($recordSet);

        return $dto;
    }

    function RetrieveRecordArray($filter = null){
        $dtoArray = array();

        $query = "SELECT * FROM campodocumento WHERE ".$filter.";";
        if (empty($filter)) $query = "SELECT * FROM campodocumento;";

        $recordSet = mysql_query($query, $this->mysqlConnection);
        if ((!$recordSet) && ($this->showErrors)) {
            print_r(mysql_error());
            echo '<br/><br/>';
        }
        $recordCount = mysql_num_rows($recordSet);
        if ($recordCount == 0) return $dtoArray;

        $index = 0;
        while( $record = mysql_fetch_array($recordSet) ){
            $dto = new CampoDocumentoDTO();
            $dto->id              = $record['id'];
            $dto->modeloDocumento = $record['modeloDocumento'];
            $dto->nome            = $record['nome'];
            $dto->tipo            = $record['tipo'];

            $dtoArray[$index] = $dto;
            $index++;
        }
        mysql_free_result($recordSet);

        return $dtoArray;
    }

    /* Obtem os tipos de campo cadastrados no banco
    static function GetFieldTypes($mysqlConnection) {
        $fieldTypes = array();

        $query = "SELECT * FROM tipocampo;";
        $recordSet = mysql_query($query, $mysqlConnection);
        if (!$recordSet) {
            print_r(mysql_error());
            echo '<br/><br/>';
        }
        $recordCount = mysql_num_rows($recordSet);
        if ($recordCount == 0) return null;

        while( $record = mysql_fetch_array($recordSet) ) {
            $fieldTypes['id']        = $record['id'];
            $fieldTypes['descricao'] = $record['descricao'];
        }
        mysql_free_result($recordSet);

        return $fieldTypes;
    }*/

}

?>
