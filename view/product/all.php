<?php
require_once "config/config.php";
?>


<div class="row justify-content-between">
    <div class="row">
        <div class="m-3 dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Categoria
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php foreach ($categoria as $value) : ?>
                    <!-- Aca en los href van los FILTROS  -->
                    <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&idcategoria=" . $value->idcategoria . $filtersort . $filterpage ?>"><?php echo $value->nombrecategoria ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="m-3 dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ordenar Por
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <!-- Aca en los href van los FILTROS  -->
                <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&sort=1" . $filtercategory . $filterpage ?>">Mas Reciente</a>
                <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&sort=2" . $filtercategory . $filterpage ?>">Mas Antiguo</a>
                <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&sort=3" . $filtercategory . $filterpage ?>">Mayor Precio</a>
                <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&sort=4" . $filtercategory . $filterpage ?>">Menor Precio</a>
            </div>
        </div>
    </div>
    <?php if (isset($categoriaunica)) : ?>
        <div>
            <span class="badge badge-info"><?php echo $categoriaunica["0"]->nombrecategoria; ?> </span>
        </div>
    <?php endif; ?>
    <form action="<?php echo URL_BASE ?>product/all" method="POST">
        <div class="input-group col-xl-11 m-3 aling-self-start">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Buscar</button>
            </div>
            <input type="text" id="search" name="search" class="form-control col" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
        </div>
    </form>
</div>

<?php require_once "view/product/fichaProducto.php"; ?>

<nav aria-label="Page navigation example" class="m-5">
    <ul class="pagination">
        <!-- Aca en los href van los FILTROS  -->
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=" . $prev . $filtersort . $filtercategory ?>">Anterior</a></li>
        <?php for ($i = 1; $i <= $numPaginas; $i++) : ?>
            <?php $active = "" ?>
            <?php if ($page == $i) $active = "active" ?>
            <li class="page-item <?php echo $active ?>"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=" . $i . $filtersort . $filtercategory ?>"><?php echo $i ?></a></li>
        <?php endfor ?>
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=" . $next . $filtersort . $filtercategory ?>">Siguiente</a></li>
    </ul>
</nav>