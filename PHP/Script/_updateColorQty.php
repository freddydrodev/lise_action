<?php
require '../Inc/_db.php';
if(isset($_POST['qty']) && isset($_POST['pid']) && isset($_POST['cid'])){
  $ar = array();
  $pid = htmlspecialchars(trim($_POST['pid']));
  $cid = htmlspecialchars(trim($_POST['cid']));
  $qty = htmlspecialchars(trim($_POST['qty']));

  $check = $db->prepare('UPDATE quantity SET quantity = ? WHERE productID = ? AND colorID = ?');
  if($check->execute(array($qty, $pid, $cid))){
    $ar = array('msg' => 'success');
  }
  else {
    $ar = array('msg' => 'error');
  }

  echo json_encode($ar);
}
