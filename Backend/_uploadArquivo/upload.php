<?php

if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
  move_uploaded_file($_FILES['file']['tmp_name'], "_tempDir/" . $_FILES['file']['name']);

  $ret = array('status' => 'ok');
} else {
  $ret = array('error' => 'no_file');
}

header('Content-Type: application/json');
echo json_encode($ret);
exit;

?>
