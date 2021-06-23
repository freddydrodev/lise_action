<?php
$page = 'Employees';
$ind = true;
include '../PHP/Inc/head.php';
$_sex = array('H' => 'Homme', 'F' => 'Femme');
$_ut = array(2 => 'Caissiere', 3 => 'Livreur');
?>
<div  id="employee-list">
  <div class="row title">
    <div class="col position-relative">
      <div class="d-flex justify-content-between p-3 align-items-center rounded-3">
        <h2 class="text-uppercase m-0">Employee <br/></h2>
        <!-- insert category modal start -->

        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
            <span class="flaticon-mathematical-addition-sign small-icon"></span>
            Ajouter Employee
          </button>
          <button type="button" data-toggle="collapse" data-target="#search" aria-expanded="false" aria-controls="collapseSearch" class="search-toogle btn btn-info">
            <span class="flaticon-magnifying-glass-1"></span>
          </button>
        </div>
        <!-- search -->
        <div class="collapse position-absolute h-100 light-shadow" id="search">
          <div class="input-group h-100">
            <input type="search" name="search" placeholder="Recherchez dans clients..." class="search border-0 form-control px-4">
            <button type="reset" class="input-group-addon bg-white border-0 text-muted px-4" data-toggle="collapse" data-target="#search" aria-expanded="false" aria-controls="collapseSearch">
              <span class="flaticon-cancel"></span>
            </button>
          </div>
        </div>
        <!-- popup -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addCategoryModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0 border-0">
              <div class="modal-header border-0 py-2">
                <h5 class="modal-title position-relative legend px-3"><span class="legend-text">Ajouter Employee</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="" action="./" method="post">
                  <?php include '../PHP/Script/addEmployee.php'; ?>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Nom</label>
                    <input type="text" name="name" placeholder="EX: Kuame Kore" class="form-control border-0 rounded-0 px-0" required>
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Pseudo</label>
                    <input type="text" name="pseudo" placeholder="EX: KKre" class="form-control border-0 rounded-0 px-0" required>
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Numero</label>
                    <input type="text" name="phone" placeholder="EX: +22501234567" class="form-control border-0 rounded-0 px-0" required>
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Sex</label>
                    <select class="custom-select form-control" name="sex" required>
                      <option value="H">Homme</option>
                      <option value="F">Femme</option>
                    </select>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Type D'employee</label>
                    <select class="custom-select form-control" name="type" required>
                      <option value="2">Caissiere</option>
                      <option value="3">Livreur</option>
                    </select>
                  </fieldset>
                  <div class="modal-footer border-0">
                    <button type="submit" name="addEmployee" class="btn btn-primary">Ajouter</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>

        <!-- update information popu -->
        <div class="modal fade" tabindex="-1" role="dialog" id="editEmployee">
          <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0 border-0">
              <div class="modal-header border-0 py-2">
                <h5 class="modal-title position-relative legend px-3"><span class="legend-text">Modifier Employee</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="" action="./" method="post">
                  <?php include '../PHP/Script/updateEmployee.php'; ?>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Nom</label>
                    <input type="text" name="fn" placeholder="EX: Kuame Kore" class="form-control border-0 rounded-0 px-0" required>
                    <input type="hidden" name="id">
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Pseudo</label>
                    <input type="text" name="un" placeholder="EX: KKre" class="form-control border-0 rounded-0 px-0" required>
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Numero</label>
                    <input type="text" name="ph" placeholder="EX: +22501234567" class="form-control border-0 rounded-0 px-0" required>
                    <span class="under w-100 d-block position-relative"></span>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Sex</label>
                    <select class="custom-select form-control" name="sx" required>
                      <option value="H">Homme</option>
                      <option value="F">Femme</option>
                    </select>
                  </fieldset>
                  <fieldset class="form-group px-3 material-input mb-1">
                    <label class="small">Type D'employee</label>
                    <select class="custom-select form-control" name="ut" required>
                      <option value="2">Caissiere</option>
                      <option value="3">Livreur</option>
                    </select>
                  </fieldset>
                  <div class="modal-footer border-0">
                    <button type="submit" name="editEmployee" class="btn btn-primary">Modifier Employee</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        <!-- end insert category modal -->
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
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="username">
                Username
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="init">
                Mot De Passe Initial
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="phone">
                Numero
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="sex">
                Sexe
              </button>
            </th>
            <th scope="col" class="border-top-0 border-bottom-0 text-center">
              <button class="sort bg-none border-0 rounded-30 btn btn-block" data-sort="type">
                Role
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
          <?php $livreurs = $db->query('SELECT * FROM users WHERE usertype = 3 OR usertype = 2 ORDER BY fullname');
          while ($livreur = $livreurs->fetch()) { ?>
            <tr class="mb-3 bg-white border-bottom-1">
              <td class="name border-top-0 align-middle"><?php echo $livreur['fullname'] ?></td>
              <td class="username border-top-0 align-middle"><?php echo $livreur['username'] ?></td>
              <td class="init border-top-0 align-middle"><?php echo $livreur['init'] ?></td>
              <td class="phone border-top-0 align-middle"><?php echo $livreur['phone'] ?></td>
              <td class="sex border-top-0 align-middle"><?php echo $_sex[$livreur['sex']] ?></td>
              <td class="type border-top-0 align-middle"><?php echo $_ut[$livreur['usertype']] ?></td>
              <td class="border-top-0 align-middle">
                <button
                class="btn btn-primary"
                type="button"
                data-toggle="modal"
                data-target="#editEmployee"
                data-id="<?php echo $livreur['id'] ?>"
                data-fullname="<?php echo $livreur['fullname'] ?>"
                data-phone="<?php echo $livreur['phone'] ?>"
                data-username="<?php echo $livreur['username'] ?>"
                data-sex="<?php echo $livreur['sex'] ?>"
                data-role="<?php echo $livreur['usertype'] ?>">
                  <span class="flaticon-edit-1"></span>
                </button>
                <button name="delemp" value="<?php echo $livreur['id'] ?>" class="btn btn-danger ml-2">
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
