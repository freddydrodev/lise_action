<?php
require '../Inc/_db.php';
if(isset($_POST['q'])){
  $ar = array();
  $s = '%' . htmlspecialchars(trim($_POST['q'])) . '%';

  if(strlen($s) > 2){
    $check = $db->prepare('SELECT * FROM users WHERE fullname LIKE :s AND usertype = 4');
    $check->bindValue(':s', $s, PDO::PARAM_STR);
    $check->execute();



    while ($get = $check->fetch()) {
      // push data into the new array
      array_push($ar, array(
        'id' => $get['id'],
        'fullname' => $get['fullname'],
        'phone' => $get['phone'],
        'facebookID' => $get['facebookID'],
        'email' => $get['email'],
        'location' => $get['location']
      ));
    }

    echo json_encode($ar);
  }
}
