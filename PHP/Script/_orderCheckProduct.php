<?php
require '../Inc/_db.php';

if(isset($_POST['s'])){
  $s = '%' . htmlspecialchars(trim($_POST['s'])) . '%';
  if(strlen($s) > 2){
    $check = $db->prepare('SELECT * FROM products WHERE name LIKE :s OR ID LIKE :s');
    $check->bindValue(':s', $s, PDO::PARAM_STR);
    $check->execute();

    $get = $check->fetch();

    echo json_encode($get);
  }
}
