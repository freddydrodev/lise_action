<?php
$page = 'Produits';
$ind = true;
include '../PHP/Inc/head.php';
include $_ind . 'PHP/Script/addCategory.php';
include $_ind . 'PHP/Script/editCategory.php';
include $_ind . 'PHP/Script/addProduct.php';

// show categories list
$showCategories = $db->query('SELECT * FROM Categories ORDER BY createdAt');

?>

<!-- <nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active" aria-current="page">Produits</li>
  </ol>
</nav>
<div class="row resume">
  <div class="col-md-6 col-lg-3 mb-4">
    <div class="p-3 d-flex bg-white text-truncate light-shadow">
      <h3 class="mr-3 text-primary">100</h3>
      <div class="w-100">
        <h5>Produits</h5>
        <p class="text-muted">Libre</p>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 mb-4">
    <div class="p-3 d-flex bg-white text-truncate light-shadow">
      <h3 class="mr-3 text-warning">50</h3>
      <div class="w-100">
        <h5>Categories</h5>
        <p class="text-muted">Total</p>
        <div class="progress">
          <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 mb-4">
    <div class="p-3 d-flex bg-white text-truncate light-shadow">
      <h3 class="mr-3 text-danger">50</h3>
      <div class="w-100">
        <h5>Commandes</h5>
        <p class="text-muted">Total</p>
        <div class="progress">
          <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 mb-4">
    <div class="p-3 d-flex bg-white text-truncate light-shadow">
      <h3 class="mr-3 text-success">500k</h3>
      <div class="w-100">
        <h5>Ventes</h5>
        <p class="text-muted">Total</p>
        <div class="progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<!-- Categories title -->
<div class="row title">
  <div class="col">
    <div class="d-flex justify-content-between p-3 align-items-center rounded-3">
      <h2 class="text-uppercase m-0">Categories</h2>
      <!-- insert category modal start -->
      <?php if ($_SESSION['id'] == 1): ?>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal"><span class="flaticon-mathematical-addition-sign small-icon"></span>Ajouter Categorie</button>

      <div class="modal fade" tabindex="-1" role="dialog" id="addCategoryModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content rounded-0 border-0">
            <div class="modal-header border-0 py-2">
              <h5 class="modal-title position-relative legend px-3"><span class="legend-text">Ajouter Categorie</span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" action="./" method="post">
                <fieldset class="form-group px-3 material-input mb-1">
                  <label class="small">Nom de la Categorie</label>
                  <input type="text" name="category" placeholder="EX: Etagere, Electronique, Ordinateur, Vetement, ..." class="form-control border-0 rounded-0 px-0" required>
                  <span class="under w-100 d-block position-relative"></span>
                </fieldset>
                <div class="modal-footer border-0">
                  <button type="submit" name="addCategory" class="btn btn-primary">Ajouter</button>
                  <button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>

      <!-- update category -->
      <div class="modal fade" tabindex="-1" role="dialog" id="editCategory">
        <div class="modal-dialog" role="document">
          <div class="modal-content rounded-0 border-0">
            <div class="modal-header border-0 py-2">
              <h5 class="modal-title position-relative legend px-3"><span class="legend-text">Ajouter Categorie</span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" action="./" method="post">
                <fieldset class="form-group px-3 material-input mb-1">
                  <label class="small">Nom de la Categorie</label>
                  <input type="hidden" name="id">
                  <input type="text" name="name" placeholder="EX: Etagere, Electronique, Ordinateur, Vetement, ..." class="form-control border-0 rounded-0 px-0" required>
                  <span class="under w-100 d-block position-relative"></span>
                </fieldset>
                <div class="modal-footer border-0">
                  <button type="submit" name="editCategory" class="btn btn-primary">Modifier</button>
                  <button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <?php endif; ?>
      <!-- end insert category modal -->
    </div>
  </div>
