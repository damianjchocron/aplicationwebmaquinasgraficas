<?php
require_once "controllers/baseController.php";
require_once "models/product/product.php";
require_once "models/product/idmax.php";
require_once "models/categoria/categoria.php";
require_once "models/product/img.php";

class productdata extends baseController
{
    public function allforpagination($idcategoria, $search)
    {
        $filterQueryCategoria = "";
        $filterQuerySearch = "";

        if(!empty($idcategoria)) $filterQueryCategoria =  " AND idcategoria = $idcategoria "; 
        if(!empty($search)) $filterQuerySearch = " AND product.titulo LIKE '$search' ";
        
        $array = [];
        $conexion = $this->connect();
        $query = <<<EOD
        SELECT * FROM product
        JOIN multimedia
        ON product.idproduct = multimedia.idproduct
        WHERE multimedia.priority  = 1 
        AND titulo  != ""
        $filterQueryCategoria
        $filterQuerySearch
        EOD;
        $result = $conexion->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
       
        return $rows;
    }

    function deleteimg($idmultimedia)
    {
        $conexion = $this->connect();
        $query = <<<EOD
        DELETE FROM multimedia WHERE idmultimedia = "$idmultimedia"
        EOD;
        $result = $conexion->query($query);
    }

    function allimg ()
    {
        $conexion = $this->connect();
        $query = <<<EOD
        SELECT idproduct, idmultimedia, url, priority
        FROM multimedia;
        EOD;
        $result = $conexion->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $value) {
                $listaImageinstance = new listaImage();
                $listaImageinstance->idproduct = $value["idproduct"];

                $img = new imgmodel();
                $img->idproduct = $value["idproduct"];
                $img->idmultimedia = $value["idmultimedia"];
                $img->url = $value["url"];
                $img->priority = $value["priority"];

                $listaImageinstance->imge[] = $img;

                $array[] = $listaImageinstance;
            }
        }
        return $array;
      
    }

    function deleteData($idproductdelete)
    {
        $conexion = $this->connect();
        $query = <<<EOD
        DELETE FROM product
        WHERE idproduct = $idproductdelete;
        EOD;
        $result = $conexion->query($query);
    }

    function modifyData($idproduct, $titulo, $descripcion, $precio, $idcategoria)
    {
        $conexion = $this->connect();
        $query = <<<EOD
        UPDATE product
        SET
            titulo = "$titulo",
            descripcion = "$descripcion",
            precio = "$precio",
            idcategoria = "$idcategoria"
        WHERE idproduct = $idproduct;
        EOD;
        $result = $conexion->query($query);
    }


    //Ver si esta query la puedo meter en la ALL !!! y BORRAR
    function search($search, $pagination)
    {
        $array = [];
        $conexion = $this->connect();
        $query = <<<EOD
        SELECT multimedia.priority , multimedia.url, product.idproduct, titulo, descripcion, precio, idcategoria, fecha_alta
        FROM product
        JOIN multimedia
        ON product.idproduct = multimedia.idproduct
        WHERE multimedia.priority  = 1
        AND product.titulo LIKE "$search"
        LIMIT $pagination , 6;        
        EOD;
        $result = $conexion->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $value) {
                $card = new productmodel();
                $card->nombre = $value["titulo"];
                $card->precio = $value["precio"];
                $card->descripcion = $value["descripcion"];
                $card->fecha_alta = $value["fecha_alta"];
                $card->url = $value["url"];
                $card->idproduct = $value["idproduct"];

                $array[] = $card;
            }
        }
        return $array;
    }

    function all($pagination = "", $idcategoria = "", $sort = "", $search = "", $numRegisPos = 0)
    {
        $filtercampoOrden = "";
        if (!empty($sort)) {
            $campoOrden = "";
            switch ($sort) {
                case 1:
                    $campoOrden = "product.fecha_alta DESC";
                    break;
                case 2:
                    $campoOrden = "product.fecha_alta ASC";
                    break;
                case 3:
                    $campoOrden = "product.precio DESC";
                    break;
                case 4:
                    $campoOrden = "product.precio ASC";
                    break;
            }
            $filtercampoOrden = " ORDER BY $campoOrden ";
        }
        $filterpagination = "";
        if (!empty($pagination) | $pagination == "0") {
            $filterpagination = " LIMIT $pagination , $numRegisPos ";
        }
        $filtersearch = "";
        if (!empty($search)) $filtersearch = " AND titulo LIKE '%" . $search . "%' ";
        $filtercategoria = "";
        if (!empty($idcategoria)) $filtercategoria = " AND product.idcategoria = $idcategoria  ";
        $array = [];
        $conexion = $this->connect();
        $query = <<<EOD
        SELECT categoria.nombrecategoria , multimedia.priority , multimedia.url, product.idproduct, titulo, descripcion, precio, product.idcategoria, fecha_alta
        FROM product
        JOIN multimedia
        ON product.idproduct = multimedia.idproduct
        JOIN categoria
        ON product.idcategoria = categoria.idcategoria
        WHERE multimedia.priority  = 1
        AND titulo  != ""
        $filtercategoria
        $filtersearch
        $filtercampoOrden
        $filterpagination;        
        EOD;
        //Ver $query
        $result = $conexion->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $value) {
                $card = new productmodel();
                $card->nombre = $value["titulo"];
                $card->precio = $value["precio"];
                $card->descripcion = $value["descripcion"];
                $card->fecha_alta = $value["fecha_alta"];
                $card->url = $value["url"];
                $card->idproduct = $value["idproduct"];
                $card->nombrecategoria = $value["nombrecategoria"];
                $card->idcategoria = $value["idcategoria"];

                $array[] = $card;
            }
        }
        return $array;
    }


    public function getimgdetail($idproduct)
    {
        $conexion = $this->connect();
        $query = <<<EOD
        SELECT idproduct, idmultimedia, url, priority
        FROM multimedia
        WHERE idproduct = $idproduct;
        EOD;
        $result = $conexion->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $value) {
                $img = new imgmodel();
                $img->idproduct = $value["idproduct"];
                $img->idmultimedia = $value["idmultimedia"];
                $img->url = $value["url"];
                $img->priority = $value["priority"];

                $array[] = $img;
            }
        }
        return $array;
    }

    function getdetail($idproduct)
    {
        $card = new productmodel();
        $conexion = $this->connect();
        $query = <<<EOD
        SELECT categoria.nombrecategoria, product.idproduct, titulo, descripcion, precio, fecha_alta
        FROM product
        JOIN categoria
        ON product.idcategoria = categoria.idcategoria
        WHERE product.idproduct  = $idproduct;
        EOD;
        $result = $conexion->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            $value = $rows[0];
            $card->nombre = $value["titulo"];
            $card->precio = $value["precio"];
            $card->descripcion = $value["descripcion"];
            $card->fecha_alta = $value["fecha_alta"];
            $card->categoria = $value["nombrecategoria"];
        }
        return $card;
    }

    function insertarmultimedia($directorynumber, $url, $priority)
    {
        $conexion = $this->connect();
        $query = <<<EOD
        INSERT INTO multimedia
        (idproduct,url,priority)
        VALUES ("$directorynumber","$url","$priority")
        EOD;
        $result = $conexion->query($query);
    }

    function getcategoria($idcategory = "")
    {
        $array = [];
        $conexion = $this->connect();
        $filtercategory = "";
        if (!empty($idcategory)) $filtercategory = "WHERE idcategoria = $idcategory";
        $query = <<<EOD
        SELECT * FROM categoria
        $filtercategory
        EOD;
        $result = $conexion->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) > 0) {
            foreach ($rows as $value) {
                $categoriamodelinstance = new categoriamodel();
                $categoriamodelinstance->nombrecategoria = $value["nombrecategoria"];
                $categoriamodelinstance->idcategoria = $value["idcategoria"];
                $array[] = $categoriamodelinstance;
            }
        }
        return $array;
    }

    function insertproduct($titulo, $descripcion, $precio, $idcategoria)
    {
        $conexion = $this->connect();
        $query = <<<EOD
        INSERT INTO product 
        (titulo,descripcion,precio,idcategoria,fecha_alta)
        VALUES ("$titulo","$descripcion","$precio","$idcategoria",now())
        ;
        EOD;
        $result = $conexion->query($query);
        return true;
    }

    function getmaxid()
    {
        $conexion = $this->connect();
        $query = "SELECT MAX(idproduct) as maxid FROM product";
        $result = $conexion->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            $value = $rows[0];
            $instanciaModel = new idmaxmodel();
            $instanciaModel->maxid = $value["maxid"];
        }
        return $instanciaModel;
    }

    function getproductdata()
    {
        $array = [];
        $conexion = $this->connect();
        $query = <<<EOD
        SELECT multimedia.priority , multimedia.url, product.idproduct, titulo, descripcion, precio, idcategoria, fecha_alta
        FROM product
        JOIN multimedia
        ON product.idproduct = multimedia.idproduct
        WHERE multimedia.priority  = 1
        LIMIT 6;
        EOD;
        $result = $conexion->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0) {
            foreach ($rows as $value) {
                $card = new productmodel();
                $card->nombre = $value["titulo"];
                $card->precio = $value["precio"];
                $card->descripcion = $value["descripcion"];
                $card->fecha_alta = $value["fecha_alta"];
                $card->url = $value["url"];
                $card->idproduct = $value["idproduct"];

                $array[] = $card;
            }
        }
        return $array;
    }
}
