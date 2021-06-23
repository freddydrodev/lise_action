<?php
$page = 'Ventes';
$ind = true;
include '../PHP/Inc/head.php';
?>
<!-- <nav aria-label="breadcrumb" role="navigation">
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active" aria-current="page">Ventes</li>
  </ol>
</nav>
<div class="row chart-resume">
  <div class="col">
    <div class="card border-0 p-3 mb-4 light-shadow">
      <div class="d-flex align-items-center">
        <div class="w-50">
          <h5 class="card-title">Evolution Des Ventes</h5>
          <h6 class="card-subtitle text-muted">Courbe representant l'evolution des ventes</h6>
        </div>
        <div class="w-50">
          <ul class="nav nav-tabs justify-content-end border-bottom-0" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link py-1 px-4 btn btn-outline-primary mr-2 text-small" id="thisweek-tab" data-toggle="tab" href="#thisweek" role="tab" aria-controls="thisweek" aria-selected="false">Cette Semaine</a>
            </li>
            <li class="nav-item">
              <a class="nav-link py-1 px-4 btn btn-outline-primary mr-2 text-small" id="thisMonth-tab" data-toggle="tab" href="#thisMonth" role="tab" aria-controls="thisMonth" aria-selected="false">Ce Mois</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active py-1 px-4 btn btn-outline-primary text-small" id="thisYear-tab" data-toggle="tab" href="#thisYear" role="tab" aria-controls="thisYear" aria-selected="true">Cette Annee</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="card-body px-0 pb-0">
        <div class="tab-content" id="salesTab">
          <div class="tab-pane fade" id="thisweek" role="tabpanel" aria-labelledby="thisweek-tab">
            ok2
          </div>
          <div class="tab-pane fade" id="thisMonth" role="tabpanel" aria-labelledby="thisMonth-tab">
            ok3
          </div>
          <div class="tab-pane fade show active" id="thisYear" role="tabpanel" aria-labelledby="thisYear-tab">
            <canvas id="thisYearSales" class="w-100 rounded-3" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<!-- Produits title -->
