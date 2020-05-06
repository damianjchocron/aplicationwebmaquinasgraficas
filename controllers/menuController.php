<?php 

    require_once "controllers/baseController.php";
    

    class menuController extends baseController{

        public function header(){
            
            require_once "view/layout/header.php";
        }
        public function footer()
        {
            require_once "view/layout/footer.php";
        }

       
    }
?> 