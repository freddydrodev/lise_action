<?php
require '../Inc/_db.php';

if(isset($_POST['delCat'])){
  include '../Inc/func.php';

  $pid = trim(htmlspecialchars($_POST['delCat']));
  
  $up = $db->prepare('UPDATE products SET category = 1 WHERE category = ?');
  if($up->execute(array($pid))){

    $del = $db->prepare('DELETE FROM categories WHERE ID = ? AND ID != 1');
    if ($del->execute(array($pid))) {

      $ar = array('type' => 'success', 'text' => 'Success! Categorie supprime');
    } else {

      $ar = array('type' => 'danger', 'text' => 'Erreur! Categorie non-supprime');
    }

    echo json_encode($ar);
  }
}
