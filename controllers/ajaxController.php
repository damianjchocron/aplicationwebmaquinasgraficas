<?php
require_once "/var/www/html/EGXD/data/product/product.php";
$productdatainstace = new productdata();

$idmultimedia = "";
$urlimg = "";
if (isset($_POST['idmultimedia'])) $idmultimedia = $_POST['idmultimedia'];
if (isset($_POST['url'])) {
    $urlimg = $_POST['url'];
    $urlimgsinespacio = str_replace(" ", "%20", $urlimg); //Encodea URL ultima parte
    $urlfull = URL_BASE . $urlimgsinespacio;
    $realpath = realpath($urlimg);
    $verify = unlink($realpath);
    /* Cuando borra y borra el qe tiene Priority 1, el select deja de funcionar porqe 
         Se hace sobre el qe tiene pripority "1" para poder mostrar la foto */
    $productdatainstace->deleteimg($idmultimedia);
}

/* Ver si lo qe devuelve hace qe enterre en error en AJAX */
echo $idmultimedia;
