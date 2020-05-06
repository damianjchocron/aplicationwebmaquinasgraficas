<?php
require_once "controllers/baseController.php";


class loaddata extends baseController{
    public function insertproductdata($titulo,$precio,$descripcion)
    {
        $query=<<<EOD
                INSERT INTO product
                (titulo,precio,descripcion,fecha_alta,idcategoria)
                VALUES ('{$titulo}','{$precio}','{$descripcion}',now(),1);
        EOD;
        return $query;
    }

    public function loadproductdata()
    {
        $truncate = "TRUNCATE TABLE product";
        $this->ExecuteQuery($truncate);

        $string = $this->insertproductdata("komori",'130000', "Muy buena");
        $this->ExecuteQuery($string);

        $string = $this->insertproductdata("Speed Master",'130000', "Muy buena");
        $this->ExecuteQuery($string);

        $string = $this->insertproductdata("Planeta",'130000', "Muy buena");
        $this->ExecuteQuery($string);

        $string = $this->insertproductdata("Troqueladora",'130000', "Muy buena");
        $this->ExecuteQuery($string);

        $string = $this->insertproductdata("Guillotina",'130000', "Muy buena");
        $this->ExecuteQuery($string);

    }
}
?>