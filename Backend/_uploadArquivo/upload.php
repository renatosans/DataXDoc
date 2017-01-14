<?php

    $filesMoved = 0;
    foreach ($_FILES as $file){
        if (!move_uploaded_file($file['tmp_name'], '../_tempDir/'.$file['name'])){
            print_r(error_get_last());
            exit;
        }
        $filesMoved++;
    }
    echo "Operação efetuada com sucesso. ".$filesMoved." arquivos movidos.";

    /*
    if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
      move_uploaded_file($_FILES['file']['tmp_name'], "_tempDir/" . $_FILES['file']['name']);

      $ret = array('status' => 'ok');
    } else {
      $ret = array('error' => 'no_file');
    }

    header('Content-Type: application/json');
    echo json_encode($ret);
    exit;
    */

?>
