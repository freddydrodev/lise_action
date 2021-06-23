<?php
require '../Inc/_db.php';

if(isset($_POST['s'])){

  $s = htmlspecialchars(trim($_POST['s']));
  if(strlen($s) > 2){
    $check = $db->prepare('SELECT * FROM products WHERE ID = :s');
    $check->bindValue(':s', $s, PDO::PARAM_STR);
    $check->execute();

    $prod = $check->fetch();

    $checkCat = $db->prepare('SELECT name FROM categories WHERE ID = ?');
    $checkCat->execute(array($prod['category']));

    $cat = $checkCat->fetch();

    $checkQty = $db->prepare('SELECT ((SELECT SUM(quantity) FROM quantity WHERE productID = :s) - coalesce((SELECT SUM(quantity) FROM product_ordered WHERE productID = :s), 0)) AS qty');
    $checkQty->bindValue(':s', $s, PDO::PARAM_STR);
    $checkQty->execute();

    $qty = $checkQty->fetch();

    $colors = array();

    $checkColor = $db->prepare('SELECT quantity.colorID, quantity.quantity, color.color FROM quantity INNER JOIN color ON color.ID = quantity.colorID WHERE quantity.productID = ?');
    $checkColor->execute(array($s));

    $c = 0;
    while ($color = $checkColor->fetch()) {
      $destroy = $db->prepare('SELECT COUNT(*) AS nbr FROM in_process WHERE productID = ? AND colorID = ?');
      $destroy->execute(array($prod['ID'], $color['colorID']));
      $canDestroy = $destroy->fetch();
      
      if($canDestroy['nbr'] <= 0){
        $newAr = array(
          'colorID' => $color['colorID'],
          'colorName' => $color['color'],
          'colorQty' => $color['quantity']
        );
        array_push($colors, $newAr);
      }
    }

    $ar = array(
      'prodID' => $prod['ID'],
      'prodName' => $prod['name'],
      'prodPrice' => $prod['price'],
      'catName' => $cat['name'],
      'available' => $qty['qty'],
      'colors' => $colors
    );
    echo json_encode($ar);
  }
}
