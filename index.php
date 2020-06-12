<?php
ini_set('output_buffering', 1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "autoload.php";
require_once "controllers/menuController.php";
require_once "config/config.php";
require_once "models/user/user.php";
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Equipamiento Grafico</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" id="viewportMeta">
    <meta name="description" content="Venta de maquinas graficas"/>
    <meta name="keywords" content="" />
    <meta name="author" content="Damian Jose Chocron Martinez" />

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    

    <!-- <link rel="icon" type="image/svg+xml" href="/img/favicon.svg" sizes="any"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URL_BASE; ?>css.css">
</head>

<body>
    <header>
        <?php
        $cabecera = new menuController();
        $cabecera->header();
        ?>
    </header>
    <main>
        <?php require_once "loadcontroller.php"; ?>
    </main>
    <footer>
        <?php require_once "./view/layout/footer.php"; ?>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php if (isset($_GET["delete"]) | isset($_POST["idproductmodify"])) : ?>
        <!-- NO alcanza variable de productController, pero esto siempre da error si no esta en modify.php-->
        <script src="<?php echo URL_BASE; ?>js/jsmodal.js" type="text/javascript"></script>
    <?php endif; ?>
    <?php if (isset($_SESSION["indentity"])) : ?>
        <!-- NO alcanza variable de productController, pero esto siempre da error si no esta en modify.php-->
        <script src="<?php echo URL_BASE; ?>js/jsaccesstoken.js" type="text/javascript"></script>
    <?php endif; ?>
    <?php if (isset($_GET["action"]) && $_GET["action"] == "modify") : ?>
        <script src="<?php echo URL_BASE; ?>js/jsmodalimagenesmodify.js" type="text/javascript"></script>
    <?php endif; ?>
    <?php if (isset($_GET["action"]) && $_GET["action"] == "insertform") : ?>
        <script src="<?php echo URL_BASE; ?>js/insertform.js" type="text/javascript"></script>
    <?php endif; ?>

</body>

</html>