<?php
if(isset($_POST['editEmployee'])){
  include $_ind . 'PHP/Inc/func.php';

  $id = trim(htmlspecialchars($_POST['id']));
  $fn = strtolower(trim(htmlspecialchars($_POST['fn'])));
  $un = trim(htmlspecialchars($_POST['un']));
  $ph = trim(htmlspecialchars($_POST['ph']));
  $ut = trim(htmlspecialchars($_POST['ut']));
  $sx = trim(htmlspecialchars($_POST['sx']));
  $correct = true;

  if(!empty($id)){
    if(!preg_match('/^[a-zàâçéèêëîïôûùüÿñæœ \-]{5,100}$/i', $fn)) {
        $correct = false;
        bootstrapNotify('Erreur Nom: Seul les lettres, tirets et les espaces sont autorises (entre 5 et 100 charcateres)');
    }

    if(!preg_match('/^[a-z0-9àâçéèêëîïôûùüÿñæœ]{6,32}$/i', $un)) {
        $correct = false;
        bootstrapNotify('Erreur Pseudo: Seul les lettres et les nombres sont autorises (entre 6 et 32 characteres)');
    }

    if(!preg_match('/^(\+[1-9]{1}[0-9]{0,2})?[0-9]{6,10}$/', $ph)) {
        $correct = false;
        bootstrapNotify('Erreur Numero: Format doit etre +22501234567 ou 01234567');
    }

    if($sx !== 'H' && $sx !== 'F'){
      $correct = false;
      bootstrapNotify('Erreur Sexe: Inconnue sexe selectionne');
    }

    if($ut != 2 && $ut != 3){
      $correct = false;
      bootstrapNotify('Erreur Type d\'employee: Inconnue sexe selectionne');
    }

    if($correct) {
      $add = $db->prepare('UPDATE users SET fullname = ?, username = ?, phone = ?, sex = ?, usertype = ? WHERE id = ?');
      if($add->execute(array(ucwords($fn), $un, $ph, $sx, $ut, $id))) {
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
