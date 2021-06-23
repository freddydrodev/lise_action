<ul class="navbar-nav w-100 justify-content-end align-items-center">
  <?php if ($_SESSION['id'] == 1): ?>
  <li class="nav-item mr-4" data-toggle="tooltip" data-placement="bottom" title="Employees">
    <a href="<?php echo $_ind ?>Employees/" class="nav-link <?php echo $page == 'Employees' ? 'active' : '' ?>">
      <span class="flaticon-support"></span>
      <?php echo $page == 'Employees' ? '<span class="sr-only">(current)</span>' : '' ?>
    </a>
  </li>
  <?php endif; ?>
  <li class="nav-item mr-4" data-toggle="tooltip" data-placement="bottom" title="Clients">
    <a href="<?php echo $_ind ?>Customers/" class="nav-link <?php echo $page == 'Clients' ? 'active' : '' ?>">
      <span class="flaticon-transport"></span>
      <?php echo $page == 'Clients' ? '<span class="sr-only">(current)</span>' : '' ?>
    </a>
  </li>

  <li class="nav-item mr-4" data-toggle="tooltip" data-placement="bottom" title="Produits">
    <a href="<?php echo $_ind ?>Products/" class="nav-link <?php echo $page == 'Produits' ? 'active' : '' ?>">
      <span class="flaticon-box-3"></span>
      <?php echo $page == 'Produits' ? '<span class="sr-only">(current)</span>' : '' ?>
    </a>
  </li>
  <li class="nav-item mr-4" data-toggle="tooltip" data-placement="bottom" title="Commandes">
    <a href="<?php echo $_ind ?>Orders/" class="nav-link <?php echo $page == 'Commandes' ? 'active' : '' ?>">
      <span class="flaticon-receipt"></span>
      <?php echo $page == 'Commandes' ? '<span class="sr-only">(current)</span>' : '' ?>
    </a>
  </li>
  <li class="nav-item mr-4" data-toggle="tooltip" data-placement="bottom" title="Ventes">
    <a href="<?php echo $_ind ?>Sales/" class="nav-link <?php echo $page == 'Ventes' ? 'active' : '' ?>">
      <span class="flaticon-banknote"></span>
      <?php echo $page == 'Ventes' ? '<span class="sr-only">(current)</span>' : '' ?>
    </a>
  </li>
  <!-- <li class="nav-item mr-4" data-toggle="tooltip" data-placement="bottom" title="Compte">
    <a href="<?php echo $_ind ?>Account" class="nav-link <?php echo $page == 'Compte' ? 'active' : '' ?>">
      <span class="flaticon-options"></span>
      <?php echo $page == 'Compte' ? '<span class="sr-only">(current)</span>' : '' ?>
    </a>
  </li> -->
  <!-- <li class="nav-item mr-4" data-toggle="tooltip" data-placement="bottom" title="Recherche">
    <a href="#" class="nav-link toogle-search"><span class="flaticon-magnifying-glass-1"></span></a>
  </li> -->
  <li class="nav-item">
    <a href="<?php echo $_ind ?>Logout//" class="nav-link" data-toggle="tooltip" data-placement="left" title="Deconnexion">
      <span class="flaticon-logout-1"></span>
    </a>
  </li>
</ul>
