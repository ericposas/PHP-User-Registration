<?php

function redirect_to($page, $ms=2000){
  echo "
  <script>
    setTimeout(()=>{
      window.location.href = '{$page}';
    }, {$ms});
  </script>
  ";
}

 ?>
