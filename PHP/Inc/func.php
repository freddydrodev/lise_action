<?php
$_ind = isset($ind) ? $ind ? '../' : './' : './';

//inc File
// function _inc($file) {
//   include $_ind . 'PHP/Inc/' . $file . '.php';
// }

function bootstrapNotify($msg = 'Erreur Inconnue', $type = 'danger'){
  ?>
  <script type="text/javascript">
    $.notify({
    // options
    icon: 'flaticon-question',
    message: "<?php echo $msg ?>"
    },{
      // settings
      type: "<?php echo $type ?>",
      showProgressbar: true,
      placement: {
    		from: "bottom",
    		align: "left"
    	},
      z_index: 1110,
      mouse_over: 'pause',
      animate: {
    		enter: 'animated bounceIn',
    		exit: 'animated bounceOut'
    	}
    });
  </script>
  <?php
}

function generateRandomString($length = 5) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function custom_number_format($n, $precision = 3) {
    if ($n < 1000000) {
        // Anything less than a million
        $n_format = number_format($n);
    } else if ($n < 1000000000) {
        // Anything less than a billion
        $n_format = number_format($n / 1000000, $precision) . 'M';
    } else {
        // At least a billion
        $n_format = number_format($n / 1000000000, $precision) . 'B';
    }

    return $n_format;
}
