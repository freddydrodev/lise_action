<?php
require '../Inc/_db.php';

if(isset($_POST['delProd'])){
  include '../Inc/func.php';

  $pid = trim(htmlspecialchars($_POST['delProd']));

  $del = $db->prepare('DELETE FROM products WHERE ID = ?');
  if ($del->execute(array($pid))) {
    $ar = array('type' => 'success', 'text' => 'Success! Produit supprime');
  }
  else {
    $ar = array('type' => 'danger', 'text' => 'Erreur! Produit non-supprime');
  }
  echo json_encode($ar);
}
