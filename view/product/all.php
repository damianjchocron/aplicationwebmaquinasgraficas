<?php
require_once "config/config.php";
$productdatainstance = new productdata();
$filtercategory = "";
$sort = "";
$forDropDown = "Ordenar Por";
if (isset($_GET["idcategoria"])) {
    $idcategory = $_GET["idcategoria"];
    $filtercategory = "&idcategoria=" . $_GET["idcategoria"];
    $forDropDown =  "";
    $categoriaunica = $productdatainstance->getcategoria($idcategory);
}
if (isset($_GET["sort"])) $sort = "&sort=" . $_GET["sort"];
$urlact = $_SERVER["REQUEST_URI"];

?>


<div class="row justify-content-between">
    <div class="row">
        <div class="m-3 dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Categoria
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php foreach ($categoria as $value) : ?>
                    <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&idcategoria=" . $value->idcategoria . $sort ?>"><?php echo $value->nombrecategoria ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="m-3 dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ordenar Por
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&sort=1" . $filtercategory ?>">Mas Reciente</a>
                <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&sort=2" . $filtercategory ?>">Mas Antiguo</a>
                <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&sort=3" . $filtercategory ?>">Mayor Precio</a>
                <a class="dropdown-item" href="<?php echo URL_BASE . "product/all&sort=4" . $filtercategory ?>">Menor Precio</a>
            </div>
        </div>
    </div>
    <?php if(isset($categoriaunica)):?>
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
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all" ?>">1</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=1" ?>">2</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=2" ?>">3</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=3" ?>">4</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=4" ?>">5</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=5" ?>">6</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=6" ?>">7</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo URL_BASE . "product/all&page=7" ?>">8</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
</nav>