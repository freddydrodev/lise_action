<?php
require '../Inc/_db.php';

if(isset($_POST['deluser'])){
  include '../Inc/func.php';

  $uid = trim(htmlspecialchars($_POST['deluser']));

  $del = $db->prepare('DELETE FROM users WHERE id = ? AND id != 1');
  if ($del->execute(array($uid))) {
    $ar = array('type' => 'success', 'text' => 'Success! utilisateur supprime');
  }
  else {
    $ar = array('type' => 'danger', 'text' => 'Erreur! utilisateur non-supprime');
  }
  echo json_encode($ar);
}
