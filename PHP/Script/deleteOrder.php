<?php
require '../Inc/_db.php';

if(isset($_POST['delOrd'])){
  include '../Inc/func.php';

  $pid = trim(htmlspecialchars($_POST['delOrd']));

  $del = $db->prepare('DELETE FROM orders WHERE ID = ?');
  if ($del->execute(array($pid))) {
    $ar = array('type' => 'success', 'text' => 'Success! Commande supprime');
  }
  else {
    $ar = array('type' => 'danger', 'text' => 'Erreur! Commande non-supprime');
  }
  echo json_encode($ar);
}
