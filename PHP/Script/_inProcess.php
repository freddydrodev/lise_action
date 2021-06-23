<?php
if(isset($_POST['ID']) && !empty($_POST['ID'])
&& isset($_POST['type']) && !empty($_POST['type'])){
  require '../Inc/_db.php';

  $type = htmlspecialchars(trim($_POST['type']));
  $id = htmlspecialchars(trim($_POST['ID']));

  if($type == 'add'){
    $add = $db->prepare('INSERT INTO in_process(productID) VALUES(?)');
    if($add->execute(array($id))){
      echo json_encode(array('txt' => 'Success: Produit ajoute a la liste', 'type' => 'success'));
    }
    else {
      echo json_encode(array('txt' => 'Erreur: Erreur Lors de lajoue du produit', 'type' => 'danger'));
    }
  }
  elseif ($type == 'delete') {
    $add = $db->prepare('DELETE FROM in_process WHERE productID = ?');
    if($add->execute(array($id))){
      echo json_encode(array('txt' => 'Success: Produit supprimer de la liste', 'type' => 'success'));
    }
    else {
      echo json_encode(array('txt' => 'Erreur: Erreur Lors de la suppression du produit', 'type' => 'danger'));
    }
  }
  elseif ($type == 'get') {
    $get = $db->prepare('SELECT * FROM in_process WHERE productID = ?');
    $get->execute(array($id));
    $_get = $get->fetch();
    if(empty($_get)){
      echo json_encode(array('exist' => false));
    }
    else {
      echo json_encode(array('exist' => true));
    }


    // echo json_encode(array('found' => $_POST['ID']));
  }
}
else {
  echo json_encode(array('txt' => 'Erreur: Information manquante', 'type' => 'danger'));
}