<div  id="salesList">
  <div class="row title">
    <div class="col position-relative">
      <div class="d-flex justify-content-between p-3 align-items-center rounded-3">
        <h2 class="text-uppercase m-0">Ventes</h2>
        <button type="button" data-toggle="collapse" data-target="#search" aria-expanded="false" aria-controls="collapseSearch" class="search-toogle btn btn-info"><span class="flaticon-magnifying-glass-1"></span></button>
      </div>
      <div class="collapse position-absolute h-100 light-shadow" id="search">
        <div class="input-group h-100">
          <input type="search" name="search" placeholder="Recherchez dans clients..." class="search border-0 form-control px-4">
          <button type="reset" class="input-group-addon bg-white border-0 text-muted px-4" data-toggle="collapse" data-target="#search" aria-expanded="false" aria-controls="collapseSearch">
            <span class="flaticon-cancel"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Produits list -->

  <div class="row mt-4">
    <div class="col">
      <table class="table table-bordered light-shadow table-sm">
        <thead class="bg-white">
          <tr>
            <th scope="col" class="text-center">
              <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="ref">
                Reference
              </button>
            </th>
            <th scope="col" class="text-center">
              <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="client">
                Client
              </button>
            </th>
            <th scope="col" class="text-center">
              <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="article">
                Articles
              </button>
            </th>
            <th scope="col" class="text-center">
              <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="location">
                Lieu
              </button>
            </th>
            <th scope="col" class="text-center">
              <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="date">
                Date
              </button>
            </th>
            <th scope="col" class="text-center">
              <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="madeBy">
                Fait. Par
              </button>
            </th>
            <th scope="col" class="text-center">
              <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="delivrer">
                Livreur
              </button>
            </th>
            <th scope="col" class="text-center">
              <button class="bg-transparent rounded-30 btn btn-block" data-sort="delivrer">
                Option
              </button>
            </th>
          </tr>
        </thead>
        <tbody class="list text-center">
          <?php $livraisons = $db->prepare('
          SELECT orders.ID, orders.createdAt, cust.fullname AS custName, cust.phone, cust.location, emp.fullname AS empName, livr.fullname AS livrName, livr.ID as livrID FROM orders INNER JOIN users AS cust ON cust.ID = orders.customerID INNER JOIN users AS emp ON emp.ID = orders.employeeID INNER JOIN users AS livr ON livr.ID = orders.livreurID WHERE orders.state = "1" ORDER BY orders.createdAt DESC ');
          $livraisons->execute();

          while ($livraison = $livraisons->fetch()) { ?>
            <tr class="mb-3 bg-white border-bottom-1">
              <td class="ref align-middle">
                <p><strong>#<?php echo $livraison['ID'] ?></strong></p>
                <svg class="barcode" jsbarcode-value="<?php echo $livraison['ID'] ?>" jsbarcode-height="20" jsbarcode-displayValue="false" jsbarcode-width="1"></svg>
              </td>
              <td class="client align-middle"><?php echo $livraison['custName'] ?>
                <br>
                <strong class="text-muted small">(<?php echo $livraison['phone'] ?>)</strong></td>
              <td class="article align-middle bg-light">
                <?php
                $ordersArticles = $db->prepare('
                  SELECT products.name,products.ID, categories.name AS cat, product_ordered.paid, product_ordered.quantity, color.color
                  FROM product_ordered
                  INNER JOIN color ON color.ID = product_ordered.colorID
                  INNER JOIN products ON products.ID = product_ordered.productID
                  LEFT JOIN categories ON categories.ID = products.category
                  WHERE product_ordered.orderID = ? ORDER BY products.name');
                $ordersArticles->execute(array($livraison['ID']));
                $total = 0;
                while ($article = $ordersArticles->fetch()) {
                  $total += (double)$article['quantity'] * (double)$article['paid'];
                  ?>
                  <div class="row small text-left">
                    <div class="col-6">
                      <p class="mb-1"><strong>#<?php echo $article['ID'] ?></strong></p>
                      <p class="mb-1"><?php echo $article['name'] ?> <?php echo $article['cat'] ?> <?php echo $article['color'] == 'pas de couleur' ? '' : '('.$article['color'].')' ?></p>
                    </div>
                    <div class="col">
                      <p class="mb-1"><small>x</small><?php echo $article['quantity'] ?></p>
                    </div>
                    <div class="col">
                      <p class="mb-1"> <strong class=""><?php echo $article['paid'] ?> Fr</strong></p>
                    </div>
                  </div>
                <?php } ?>
                <div class="row small text-left bg-white text-primary">
                  <div class="col-6">
                    <p class="mb-1 py-2"><strong>Total</strong></p>
                  </div>
                  <div class="col">
                    <p class="mb-1 py-2"></p>
                  </div>
                  <div class="col">
                    <p class="mb-1 py-2"><strong><?php echo $total ?> Fr</strong></p>
                  </div>
                </div>
              </td>
              <td class="location align-middle"><?php echo $livraison['location'] ?></td>
              <td class="date align-middle date-order-<?php echo $livraison['ID'] ?>">21 Dec 2017
              </td>
              <script type="text/javascript">
                $(".date-order-<?php echo $livraison['ID'] ?>").text(moment("<?php echo $livraison['createdAt'] ?>").format("ddd Do MMM YYYY"));
              </script>
              <td class="madeBy align-middle"><?php echo $livraison['empName'] ?></td>
              <td class="delivrer align-middle">
                <a href="../Livreur?id=<?php echo $livraison['livrID'] ?>" class="text-dark">
                  <?php echo $livraison['livrName'] ?>
                </a>
              </td>
              <td class="align-middle">
                <button name="delSal" value="<?php echo $livraison['ID'] ?>" class="btn btn-danger ml-2">
                  <span class="flaticon-delete"></span>
                </button>
              </td>
            </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
</div>


<?php include '../PHP/Inc/foot.php'; ?>
