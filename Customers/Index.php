<?php
$page = 'Clients';
$ind = true;
include '../PHP/Inc/head.php';
$_sex = array('' => '<small class="text-muted ">(Non Defini)</small>', 'H' => 'Homme', 'F' => 'Femme');
?>
<div class="modal fade" tabindex="-1" role="dialog" id="updateClients">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-0 border-0">
      <div class="modal-header border-0 py-2">
        <h5 class="modal-title position-relative legend px-3"><span class="legend-text">Modifier Information Client</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="./" method="post">
          <?php include '../PHP/Script/updateClient.php'; ?>
          <fieldset class="form-group px-3 material-input mb-1">
            <label class="small">Nom Client</label>
            <input type="hidden" name="id" value="">
            <input type="text" name="fn" placeholder="EX: Lise Belle Kuame" class="form-control border-0 rounded-0 px-0" autocomplete="off" required>
            <span class="under w-100 d-block position-relative"></span>
            <div class="suggested-people-wrapper articles position-relative">
              <div class="position-absolute w-100">
                <div class="position-relative w-100 scroller"></div>
              </div>
            </div>
          </fieldset>
          <fieldset class="form-group px-3 material-input mb-1">
            <label class="small">Identifiant Facebook</label>
            <input type="text" name="fb" placeholder="EX: Belise Style" class="form-control border-0 rounded-0 px-0" required>
            <span class="under w-100 d-block position-relative"></span>
          </fieldset>
          <fieldset class="form-group px-3 material-input mb-1">
            <label class="small">Address Electronic</label>
            <input type="email" name="em" placeholder="EX: belisestyle@yahoo.fr" class="form-control border-0 rounded-0 px-0">
            <span class="under w-100 d-block position-relative"></span>
          </fieldset>
          <fieldset class="form-group px-3 material-input mb-1">
            <label class="small">Numero</label>
            <input type="text" name="ph" placeholder="EX: +22501234567" class="form-control border-0 rounded-0 px-0" required>
            <span class="under w-100 d-block position-relative"></span>
          </fieldset>
          <fieldset class="form-group px-3 material-input mb-1">
            <label class="small">Lieu De Residence</label>
            <input type="text" name="ln" placeholder="EX: Riviera Faya" class="form-control border-0 rounded-0 px-0" required>
            <span class="under w-100 d-block position-relative"></span>
          </fieldset>
          <fieldset class="form-group px-3 material-input mb-1">
            <label class="small">Sexe</label>
            <select class="form-control custom-select" name="sx" required>
              <option value="F">Femme</option>
              <option value="H">Homme</option>
            </select>
          </fieldset>
          <div class="modal-footer border-0">
            <button type="submit" name="clientUpdate" class="btn btn-primary">Modifier</button>
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="customer-list">

  <div class="row title">
    <div class="col position-relative">
      <div class="d-flex justify-content-between p-3 align-items-center rounded-3">
        <h2 class="text-uppercase m-0">Clients</h2>
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
  <div class="row">
    <div class="col">
      <table class="table">
        <thead>
          <tr>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="name">
                Nom
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="phone">
                Contact
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="facebook">
                Facebook
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="email">
                Email
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="sex">
                Sexe
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="location">
                Lieu de residence
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="bg-none border-0 rounded-30 btn btn-block">
                Options
              </button>
            </th>
          </tr>
        </thead>
        <tbody class="list text-center light-shadow">
          <?php
          $users = $db->query('SELECT * FROM users WHERE usertype = 4 ORDER BY fullname');
          while ($cust = $users->fetch()) { ?>
            <tr class="mb-3 bg-white border-bottom-1">
              <td class="name border-top-0 align-middle"><?php echo $cust['fullname'] ?></td>
              <td class="phone border-top-0 align-middle"><?php echo strlen($cust['phone']) > 0 ? $cust['phone'] : '<small class="text-muted ">(Non Defini)</small>' ?></td>
              <td class="facebook border-top-0 align-middle"><?php echo strlen($cust['facebookID']) > 0 ? $cust['facebookID'] : '<small class="text-muted ">(Non Defini)</small>' ?></td>
              <td class="email border-top-0 align-middle"><?php echo strlen($cust['email']) > 0 ? $cust['email'] : '<small class="text-muted ">(Non Defini)</small>' ?></td>
              <td class="sex border-top-0 align-middle"><?php echo $_sex[$cust['sex']] ?></td>
              <td class="location border-top-0 align-middle"><?php echo strlen($cust['location']) > 0 ? $cust['location'] : '<small class="text-muted ">(Non Defini)</small>' ?></td>
              <td class="border-top-0 align-middle">
                <button
                class="btn btn-primary"
                type="button"
                data-toggle="modal"
                data-target="#updateClients"
                data-ID="<?php echo $cust['id'] ?>"
                data-fullname="<?php echo $cust['fullname'] ?>"
                data-phone="<?php echo $cust['phone'] ?>"
                data-facebook="<?php echo $cust['facebookID'] ?>"
                data-email="<?php echo $cust['email'] ?>"
                data-sex="<?php echo $cust['sex'] ?>"
                data-location="<?php echo $cust['location'] ?>">
                  <span class="flaticon-edit-1"></span>
                </button>
                <?php if ($_SESSION['id'] == 1): ?>
                <button name="deluser" value="<?php echo $cust['id'] ?>" class="btn btn-danger ml-2">
                  <span class="flaticon-delete"></span>
                </button>
              <?php endif; ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include '../PHP/Inc/foot.php'; ?>
