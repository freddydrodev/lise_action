<?php
$page = 'Livreur';
$ind = true;
include '../PHP/Inc/head.php';
?>
<div class="row title">
  <div class="col">
    <div class="d-flex justify-content-between p-3 align-items-center rounded-3">
      <h2 class="text-uppercase m-0">Livreur</h2>
      <!-- insert category modal start -->

      <button type="button" class="btn btn-primary" onclick="printJS({ printable: 'printable', type: 'html', font_size: '11pt', font:'Poppins', maxWidth: 1210 });">
        <span class="flaticon-mathematical-addition-sign small-icon"></span>Imprimer
      </button>

    </div>
  </div>
</div>

<div class="row" id="livraison-list">
  <div class="col">
    <ul class="nav nav-pills my-3" id="pills-tab" role="tablist">
      
      <li class="nav-item">
        <a class="nav-link active" id="pills-new-tab" data-toggle="pill" href="#pills-new" role="tab" aria-controls="pills-new" aria-selected="true">En Attente</a>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
        <table class="table table-bordered light-shadow" id="printable" style="width:1210px">
          <thead class="bg-white">
            <tr>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="name">
                  Ref.
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="name">
                  Contact
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="name">
                  Nom
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="name">
                  Articles
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="category">
                  Lieu
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="category">
                  Date
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="bg-transparent rounded-30 btn btn-block">
                  Signature
                </button>
              </th>
            </tr>
          </thead>
          <tbody class="list text-center">
            <?php $livraisons = $db->prepare('
            SELECT orders.ID, cust.phone, cust.fullname AS custName, cust.location, livr.ID as livrID
            FROM orders
            INNER JOIN users AS cust ON cust.ID = orders.customerID
            INNER JOIN users AS livr ON livr.ID = orders.livreurID
            WHERE livr.ID = ? AND state = "0"
            ORDER BY orders.createdAt DESC ');
            $livraisons->execute(array($_GET['id']));

            while ($livraison = $livraisons->fetch()) { ?>
              <tr class="mb-3 bg-white border-bottom-1">
                <td class="align-middle">
                  <!-- <svg class="barcode" jsbarcode-value="<?php echo $livraison['ID'] ?>" jsbarcode-height="20" jsbarcode-displayValue="false" jsbarcode-width="1"></svg> -->
                  <p><strong>#<?php echo $livraison['ID'] ?></strong></p>
                </td>
                <td class="align-middle"><?php echo $livraison['phone'] ?></td>
                <td class="align-middle"><?php echo $livraison['custName'] ?></td>
                <td class="align-middle">
                  <?php
                  $ordersArticles = $db->prepare('
                    SELECT products.name,products.ID, categories.name AS cat, product_ordered.paid, product_ordered.quantity, color.color
                    FROM product_ordered
                    INNER JOIN color ON color.ID = product_ordered.colorID
                    INNER JOIN products ON products.ID = product_ordered.productID
                    LEFT JOIN categories ON categories.ID = products.category
                    WHERE product_ordered.orderID = ? ORDER BY products.name');
                  $ordersArticles->execute(array($livraison['ID']));
                  // $total = 0;
                  while ($article = $ordersArticles->fetch()) {
                    // $total += (double)$article['quantity'] * (double)$article['paid'];
                    ?>
                    <div class="row small text-left">
                      <div class="col-10">
                        <p class="mb-1"><strong>#<?php echo $article['ID'] ?></strong></p>
                        <p class="mb-1" style="width:230px"><?php echo $article['name'] ?> <?php echo $article['cat'] ?> <?php echo $article['color'] == 'pas de couleur' ? '' : '('.$article['color'].')' ?></p>
                      </div>
                      <div class="col">
                        <p class="mb-1"><small>x</small><?php echo $article['quantity'] ?></p>
                      </div>
                    </div>
                  <?php } ?>

                </td>
                <td class="align-middle"><?php echo $livraison['location'] ?></td>
                <td class="align-middle" width="120"></td>
                <td class="align-middle" width="120"></td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="pills-caissiere" role="tabpanel" aria-labelledby="pills-caissiere-tab">
        <table class="table">
          <thead>
            <tr>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="name">
                  Nom
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="name">
                  Username
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="name">
                  Mot De Passe Initial
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="name">
                  Numero
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class="sort bg-transparent rounded-30 btn btn-block" data-sort="category">
                  Sex
                </button>
              </th>
              <th scope="col" class="text-center">
                <button class=" rounded-30 btn btn-block">
                  Options
                </button>
              </th>
            </tr>
          </thead>
          <tbody class="list text-center light-shadow">
            <?php $livraisons = $db->query('SELECT * FROM users WHERE usertype = 2 ORDER BY fullname');
            while ($livraison = $livraisons->fetch()) { ?>
              <tr class="mb-3 bg-white border-bottom-1">
                <td class="align-middle"><?php echo $livraison['fullname'] ?></td>
                <td class="align-middle"><?php echo $livraison['username'] ?></td>
                <td class="align-middle"><?php echo $livraison['init'] ?></td>
                <td class="align-middle"><?php echo $livraison['phone'] ?></td>
                <td class="align-middle"><?php echo $_sex[$livraison['sex']] ?></td>
                <td class="align-middle">
                  <a href="#" class="btn btn-primary">
                    <span class="flaticon-edit-1"></span>
                  </a>
                  <a href="#" class="btn btn-danger ml-2">
                    <span class="flaticon-delete"></span>
                  </a>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
<?php include '../PHP/Inc/foot.php'; ?>
