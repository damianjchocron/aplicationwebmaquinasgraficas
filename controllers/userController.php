<?php
require_once "controllers/baseController.php";
require_once "controllers/encrypController.php";
require_once "data/user/user.php";
require_once "models/user/user.php";
require_once "config/config.php";


class userController extends baseController
{
    function login()
    {

        $userdatanstance = new userdata();
        $encrypinstance = new encrypController();

        $hash = "";
        $nombreusuario = "";
        $passwordd = "";
        $identity = "";
        if (isset($_POST["passwordd"])) $passwordd = $_POST["passwordd"];

        if (isset($_POST["nombreusuario"])) {
            $nombreusuario = $_POST["nombreusuario"];
            $identity = $userdatanstance->selectuserdata($nombreusuario);
        }
        if ($identity) {
            if ($identity->passwordd == $passwordd) {
                $_SESSION["indentity"] = $identity;
                $idusuario = $identity->idusuario;
                $hash = $encrypinstance->makehash($idusuario);
                echo $hash;
               // header("location:" . URL_BASE . "product/insertform");
            }
        }
        require_once "view/user/login.php";
    }
}
