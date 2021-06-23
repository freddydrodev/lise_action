<?php
$log = true;
$page = 'Inscription';
$ind = true;
include '../PHP/Inc/head.php'; ?>
  <div class="fixed-top w-100 h-100">
    <div class="d-flex w-100 h-100 justify-content-center align-items-center">
      <div class="d-flex justify-content-center flex-column mr-5">
        <p class="logo-img-wrapper connexion d-flex align-items-center justify-content-center rounded-circle mx-auto">
          <img src="../Media/Images/logo.jpeg" alt="logo-img" class="d-inline-block" id="logo-connexion">
        </p>
        <h1 class="intro text-center font-weight-light">Welcome to BelliseStyle</h1>
        <h2 class="text-muted text-center font-weight-light">Admin session</h2>
      </div>
      <form class="log-form pb-3  bg-white" action="./" method="post">
        <h3 class="mb-3 p-3">Inscription</h3>
        <div class="msg">
          <?php include $_ind . 'PHP/Script/registration.php'; ?>
        </div>
        <fieldset class="form-group px-3">
          <label for="fullname">Votre Nom Complet</label>
          <input type="text" id="fullname" name="fullname" required class="rounded-0 form-control">
        </fieldset>
        <fieldset class="form-group px-3">
          <label for="username">Votre Pseudo</label>
          <input type="username" id="username" name="username" required class="rounded-0 form-control">
        </fieldset>
        <fieldset class="form-group px-3">
          <label for="password">Votre Mot De Pass</label>
          <input type="password" id="password" name="password" required class="rounded-0 form-control">
        </fieldset>
        <fieldset class="form-group px-3">
          <label for="r-password">Confirmez Votre Mot De Pass</label>
          <input type="password" id="r-password" name="r-password" required class="rounded-0 form-control">
        </fieldset>
        <fieldset class="form-group px-3">
          <button type="submit" name="register" class="btn btn-primary btn-block border-none rounded-0">Inscription</button>
        </fieldset>
      </form>
    </div>
  </div>
<?php include '../PHP/Inc/foot.php'; ?>
