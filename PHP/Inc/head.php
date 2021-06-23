<?php
$_ind = isset($ind) ? $ind ? '../' : './' : './';

include $_ind . 'PHP/Inc/db.php';
// include $_ind . 'PHP/Inc/func.php';

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $page ?></title>
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/loaders.min.css">
    <!-- script for preload screen here -->
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/animate.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/Icon/flaticon.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/Fonts/Logo/logo.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/slick.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/alertify.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/print.min.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/slick-theme.min.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/list.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/Style.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/Style.products.css">
    <link rel="stylesheet" href="<?php echo $_ind; ?>Css/Style.sales.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,400,900" rel="stylesheet">

    <script src="<?php echo $_ind; ?>Js/jQuery.min.js"></script>
    <script src="<?php echo $_ind; ?>Js/moment.js"></script>
    <script src="<?php echo $_ind; ?>Js/fr.js"></script>
    <script type="text/javascript">
      moment.locale('fr');
    </script>
    <script type="text/javascript" src="<?php echo $_ind; ?>Js/bootstrap-notify.min.js"></script> 
  </head>
  <body>
    <div class="page-wrapper">
      <?php
      if(!isset($log)){
        include $_ind . 'PHP/Inc/header.php';
      }
      ?>
      <div class="container-fluid" id="page-content">
