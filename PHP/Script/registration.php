<?php
include $_ind . 'PHP/Inc/func.php';

// bootstrapNotify('fredius', 'success');
$sent = false;
if(isset($_POST['register'])){
  $fn = $_POST['fullname'];
  $un = $_POST['username'];
  $ps = $_POST['password'];
  $cn = $_POST['r-password'];
  $correct = true;

  if(!preg_match('/^[a-zA-Z ]{5,100}$/', $fn)) {
      $correct = false;
      bootstrapNotify('Nom: mauvais format! Doit etre entre 5 et 100 characteres alphabetique');
  }
  if(!preg_match('/^[a-zA-Z0-9]{5,32}$/', $un)) {
      $correct = false;
      bootstrapNotify('Pseudo: mauvais format! Doit etre entre 5 et 32 characteres alphanumerique sans espace');
  }

  if (strlen($ps) < 6) {
      $correct = false;
      bootstrapNotify('Mot De Pass: Doit contenir au moins 6 characteres');
  }

  if($ps !== $cn){
      $correct = false;
      bootstrapNotify('Confirm: Les Mots de pass ne concorde pas');
  }

  if($correct){
    $add = $db->prepare('INSERT INTO users(id, fullname, username, password, usertype, createdAt) VALUES(1,?,?,?, 1,NOW())');
    if($add->execute(array(ucwords($fn), $un, sha1($ps)))){
        $_SESSION['id'] = $db->lastInsertId();
        $add->closeCursor();
        header('location: ../Products/');
    }
    else {
      bootstrapNotify();
      $add->closeCursor();
    }
  }
  else {
    $sent = true;
  }
}
