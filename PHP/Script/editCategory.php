<?php
if(isset($_POST['editCategory'])){
  include $_ind . 'PHP/Inc/func.php';

  $cat = htmlspecialchars(trim($_POST['name']));
  $id = htmlspecialchars(trim($_POST['id']));
  $correct = true;

  if(!preg_match('/^[a-z0-9àâçéèêëîïôûùüÿñæœ \-]*$/i', $cat)) {
      $correct = false;
      bootstrapNotify('Erreur: Seul les lettres, tirets et les espaces sont autorise');
  }

  $checker = $db->prepare('SELECT * FROM categories WHERE name = ?');
  $checker->execute(array($cat));
  if($check = $checker->fetch()){
    $correct = false;
    bootstrapNotify('Erreur: Cette categorie existe deja');
  }

  if($correct){
    $add = $db->prepare('UPDATE categories SET name = ? WHERE id = ? AND id != 1');
    if($add->execute(array($cat, $id))){
      bootstrapNotify('Success! Categorie Modifie', 'success');
    }
    else {
      bootstrapNotify();
    }
  }
}
