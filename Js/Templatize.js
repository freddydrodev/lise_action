var nbr = 0;

$('.addMoreQuantity').click(function () {
  nbr++;

  var template = '<div class="row px-3 newQuantity"><fieldset class="form-group px-3 material-input mb-1 col"><label class="small">Couleur ' + (nbr + 1) + '</label><input type="text" name="color-' + (nbr + 1) + '" placeholder="EX: Rouge, Bleu, Vert, ..." class="form-control border-0 rounded-0 px-0" required><span class="under w-100 d-block position-relative"></span></fieldset><fieldset class="form-group px-3 material-input mb-1 col"><label class="small">Quantite</label><input type="nbr" min="0" name="quantity-' + (nbr + 1) + '" placeholder="EX: 100, 10, ..."     class="form-control border-0 rounded-0 px-0" required><span class="under w-100 d-block position-relative"></span></fieldset><button type="button" class="deleter btn text-danger bg-none"><span class="flaticon-close-button"></span></button></div>';

  $(this).parent().before(template);

  $('.deleter').click(function () {
    nbr--;
    $(this).parent().remove();
  });
});

var countChecked = function () {
  if ($('#addProductAlt:checked').length > 0) {
    $('.alt-inp').attr('required', true);
  }else {
    $('.alt-inp').attr('required', false);
  }
};

countChecked();

$('#addProductAlt[type=checkbox]').on('click', countChecked);
