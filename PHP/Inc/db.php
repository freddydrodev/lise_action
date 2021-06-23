<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=bellisestyle', 'root', '');
} catch (Exception $e) {
    Die('Erreur : ' . $e->getMessage());
}

session_start();
// check if the session is open and restrict pages based on it
if (!isset($log) && !isset($_SESSION['id'])) {
  header('location: ../');
}
if (isset($log) && isset($_SESSION['id'])) {
  header('location:' . $_ind . 'Products/');
}

//check if the created session exist it define if first admin has been added
if(isset($_SESSION['created'])){
  $_SESSION['created'] = $_SESSION['created'] ? true : false;// define if the system has some user
}
else {
  $_SESSION['created'] = false;
}

if(isset($page)){
  if($_SESSION['created'] && $page == 'Inscription'){
    header('location: ../');
  }

  if($page === 'Connexion'){
    if(!$_SESSION['created']){
      $users = $db->prepare('SELECT COUNT(id) AS nbr FROM users');
      $users->execute();
      $user = $users->fetch();
      if($user['nbr'] == 0){
        header('location: Registration/');
      }
      else {
        $_SESSION['created'] = true;
      }
    }
  }
}
