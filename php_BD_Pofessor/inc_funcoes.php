<?php 
  function ola(){
      echo "ola";
  } 

  function card($texto, $cor){

  ?>

  <div class="card <?php echo $cor ?> darken-1">
  <div class="card-content white-text">
      <span class="card-title"></span>
      <p> <?php echo $texto ?> </p>
  </div>
  <div class="card-action">
      <a href="#">This is a link</a>
      <a href="#">This is a link</a>
  </div>
  </div>
  <?php
  }

?>