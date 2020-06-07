<?php
require_once "controllers/baseController.php";
require_once "data/product/product.php";
require_once "config/config.php";
require_once "controllers/encrypController.php";
require_once "data/user/user.php";
require_once "models/product/img.php";


class productController extends baseController
{
    public function loadajax()
    {
        $productdatainstance = new productdata();

        $nombre = "";
        $directory = "";
        $idproduct = "";

        if (isset($_POST["idproduct"])) $directory = "img/" . $_POST["idproduct"];
        $idproduct = $_POST["idproduct"];

        if (isset($_FILES["inputfileimg"])) {
            $nombre = ($_FILES["inputfileimg"]['name']);
            $upload = $this->upload($nombre, "inputfileimg", $directory, array("image/jpeg", "image/png", "image/gif"));
            $directorycomplet = $directory . "/" . $nombre;
            $check = $productdatainstance->insertarmultimedia($idproduct, $directorycomplet, 0);
        }
        if ($upload) echo "Subida OK";
    }

    function deleteoneimg()
    {
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
    }
    function modify()
    {
        $productdatainstace = new productdata();

        $idproductupdate = "";
        $titulo = "";
        $descripcion = "";
        $precio = "";
        $idcategoria = "";
        $idproductdelete = "";

        //Falta a agregar isset y hacer funcion en data y llamarla de delte

        if (isset($_POST["titulo"])) $titulo = $_POST["titulo"];
        if (isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
        if (isset($_POST["precio"])) $precio = $_POST["precio"];
        if (isset($_POST["idcategoria"])) $idcategoria = $_POST["idcategoria"];

        if (isset($_GET["delete"])) {
            $idproductdelete = $_GET["delete"];
            $productdatainstace->deleteData($idproductdelete);
            $realpathdirectorydelete = realpath("img/" . $idproductdelete);
            $check2 = array_map('unlink', glob("$realpathdirectorydelete/*.*"));
            $check = rmdir($realpathdirectorydelete);
            $showmodal = "Borrado con exito";
        }

        if (isset($_POST["idproductmodify"])) {
            $idproductupdate = $_POST["idproductmodify"];
            $productdatainstace->modifyData($idproductupdate, $titulo, $descripcion, $precio, $idcategoria);
            $showmodal = "Modificado con exito";
        }

        $variableimagenes = $productdatainstace->allimg(); //Todas las imagenes
        //var_dump($variableimagenes); 

        $dataproductforrender = $productdatainstace->all();
        $categorias = $productdatainstace->getcategoria();

        $json = json_encode($variableimagenes);

        require_once "view/product/modify.php";
    }

    function all()
    {
        $productdatainstace = new productdata();
        $page = "0";
        $pagination = "0";
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            $pagination = 5 * $page;
        }
        $idcategoria  = "";
        $sort = "1";
        $search = "";

        if (isset($_POST["search"])) $search = $_POST["search"];

        if (isset($_GET["idcategoria"])) $idcategoria = $_GET["idcategoria"];
        if (isset($_GET["sort"])) $sort = $_GET["sort"];
        $dataproductforrender = $productdatainstace->all($pagination, $idcategoria, $sort, $search);
        $categoria = $productdatainstace->getcategoria();

        require_once "view/product/all.php";
    }

    function detail()
    {
        $idproduct = "";
        if (isset($_GET["idproduct"])) $idproduct = $_GET["idproduct"];
        $productdatainstace = new productdata();
        $forrenderinfo = $productdatainstace->getdetail($idproduct); //HACER VARDUMP??
        $forrenderimg = $productdatainstace->getimgdetail($idproduct);

        require_once "view/product/detail.php";
    }

    function insertform()
    {
        $url = "";
        $productdatainstance = new productdata();
        $arraydirectory = "";
        $arraydirectory = $productdatainstance->getmaxid();
        $directorynumber = $arraydirectory->maxid + 1;
        $directory = "img/" . $directorynumber;
        print $directory;
        if (isset($_FILES["image"])) {
            foreach ($_FILES as $key => $value) {
                echo $key;
                $url = $directory . "/" . $value['name'];
                $upload = $this->upload($value['name'], $key, $directory, array("image/jpeg", "image/png", "image/gif"));
                $priority = "0";
                if ($key == "image") $priority = "1";
                $productdatainstance->insertarmultimedia($directorynumber, $url, $priority);
            }
        }
        if (isset($upload) && $upload["uploaded"]) {
            echo "<p>Imagen Subida Exitosamente !</p>";
        } elseif (isset($upload) && $upload["uploaded"] == false) {
            echo "<p>No se subio la imagen</p>";
            echo "<p>Error: " . $upload["error"] . "</p>";
        }

        $titulo = "";
        $descripcion = "";
        $precio = "";
        $idcategoria = "";


        if (isset($_POST["descripcion"])) $descripcion = $_POST["descripcion"];
        if (isset($_POST["precio"])) $precio = $_POST["precio"];
        if (isset($_POST["categoria"])) $idcategoria = $_POST["categoria"];
        if (isset($_POST["titulo"])) {
            $titulo = $_POST["titulo"];
            $productdatainstance->insertproduct($titulo, $descripcion, $precio, $idcategoria);
        }
        $categoria = $productdatainstance->getcategoria();

        require_once "view/load/loadform.php";
    }

    function index()
    {
        $productdatainstace = new productdata();
        $dataproductforrender = $productdatainstace->getproductdata();

        require "view/product/index.php";
    }


    //DELETE IMG FUNCTION PARA BORRAR ARCHIVO.

    private $info_file;

    public function __construct()
    {
        $this->info_file = array();
    }

    public function upload($name, $file, $directory, $types_allowed, $force_name = NULL)
    {
        $this->info_file = array(
            "name"            => $_FILES["$file"]["name"],
            "complete_name" => $_FILES["$file"]["name"],
            "temporal_name" => $_FILES["$file"]["tmp_name"],
            "type"            => $_FILES["$file"]["type"],
            "size"            => $_FILES["$file"]["size"],
            "error"            => $_FILES["$file"]["error"]
        );

        if ($force_name != NULL) {
            $this->info_file["complete_name"] = $name;
        }

        if (is_uploaded_file($this->info_file["temporal_name"])) {
            if (is_array($types_allowed) && in_array($this->info_file["type"], $types_allowed)) {

                if (!is_dir($directory)) {
                    $dir = mkdir($directory, 0777, true);
                } else {
                    $dir = true;
                }

                if ($dir) {
                    $mpf = move_uploaded_file($this->info_file["temporal_name"], $directory . "/" . $this->info_file["complete_name"]);

                    if ($mpf) {
                        $uploaded = true;
                    } else {
                        $uploaded = false;
                        $error = "The file has not moved";
                    }
                } else {
                    $upload = false;
                    $error = "The directory does not exist";
                }
            } else {
                $uploaded = false;
                $error = "The type of file to be uploaded is not allowed";
            }
        } else {
            $uploaded = false;
            $error = "The file has not been uploaded";
        }

        $response = array("uploaded" => $uploaded, "error" => null);

        if (isset($uploaded) && isset($error)) {
            $response = array(
                "uploaded" => $uploaded,
                "error" => $error
            );
        }

        return $response;
    }

    public function getInfoFile()
    {
        return $this->info_file;
    }
}
