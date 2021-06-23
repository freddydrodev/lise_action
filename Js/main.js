function bootstrapNotify (_text, _type) {
  $.notify(
  {
    // options
    icon: 'flaticon-question',
    message: _text,
  },
  {
    // settings
    type: _type,
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
}



$('.toogle-search').click(function(){
  $('#searchBox').toggleClass('d-none');
  $('.bigsearch').focus();
  return false;
})
