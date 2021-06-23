<?php
require '../Inc/_db.php';
$del = $db->prepare('DELETE FROM in_process');
$del->execute();
