<?php require_once "config/config.php"; ?>
<div class="row">
  <div class="col-xl-6 mb-3 mt-3">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <?php foreach ($forrenderimg as $value) : ?>
        <!-- Aca le doy el el active para el carrusel -->
        <?php $active  = "" ; if($value->priority == "1") $active = "active"; ?>
          <div class="carousel-item <?php echo $active ?>">
            <img src="<?php echo URL_BASE . $value->url ?>" class="d-block w-100" alt="FotosMaquinas">
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
  </div>
  <div class="col-xl-6 mb-3">
    <ul class="list-group list-group-flush">
      <?php foreach ($forrenderinfo as $value) : ?>
        <li class="list-group-item"><?php echo $value ?></li>
      <?php endforeach ?>
    </ul>
  </div>
</div>