<?php
require '../Inc/_db.php';

if(isset($_POST['valOrd'])){
  include '../Inc/func.php';

  $pid = trim(htmlspecialchars($_POST['valOrd']));

  $del = $db->prepare('UPDATE orders SET state = "1" WHERE ID = ?');
  if ($del->execute(array($pid))) {
    $ar = array('type' => 'success', 'text' => 'Success! Commande valide');
  }
  else {
    $ar = array('type' => 'danger', 'text' => 'Erreur! Commande non-valide');
  }
  echo json_encode($ar);
}
