<?php
require_once "controllers/baseController.php";
require_once "controllers/productController.php";

class homeController extends BaseController
{
    public function index()
    {
        $productInstance = new productController;
        $productInstance->index();
        require_once './view/home/index.php';
    }
}
