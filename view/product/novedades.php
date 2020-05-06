<?php

//print_r ($datosCard2);

?>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php foreach ($datosCard2 as $key => $value) : ?>
      <?php
        $activo = "";
        if ($key == 0) $activo = "active";
      ?>
      <div class="carousel-item <?php echo $activo ?>">
        <?php require "view/product/fichaProducto.php" ?>
      </div>
    <?php endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>