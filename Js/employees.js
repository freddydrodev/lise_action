var options = { valueNames: ['name', 'phone', 'init', 'username', 'sex', 'type'] };

var userList = new List('employee-list', options);

$('button[name="delemp"]').click(function(){
  // confirm dialog
  var $this = $(this);
  var val = $this.val();

  alertify.confirm("Voulez-vous vraiment Supprimer cet employee?",
  function () {
    $.ajax({
      type: 'POST',
      url: '../PHP/Script/deleteUser.php',
      data: { deluser: val },
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

// update employee information
$('#editEmployee').on('show.bs.modal', function (event) {
  var $button = $(event.relatedTarget); // Button that triggered the modal

  var _data = {
    id: $button.data('id'),
    fn: $button.data('fullname'),
    ph: $button.data('phone'),
    un: $button.data('username'),
    sx: $button.data('sex'),
    ut: $button.data('role'),
  };

  var $modal = $(this);

  for (key in _data) {
    $modal.find('input[name="' + key + '"]').val(_data[key]);

    //for select opt
    if(key == 'ut' || key == 'sx'){
      $modal.find('select[name="' + key + '"] option[value="' + _data[key] + '"]').prop('selected', true);
    }
  }
});
