// barcode orders
JsBarcode('.barcode').init();

//orders search
var userList = new List('orders-list',
{ valueNames:
  ['ref', 'client', 'article', 'location', 'date', 'madeBy', 'delivrer'],
});

//perfectscroll
// var scrollEl = document.querySelectorAll('.product-ordered-list');
// scrollEl.forEach(function (el) {
//   new PerfectScrollbar(el, { suppressScrollX: true });
// });

var ps = new PerfectScrollbar('.order-form-product-added', { suppressScrollX: true });

var ps2 = new PerfectScrollbar('.sugestion-wrapper .scroller', { suppressScrollX: true });

// AJAX POP EVOLUTION
var unAvailable = [];
var currentElement = null;
var selectOpt = [];
var $scroler = $('.sugestion-wrapper .scroller');
var $getProd = $('.getProduct');

// autocomple ajax products
$getProd.keyup(function () {
  var s = $(this).val();
  $scroler.addClass('.active');
  $scroler.empty();

  $.ajax({
    type: 'POST',
    url: '../PHP/Script/_orderCheckProducts.php',
    data: { s: s },
    success: function (data) {
      if (data) {
        console.log(data);

        for (var i = 0; i < data.length; i++) {
          if (data[i].available > 0) {
            $scroler.append(
            '<div class="bg-white light-shadow rounded my-3 p-2 w-100 suggestion" data-ID="' + data[i].ID + '">' +
              '<div class="d-flex justify-content-between">' +
                '<h4>#' + data[i].ID + '</h4>' +
                '<p class="small mb-0">' + data[i].available + ' Available(s)</p>' +
              '</div>' +
              '<div class="d-flex justify-content-between">' +
                '<h5 class="text-muted mb-0">' + data[i].prodName + ' - ' + data[i].catName + '</h5>' +
                '<p class="text-primary mb-0">' + data[i].price + ' FR</p>' +
              '</div>' +
            '</div>');
          } else {
            // has to be done
            $scroler.append('<p>' + data[i].prodName + ' is not available</p>');
          }
        }
      }
    },

    dataType: 'json',
  });
});

//make suggestion append on click
$(document).on('click', '.suggestion', function () {
  var ID = $(this).attr('data-ID');
  $scroler.empty();
  $scroler.removeClass('.active');
  $getProd.val('');

  $.ajax({
    type: 'POST',
    url: '../PHP/Script/_orderGetProduct.php',
    data: { s: ID },
    success: function (data) {
      if (data) {
        var opts = '';
        var newList = { element: data.prodID, children: [] };

        for (var i = 0; i < data.colors.length; i++) {
          opts += '<option value="' + data.colors[i].colorID +
          '" data-qty="' + data.colors[i].colorQty +
          '" class="' + isSel + '">' +
          data.colors[i].colorName +
          '</option>';
        }

        //Add as unAvailable
        unAvailable.push(data.prodID);

        $('.order-form-product-added').append(
          '<fieldset class="form-group px-3 material-input mb-1 row">'+
            '<div class="col-3">'+
              '<input type="text" name="article-id[]" class="form-control border-0 rounded-0 px-2 selected-article" data-ID="' + data.prodID + '" value="#' + data.prodID + ' - ' + data.prodName + ' (' + data.catName + ')" required title="' + data.prodName + ' (' + data.catName + ')">'+
            '</div>'+
            '<div class="col-3">'+
              '<select class="custom-select w-100 color-order" name="article-color[]" data-ID="' + data.prodID + '">' + opts +
              '</select>'+
            '</div>'+
            '<div class="col-3">'+
              '<div class="input-group input-group-number">'+
                '<button type="button" class="remto input-group-addon btn rounded-0 btn-danger text-white">-</button>'+
                '<input type="number" name="article-qty[]" min="1" max="' + data.colors[0].colorQty + '" class="qty-order form-control border-0 rounded-0 px-2" value="1" required>'+
                '<button type="button" class="addto input-group-addon btn rounded-0 btn-primary text-white">+</button>'+
              '</div>'+
            '</div>'+
            '<div class="col-3">'+
              '<input type="text" name="article-paid[]" class="form-control px-2" value="' + data.prodPrice + '" max="' + data.prodPrice + '" required>'+
            '</div>'+
          '</fieldset>');

        addInProcess(1, data.colors[0].colorID, data.colors[0].colorID, data.prodID);

        // var $sameDataID = $('select[data-id="' + data.prod
        //  + '"] option:selected');

        // $('.order-form-product-added > fieldset:last-child option').each(function (index) {
        //   // selectOption($sameDataID, $selectedOpt);
        //
        //  newList.children.push({
        //    $el: $(this),
        //    txt: $(this).text(),
        //    selected: index === 0 ? true : false,
        //  });
        // });


        // selectOpt.push(newList);
      }
    },

    error: function (err) {
      console.log(err);
    },

    dataType: 'json',
  });
});

