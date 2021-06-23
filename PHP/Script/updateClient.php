<?php
if(isset($_POST['clientUpdate'])){
  include $_ind . 'PHP/Inc/func.php';

  $id = trim(htmlspecialchars($_POST['id']));
  $fn = strtolower(trim(htmlspecialchars($_POST['fn'])));
  $fb = trim(htmlspecialchars($_POST['fb']));
  $em = '';
  $ph = trim(htmlspecialchars($_POST['ph']));
  $ln = trim(htmlspecialchars($_POST['ln']));
  $sx = trim(htmlspecialchars($_POST['sx']));
  $correct = true;

  if(!empty($id)){
    if(!preg_match('/^[a-zàâçéèêëîïôûùüÿñæœ \-]{5,100}$/i', $fn)) {
        $correct = false;
        bootstrapNotify('Erreur Nom: Seul les lettres, tirets et les espaces sont autorises (entre 5 et 100 charcateres)');
    }

    if(!preg_match("/^[a-zàâçéèêëîïôûùüÿñæœ \-\']{5,100}$/i", $fb)) {
        $correct = false;
        bootstrapNotify('Erreur Facebook: Seul les lettres, tirets, apostrof et les espaces sont autorises (entre 5 et 100 charcateres)');
    }

    if(!preg_match("/^[a-z0-9àâçéèêëîïôûùüÿñæœ\, \-\']{5,100}$/i", $ln)) {
        $correct = false;
        bootstrapNotify('Erreur Location: Seul les lettres, nombres, tirets, apostrof et les espaces sont autorises (entre 5 et 100 charcateres)');
    }

    if(isset($_POST['em']) && !empty($_POST['em'])){
      $em = trim(htmlspecialchars($_POST['em']));
      if(!preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i", $em)) {
          $correct = false;
          bootstrapNotify('Erreur Email: Format est example@example.com');
      }
    }

    if(!preg_match('/^(\+[1-9]{1}[0-9]{0,2})?[0-9]{6,10}$/', $ph)) {
        $correct = false;
        bootstrapNotify('Erreur Numero: Format doit etre +22501234567 ou 01234567');
    }

    if($sx !== 'H' && $sx !== 'F'){
      $correct = false;
      bootstrapNotify('Erreur Sexe: Inconnue sexe selectionne');
    }

    if($correct) {
      $add = $db->prepare('UPDATE users SET fullname = ?, facebookID = ?, email = ?, phone = ?, location = ?, sex = ? WHERE id = ?');
      if($add->execute(array(ucwords($fn), $fb, $em, $ph, $ln, $sx, $id))) {
        bootstrapNotify('Information modifie', 'success');
      }
      else {
        bootstrapNotify('Erreur: Information modif');
      }
    }
  }
  else {
    bootstrapNotify('Erreur: Pas d\'identifiant');
  }

}
