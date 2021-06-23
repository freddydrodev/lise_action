<?php
require '../Inc/_db.php';
if(isset($_POST['id'])){
  $ar = array();
  $s = htmlspecialchars(trim($_POST['id']));

  $check = $db->prepare('SELECT quantity.*, color.color
    FROM quantity
    INNER JOIN color ON color.ID = quantity.colorID
    WHERE productID = ?');
  $check->execute(array($s));

  while ($get = $check->fetch()) {
    // push data into the new array
    array_push($ar, array(
      'productID' => $get['productID'],
      'colorID' => $get['colorID'],
      'quantity' => $get['quantity'],
      'color' => $get['color']
    ));
  }

  echo json_encode($ar);
}
