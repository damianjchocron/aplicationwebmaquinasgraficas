<?php

require_once 'autoload.php';
require_once "controllers/encrypController.php";
require_once "data/user/user.php";

$showError = true;
$controllerName = "homeController";
$action = "index";
$actionprotected = array('modify', 'insertform');
$encrypinstance = new encrypController();
$userdatainstance = new userdata();



$controllerDefine = isset($_GET['controller']);
if ($controllerDefine) $controllerName = $_GET['controller'] . 'Controller';


$actionDefine = isset($_GET['action']);
if ($actionDefine)  $action = $_GET['action'];


if (class_exists($controllerName)) {
    $controller = new $controllerName;
    $exits = method_exists($controller, $action);
    $showError = !$exits;
    if ($exits) {
        $needcheckaction = "false";
        foreach ($actionprotected as $value) {
            if ($value == $action) {
                $needcheckaction = "true";
                if (isset($_GET["accesstoken"])) {
                    $identity = "";
                    $pathcomplet = parse_url($_SERVER["REQUEST_URI"]);
                    parse_str($pathcomplet['path'], $pathparse);
                    $accesstokendecode = $pathparse['accesstoken'];
                    $idusuarioDesencriptado = $encrypinstance->decrypt($accesstokendecode);
                    if ($idusuarioDesencriptado) {
                        $identity = $userdatainstance->selectuserdata(null, $idusuarioDesencriptado);
                    }
                    if (!empty($identity)) {
                        $controller->$action();
                    }else{
                        echo 'No autorizado';
                    }
                } else{
                    echo 'No autorizado';
                }
            }
        }
        if ($needcheckaction == 'false') $controller->$action();
    }
}


if ($showError) {
    $error = new errorController();
    $error->error();
}
