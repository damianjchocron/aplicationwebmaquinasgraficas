<?php
require_once "config/config.php";
?>
<div class="container">
    <div class="row">
        <?php foreach ($dataproductforrender as $value) : ?>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 pr-4 pb-4">
                <div class="card-deck">
                    <div class="mt1 card">
                        <img src="<?php echo URL_BASE . $value->url ?>" class="card-img-top" alt="FotosMaquinas">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $value->nombre ?></h5>
                            <p class="card-text"><?php echo $value->descripcion ?></p>
                            <p class="card-text">Precio $<?php echo $value->precio ?></p>
                            <a href="<?php echo URL_BASE . "product/detail&idproduct=" . $value->idproduct; ?>" class="btn btn-primary">Ver Mas</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>