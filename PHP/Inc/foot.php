  </div>

  <p class="fixed-bottom m-0 d-none">
    <button type="button" name="addStuff" class="btn btn-primary rounded-circle p-0">
      <span class="flaticon-cross-1"></span>
    </button>
  </p>
  </div>

<div class="fixed-top w-100 h-100 bg-default-9 d-none" id="searchBox">
  <p class="h4 py-4 text-center m-0">Recherche</p>
  <div class="container-fluid">
    <p>
      <input type="text" name="search" class="form-control p-0 font-weight-light w-75 mx-auto bigsearch bg-none rounded-0 border-0 text-center">
    </p>
    <p class="text-center text-muted">Aucun resultat pour </b>Fredius Tout Court </b></p>

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">1</div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">2</div>
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">3</div>
    </div>
    <ul class="nav nav-pills nav-justified fixed-bottom" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link rounded-0 active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link rounded-0" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link rounded-0" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
      </li>
    </ul>
  </div>
</div>
    <script src="<?php echo $_ind; ?>Js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $_ind; ?>Js/popper.js"></script>
    <script src="<?php echo $_ind; ?>Js/bootstrap.min.js"></script>
    <script src="<?php echo $_ind; ?>Js/list.min.js"></script>
    <script src="<?php echo $_ind; ?>Js/slick.min.js"></script>
    <script src="<?php echo $_ind; ?>Js/alertify.js"></script>
    <script src="<?php echo $_ind; ?>Js/bootstrap-notify.min.js"></script>
    <script src="<?php echo $_ind; ?>Js/perfect-scrollbar.min.js"></script>
    <script src="<?php echo $_ind; ?>Js/Chart.min.js"></script>
    <script src="<?php echo $_ind; ?>Js/JsBarcode.all.min.js"></script>
    <script src="<?php echo $_ind; ?>Js/print.min.js"></script>
    <script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
    </script>

    <script src="<?php echo $_ind; ?>Js/main.js"></script>
    <script src="<?php echo $_ind; ?>Js/Templatize.js"></script>
    
    <?php if ($page === 'Clients'): ?>
    <script src="<?php echo $_ind; ?>Js/clients.js"></script>
    <?php endif; ?>

    <?php if ($page === 'Employees'): ?>
    <script src="<?php echo $_ind; ?>Js/employees.js"></script>
    <?php endif; ?>

    <?php if ($page === 'Livreur'): ?>
    <script src="<?php echo $_ind; ?>Js/delivrer.js"></script>
    <?php endif; ?>

    <?php if ($page === 'Commandes'): ?>
    <script src="<?php echo $_ind; ?>Js/orders.js"></script>
    <?php endif; ?>

    <?php if ($page === 'Produits'): ?>
    <script src="<?php echo $_ind; ?>Js/products.js"></script>
    <?php endif; ?>

    <?php if ($page === 'Ventes'): ?>
    <script src="<?php echo $_ind; ?>Js/sales.js"></script>
    <?php endif; ?>



  </body>
</html>
