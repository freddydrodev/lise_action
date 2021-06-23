<?php
require '../Inc/_db.php';
if(isset($_POST['delSal'])){
  $ar = array();
  $id = htmlspecialchars(trim($_POST['delSal']));

  $check = $db->prepare('DELETE FROM orders WHERE ID = ?');
  if($check->execute(array($id))){
    $ar = array('type' => 'success');
  }
  else {
    $ar = array('type' => 'error');
  }

  echo json_encode($ar);
}
