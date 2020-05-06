<?php
require_once "controllers/baseController.php";
require_once "models/user/user.php";

class userdata extends baseController
{

    function selectuserdata($nombre, $idusuario = "")
    {
        $usermodelinstance = new usermodel();
        $conexion = $this->connect();
        $nombrefilter = "";
        if ($nombre != "null") $nombrefilter = `WHERE nombreusuario = "$nombre"`;
        $idusuariofilter = "";
        if (!empty($idusuario)) $idusuariofilter = `WHERE idusuario = "$idusuario"`;
        $query = <<<EOD
        SELECT idusuario, nombreusuario, email, passwordd
        FROM usuario
        $nombrefilter
        $idusuariofilter
        EOD;
        $result = $conexion->query($query);
        if ($result) {
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            $value =  $rows[0];
            $usermodelinstance->idusuario = $value["idusuario"];
            $usermodelinstance->nombre = $value["nombreusuario"];
            $usermodelinstance->email = $value["email"];
            $usermodelinstance->passwordd = $value["passwordd"];
        }
        return $usermodelinstance;
    }
}
