var options = { valueNames: ['name', 'ID', 'category', 'price', 'quantity'] };

var userList = new List('productsList', options);

//perfectscroll
var scrollEl = document.querySelectorAll('#categories-list .card-text');

scrollEl.forEach(function(el){
  new PerfectScrollbar(el);
});

// slick carousel
$(document).ready(function(){
  $('#categories-list').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    adaptiveHeight: true,
    centerMode: true,
    centerPadding: '60px'
  });
});

$('button[name="delProd"]').click(function(){
  // confirm dialog
  var $this = $(this);
  var val = $this.val();

  alertify.confirm("Voulez-vous vraiment Supprimer ce produit?",
  function () {
    $.ajax({
      type: 'POST',
      url: '../PHP/Script/deleteProd.php',
      data: { delProd: val },
      success: function (data) {
        bootstrapNotify(data.text, data.type);

        if(data.type === 'success'){
          $this.parents('tr').fadeOut();
        }
      },
      error: function (err) {
        console.log(err.responseText);
      },
      dataType: "json"
    });

  },
  function() {
    console.log('canceled');
  });
  return false;
});

$('button[name="delCat"]').click(function(){
  // confirm dialog
  var $this = $(this);
  var val = $this.val();

  alertify.confirm("Voulez-vous vraiment Supprimer cette categorie?",
  function () {
    $.ajax({
      type: 'POST',
      url: '../PHP/Script/deleteCat.php',
      data: { delCat: val },
      success: function (data) {
        bootstrapNotify(data.text, data.type);

        if(data.type === 'success'){
          $this.parents('.slick-slide.col').fadeOut();
        }
      },
      error: function (err) {
        console.log(err.responseText);
      },
      dataType: "json"
    });

  },
  function() {
    console.log('canceled');
  });
  return false;
});

// update category information
$('#editCategory').on('show.bs.modal', function (event) {
  var $button = $(event.relatedTarget); // Button that triggered the modal

  var _data = {
    id: $button.data('id'),
    name: $button.data('name'),
  };

  var $modal = $(this);

  for (key in _data) {
    $modal.find('input[name="' + key + '"]').val(_data[key]);
  }
});

// update product information
$('#editProduct').on('show.bs.modal', function (event) {
  $('.listExistingColor').empty();
  var $button = $(event.relatedTarget); // Button that triggered the modal

  var _data = {
    id: $button.data('id'),
    name: $button.data('name'),
    category: $button.data('category'),
    price: $button.data('price'),
  };

  var $modal = $(this);

  $.ajax({
    type: 'POST',
    url: '../PHP/Script/_getQty.php',
    data: { id: _data.id },
    success: function (data) {
      for (var i = 0; i < data.length; i++) {
        var test =
          '<fieldset class="form-group py-2 px-3 material-input mb-1 row existingColor">'+
            '<div class="col-6">'+
              '<input type="text" name="existingColor[]" value="' + data[i].color +'" class="form-control border-0 rounded-0 px-3" readonly>'+
            '</div>'+
            '<div class="col">'+
              '<div class="input-group input-group-number">'+
                '<button type="button" class="remto input-group-addon btn rounded-0 btn-danger text-white">-</button>'+
                '<input type="number" data-pid="'+ data[i].productID + '" data-cid="' + data[i].colorID +'" name="colorqty[]" min="1" max="1000000" class="qty-order form-control border-0 rounded-0 px-2" value="' + data[i].quantity +'" required readonly>'+
                '<button type="button" class="addto input-group-addon btn rounded-0 btn-primary text-white">+</button>'+
              '</div>'+
            '</div>'+
            '<button type="button" class="delColor btn text-danger bg-none"><span class="flaticon-close-button"></span></button>'+
          '</fieldset>';

        $('.listExistingColor').append(test);
        console.log(data[i]);
      }
    },
    error: function (err) {
      console.log(err.responseText);
    },
    dataType: "json"
  });

  for (key in _data) {
    $modal.find('input[name="' + key + '"]').val(_data[key]);

    //for select opt
    if(key == 'category'){
      $modal.find('select[name="' + key + '"] option[value="' + _data[key] + '"]').prop('selected', true);
    }
  }

});

//increase or decrease input number
$(document).on('click', '.input-group-number button', function () {
  var $par = $(this).parents('.existingColor');
  var $qty = $par.find('.qty-order');
  var _cid = $qty.attr('data-cid');
  var _pid = $qty.attr('data-pid');
  var val = $qty.val();
  var max = $qty.attr('max');
  var min = $qty.attr('min');

  console.log(val, _cid, _pid);
  function change() {
    return $(this).hasClass('remto') ?
    ((parseInt(val) - 1) > min ? (parseInt(val) - 1) : parseInt(min)) :
    ((parseInt(val) + 1) < max ? (parseInt(val) + 1) : parseInt(max));
  }

  $qty.val(change.bind(this));

  $.ajax({
    type: 'POST',
    url: '../PHP/Script/_updateColorQty.php',
    data: { qty: $qty.val(), pid: _pid, cid: _cid },
    success: function (data) {
      // bootstrapNotify(data.text, data.type);
      console.log(data);
      // if(data.type === 'success'){
      //   $this.parents('tr').fadeOut();
      // }
    },
    error: function (err) {
      console.log(err.responseText);
    },
    dataType: "json"
  });
});