function selectOption($sameDataID, $selectedOpt) {
  var met = false;
  console.log();
  console.log('--------------------------');
  for (var i = 0; i < $sameDataID.length; i++) {

    // if the select tag (element) is different
    if ($selectedOpt[0] != $sameDataID[i]) {
      console.log($sameDataID[i]);

      if ($($sameDataID[i]).text() === $selectedOpt.text()) {
        met = true;
      }
    }
  }

  // we compare the text display into the option selectedOpt
  // and we decide to switch or not based on the value
  if (!met) {
    $selectedOpt.parent().find('.isSelected').removeClass('isSelected');
    $selectedOpt.addClass('isSelected');
  } else {
    $selectedOpt.parent().find('.isSelected').prop('selected', true);
  }
}

//change selected product's color
$(document).on('change', '.color-order', function (e) {

  // the current select tag
  var $this = $(this);

  var $old = $(this).find('.isSelected');

  // the actual selected option
  var $selectedOpt = $this.find('option:selected');

  // the id of the product
  var dataID = $this.attr('data-id');

  // select all the selected option of the same product
  var $sameDataID = $('select[data-id="' + dataID + '"] option:selected');

  // get the quantity of the product
  var qty = $selectedOpt.attr('data-qty');

  // get the input number to manage the quantity value
  var $qtyOrder = $this.parents('.form-group').find('.qty-order');

  // get the actual value display on the input number
  var val = $qtyOrder.val();

  // we now check if we can change the color or not
  selectOption($sameDataID, $selectedOpt);

  // update the value base on the max quantity available
  if (parseInt(val) > parseInt(qty)) {
    $qtyOrder.val(qty);
  }

  $qtyOrder.attr('max', qty);
  $this.find('option:selected').addClass('isSelected');
  // console.log($this.find('option:selected')[0]);

  console.log($old.val(), $old.attr('value'), $this.find('option:selected')[0]);
  if($old[0] != $this.find('option:selected')[0]){
    addInProcess(qty, $this.val(), $old.val(), dataID);
  }
});

//increase or decrease input number
$(document).on('click', '.input-group-number button', function () {
  var $par = $(this).parents('.material-input.row');
  var $qty = $par.find('.qty-order');
  var _color = $par.find('.color-order').val();
  var _id = $par.find('.selected-article').attr('data-ID');
  var val = $qty.val();
  var max = $qty.attr('max');
  var min = $qty.attr('min');

  // console.log($par, _color, _id);
  function change() {
    return $(this).hasClass('remto') ?
    ((parseInt(val) - 1) > min ? (parseInt(val) - 1) : min) :
    ((parseInt(val) + 1) < max ? (parseInt(val) + 1) : max);
  }

  $qty.val(change.bind(this));

  addInProcess($qty.val(), _color, _color, _id);

});

//change step
$('.change-step').click(function () {

  $('.order-form-step').toggleClass('current-step');
  $(this).text($(this).text() == 'Suivant' ? 'Precedant' : 'Suivant');

});

function addInProcess(_qty, _color, _oldColor, _id) {

  $.ajax({
    type: 'POST',

    url: '../PHP/Script/_inProcess.php',

    data: { qty: _qty, color: _color, id: _id, old: _oldColor },

    success: function (data) {
      console.log(data);
    },

    error: function (error) {
      console.log(error);
    },
  });

}

$('.form-order').submit(function (e) {
  e.preventDefault();
  var selectedArticle = $('.selected-article').length;

  if (selectedArticle <= 0) {
    $.notify(
    {
      // options
      icon: 'flaticon-question',
      message: 'aucun article selectionne',
    },
    {
      // settings
      type: 'danger',
      showProgressbar: true,
      placement: {
        from: 'bottom',
        align: 'left',
      },
      z_index: 1110,
      mouse_over: 'pause',
      animate: {
        enter: 'animated bounceIn',
        exit: 'animated bounceOut',
      },
    });
    return false;
  }
});

$('#addCommandeModal').modal('show');