</div>
<!-- Categories list -->
<div class="row mb-0" id="categories-list">
  <!-- start category items -->
  <?php while ($showCategory = $showCategories->fetch()) { ?>
    <div class="col py-5">
      <div class="card border-0 light-shadow">
        <div class="card-body">
          <h4 class="card-title"><?php echo $showCategory['name'] ?></h4>
          <!-- items in category count -->
          <?php
          $countItemsInCategory = $db->prepare('SELECT COUNT(*) AS nbr FROM products WHERE category = ?');
          $countItemsInCategory->execute(array($showCategory['ID']));
          $_countItemsInCategory = $countItemsInCategory->fetch();
           ?>
          <h6 class="card-subtitle mb-2 text-muted"><?php echo $_countItemsInCategory['nbr'] > 1 ?  $_countItemsInCategory['nbr'] . ' Articles' : $_countItemsInCategory['nbr'] . ' Article' ?></h6>
          <div class="card-text mb-2 position-relative">
            <!-- begining items in category list -->
            <?php if ($_countItemsInCategory['nbr'] > 0): ?>

              <!-- display category element -->
              <?php
              $ItemsInCategory = $db->prepare('SELECT ID, name, price FROM products WHERE category = ? ORDER BY name');
              $ItemsInCategory->execute(array($showCategory['ID']));
              while ($_ItemsInCategory = $ItemsInCategory->fetch()) {
                $qtyPdctTop = $db->prepare('SELECT SUM(quantity) AS qty FROM quantity WHERE productID = ?');
                $qtyPdctTop->execute(array($_ItemsInCategory['ID']));
                $_qtyPdctTop = $qtyPdctTop->fetch();
                ?>

                <div class="media mb-1">
                  <img class="mr-3 img-prev-media" src="../Media/Images/Articles/Article_<?php echo $_ItemsInCategory['ID'] ?>.jpg" alt="Image de l'article">
                  <div class="media-body">
                    <h5 class="mt-0 mb-0"><?php echo $_ItemsInCategory['name'] ?></h5>
                    <p class="text-muted"><?php echo $_ItemsInCategory['price'] ?>Fr <span class="badge badge-primary badge-pill font-weight-normal float-right"><?php echo $_qtyPdctTop['qty'] ?> Disponible</span></p>
                  </div>
                </div>
              <?php } ?>

              <!-- end category item list -->
            <?php else: ?>
              <p>Aucun Produit.</p>
            <?php endif; ?>
            <!-- end items in category list -->
          </div>
          <?php if ($showCategory['ID'] != 1 && $_SESSION['id'] == 1): ?>
            <button
            class="btn btn-primary"
            type="button"
            data-toggle="modal"
            data-target="#editCategory"
            data-id="<?php echo $showCategory['ID'] ?>"
            data-name="<?php echo $showCategory['name'] ?>">
              <span class="flaticon-edit-1"></span>
            </button>
            <button name="delCat" value="<?php echo $showCategory['ID'] ?>" class="btn btn-danger ml-2">
              <span class="flaticon-delete"></span>
            </button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php } ?>
  <!-- end category items -->
</div>

