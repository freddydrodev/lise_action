<?php
if(isset($_POST['addEmployee'])){
  include $_ind . 'PHP/Inc/func.php';

  $name = strtolower(htmlspecialchars(trim($_POST['name'])));
  $pseudo = htmlspecialchars(trim($_POST['pseudo']));
  $phone = htmlspecialchars(trim($_POST['phone']));
  $sex = htmlspecialchars(trim($_POST['sex']));
  $type = htmlspecialchars(trim($_POST['type']));
  $pass = generateRandomString(10);
  $correct = true;

  if(!preg_match('/^[a-zA-Zàâçéèêëîïôûùüÿñæœ \-]{5,100}$/i', $name)) {
      $correct = false;
      bootstrapNotify('Erreur Nom: Seul les lettres, tirets et les espaces sont autorises (entre 5 et 100 charcateres)');
  }

  if(!preg_match('/^[a-zA-Z0-9àâçéèêëîïôûùüÿñæœ]{5,32}$/i', $pseudo)) {
      $correct = false;
      bootstrapNotify('Erreur Pseudo: Seul les lettres et les nombres sont autorises (entre 5 et 32 characteres)');
  }
  if(!preg_match('/^(\+[1-9]{1}[0-9]{0,2})?[0-9]{6,10}$/', $phone)) {
      $correct = false;
      bootstrapNotify('Erreur Numero: Format doit etre +22501234567 ou 01234567');
  }

  if($correct){
    $add = $db->prepare('INSERT INTO users (fullname, username, password, init, phone, sex, usertype, createdAt) VALUES(?,?,?,?,?,?,?,NOW())');
    if($add->execute(array(ucwords($name), $pseudo, sha1($pass), $pass, $phone, $sex, $type))){
        bootstrapNotify('Employee Ajoute', 'success');
    }
    else {
      bootstrapNotify('Erreur Inconu');
    }
  }
}
