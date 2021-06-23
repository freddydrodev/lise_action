<?php
if(isset($_POST['makeOrder'])){
  include $_ind . 'PHP/Inc/func.php';
  
  $existingUser = isset($_POST['existingUser']) && !empty($_POST['existingUser']) ? strtolower(trim(htmlspecialchars($_POST['existingUser']))) : false;
  $client = strtolower(trim(htmlspecialchars($_POST['name-client'])));
  $facebook = trim(htmlspecialchars($_POST['id-facebook']));
  $email = '';
  $phone = trim(htmlspecialchars($_POST['phone']));
  $location = trim(htmlspecialchars($_POST['location']));
  $livreur = trim(htmlspecialchars($_POST['livreur']));
  $correct = true;
  $quantity = 0;

  //get products
  if(count($_POST['prod-id']) >= 1){
    foreach ($_POST['prod-id'] as $key => $prod) {
      print_r($_POST['color'][$prod]) ;
      foreach ($_POST['color'][$prod] as $colID => $col) {
        if($colID != 0){
          if($col['quantity'] > 0){
            $quantity += (int)$col['quantity'];
          }
        }
      }
    }
    if($quantity > 0){
      if(!preg_match('/^[a-zàâçéèêëîïôûùüÿñæœ \-]{5,100}$/i', $client)) {
          $correct = false;
          bootstrapNotify('Erreur Nom: Seul les lettres, tirets et les espaces sont autorises (entre 5 et 100 charcateres)');
      }

      if(!preg_match("/^[a-zàâçéèêëîïôûùüÿñæœ \-\']{5,100}$/i", $facebook)) {
          $correct = false;
          bootstrapNotify('Erreur Facebook: Seul les lettres, tirets, apostrof et les espaces sont autorises (entre 5 et 100 charcateres)');
      }

      if(!preg_match("/^[a-z0-9àâçéèêëîïôûùüÿñæœ\, \-\']{5,100}$/i", $location)) {
          $correct = false;
          bootstrapNotify('Erreur Location: Seul les lettres, nombres, tirets, apostrof et les espaces sont autorises (entre 5 et 100 charcateres)');
      }

      if(isset($_POST['email']) && !empty($_POST['email'])){
        $email = trim(htmlspecialchars($_POST['email']));
        if(!preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i", $email)) {
            $correct = false;
            bootstrapNotify('Erreur Email: Format est example@example.com');
        }
      }

      if(!preg_match('/^(\+[1-9]{1}[0-9]{0,2})?[0-9]{6,10}$/', $phone)) {
          $correct = false;
          bootstrapNotify('Erreur Numero: Format doit etre +22501234567 ou 01234567');
      }

      if($correct){
        //check if the user already exist or it has been added as new
        echo ($_POST['suggested']);
        if(isset($_POST['suggested']) && !empty($_POST['suggested'])){
          $sug = trim(htmlspecialchars($_POST['suggested']));
          if($sug === "null"){
            $add = $db->prepare('UPDATE users SET fullname = ?, facebookID = ?, email = ?, phone = ?, location = ? WHERE id = ?');
            $el = array(ucwords($client), $facebook, $email, $phone, $location, $sug);
          }
          else {
            $add = $db->prepare('INSERT INTO users(fullname, facebookID, email, phone, location, usertype, createdAt) VALUES(?,?,?,?,?,4,NOW())');
            $el = array(ucwords($client), $facebook, $email, $phone, $location);
          }

          if($add->execute($el)){
            $ID = (int)$sug > 0 ? $sug : $db->lastInsertId();

            //create order
            $OID = generateRandomString(6);
            $mkOrder = $db->prepare('INSERT INTO orders(ID, createdAt, customerID, employeeID, livreurID, state) VALUES(?,NOW(),?,?,?, "0")');
            if($mkOrder->execute(array($OID, $ID, $_SESSION['id'], $livreur))){
              //insert product in order list
              $ok = true;

              foreach ($_POST['prod-id'] as $key => $prod) {
                print_r($_POST['color'][$prod]) ;
                foreach ($_POST['color'][$prod] as $colID => $col) {
                  if($colID != 0){
                    if($col['quantity'] > 0){
                      $ol = $db->prepare('INSERT INTO product_ordered(productID, orderID, colorID, quantity, paid) VALUES (?,?,?,?,?)');
                      if($ol->execute(array($prod, $OID, $colID, $col['quantity'], $col['price']))){
                      }
                      else {
                        $ok = false;
                      }
                    }
                  }
                }
              }
              if($ok){
                bootstrapNotify('Commande Insere', 'success');
              }
              else {
                bootstrapNotify('Erreur Inconnue: Insertion article');
              }

            } else {
              bootstrapNotify('Erreur Inconnue: creation Commande');
            }
          } else {
            bootstrapNotify('Erreur Inconnue: Ajoue Client');
          }
        } else {
          bootstrapNotify('Erreur Suggestion Manquant');
        }
      }
    }
    else {
      $correct = false;
      bootstrapNotify('Erreur Produit: Aucun Produit selectionne');
    }
  }
  else {
    $correct = false;
    bootstrapNotify('Erreur Produit: Aucun Produit selectionne');
  }

  $del = $db->prepare('DELETE FROM in_process');
  $del->execute();

}
