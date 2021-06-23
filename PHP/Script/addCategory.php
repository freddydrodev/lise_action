<?php
if(isset($_POST['addCategory'])){
  include $_ind . 'PHP/Inc/func.php';

  $cat = htmlspecialchars(trim($_POST['category']));
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
    $add = $db->prepare('INSERT INTO categories (name, createdAt) VALUES(?, NOW())');
    if($add->execute(array($cat))){
      bootstrapNotify('Success! Categorie ajoute', 'success');
    }
    else {
      bootstrapNotify();
    }
  }
}