<!-- Produits title -->
<div class="mt-5" id="productsList">
  <div class="row mb-4 title">
    <div class="col position-relative">
      <div class="d-flex justify-content-between p-3 align-items-center rounded-3">
        <h2 class="text-uppercase m-0">Produits <br/></h2>
        <!-- insert category modal start -->

        <div class="btn-group" role="group" aria-label="Basic example">
          <?php if ($_SESSION['id'] == 1): ?>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal"><span class="flaticon-mathematical-addition-sign small-icon"></span>Ajouter Produit</button>
          <?php endif; ?>
          <button type="button" data-toggle="collapse" data-target="#search" aria-expanded="false" aria-controls="collapseSearch" class="search-toogle btn btn-info">
            <span class="flaticon-magnifying-glass-1"></span>
          </button>
        </div>
        <!-- search -->
        <div class="collapse position-absolute h-100 light-shadow" id="search">
          <div class="input-group h-100">
            <input type="search" name="search" placeholder="Recherchez dans Produits..." class="search border-0 form-control px-4">
            <button type="reset" class="input-group-addon bg-white border-0 text-muted px-4" data-toggle="collapse" data-target="#search" aria-expanded="false" aria-controls="collapseSearch">
              <span class="flaticon-cancel"></span>
            </button>
          </div>
        </div>
        <!-- popup -->
        <?php if ($_SESSION['id'] == 1): ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="addProductModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0 border-0">
              <div class="modal-header border-0 py-2">
                <h5 class="modal-title position-relative legend px-3"><span class="legend-text">Ajouter Produit</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="" action="./" method="post" enctype="multipart/form-data">
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Image</label>
                    <div class="input-group">
                      <label class="input-group-addon bg-primary text-white" for="imgProd">
                        <span class="flaticon-box"></span>
                      </label>
                      <input type="file" name="pic" class="form-control" id="imgProd" accept="image/*" required>
                    </div>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Nom</label>
                    <input type="text" name="name" placeholder="EX:  T-shirt Nike, Chaussure AD, ..." class="form-control border-0 rounded-0 px-0" required>
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Prix</label>
                    <input type="number" name="price" min="0" placeholder="EX: 10000, 500000, ..." class="form-control border-0 rounded-0 px-0" required>
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>
                  <div class="row px-3">
                    <fieldset class="form-group px-3 material-input mb-1 col">
                      <label class="small">Couleur</label>
                      <input type="text" name="defaultColor" placeholder="EX: Rouge, Bleu, Vert, ..." class="form-control border-0 rounded-0 px-0">
                      <span class="under w-100 d-block position-relative"></span>
                    </fieldset>
                    <fieldset class="form-group px-3 material-input mb-1 col">
                      <label class="small">Quantite</label>
                      <input type="number" name="defaultQty" min="0" placeholder="EX: 100, 10, ..." class="form-control border-0 rounded-0 px-0" required>
                      <span class="under w-100 d-block position-relative"></span>
                    </fieldset>
                  </div>
                  <fieldset class="form-group px-3 pt-3 material-input mb-1 col">
                    <button type="button" class="btn btn-success btn-block addMoreQuantity" data-toggle="tooltip" data-placement="bottom" title="Ajouter Nouvelle Couleur et Quantite">
                      <span class="flaticon-cross small-icon"></span>
                    </button>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1 col">
                    <label class="small">Categorie</label>
                    <select class="form-control custom-select" name="category" required>
                      <?php
                      $selectCategories = $db->query('SELECT * FROM Categories ORDER BY name');
                      while($selectCategory = $selectCategories->fetch()){ ?>
                        <option value="<?php echo $selectCategory['ID'] ?>"<?php if ($selectCategory['name'] == 'Uncategorized'): ?> selected <?php endif; ?>><?php echo $selectCategory['name'] ?></option>
                      <?php } ?>
                    </select>
                  </fieldset>
                  <!-- list of alternatif product -->
                  <?php
                  $countProducts = $db->query('SELECT COUNT(*) AS nbr FROM products');
                  $countProduct = $countProducts->fetch();
                  if($countProduct['nbr'] > 0){
                   ?>
                  <fieldset class="form-group px-3 material-input mb-1 col">
                    <input type="checkbox" name="addProductAlt" id="addProductAlt" class="d-none">
                    <label for="addProductAlt" class="position-relative">Alternative</label>
                    <div class="alternative">
                      <div class="row">
                        <fieldset class="form-group px-3 material-input mb-1 col">
                          <label class="small">Product</label>
                          <select class="form-control custom-select alt-inp" name="alt-product">
                            <?php
                            $productAlt = $db->query('SELECT ID, name FROM products ORDER BY name');
                            while($_productAlt = $productAlt->fetch()){ ?>
                              <option value="<?php echo $_productAlt['ID'] ?>"><?php echo $_productAlt['name'] ?></option>
                            <?php } ?>
                          </select>
                        </fieldset>
                        <fieldset class="form-group px-3 material-input mb-1 col">
                          <label class="small">Quantite pour un</label>
                          <input type="text" name="alt-quantity" placeholder="EX: 100, 10, ..." class="form-control border-0 rounded-0 px-0 alt-inp">
                          <span class="under w-100 d-block position-relative"></span>
                        </fieldset>
                      </div>
                    </div>
                  </fieldset>
                <?php } ?>
                  <div class="modal-footer border-0">
                    <button type="submit" name="addProduct" class="btn btn-primary">Ajouter</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- update information popu -->
        <div class="modal fade" tabindex="-1" role="dialog" id="editProduct">
          <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0 border-0">
              <div class="modal-header border-0 py-2">
                <h5 class="modal-title position-relative legend px-3"><span class="legend-text">Modifier Produit</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="" action="./" method="post" enctype="multipart/form-data">
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Image</label>
                    <div class="input-group">
                      <label class="input-group-addon bg-primary text-white" for="imgProd">
                        <span class="flaticon-box"></span>
                      </label>
                      <input type="file" name="pic" class="form-control" id="imgProd" accept="image/*" required>
                    </div>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Nom</label>
                    <input type="text" name="name" placeholder="EX:  T-shirt Nike, Chaussure AD, ..." class="form-control border-0 rounded-0 px-0" required>
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Prix</label>
                    <input type="number" name="price" min="0" placeholder="EX: 10000, 500000, ..." class="form-control border-0 rounded-0 px-0" required>
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>

                  <div class="row px-3">
                    <fieldset class="form-group px-3 material-input mb-1 col">
                      <label class="small">Couleur</label>
                    </fieldset>
                    <fieldset class="form-group px-3 material-input mb-1 col">
                      <label class="small">Quantite</label>
                    </fieldset>
                    <div class="listExistingColor">
                    </div>
                  </div>
                  <fieldset class="form-group px-3 pt-3 material-input mb-1 col">
                    <button type="button" class="btn btn-success btn-block addMoreQuantity" data-toggle="tooltip" data-placement="bottom" title="Ajouter Nouvelle Couleur et Quantite">
                      <span class="flaticon-cross small-icon"></span>
                    </button>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1 col">
                    <label class="small">Categorie</label>
                    <select class="form-control custom-select" name="category" required>
                      <?php
                      $selectCategories = $db->query('SELECT * FROM Categories ORDER BY name');
                      while($selectCategory = $selectCategories->fetch()){ ?>
                        <option value="<?php echo $selectCategory['ID'] ?>"><?php echo $selectCategory['name'] ?></option>
                      <?php } ?>
                    </select>
                  </fieldset>
                  <!-- list of alternatif product -->
                  <div class="modal-footer border-0">
                    <button type="submit" name="editProduct" class="btn btn-primary">Modifier</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        <?php endif; ?>
        <!-- end insert category modal -->
      </div>
    </div>
  </div>
  <!-- Produits list -->
  <div class="row">
    <div class="col">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="bg-none border-0 rounded-30 btn btn-block">
                Image
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="ID">
                ID
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="name">
                Nom
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="category">
                Categories
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="price">
                Prix
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="quantity">
                Quantite
              </button>
            </th>
            <?php if ($_SESSION['id'] == 1): ?>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="bg-none border-0 rounded-30 btn btn-block">
                Options
              </button>
            </th>
          <?php endif; ?>
          </tr>
        </thead>
        <tbody class="list text-center light-shadow">
          <!-- start item list -->
          <?php //get the products
          $getProducts = $db->prepare('SELECT * FROM products ORDER BY createdAt DESC');
          $getProducts->execute();
          while ($getProduct = $getProducts->fetch()) { 
            $qtyProdList = $db->prepare('SELECT SUM(quantity) AS qty FROM quantity WHERE productID = ?');
                $qtyProdList->execute(array($getProduct['ID']));
                $_qtyProdList = $qtyProdList->fetch();
            ?>
          <tr class="mb-3 bg-white border-bottom-1">
            <td class="border-top-0 articleImg align-middle"><img src="../Media/Images/Articles/Article_<?php echo $getProduct['ID'] ?>.jpg" alt="Article Img" class="w-100"></td>
            <th scope="row" class="ID border-top-0 align-middle">#<?php echo $getProduct['ID'] ?></th>
            <td class="name border-top-0 align-middle"><?php echo $getProduct['name'] ?></td>
            <?php
            $catSel = $db->prepare('SELECT name FROM categories WHERE ID = ?');
            $catSel->execute(array($getProduct['category']));
            $catGet = $catSel->fetch();
            ?>
            <td class="category border-top-0 align-middle"><?php echo $catGet['name'] ?></td>
            <td class="price border-top-0 align-middle"><?php echo $getProduct['price'] ?>fr</td>
            <td class="quantity border-top-0 align-middle"><?php echo $_qtyProdList['qty'] ?></td>
            <?php if ($_SESSION['id'] == 1): ?>
            <td class="border-top-0 align-middle">
              <button
              class="btn btn-primary"
              type="button"
              data-toggle="modal"
              data-target="#editProduct"
              data-id="<?php echo $getProduct['ID'] ?>"
              data-name="<?php echo $getProduct['name'] ?>"
              data-category="<?php echo $getProduct['category'] ?>"
              data-price="<?php echo $getProduct['price'] ?>">
                <span class="flaticon-edit-1"></span>
              </button>
              <button name="delProd" value="<?php echo $getProduct['ID'] ?>" class="btn btn-danger ml-2">
                <span class="flaticon-delete"></span>
              </button>
            </td>
          <?php endif; ?>
          </tr>
        <?php } ?>
          <!-- end item list -->
        </tbody>
      </table>
    </div>
  </div>
</div>


<?php include '../PHP/Inc/foot.php'; ?>
