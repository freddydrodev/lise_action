<?php
include $_ind . 'PHP/Inc/func.php';

if (isset($_POST['login'])) {
    $un = htmlspecialchars(trim($_POST['username']));
    $ps = htmlspecialchars(trim($_POST['password']));

    $check = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $check->execute(array($un, sha1($ps)));
    if($user = $check->fetch()){
        $_SESSION['id'] = $user['id'];
        header('location: Products/');
    }
    else {
      bootstrapNotify('Erreur: Aucun compte ne correspond aux donnees entrees');
    }
}
