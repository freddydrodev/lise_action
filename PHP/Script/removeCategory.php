<?php
include '../Inc/db.php';
if(isset($_GET['catID'])){

  $id = htmlspecialchars(trim($_GET['catID']));

  if(!preg_match('/^[0-9]$/', $id)) {
      Die('Erreur: Mauvais ID entre');
  }
  if($id == 1) {
      Die('Erreur: Impossible de supprimer la categorie par defaut');
  }

  // $checker = $db->prepare('DELETE FROM categories WHERE id = ?');
  // if($checker->execute(array($id))){
    header('location: ../../Products/');
  // }
}
