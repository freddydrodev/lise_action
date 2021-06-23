<?php
require '../Inc/_db.php';

if(isset($_POST['s'])){
  $ar = array();
  $s = '%' . htmlspecialchars(trim($_POST['s'])) . '%';
  if(strlen($s) > 2){
    $check = $db->prepare('SELECT
  	products.name AS prodName,
    products.ID,
    products.price,
  	categories.name AS catName
    FROM products
    INNER JOIN categories ON categories.ID = products.category
    WHERE products.name LIKE :s OR categories.name LIKE :s OR products.ID LIKE :s');
    $check->bindValue(':s', $s, PDO::PARAM_STR);
    $check->execute();

    while ($get = $check->fetch()) {

      //get the quantity
      $qty = $db->prepare('SELECT (
        (SELECT SUM(quantity.quantity) FROM quantity WHERE quantity.productID = :id)
        -
        coalesce((SELECT SUM(product_ordered.quantity) FROM product_ordered WHERE product_ordered.productID = :id), 0)
      ) AS available');
      $qty->bindValue(':id', $get['ID'], PDO::PARAM_STR);
      $qty->execute();
      $_qty = $qty->fetch();

      array_push($ar, array(
        'available' => $_qty['available'],
        'prodName' => $get['prodName'],
        'catName' => $get['catName'],
        'ID' => $get['ID'],
        'price' => $get['price']
      ));
    }

    echo json_encode($ar);
  }
}
